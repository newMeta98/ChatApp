<?php
session_start();
// initializing variables
$errors = array(); 
// connect to the database
include 'db.php';
include 'keys_locks.php';
include 'filters.php';
include 'cookies.php';
// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $img = "img/profile_man.jpg";

  $username = mysql_escape($db, $_POST['username']);
  $username = filter_sring($username);

  $email = mysql_escape($db, $_POST['email']);
  $email = filter_email($email);

  $password_1 = dec_user_to_serv($_POST['password_1'], $kh);
  $password_1 = mysql_escape($db, $password_1);
  $password_1 = filter_sring($password_1);

  $password_2 = dec_user_to_serv($_POST['password_2'], $kh);
  $password_2 = mysql_escape($db, $password_2);
  $password_2 = filter_sring($password_2);

  $agree = mysql_escape($db, $_POST['agree']);
  $agree = filter_sring($agree);

  $question = dec_user_to_serv($_POST['question'], $kh);
  $question = mysql_escape($db, $question);
  $question = filter_sring($question);

  $pin = dec_user_to_serv($_POST['pin'], $kh);
  $pin = mysql_escape($db, $pin);
  $pin = filter_int($pin);



  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($email)) { array_push($errors, "Email is required"); 
      echo "Email is required!"; }

  if (empty($username)) { array_push($errors, "Username is required"); 
      echo "Username is required!";}

  if (empty($password_1)) { array_push($errors, "Password is required");
      echo "Password is required!";}

  if (empty($pin)) { array_push($errors, "Pin is required");
      echo "Pin is required!";}

  if ($password_1 != $password_2) {
      array_push($errors, "The two passwords do not match"); 
      echo "The two passwords do not match!";
    }else{
        $pass_length = strlen((string)$password_1);
        if($pass_length > 8) {
         
        } else {
            echo("Password is not a valid lenght");
        }
    }

  if (filter_var($pin, FILTER_VALIDATE_INT)){
      $num_length = strlen((string)$pin);
      if($num_length == 6) {
       
      } else {
          echo("$pin is not a valid pin");
      }
  } else{
    echo("$pin is not a valid pin");
    } 
  if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
  } else {
      echo "$email is not a valid email address";
    }


  if ($question != 'test3234') {
      echo "question not VALID";
  }else{

    // first check the database to make sure 
    // a user does not already exist with the same username and/or email
    $user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

      if (isset($user['email'])) {
        array_push($errors, "Email already exists"); echo "Email already exists!";
      }



    // Finally, register user if there are no errors in the form
    if (count($errors) == 0) {
    
      $Query = "SELECT * FROM gn WHERE id ='4' LIMIT 1";
      $Result = mysqli_query($db, $Query);
      while($rows=mysqli_fetch_array($Result)){

        $g = decryptthis($rows['g'], $key_g);
        $n = decryptthis($rows['n'], $key_n);
      }

      $a = rand(111111111,99999999999);
      $publica = bcpowmod($g, $a, $n);


      $a = encryptthis($a, pinkey($pin));
      $publica = encryptthis($publica, $key_publica);

      $checkme = 'pin is valid';
      $checkme = encryptthis($checkme, pinkey($pin));

      $userID_name = "userID";
      $userID1 = 'userID-'.md5(rand());
      $user_name = "username";
      $email_name = "email";
      $pass_name = "pass";
     
      //encrypt before saving in the database
    
      $userID = encryptthis($userID1, $key_userId);
      $password = encryptthis($password_1, $key_pass);
      $question = encryptthis($question, $key_userId);
      $pin = encryptthis($pin, $key_pin);

      $query = "INSERT INTO users (email, userID, username, password, profile, agree, question, a, publica, checkme) 
            VALUES('$email', '$userID', '$username', '$password', '$img', '$agree', '$question', '$a', '$publica', '$checkme')";
      
      if (mysqli_query($db, $query)) {

          create_cookie($email_name, $email);
          create_cookie($userID_name, $userID);
          create_cookie($pass_name, $password);
          $_SESSION['mypin'] = $pin;
      }
          
    }
  }


}
?>