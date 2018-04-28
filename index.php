<?php
include_once('classes/Post.class.php');
include_once('classes/User.class.php');

User::checklogin();
$post = Post::ShowPosts();

if(count($post) < 1){

}
else{

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

<h1>Viewing all Posts</h1>
<div class="post_container">
<?php foreach($post as $p): ?>
        <div class="post">
            <div class="post__title"><h1><?php echo $p['post_title'] ?></h1></div>
            <div class="post__user post__details"><h3>Posted by: <a href="profile.php?user=<?php echo $p['user_id']; ?>"><?php echo $p['username'] ?></a></h3></div>
            <div class="post__date post__details"><p><span>Posted on: </span> <?php echo $p['post_date'] ?></p></div>
            <div class="post__picture"><img src="<?php echo $p['picture'] ?>" alt=""></div>
            <div class="post__desc"><p><?php echo $p['description'] ?></p></div>
            <?php if($_SESSION['userid'] == $p['user_id']): ?>
                <form class="post_form" action="" method="post">
                    <a href="editpost.php?edit=<?php echo $p['id'] ?>"><input type="button" class="button" value="&#xf044; Edit" style="font-family:Arial, FontAwesome" name="edit"></a>
                    <a href="deletepost.php?delete=<?php echo $p['id'] ?>"><input type="button" class="button" value="&#xf1f8; Delete" style="font-family:Arial, FontAwesome" name="delete"></a>
                </form>
            <?php endif; ?>
            <a class="btn_post" href="posts.php?post=<?php echo $p['id']; ?>"><button class="btn_post">View full post</button></a>
        </div>


<?php endforeach; ?>


</div>
</div>
<button class=" btn_post btn_loadmore" type="button" name="load-more" value="Load more Snapshots">Load more Snapshots</button>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    var limit = 40;
    $('.button--load-more').on('click',function () {
        limit = limit + 40;
        $.ajax({
            url:"ajax/post_load.php",
            method: "POST",
            data:{limit:limit},
            success:function (data) {
                $(".post-container").html(data);
            }
        });
    });
$('#search').keyup(function () {
    $keyword = $('#search').val();
    $.ajax({
        url:"ajax/post_search.php",
        method: "POST",
        data:{keyword:$keyword},
        success:function (data) {
            $(".post-container").html(data);
        }
    });
});

</script>
</html>


