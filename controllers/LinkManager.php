<?php
class LinkManager extends Controller {
	function __construct() {
		parent:: __construct();
		$this->manage();
    }
//change Router to links
    //change init
    //change controllers
    private function multiexplode ($delimiters, $string) {
	    $subst = str_replace($delimiters, $delimiters[0], $string);
	    $res = explode($delimiters[0], $subst);
	    return $res;
	}

    public function manage() {
    	$uri = getURI();
        $exploded = $this->multiexplode(array("=","&"), $uri);
        //print_r($exploded);
    	if (isset($exploded[1]) && isset($exploded[3])) {
            $task = $exploded[0];
            $token = $exploded[1];
            $email = $exploded[3];
            switch ($task) {
                case 'email/recovery/token':
                    $this->recover($token, $email);
                    break;
                case 'profile/active/token':
                     $this->activate($token, $email);
                    break;
                default:
                     # code...
                    break;
            }
    	}
    }

    private function activate($token, $email) {
    	if (!empty($token) && !empty($email)) {
    		$user = new UserModel();
    		if ($user->activate($email, $token)) {
    			Session::flash('activation','<div class="success-manager"> Your email has been confirmed! Now you can login </div>');
				header('Location: ../../login');
    		} else {
                echo '<br/> Link for activation not valid <br/>';
            }
    	} else {
    		echo '<div class="error-manager"><br/> Token or Email is empty... and link for activation not valid <br/><div>';
    	}
    }

    private function recover($token, $email) {
        $user = new UserModel();
        $check = $user->check($email, $token);
        if ($check) {
            $this->_sessionName = Config::get('session/email_name');
            Session::put($this->_sessionName, $email);
            header('Location: ../../password');
        }
    }
}