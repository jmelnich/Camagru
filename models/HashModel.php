<?php
class HashModel extends Model {
	public function __construct() {
		parent::__construct();
	}

	public function add($hashword, $pid) {
		$this->_db->insert('hashtags', array(
			'hashword' => $hashword,
			'pid' => $pid
		));
	}

}
