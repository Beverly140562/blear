<div id="friends">

    <?php 
        
        $image = "images/default-profile.jpg";
        if($FRIEND_ROW['userid'] == "Female/Male")
        {
            $image = "images/default-profile.jpg";
        }

        if(file_exists($FRIEND_ROW['profile_image']))
        {
            $image = $image_class->get_thumb_profile($FRIEND_ROW['profile_image']);
        }
    ?>

    <a href="profile.php?id=<?php echo $FRIEND_ROW['userid'];?>">
        <img id="friends_img"src="<?php echo $image ?>">
        <br>
        
        <?php echo $FRIEND_ROW['name'] ?>
    </a>
    </div>