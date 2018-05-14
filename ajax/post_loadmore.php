<?php
include_once("../classes/db.class.php");
include_once("../classes/Post.class.php");
session_start();
$output = "";
$limit = $_POST['limit'];
if(isset($limit)){
    if($limit != ""){
        $post = Post::ShowAllPosts($limit,$_SESSION['userid']);

       foreach($post as $p) {
            $tags = Post::ShowTags($p['id']);
            $output.=' <div class="post">';
            $output .='<div class="post__title"><h2>'. $p['post_title'].'</h2></div>';
            $output .='<div class="post__detail_top_grid">
                       <div class="post__user post__details"><h3>Posted by: <a href="profile.php?user='.$p['user_id'].'">'.$p['username'].'</a></h3></div>
                       <div class="post__date post__details"><p><span>Posted on: </span>'.$p['post_date'].'</p></div>
                       </div><div><form class="post_form post__detail_grid" action="" method="post">
                       <a class="post__reported post__link" href="index.php?reported='.$p['id'].'"><input type="button" class="post__link" value="Report"></a>
                       <a class="post__link" href="editpost.php?edit='.$p['id'].'"><input type="button" class="post__link" value="Edit"  name="edit"></a>
                            <a class="post__link" href="deletepost.php?delete='.$p['id'].'"><input type="button" class="post__link" value="Delete"  name="delete"></a>                 
                            </form></div>';
            $output .='<div class="post__picture"><img src="'. $p['picture'].'" alt=""></div>';
            $output .='<div class="post_desc"><p>'. $p['description'].'</p></div>

                <a class="" href="posts.php?post='.$p['id'].'"><button class="btn__confirm btn_post">View full post</button></a>
';
            $output .='</div>';


        };
        echo $output;

    }
}


?>



