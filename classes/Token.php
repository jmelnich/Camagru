<?php
class Token {
	public static function generate() {
		return Session::put(Config::get('session/token_name'), md5(uniqid()));
	}
	/* to check if token exists on not. Get token from our session and check
	whether its the same as from the form. Delete session*/
	public static function check($token) {
		echo 'token === (shows old token for some reason)' . $token . '<br/>';
		$tokenName = Config::get('session/token_name');
		echo 'tokenName === ' . $tokenName . '<br/>';
		$a = Session::exists($tokenName);
		echo 'session exists === ' . $a . '<br/>';
		$b = Session::get($tokenName);
		echo 'session name === ' . $b . '<br/>';
		//echo Input::get('token');
		if(Session::exists($tokenName) && $token === Session::get($tokenName)) {
			Session::delete($tokenName);
			return true;
		}
		return false;
	}
}