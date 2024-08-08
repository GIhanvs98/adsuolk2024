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

namespace App\Observers\Traits\Setting;

use App\Models\Currency;
use App\Providers\AppService\ConfigTrait\CurrencyexchangeConfig;
use Illuminate\Support\Facades\DB;

trait CurrencyexchangeTrait
{
	use CurrencyexchangeConfig;
	
	/**
	 * Updating
	 *
	 * @param $setting
	 * @param $original
	 * @return bool
	 */
	public function currencyexchangeUpdating($setting, $original)
	{
		// Test the Currency Exchange driver config
		$driverTest = $setting->value['driver_test'] ?? '0';
		$driverTest = ($driverTest == '1');
		
		$errorMessage = $this->testCurrencyexchangeConfig($driverTest, $setting->value);
		if (!empty($errorMessage)) {
			notification($errorMessage, 'error');
			
			return false;
		}
		
		// If the Currency Exchange driver is changed, then clear existing rates
		if (is_array($setting->value) && array_key_exists('driver', $setting->value)) {
			$origDriver = $original['value']['driver'] ?? null;
			$driver = $setting->value['driver'] ?? null;
			
			$isDriverChanged = ($driver != $origDriver);
			if ($isDriverChanged) {
				$defaultCurrencyBase = config('currencyexchange.drivers.' . $driver . '.currencyBase');
				$currencyBase = $setting->value[$driver . '_base'] ?? $defaultCurrencyBase;
				
				$origDefaultCurrencyBase = config('currencyexchange.drivers.' . $origDriver . '.currencyBase');
				$origCurrencyBase = $original['value'][$origDriver . '_base'] ?? $origDefaultCurrencyBase;
				
				$isCurrencyBaseChanged = ($currencyBase != $origCurrencyBase);
				if ($isCurrencyBaseChanged) {
					$affected = DB::table((new Currency)->getTable())->update(['rate' => null]);
				}
			}
		}
	}
	
	/**
	 * Saved
	 *
	 * @param $setting
	 */
	public function currencyexchangeSaved($setting): void
	{
		try {
			cache()->forget('update.currencies.rates');
		} catch (\Exception $e) {
		}
	}
}
