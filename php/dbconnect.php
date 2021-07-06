<?php 
session_start();
$con = mysqli_connect("localhost","mywonder_webappproject","Cisco_0213","mywonder_webappproject");
 
// Check connection
if (mysqli_connect_errno()){
	echo "Failed to connect to MySQL : " . mysqli_connect_error();
}
?>
