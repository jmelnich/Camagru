<div class="container">
	<form id="password-form" action="password" method="post">
		<div class="form-group">
			<label>New password</label>
			<input type="password" class="form-control" name="password" value="">
		</div>
		<div class="form-group">
			<label>Repeat new password</label>
			<input type="password" class="form-control" name="password_confirm" value="">
		</div>
		<input type="hidden" name="token" value="<?php echo Token::generate();?>">
		<button type="submit" name="submit" class="btn btn-primary">Save new password</button>
	</form>
</div>