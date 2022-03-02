<?php 

function create_cookie($name, $value){
      setcookie($name, $value, time() + (86400 * 30), "/");
}
function destry_cookie($name){
      setcookie($name, "", time() - (89700 * 30), "/");
}
if (isset($_COOKIE['email'])) {
	$email = $_COOKIE['email'];
}
if (isset($_COOKIE['pass'])) {
	$pass = $_COOKIE['pass'];
}
if (isset($_COOKIE['username'])) {
	$username = $_COOKIE['username'];
}
if (isset($_COOKIE['userID'])) {
	$userID = $_COOKIE['userID'];
}
?>