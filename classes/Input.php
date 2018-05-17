<?php
class Input {
	public static function exist($type='post') {
		switch($type) {
			case 'post':
				return (!empty($_POST)) ? true : false;
			case 'get':
				return (!empty($_GET)) ? true : false;
			default:
				return false;
		}
	}

	/* grab data from form by name
	Input::get('username'); */
	public static function get($item) {
		if(isset($_POST[$item])) {
			return $_POST[$item];
		} else if(isset($_GET[$item])) {
			return $_GET[$item];
		}
		return '';
	}
}