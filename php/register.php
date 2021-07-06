<?php
include ('dbconnect.php');
// When form submitted, insert values into the database.
if (isset($_POST['username'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $otp = rand(1000,9999);
  
  $query    = "INSERT into `tbl_user` (name, email, phone, username, password, otp)
  VALUES ('$name', '$email', '$phone', '$username', '$password', '$otp')";
  $result   = mysqli_query($con, $query);
  if ($result) {
    echo "<script> alert('Registration successful')</script>";
    echo "<script> window.location.replace('../html/login.html')</script>";
  } else {
    echo "<script> alert('Registration failed')</script>";
    echo "<script> window.location.replace('../html/register.html')</script>";
  }
}
?>
