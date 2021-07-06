<?php
session_start();
include 'dbconnect.php';

//Pay button
if (isset($_GET['submit'])) {
  $name = $_GET["name"];
  $email = $_GET['email'];
  $phone = $_GET["phone"];
  $amount = $_GET['price'];
  

  $api_key = '04284585-70f6-4ae8-8ad7-a8ce1ca7cda4';
  $collection_id = 'jlkalpiz';
  $host = 'https://billplz-staging.herokuapp.com/api/v3/bills';

  $data = array(
    'collection_id' => $collection_id,
    'name' => $name,
    'email' => $email,
    'phone' => $phone,
                'amount' => $amount * 100, // RM20
                'description' => 'Payment for order',
                'callback_url' => "https://mywonderworlds.com/Wong_Yan_Mei/project/php/mainpage.php",
                'redirect_url' => "https://mywonderworlds.com/Wong_Yan_Mei/project/php/paymentupdate.php?&name=$name&email=$email&phone=$phone&price=$amount"
                
              );
  $process = curl_init($host);
  curl_setopt($process, CURLOPT_HEADER, 0);
  curl_setopt($process, CURLOPT_USERPWD, $api_key . ":");
  curl_setopt($process, CURLOPT_TIMEOUT, 30);
  curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($process, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($process, CURLOPT_POSTFIELDS, http_build_query($data));

  $return = curl_exec($process);
  curl_close($process);

  $bill = json_decode($return, true);

            //echo "<pre>".print_r($bill, true)."</pre>";
  header("Location: {$bill['url']}");

}

?>
<!DOCTYPE html>
<html>
<head>
  <title>My cart</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/style.css">
  
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> 
</head>
<body>
  <div class="header"> <!--Header-->
    <h1>Interocean Motor</h1>
  </div>
  <div class="topnavbar"> <!--Top navigation bar-->
    <a href="mainpage.php" class="left">Back to Mainpage</a>
  </div>
  <div style="clear:both"></div>  
  <br />  
  <h3>Order Details</h3> <!--Order details from cart-->
  <div class="table-responsive">  
   <table class="table table-bordered">  
    <tr>  
     <th width="40%">Product Name</th>  
     <th width="15%">Product Quantity</th>  
     <th width="15%">Product Price</th>  
     <th width="15%">Product Total</th>  
     <th width="5%">Action</th>  
   </tr>
   <?php   
   if(!empty($_SESSION["my_cart"]))  
   {  
     $total = 0;  
     foreach($_SESSION["my_cart"] as $keys => $values)  
     {  
      ?>  
      <tr>  
       <td><?php echo $values["item_prname"]; ?></td>  
       <td><?php echo $values["item_quantity"]; ?></td>  
       <td>RM <?php echo $values["item_prprice"]; ?></td>  
       <td>RM <?php echo number_format($values["item_quantity"] * $values["item_prprice"], 2); ?></td>  
       <td><a href="mainpage.php?action=delete&prid=<?php echo $values["item_prid"]; ?>"><span class="text-danger">REMOVE</span></a></td>  
     </tr>  
     <?php  
     $total = $total + ($values["item_quantity"] * $values["item_prprice"]);  
   }  
   ?>  
   <tr>  
     <td colspan="3" align="right">Grand Total</td>  
     <td align="right">RM <?php echo number_format($total, 2); ?></td>  
     <td></td>  
   </tr>
   <?php  
 }  
 ?>  
</table>
</div>  
</div>  
<br />  
</div>
<form class="form" action=""  method="get">
  <h1 class="login-title">Payment Form:</h1> <!--Payment Form-->
  <label>Email:</label>
  <input type="text" class="login-input" name="email" placeholder="Your Email" required/> <!--Email-->
  <label>Name:</label>
  <input type="text" class="login-input" name="name" placeholder="Your Name" required/> <!--Name-->
  <label>Phone Number:</label>
  <input type="text" class="login-input" name="phone" placeholder="Your Phone Number" required/> <!--Phone Number-->
  <label>Total Amount:</label>
  <input type="text" class="login-input" name="price" value="RM <?php echo $total ?>.00"> <!--Total Amount-->
  <input type="hidden" id="idprice" name="price" value="<?php echo $total ?>">
  <input type="submit" class="login-button" name="submit" value="Pay"> <!--Pay button-->
</form>
</body>
</html>
