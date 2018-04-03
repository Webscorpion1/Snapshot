<?php

//das hier voor die DB connectie met arrays ma sander moet ge ff manueel aanpassen werkt ni juist 100% en wij hebbn da nie echt nodig tbh
//include_once("../settings/settings.php");

 class User {
    private $firstname;
    private $lastname;
    private $username;
    private $email;
    private $password;



    public function setFirstname($firstname)
     {
         $this->firstname = $firstname;
     }


     public function getFirstname()
     {
         return $this->firstname;
     }

     public function setLastname($lastname)
     {
         $this->lastname = $lastname;
     }


     public function getLastname()
     {
         return $this->lastname;
     }


    public function setUsername($username)
    {
        $this->username = $username;
    }


    public function getUsername()
    {
        return $this->username;
    }


    public function setEmail($email)
    {
        $this->email = $email;
    }


    public function getEmail()
    {
        return $this->email;
    }

     public function setPassword($password)
     {
         //encrypten van het password
         $hash = password_hash($password,PASSWORD_DEFAULT);// standaard 10 keer als je geen options mee geeft
         $this->password = $hash;
         return $this;
     }
     public function getPassword()
     {
         return $this->password;
     }

     public function register(){
        //connection
         $conn = new PDO('mysql:host=localhost; dbname=snapshot', 'root', 'root');
         //$conn = new PDO("mysql:host=".['host'].['port'].";dbname=".['dbname'], ['username'], ['password']);
         //query (insert)
         $statement = $conn->prepare("insert into users (firstname, lastname, username, email, password) values(:firstname,:lastname,:username,:email,:password)");
         $statement->bindParam(':firstname',$this->firstname);
         $statement->bindParam(':lastname',$this->lastname);
         $statement->bindParam(':username',$this->username);
         $statement->bindParam(':email',$this->email);
         $statement->bindParam(':password',$this->password);
         //execute
         $result = $statement->execute();
         //return true/false
         return $result;
     }
     /*
      * start a new session and redirect a user
      * @return: null
      */
     public function login()
     {
         session_start();
         $_SESSION['loggedin'] = true;
         header('Location: index.php');
     }
 }
 ?>