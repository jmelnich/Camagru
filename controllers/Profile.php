<?php
class Profile extends Controller {
    function __construct() {
        parent:: __construct();
        $this->view->render('profile');
    }
}