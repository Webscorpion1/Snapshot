<?php

include_once ("classes/Db.class.php");
include_once ("classes/User.class.php");


if(!empty($_POST)){
    $email = $_POST['email'];
    $password = $_POST['password'];


    if(User::canilogin($email, $password)){
        session_start();
        $_SESSION['email'] = $email;
        $_SESSION['loggedin'] = true;
        header('Location: index.php');
    }
    else{
        $error = true;

    }
}



?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log in - Snapshot</title>
    <meta name="description" content="snapshot" />
    <meta name="keywords" content="snapshot, imd" />
    <meta name="author" content="Lucas Debelder, Jasmina Dahou, Sander Verbesselt, Frederik Delaet" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:600,800|Open+Sans" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.0.4/js/all.js"></script>
    <link rel="stylesheet" type="text/css" href="css/reset.css" />
    <link rel="stylesheet" type="text/css" href="css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="css/master.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    
    <meta property="og:url" content="">
    <meta property="og:type" content=""/>
    <meta property="og:title" content=""/>
    <meta property="og:description" content=""/>
    <meta property="og:image" content=""/>
    
    
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="">
    <meta name="twitter:creator" content="">
    <meta name="twitter:title" content="">
    <meta name="twitter:description" content=" ">
    <meta name="twitter:image" content=""> 
    
</head>

<body class="login">
    <div class="grid container_login">
        <div class="login_grid">

            <form class="form_login" action="" method="post">
            <h1>Sign in to Snapshot.</h1>
            <h2>Enter your details below.</h2>

                <?php if( isset($error) ): ?>
				<div class="form__error">
					<p>
						Sorry, we can't log you in with that email address and password. Can you try again?
					</p>
				</div>
                <?php endif;?>

				<div>
					<label for="email">EMAIL</label><br/>
					<input type="text" id="email" name="email" placeholder="Lucasdebelder@snapshot.be" required>
				</div>
				<div>
					<label for="password">PASSWORD</label><br/>
					<input type="password" id="password" name="password" placeholder="Atleast 8 characters" required>
				</div>

                
				<div>
                    <input type="submit" value="LOG IN" class="btn_login">
                    <!-- REMEMBER ME - kunnen we later nog toevoegen? 
                    <input type="checkbox" id="rememberMe"><label for="rememberMe" class="label__inline">Remember me</label>
                    -->
                </div>
                
                <p class="center_align">Or</p>
                <br/>
                <a class="center_align" href="register.php">Register here.</a>

            </form>
    </div>
</body>
</html>


