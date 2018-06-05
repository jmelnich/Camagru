<?php
class Password extends Controller {
	private $_sessionName;

	function __construct() {
		parent:: __construct();
		$this->view->render('password');
		if (isset($_POST['submit'])) {
        	$this->savePassword();
        }
	}

	public function savePassword() {
		$validate = new Validation();
		$validation = $validate->check($_POST, array(
			'password' => array(
				'name' => 'password',
				'required' => true,
				'min' => 6,
				'max' => 20,
				'complex' => true
			),
			'password_confirm' => array(
				'name' => 'password confirmation',
				'required' => true,
				'matches' => 'password'
			)
		));

		if ($validate->passed()) {
			$this->_sessionName = Config::get('session/email_name');
			if (Session::exists($this->_sessionName)) {
				$email = Session::get($this->_sessionName);
				$user = new UserModel($email);
			 	$salt = Hash::salt(32);
			 	try {
					$user->update(array(
						'password' => Hash::make(Input::get('password'), $salt),
						'salt' => $salt,
						'token' => Input::get('token')
					));
					Session::delete($this->_sessionName);
			 	} catch (Exception $e) {
			 		die($e->getMessage());
			 	}
			} else {
				echo "no session found";
			}
			Session::flash('change-password','<div class="success-manager" Your password has been changed. Now you can login.</div>');
				header('Location: login');
		} else {
			?> <div class="error-manager">
			<?php
			foreach ($validate->getErrors() as $error) {
				echo $error . "<br/> ";
			}
			?></div>
			<?php
		}
	}
}