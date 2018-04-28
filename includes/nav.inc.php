<nav>
    <ul>

        <li><img src="media/frontend/logo.svg" alt="Logo" ></li>
        <form class="nav_search" action="" method="post">
            <input type="text" name="search" id="search" placeholder="&#xF002; Search on tags" style="font-family:Arial, FontAwesome" />
        </form>
        <li><a class="active" href="index.php">Home</a></li>
        <li><a href="addpost.php">Add post</a></li>
        <li><a href="profile.php?user=<?php echo $_SESSION['userid']; ?>">Profile</a></li>
        <li><a href="logout.php">Log out</a></li>

    </ul>
</nav>