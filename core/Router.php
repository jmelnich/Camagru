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

	public function run () {
		$uri = $this->getURI();
		foreach ($this->_uriCollection as $key => $value) {
			if (preg_match("#^$value$#", $uri)) {
				$useMethod = $this->_methodCollection[$key];
				new $useMethod();
				return true;
			}
		}
		$useMethod = 'NotFound';
		new $useMethod();
	}
}