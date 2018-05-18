<?php
class UserModel extends Model {
    public function __construct($user = null) {
        parent::__construct();
    }

	public function create(Array $fields = array()) {
		if (!$this->_db->insert('users', $fields)) {
			throw new Exception('There was a problem creating a new user');
		} else {
			echo "if passed";
		}
	}

}
