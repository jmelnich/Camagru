<?php
class Login extends Controller {
	function __construct() {
		parent:: __construct();
		echo 'Im Login';
        $this->view->render('login');
        $this->model->loadModel('login');
	}
 //    function index () {
 //        require 'models/LoginModel.php';
 //        $model = new LoginModel();
 //    }
	function userAuth() {
        echo "aaaaa";
        $this->model->run();
    }
}