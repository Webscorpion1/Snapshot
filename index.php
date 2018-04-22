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
    <meta name="author" content="Lucas Debelder, Sander Verbesselt, Frederik Delaet" />
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
    <nav>
        <ul>
            <li><img src="media/frontend/logo.svg" alt="Logo" ></li>

            <li><a class="active" href="index.php">Home</a></li>
            <li><a href="posts.php">Posts</a></li>
            <li><a href="addpost.php">Add post</a></li>
            <li><a href="account.php">Profile settings</a></li>
            <li><a href="logout.php">Log out</a></li>
        </ul>
    </nav>
<div class="wrapper">
<h1>Posts</h1>
<div class="post-container">
<?php foreach($post as $p): ?>
    <div class="post">
        <div class="post_title"><p><?php echo $p['post_title'] ?></p></div>
        <div class="post__picture"><img src="<?php echo $p['picture'] ?>" alt=""></div>
        <div class="post_desc"><p><?php echo $p['description'] ?></p></div>
        <div class="post_date"><?php echo $p['post_date'] ?></div>
    </div>
<?php endforeach; ?>
</div>
</div>
<input type="button" name="load-more" class="button button--load-more" value="load more">
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    var limit = 5;
    $('.button--load-more').on('click',function () {
        limit = limit + 5;
        $.ajax({
            url:"ajax/post_load.php",
            method: "POST",
            data:{limit:limit},
            success:function (data) {
                $(".post-container").html(data);
            }
        });
    });
</script>
</html>


