<?php
/*
 * LaraClassifier - Classified Ads Web Application
 * Copyright (c) BeDigit. All Rights Reserved
 *
 * Website: https://laraclassifier.com
 * Author: BeDigit | https://bedigit.com
 *
 * LICENSE
 * -------
 * This software is furnished under a license and may be used and copied
 * only in accordance with the terms of such license and with the inclusion
 * of the above copyright notice. If you Purchased from CodeCanyon,
 * Please read the full License from here - https://codecanyon.net/licenses/standard
 */

use App\Exceptions\Custom\CustomException;
use App\Helpers\DotenvEditor;

/**
 * @param string|null $purchaseCode
 * @param string|null $itemId
 * @return string
 */
function getPurchaseCodeApiEndpoint(?string $purchaseCode, string $itemId = null): string
{
	$baseUrl = getAsString(config('larapen.core.purchaseCodeCheckerUrl'));
	
	return $baseUrl . $purchaseCode . '&domain=' . getDomain() . '&item_id=' . $itemId;
}

/**
 * Create the "installed" file
 *
 * @param bool $stopOnException
 * @return void
 * @throws \App\Exceptions\Custom\CustomException
 */
function createTheInstalledFile(bool $stopOnException = false): void
{
	$filePath = storage_path('installed');
	$content = '';
	
	if (!file_exists($filePath)) {
		try {
			file_put_contents($filePath, $content);
		} catch (\Throwable $e) {
		}
	}
	
	if (!file_exists($filePath)) {
		try {
			$fp = fopen($filePath, 'w');
			fwrite($fp, $content);
			fclose($fp);
		} catch (\Throwable $e) {
			if ($stopOnException) {
				throw new CustomException($e->getMessage());
			}
		}
	}
}

/**
 * Check if the app's installation files exist
 *
 * @return bool
 */
function appInstallFilesExist(): bool
{
	// Check if the '.env' and 'storage/installed' files exist
	if (file_exists(base_path('.env')) && file_exists(storage_path('installed'))) {
		return true;
	}
	
	return false;
}

/**
 * Check if the app is installed
 *
 * @return bool
 */
function appIsInstalled(): bool
{
	// Check if the app's installation files exist
	return appInstallFilesExist();
}

/**
 * Check if the app is being installed or upgraded
 *
 * @return bool
 */
function appIsBeingInstalledOrUpgraded(): bool
{
	return (appIsBeingInstalled() || appIsBeingUpgraded());
}

/**
 * Check if the app is being installed
 *
 * @return bool
 */
function appIsBeingInstalled(): bool
{
	return str_contains(currentRouteAction(), 'InstallController');
}

/**
 * Check if the app is being upgraded
 *
 * @return bool
 */
function appIsBeingUpgraded(): bool
{
	return str_contains(currentRouteAction(), 'UpgradeController');
}

/**
 * Check if an update is available
 *
 * @return bool
 */
function updateIsAvailable(): bool
{
	// Check if the '.env' file exists
	if (!file_exists(base_path('.env'))) {
		return false;
	}
	
	$updateIsAvailable = false;
	
	// Get eventual new version value & the current (installed) version value
	$lastVersion = getLatestVersion();
	$currentVersion = getCurrentVersion();
	
	// Check the update
	if (version_compare($lastVersion, $currentVersion, '>')) {
		$updateIsAvailable = true;
	}
	
	return $updateIsAvailable;
}

/**
 * Get the current version value
 *
 * @return null|string
 */
function getCurrentVersion(): ?string
{
	$version = DotenvEditor::getValue('APP_VERSION');
	
	return checkAndUseSemVer($version);
}

/**
 * Get the app's latest version
 *
 * @return string
 */
function getLatestVersion(): string
{
	return checkAndUseSemVer(config('version.app'));
}

/**
 * Get a given update file version
 *
 * @param string $filePath
 * @return string
 */
function getUpdateFileVersion(string $filePath): string
{
	return str($filePath)->lower()->between('update-', '.php')->toString();
}

/**
 * Check and use semver version num format
 *
 * @param string|null $version
 * @return string
 */
function checkAndUseSemVer(?string $version): string
{
	$defaultSemver = '0.0.0';
	
	if (empty($version)) {
		return $defaultSemver;
	}
	
	$semver = null;
	
	if (empty($semver)) {
		$numPattern = '([0-9]+)';
		$hasValidFormat = preg_match('#^' . $numPattern . '\.' . $numPattern . '\.' . $numPattern . '$#', $version);
		$semver = $hasValidFormat ? $version : $semver;
	}
	if (empty($semver)) {
		$hasValidFormat = preg_match('#^' . $numPattern . '\.' . $numPattern . '$#', $version);
		$semver = $hasValidFormat ? $version . '.0' : $semver;
	}
	if (empty($semver)) {
		$hasValidFormat = preg_match('#^' . $numPattern . '$#', $version);
		$semver = $hasValidFormat ? $version . '.0.0' : $semver;
	}
	if (empty($semver)) {
		$semver = $defaultSemver;
	}
	
	return $semver;
}
