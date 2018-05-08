<?php
$page_title='Login page';
include('includes/header.php');
?>

<div class="container">
    <form id="login-form">
        <div class="form-group">
            <label>Email</label>
            <input type="text" class="form-control" name="email">
        </div>
        <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password">
        </div>
        <button type="submit" class="btn btn-primary">Log In</button>
        <p>Don't have account? <span><a href="signup.php">Sign up</a><span></p>
    </form>
</div>

<?php
include('includes/footer.php');
?>

