<?php 
  if (isset($_GET['logout'])) {
    session_unset(); 
    session_destroy(); 

     $email_name = "email";
     setcookie($email_name, '', time() - (89700 * 30), "/");
     
     $userID_name = "userID";
     setcookie($userID_name, '', time() - (89700 * 30), "/");

     $pass_name = "pass";
     setcookie($lname, "", time() - (89700 * 30), "/");


     header("location: index.php");
  }
?>