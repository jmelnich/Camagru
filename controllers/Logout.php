<?php
class Logout extends Controller {
	function __construct() {
		parent:: __construct();
		$this->userLogout();
    }

    public function userLogout() {
    	$user = new UserModel();
    	$user->logout();
    	header('Location: index');
    }
}