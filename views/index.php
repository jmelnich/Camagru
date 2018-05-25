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
	<div class="feed">
		<div class="feed__header">
			Kind of Feed
		</div>
	</div>
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


