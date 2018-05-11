<?php
include_once("../classes/db.class.php");
session_start();
$userid = $_SESSION['userid'];
$output = "";
$keyword = $_POST['keyword'];
if(isset($keyword)){
    if($keyword != ""){
        $conn = db::getInstance();

        $query ="SELECT posts.id, posts.post_title, posts.picture ,posts.description, posts.location, posts.post_date, tags.tag_title
                  FROM posts
                  INNER JOIN friends 
                  ON posts.user_id = friends.user1_id OR posts.user_id = friends.user2_id
                  INNER JOIN tags
                  ON posts.id = tags.post_id
                  WHERE (friends.user1_id='$userid' OR friends.user2_id='$userid')
                  AND tags.tag_title = '$keyword'
                  ORDER BY posts.post_date DESC
                  LIMIT 5";
        $result = $conn->prepare($query);
        $result->execute();

        while($row = $result->fetch()) {
            $output.=' <a href="posts.php?post="'.$row['id'].'">';
            $output.=' <div class="post">';
            $output .='<div class="post_desc"><p>'. $row['post_title'].'</p></div>';
            $output .='<div class="post__picture"><img src="'. $row['picture'].'" alt=""></div>';
            $output .='<div class="post_desc"><p>'. $row['description'].'</p></div>';
            $output .=' <div class="post_date">'. $row['post_date'].'</div>';
            $output .='</div>';
            $output.='</a>';
        };
        echo $output;
    }
}
else{

}

?>


