<?php
include_once('classes/Post.class.php');
include_once('classes/User.class.php');

User::checklogin();
$post = Post::ShowPosts(0,$_SESSION['userid']);

if(! empty($_POST)) {

    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    if (in_array($fileActualExt, $allowed)){
        if ($fileError === 0){
            if ($fileSize < 10000000){
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileDestination = 'uploads/'.$fileNameNew;
                print_r($fileDestination);
                move_uploaded_file($fileTmpName, $fileDestination);
                $feedback = "Post has been saved.";
                $title = $_POST['title'];
                $desc = $_POST['description'];
                $filter = $_POST['filter'];
                $date = date("Y-m-d H:i:s");
                $location = "";
                $userid = $_SESSION['userid'];
                $newPost = new Post();

                $newPost->setTitle($title);
                $newPost->setPicture($fileDestination);
                $newPost->setDescription($desc);
                $newPost->setDate($date);
                $newPost->setUserId($userid);
                $newPost->setLocation($location);
                $newPost->setFilter($filter);
                $newPost->AddPost();
                $postId = Post::getLastId();


                $string = $_POST['tag'];
                $tags = explode(',' , $string);

                foreach($tags as $t) {
                    $newPost->setTag($t);
                    $newPost->AddTags($postId);
                }

            } else{
                $feedback = "Your file is too big.";
            }
        } else{
            $feedback = "There was an error uploading your file.";
        }
    } else{
        $feedback = "You cannot upload files of this type.";
    }



}
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add post - Snapshot</title>
    <meta name="description" content="snapshot" />
    <meta name="keywords" content="snapshot, imd" />
    <meta name="author" content="Lucas Debelder, Sander Verbesselt, Frederik Delaet" />
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

<body>
<nav>
    <ul>

        <li><img src="media/frontend/logo.svg" alt="Logo" ></li>
        <li><a href="index.php">Home</a></li>
        <li><a href="friendposts.php">Friend's posts</a></li>
        <li><a class="active" href="addpost.php">Add post</a></li>
        <li><a href="profile.php?user=<?php echo $_SESSION['userid']; ?>">Profile</a></li>
        <li><a href="logout.php">Log out</a></li>

    </ul>
</nav>

<form action="" method="post" enctype="multipart/form-data">

    <h1 form__title>Add post</h1>
    <?php  if(isset($feedback)): ?>
        <div class="feedback">
            <p><?php echo $feedback; ?></p>
        </div>
    <?php endif; ?>
    <div class="form__field">
        <label for="title" class="label">YOUR SHOT TITLE:</label> <br/>
        <input class="form__input" type="text" name="title">
    </div>
    <div class="form__field">
        <label for="file" class="label">UPLOAD PICTURE</label><br/>
        <input class="form__input" type="file" name="file" class="fileToUpload" onchange="showIMG(this);">
        <img id="preview" src="#" alt="Snapshot preview" />
    </div>
    <div class="form__field">
        <label for="description" class="label">DESCRIPTION</label><br/>
        <textarea name="description" cols="25" rows="5"></textarea>
    </div>

    <div class="form__field">
        <label for="tag" class="label">ADD SOME TAGS TO YOUR SHOT (seperated with , )</label><br/>
        <input class="form__input" type="text" name="tag">
    </div>

    <p>JPG, GIF or PNG. Snapshots are 400 × 300 pixels or 800 × 600 (for HiDPI displays). </p><br/><br/>

    <div class="form__field">
        <label for="tag" class="label">ADD ONE (Instagram) FILTER TO YOUR SHOT </label><br/>

        <select name="filter">
            <option value="no_filter">-None-</option>
            <option value="_1977">1977</option>
            <option value="aden">aden</option>
            <option value="brannan">brannan</option>
            <option value="brooklyn">brooklyn</option>
            <option value="clarendon">clarendon</option>
            <option value="earlybird">earlybird</option>
            <option value="gingham">gingham</option>
            <option value="hudson">hudson</option>
            <option value="inkwell">inkwell</option>
            <option value="kelvin">kelvin</option>
            <option value="lark">lark</option>
            <option value="lofi">lofi</option>
            <option value="maven">maven</option>
            <option value="mayfair">mayfair</option>
            <option value="moon">moon</option>
            <option value="nashville">nashville</option>
            <option value="perpetua">perpetua</option>
            <option value="reyes">reyes</option>
            <option value="rise">rise</option>
            <option value="slumber">slumber</option>
            <option value="stinson">stinson</option>
            <option value="toaster">toaster</option>
            <option value="valencia">valencia</option>
            <option value="walden">walden</option>
            <option value="willow">willow</option>
            <option value="xpro2">xpro2</option>
        </select>
    </div>

    <div class="form__field">
        <input class="btn_style" type="submit" name="submit" value="Add post"">
    </div>
</form>


</body>
<script>
    function showIMG(input) {
        document.getElementById("preview").style.display = "block";
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#preview')
                    .attr('src', e.target.result)
                    .style.display = "block";
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    var selectElem = document.querySelector('.form__field select');

    selectElem.onchange = function() {
        document.querySelector('#preview').className = this.value;
    }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</html>


