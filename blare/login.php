<?php 
session_start();

    include("actions/connect.php");
    include("actions/login_action.php");

    $username = "";
    $password = "";

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {

        $login = new Login();
        $result = $login->evaluate($_POST);

        if($result != "")
        {
        echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
        echo "the following error occured:<br><br>";    
        echo $result;
        echo "</div>";
        }else
        {
            header("Location: profile.php");
            die;
        }

        $username = $_POST['username'];
        $password = $_POST['password'];

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fetter | Log in</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/Login.css" rel="stylesheet">
</head>
<body>

<?php 

?>
<div class="text-center ">
         <img src="images/Logofetter.png">
    </div>

    <div class="container">
        <form  method="post">
            <div class="form-floating">
                <input type="text" class="form-control" value="<?php echo $username ?>"  name="username" id="text" placeholder="Username" required>
                <label for="floating">Username</label>
            </div>
            <div class="form-floating">
                <input type="password" placeholder="Password" id="text" value="<?php echo $password ?>"  name="password" class="form-control" required>
                <span class="show_hide_text cursor-pointer" id="show_hide_password">Show</span>
                <label for="show_hide_password">Password</label>
            </div>
            <div class="form-btn text-center rounded  m-5 ">
                <input type="submit"  class="btn text-white fw-bold" value="Log in" id="button ">
            </div>
        </form>
            <div class="p-1 text-white"><p>Not registered yet <a href="registration.php">Registration Here</a></p></div>
    </div>


    <script src="js/common.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  
</body>
</html>