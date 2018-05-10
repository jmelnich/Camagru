<?php
class Router
{
	private $routes;
	//DEL
	// public function __construct ()
	// {
	// 	$routesPath = ROOT . '/config/routes.php';
	// 	$this->routes = include($routesPath); //присваеваем массив
	// }
	private $_uriCollection = array();
	/*
	@return string
	*/
	private function getURI () {
		$req_URI = $_SERVER['REQUEST_URI'];
		if (!empty($req_URI)) {
			$req_URI = trim($req_URI, '/');
			return $req_URI;
		}
		return 0;
	}
	/*
	Builds a collection of internal URI to look for
	*/
	public function add ($uri) {
		$uri = trim($uri, '/');
		$this->_uriCollection[] = $uri;
	}

	public function run () {
		$uri = $this->getURI();
		$uri = null;
		echo (isset($uri));
		$uri = isset($uri) ? $uri : '/';
		echo $uri;
		// print_r($this->_uriCollection);
		// echo "<br>";
		// foreach ($this->routes as $pattern => $path) {
		// 	// if (preg_match("~$pattern~", $uri)) {
		// 		$getCA = explode('/', $path); //1st el - controller; 2nd - action
		// 		//print_r($a);
		// 		$controllerName = array_shift($getCA) . "Controller"; //home
		// 		$controllerName = ucfirst($controllerName); //HomeController
		// 		$actionName = 'action'. ucfirst(array_shift($getCA)); //actionHome
		// 		//подключаем файл класса-контроллера
		// 		$controllerFile = ROOT . '/controllers/' . $controllerName . ".php";

		// 		if (file_exists($controllerFile)) {
		// 			include_once($controllerFile);
		// 		}
		// 		//создать обьект. вызвать action
		// 		$controllerObj = new $controllerName;
		// 		$res = $controllerObj->$actionName();
		// 		if ($res != null) {
		// 			break;
		// 		}
		// 	//}
		// }

		// foreach ($this->_uriCollection as $key => $value) {
		// 	echo $uri;
		// 	echo "<br>";
		// 	if (preg_match("#^$value$#", $uri)) {
		// 		echo $key;
		// 		echo "<br>";
		// 		echo $value;
		// 		echo "<br>";
		// 	}
		// }
	}
}