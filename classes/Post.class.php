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
    private $reported;
    private $filter;


    public function getFilter()
    {
        return htmlspecialchars($this->filter);
    }


    public function setFilter($filter)
    {
        $this->filter = $filter;
    }

    public function setReported($reported)
    {
        $this->reported = $reported;
    }

    public function getReported()
    {
        return htmlspecialchars($this->reported);
    }


    public function setTag($tag)
    {
        $this->tag = $tag;
    }

    public function getTag()
    {
        return htmlspecialchars($this->tag);
    }


    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return htmlspecialchars($this->title);
    }

    public function setLocation($location)
    {
        $this->location = $location;
    }

    public function getLocation()
    {
        return htmlspecialchars($this->location);
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getUserId()
    {
        return htmlspecialchars($this->user_id);
    }

    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

    public function getPicture()
    {
        return htmlspecialchars($this->picture);
    }


    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return htmlspecialchars($this->description);
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getDate()
    {
        return htmlspecialchars($this->date);
    }

    public static function ShowPosts($limit, $userid){
        $conn = db::getInstance();
        $query = "SELECT posts.id, posts.post_title, posts.picture, posts.description, posts.filter, posts.location, posts.post_date, posts.user_id, users.username
                  FROM posts
                  INNER JOIN friends 
                  ON posts.user_id = friends.user2_id
                  INNER JOIN users
                  ON posts.user_id = users.id 
                  WHERE $userid = friends.user1_id 
                  AND posts.reported < 3
                  ORDER BY posts.post_date DESC
                  LIMIT $limit";
        $statement = $conn->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public static function ShowAllPosts($limit, $userid){
        $conn = db::getInstance();
        $query = "SELECT posts.id, posts.post_title, posts.picture, posts.description, posts.filter, posts.location, posts.post_date, posts.user_id, users.username
                  FROM posts               
                  INNER JOIN users
                  ON posts.user_id = users.id            
                  WHERE posts.reported < 3
                  ORDER BY posts.post_date DESC
                  LIMIT $limit";
        $statement = $conn->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public static function SearchAllPosts($limit, $userid, $keyword){
        $conn = db::getInstance();
        $query = "SELECT posts.id, posts.post_title, posts.picture, posts.description, posts.filter, posts.location, posts.post_date, posts.user_id, users.username, tags.tag_title
                  FROM posts
                  INNER JOIN users
                  ON posts.user_id = users.id 
                  INNER JOIN tags
                  ON posts.id = tags.post_id
                  WHERE posts.reported < 3
                  AND tags.tag_title = '$keyword'
                  ORDER BY posts.post_date DESC
                  LIMIT $limit";
        $statement = $conn->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public static function SearchFriendsPosts($limit, $userid, $keyword){
        $conn = db::getInstance();
        $query = "SELECT posts.id, posts.post_title, posts.picture, posts.description, posts.filter, posts.location, posts.post_date, posts.user_id, users.username, tags.tag_title
                  FROM posts
                  INNER JOIN users
                  ON posts.user_id = users.id 
                  INNER JOIN friends 
                  ON posts.user_id = friends.user2_id
                  INNER JOIN tags
                  ON posts.id = tags.post_id
                  WHERE posts.reported < 3
                  AND tags.tag_title = '$keyword'
                  AND $userid = friends.user1_id 
                  ORDER BY posts.post_date DESC
                  LIMIT $limit";
        $statement = $conn->prepare($query);

        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }



    public function AddPost(){

        $conn = db::getInstance();
        $query = "insert into posts (post_title, picture, description, filter, location, user_id, post_date) values (:post_title, :picture, :description, :filter, :location,  :user_id, :post_date)";
        $statement = $conn->prepare($query);
        $statement->bindValue(':post_title',$this->getTitle());
        $statement->bindValue(':picture',$this->getPicture());
        $statement->bindValue(':description',$this->getDescription());
        $statement->bindValue(':filter', $this->getFilter());
        $statement->bindValue(':location',$this->getLocation());
        $statement->bindValue(':user_id',$this->getUserId());
        $statement->bindValue(':post_date',$this->getDate());
        $statement->execute();

    }
    public static function getLastId(){
        $conn = db::getInstance();
        $query = "SELECT from posts LAST_INSERT_ID";
        $statement = $conn->prepare($query);
        $statement->execute();
        return $conn->lastInsertId();;
    }
    public function AddTags($postid){
        $conn = db::getInstance();
        $query = "insert into tags (tag_title, post_id) values (:tag_title, :post_id)";
        $statement = $conn->prepare($query);
        $statement->bindValue(':tag_title',$this->getTag());
        $statement->bindValue(':post_id',$postid);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public static function PostDetail(){
        $conn = db::getInstance();
        $query = "SELECT posts.id, posts.post_title, posts.picture, posts.filter, posts.description, posts.location, posts.reported, posts.post_date, users.username
                  FROM posts 
                  INNER JOIN users
                  ON posts.user_id=users.id
                  WHERE posts.id = :post_id";
        $statement = $conn->prepare($query);
        $statement->bindValue(':post_id', $_GET['post']);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public static function DeleteTags($delete){
        $conn = db::getInstance();
        $query = "DELETE FROM tags WHERE post_id=:id";
        $statement = $conn->prepare($query);
        $statement->bindValue(':id',$delete,PDO::PARAM_INT);
        $statement->execute();
    }
    public static function DeletePost($delete){
        $conn = db::getInstance();
        $query = "DELETE FROM posts WHERE id=:id";
        $statement = $conn->prepare($query);
        $statement->bindValue(':id',$delete,PDO::PARAM_INT);
        $statement->execute();

    }
    public static function editPost($id, $title, $desc){
        $conn = db::getInstance();
        $query = "UPDATE posts 
                  SET post_title = :title,
                      description = :description  
                  WHERE id=:id";
        $statement = $conn->prepare($query);
        $statement->bindParam(':id',$id);
        $statement->bindParam(':title',$title);
        $statement->bindParam(':description',$desc);
        $statement->execute();
    }
    public static function showEditPost($id){
        $conn = db::getInstance();
        $query = "SELECT * FROM posts WHERE id = :id";
        $statement = $conn->prepare($query);
        $statement->bindParam(':id',$id);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function reported($postid){
        $conn = db::getInstance();
        $query = "UPDATE posts 
                  SET    reported=reported+1
                  WHERE id=$postid";
        $statement = $conn->prepare($query);
        $statement->execute();
    }
    public static function checkReported($postid){
        $conn = db::getInstance();
        $query = "SELECT * FROM posts WHERE id = $postid";
        $statement = $conn->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public static function ShowTags($postid){
        $conn = db::getInstance();
        $query = "SELECT tags.tag_title
                  FROM tags
                  INNER JOIN posts
                  ON tags.post_id = posts.id 
                  WHERE posts.id = :postid";
        $statement = $conn->prepare($query);
        $statement->bindParam(':postid',$postid);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

}
