<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * debuging function
 */
if (!function_exists('__debug')) {
	function __debug()
	{
		echo '<pre>';
		print_r(func_get_args());
		echo '</pre>';
		die();
	}
}
