<?php
class Login extends Controller {
	function __construct() {
		parent:: __construct();
        $this->view->render('login');
        /*if submit button was pressed, then call to userLogin fnc */
        if (isset($_POST['submit'])) {
        	$this->userLogin();
        }
	}

	public function userLogin() {
        $validate = new Validation();
		$validation = $validate->check($_POST, array(
			'email' => array(
				'name' => 'email',
				'required' => true,
				'exist' => 'users',
				'valid' => true
			),
			'password' => array(
				'name' => 'password',
				'required' => true,
				'match' => 'email'
			)
		));

		if ($validate->passed()) {
			$user = new UserModel();
			$login = $user->login(Input::get('email'), Input::get('password'));
			//TODO: login user
			if ($login) {
				header('Location: index');
			} else {
				echo 'sorry, logging failed';
			}
		} else {
			foreach ($validate->getErrors() as $error) {
				echo $error . "<br/> ";
			}
		}

		// if ($valid->checkEmail($email) && $valid->checkPass($password)) {
		// 	//TODO`: check user exists in DB and its email matches password
		// 	$access = new UserModel();
		// 	$access->checkUserData($email, $password);
		// 	return true;
		// } else {
		// 	$errorMsg = $valid->errors[0];
		// 	$this->view->render('login', $errorMsg);

		// }
	}

}