<?php
include_once('classes/Post.class.php');
include_once('classes/User.class.php');

User::checklogin();
$user = User::getUser();
if(!empty($_POST['unfollow'])){
    $u = new User();
    $current_user = $_SESSION['userid'];
    $friend = $_GET['user'];
    $u->unFollow($current_user, $friend);

}
if(!empty($_POST['follow'])){
    $u = new User();
    $current_user = $_SESSION['userid'];
    $friend = $_GET['user'];
    $u->follow($current_user, $friend);

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
            <li><a class="active" href="profile.php?user=<?php echo $_SESSION['userid']; ?>">Profile</a></li>
            <li><a href="logout.php">Log out</a></li>
        </div>
    </ul>
</nav>
<div class="wrapper">

    <div class="container">
        <div class="profile-container">
        <h1>Profile</h1>
        <h2><?php echo $user[0]['firstname'] ?>&nbsp;<?php echo $user[0]['lastname'] ?></h2>
        <p><?php echo $user[0]['avatar'] ?></p>
        <p><?php echo $user[0]['description'] ?></p>
        <div class="follow">
        <?php $checkfollow = User::checkFollow($_SESSION['userid'], $_GET['user']); ?>
        <?php if($_SESSION['userid'] !== $_GET['user'] && $checkfollow == false): ?>
        <form action="" method="post">
            <input class="btn_style" type="submit" value="Follow" name="follow">
        </form>
        <?php endif; ?>
        <?php if($_SESSION['userid'] !== $_GET['user'] && $checkfollow == true): ?>
            <form action="" method="post">
                <input class="btn_style" type="submit" value="unfollow" name="unfollow">
            </form>
        <?php endif; ?>
            <?php if($_SESSION['userid'] == $_GET['user']): ?>
                <a href="profile_edit.php?user=<?php echo $_GET['user']; ?>">Edit profile</a>
            <?php endif; ?>
        </div>
    </div>
    </div>
</div>
</body>
</html>


