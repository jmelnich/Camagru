<?php
class Hash {
	public static function make($password, $solt = '') {
		return hash('whirlpool', $password . $solt);
	}

	/* improves security for password */
	public static function salt($length) {
		return bin2hex(random_bytes($length));
	}

	public static function unique() {
		return self::make(uniqid());
	}
}