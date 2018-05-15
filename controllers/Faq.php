<?php
class Faq extends Controller {
	function __construct() {
		parent:: __construct();
		echo 'Im faq';
        $this->view->render('faq');
        if (isset($_POST['submit'])) {
        	$this->sendEmail();
        }
    }

    public function sendEmail() {
    	$from_email = $_POST['email'];
    	$from_name = $_POST['name'];
    	$mail_msg = $_POST['text'];
    	require 'config/database.php';
    	$mail_to = $ADM_EMAIL;
    	$mail_subject = "message from faq page";
		// Set preferences for Subject field
    	$encoding = "utf-8";
		$subject_preferences = array(
			"input-charset" => $encoding,
			"output-charset" => $encoding,
			"line-length" => 76,
			"line-break-chars" => "\r\n"
		);
		// Set mail header
		$header = "Content-type: text/html; charset=".$encoding." \r\n";
		$header .= "From: ".$from_name." <".$from_email."> \r\n";
		$header .= "MIME-Version: 1.0 \r\n";
		$header .= "Content-Transfer-Encoding: 8bit \r\n";
		$header .= "Date: ".date("r (T)")." \r\n";
		$header .= iconv_mime_encode("Subject", $mail_subject, $subject_preferences);
    // Check validity
    	$user = new User();
    	if ($user->checkEmail($from_email) && ($user->isFilled($mail_msg))){
			// The magic is going here: Send mail
			mail($mail_to, $mail_subject, $mail_msg, $header);
		// Generate HTML for user so let him know his message is sent
    	echo "<br/>
    			<p class='msg'>Thanks for submiting the form. <br/>
    			We will contact you to your " . $from_email . " email within 42 years :)</p>
    			<br/>";
    	} else {
    		$errorMsg = $user->errors[0];
			$this->view->render('faq', $errorMsg);
    	}

    }
}