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
		$uid = $_POST['uid'];
		$unique = time();
		$output_file = $path . 'img_' . $unique . '.png';
		$this->base64_to_png($base_str, $output_file);
		$post = new PostModel();
		try {
			if (isset($_POST['caption'])) {
				$caption = strip_tags($_POST['caption']);
				if (strpos($caption, '#') !== false) {
					echo 'inside hash';
					$caption = convertHash($caption);
					$post->add($uid, $output_file, $caption);
				} else {
					$post->add($uid, $output_file, $caption);
				}
			} else {
				$post->add($uid, $output_file);
			}
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
}
