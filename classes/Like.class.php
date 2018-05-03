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
        return $this->postid;
    }

    public function setUserid($userid)
    {
        $this->userid = $userid;
    }

    public function getUserid()
    {
        return $this->userid;
    }


    public function Addlike($postid){

        $conn = db::getInstance();
        $query = "insert into likes (post_id, user_id) values (:post_id, :user_id)";
        $statement = $conn->prepare($query);
        $statement->bindValue(':post_id',$postid);
        $statement->bindValue(':user_id',$this->getUserId());
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function Removelike($postid){

        $conn = db::getInstance();
        $query = "delete from likes (post_id, user_id) values (:post_id, :user_id)";
        $statement = $conn->prepare($query);
        $statement->bindValue(':post_id',$postid);
        $statement->bindValue(':user_id',$this->getUserId());
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public static function Countlike(){
        $conn = db::getInstance();
        $statement = $conn->prepare("SELECT * from likes");
        $statement->execute();
        $likecount =  $statement->rowCount();
        return $likecount;
    }

}