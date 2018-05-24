<div class="container">
	<form id="login-form" action="recovery" method="post">
		<div class="form-group">
			<label>Email</label>
			<input type="text" class="form-control" name="email" value="<?php echo escape(Input::get('email')); ?>">
		</div>
		<input type="hidden" name="token" value="<?php echo Token::generate();?>">
		<button type="submit" name="submit" class="btn btn-primary">Send recovery link</button>
		<p class="text"><a href="login">Back to login</a></p>
		<p class="text">Don't have account? <span><a href="signup">Sign up</a><span></p>
	</form>
</div>