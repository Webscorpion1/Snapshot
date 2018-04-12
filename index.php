<?php
include_once('classes/Post.class.php');
include_once('classes/User.class.php');
include_once("includes/functions.inc.php");
checklogin();
$post = Post::ShowPosts();

echo $_SESSION['userid'];
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

<h1>Posts</h1>
<?php foreach($post as $p): ?>
    <div class="post">
        <div class="post__picture"><img src="<?php echo $p['picture'] ?>" alt=""></div>
        <div class="post_desc"><p><?php echo $p['description'] ?></p></div>
        <div class="post_date"><?php echo $p['post_date'] ?></div>
    </div>
<?php endforeach; ?>
</body>
</html>


