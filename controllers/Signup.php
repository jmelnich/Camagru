<?php
class Signup extends Controller {
    function __construct() {
        parent:: __construct();
        echo 'Im signup ';
        $this->view->render('signup');
    }

}