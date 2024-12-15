    <!--top bar-->

    <?php 
    
    $corner_image = "images/default-profile.jpg";
    if(isset($user_data))
    {
        $image_class = new Image();
        $corner_image = $user_data["profile_image"];
    }
    ?>
<div id="blue_bar">    
    <div style="width:800px;margin:auto;font-size:30px;">

        <a href="timeline.php" style="color:white;">Fetter</a>
        
        &nbsp &nbsp <input type="text" id="search_box" placeholder="Search for people">

        <a href="profile.php">
        <img src="<?php echo $corner_image?>" style="width:35px; float:right;">
        </a>

        <a href="logout.php">
        <span style="font-size:11px;float:right;margin:10px;color:white;">Logout</span>
        </a>

    </div>
</div>