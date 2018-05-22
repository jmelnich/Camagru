<?php
class UserModel extends Model {
	private $_sessionName,
			$_data,
			$_isLoggedIn;

    public function __construct($user = null) {
    	echo $this->_data;
        parent::__construct();
        $this->_sessionName = Config::get('session/session_name');
        if (!$user) {
        	if (Session::exists($this->_sessionName)) {
        		$user = Session::get($this->_sessionName);
        		if($this->find($user)) {
        			$this->_isLoggedIn = true;
        		} else {
        			//TODO: processed logout
        			$this->_isLoggedIn = false;
        		}
        	}
        } else {
        	$this->find($user);
        }
    }

	/* FOR USERS ONLY */
	/* find user by id or email. Usage: $user = $this->find($email); */
	public function find($user = null) {
		if ($user) {
			$field = is_numeric($user) ? 'id' : 'email';
			$data = $this->_db->get('users', array($field, '=', $user));
			if ($data->count()) {
				return $this->_data = $this->_db->first();
			}
		}
	}

	public function create(Array $fields = array()) {
		if (!$this->_db->insert('users', $fields)) {
			throw new Exception('There was a problem creating a new user');
		} else {
			echo "passed";
		}
	}

	public function activate($email, $token) {
		$user = $this->find($email);
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
		$this->_data = $this->find($email);
		$user = $this->_data;
		if ($user) {
			if ($user->password === Hash::make($password, $user->salt)) {
				/* storing user id in session: $_SESSION[$session_name] = 3;*/
				Session::put($this->_sessionName, $user->id);
				return true;
			} else {
				echo '<br/> passwords dont match <br/>';
			}
		}
		return false;
	}

	public function data() {
		return $this->_data;
	}

	public function isLoggedIn() {
		return $this->_isLoggedIn;
	}

}
