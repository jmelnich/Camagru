<?php
class Router
{
	private $_uriCollection = array();
	private $_methodCollection = array();
	/*
	@return string
	*/
	private function getURI () {
		$req_URI = $_SERVER['REQUEST_URI'];
		if (!empty($req_URI)) {
			$req_URI = trim($req_URI, '/');
			$req_URI = ($req_URI == "" ? '/' : $req_URI);
			return $req_URI;
		}
		return 0;
	}
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
		$uri = $this->getURI();
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