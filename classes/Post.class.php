<?php

include_once("Db.class.php");


class Post {
    private $picture;
    private $description;
    private $date;

    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

    public function getPicture()
    {
        return $this->picture;
    }


    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getDate()
    {
        return $this->date;
    }

    public static function ShowPosts(){
        $userid = $_SESSION['userid'];
        echo $userid;
        $conn = db::getInstance();
        $query = "SELECT posts.picture ,posts.description, posts.location, posts.post_date
                  FROM posts
                  INNER JOIN friends 
                  ON posts.user_id = friends.user1_id OR posts.user_id = friends.user2_id
                  WHERE friends.user1_id='$userid' OR friends.user2_id='$userid'
                  ORDER BY posts.post_date DESC
                  LIMIT 5";
        $statement = $conn->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}