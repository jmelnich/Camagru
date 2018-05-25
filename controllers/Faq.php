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

    }
}