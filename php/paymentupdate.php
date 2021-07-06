<?php
error_reporting(0);
include_once("dbconnect.php");

$name=$_GET['name'];
$email = $_GET['email'];
$phone = $_GET['phone'];
$amount = $_GET['price'];


$data = array(
    'id' =>  $_GET['billplz']['id'],
    'paid_at' => $_GET['billplz']['paid_at'] ,
    'paid' => $_GET['billplz']['paid'],
    'x_signature' => $_GET['billplz']['x_signature']
);

$paidstatus = $_GET['billplz']['paid'];

if ($paidstatus=="true"){
  $receiptid = $_GET['billplz']['id'];
  $signing = '';
  foreach ($data as $key => $value) {
    $signing.= 'billplz'.$key . $value;
    if ($key === 'paid') {
        break;
    } else {
        $signing .= '|';
    }
}
}

$signed= hash_hmac('sha256', $signing, 'S-wzNn8FTL0endIB4wgi728w');
if ($signed === $data['x_signature']) {
    

}

$query    = "INSERT into `tbl_purchased` (receiptid, email, name, phone, paid, status)
VALUES ('$receiptid', '$email', '$name', '$phone', '$amount','paid')";
$result   = mysqli_query($con, $query);
if ($result) {
   echo '<br><br><body><div><h2><br><br><center>Your Receipt</center> <!--Form Receipt-->
   </h1>
   <table border=1 width=70% height=50% align=center>
   <tr><td>Receipt ID</td><td>' . $receiptid . '</td></tr><tr><td>Email to </td>
   <td>' . $email . ' </td></tr><td>Your Name </td><td> ' . $name . '</td></tr>
   <td>Your Phone </td><td> ' . $phone . '</td></tr><td>Amount </td><td>RM ' . $amount . '</td></tr>
   <tr><td>Payment Status </td><td>' . $paidstatus . '</td></tr>
   </table><br>
   <p style="text-align:center">
   <a  href=' . 'https://mywonderworlds.com/Wong_Yan_Mei/project/php/mainpage.php' . '>Press this link to return to Interocean Motor </a> <!--Link back to Mainpage-->
   </p>';
}
else{
   echo "<script>window.location.replace('../php/payment.php')</script>";
}
?>
