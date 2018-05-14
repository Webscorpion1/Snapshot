<?php
include_once("../classes/Comments.class.php");



try {
    session_start();
    $newComment = new Comments();
    $date = date("Y-m-d H:i:s");
    $userid = $_SESSION['userid'];
    $newComment->setComment(strip_tags($_POST['text']));
    $newComment->setDate(strip_tags($date));
    $newComment->setUserId(strip_tags($userid));
    $newComment->AddComment(strip_tags($_POST['postid']));

    $feedback['status'] = 'success';
    $feedback['text'] = htmlspecialchars($newComment->getComment());
}
catch(Exception $e) {

}

header('Content-Type: application/json');
echo json_encode($feedback);
