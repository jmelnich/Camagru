
<?php

// CREATE DATABASE IF NOT EXISTS `camagru`
// USE `camagru`

$createUsers = "CREATE TABLE IF NOT EXISTS `users`
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
		`avatar` varchar(50) DEFAULT '/public/img/avatars/default.png',
		`notification` tinyint(1) NOT NULL DEFAULT '1'
	);";

//TODO: test the validity of the code below
$db = DB::getInstance();
$db->insert("users", array('email' => "julyettka@gmail.com",
							'username' => 'julyettka',
							'first_name' => 'julia',
							'last_name' => 'ml',
							'password' => '', //TODO:change it
							'salt' => '', //TODO:change it
							'token' => '1',
							'activation' => '1',
							'notification' => '0'
						));


$createUsersSessions = "CREATE TABLE IF NOT EXISTS `users_session`
	(
		`id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
		`user_id` int(11) NOT NULL UNIQUE,
		`hash` varchar(50) NOT NULL
	);";