<?php 
session_start();
include 'dbconnect.php';

//add to cart button
if(isset($_POST["add_to_cart"]))
{  
  if(isset($_SESSION["my_cart"]))  
  {  
   $item_array_prid = array_column($_SESSION["my_cart"], "item_prid");  
   if(!in_array($_GET["prid"], $item_array_prid))  
   {  
    $count = count($_SESSION["my_cart"]);
    echo '<script>alert("Product Added")</script>';  
    echo '<script>window.location="../php/mainpage.php"</script>';
    $item_array = array(  
     'item_prid'     => $_GET["prid"],  
     'item_prname'   => $_POST["hidden_name"],  
     'item_prprice'  => $_POST["hidden_price"],  
     'item_quantity' => $_POST["quantity"]  
   );  
    $_SESSION["my_cart"][$count] = $item_array;
  }  
  else  
  {  
    echo '<script>alert("Product Already Added")</script>';  
    echo '<script>window.location="../php/mainpage.php"</script>';  
  }  
}  
else  
{  
 $item_array = array(  
  'item_prid'     => $_GET["prid"],  
  'item_prname'   => $_POST["hidden_name"],  
  'item_prprice'  => $_POST["hidden_price"],  
  'item_quantity' => $_POST["quantity"]  
);  
 $_SESSION["my_cart"][0] = $item_array;  
}  
}  
if(isset($_GET["action"]))  
{  
  if($_GET["action"] == "delete")  
  {  
   foreach($_SESSION["my_cart"] as $keys => $values)  
   {  
    if($values["item_prid"] == $_GET["prid"])  
    {  
     unset($_SESSION["my_cart"][$keys]);  
     echo '<script>alert("Product Removed")</script>';  
     echo '<script>window.location="../php/cart.php"</script>';  
   }  
 }  
}  
} 

?>

<!DOCTYPE html> 
<html>
<head>
  <title>Main Page</title>
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
    <a href="search.php" class="left">Search</a>
    <a href="../html/index.html" class="right">Logout</a>
    <a href="cart.php" class="right">My Cart</a>
  </div>
  <div class="card-header">
    <h4><center>Product List</center></h4>
  </div>
  <div class="card-body">
    <?php
    include 'dbconnect.php';
    
    //Fetch Data From Database into Card List
    $add = "SELECT * FROM tbl_products ORDER BY prid DESC";  
    $add_run = mysqli_query($con, $add);  
    
    if(mysqli_num_rows($add_run) > 0)  
    {
      while($add_row = mysqli_fetch_array($add_run))
      {
        ?>
        <center>
        <div class="col-md-4">  
         <form method="post" action="mainpage.php?action=add&prid=<?php echo $add_row["prid"]; ?>">
          <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">
           <?php echo "<img src='../images/" . $add_row['image'] . "' height='130' width='150'> "; ?> <br />  
           <h6><?php echo $add_row["prname"]; ?></h6>  
           <h6>RM <?php echo $add_row["prprice"]; ?></h6>  
           <h6>Available Quantity: <?php echo $add_row["prqty"]; ?></h6>
           <input type="text" name="quantity" class="form-control" value="1" />  
           <input type="hidden" name="hidden_name" value="<?php echo $add_row["prname"]; ?>" />  
           <input type="hidden" name="hidden_price" value="<?php echo $add_row["prprice"]; ?>" />  
           <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />  
         </div>  
         </center>
       </form>  
     </div> <br />
     <?php  
   }  
 }  
 ?>
</body>  
</html>
