<?php
class CommentModel extends Model {
	public function __construct() {
		parent::__construct();
	}

	public function get($pid) {
		//$sql = "SELECT * FROM comments ORDER BY time DESC";
		$this->_db->get('comments', array(
			'pid', '=', $pid
		));
		$obj = $this->_db->results();
		$array = json_decode(json_encode($obj), True);
		return $array;
	}

	public function add($pid, $uid, $comment) {
		if ($uid && $pid && $comment) {
			$this->_db->insert('comments', array(
				'pid' => $pid,
				'uid' => $uid,
				'text' => $comment
			));
		}
		echo 'success';
	}


	// public function delete($id){
	// 	$this->_db->delete('posts', array(
	// 		'id', '=', $id
	// 	));
	// }
}