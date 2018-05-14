<?php
include_once("../classes/Comments.class.php");



try {
    session_start();
    $newComment = new Comments();
    $date = date("Y-m-d H:i:s");
    $userid = $_SESSION['userid'];
    $newComment->setComment($_POST['text']);
    $newComment->setDate($date);
    $newComment->setUserId($userid);
    $newComment->AddComment(strip_tags($_POST['postid']));
    $user = User::getSingleUser($newComment->getUserId());
    $username = $user[0]['username'];
    $feedback['status'] = 'success';
    $feedback['text'] = htmlspecialchars($newComment->getComment());
    $feedback['date'] = htmlspecialchars($newComment->getDate());
    $feedback['user'] = htmlspecialchars($username);


}
catch(Exception $e) {

}

header('Content-Type: application/json');
echo json_encode($feedback);
