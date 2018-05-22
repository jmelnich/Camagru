<?php
class Signup extends Controller {
    function __construct() {
        parent:: __construct();
        $this->view->render('signup');
        if (isset($_POST['submit'])) {
        	/* TODO:
        	fix CSRF Protection: check our token (video 12/23)*/
        	// if (Token::check(Input::get('token'))) {
        		$this->userSignup();
        	//}
        }
    }

    public function userSignup() {
        $validate = new Validation();
        if(Input::exist()) {
        	echo "submitted";
        }
		/*check credentials */
		$validation = $validate->check($_POST, array(
			'email' => array(
				'name' => 'email',
				'required' => true,
				'min' => 2,
				'max' => 30,
				'unique' => 'users',
				'valid' => true
			),
			'username' => array(
				'name' => 'username',
				'required' => true,
				'min' => 2,
				'max' => 20
			),
			'first_name' => array(
				'name' => 'first name',
				'min' => 2,
				'max' => 20
			),
			'last_name' => array(
				'name' => 'last name',
				'min' => 2,
				'max' => 20
			),
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
			),
		));

		if ($validate->passed()) {
			$user = new UserModel();
			$salt = Hash::salt(32);
			try {
				echo "Passsing to UserModel";
				$user->create(array(
							'email' => Input::get('email'),
							'username' => Input::get('username'),
							'first_name' => Input::get('first_name'),
							'last_name' => Input::get('last_name'),
							'password' => Hash::make(Input::get('password'), $salt),
							'salt' => $salt,
							'token' => Input::get('token')
						));
				$mail = new Email();
				$link =  "<a href='" . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/profile/active/token=" . Input::get('token') . "&email=" . Input::get('email') . "'>this link</a>.\n";
				$mail->activate(Input::get('email'), $link);
				Session::flash('success','Your register successfully! Check your email for activation');
				header('Location: index');
			} catch (Exception $e) {
				die($e->getMessage()); //TODO: make it user-friendly. Redirect user to a page where we say that 'oops we cannot register you';
			}
		} else {
			foreach ($validate->getErrors() as $error) {
				echo $error . "<br/> ";
			}
		}
	}

}