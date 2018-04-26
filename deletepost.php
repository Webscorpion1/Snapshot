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
<?php include_once("includes/nav.inc.php"); ?>

<div class="wrapper">
    <?php echo $_GET['delete'] ?>
    <?php if(isset($feedback)): ?>
        <p><?php echo $feedback ?></p>
    <?php endif; ?>
    <?php if(empty($_POST['final_delete'])): ?>
    <h2>Are you sure you want to delete your post?</h2>
    <div class="container">
        <form action="" method="post">
            <input type="submit" value="Yes" name="final_delete">
        </form>
        <form action="index.php" method="post">
            <input type="submit" value="no">
        </form>
    </div>
    <?php endif; ?>
</div>
</body>
</html>


