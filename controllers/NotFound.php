<?php
class NotFound extends Controller {
    function __construct() {
        parent:: __construct();
        echo 'Im 404';
        $this->view->render('404');
    }
}