<?php
include_once("../classes/Comments.class.php");

$newComment = new Comments();

try {

    $date = date("Y-m-d H:i:s");
    $userid = $_SESSION['userid'];

    $newComment->setComment( $_POST['comment'] );
    $newComment->setDate($date);
    $newComment->setUserId($userid);
    $newComment->AddComment($_GET['post']);


    $feedback['status'] = 'succes';
    $feedback['text'] = htmlspecialchars($newComment->getComment());
}
catch(Exception $e) {

}

header('Content-Type: application/json');
echo json_encode($feedback);
