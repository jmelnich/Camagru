<?php
$title = ($name == "index") ? "Home" : ucfirst($name);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="public/css/style.css">
    </head>

    <body>
        <header>
            <ul class="nav">
                <li><a href="index">Home</a></li>
                <?php
                    $user = new UserModel();
                if ($user->isLoggedIn()) {
                    $username = ucfirst($user->data()->username);
                    ?>
                <li><a href="profile">Hello, <?php echo escape($username);?></a></li>
                <li><a href="add">Add photo</a></li>
                <li><a href="logout">Log out</a></li>
                <?php } else {
                    ?>
                <li><a href="login">Login</a></li>
                <li><a href="signup">Sign up</a></li>
                    <?php
                }
                ?>
            </ul>
        </header>