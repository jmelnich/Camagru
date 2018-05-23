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
				'valid' => true
			),
			'password' => array(
				'name' => 'password',
				'required' => true
			)
		));

		if ($validate->passed()) {
			$user = new UserModel();
			$remember = (Input::get('remember') === 'on') ? true : false;
			$login = $user->login(Input::get('email'), Input::get('password'), $remember);
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
	}

}