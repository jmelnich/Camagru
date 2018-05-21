<?php
define('ROOT', dirname(__FILE__));
require_once(ROOT . '/core/init.php');
//DB::getInstance()->action('SELECT *', 'users', array('username', '=', 'julia'));
// $users = DB::getInstance()->query('SELECT username FROM users');
// $if($users->count()) {
// 	foreach ($users as $user) {
// 		echo $user->username;
// 	}
// }

//$user = DB::getInstance()->get('users', array('username', '=', 'julia'));
//$user = DB::getInstance()->query("SELECT * FROM users");
// $user = DB::getInstance()->update('users', 2, array(
// 	'username' => "ivan",
// ));

// $user = DB::getInstance()->insert("users", array('email' => "julyettka@gmail.com",
// 							'username' => 'julyettka',
// 							'first_name' => 'julia',
// 							'last_name' => 'm',
// 							'password' => '123456q', //TODO:change it
// 							'salt' => '123456q', //TODO:change it
// 							'token' => '1'
// 						));

// if(!$user->count()) {
// 	echo "No user";
// } else {
// 	echo $user->first()->username;
// }

