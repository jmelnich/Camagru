<?php
class Add extends Controller {
	function __construct() {
		parent:: __construct();
        $this->view->render('add');
        if (isset($_POST['submit'])) {
        	$this->addPost();
        }
    }

    public function base64_to_jpeg($base64_string, $output_file) {
	    $ifp = fopen($output_file, 'wb');
	    $data = explode(',', $base64_string);
	    fwrite($ifp, base64_decode($data[1]));
	    fclose($ifp);
    	return $output_file;
	}

    public function addPost() {
    	$path = Config::get('img/avatars/test.jpg');
    	$base_str = $_POST['image'];
    	$this->base64_to_jpeg($base_str, $path);

    }
}
