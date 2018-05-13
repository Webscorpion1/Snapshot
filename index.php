<?php
include_once('classes/Post.class.php');
include_once('classes/User.class.php');
include_once('classes/Like.class.php');

User::checklogin();


$post = Post::ShowAllPosts(2,$_SESSION['userid']);

if(!empty($_POST['searchsubmit'])){
    $post = Post::SearchAllPosts(100,$_SESSION['userid'],$_POST['search']);
}

$likefeedback = "unlike";

if(count($post) < 1){

}
else{

}


$colors = array(
    "Black"     => array(0, 0, 0),
    "Green"     => array(0, 128, 0),
    "Silver"    => array(192, 192, 192),
    "Lime Green"      => array(0, 255, 0),
    "Gray"      => array(128, 0, 128),
    "Olive Green"     => array(128, 128, 0),
    "White"     => array(255, 255, 255),
    "Yellow"    => array(255, 255, 0),
    "Dark Red"    => array(128, 0, 0),
    "Dark Blue"      => array(0, 0, 128),
    "Red"       => array(255, 0, 0),
    "Blue"      => array(0, 0, 255),
    "Purple"    => array(128, 0, 128),
    "Teal Blue"      => array(0, 128, 128),
    "Pink"   => array(255, 0, 255),
    "Aqua Blue"      => array(0, 255, 255),
);
function html2rgb($color)
{
    if ($color[0] == '#')
        $color = substr($color, 1);

    if (strlen($color) == 6)
        list($r, $g, $b) = array($color[0].$color[1],
            $color[2].$color[3],
            $color[4].$color[5]);
    elseif (strlen($color) == 3)
        list($r, $g, $b) = array($color[0].$color[0],
            $color[1].$color[1], $color[2].$color[2]);
    else
        return false;

    $r = hexdec($r); $g = hexdec($g); $b = hexdec($b);

    return array($r, $g, $b);
}

function distancel2(array $color1, array $color2) {
    return sqrt(pow($color1[0] - $color2[0], 2) +
        pow($color1[1] - $color2[1], 2) +
        pow($color1[2] - $color2[2], 2));
}


/*ALLE KLEUR  VINDEN*/

function colorPalette($imageFile, $numColors, $granularity = 5)
{
    $granularity = max(1, abs((int)$granularity));
    $colors = array();
    $size = @getimagesize($imageFile);
    if($size === false)
    {
        user_error("Unable to get image size data");
        return false;
    }
    $img = @imagecreatefromstring(file_get_contents($imageFile));
    // Andres mentioned in the comments the above line only loads jpegs,
    // and suggests that to load any file type you can use this:
    // $img = @imagecreatefromstring(file_get_contents($imageFile));

    if(!$img)
    {
        user_error("Unable to open image file");
        return false;
    }
    for($x = 0; $x < $size[0]; $x += $granularity)
    {
        for($y = 0; $y < $size[1]; $y += $granularity)
        {
            $thisColor = imagecolorat($img, $x, $y);
            $rgb = imagecolorsforindex($img, $thisColor);
            $red = round(round(($rgb['red'] / 0x33)) * 0x33);
            $green = round(round(($rgb['green'] / 0x33)) * 0x33);
            $blue = round(round(($rgb['blue'] / 0x33)) * 0x33);
            $thisRGB = sprintf('%02X%02X%02X', $red, $green, $blue);
            if(array_key_exists($thisRGB, $colors))
            {
                $colors[$thisRGB]++;
            }
            else
            {
                $colors[$thisRGB] = 1;
            }
        }
    }
    arsort($colors);
    return array_slice(array_keys($colors), 0, $numColors);
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

        <form class="nav_search" action="" method="post">
            <input class="form__input" type="text" name="search" id="search" placeholder="Search on tags" style="font-family:Arial, FontAwesome" />
            <input type="submit" name="searchsubmit" value="search">
        </form>

        <div class="links">
            <li><a class="active" href="index.php">Home</a></li>
            <li><a href="friendposts.php">Friend's posts</a></li>
            <li><a href="addpost.php">Add post</a></li>
            <li><a href="profile.php?user=<?php echo $_SESSION['userid']; ?>">Profile</a></li>
            <li><a href="logout.php">Log out</a></li>
        </div>
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
                <div class="post__picture"><img class="<?php echo $p['filter']; ?>" src="<?php echo $p['picture']; ?>" alt=""></div>
                <?php
                // HOOFD KLEUR VINDEN
                $image=imagecreatefromjpeg($p['picture']);
                $thumb=imagecreatetruecolor(1,1); imagecopyresampled($thumb,$image,0,0,0,0,1,1,imagesx($image),imagesy($image));
                $mainColor=strtoupper(dechex(imagecolorat($thumb,0,0)));

                $distances = array();
                $val = html2rgb($mainColor);
                foreach ($colors as $name => $c) {
                    $distances[$name] = distancel2($c, $val);
                }

                $mincolor = "";
                $minval = pow(2, 30); /*big value*/
                foreach ($distances as $k => $v) {
                    if ($v < $minval) {
                        $minval = $v;
                        $mincolor = $k;
                    }
                }
                ?>
                    <p>The main color in this Snapshot is  <?php echo $mincolor ?></p>


                <div class="flex">
                    <?php
                    // ALLE KLEUREN VINDEN
                    $palette = colorPalette($p['picture'], 5, 4);
                    foreach($palette as $color)
                    {
                       echo "<div class='colordiv' style='background-color:#$color;'>&nbsp;</div>";
                    }
                    ?>
                </div>
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
    /*
    var limit = 2;
    $('.btn_loadmore').on('click',function () {
        limit = limit + 2;
        $.ajax({
            url:"ajax/post_load.php",
            method: "POST",
            data:{limit:limit},
            success:function (data) {
                console.log(data);
                $(".post-container").html(data);
            }
        });
    });
    */
    var limit = 2;
    $('.btn_loadmore').on('click',function () {
        limit = limit + 2;
        $.ajax({
            url:"ajax/post_loadmore.php",
            method: "POST",
            data:{limit:limit},
            success:function (data) {
                console.log(data);

                $(".post_container").html(data);
            }
        });
    });







/*

    $('#search').keyup(function () {
        $keyword = $('#search').val();
        $.ajax({
            url:"ajax/post_search.php",
            method: "POST",
            data:{keyword:$keyword},
            success:function (data) {
                $(".post_container").html(data);
            }
        });
    });
*/
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


    function getURLParameter(url, name) {
        return (RegExp(name + '=' + '(.+?)(&|$)').exec(url)||[,null])[1];
    }

</script>
</html>


