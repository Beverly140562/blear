<?php

session_start();

if(isset($_SESSION["blare_userid"]))
{
// remove all session variables
$_SESSION['blare_userid'] = NULL;
unset($_SESSION['blare_userid']);
}

// Redirect to login
header('Location: login.php');
die;