<?php
class Setup extends Controller {
	function __construct() {
		echo 'hi, admin';
		$this->create();
	}

	public function create() {
		try {
			$db = DB::getInstance();
			$sql = "CREATE TABLE IF NOT EXISTS `users`
				(
					`id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
					`email` varchar(60) NOT NULL UNIQUE,
					`username` varchar(30) NOT NULL,
					`first_name` varchar(30),
					`last_name` varchar(30),
					`password` varchar(160) NOT NULL,
					`salt` varchar(64) NOT NULL,
					`token` varchar(255),
					`activation` tinyint(1) NOT NULL DEFAULT '0',
					`avatar` varchar(250) DEFAULT 'public/img/avatars/default.png',
					`notification` tinyint(1) NOT NULL DEFAULT '1'
				);";

			$sql .= "CREATE TABLE IF NOT EXISTS `users_session`
				(
					`id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
					`user_id` int(11) NOT NULL UNIQUE,
					`hash` varchar(50) NOT NULL
				);";

			$sql .= "CREATE TABLE IF NOT EXISTS `posts`
				(
					`id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
					`uid` int(11) NOT NULL,
					`isrc` varchar(50) NOT NULL,
					`caption` varchar (255),
					`time` DATETIME DEFAULT NOW()
				);";

			$sql .= "CREATE TABLE IF NOT EXISTS `comments`
				(
					`id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
					`pid` int(11) NOT NULL,
					`uid` int(11) NOT NULL,
					`text` varchar(255) NOT NULL,
					`time` DATETIME DEFAULT NOW()
				);";

			$sql .= "CREATE TABLE IF NOT EXISTS `likes`
			(
				`id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
				`pid` int(11) NOT NULL,
				`uid` int(11) NOT NULL
			);";

			$sql .= "CREATE TABLE IF NOT EXISTS `test`
			(
				`id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
				`pid` int(11) NOT NULL,
				`uid` int(11) NOT NULL
			);";

			$db->query($sql);
			header('Location: index');
		}
		catch (Exception $e) {
			echo 'error in Setup up controller <br/> ';
			die($e->getMessage());
		}
	}
}


