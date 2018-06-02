<?php
class Home extends Controller {
	function __construct() {
		parent:: __construct();
        $this->view->render('index');
        if (!empty($_POST['request'])) {
	        switch ($_POST['request']) {
	        	case 'delete':
	        		$this->delPost();
	        		break;
	        	case 'addcomment':
	        		$this->addComment();
	        		break;
                case 'addlike':
                    $this->addLike();
                    break;
                case 'dislike':
                    $this->disLike();
	        	default:
	        		# code...
	        		break;
	        }

        }
    }

    public function delPost() {
    	$pid = $_POST['pid'];
    	$post = new PostModel();
    	$post->delete($pid);
    }

    public function addComment() {
    	$pid = $_POST['pid'];
    	$uid = $_POST['uid'];
    	$comment = $_POST['comment'];
    	$p_comment = new CommentModel();
    	$p_comment->add($pid, $uid, $comment);
    }

    public function addLike() {
        echo "addLike post";
        $pid = $_POST['pid'];
        $uid = $_POST['uid'];
        $like = new LikeModel();
        $like->like($pid, $uid);
    }

        public function disLike() {
        $pid = $_POST['pid'];
        $uid = $_POST['uid'];
        $like = new LikeModel();
        $like->dislike($pid, $uid);
    }
}