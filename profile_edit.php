<?php
include_once("classes/User.class.php");


User::checklogin();
if (!empty ($_POST)) {
    $file = $_FILES['photo'];
    $fileName = $_FILES['photo']['name'];
    $fileTmpName = $_FILES['photo']['tmp_name'];
    $fileSize = $_FILES['photo']['size'];
    $fileError = $_FILES['photo']['error'];
    $fileType = $_FILES['photo']['type'];
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

if (in_array($fileActualExt, $allowed)) {
    if ($fileError === 0) {
        if ($fileSize < 10000) {
            $fileNameNew = uniqid('', true) . "." . $fileActualExt;
            $fileDestination = 'uploads/' . $fileNameNew;
            print_r($fileDestination);
            move_uploaded_file($fileTmpName, $fileDestination);

            $user = new User();
            if ($_POST['confirmation_pw'] == $user->getPassword()) {
            }
            $user->setEmail($_POST['change_email']);
            $user->setAvatar($fileDestination);
            $user->setDescr($_POST['bio']);
            $user->setPassword($_POST['change_password']);
            $user->editprofile();
            header('Location: index.php');
        }
    }
}
}

?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Account - Snapshot</title>
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
<nav>
    <ul>

        <li><img src="media/frontend/logo.svg" alt="Logo" ></li>
        <form class="nav_search" action="" method="post">
            <input type="text" name="search" id="search" placeholder="&#xF002; Search on tags" style="font-family:Arial, FontAwesome" />
        </form>
        <li><a href="index.php">Home</a></li>
        <li><a href="addpost.php">Add post</a></li>
        <li><a class="active" href="profile.php?user=<?php echo $_SESSION['userid']; ?>">Profile</a></li>
        <li><a href="logout.php">Log out</a></li>

    </ul>
</nav>
<form action="" method="post" enctype="multipart/form-data">
    <h1 form__title>Update account</h1>

    <!-- Profiel foto -->
    <div>
        <label for="photo">UPDATE PROFILE PICTURE</label><br/>
        <input  class="form__input"  type="file" class="fileToUpload" name="photo" placeholder="">
    </div>

    <!-- Bio/descriptie -->
    <div>
        <label for="bio">UPDATE/EDIT BIO</label><br/>
        <input  class="form__input" type="text" id="bio" name="bio" placeholder="">
    </div>

    <!-- Bio/descriptie -->
    <div>
        <label for="change_password">CHANGE PASSWORD</label><br/>
        <input  class="form__input" type="password" id="change_password" name="change_password" placeholder="">
    </div>

    <!-- Bio/descriptie -->
    <div>
        <label for="change_email">CHANGE EMAIL</label><br/>
        <input  class="form__input" type="email" id="change_email" name="change_email" placeholder="">
    </div>

    <!-- RETYPE PASSWORD -->
    <div>
        <label for="confirmation_pw">TYPE IN THE CURRENT PASSWORD TO VERIFY</label><br/>
        <input  class="form__input" style="background-color: rgba(247, 129, 34, 0.1);" type="password" id="confirmation_pw" name="confirmation_pw" placeholder="">
    </div>

    <div>
        <input  class="form__input" type="submit" name="submit" value="SAVE PROFILE" class="btn_style">
    </div>
    </form>
    </body>

        </html>
