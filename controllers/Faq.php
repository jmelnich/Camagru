<?php
class Faq extends Controller {
	function __construct() {
		parent:: __construct();
        $this->view->render('faq');
        if (isset($_POST['submit'])) {
        	$this->sendEmail();
        }
    }

    public function sendEmail() {
        $validate = new Validation();
        $validation = $validate->check($_POST, array(
            'text' => array (
                'name' => 'message',
                'required' => true,
                'min' => 4,
                'max' => 10000,
            ),
            'name' => array (
                'name' => 'name',
                'required' => true,
                'min' => 2,
                'max' => 20
            ),
            'email' => array(
                'name' => 'email',
                'max' => 20,
                'required' => true,
                'valid' => true
            )
        ));

        if($validate->passed()) {
          $email = new Email();
            $email->contact(
                Input::get('email'),
                Input::get('name'),
                Input::get('text')
            );
            echo "success";
        } else {
            foreach ($validate->getErrors() as $error) {
               echo $error . "<br/> ";
            }
        }


  //   	$from_email = $_POST['email'];
  //   	$from_name = $_POST['name'];
  //   	$mail_msg = $_POST['text'];
  //   	require 'config/database.php';
  //   	$mail_to = $ADM_EMAIL;
  //   	$mail_subject = "message from faq page";



  //   // Check validity
  //   	$user = new User();
  //   	if ($user->checkEmail($from_email) && ($user->isFilled($mail_msg))){
		// 	// The magic is going here: Send mail
		// 	mail($mail_to, $mail_subject, $mail_msg, $header);
		// // Generate HTML for user so let him know his message is sent
  //   	echo "<br/>
  //   			<p class='msg'>Thanks for submiting the form. <br/>
  //   			We will contact you to your " . $from_email . " email within 42 years :)</p>
  //   			<br/>";
  //   	} else {
  //   		$errorMsg = $user->errors[0];
		// 	$this->view->render('faq', $errorMsg);
  //   	}

    }
}