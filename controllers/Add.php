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
			if ($_POST['caption']) {
				$caption = strip_tags($_POST['caption']);
				if (strpos($caption, '#')) {
					$caption = convertHash($caption);
					$post->add($uid, $output_file, $caption);
					//TODO:
					//get all hashtag words in array
					//foreach hash word, save it to DB
					// hashword, pid
					//create table hastags
					//get hash url
					//grab all data where hashword === get
					//display it
				}
			} else {
				$post->add($uid, $output_file);
			}
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
}
