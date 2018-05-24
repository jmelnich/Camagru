<?php
class Recovery extends Controller {
	function __construct() {
		parent:: __construct();
		$this->view->render('recovery');
		if (isset($_POST['submit'])) {
        	$this->sendRecover();
        }
	}

	public function sendRecover() {
		$validate = new Validation();
		$validation = $validate->check($_POST, array(
			'email' => array(
				'name' => 'email',
				'required' => true,
				'valid' => true,
				'exists' => 'users'
			)
		));
		if ($validate->passed()) {
			$user = new UserModel(Input::get('email'));
			try {
				$user->update(array(
					'token' => Input::get('token')
				));
			} catch(Exception $e) {
				die($e->getMessage());
			}
			$mail = new Email();
			$link =  "<a href='" . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/email/recovery/token=" . Input::get('token') . "&email=" . Input::get('email') . "'>this link</a>.\n";
			$mail->recover(Input::get('email'), $link);
			Session::flash('recovery','The link for password recovery has been sent to your email.');
			header('Location: index');
		 } else {
		 	foreach ($validate->getErrors() as $error) {
		 		echo $error . '<br/>';
		 	}
		 }
	}
}