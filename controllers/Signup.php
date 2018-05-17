<?php
class Signup extends Controller {
    function __construct() {
        parent:: __construct();
        echo 'Im signup ';
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
				'max' => 20,
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

		if($validate->passed()) {
			Session::flash('success','Your register successfully!');
			header('Location: index');
			//echo "Passsing to UserModel";
			//$user = new UserModel();
			//$user->signUp();
		} else {
			foreach ($validate->getErrors() as $error) {
				echo $error . "<br/> ";
			}
		}

		//$this->model->run();
	}

}