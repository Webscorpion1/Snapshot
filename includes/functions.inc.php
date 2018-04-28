<?php
function canilogin( $email, $password){
    //OUDE MANIER WERKT
    //$conn = new mysqli("localhost:3310", "root", "root", "snapshot");
    //$query = "select * FROM users WHERE email='".$conn->real_escape_string($email). "'";
    //$result = $conn->query($query);
    

    $conn = new PDO('mysql:host=localhost; dbname=snapshot', 'root', 'root');

    //$query = "select * FROM users WHERE email='".$conn->real_escape_string($email). "'";
    $statement = $conn->prepare("select * from users where email = :email");
    $statement->bindValue(':email', $email);
    $statement->execute();
    $result = $statement;


    /*if($result->num_rows != 1){
        return false;
    }
        $user = $result->fetch_assoc();
        if(password_verify($password, $user['password'])){
            return true;
        }
    else{
        return false;
    } */
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

function checklogin()
{
    session_start();
    if (!isset($_SESSION['loggedin'])) {
        header('Location: login.php');
    }
}
?>
