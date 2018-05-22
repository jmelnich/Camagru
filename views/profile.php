<?php
    $user = new UserModel();
if ($user->isLoggedIn()) {
    $username = ucfirst($user->data()->username);
    $first_name = ucfirst($user->data()->first_name);
    $last_name = ucfirst($user->data()->last_name);
}?>
<div class="container">
	<form action="" method="post" class="profile" id="edit-profile">

		<h3 class="panel-title">Profile info</h3>
		<div class="form-group">
			<label class="profile__pic-uploader" title="Change picture">
				<input type="file" name="picture" accept="image/*">
			</label>
		</div>
		<div class="form-group">
			<label for="name">Username</label>
			<input type="text" name="name" class="form-control" value="<?php echo escape($username); ?>">
		</div>
		<div class="form-group">
			<label for="name">First name</label>
			<input type="text" name="name" class="form-control" value="<?php echo escape($first_name); ?>">
		</div>
		<div class="form-group">
			<label for="name">Last name</label>
			<input type="text" name="name" class="form-control" value="<?php echo escape($last_name); ?>">
		</div>
		<input type="hidden" name="token" value="<?php echo Token::generate();?>">
		<button type="submit" value="update" class="btn btn-primary">
			<span>Update</span>
		</button>
	</form>

	<form class="profile" id="edit-password">
		<h3 class="panel-title">Change password</h3>
		<div class="form-group">
			<label for="name">Current password</label>
			<input type="text" name="name" class="form-control" value="">
		</div>
		<div class="form-group">
			<label for="name">New password</label>
			<input type="text" name="name" class="form-control" value="">
		</div>
		<div class="form-group">
			<label for="name">Repeat new password</label>
			<input type="text" name="name" class="form-control" value="">
		</div>
		<button class="btn btn-primary btn-mw-sm" data-profile-action="save">
			<span>Update</span>
		</button>
  </div>