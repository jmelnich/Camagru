<?php
/* @returns string */
function getURI () {
	$req_URI = $_SERVER['REQUEST_URI'];
	if (!empty($req_URI)) {
		$req_URI = trim($req_URI, '/');
		$req_URI = ($req_URI == "" ? '/' : $req_URI);
		return $req_URI;
	}
	return 0;
}