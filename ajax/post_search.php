<?php
include_once("../classes/db.class.php");
include_once("../classes/Post.class.php");
session_start();
$userid = $_SESSION['userid'];
$output = strip_tags("");
$keyword = strip_tags($_POST['keyword']);
if(isset($keyword)){
    if($keyword != ""){
       $search = Post::SearchPosts(5,$userid,$keyword);
        foreach($search as $s) {
      
            $output.=' <div class="post">';
            $output .='<div class="post_desc"><p>'. $s['post_title'].'</p></div>';
            $output .='<div class="post__picture"><img src="'. $s['picture'].'" alt=""></div>';
            $output .='<div class="post_desc"><p>'. $s['description'].'</p></div>';
            $output .=' <div class="post_date">'. $s['post_date'].'</div>';
            $output .='</div>';

        };
        echo htmlspecialchars($output);
    }
}


?>


