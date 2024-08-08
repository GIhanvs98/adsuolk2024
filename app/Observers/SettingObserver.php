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

namespace App\Observers;

use App\Models\Setting;
use App\Observers\Traits\Setting\AppTrait;
use App\Observers\Traits\Setting\CurrencyexchangeTrait;
use App\Observers\Traits\Setting\DomainmappingTrait;
use App\Observers\Traits\Setting\ListingFormTrait;
use App\Observers\Traits\Setting\ListingsListTrait;
use App\Observers\Traits\Setting\LocalizationTrait;
use App\Observers\Traits\Setting\MailTrait;
use App\Observers\Traits\Setting\OptimizationTrait;
use App\Observers\Traits\Setting\SecurityTrait;
use App\Observers\Traits\Setting\SeoTrait;
use App\Observers\Traits\Setting\SmsTrait;
use App\Observers\Traits\Setting\SocialShareTrait;
use App\Observers\Traits\Setting\StyleTrait;

class SettingObserver
{
	use AppTrait, CurrencyexchangeTrait, DomainmappingTrait, ListingFormTrait, ListingsListTrait, LocalizationTrait;
	use MailTrait, OptimizationTrait, SecurityTrait, SeoTrait, SmsTrait, SocialShareTrait, StyleTrait;
	
	/**
	 * Listen to the Entry updating event.
	 *
	 * @param Setting $setting
	 * @return void
	 */
	public function updating(Setting $setting)
	{
		if (isset($setting->key) && isset($setting->value)) {
			// Get the original object values
			$original = $setting->getOriginal();
			
			if (is_array($original) && array_key_exists('value', $original)) {
				$original['value'] = jsonToArray($original['value']);
				
				// Find & call sub-setting observer's action
				$settingMethodName = str($setting->key)->camel() . 'Updating';
				if (method_exists($this, $settingMethodName)) {
					return $this->$settingMethodName($setting, $original);
				}
			}
		}
	}
	
	/**
	 * Listen to the Entry updated event.
	 *
	 * @param Setting $setting
	 * @return void
	 */
	public function updated(Setting $setting)
	{
		// Find & call sub-setting observer's action
		$settingMethodName = str($setting->key)->camel() . 'Updated';
		if (method_exists($this, $settingMethodName)) {
			$this->$settingMethodName($setting);
		}
		
		// Removing Entries from the Cache
		$this->clearCache($setting);
	}
	
	/**
	 * Listen to the Entry saved event.
	 *
	 * @param Setting $setting
	 * @return void
	 */
	public function saved(Setting $setting)
	{
		// Find & call sub-setting observer's action
		$settingMethodName = str($setting->key)->camel() . 'Saved';
		if (method_exists($this, $settingMethodName)) {
			$this->$settingMethodName($setting);
		}
		
		// Removing Entries from the Cache
		$this->clearCache($setting);
	}
	
	/**
	 * Listen to the Entry deleted event.
	 *
	 * @param Setting $setting
	 * @return void
	 */
	public function deleted(Setting $setting)
	{
		// Removing Entries from the Cache
		$this->clearCache($setting);
	}
	
	/**
	 * Removing the Entity's Entries from the Cache
	 *
	 * @param $setting
	 * @return void
	 */
	private function clearCache($setting): void
	{
		try {
			cache()->flush();
		} catch (\Exception $e) {
		}
	}
}
