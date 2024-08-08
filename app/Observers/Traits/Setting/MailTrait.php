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

use App\Providers\AppService\ConfigTrait\MailConfig;

trait MailTrait
{
	use MailConfig;
	
	/**
	 * Updating
	 *
	 * @param $setting
	 * @param $original
	 * @return bool
	 */
	public function mailUpdating($setting, $original)
	{
		// Test the mail driver config
		$driverTest = $setting->value['driver_test'] ?? '0';
		$driverTest = ($driverTest == '1');
		$mailTo = $setting->value['email_always_to'] ?? null;
		
		$errorMessage = $this->testMailConfig($driverTest, $mailTo, $setting->value, true);
		if (!empty($errorMessage)) {
			notification($errorMessage, 'error');
			
			return false;
		}
	}
}
