<?php
function canilogin( $username, $password){
    //OUDE MANIER WERKT
    $conn = new mysqli("localhost", "root", "root", "snapshot"); 
    $query = "select * FROM users WHERE email='".$conn->real_escape_string($username). "'";
    $result = $conn->query($query);
    

    /* $conn = new PDO('mysql:host=localhost; dbname=snapshot', 'root', 'root');

    //$query = "select * FROM users WHERE email='".$conn->real_escape_string($username). "'";
    $statement = $conn->prepare("select * from users where email = :username");
    $statement->bindValue(':username', $username);
    $statement->execute();
    $result = $statement->execute();
*/
    
    
    
    
    
    if($result->num_rows != 1){
        return false;
    }
        $user = $result->fetch_assoc();
        if(password_verify($password, $user['password'])){
            return true;
        }
    else{
        return false;
    } 
}
?>
