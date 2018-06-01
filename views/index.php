<?php
if (Session::exists('success')) {
	echo Session::flash('success');
}
if (Session::exists('recovery')) {
	echo Session::flash('recovery');
}

$user = new UserModel();
if ($user->isLoggedIn()) {
    $username = $user->data()->username;
    $first_name = ucfirst($user->data()->first_name);
    $last_name = ucfirst($user->data()->last_name);
    $avatar =$user->data()->avatar;
}
?>

<div class="container">

<?php
$posts = new PostModel();
$posts = $posts->get();

foreach ($posts as $post) {
 $user_post = new UserModel($post['uid']);
 $username_post = $user_post->data()->username;
 $username_avatar = $user_post->data()->avatar;
 ?>
	<div class="post">
		<div class="post-header">
			<img class="post-header-avatar" src="../<?php echo escape($username_avatar);?>" alt="">
			<span class="post-header-username"><?php echo escape($username_post);?></span>
			<div class="post-header-timestamp"><?php echo escape($post['time']);?></div>
		</div>
		<img class="post-img" src="../<?php echo escape($post['isrc']);?>" alt="">
		<div class="post-footer">
			<i class="fa fa-heart-o"></i>
			<i class="fa fa-trash-o"></i>
		</div>
		<div class=post-comment>
			<form>
				<textarea placeholder="Comment..."></textarea>
				<button id="comment" class="btn btn-primary">Comment</button>
			</form>
		</div>
	</div>
<?php
}
?>
</div>