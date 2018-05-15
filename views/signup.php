<div class="container">
    <form id="login-form" action="signup" method="post">
        <div class="form-group">
          <label>Email</label>
          <input type="text" class="form-control" name="email">
        </div>

        <div class="form-group">
          <label>Username</label>
          <input type="text" class="form-control" name="username">
        </div>

        <div class="form-group">
          <label>Password</label>
          <input type="password" class="form-control" name="password">
        </div>

        <div class="form-group">
          <label>Confirm password</label>
          <input type="password" class="form-control" name="password_confirm">
        </div>
        <span class="error"><?php echo $data?></span>
        <button type="submit" name="submit" class="btn btn-primary">Sign Up</button>
        <p>Already have account? <span><a href="login">Log in</a><span></p>
    </form>
</div>
