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

namespace App\Exceptions\Handler;

use Illuminate\Http\Exceptions\ThrottleRequestsException as OrigThrottleRequestsException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/*
 * Throttle Requests Exception
 */

trait ThrottleRequestsExceptionHandler
{
	/**
	 * @param \Throwable $e
	 * @return bool
	 */
	protected function isThrottleRequestsException(\Throwable $e): bool
	{
		return ($e instanceof OrigThrottleRequestsException);
	}
	
	/**
	 * @param \Throwable $e
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
	 */
	protected function responseThrottleRequestsException(\Throwable $e, Request $request): Response|JsonResponse
	{
		$message = $this->getThrottleRequestsExceptionMessage($e, $request);
		
		return $this->responseCustomError($e, $request, $message, Response::HTTP_TOO_MANY_REQUESTS);
	}
	
	// PRIVATE
	
	/**
	 * @param \Throwable $e
	 * @param \Illuminate\Http\Request $request
	 * @return string
	 */
	private function getThrottleRequestsExceptionMessage(\Throwable $e, Request $request): string
	{
		$message = 'Too Many Requests, Please Slow Down.';
		
		if (!empty($e->getMessage())) {
			$message .= "\n" . $e->getMessage();
		}
		
		return $message;
	}
}
