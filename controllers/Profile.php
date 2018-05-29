<?php
class Profile extends Controller {
	function __construct() {
		parent:: __construct();
		$this->view->render('profile');

		if (isset($_POST['submit-photo'])) {
			$this->uploadPhoto();
		}
		else if (isset($_POST['submit-details'])) {
			$this->editDetails();
		}
		else if (isset($_POST['submit-password'])) {
			$this->editPassword();
		}
	}

	public function uploadPhoto() {
		$validate = new ImageValidation();
		$validation = $validate->check($_FILES['picture'], array(
			'size' => array(
				'name' => 'size',
				'min' => 0,
				'max' => 10000
			),
			'type' => array(
				'name' => 'type',
				'type' => 'valid'
			)
		));
		if ($validate->passed()) {
			$name = $_FILES['picture']['name'];
			$path = Config::get('img/avatars');
			$target = $path . $name;
			//echo $target;
			$user = new UserModel();
			try {
				$user->update(array(
					'avatar' => $target
				));
			move_uploaded_file($_FILES['picture']['tmp_name'], $target);
			} catch(Exception $e) {
				die($e->getMessage());
			}
			header('Location: profile');
		} else {
			foreach ($validate->getErrors() as $error) {
				echo $error . '<br/> ';
			}
		}
	}


	public function editDetails() {
		$validate = new Validation();
		$validation = $validate->check($_POST, array(
			'username' => array(
				'name' => 'username',
				'required' => true,
				'min' => 1,
				'max' => 20
			),
			'first_name' => array(
				'name' => 'first name',
				'min' => 1,
				'max' => 20
			),
			'last_name' => array(
				'name' => 'last name',
				'min' => 1,
				'max' => 20
			)
		));
		if ($validate->passed()) {
			$user = new UserModel();
			try {
				$user->update(array(
					'username' => Input::get('username'),
					'first_name' => Input::get('first_name'),
					'last_name' => Input::get('last_name')
				));
			} catch(Exception $e) {
				die($e->getMessage());
			}
			Session::flash('update', 'Your details have been updated');
			header('Location: profile');
		} else {
			foreach ($validate->getErrors() as $error) {
				echo $error . '<br/> ';
			}
		}
	}

	 public function editPassword() {
		$validate = new Validation();
		$validation = $validate->check($_POST, array(
			'current_password' => array(
				'name' => 'current password',
				'required' => true
			),
			'new_password' => array(
				'name' => 'new password',
				'required' => true,
				'min' => 6,
				'max' => 20,
				'complex' => true
			),
			'new_password_confirm' => array(
				'name' => 'new password confirmation',
				'required' => true,
				'matches' => 'new_password'
			)
		));
		if ($validate->passed()) {
			$user = new UserModel();
			if (Hash::make(Input::get('current_password'), $user->data()->salt) !== $user->data()->password) {
				echo 'Your current password is wrong <br/>';
			} else {
				$salt = Hash::salt(32);
				try {
					$user->update(array(
						'password' => Hash::make(Input::get('new_password'), $salt),
						'salt' => $salt
					));
				} catch(Exception $e) {
					die($e->getMessage());
				}
				Session::flash('update', 'Your password has been updated');
				header('Location: profile');
			}
		} else {
			foreach ($validate->getErrors() as $error) {
				echo $error . '<br/> ';
			}
		}
	}
}