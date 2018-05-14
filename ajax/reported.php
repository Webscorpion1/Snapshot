<?php
include_once("../classes/Post.class.php");



try {
    $postid = strip_tags($_POST['postid']);
    $checkReport = Post::checkReported($postid);
    $post = new Post();
    $post->strip_tags(reported($postid));

    if ($checkReport[0]['reported'] > 1){
        $feedback['status'] = 'success';
        header('Content-Type: application/json');
        echo json_encode($feedback);
    }
}
catch(Exception $e) {

}


