<?php 

    include("actions/connect.php");
    include("actions/registration_action.php");

    $name = "";
    $username = "";

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {

        $signup = new Signup();
        $result = $signup->evaluate($_POST);

        if($result != "")
        {
        echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
        echo "the following error occured:<br><br>";    
        echo $result;
        echo "</div>";
        }else
        {
            header("Location: login.php");
            die;
        }

        $name = $_POST['name'];
        $username = $_POST['username'];

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fetter | Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/registration.css" rel="stylesheet">

</head>
<body>


    <div class="h1 text-center" >
         <img src="images/Logofetter.png">
    </div>

    

    <div class="container rounded " style="box-shadow: 5px 5px 1px lightgrey;">
                

        <h3 class=" text-center fw-bold">Create new account</h3>
        <h4 class=" text-center fs-5 p-1">It's quick and <br> easy.</h4>
        <form action="registration.php" method="post">
            <div class="form-floating">
                <input type="fullname" class="form-control" id="text"  value="<?php echo $name ?>" name="name" placeholder="Full name" required>
                <label for="name">Full name</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control" id="text"  value="<?php echo $username ?>" name="username"  placeholder="Username" required>
                <label for="floating">Username</label>
            </div>
            <div class="form-floating">
                <input type="password" placeholder="Password" id="text" name="password" class="form-control" required>
                <span class="show_hide_text cursor-pointer" id="show_hide_password">Show</span>
                <label for="show_hide_password">Password</label>
            </div>

    <div class="for-btn text-center rounded">
            <input type="submit" class="btn text-white fw-bold" value="Sign up" id="button">
            </div>
            

        </form>
    </div>

    
    <div class="container p-1 text-white" style="max-width: 500px;">
    <p>People who use our service may have uploaded your <br> contact information to Fetter.</p>
    </div>

    <div class="text-center text-white ">
        <div><p>Already registered <a href="login.php">Login Here</p></div>
    </div>
    
    <script src="js/common.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>