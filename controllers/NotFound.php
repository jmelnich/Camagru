<?php
class NotFound extends Controller {
    function __construct() {
        parent:: __construct();
        $this->view->render('404');
    }
}