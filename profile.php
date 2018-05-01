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
        <form class="nav_search" action="" method="post">
            <input class="form__input" type="text" name="search" id="search" placeholder="&#xF002; Search on tags" style="font-family:Arial, FontAwesome" />
        </form>
        <li><a href="index.php">Home</a></li>
        <li><a href="addpost.php">Add post</a></li>
        <li><a class="active" href="profile.php?user=<?php echo $_SESSION['userid']; ?>">Profile</a></li>
        <li><a href="logout.php">Log out</a></li>

    </ul>
</nav>
<div class="wrapper">
    <h1>Profile</h1>
    <div class="container">
        <h2><?php echo $user[0]['firstname'] ?>&nbsp;<?php echo $user[0]['lastname'] ?></h2>
        <p><?php echo $user[0]['avatar'] ?></p>
        <p><?php echo $user[0]['description'] ?></p>
        <div class="follow">
        <?php $checkfollow = User::checkFollow($_SESSION['userid'], $_GET['user']); ?>
        <?php if($_SESSION['userid'] !== $_GET['user'] && $checkfollow == false): ?>
        <form action="" method="post">
            <input type="submit" value="Follow" name="follow">
        </form>
        <?php endif; ?>
        <?php if($_SESSION['userid'] !== $_GET['user'] && $checkfollow == true): ?>
            <form action="" method="post">
                <input type="submit" value="unfollow" name="unfollow">
            </form>
        <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>


