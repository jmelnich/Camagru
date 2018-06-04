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

    private function sendNotification($pid, $activity) {
        $owner_post = new PostModel();
        $owner_id = $owner_post->findOwner($pid);
        $owner = new UserModel($owner_id);
        $is_notify = $owner->data()->notification;
        if ($is_notify == 1) {
            $email = $owner->data()->email;
            $mail = new Email();
            if ($activity === 'comment') {
                $mail->notifyAboutComment($email);
            } else if ($activity === 'like') {
                $mail->notifyAboutLike($email);
            }
        }
    }

    public function addComment() {
        $pid = $_POST['pid'];
        $uid = $_POST['uid'];
        $comment = $_POST['comment'];
        $p_comment = new CommentModel();
        $p_comment->add($pid, $uid, $comment);
        $activity = 'comment';
        $this->sendNotification($pid, $activity);
    }

    public function addLike() {
        echo "addLike post";
        $pid = $_POST['pid'];
        $uid = $_POST['uid'];
        $like = new LikeModel();
        $like->like($pid, $uid);
        $activity = 'like';
        $this->sendNotification($pid, $activity);
    }

    public function disLike() {
    $pid = $_POST['pid'];
    $uid = $_POST['uid'];
    $like = new LikeModel();
    $like->dislike($pid, $uid);
}
}