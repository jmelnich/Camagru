<?php
$page_title='Signup page';
include('includes/header.php');
?>

<div class="container">
    <form id="login-form">
        <div class="form-group">
          <label>Email</label>
          <input type="text" class="form-control" name="email">
        </div>

        <div class="form-group">
          <label>Username</label>
          <input type="text" class="form-control" name="username">
        </div>

        <div class="form-group">
          <label>Name</label>
          <input type="text" class="form-control" name="displayName">
        </div>

        <div class="form-group">
          <label>Password</label>
          <input type="password" class="form-control" name="password">
        </div>

        <div class="form-group">
          <label>Confirm password</label>
          <input type="password" class="form-control" name="password_confirm">
        </div>
        <button type="submit" class="btn btn-primary">Sign Up</button>
        <p>Already have account? <span><a href="login.php">Log in</a><span></p>
    </form>
</div>

<?php
include('includes/footer.php');
?>
