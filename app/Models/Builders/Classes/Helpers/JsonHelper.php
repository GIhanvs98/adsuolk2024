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

namespace App\Models\Builders\Classes\Helpers;

/*
 * MySQL 5.7 | MariaDB 10.2.3 and later supports the JSON manipulation methods
 * (JSON_EXTRACT, JSON_UNQUOTE, ...)
 *
 * MySQL 5.7.9 and later supports the -> operator
 * - JSON_EXTRACT(c, "$.id") becomes c->"$.id"
 *
 * MySQL 5.7.13 and later supports the ->> operator
 * - JSON_UNQUOTE(JSON_EXTRACT(column, path)) becomes JSON_UNQUOTE(column->path)
 * - JSON_UNQUOTE(column->path) becomes column->>path
 */

class JsonHelper
{
	/**
	 * @param string $column
	 * @param string $path
	 * @return string
	 */
	public static function jsonExtract(string $column, string $path): string
	{
		// Convert non-JSON value column to the right JSON format
		$jsonObjColumn = 'JSON_OBJECT(\'' . $path . '\', ' . $column . ')';
		$isValidJson = 'JSON_VALID(' . $column . ')';
		$column = 'IF(' . $isValidJson . ', ' . $column . ', ' . $jsonObjColumn . ')';
		
		$path = (str_starts_with($path, '[')) ? '$' . $path : '$.' . $path;
		
		// Apply WHERE clause using MySQL JSON methods
		// $jsonColumn = $column . '->>"' . $path . '"'; // MySQL 5.7.13
		return 'JSON_UNQUOTE(JSON_EXTRACT(' . $column . ', \'' . $path . '\'))';
	}
}
