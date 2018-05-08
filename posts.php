<?php
include_once('classes/Post.class.php');
include_once('classes/User.class.php');
include_once('classes/Comments.class.php');

User::checklogin();


if(!empty($_GET)){
    $post = Post::PostDetail();
    $comment = Comments::ShowComments($_GET['post']);

}
$newComment = new Comments();

if(count($comment) < 1){
}
else{ }

/*
if(isset($_POST['btnCreatePost'])) {

    $date = date("Y-m-d H:i:s");
    $userid = $_SESSION['userid'];

    $newComment = new Comments();

    $newComment->setComment( $_POST['comment'] );
    $newComment->setDate($date);
    $newComment->setUserId($userid);
    $newComment->AddComment($_GET['post']);

}
*/

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
        <li><a class="active" href="index.php">Home</a></li>
        <li><a href="friends.php">Friend's posts</a></li>
        <li><a href="addpost.php">Add post</a></li>
        <li><a href="profile.php?user=<?php echo $_SESSION['userid']; ?>">Profile</a></li>
        <li><a href="logout.php">Log out</a></li>

    </ul>
</nav>
<div class="wrapper">

    <form class="post" action="" method="post" enctype="multipart/form-data">

        <div class="post__title"><h1><?php echo $post[0]['post_title']?></h1></div>
        <div class="post__detail_top_grid">
        <div class="post__user post__details"><h3>Posted by: <?php echo $post[0]['username']; ?> </h3></div>
        <div class="post__date post__details"><p><span>Posted on: </span> <?php echo $post[0]['post_date']; ?> </p></div>
        </div>
            <div class="post__picture"><img src="<?php echo $post[0]['picture'] ?>" alt=""></div>
        <div class="post__desc"><p><?php echo $post[0]['description']?></p></div>

    </form>

    <form class="post" action="" method="post" enctype="multipart/form-data">
        <div class="form__field">
            <label for="comment" class="label">YOUR COMMENT</label><br/>
            <textarea name="comment" id="post" cols="30" rows="2"></textarea>
            <input type="submit" class="btn__confirm btn_post btn_comment" name="btnCreatePost" id="btnCreatePost" value="Send" />


            <br/>


        </div>
        <div class="comment-container">
            <h2>View all comments</h2>
            <?php foreach($comment as $c): ?>
                <div class="post__comment"><h3><?php echo $c['comment']?></h3></div>
                <div class="post__detail_top_grid">
                    <div class="post__user post__details"><h3>Posted by: <?php echo $c['username']?> </h3></div>
                    <div class="post__date post__details"><p><span>Posted on: </span><?php echo $c['post_date']?>  </p><br/><br/></div>
                </div>
            <?php endforeach; ?></div>
    </form>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script>
    $("#btnCreatePost").on("click", function(e) {
        var text = $("#post").val();
        var postid = <?php echo $_GET['post']; ?>;

        console.log(postid);
        console.log(text);
        $.ajax({
            method: "POST",
            url: "ajax/ajax_comments.php",
            data: {text: text, postid: postid}
        })
            .done(function( res ) {
                if(res.status == "success"){
                    var ctext = `

                            <h3>${res.text}</h3>
                            `;
                    $('.comment-container').append(ctext);
                    $(".comment-container").first().slideDown();
                }

            });

        e.preventDefault();
        $("#post").val("");

    });
</script>
</html>