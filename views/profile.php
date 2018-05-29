<?php
if (Session::exists('update')) {
	echo Session::flash('update');
}
$user = new UserModel();
if ($user->isLoggedIn()) {
    $username = $user->data()->username;
    $first_name = ucfirst($user->data()->first_name);
    $last_name = ucfirst($user->data()->last_name);
    $avatar =$user->data()->avatar;
} else {
	header('Location: 404');
}?>
<div class="container">
		<h3 class="panel-title">Profile info</h3>
		<div class="container-left">
			<form enctype="multipart/form-data" action="profile" method="post" class="profile" id="edit-avatar">
				<div class="form-group">
					<img class="avatar" src="../<?php echo escape($avatar); ?>" alt="Smiley face" height="150" width="150">
					<label class="profile__pic-uploader" title="Change picture">Change photo</label>
					<input type="file" name="picture" accept="image/*">
				<input type="hidden" name="token" value="<?php echo Token::generate();?>">
				<input type="hidden" name="MAX_FILE_SIZE" value="32768">
				<button type="submit" name="submit-photo" value="update" class="btn btn-primary">
					<span>Update</span>
				</button>
				</div>
			</form>
		</div>
		<div class="container-right">
			<form action="profile" method="post" class="profile" id="edit-profile">
				<div class="form-group">
					<label for="name">Username</label>
					<input type="text" name="username" class="form-control" value="<?php echo escape($username); ?>">
				</div>
				<div class="form-group">
					<label for="name">First name</label>
					<input type="text" name="first_name" class="form-control" value="<?php echo escape($first_name); ?>">
				</div>
				<div class="form-group">
					<label for="name">Last name</label>
					<input type="text" name="last_name" class="form-control" value="<?php echo escape($last_name); ?>">
				</div>
				<input type="hidden" name="token" value="<?php echo Token::generate();?>">
				<button type="submit" value="update" name="submit-details" class="btn btn-primary">
					<span>Update</span>
				</button>
			</form>
		</div>


		<h3 class="panel-title">Change password</h3>
		<div class="container-left">
		</div>
		<div class="container-right">
			<form action="profile" class="profile" method="post" id="edit-password">
				<div class="form-group">
					<label for="name">Current password</label>
					<input type="password" name="current_password" class="form-control" value="">
				</div>
				<div class="form-group">
					<label for="name">New password</label>
					<input type="password" name="new_password" class="form-control" value="">
				</div>
				<div class="form-group">
					<label for="name">Repeat new password</label>
					<input type="password" name="new_password_confirm" class="form-control" value="">
				</div>
				<input type="hidden" name="token" value="<?php echo Token::generate();?>">
				<button class="btn btn-primary btn-mw-sm" name="submit-password" data-profile-action="save">
					<span>Update</span>
				</button>
			</form>
		</div>




  </div>