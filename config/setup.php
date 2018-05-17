
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
		`password` varchar(128) NOT NULL,
		`activation` tinyint(1) NOT NULL DEFAULT '0',
		`avatar` varchar(50) DEFAULT '/public/img/avatars/default.png',
		`notification` tinyint(1) NOT NULL DEFAULT '1'
	);";
