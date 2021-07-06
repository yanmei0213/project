<?php
include 'dbconnect.php';

	$prid = $_GET['prid'];
	$add_query = "SELECT * FROM tbl_products WHERE prid='$prid' ";
	$add_query_run = mysqli_query($con, $add_query);

	if(mysqli_num_rows($add_query_run) > 0)
	{
		while($row = mysqli_fetch_array($add_query_run))
		{
			
			?>
			
<!Doctype html>
<html>
<head>
	<title>Edit Page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="header"> <!--Header-->
		<h1>Interocean Motor</h1>
	</div>
	<form class="form" action="../php/process.php" method="POST" enctype="multipart/form-data">
	    <h1 class="login-title">Interocean Motor Products - Edit Page:</h1>
	    <input type="hidden" name="edit_prid" value="<?php echo $row['prid'] ?>">
	    <label>Product Name:</label>
	    <input type="text" name="prname" class="login-input" value="<?php echo $row['prname']; ?>">
	    <label>Product Type:</label>
	    <input type="text" name="prtype" class="login-input" value="<?php echo $row['prtype']; ?>">
	    <label>Product Price(RM):</label>
	    <input type="text" name="prprice" class="login-input" value="<?php echo $row['prprice']; ?>">
	    <label>Product Quantity:</label>
	    <input type="text" name="prqty" class="login-input" value="<?php echo $row['prqty']; ?>">
	    <input type="submit" class="login-button" name="edit" value="Save">
	    <br>
		<br>
	    <center><a href="../php/adminmainpage.php" class="cancel-button">Cancel</a></center>
	</form>
			<?php
		}
	}
	else
	{
		echo "No Data Found by this URL Id";
	}
	?>
</body>
</html>
