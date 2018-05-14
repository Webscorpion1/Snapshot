<?php
include_once("../classes/db.class.php");
include_once("../classes/Post.class.php");
session_start();
$userid = $_SESSION['userid'];
$output = strip_tags("");
$limit = strip_tags($_POST['limit']);
if(isset($limit)){
    if($limit != ""){
        $post = Post::ShowPosts($limit,$userid);

       foreach($post as $p) {

            $output.=' <div class="post">';
            $output .='<div class="post_desc"><p>'. $p['post_title'].'</p></div>';
            $output .='<div class="post__picture"><img src="'. $p['picture'].'" alt=""></div>';
            $output .='<div class="post_desc"><p>'. $p['description'].'</p></div>';
            $output .=' <div class="post_date">'. $p['post_date'].'</div>';
            $output .='</div>';


        };
        echo htmlspecialchars($output);

    }
}


?>



