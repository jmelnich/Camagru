<?php
class UserModel extends Model {
	private $_sessionName;
    public function __construct($user = null) {
        parent::__construct();
        $this->sessionName = Config::get('session/session_name');
    }

	public function create(Array $fields = array()) {
		if (!$this->_db->insert('users', $fields)) {
			throw new Exception('There was a problem creating a new user');
		} else {
			echo "passed";
		}
	}

	public function activate($email, $token) {
		$user = $this->_db->find($email);
		if ($user) {
			$db_token = $user->token;
			if ($token === $db_token) {
				$this->_db->updateByEmail('users', $email, array(
					'activation' => '1'));
				return true;
			} else {
				echo '<br/> wrong token <br/>';
				return false;
			}
		} else {
			echo '<br/> No user with this email <br/>';
			return false;
		}
	}

	public function login($email, $password) {
		$user = $this->_db->find($email);
		if ($user) {
			if ($user->password === Hash::make($password, $user->salt)) {
				echo '<br/> passwords match <br/>';
				/* storing user id in session: $_SESSION[$session_name] = 3;*/

				Session::put($this->sessionName, $user->id);
				echo Session::get(Config::get('session/session_name'));
				return true;
			} else {
				echo '<br/> passwords dont match <br/>';
			}
		}
		echo ($user->username);
		return false;
	}

}
