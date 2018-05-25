<?php
ini_set(display_errors, 1);
error_reporting(E_ALL);
session_start(); //allows people to login

/* Inlcuding data for database */
require_once(ROOT . '/config/database.php');

/* Inlcuding the files from classes dir */
spl_autoload_register(function($class) {
	require_once(ROOT . '/classes/' . $class . '.php');
});
/* Inlcuding functions */
require_once(ROOT . '/functions/sanitize.php');
require_once(ROOT . '/functions/getURI.php');

/* Inlcuding core files */
require_once(ROOT . '/core/Router.php');
require_once(ROOT . '/core/Controller.php'); //it also includes all other controllers
require_once(ROOT . '/core/View.php');
require_once(ROOT . '/core/Model.php');
require_once(ROOT . '/models/UserModel.php');

/*add page to router and render it in its controller*/
$router = new Router();
$router->add('/', 'Home');
$router->add('/index', 'Home');
$router->add('/login', 'Login');
$router->add('/signup', 'Signup');
$router->add('/profile', 'Profile');
$router->add('/token=', 'LinkManager'); //for activating account//recovering pass
$router->add('/logout', 'Logout');
$router->add('/faq', 'Faq');
$router->add('/recovery', 'Recovery');
$router->add('/password', 'Password');

$router->run();

if (Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('session/session_name'))) {
	$hash = Cookie::get(Config::get('remember/cookie_name'));
	$hashCheck = DB::getInstance()->get('users_session', array('hash', '=', $hash));

	if ($hashCheck->count()) {
		echo $hashCheck->first()->user_id;
		$user = new UserModel($hashCheck->first()->user_id);
		$user->login();
	}
}

?>