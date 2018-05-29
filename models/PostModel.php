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

	public function get() {
		$sql = "SELECT * FROM posts";
		$this->_db->query($sql);
		$obj = $this->_db->results();
		$array = json_decode(json_encode($obj), True);
		return $array;
	}
}