<?php
include("includes/header.php");

?>
    <h1>Hello!</h1>
    <div class = "user_details column">
        <a href="#"><img src="<?php echo $user['profile_pic']; ?>" alt="profile_pic"></a><br>

        <a href="#">
        <?php 
        echo $user['first_name'] . " " . $user['last_name']
        ?><br>
        <?php echo "Posts: " . $user['num_post'];?><br>
        <?php echo "Likes: " . $user['num_likes'];?><br>
        </a>
    </div>
</div>
</body>
</html>