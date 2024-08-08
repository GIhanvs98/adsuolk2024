<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$entries = [
			[
				'key'         => 'app',
				'name'        => 'Application',
				'field'       => null,
				'value'       => null,
				'description' => 'Application Global Options',
				'parent_id'   => null,
				'lft'         => 2,
				'rgt'         => 3,
				'depth'       => 1,
				'active'      => 1,
				'created_at'  => null,
				'updated_at'  => null,
			],
			[
				'key'         => 'style',
				'name'        => 'Style',
				'field'       => null,
				'value'       => null,
				'description' => 'Style Customization',
				'parent_id'   => null,
				'lft'         => 4,
				'rgt'         => 5,
				'depth'       => 1,
				'active'      => 1,
				'created_at'  => null,
				'updated_at'  => null,
			],
			[
				'key'         => 'listing_form',
				'name'        => 'Listing Form',
				'field'       => null,
				'value'       => null,
				'description' => 'Listing Form Options',
				'parent_id'   => null,
				'lft'         => 6,
				'rgt'         => 7,
				'depth'       => 1,
				'active'      => 1,
				'created_at'  => null,
				'updated_at'  => null,
			],
			[
				'key'         => 'listings_list',
				'name'        => 'Listings List',
				'field'       => null,
				'value'       => null,
				'description' => 'Listings List Options',
				'parent_id'   => null,
				'lft'         => 8,
				'rgt'         => 9,
				'depth'       => 1,
				'active'      => 1,
				'created_at'  => null,
				'updated_at'  => null,
			],
			[
				'key'         => 'listing_page',
				'name'        => 'Listing Page',
				'field'       => null,
				'value'       => null,
				'description' => 'Listing Details Page Options',
				'parent_id'   => null,
				'lft'         => 10,
				'rgt'         => 11,
				'depth'       => 1,
				'active'      => 1,
				'created_at'  => null,
				'updated_at'  => null,
			],
			[
				'key'         => 'mail',
				'name'        => 'Mail',
				'field'       => null,
				'value'       => null,
				'description' => 'Mail Sending Configuration',
				'parent_id'   => null,
				'lft'         => 12,
				'rgt'         => 13,
				'depth'       => 1,
				'active'      => 1,
				'created_at'  => null,
				'updated_at'  => null,
			],
			[
				'key'         => 'sms',
				'name'        => 'SMS',
				'field'       => null,
				'value'       => null,
				'description' => 'SMS Sending Configuration',
				'parent_id'   => null,
				'lft'         => 14,
				'rgt'         => 15,
				'depth'       => 1,
				'active'      => 1,
				'created_at'  => null,
				'updated_at'  => null,
			],
			[
				'key'         => 'upload',
				'name'        => 'Upload',
				'field'       => null,
				'value'       => null,
				'description' => 'Upload Settings',
				'parent_id'   => null,
				'lft'         => 16,
				'rgt'         => 17,
				'depth'       => 1,
				'active'      => 1,
				'created_at'  => null,
				'updated_at'  => null,
			],
			[
				'key'         => 'localization',
				'name'        => 'Localization',
				'field'       => null,
				'value'       => null,
				'description' => 'Localization Configuration',
				'parent_id'   => null,
				'lft'         => 18,
				'rgt'         => 19,
				'depth'       => 1,
				'active'      => 1,
				'created_at'  => null,
				'updated_at'  => null,
			],
			[
				'key'         => 'security',
				'name'        => 'Security',
				'field'       => null,
				'value'       => null,
				'description' => 'Security Options',
				'parent_id'   => null,
				'lft'         => 20,
				'rgt'         => 21,
				'depth'       => 1,
				'active'      => 1,
				'created_at'  => null,
				'updated_at'  => null,
			],
			[
				'key'         => 'social_auth',
				'name'        => 'Social Login',
				'field'       => null,
				'value'       => null,
				'description' => 'Social Network Login',
				'parent_id'   => null,
				'lft'         => 22,
				'rgt'         => 23,
				'depth'       => 1,
				'active'      => 1,
				'created_at'  => null,
				'updated_at'  => null,
			],
			[
				'key'         => 'social_link',
				'name'        => 'Social Network',
				'field'       => null,
				'value'       => null,
				'description' => 'Social Network Profiles',
				'parent_id'   => null,
				'lft'         => 24,
				'rgt'         => 25,
				'depth'       => 1,
				'active'      => 1,
				'created_at'  => null,
				'updated_at'  => null,
			],
			[
				'key'         => 'social_share',
				'name'        => 'Social Share',
				'field'       => null,
				'value'       => null,
				'description' => 'Social Media Sharing',
				'parent_id'   => null,
				'lft'         => 26,
				'rgt'         => 27,
				'depth'       => 1,
				'active'      => 1,
				'created_at'  => null,
				'updated_at'  => null,
			],
			[
				'key'         => 'optimization',
				'name'        => 'Optimization',
				'field'       => null,
				'value'       => null,
				'description' => 'Optimization Options',
				'parent_id'   => null,
				'lft'         => 28,
				'rgt'         => 29,
				'depth'       => 1,
				'active'      => 1,
				'created_at'  => null,
				'updated_at'  => null,
			],
			[
				'key'         => 'seo',
				'name'        => 'SEO',
				'field'       => null,
				'value'       => null,
				'description' => 'SEO Options',
				'parent_id'   => null,
				'lft'         => 30,
				'rgt'         => 31,
				'depth'       => 1,
				'active'      => 1,
				'created_at'  => null,
				'updated_at'  => null,
			],
			[
				'key'         => 'pagination',
				'name'        => 'Pagination',
				'field'       => null,
				'value'       => null,
				'description' => 'Pagination & Limit Options',
				'parent_id'   => 0,
				'lft'         => 32,
				'rgt'         => 33,
				'depth'       => 1,
				'active'      => 1,
				'created_at'  => null,
				'updated_at'  => null,
			],
			[
				'key'         => 'other',
				'name'        => 'Others',
				'field'       => null,
				'value'       => null,
				'description' => 'Other Options',
				'parent_id'   => null,
				'lft'         => 34,
				'rgt'         => 35,
				'depth'       => 1,
				'active'      => 1,
				'created_at'  => null,
				'updated_at'  => null,
			],
			[
				'key'         => 'cron',
				'name'        => 'Cron',
				'field'       => null,
				'value'       => null,
				'description' => 'Cron Job Options',
				'parent_id'   => null,
				'lft'         => 36,
				'rgt'         => 37,
				'depth'       => 1,
				'active'      => 1,
				'created_at'  => null,
				'updated_at'  => null,
			],
			[
				'key'         => 'footer',
				'name'        => 'Footer',
				'field'       => null,
				'value'       => null,
				'description' => 'Pages Footer',
				'parent_id'   => null,
				'lft'         => 38,
				'rgt'         => 39,
				'depth'       => 1,
				'active'      => 1,
				'created_at'  => null,
				'updated_at'  => null,
			],
			[
				'key'         => 'backup',
				'name'        => 'Backup',
				'field'       => null,
				'value'       => null,
				'description' => 'Backup Configuration',
				'parent_id'   => null,
				'lft'         => 40,
				'rgt'         => 41,
				'depth'       => 1,
				'active'      => 1,
				'created_at'  => null,
				'updated_at'  => null,
			],
		];
		
		$tableName = (new Setting())->getTable();
		foreach ($entries as $entry) {
			DB::table($tableName)->insert($entry);
		}
	}
}
