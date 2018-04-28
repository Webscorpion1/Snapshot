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
<?php include_once("includes/nav.inc.php"); ?>
<form action="" method="post" enctype="multipart/form-data">
    <h1 form__title>Update account</h1>

    <!-- Profiel foto -->
    <div>
        <label for="photo">UPDATE PROFILE PICTURE</label><br/>
        <input type="file" class="fileToUpload" name="photo" placeholder="">
    </div>

    <!-- Bio/descriptie -->
    <div>
        <label for="bio">UPDATE/EDIT BIO</label><br/>
        <input type="text" id="bio" name="bio" placeholder="">
    </div>

    <!-- Bio/descriptie -->
    <div>
        <label for="change_password">CHANGE PASSWORD</label><br/>
        <input type="password" id="change_password" name="change_password" placeholder="">
    </div>

    <!-- Bio/descriptie -->
    <div>
        <label for="change_email">CHANGE EMAIL</label><br/>
        <input type="email" id="change_email" name="change_email" placeholder="">
    </div>

    <!-- RETYPE PASSWORD -->
    <div>
        <label for="confirmation_pw">TYPE IN THE CURRENT PASSWORD TO VERIFY</label><br/>
        <input style="background-color: rgba(247, 129, 34, 0.1);" type="password" id="confirmation_pw" name="confirmation_pw" placeholder="">
    </div>

    <div>
        <input type="submit" name="submit" value="SAVE PROFILE" class="btn_login">
    </div>
    </form>
    </body>

        </html>
