<?php
class User {
	public $errors = array();
	public function checkEmail($email) {
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return true;
		}
		$this->errors[] = 'Wrong email';
		return false;
	}

	public function checkEmailAvailability($email) {
		//TODO: check database if doesn't exist
		return true;
	}

	public function checkUsername($username) {
		if (preg_match('/^[a-z0-9 .\-]+$/i', $username)) {
        	return true;
		} else {
        	$this->errors[] = 'Name can consist of letters or numbers only';
		}
	}

	public function isLogged($state) {

	}

	public function checkPass($password) {
		if (strlen($password) >= 6) {
            return true;
        }
        $this->errors[] = 'Wrong password';
        return false;
	}

}
