<nav>
    <ul>
        <li><img src="media/frontend/logo.svg" alt="Logo" ></li>
        <li><a class="active" href="index.php">Home</a></li>
        <li><a href="addpost.php">Add post</a></li>
        <li><a href="profile.php?user=<?php echo $_SESSION['userid']; ?>">Profile</a></li>
        <li><a href="logout.php">Log out</a></li>
        <form action="" method="post">
            <input type="text" name="search" id="search" placeholder="">
            <input type="submit" name="submit" value="SEARCH">
        </form>
    </ul>
</nav>