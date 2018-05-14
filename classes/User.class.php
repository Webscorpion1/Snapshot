<?php

include_once("Db.class.php");


 class User {
    private $firstname;
    private $lastname;
    private $username;
    private $email;
    private $password;
    private $avatar;
    private $descr;

     public function getDescr()
     {
         return htmlspecialchars($this->descr);
     }

     public function setDescr($descr)
     {
         $this->descr = $descr;
     }

     public function getAvatar()
     {
         return htmlspecialchars($this->avatar);
     }


     public function setAvatar($avatar)
     {
         $this->avatar = $avatar;
     }

    public function setFirstname($firstname)
     {
         $this->firstname = $firstname;
     }


     public function getFirstname()
     {
         return htmlspecialchars($this->firstname);
     }

     public function setLastname($lastname)
     {
         $this->lastname = $lastname;
     }


     public function getLastname()
     {
         return htmlspecialchars($this->lastname);
     }


    public function setUsername($username)
    {
        $conn = db::getInstance();
        $sthandler = $conn->prepare("SELECT username FROM users WHERE username = :username");
        $sthandler->bindParam(':username', $username);
        $sthandler->execute();
        if($sthandler->rowCount() > 0){
            throw  new Exception("Username already exists.");
        }
        if(strlen($username) < 4){
            throw  new Exception("Username must be at least 4 characters long.");
        }
        $this->username = $username;
    }


    public function getUsername()
    {
        return htmlspecialchars($this->username);
    }


    public function setEmail($email)
    {
        $conn = db::getInstance();
        $sthandler = $conn->prepare("SELECT email FROM users WHERE email = :email");
        $sthandler->bindParam(':email', $email);
        $sthandler->execute();
        if($sthandler->rowCount() > 0){
            throw  new Exception("E-mail already exists.");
        }

        $this->email = $email;
    }


    public function getEmail()
    {
        return htmlspecialchars($this->email);
    }

     public function setPassword($password)
     {
         if(strlen($password) < 8){
             throw  new Exception("Password must be at least 8 characters long.");
         }

         $hash = password_hash($password,PASSWORD_DEFAULT);// standaard 10 keer als je geen options mee geeft
         $this->password = $hash;
         return htmlspecialchars($this);
     }
     public function getPassword()

     {
         return htmlspecialchars($this->password);
     }

     public function register(){
         $conn = db::getInstance();
         $statement = $conn->prepare("insert into users (firstname, lastname, username, email, password, avatar) values(:firstname,:lastname,:username,:email,:password,:avatar)");
         $statement->bindParam(':firstname',$this->firstname);
         $statement->bindParam(':lastname',$this->lastname);
         $statement->bindParam(':username',$this->username);
         $statement->bindParam(':email',$this->email);
         $statement->bindParam(':password',$this->password);
         $statement->bindParam(':avatar',$this->avatar);
         $result = $statement->execute();
         return $result;
     }

     public function login()
     {
         session_start();
         $_SESSION['loggedin'] = true;
         header('Location: index.php');
     }
     public function editprofile($userid){


         $conn = db::getInstance();
         $statement = $conn->prepare("update users set avatar = :avatar, description = :descr, email = :email, password = :password WHERE  id = $userid");
         $statement->bindParam(':avatar',$this->avatar);
         $statement->bindParam(':descr',$this->descr);
         $statement->bindParam(':email',$this->email);
         $statement->bindParam(':password',$this->password);
         $result = $statement->execute();
         return $result;
     }
     public static function canilogin( $email, $password){

         $conn = db::getInstance();
         $statement = $conn->prepare("select * from users where email = :email");
         $statement->bindValue(':email', $email);
         $statement->execute();
         $result = $statement;



         if($result->rowCount() != 1){
             return false;
         }
         $user = $result->fetch(PDO::FETCH_ASSOC);
         if(password_verify($password, $user['password'])){
             session_start();
             $_SESSION['userid']= $user['id'];
             return true;
         }
         else{
             return false;
         }

     }

     public static function checklogin()
     {

         session_start();
         if (!isset($_SESSION['loggedin'])) {
             header('Location: login.php');
         }

     }
     public static function getUser(){
         $conn = db::getInstance();
         $id = $_GET['user'];
         $query = "SELECT * FROM users WHERE id = '$id'";
         $statement = $conn->prepare($query);
         $statement->execute();
         $result = $statement->fetchAll(PDO::FETCH_ASSOC);
         return $result;
     }
     public function follow($user, $friend){
         $conn = db::getInstance();
         $statement = $conn->prepare("insert into friends (user1_id, user2_id) values(:user1,:user2)");
         $statement->bindParam(':user1',$user);
         $statement->bindParam(':user2',$friend);
         $result = $statement->execute();
         return $result;
     }
     public static function checkFollow($user, $friend){
         $conn = db::getInstance();
         $query = "SELECT * FROM friends WHERE user1_id = $user AND user2_id = $friend";
         $statement = $conn->prepare($query);
         $statement->execute();
         $count =  $statement->rowCount();

         if ( $count > 0) {
             return true;
         }else{
             return false;
         }
     }
     public static function unFollow($user, $friend){
         $conn = db::getInstance();
         $query = "DELETE FROM friends WHERE user1_id = $user AND user2_id = $friend";
         $statement = $conn->prepare($query);
         $statement->execute();
     }
 }
 ?>