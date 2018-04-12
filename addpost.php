<?php
include_once('classes/Post.class.php');
include_once('classes/User.class.php');
include_once("includes/functions.inc.php");
checklogin();
$post = Post::ShowPosts();


?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Homepage - Snapshot</title>
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

<body>
<a href="register.php">Register</a>
<a href="login.php">Login</a>
<a href="posts.php">Posts</a>
<a href="account.php">Profile settings</a>
<div class="wrapper">
    <h1>Posts</h1>
    <div class="container">
        <form action="" method="post" enctype="multipart/form-data">
            <h2 form__title>Add post</h2>

            <div class="form__field">
                <label for="file" class="label">Upload picture</label>
                <input type="file" name="file" id="fileToUpload">
            </div>
            <div class="form__field">
                <label for="question" class="label">Description</label>
                <textarea name="question" id="question" cols="25" rows="5"></textarea>
            </div>
            <div class="form__field">
                <input type="submit" name="submit" value="Add question"">
            </div>
        </form>
    </div>
</div>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>

</script>
</html>


