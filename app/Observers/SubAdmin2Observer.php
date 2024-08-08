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

use App\Models\City;
use App\Models\SubAdmin2;

class SubAdmin2Observer
{
	/**
	 * Listen to the Entry deleting event.
	 *
	 * @param SubAdmin2 $admin
	 * @return void
	 */
	public function deleting(SubAdmin2 $admin)
	{
		// Delete all the cities of the admin. division
		$cities = City::inCountry($admin->country_code)->where('subadmin2_code', $admin->code);
		if ($cities->count() > 0) {
			foreach ($cities->cursor() as $city) {
				$city->delete();
			}
		}
	}
	
	/**
	 * Listen to the Entry saved event.
	 *
	 * @param SubAdmin2 $admin
	 * @return void
	 */
	public function saved(SubAdmin2 $admin)
	{
		// Removing Entries from the Cache
		$this->clearCache($admin);
	}
	
	/**
	 * Listen to the Entry deleted event.
	 *
	 * @param SubAdmin2 $admin
	 * @return void
	 */
	public function deleted(SubAdmin2 $admin)
	{
		// Removing Entries from the Cache
		$this->clearCache($admin);
	}
	
	/**
	 * Removing the Entity's Entries from the Cache
	 *
	 * @param $admin
	 * @return void
	 */
	private function clearCache($admin): void
	{
		try {
			cache()->flush();
		} catch (\Exception $e) {
		}
	}
}
