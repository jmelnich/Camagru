<?php
define('ROOT', dirname(__FILE__));
require_once(ROOT . '/core/init.php');
//echo Config::get('mysql/host');
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


// if(!$user->count()) {
// 	echo "No user";
// } else {
// 	echo $user->first()->username;
// }