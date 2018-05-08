<?php
include_once('classes/Post.class.php');
include_once('classes/User.class.php');

User::checklogin();
$editpost = Post::showEditPost($_GET['edit']);

if(!empty($_POST['edit_post'])){
  Post::editPost($_GET['edit'],$_POST['title'],$_POST['description']);
  $feedback = "Your post has been edited.";
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

        <li><img src="media/frontend/logo.svg" alt="Logo" ></li>

        <li><a href="index.php">Home</a></li>
        <li><a href="friends.php">Friend's posts</a></li>
        <li><a href="addpost.php">Add post</a></li>
        <li><a href="profile.php?user=<?php echo $_SESSION['userid']; ?>">Profile</a></li>
        <li><a href="logout.php">Log out</a></li>

    </ul>
</nav>
<div class="wrapper">

    <?php if(isset($feedback)): ?>
        <p><?php echo $feedback ?></p>
    <?php endif; ?>

        <div class="container">

            <form action="" method="post">
                <h1>Edit post</h1>
                <div>
                    <label for="title">CHANGE TITLE TO</label><br/>
                    <input class="form__input" type="text" id="description" name="title" value="<?php echo $editpost[0]['post_title'] ?>" placeholder="">
                </div>
                <div>
                    <label for="description">CHANGE DESCRIPTION TO</label><br/>
                    <input class="form__input" type="text" id="description" name="description" value="<?php echo $editpost[0]['description'] ?>" placeholder="">
                </div>
                <input class="btn_style" type="submit" value="Edit post" name="edit_post">
            </form>
        </div>

</div>
</body>
</html>


