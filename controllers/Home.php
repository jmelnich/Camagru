<?php
class Home extends Controller {
	function __construct() {
		parent:: __construct();
        $this->view->render('index');
        if (!empty($_POST['p_id'])) {
			$this->delPost();
		}
    }

    public function delPost() {
    	$p_id = $_POST['p_id'];
    	$post = new PostModel();
    	$post->delete($p_id);
    }
}