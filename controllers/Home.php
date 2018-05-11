<?php

class Home extends Controller {
	function __construct() {
		parent:: __construct();
		echo 'Im home';

        $this->view->render('index');
	}
}