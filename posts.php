<?php
include_once('classes/Post.class.php');
include_once('classes/User.class.php');
include_once('classes/Comments.class.php');

User::checklogin();


if(!empty($_GET)){
    $post = Post::PostDetail();
    $comment = Comments::ShowComments($_GET['post']);

}

if(count($comment) < 1){
}
else{ }

if(! empty($_POST)) {

    $date = date("Y-m-d H:i:s");
    $userid = $_SESSION['userid'];

    $newComment = new Comments();

    $newComment->setComment( $_POST['comment'] );
    $newComment->setDate($date);
    $newComment->setUserId($userid);
    $newComment->AddComment($_GET['post']);

}

?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Posts - Snapshot</title>
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
            <input type="text" name="search" id="search" placeholder="&#xF002; Search on tags" style="font-family:Arial, FontAwesome" />
        </form>
        <li><a class="active" href="index.php">Home</a></li>
        <li><a href="addpost.php">Add post</a></li>
        <li><a href="profile.php?user=<?php echo $_SESSION['userid']; ?>">Profile</a></li>
        <li><a href="logout.php">Log out</a></li>

    </ul>
</nav>
<div class="wrapper">

    <form class="post" action="" method="post" enctype="multipart/form-data">

        <div class="post__title"><h1><?php echo $post[0]['post_title']?></h1></div>
        <div class="post__user"><h3>Posted by: <?php echo $post[0]['user_id']; ?> </h3></div>
        <div class="post__date"><p><span>Posted on: </span> <?php echo $post[0]['post_date']; ?> </p></div>
        <div class="post__picture"><img src="<?php echo $post[0]['picture'] ?>" alt=""></div>
        <div class="post__desc"><p><?php echo $post[0]['description']?></p></div>

    </form>

    <form class="post" action="" method="post" enctype="multipart/form-data">
        <div class="form__field">
            <label for="comment" class="label">YOUR COMMENT</label><br/>
            <input name="comment">


            <h1>All comments</h1>
            <?php foreach($comment as $c): ?>
                <div class="post__comment"><h1><?php echo $c['comment']?></h1></div>
                <div class="post__user"><h3>Posted by: <?php echo $c['user_id']?> </h3></div>
                <div class="post__date"><p><span>Posted on: </span><?php echo $c['post_date']?>  </p></div>
            <?php endforeach; ?>
        </div>
    </form>
</div>
</body>
</html>