<?php
if (Session::exists('activation')) {
	echo Session::flash('activation');
}
?>
<div class="container">
	<form id="login-form" action="login" method="post">
		<div class="form-group">
			<label>Email</label>
			<input type="text" class="form-control" name="email" value="<?php echo escape(Input::get('email')); ?>">
		</div>
		<div class="form-group">
				<label>Password</label>
				<input type="password" class="form-control" name="password">
		</div>
		<div class="form-group">
				<input type="checkbox" class="" name="remember" id="remember">
				<label class="label-secondary" for="remember">Remember me</label>
		</div>
		<span class="error"><?php echo $data?></span>
		<button type="submit" name="submit" class="btn btn-primary">Log In</button>
		<p>Don't have account? <span><a href="signup">Sign up</a><span></p>
	</form>
</div>


