<?php
class UserModel extends Model {
    public function __construct($user = null) {
        parent::__construct();
    }

	public function create(Array $fields = array()) {
		if (!$this->_db->insert('users', $fields)) {
			throw new Exception('There was a problem creating a new user');
		} else {
			echo "passed";
		}
	}

	public function activate($email, $token) {
		$user = $this->_db->get('users', array('email', '=', $email));
		if($this->_db->count()) {
			/* update user info by id. Usage:
		$user = DB::getInstance()->updateByEmail('users', 'julyettka@gmail.com', array(
		'activation' => '1'
	)); */
	//TODO: compare token!
		$this->_db->updateByEmail('users', $email, array(
			'activation' => '1'));
			return true;
		} else {
			echo "No user with this email";
			return false;
		}

		//get its token
		//check if it matches
	}

}
