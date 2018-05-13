<?php
include_once('classes/Post.class.php');
include_once('classes/User.class.php');

User::checklogin();
if(!empty($_POST['final_delete'])){
    Post::DeleteTags($_GET['delete']);
    Post::DeletePost($_GET['delete']);
    $feedback = "Post has been deleted";
}
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
    <link rel="stylesheet" href="https://cssgram-cssgram.netdna-ssl.com/cssgram.min.css">

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
        <div class="logo">
            <li><img src="media/frontend/logo.svg" alt="Logo" ></li>
        </div>


        <div class="links">
            <li><a href="index.php">Home</a></li>
            <li><a href="friendposts.php">Friend's posts</a></li>
            <li><a href="addpost.php">Add post</a></li>
            <li><a href="profile.php?user=<?php echo $_SESSION['userid']; ?>">Profile</a></li>
            <li><a href="logout.php">Log out</a></li>
        </div>
    </ul>
</nav>
<div class="container">

    <form class="formdelete" action="" method="post">
    <?php if(isset($feedback)): ?>
        <p><?php echo $feedback ?></p>
    <?php endif; ?>
    <?php if(empty($_POST['final_delete'])): ?>
    <h2>Are you sure you want to delete your post?</h2>
        <form class="delete" action="" method="post">
            <input class="btn_style delete" type="submit" value="Yes" name="final_delete">
        </form>
        <form class="delete" action="index.php" method="post">
            <input class="btn_style delete" type="submit" value="No">
        </form>

    </form>
    <?php endif; ?>
</div>
</body>
</html>


