<?php
include_once('classes/Post.class.php');
include_once('classes/User.class.php');
include_once('classes/Like.class.php');

User::checklogin();


$post = Post::ShowPosts();
$likefeedback = "unlike";

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
        <form class="nav_search" action="" method="post">
            <input class="form__input" type="text" name="search" id="search" placeholder="Search on tags" style="font-family:Arial, FontAwesome" />
        </form>
        <li><a class="active" href="index.php">Home</a></li>
        <li><a href="addpost.php">Add post</a></li>
        <li><a href="profile.php?user=<?php echo $_SESSION['userid']; ?>">Profile</a></li>
        <li><a href="logout.php">Log out</a></li>
    </ul>
</nav>

<div class="wrapper">

<h1 class="home-title">Viewing all Posts</h1>

<div class="post_container">
<?php foreach($post as $p): ?>
  <?php
    $likecount = Like::Checklike($p['id'],$_SESSION['userid']);
    if($likecount > 0){
      $likefeedback = "like";
  }
  else{
      $likefeedback = "unlike";
  }
  ?>


        <div class="post">
            <div class="post__title"><h2><?php echo $p['post_title'] ?></h2></div>
            <div class="post__detail_top_grid">
            <div class="post__user post__details"><h3>Posted by: <a href="profile.php?user=<?php echo $p['user_id']; ?>"><?php echo $p['username'] ?></a></h3></div>
            <div class="post__date post__details"><p><span>Posted on: </span> <?php echo $p['post_date'] ?></p></div>

            </div>
                <div class="post__picture"><img src="<?php echo $p['picture'] ?>" alt=""></div>
            <div>
                <form class="post_form post__detail_grid" action="" method="post">
                    <a class="post__reported post__link" href="index.php?reported=<?php echo $p['id']; ?>"><input type="button" class="post__link" value="Report"></a>
                    <?php if($_SESSION['userid'] == $p['user_id']): ?>
                    <a class="post__link" href="editpost.php?edit=<?php echo $p['id'] ?>"><input type="button" class="post__link" value="Edit"  name="edit"></a>
                    <a class="post__link" href="deletepost.php?delete=<?php echo $p['id'] ?>"><input type="button" class="post__link" value="Delete"  name="delete"></a>
                    <?php endif; ?>
                   </form>
            </div>
            <div>
                <img src="media/<?php echo $likefeedback; ?>.png" class="img_like" id="<?php echo $p['id']; ?>">
                <div class="like-count"><?php echo Like::Countlike($p['id']) ?></div>
            </div>
            <div class="post__desc"><p><?php echo $p['description'] ?></p></div>
            <a class="" href="posts.php?post=<?php echo $p['id']; ?>"><button class="btn__confirm btn_post">View full post</button></a>
        </div>

<?php endforeach; ?>

</div>
</div>
<button class=" btn_post btn_loadmore" type="button" name="load-more" value="Load more Snapshots">Load more Snapshots</button>
</body>
<script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
<script>
    var limit = 40;
    $('.btn_loadmore').on('click',function () {
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

    $(".post__reported").on("click", function(e) {
        var url = ($(this).attr('href'));
        var postid = getURLParameter(url, 'reported');
        $.ajax({
            context: this,
            method: "POST",
            url: "ajax/reported.php",
            data: {postid: postid}
        })
            .done(function( res ) {
                if(res.status == "success"){
                    console.log("yes");
               $(this).parents('.post').fadeOut();
                }

            });
        e.preventDefault();
        $(this).fadeOut();
    });



    $(".img_like").on('click',function () {

        var postid = $(this).attr('id');
            console.log(postid);
        $.ajax({
            context: this,
            method: "POST",
            url: "ajax/post_like.php",
            data: {postid: postid}
        })
            .done(function( res ) {
                if(res.status == "success"){
                    console.log("yes");

                    $(this).attr('src','media/like.png');
                    $(this).val("like");
                    var number =  $(".img_like").closest('.like-count').text();
                    console.log(number);
                    var total = number + 1;
                    $(".img_like").closest('.like-count').text(total);

                }
                else{
                    console.log("no");
                    $(this).attr('src','media/unlike.png');
                    $(this).val("unlike");
                    var number =  $(".img_like").closest('.like-count').text();
                    console.log(number);
                    var total = number - 1;
                    $(".img_like").closest('.like-count').text(total);
                }
            });

    });

/*


    $(".post__like").on('click',function (e) {
        e.preventDefault();

        var postid = $(this).attr('id');
        console.log(postid);
        $.ajax({
            context: this,
            method: "POST",
            url: "ajax/post_like.php",
            data: {postid: postid}
        })
            .done(function( res ) {
                if(res.status == "success"){
                    console.log("yes");
                    $(this).val("unlike");
                    $(this).closest('.like-count').text(+1);

                }
                else{
                    console.log("no");
                    $(this).val("like");
                    $(this).closest('.like-count').text(-1);
                }
            });

    });


    */


    function getURLParameter(url, name) {
        return (RegExp(name + '=' + '(.+?)(&|$)').exec(url)||[,null])[1];
    }

</script>
</html>


