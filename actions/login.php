<?php
session_start();
// initializing variables
$username = "";
$email    = "";
$errors = array(); 
 
// connect to the database
include 'db.php';
include 'keys_locks.php';
include 'filters.php';
include 'cookies.php';
// LOGIN USER
if (isset($_POST['log_user'])) {

  $email = mysql_escape($db, $_POST['email']);
  $email = filter_email($email);

  $password = dec_user_to_serv($_POST['password'], $kh);
  $password = mysql_escape($db, $password);
  $password = filter_sring($password);

  $pin = dec_user_to_serv($_POST['pin'], $kh);
  $pin = mysql_escape($db, $pin);
  $pin = filter_sring($pin);


  if (empty($email)) {
    array_push($errors, "Email is required");
    echo "Email is required!";
  }

   if (filter_var($pin, FILTER_VALIDATE_INT)) {
  } else {
    echo("$pin is not a valid pin");
  } 
  if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
  } else {
    echo("$email is not a valid email address");
  }
  if (empty($password)) {
    array_push($errors, "Password is required");
    echo "Password is required!";
  }
  
  if (count($errors) == 0) {


    $query_user = "SELECT * FROM users WHERE email='$email'";
    $results_user = mysqli_query($db, $query_user);


    if (mysqli_num_rows($results_user) == 1) {

      $queryUSER = "SELECT * FROM users WHERE email='$email'";
      $resultsUSER = mysqli_query($db, $queryUSER);
      while($rows=mysqli_fetch_array($resultsUSER)){

        $password_db = $rows['password'];
        $password_dcp = decryptthis($password_db, $key_pass);
        $password_dcp = filter_sring($password_dcp);

        $checkme = $rows['checkme'];
        $checkme = decryptthis($checkme, pinkey($pin));
        if ($checkme == 'pin is valid') {
          # code...

        if ($password_dcp == $password) {


          $email_name = "email";
          $userID_name = "userID";
          $pass_name = "pass";
          $userID = $rows['userID'];

          $userID = decryptthis($userID, $key_userId);
          $userID = encryptthis($userID, $key_userId);
          $password = encryptthis($password, $key_pass);
          $pin = encryptthis($pin, $key_pin);

          create_cookie($email_name, $email);
          create_cookie($userID_name, $userID);
          create_cookie($pass_name, $password);
          $_SESSION['mypin'] = $pin;
          
    }else{ 
      array_push($errors, "Wrong email/password combination");
      echo "Wrong email/password combination!";
    }
    }else{
          echo 'STOP, wrong pin';
          
    }


  }}else {
      array_push($errors, "Wrong email/password combination");
      echo "Wrong email/password combination!";
    }
  }
}
?>