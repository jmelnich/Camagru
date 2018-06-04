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
	}

	public function get($starting_limit = null, $posts_per_page = null) {
		if ($posts_per_page) {
			$sql = "SELECT * FROM posts ORDER BY time DESC LIMIT " . $starting_limit . ',' . $posts_per_page;
		} else {
			$sql = "SELECT * FROM posts ORDER BY time DESC";
		}
		$this->_db->query($sql);
		$obj = $this->_db->results();
		$array = json_decode(json_encode($obj), True);
		return $array;
	}

	public function count() {
		$sql = "SELECT * FROM posts";
		$this->_db->query($sql);
		return $this->_db->count();
	}

	public function delete($id){
		$this->_db->delete('posts', array(
			'id', '=', $id
		));
	}

	public function getRecent($uid, $quantity) {
		$this->_db->get('posts', array(
			'uid', '=', $uid
		));
		$obj = $this->_db->results();
		$array = json_decode(json_encode($obj), True);
		return $array;
	}

	public function findOwner($pid) {
		$this->_db->get('posts', array(
			'id', '=', $pid
		));
		$obj = $this->_db->first();
		$post = json_decode(json_encode($obj), True);
		return $post['uid'];
	}
}
