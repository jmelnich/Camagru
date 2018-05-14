<?php
require_once(ROOT . '/controllers/User.php');

class Login extends Controller {
	function __construct() {
		parent:: __construct();
		echo 'Im Login';
        $this->view->render('login');
        //$this->model->loadModel('login');
        /*if submit button was pressed, then call to userLogin fnc */
        if (isset($_POST['submit'])) {
        	$this->userLogin();
        }
	}

	public function userLogin() {
        $user = new User();
		/*check credentials from html*/
		$email = $_POST['email'];
		$password = $_POST['password'];
		if ($user->checkEmail($email) && $user->checkPass($password)) {
			//TODO`: check user exists in DB and its email matches password
			echo "correct";
			return true;
		} else {
			$errorMsg = $user->errors[0];
			$this->view->render('login', $errorMsg);

		}
		//$errors = false;


		//$this->model->run();
	}

}