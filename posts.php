<?php
include_once('classes/Post.class.php');
include_once('classes/User.class.php');

Post::ShowPosts();


?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div class="post">
   <div class="post__picture"></div>
    <div class="post_desc"></div>
    <div class="post_date"></div>
</div>
</body>
</html>