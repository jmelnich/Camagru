<?php
if (Session::exists('success')) {
	echo Session::flash('success');
}
if (Session::exists('recovery')) {
	echo Session::flash('recovery');
}

$user = new UserModel();
if ($user->isLoggedIn()) {
	$uid = $user->data()->id;
    $username = $user->data()->username;
    $first_name = ucfirst($user->data()->first_name);
    $last_name = ucfirst($user->data()->last_name);
    $avatar =$user->data()->avatar;
} else {
	$uid = '';
}
?>

<div class="container" id="feed">

<?php
$posts_per_page = 5;
$posts = new PostModel();
/* get all posts to know how many pages for pagination I need */
$number_f_posts = $posts->count();
$number_f_pages = ceil($number_f_posts/$posts_per_page);
/* get info about my current page */
if(!isset($_GET['page'])) {
	$page = 1;
} else {
	$page = $_GET['page'];
}

/* calculate my starting limit for sql request */
$starting_limit = ($page - 1) * $posts_per_page;

$paginated_posts = $posts->get($starting_limit, $posts_per_page);


foreach ($paginated_posts as $post) {
	$user_post = new UserModel($post['uid']);
	$username_post = $user_post->data()->username;
	$username_avatar = $user_post->data()->avatar;

 	?>
	<div id=<?php echo escape($post['id']);?> class="post">
		<div class="post-header">
			<img class="post-header-avatar" src="../<?php echo escape($username_avatar);?>" alt="">
			<span class="post-header-username"><?php echo escape($username_post);?></span>
			<div class="post-header-timestamp"><?php echo escape($post['time']);?></div>
		</div>
		<img class="post-img" src="../<?php echo escape($post['isrc']);?>" alt="">
		<?php if ($uid) { ?>
		<div class="post-footer">
				<?php
					if (!empty($post['caption'])) {
						?>
					<div class="caption"><p><?php echo wordwrap($post['caption'],70, '<br />');?></p></div>
					<?php
					}
				 ?>
			<div class="post-footer-events">
				<?php
				$like = new LikeModel();
				$quantity_likes = $like->getQuantity($post['id']);
				?>
				<span><?php echo escape($quantity_likes);?></span>
				<?php
				$isLiked = $like->isLiked($post['id'], $uid);
				if ($isLiked) {
				?>
				<i value="<?php echo escape($post['id']);?>" class="fa fa-heart"></i>
				<?php } else {?>
				<i value="<?php echo escape($post['id']);?>" class="fa fa-heart-o"></i>
				<?php } ?>
				<?php if ($uid === $user_post->data()->id) {
					?>
				<i value="<?php echo escape($post['id']);?>" class="fa fa-trash-o"></i>
				<?php }?>
			</div>
		</div>
		<div class="section-comments">
			<ul>
				<?php
				$comments = new CommentModel();
				$comments = $comments->get($post['id']);
				foreach ($comments as $comment) {
					$user_comment = new UserModel($comment['uid']);
					$username_comment = $user_comment->data()->username;
					$username_comment_avatar = $user_comment->data()->avatar;
				?>
					<li class="li-comment">
						<div class="post-comment-header">
							<img class="post-comment-header-avatar" src="../<?php echo escape($username_comment_avatar);?>" alt="">
							<span class="post-header-username"><?php echo escape($username_comment);?></span>
							<p class="comment"><?php echo escape($comment['text']);?></p>
						</div>
					</li>
				<?php
				}
				?>
			</ul>
		</div>
		<div class="post-comment">
			<form value="<?php echo escape($post['id']);?>">
				<textarea placeholder="Comment..."></textarea>
				<button value="<?php echo escape($post['id']);?>" class="btn btn-primary">Comment</button>
			</form>
		</div>
		<?php } ?>
	</div>
	<?php
}
?>
</div>
	<div class="pagination">
		<?php
		for ($page = 1; $page <= $number_f_pages; $page++) {
			echo '<a href="index?page=' . $page . '">' . $page . '</a>';
		}
		?>
	</div>

<!-- The Modal -->
<div id="delete-modal" class="modal">
  <!-- Modal content -->
	<div class="delete-modal-content">
		<span class="close">&times;</span>
		<p>Are you sure you want to delete this post?</p>
		<div class="delete-modal-content-btn">
			<button id="yes" class="btn btn-primary">Yes</button>
			<button id="no" class="btn btn-primary">No</button>
		</div>
	</div>
</div>

<script type="module" src="public/js/events.js"></script>