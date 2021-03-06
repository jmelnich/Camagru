<div class="container">
    <form class="form" id="login-form" action="signup" method="post">
        <div class="form-group">
          <label>*Email</label>
          <input type="text" class="form-control" name="email" value="<?php echo escape(Input::get('email')); ?>">
        </div>

        <div class="form-group">
          <label>*Username</label>
          <input type="text" class="form-control" name="username" value="<?php echo escape(Input::get('username')); ?>">
        </div>

        <div class="form-group">
          <label>First name</label>
          <input type="text" class="form-control" name="first_name" value="<?php echo escape(Input::get('first_name')); ?>">
        </div>

        <div class="form-group">
          <label>Last name</label>
          <input type="text" class="form-control" name="last_name" value="<?php echo escape(Input::get('last_name')); ?>">
        </div>

        <div class="form-group">
          <label>*Password</label>
          <input type="password" class="form-control" name="password" value="">
        </div>

        <div class="form-group">
          <label>*Confirm password</label>
          <input type="password" class="form-control" name="password_confirm" value="">
        </div>
        <input type="hidden" name="token" value="<?php echo Token::generate();?>">
        <button type="submit" name="submit" class="btn btn-primary">Sign Up</button>
        <p>Already have account? <span><a href="login">Log in</a><span></p>
    </form>
</div>
