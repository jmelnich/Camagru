<?php
/* a class-function that return us a path to our database. Usage:
Config::get('mysql/host') */
class Config {
	public static function get($path = null) {
		if ($path) {
			$config = $GLOBALS['config'];
			$path = explode('/', $path);
			foreach($path as $bit) {
				if(isset($config[$bit])) {
					$config=$config[$bit];
				}
			}
			return $config;
		}
		return false;
	}
}