<?php

declare (strict_types=1);
namespace Rector\Application;

use RectorPrefix202406\Nette\Utils\FileSystem as UtilsFileSystem;
use Rector\Caching\Detector\ChangedFilesDetector;
use Rector\Configuration\Option;
use Rector\Configuration\Parameter\SimpleParameterProvider;
use Rector\Configuration\VendorMissAnalyseGuard;
use Rector\Parallel\Application\ParallelFileProcessor;
use Rector\Provider\CurrentFileProvider;
use Rector\Testing\PHPUnit\StaticPHPUnitEnvironment;
use Rector\Util\ArrayParametersMerger;
use Rector\ValueObject\Application\File;
use Rector\ValueObject\Configuration;
use Rector\ValueObject\Error\SystemError;
use Rector\ValueObject\FileProcessResult;
use Rector\ValueObject\ProcessResult;
use Rector\ValueObject\Reporting\FileDiff;
use Rector\ValueObjectFactory\Application\FileFactory;
use RectorPrefix202406\Symfony\Component\Console\Input\InputInterface;
use RectorPrefix202406\Symfony\Component\Console\Style\SymfonyStyle;
use RectorPrefix202406\Symplify\EasyParallel\CpuCoreCountProvider;
use RectorPrefix202406\Symplify\EasyParallel\Exception\ParallelShouldNotHappenException;
use RectorPrefix202406\Symplify\EasyParallel\ScheduleFactory;
use Throwable;
final class ApplicationFileProcessor
{
    /**
     * @readonly
     * @var \Symfony\Component\Console\Style\SymfonyStyle
     */
    private $symfonyStyle;
    /**
     * @readonly
     * @var \Rector\ValueObjectFactory\Application\FileFactory
     */
    private $fileFactory;
    /**
     * @readonly
     * @var \Rector\Parallel\Application\ParallelFileProcessor
     */
    private $parallelFileProcessor;
    /**
     * @readonly
     * @var \Symplify\EasyParallel\ScheduleFactory
     */
    private $scheduleFactory;
    /**
     * @readonly
     * @var \Symplify\EasyParallel\CpuCoreCountProvider
     */
    private $cpuCoreCountProvider;
    /**
     * @readonly
     * @var \Rector\Caching\Detector\ChangedFilesDetector
     */
    private $changedFilesDetector;
    /**
     * @readonly
     * @var \Rector\Provider\CurrentFileProvider
     */
    private $currentFileProvider;
    /**
     * @readonly
     * @var \Rector\Application\FileProcessor
     */
    private $fileProcessor;
    /**
     * @readonly
     * @var \Rector\Util\ArrayParametersMerger
     */
    private $arrayParametersMerger;
    /**
     * @readonly
     * @var \Rector\Configuration\VendorMissAnalyseGuard
     */
    private $vendorMissAnalyseGuard;
    /**
     * @var string
     */
    private const ARGV = 'argv';
    /**
     * @var SystemError[]
     */
    private $systemErrors = [];
    public function __construct(SymfonyStyle $symfonyStyle, FileFactory $fileFactory, ParallelFileProcessor $parallelFileProcessor, ScheduleFactory $scheduleFactory, CpuCoreCountProvider $cpuCoreCountProvider, ChangedFilesDetector $changedFilesDetector, CurrentFileProvider $currentFileProvider, \Rector\Application\FileProcessor $fileProcessor, ArrayParametersMerger $arrayParametersMerger, VendorMissAnalyseGuard $vendorMissAnalyseGuard)
    {
        $this->symfonyStyle = $symfonyStyle;
        $this->fileFactory = $fileFactory;
        $this->parallelFileProcessor = $parallelFileProcessor;
        $this->scheduleFactory = $scheduleFactory;
        $this->cpuCoreCountProvider = $cpuCoreCountProvider;
        $this->changedFilesDetector = $changedFilesDetector;
        $this->currentFileProvider = $currentFileProvider;
        $this->fileProcessor = $fileProcessor;
        $this->arrayParametersMerger = $arrayParametersMerger;
        $this->vendorMissAnalyseGuard = $vendorMissAnalyseGuard;
    }
    public function run(Configuration $configuration, InputInterface $input) : ProcessResult
    {
        $filePaths = $this->fileFactory->findFilesInPaths($configuration->getPaths(), $configuration);
        $this->verifyVendor($filePaths);
        $this->verifySkippedRules();
        // no files found
        if ($filePaths === []) {
            return new ProcessResult([], []);
        }
        $this->configureCustomErrorHandler();
        /**
         * Mimic @see https://github.com/phpstan/phpstan-src/blob/ab154e1da54d42fec751e17a1199b3e07591e85e/src/Command/AnalyseApplication.php#L188C23-L244
         */
        if ($configuration->shouldShowProgressBar()) {
            $fileCount = \count($filePaths);
            $this->symfonyStyle->progressStart($fileCount);
            $this->symfonyStyle->progressAdvance(0);
            $postFileCallback = function (int $stepCount) : void {
                $this->symfonyStyle->progressAdvance($stepCount);
                // running in parallel here → nothing else to do
            };
        } else {
            $postFileCallback = static function (int $stepCount) : void {
            };
        }
        if ($configuration->isDebug()) {
            $preFileCallback = function (string $filePath) : void {
                $this->symfonyStyle->writeln('[file] ' . $filePath);
            };
        } else {
            $preFileCallback = null;
        }
        if ($configuration->isParallel()) {
            $processResult = $this->runParallel($filePaths, $input, $postFileCallback);
        } else {
            $processResult = $this->processFiles($filePaths, $configuration, $preFileCallback, $postFileCallback);
        }
        $processResult->addSystemErrors($this->systemErrors);
        $this->restoreErrorHandler();
        return $processResult;
    }
    /**
     * @param string[] $filePaths
     * @param callable(string $file): void|null $preFileCallback
     * @param callable(int $fileCount): void|null $postFileCallback
     */
    public function processFiles(array $filePaths, Configuration $configuration, ?callable $preFileCallback = null, ?callable $postFileCallback = null) : ProcessResult
    {
        /** @var SystemError[] $systemErrors */
        $systemErrors = [];
        /** @var FileDiff[] $fileDiffs */
        $fileDiffs = [];
        foreach ($filePaths as $filePath) {
            if ($preFileCallback !== null) {
                $preFileCallback($filePath);
            }
            $file = new File($filePath, UtilsFileSystem::read($filePath));
            try {
                $fileProcessResult = $this->processFile($file, $configuration);
                $systemErrors = $this->arrayParametersMerger->merge($systemErrors, $fileProcessResult->getSystemErrors());
                $currentFileDiff = $fileProcessResult->getFileDiff();
                if ($currentFileDiff instanceof FileDiff) {
                    $fileDiffs[] = $currentFileDiff;
                }
                // progress bar on parallel handled on runParallel()
                if (\is_callable($postFileCallback)) {
                    $postFileCallback(1);
                }
            } catch (Throwable $throwable) {
                $this->changedFilesDetector->invalidateFile($filePath);
                if (StaticPHPUnitEnvironment::isPHPUnitRun()) {
                    throw $throwable;
                }
                $systemErrors[] = $this->resolveSystemError($throwable, $filePath);
            }
        }
        return new ProcessResult($systemErrors, $fileDiffs);
    }
    /**
     * @param string[] $filePaths
     */
    private function verifyVendor(array $filePaths) : void
    {
        if ($this->vendorMissAnalyseGuard->isVendorAnalyzed($filePaths)) {
            $this->symfonyStyle->warning(\sprintf('Rector has detected a "/vendor" directory in your configured paths. If this is Composer\'s vendor directory, this is not necessary as it will be autoloaded. Scanning the Composer vendor directory will cause Rector to run much slower and possibly with errors.%sRemove "/vendor" from Rector paths and run again.', \PHP_EOL . \PHP_EOL));
            \sleep(3);
        }
    }
    private function verifySkippedRules() : void
    {
        $registeredRules = SimpleParameterProvider::provideArrayParameter(Option::REGISTERED_RECTOR_RULES);
        $skippedRules = SimpleParameterProvider::provideArrayParameter(Option::SKIPPED_RECTOR_RULES);
        $neverRegisteredSkippedRules = \array_unique(\array_diff($skippedRules, $registeredRules));
        if ($neverRegisteredSkippedRules !== []) {
            $total = \count($neverRegisteredSkippedRules);
            $reportNeverRegisteredRules = \implode(\PHP_EOL, $neverRegisteredSkippedRules);
            $this->symfonyStyle->warning(\sprintf('[Note] The following rule%s %s ignored, but %s actually never registered. You can remove %s from the withSkip([...]) method.%s%s', $total > 1 ? 's' : '', $total > 1 ? 'are' : 'is', $total > 1 ? 'they are' : 'it is', $total > 1 ? 'them' : 'it', \PHP_EOL, \PHP_EOL . $reportNeverRegisteredRules));
            \sleep(3);
        }
    }
    private function processFile(File $file, Configuration $configuration) : FileProcessResult
    {
        $this->currentFileProvider->setFile($file);
        $fileProcessResult = $this->fileProcessor->processFile($file, $configuration);
        if ($fileProcessResult->getSystemErrors() !== []) {
            $this->changedFilesDetector->invalidateFile($file->getFilePath());
        } elseif (!$configuration->isDryRun() || !$fileProcessResult->getFileDiff() instanceof FileDiff) {
            $this->changedFilesDetector->cacheFile($file->getFilePath());
        }
        return $fileProcessResult;
    }
    private function resolveSystemError(Throwable $throwable, string $filePath) : SystemError
    {
        $errorMessage = \sprintf('System error: "%s"', $throwable->getMessage()) . \PHP_EOL;
        if ($this->symfonyStyle->isDebug()) {
            $errorMessage .= \PHP_EOL . 'Stack trace:' . \PHP_EOL . $throwable->getTraceAsString();
        } else {
            $errorMessage .= 'Run Rector with "--debug" option and post the report here: https://github.com/rectorphp/rector/issues/new';
        }
        return new SystemError($errorMessage, $filePath, $throwable->getLine());
    }
    /**
     * Inspired by @see https://github.com/phpstan/phpstan-src/blob/89af4e7db257750cdee5d4259ad312941b6b25e8/src/Analyser/Analyser.php#L134
     */
    private function configureCustomErrorHandler() : void
    {
        $errorHandlerCallback = function (int $code, string $message, string $file, int $line) : bool {
            if ((\error_reporting() & $code) === 0) {
                // silence @ operator
                return \true;
            }
            // not relevant for us
            if (\in_array($code, [\E_DEPRECATED, \E_WARNING], \true)) {
                return \true;
            }
            $this->systemErrors[] = new SystemError($message, $file, $line);
            return \true;
        };
        \set_error_handler($errorHandlerCallback);
    }
    private function restoreErrorHandler() : void
    {
        \restore_error_handler();
    }
    /**
     * @param string[] $filePaths
     * @param callable(int $stepCount): void $postFileCallback
     */
    private function runParallel(array $filePaths, InputInterface $input, callable $postFileCallback) : ProcessResult
    {
        $schedule = $this->scheduleFactory->create($this->cpuCoreCountProvider->provide(), SimpleParameterProvider::provideIntParameter(Option::PARALLEL_JOB_SIZE), SimpleParameterProvider::provideIntParameter(Option::PARALLEL_MAX_NUMBER_OF_PROCESSES), $filePaths);
        $mainScript = $this->resolveCalledRectorBinary();
        if ($mainScript === null) {
            throw new ParallelShouldNotHappenException('[parallel] Main script was not found');
        }
        // mimics see https://github.com/phpstan/phpstan-src/commit/9124c66dcc55a222e21b1717ba5f60771f7dda92#diff-387b8f04e0db7a06678eb52ce0c0d0aff73e0d7d8fc5df834d0a5fbec198e5daR139
        return $this->parallelFileProcessor->process($schedule, $mainScript, $postFileCallback, $input);
    }
    /**
     * Path to called "rector" binary file, e.g. "vendor/bin/rector" returns "vendor/bin/rector" This is needed to re-call the
     * ecs binary in sub-process in the same location.
     */
    private function resolveCalledRectorBinary() : ?string
    {
        if (!isset($_SERVER[self::ARGV][0])) {
            return null;
        }
        $potentialRectorBinaryPath = $_SERVER[self::ARGV][0];
        if (!\file_exists($potentialRectorBinaryPath)) {
            return null;
        }
        return $potentialRectorBinaryPath;
    }
}
