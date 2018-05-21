<?php
class Profile extends Controller {
    function __construct() {
        parent:: __construct();
        echo 'Im Profile';
        $this->view->render('profile');
    }
}