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
        print_r($exploded);
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
    			Session::flash('activation','Your email has been confirmed! Now you can login');
				header('Location: ../../login');
    		} else {
                echo '<br/> Link for activation not valid <br/>';
            }
    	} else {
    		echo '<br/> Token or Email is empty... and link for activation not valid <br/>';
    	}
    }

    private function recover($token, $email) {
        echo $token;
        echo $email;
        $user = new UserModel();
        $check = $user->check($email, $token);
        if ($check) {
            //TODO: generate form for new password
            //send user to that page
        }
    }
}