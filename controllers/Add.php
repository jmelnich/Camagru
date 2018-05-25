<?php
class Add extends Controller {
	function __construct() {
		parent:: __construct();
        $this->view->render('add');
    }
}
