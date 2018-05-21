<?php
class Activate extends Controller {
	function __construct() {
		parent:: __construct();
		echo 'Im activate';
		$this->userActivate();
    }

    private function multiexplode ($delimiters, $string) {
	    $subst = str_replace($delimiters, $delimiters[0], $string);
	    $res = explode($delimiters[0], $subst);
	    return $res;
	}

    public function userActivate() {
    	$uri = getURI();

    	$exploded = $this->multiexplode(array("=","&"),$uri);
    	if (isset($exploded[1]) && isset($exploded[3])) {
    		$token = $exploded[1];
    		$email = $exploded[3];
    	}
    	if (!empty($token) && !empty($email)) {
    		$user = new UserModel();
    		$user->activate($email, $token);
    	} else {
    		echo '<br/> Link for activation not valid <br/>';
    	}
    }
}