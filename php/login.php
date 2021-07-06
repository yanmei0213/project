<?php
include ('dbconnect.php');
// When form submitted, insert values into the database.

$username = $_POST['username'];
$password = $_POST['password'];

$query = " select * from tbl_user where username = '$username' && password = '$password'";
$result   = mysqli_query($con, $query);

$num = mysqli_num_rows($result);

if($num == 1){
  $_SESSION['username'] = $username;
  echo "<script> alert('Login successful')</script>";
  echo "<script> window.location.replace('../php/mainpage.php')</script>";
} else {
  echo "<script> alert('Login failed')</script>";
  echo "<script> window.location.replace('../html/login.html')</script>";
}
?>
