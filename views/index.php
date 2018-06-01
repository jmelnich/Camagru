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
$posts = new PostModel();
$posts = $posts->get();

foreach ($posts as $post) {
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
			<section class="post-footer-events">
				<i value="<?php echo escape($post['id']);?>" class="fa fa-heart-o"></i>
				<?php if ($uid === $user_post->data()->id) {
					?>
				<i value="<?php echo escape($post['id']);?>" class="fa fa-trash-o"></i>
				<?php }?>
			</section>
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
		<div class=post-comment>
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

<script type="module" src="public/js/post.js"></script>
<script type="module" src="public/js/events.js"></script>