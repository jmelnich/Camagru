<?php
/* pull any data from config*/
$GLOBALS['config'] = array(
	'mysql' => array(
		'host' => 'localhost',
		'username' => 'root',
		'password' => 'castle7',
		'db' => 'camagru'
	),
	'remember' => array(
		'cookie_name' => 'hash',
		'cookie_expiry' => 604800
	),
	'session' => array(
		'session_name' => 'user',
		'token_name' => 'token',
		'email_name' => 'email'
	),
	'mail' => array(
		'admin_mail' => 'julyettka@gmail.com',
		'admin_name' => 'Camagru Team',
		'activate_msg' =>
	"Welcome aboard!
	Thanks for signing up.
	It's really great to have you around. After you confirm your email, you can login to your account and free to post in the application, explore other users posts and boost your inspiration with us.
	If there's anything we can do to make your experience better, just reply to this email and we'll get right back to you.",
		'recovery_msg' => "Camagru Change the password
		We received a request to change the password for the Camagru account.
		If you did not request a password change, simply ignore this email and no changes will be made to your account.",
	),
	'img' => array(
		'avatars' => 'public/img/avatars/',
		'posts' => 'public/img/posts/'
	)
);
