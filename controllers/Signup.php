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
				'valid' => 'rule'
			),
			'username' => array(
				'name' => 'username',
				'required' => true,
				'min' => 2,
				'max' => 20
			),
			'password' => array(
				'name' => 'password',
				'required' => true,
				'min' => 6,
				'max' => 20,
				'complex' => 'rule'
			),
			'password_confirm' => array(
				'name' => 'password confirmation',
				'required' => true,
				'matches' => 'password'
			),
		));

		if($validate->passed()) {
			echo "Passsed";
		} else {
			foreach ($validate->getErrors() as $error) {
				echo $error . "<br/> ";
			}
		}

		//$this->model->run();
	}

}