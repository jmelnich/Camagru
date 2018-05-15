<?php
class Login extends Controller {
	function __construct() {
		parent:: __construct();
		echo 'Im Login';
        $this->view->render('login');
        /*if submit button was pressed, then call to userLogin fnc */
        if (isset($_POST['submit'])) {
        	$this->userLogin();
        }
	}

	public function userLogin() {
        $valid = new Validation();
		/*check credentials from html*/
		$email = $_POST['email'];
		$password = $_POST['password'];
		if ($valid->checkEmail($email) && $valid->checkPass($password)) {
			//TODO`: check user exists in DB and its email matches password
			$access = new UserModel();
			$access->checkUserData($email, $password);
			return true;
		} else {
			$errorMsg = $valid->errors[0];
			$this->view->render('login', $errorMsg);

		}
	}

}