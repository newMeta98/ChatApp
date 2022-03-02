<?php
session_start();
include 'actions/db.php';
include 'actions/keys_locks.php';
include 'actions/filters.php';
include 'actions/cookies.php';
include 'actions/logout.php';

?><!DOCTYPE html>

<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>CloseApp</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta name="description" content="CChat ~ Cryptochat">
        <meta name="keywords" content="" />
        <meta name="author" content="Meta Meta">
        <meta name="copyright" content="&copy; 2021-<?php echo date('Y'); ?> Meta Meta">
        <link type="text/css" href="css/style.css" rel="stylesheet" media="all">
        <script src="js/jquery-3.4.1.min.js"></script>
        <script src="js/prng4.js"></script>
        <script src="js/rng.js"></script>
        <script src="js/jsbn.js"></script>
        <script src="js/rsa.js"></script>
        <script type="text/javascript">
    var rsa = new RSAKey();
    rsa.setPublic('<?php echo to_hex($details['rsa']['n']) ?>','<?php echo to_hex($details['rsa']['e']) ?>');
        </script>
        <script src="js/aes.js"></script>
        <script src="js/pbkdf2.js"></script>
        <script src="js/rngb4.js"></script>
        <script src="js/crypto-js.min.js"></script>
    </head>

    <body>
        <?php 
            if(isset($_COOKIE['userID'])){

                $email = $_COOKIE['email'];

                $queryUSER = "SELECT * FROM users WHERE email='$email'";
                $resultsUSER = mysqli_query($db, $queryUSER);

                while($rows=mysqli_fetch_array($resultsUSER)){
                    
                    $userID = decryptthis($rows['userID'], $key_userId);
                    $userID_cookie = decryptthis($_COOKIE['userID'], $key_userId);

                    $pass = decryptthis($rows['password'], $key_pass);
                    $pass_cookie = decryptthis($_COOKIE['pass'], $key_pass);
                    
                    if (($userID == $userID_cookie) && ($pass == $pass_cookie)) {
                        if (!isset($_SESSION['mypin'])) {
                            include 'includes/enterPIN.php';
                         }else{
                            include 'includes/home.php';
                         } 
                    }else{
                        include 'includes/login.php';
                    }
                }

            }else{
                include 'includes/login.php';
            }
        ?>
        <script src="js/prng3.js"></script>
        <script src="js/js-custom.js"></script> 
        <script src="js/loguot.js"></script>
    </body>

</html>
