<?php
include_once("classes/User.class.php");
include_once("includes/functions.inc.php");

checklogin();
if (!empty ($_POST)) {
    $user = new User();
    if($_POST['confirmation_pw'] == $user->getPassword()){}
    $user->setEmail($_POST['change_email']);
    $user->setAvatar($_POST['photo']);
    $user->setDescr($_POST['bio']);
    $user->setPassword($_POST['change_password']);
    $user->editprofile();
    header('Location: index.php');

}

?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Account - Snapshot</title>
    <meta name="description" content="snapshot" />
    <meta name="keywords" content="snapshot, imd" />
    <meta name="author" content="Lucas Debelder, Jasmina Dahou, Sander Verbesselt, Frederik Delaet" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:600,800|Open+Sans" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.0.4/js/all.js"></script>
    <link rel="stylesheet" type="text/css" href="css/reset.css" />
    <link rel="stylesheet" type="text/css" href="css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="css/master.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />

    <meta property="og:url" content="">
    <meta property="og:type" content=""/>
    <meta property="og:title" content=""/>
    <meta property="og:description" content=""/>
    <meta property="og:image" content=""/>
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="">
    <meta name="twitter:creator" content="">
    <meta name="twitter:title" content="">
    <meta name="twitter:description" content=" ">
    <meta name="twitter:image" content="">

</head>
<nav>
    <ul>
        <li><img src="media/frontend/logo.svg" alt="Logo" ></li>

        <li><a href="index.php">Home</a></li>
        <li><a href="posts.php">Posts</a></li>
        <li><a href="addpost.php">Add post</a></li>
        <li><a class="active" href="account.php">Profile settings</a></li>
        <li><a href="logout.php">Log out</a></li>
    </ul>
</nav>
<form action="" method="post">
    <h1 form__title>Update account</h1>

    <!-- Profiel foto -->
    <div>
        <label for="photo">UPDATE PROFILE PICTURE</label><br/>
        <input type="text" id="photo" name="photo" placeholder="">
    </div>

    <!-- Bio/descriptie -->
    <div>
        <label for="bio">UPDATE/EDIT BIO</label><br/>
        <input type="text" id="bio" name="bio" placeholder="">
    </div>

    <!-- Bio/descriptie -->
    <div>
        <label for="change_password">CHANGE PASSWORD</label><br/>
        <input type="password" id="change_password" name="change_password" placeholder="">
    </div>

    <!-- Bio/descriptie -->
    <div>
        <label for="change_email">CHANGE EMAIL</label><br/>
        <input type="email" id="change_email" name="change_email" placeholder="">
    </div>

    <!-- RETYPE PASSWORD -->
    <div>
        <label for="confirmation_pw">TYPE IN THE CURRENT PASSWORD TO VERIFY</label><br/>
        <input style="background-color: rgba(247, 129, 34, 0.1);" type="password" id="confirmation_pw" name="confirmation_pw" placeholder="">
    </div>

    <div>
        <input type="submit" value="SAVE PROFILE" class="btn_login">
    </div>
        </body>
        </html>
