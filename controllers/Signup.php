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
        $user = new User();
		/*check credentials from html*/
		$email = $_POST['email'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$password_confirm = $_POST['password_confirm'];

		if ($user->checkEmail($email) && $user->checkEmailAvailability($email) && $user->checkUsername($username) && $user->checkPass($password) && $password == $password_confirm) {
			echo "correct";
			return true;
		} else {
			$errorMsg = $user->errors[0];
			$this->view->render('signup', $errorMsg);

		}
		//$errors = false;


		//$this->model->run();
	}

}