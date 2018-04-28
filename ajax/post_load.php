<?php
include_once("../classes/db.class.php");
session_start();
$userid = $_SESSION['userid'];
$output = "";
$limit = $_POST['limit'];
if(isset($limit)){
    if($limit != ""){
        $conn = db::getInstance();
        $query ="SELECT posts.id, posts.post_title, posts.picture ,posts.description, posts.location, posts.post_date
                  FROM posts
                  INNER JOIN friends 
                  ON posts.user_id = friends.user1_id OR posts.user_id = friends.user2_id
                  WHERE friends.user1_id='$userid' OR friends.user2_id='$userid'
                  ORDER BY posts.post_date DESC
                  LIMIT $limit";
        $result = $conn->prepare($query);
        $result->execute();

        while($row = $result->fetch()) {

            $output.=' <div class="post">';
            $output .='<div class="post_desc"><p>'. $row['post_title'].'</p></div>';
            $output .='<div class="post__picture"><img src="'. $row['picture'].'" alt=""></div>';
            $output .='<div class="post_desc"><p>'. $row['description'].'</p></div>';
            $output .=' <div class="post_date">'. $row['post_date'].'</div>';
            $output .='</div>';


        };
        echo $output;
    }
}
else{

}

?>


