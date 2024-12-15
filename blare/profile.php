<?php

session_start();

include("actions/connect.php");
include("actions/login_action.php");
include("actions/user_action.php");
include("actions/post_action.php");
include("actions/image_action.php");
include("actions/profile_action.php");


    $login = new Login();
    $user_data = $login->check_login($_SESSION['blare_userid']);




    if(isset($_GET['id']) && is_numeric($_GET['id']))
    {
        
        $profile = new Profile();
        $profile_data = $profile->get_profile($_GET['id']);

        if(is_array($profile_data)){
        $user_data = $profile_data[0];
    }


    }
    

    //Posting start here
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {


        $post = new Post();
        $id = $_SESSION['blare_userid'];
        $post->create_post($id, $_POST, $_FILES);

        if($result == "")
        {
            header("Location: profile.php");
            die;
        }else{

            echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
            echo "the following error occured:<br><br>";    
            echo $result;
            echo "</div>";
        }
    }

    //collect post
    $post = new Post();
    $id =$user_data['userid'];


    $posts = $post->get_posts($id);

    //collect friends

    $user = new User();


    $friends = $user->get_friends($id);

    $image_class = new Image();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="css/profile.css" rel="stylesheet">
    <title>Profile | blare</title>
</head>
<body>


<br>
<?php include("header.php");?>

<!--cover-->

<div style="width:800px; margin:auto;min-height:400px;">

    <div style="background-color:white;text-align:center;color:#405d9b;">

            <?php

                $image = "images/cover_image.jpg";
                if(file_exists($user_data['cover_image']))
                {
                    $image = $image_class->get_thumb_cover($user_data['cover_image']);
                }

            ?>

        <img id="cover_pic" src="<?php echo $image ?>" style="width:100%; ">

        <span style="font-size:12px;">
            <?php

                $image = "";
                if(file_exists($user_data['profile_image']))
                {
                    $image = $user_data['profile_image'];
                }

            ?>
            <img id="profile_pic" src="<?php echo $image ?>">
            <br>

            <a style="text-decoration:none; color:green;" href="change_profileimage.php?change=profile"> Change Profile Image</a> |
            <a style="text-decoration:none; color:green;" href="change_profileimage.php?change=cover"> Change Cover</a>

        </span>

            <div style="font-size:20px; color:black;"><?php echo $user_data['name'] ?></div>
        <br>

        <a href="timeline.php"><div id="menu_buttons">Timeline</div></a>
        <div id="menu_buttons">About</div>
        <div id="menu_buttons">Friends</div>
        <div id="menu_buttons">Photos</div>
        <div id="menu_buttons">Settings</div>

    </div>
    
    <!--below cover area-->
    <div style="display:flex;">

    <!--friends area-->
        <div style="min-height:400px;flex:1;">

            <div id="friends_bar">

                Friends<br>

                <?php
                
                    if($friends)
                    {
                        foreach ($friends as $FRIEND_ROW){


                           
                            include("user.php");
                        }
                    }
                 
                
                ?>

            </div>
        </div>

    <!--post area-->
        <div style="min-height: 400px;flex:2.5; padding:20px; padding-right:0px">

            <div style="border:solid thin #aaa; padding: 10px; background-color:white;">
                <form method="post" enctype="multipart/form-data">
                    <textarea name="post" placeholder="What's on your mind?"></textarea>
                    <input type="file" name="file">
                    <input id="post_button" type="submit" value="Post">
                    <br>
                </form>
            </div>

    <!--post-->
            <div id="post_bar">
            
                <?php
                
                    if($posts)
                    {
                        foreach ($posts as $ROW){

                            $user = new User();
                            $ROW_USER = $user->get_user($ROW['userid']);
                           
                           
                            include("post.php");
                        }
                    }
                 
                
                ?>

            </div>

        </div>
    </div>

</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
