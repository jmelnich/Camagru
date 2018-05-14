<?php
$title = ($name == "index") ? "Home" : ucfirst($name);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" href="public/css/style.css">
    </head>

    <body>
        <header>
            <ul class="nav">
                <li><a href="index">Home</a></li>
                <li><a href="login">Login</a></li>
                <li><a href="signup">Sign up</a></li>
            </ul>
        </header>