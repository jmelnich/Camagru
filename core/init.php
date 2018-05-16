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
/* Inlcuding function sanitize */
require_once(ROOT . '/functions/sanitize.php');

/* Maybe I need it */
//require_once(ROOT . '/config/cookie.php');

require_once(ROOT . '/core/Router.php');
require_once(ROOT . '/core/Controller.php');
require_once(ROOT . '/core/View.php');
//require_once(ROOT . '/core/Database.php'); !! DEL OLD DATABASE
require_once(ROOT . '/core/Model.php');
require_once(ROOT . '/models/UserModel.php');

$router = new Router();
$router->add('/', 'Home');
$router->add('/index', 'Home');
$router->add('/login', 'Login');
$router->add('/signup', 'Signup');
$router->add('/faq', 'Faq');

//echo '<pre>';
//print_r($router);
$router->run();

?>