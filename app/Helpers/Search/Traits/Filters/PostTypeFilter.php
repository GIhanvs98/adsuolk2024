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

namespace App\Helpers\Search\Traits\Filters;

use App\Enums\PostType;

trait PostTypeFilter
{
	protected function applyPostTypeFilter(): void
	{
		if (config('settings.listing_form.show_listing_type') != '1') {
			return;
		}
		
		if (!isset($this->posts)) {
			return;
		}
		
		$postTypeId = request()->input('type');
		$postTypeId = is_int($postTypeId) ? $postTypeId : null;
		
		if (empty($postTypeId)) {
			return;
		}
		
		if (!$this->checkIfPostTypeExists($postTypeId)) {
			abort(404, t('post_type_not_found'));
		}
		
		$this->posts->where('post_type_id', $postTypeId);
	}
	
	/**
	 * Check if PostType exists
	 *
	 * @param $postTypeId
	 * @return bool
	 */
	private function checkIfPostTypeExists($postTypeId): bool
	{
		if (empty($postTypeId)) return false;
		
		return !empty(PostType::find($postTypeId));
	}
}
