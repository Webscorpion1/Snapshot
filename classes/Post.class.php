<?php

include_once("Db.class.php");


class Post {
    private $picture;
    private $description;
    private $date;
    private $location;
    private $user_id;
    private $title;
    private $tag;


    public function setTag($tag)
    {
        $this->tag = $tag;
    }

    public function getTag()
    {
        return $this->tag;
    }


    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setLocation($location)
    {
        $this->location = $location;
    }

    public function getLocation()
    {
        return $this->location;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

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

        $conn = db::getInstance();
        $query = "SELECT posts.id, posts.post_title, posts.picture ,posts.description, posts.location, posts.post_date, posts.user_id, users.username
                  FROM posts
                  INNER JOIN friends 
                  ON posts.user_id = friends.user1_id OR posts.user_id = friends.user2_id
                  INNER JOIN users
                  ON posts.user_id = users.id 
                  WHERE friends.user1_id='$userid' OR friends.user2_id='$userid'
                  ORDER BY posts.post_date DESC
                  LIMIT 40";
        $statement = $conn->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function AddPost(){

        $conn = db::getInstance();
        $query = "insert into posts (post_title, picture, description, location, user_id, post_date) values (:post_title, :picture, :description, :location, :user_id, :post_date)";
        $statement = $conn->prepare($query);
        $statement->bindValue(':post_title',$this->getTitle());
        $statement->bindValue(':picture',$this->getPicture());
        $statement->bindValue(':description',$this->getDescription());
        $statement->bindValue(':location',$this->getLocation());
        $statement->bindValue(':user_id',$this->getUserId());
        $statement->bindValue(':post_date',$this->getDate());
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function AddTags(){
        $conn = db::getInstance();
        $query = "insert into tags (tag_title, post_id) values (:tag_title, LAST_INSERT_ID())";
        $statement = $conn->prepare($query);
        $statement->bindValue(':tag_title',$this->getTag());
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public static function PostDetail(){
        $p_id = $_GET['post'];
        $conn = db::getInstance();
        $query = "SELECT * FROM posts WHERE id = '$p_id'";
        $statement = $conn->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
