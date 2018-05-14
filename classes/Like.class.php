<?php

include_once("Db.class.php");
include_once("Post.class.php");
include_once("User.class.php");

class Like {

    private $userid;
    private $postid;


    public function setPostid($postid)
    {
        $this->postid = $postid;
    }

    public function getPostid()
    {
        return htmlspecialchars($this->postid);
    }

    public function setUserid($userid)
    {
        $this->userid = $userid;
    }

    public function getUserid()
    {
        return htmlspecialchars($this->userid);
    }


    public function Addlike($postid, $userid){

        $conn = db::getInstance();
        $query = "insert into likes (post_id, user_id) values (:post_id, :user_id)";
        $statement = $conn->prepare($query);
        $statement->bindValue(':post_id',$postid);
        $statement->bindValue(':user_id',$userid);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public static function Removelike($postid, $userid){

        $conn = db::getInstance();
        $query = "delete from likes WHERE post_id = $postid AND user_id = $userid";
        $statement = $conn->prepare($query);
        $statement->execute();
    }

    public static function Countlike($postid){
        $conn = db::getInstance();
        $statement = $conn->prepare("SELECT * from likes WHERE post_id = $postid");
        $statement->execute();
        $count =  $statement->rowCount();
        return $count;
    }
    public static function Checklike($postid, $userid){
        $conn = db::getInstance();
        $statement = $conn->prepare("SELECT * from likes WHERE post_id = $postid AND user_id = $userid");
        $statement->execute();
        $count =  $statement->rowCount();
        return $count;
    }

}