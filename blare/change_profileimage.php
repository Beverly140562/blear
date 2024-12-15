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

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
       


        if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != "")
        {


            if($_FILES['file']['type'] == "image/jpeg")
            {

                $allowed_size = (1024 * 1024) * 7;
                if($_FILES['file']['size'] < $allowed_size)
                {

                    //everthing is fine
                    $folder = "uploads/" . $user_data['userid'] . "/";

                    //create folder
                    if(!file_exists($folder))
                    {
                        mkdir($folder,0777, true);

                    }

                     //ceate the class
                    $image = new Image();

                    $filename = $folder . $image->generate_filename(15);
                    move_uploaded_file($_FILES['file']['tmp_name'], $filename);
        
                    $change = "profile";

                        //check for mode
                        if(isset($_GET['change']))
                        {
                            $change = $_GET['change'];
                        }

                   

                    if($change == "cover")
                    {
                        if(file_exists($user_data['cover_image']))
                        {
                            unlink($user_data['cover_image']);
                        }

                        $image->resize_image($filename,$filename,1500,1500);
                    }else
                    {
                        if(file_exists($user_data['profile_image']))
                        {
                            unlink($user_data['profile_image']);
                        }
                        $image->resize_image($filename,$filename,1500,1500);
    
                    }

                    if(file_exists($filename))
                    {
                        

                        $userid = $user_data['userid'];
                        

                        if($change == "cover")
                        {
                        
                            $query = "update users set cover_image = '$filename' where userid = '$userid' limit 1 ";
                            $_POST['is_cover_image'] = 1;

                        }else{
                            $query = "update users set profile_image = '$filename' where userid = '$userid' limit 1 ";
                            $_POST['is_profile_image'] = 1;

                        }

                        
                        $DB = new Database();
                        $DB->save($query);


                        //create a post
                        $post = new Post();
                        

                        $post->create_post($id, $_POST, $filename);


                       header(("Location: profile.php"));
                        die;
                    }
                }else
                {

                    echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
                    echo "the following error occured:<br><br>";    
                    echo "Only image of size 3mb or lower are allowed! " ;
                    echo "</div>";
                    
                }
            }else
            {

                echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
                echo "the following error occured:<br><br>";    
                echo "Only image of Jpeg type are allowed! " ;
                echo "</div>";
                
            }

        
        }else
        {
            echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
            echo "the following error occured:<br><br>";    
            echo "Please add image! " ;
            echo "</div>";
        }
        
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="css/timeline.css" rel="stylesheet">
    <title>Change Profile Image | blare</title>
</head>
<body>

<?php include("header.php");?>

<!--cover-->

<div style="width:800px; margin:auto;min-height:400px;">

    
    <!--below cover area-->
    <div style="display:flex;">

    <!--post area-->
        <div style="min-height: 400px;flex:2.5; padding:20px; padding-right:0px;">

        <form method="post" enctype="multipart/form-data">
            <div style="border:solid thin #aaa; padding: 10px; background-color:white;">
                
                <input type="file" name="file"><br>
                <input id="post_button" type="submit" value="Change">
                <br>

                <div style="text-align: center;">
                    <br><br>
                <?php 

                    //check for mode
                    if(isset($_GET['change']) && $_GET['change'] == "cover")
                    {
                        $change = "cover";
                        echo "<img src='$user_data[cover_image]' style='max-width:500px;'>";
                    }else
                    {
                        echo "<img src='$user_data[profile_image]' style='max-width:500px;'>";

                    }

                    

                ?>
                </div>
            </div>
        </form>   

        </div>
    </div>

</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
