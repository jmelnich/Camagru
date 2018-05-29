<?php
class PostModel extends Model {
	public function __construct() {
		parent::__construct();
	}

	public function add($uid, $file) {
		if ($uid && $file) {
			$this->_db->insert('posts', array(
				'uid' => $uid,
				'isrc' => $file
			));
		}
		echo 'success';
	}
}