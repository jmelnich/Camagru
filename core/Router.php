<?php
class Router {
	private $_uriCollection = array();
	private $_methodCollection = array();
	/*
	Builds a collection of internal URI and methods to look for
	*/
	public function add ($uri, $method = null) {
		$uri = trim($uri, '/');
		$uri = ($uri == "" ? '/' : $uri);
		$this->_uriCollection[] = $uri;
		if ($method != null) {
			$this->_methodCollection[] = $method;
		}
	}
	public function run () { //управления от front-контроллера (index.php)
		$uri = getURI();
		/* код поиска тоукена в url for activation */
		if (preg_match("/token/", $uri)) {
			$methodName = 'LinkManager';
			$controllerFile = ROOT . '/controllers/' . $methodName . '.php';
				if (file_exists($controllerFile)) {
					include_once($controllerFile);
				}
				$controllerObj = new $methodName();
				return true;
		}
		foreach ($this->_uriCollection as $key => $value) {
			if (preg_match("#^$value$#", $uri)) {
				$methodName = $this->_methodCollection[$key]; //определение name контроллера
				$controllerFile = ROOT . '/controllers/' . $methodName . '.php';
				if (file_exists($controllerFile)) {
					include_once($controllerFile);
				}
				$controllerObj = new $methodName();
				return true;
			}
		}
		$controllerFile = ROOT . '/controllers/NotFound.php';
			if (file_exists($controllerFile)) {
				include_once($controllerFile);
			}
			$methodName = 'NotFound';
			$controllerObj = new $methodName();
	}
}