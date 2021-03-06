<?php
class UserModel extends Model {
	private $_sessionName,
			$_data,
			$_isLoggedIn,
			$_cookieName;

    public function __construct($user = null) {
    	//echo $this->_data;
        parent::__construct();
        $this->_sessionName = Config::get('session/session_name');
        $this->_cookieName = Config::get('remember/cookie_name');
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

	/* check that token === token */
	public function check($email, $token) {
		$user = $this->find($email);
		if ($user) {
			if ($user->token === $token) {
				return true;
			}
		}
		return false;
	}

	public function create(Array $fields = array()) {
		if (!$this->_db->insert('users', $fields)) {
			throw new Exception('There was a problem creating a new user');
		} else {
			echo "passed";
		}
	}

	public function activate($email, $token) {
		$check = $this->check($email, $token);
		if ($check) {
			$this->_db->updateByEmail('users', $email, array(
				'activation' => '1'));
			return true;
		} else {
			echo '<br/> wrong token <br/>';
			return false;
		}
	}

	public function login($email = null, $password = null, $remember = false) {
		if (!$email && !$password && $this->exists()) {
			Session::put($this->_sessionName, $this->data()->id);
		} else {
			$user = $this->find($email);
			if ($user) {
			$active = $user->activation;
				if ($active) {
					if ($user->password === Hash::make($password, $user->salt)) {
						/* storing user id in session: $_SESSION[$session_name] = 3;*/
						Session::put($this->_sessionName, $user->id);
						if ($remember) {
							/* storing in cookies */
							$hashCheck = $this->_db->get('users_session', array('user_id', '=', $user->id));
							if (!$hashCheck->count()) {
								$hash = Hash::unique();
								$this->_db->insert('users_session', array(
									'user_id' => $user->id,
									'hash' => $hash
								));
							} else {
								$hash = $hashCheck->first()->hash;
							}
							Cookie::put($this->_cookieName, $hash, Config::get('remember/cookie_expiry'));
						}
						return true;
					} else {
						echo '<div class="error-manager"> incorrect password <br/></div>';
					}
				} else {
					echo '<div class="error-manager"> please activate your account via email <br/></div>';
				}
			}
		}
		return false;
	}

	public function logout() {
		$this->_db->delete('users_session', array('user_id', '=', $this->data()->id));
		Session::delete($this->_sessionName);
		Cookie::delete($this->_cookieName);
	}

	public function data() {
		return $this->_data;
	}

	public function isLoggedIn() {
		return $this->_isLoggedIn;
	}

	/*  */
	public function exists() {
		return (!empty($this->_data)) ? true : false;
	}

	public function update(Array $fields = array(), $id = null) {
		if(!$id) {
			$id = $this->data()->id; //$user = new UserModel(Input::get('email'));
		}
		if (!$this->_db->updateById('users', $id, $fields)) {
			throw new Exception('There was a problem updating your info');
		}
	}
}
