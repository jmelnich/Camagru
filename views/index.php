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
?>

<div class="container">

<?php
$posts = new PostModel();
$posts = $posts->get();
//print_r($posts);
foreach ($posts as $post) {
 $user_post = new UserModel($post['uid']);
 $username_post = $user_post->data()->username;
 $username_avatar = $user_post->data()->avatar;
 ?>
	<div class="post">
		<div class="post-header">
			<img class="post-header-avatar" src="../<?php echo escape($username_avatar);?>" alt="">
			<div class="username"><?php echo escape($username_post);?></div>
		</div>
		<img src="../<?php echo escape($post['isrc']);?>" alt="">
		<div class="post-footer">
			<div class="timestamp"><?php echo escape($post['time']);?></div>
		</div>
	</div>
<?php
}
?>


</div>

<?php
} else {
	?>
<div class="container">
	Home
</div>
	<?php
}
?>


