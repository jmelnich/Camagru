<?php
ini_set(display_errors, 1);
error_reporting(E_ALL);

define('ROOT', dirname(__FILE__));
require_once(ROOT . '/core/Router.php');
require_once(ROOT . '/core/View.php');
require_once(ROOT . '/core/Model.php');
require_once(ROOT . '/core/Controller.php');
require_once(ROOT . '/controllers/Login.php');
require_once(ROOT . '/controllers/Home.php');
require_once(ROOT . '/controllers/Signup.php');
require_once(ROOT . '/controllers/NotFound.php');

$router = new Router();
$router->add('/', 'Home');
$router->add('/index', 'Home');
$router->add('/login', 'Login');
$router->add('/signup', 'Signup');

//echo '<pre>';
//print_r($router);
$router->run();

?>