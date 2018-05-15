<?php
class Signup extends Controller {
    function __construct() {
        parent:: __construct();
        echo 'Im signup ';
        $this->view->render('signup');
        if (isset($_POST['submit'])) {
        	$this->userSignup();
        }
    }

    public function userSignup() {
        $valid = new Validation();
		/*check credentials from html*/
		$email = $_POST['email'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$password_confirm = $_POST['password_confirm'];

		if ($valid->checkEmail($email) && $valid->checkEmailAvailability($email)
			&& $valid->checkUsername($username) && $valid->checkPass($password)
			&& $password == $password_confirm) {
			echo "correct";
			//TODO: call to addUser method from UserModel
			return true;
		} else {
			$errorMsg = $valid->errors[0];
			$this->view->render('signup', $errorMsg);

		}
		//$errors = false;


		//$this->model->run();
	}

}