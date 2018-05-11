<?php

class Login extends Controller {
	function __construct() {
		parent:: __construct();
		echo 'Im Login';
		//$this->_other();
        $this->view->render('login');
	}
	// protected function _other() {
	// 	echo 'This is other function';
	// }
}