<?php
include ('dbconnect.php');

if (isset($_POST['submit'])) {
	$prname = $_POST['prname'];
	$prtype = $_POST['prtype'];
	$prprice = $_POST['prprice'];
	$prqty = $_POST['prqty'];
	$image_name= $_FILES['image']['name'];
	$tmp_name= $_FILES['image']['tmp_name'];
	$folder= "../images/" .$image_name;
	move_uploaded_file($tmp_name, $folder);

	$query    = "INSERT into tbl_products (prname, prtype, prprice, prqty, image)
	VALUES ('$prname', '$prtype', '$prprice', '$prqty', '$folder')";
	$query_run   = mysqli_query($con, $query);
	if ($query_run) {
		echo "<script> alert('Add New Product Successful')</script>";
		echo "<script> window.location.replace('../php/mainpage.php')</script>";
	} else {
		echo "<script> alert('Add New Product failed')</script>";
		echo "<script> window.location.replace('../php/newproduct.php')</script>";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add New Product Page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="header"> <!--Header-->
		<h1>Interocean Motor</h1>
	</div>
	<form class="form" action=""  method="post" enctype="multipart/form-data">
		<h1 class="login-title">Add New Product Form:</h1>
		<label>Product Name:</label> <!--Product Name-->
		<input type="text" class="login-input" name="prname" required/>
		<label>Product Type:</label> <!--Product Type-->
		<select name="prtype"> 
			<option value="">---Please Select Type---</option>
			<option value="Batteries">Batteries</option>
			<option value="Bearings">Bearings</option>
			<option value="Brake Shoes">Brake Shoes</option>
			<option value="Shocks">Shocks</option>
			<option value="Spark Plugs">Spark Plugs</option>
			<option value="Tires & Tubes">Tires & Tubes</option>
		</select>
		<br>
		<br>
		<br>
		<label>Product Price(RM):</label> <!--Product Price-->
		<input type="text" class="login-input" name="prprice" required/>
		<label>Product Quantity:</label> <!--Product Quantity-->
		<input type="text" class="login-input" name="prqty" required/>
		<label>Product Image:</label> <!--Product Image-->
		<input type="file" name="image" id="image" required/>
		<br>
		<br>
		<input type="submit" class="login-button" name="submit" value="Add"> <!--Add Button-->
		<br>
		<br>
		<center><a href="adminmainpage.php" class="cancel-button">Cancel</a></center> <!--Cancel Link-->
	</form>
</body>
</html>
