<?php
class LikeModel extends Model {
	public function __construct() {
		parent::__construct();
	}

	public function like($pid, $uid) {
		if ($pid && $uid) {
			$this->_db->insert('likes', array(
				'pid' => $pid,
				'uid' => $uid
			));
		}
	}

	public function isLiked($pid, $uid) {
		$this->_db->get('likes', array(
			'pid', '=', $pid
		));
		$obj = $this->_db->results();
		$array = json_decode(json_encode($obj), True);
		foreach ($array as $row) {
			if ($row['uid'] == $uid) {
				return true;
			}
		}
		return false;
	}

	public function getQuantity($pid) {
		$this->_db->get('likes', array(
			'pid', '=', $pid
		));
		$quantity = $this->_db->count();
		return $quantity > 0 ? $quantity : '';
	}

	public function dislike($pid, $uid){
		$this->_db->get('likes', array(
			'pid', '=', $pid
		));
		$obj = $this->_db->results();
		$array = json_decode(json_encode($obj), True);
		foreach ($array as $row) {
			if ($row['uid'] == $uid) {
				$lid = $row['id'];
				break;
			}
		}
		if ($lid) {
			$this->_db->delete('likes', array(
				'id', '=', $lid
			));
		}
	}
}
