<?php
class Add extends Controller {
	function __construct() {
		parent:: __construct();
        $this->view->render('add');
        if (!empty($_POST['src'])) {
        	$this->addPost();
        }
    }

    public function base64_to_png($base64_string, $output_file) {
    	$str = str_replace("data:image/png;base64,", "", $base64_string);
  		$str = str_replace(' ', '+', $str);
  		$decodedImg = base64_decode($str);
  		file_put_contents($output_file, $decodedImg);
    	return $output_file;
	}

    public function addPost() {
    	$path = Config::get('img/posts/');
    	$base_str = $_POST['src'];
    	$uid = time();
    	$output_file = $path . 'img_' . $uid . '.png';
    	$this->base64_to_png($base_str, $output_file);
    }
}
