<?php

include_once("Db.class.php");
include_once("Post.class.php");
include_once("User.class.php");

class Like extends Post {

    private $like;
    private $unlike;

    public function getLike()
    {
        return $this->like;
    }


    public function setLike($like)
    {
        $this->like = $like;
    }

    public function getUnlike()
    {
        return $this->unlike;
    }

    public function setUnlike($unlike)
    {
        $this->unlike = $unlike;
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
}