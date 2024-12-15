
<div id="post">
    <div>
        <?php 
        
            $image = "images/default-profile.jpg";
            if($ROW_USER['userid'] == "Male")
            {
                $image = "images/default-profile.jpg";
            }

            if (empty($ROW_USER['profile_image']) || !file_exists($ROW_USER['profile_image'])) {
                $image = "images/default-profile.jpg";  // Default image if none exists or file doesn't exist
            } else {
                $image = $ROW_USER['profile_image'];  // Use the user's profile image
            }
        ?>
        <img src="<?php echo $image ?>" style="width:75px;margin-right:4px;">
    </div>
    <div style="width:100%;">
        <div style="font-weight:bold;color:#405d9b; width:100%;">
            <?php echo htmlspecialchars($ROW_USER['name']);
            
            
            ?>
            
        </div>
        <?php echo htmlspecialchars($ROW['post']) ?>
        <br><br>

        <?php

        if(file_exists($ROW['image']))
        {

            $post_image = $image_class->get_thumb_post($ROW['image']);

            echo "<img src='$post_image' style='width:50%;'  />";
        }
         
         ?>
        <br><br>

        <?php 
           $likes = "";

           if($ROW['likes'] > 0){

            $likes = $ROW['likes'];

           }else{

            $likes = "";
            
           }
        ?>

        <a href="like.php?type=post&id=<?php echo $ROW['postid'] ?>">Like<?php echo $likes?></a> . <a href="">Comment</a> . 
        <span style="color:#999;">

            <?php echo $ROW['date'] ?>

        </span>

        <span style="color:#999; float: right;">
            
        <?php
            $post = new Post();

                if($post->i_own_post($ROW['postid'],$_SESSION['blare_userid'])){
                
                echo "
                <a href='edit.php'>
                    Edit
                </a> .
                
                <a href='delete.php'>
                Delete
                </a>";
            }

        ?>

        </span>

    </div>
</div>
                