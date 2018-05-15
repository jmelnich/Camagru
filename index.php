<?php
ini_set(display_errors, 1);
error_reporting(E_ALL);

define('ROOT', dirname(__FILE__));
//require_once(ROOT . '/config/database.php');
require_once(ROOT . '/core/Router.php');
require_once(ROOT . '/core/Controller.php');
require_once(ROOT . '/core/View.php');
require_once(ROOT . '/core/Database.php');
require_once(ROOT . '/core/Model.php');
require_once(ROOT . '/controllers/Valid.php');
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