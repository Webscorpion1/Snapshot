<?php

include_once("Db.class.php");
include_once("Post.class.php");
include_once("User.class.php");

class Comments extends Post{

    private $Comment;


    public function getComment()
    {
        return $this->Comment;
    }

    public function setComment($Comment)
    {
        $this->Comment = $Comment;
    }

    public function AddComment(){

        $conn = db::getInstance();
        $query = "insert into comments (comment, user_id, post_date) values (:comment, :user_id, :post_date)";
        $statement = $conn->prepare($query);
        $statement->bindValue(':comment',$this->getComment());
        $statement->bindValue(':user_id',$this->getUserId());
        $statement->bindValue(':post_date',$this->getDate());
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

}