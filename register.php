<?php

include_once("classes/User.class.php");
try{

if( !empty ($_POST['firstname']) && !empty ($_POST['lastname']) && !empty ($_POST['username']) && !empty ($_POST['email']) && !empty ($_POST['password'])){
    if($_POST['password'] == $_POST['password_confirmation']) {
        $user = new User();
        $user->setFirstName(strip_tags($_POST['firstname']));
        $user->setLastName(strip_tags($_POST['lastname']));
        $user->setUsername(strip_tags($_POST['username']));
        $user->setEmail(strip_tags($_POST['email']));
        $user->setPassword(strip_tags($_POST['password']));
        $user->setAvatar(strip_tags(""));
        if($user->register()){
            $user->login();

        }
    }
    else{
        $error_confirmation = "Passwords don't match";

            }
        }
    }
    catch (Exception $e){
    $error_confirmation = $e->getMessage();
}
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - Snapshot</title>
    <meta name="description" content="snapshot" />
    <meta name="keywords" content="snapshot, imd" />
    <meta name="author" content="Lucas Debelder, Jasmina Dahou, Sander Verbesselt, Frederik Delaet" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:600,800|Open+Sans" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.0.4/js/all.js"></script>
    <link rel="stylesheet" type="text/css" href="css/reset.css" />
    <link rel="stylesheet" type="text/css" href="css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="css/master.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" href="https://cssgram-cssgram.netdna-ssl.com/cssgram.min.css">

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
            <h1>Get started absolutely free.</h1>
            <h2>Enter your details below.</h2>

                <div>
					<label for="firstname">FIRST NAME</label><br/>
					<input class="form__input" type="text" id="firstname" name="firstname" placeholder="Lucas" required>
                </div>
                <div>
					<label for="lastname">LAST NAME</label><br/>
					<input  class="form__input" type="text" id="lastname" name="lastname" placeholder="Debelder" required>
				</div>
                <div>
					<label for="email">USERNAME</label><br/>
					<input  class="form__input" type="text" id="username" name="username" placeholder="ZanicL3" required>
				</div>
				<div>
					<label for="email">EMAIL</label><br/>
					<input  class="form__input" type="email" id="email" name="email" placeholder="Lucasdebelder@snapshot.be" required>
				</div>

				<div>
					<label for="password">PASSWORD</label><br/>
					<input  class="form__input" type="password" id="password" name="password" placeholder="Atleast 8 characters" required>
                </div>
                <div>
                    <label for="password_confirmation">CONFIRM YOUR PASSWORD</label><br/>
                    <input  class="form__input" type="password" id="password_confirmation" name="password_confirmation" placeholder="Password confirm" required>
                </div>
                 <?php if(isset($error_confirmation)): ?>
                <div>
                    <p class="error_red">
                        <?php echo $error_confirmation ?>
                    </p>
                </div>
                <?php endif; ?>
                
				<div>
                    <input type="submit" value="REGISTER" class="btn_style">
                </div>
                
                <p class="center_align">Already have an account?</p>
                <br/>
                <a class="center_align" href="login.php">Login here.</a>

            </form>
    </div>

</body>
</html>


