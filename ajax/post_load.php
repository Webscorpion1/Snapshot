<?php
include_once("../classes/db.class.php");
include_once("../classes/Post.class.php");
session_start();
$post = Post::ShowPosts($_POST['limit'],$_SESSION['userid']);

foreach ($post as $p){

}

?>


