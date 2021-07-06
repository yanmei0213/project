<?php 
session_start();

//Edit button
if (isset($_POST['edit']))
{
	$edit_prid = $_POST['edit_prid'];
	$prname = $_POST['prname'];
    $prtype = $_POST['prtype'];
    $prprice = $_POST['prprice'];
    $prqty = $_POST['prqty'];

    $query_edit = "UPDATE tbl_products SET prname='$prname', prtype='$prtype', prprice='$prprice', prqty='$prqty' WHERE prid='$edit_prid' ";
    $query_edit_run = mysqli_query($con, $query_edit);

    if($query_edit_run) {
    	echo "<script> alert('Updated Successful')</script>";
		echo "<script> window.location.replace('../php/adminmainpage.php')</script>";
    } else {
    	echo "<script> alert('Not Updated Successful')</script>";
		echo "<script> window.location.replace('../php/adminmainpage.php')</script>";
    }
}

//Delete button
if (isset($_POST['delete']))
{
	$delete_prid = $_POST['delete_prid'];

	$del_query = "DELETE FROM tbl_products WHERE prid='$delete_prid' ";
	$del_query_run = mysqli_query($con, $del_query);

	if($del_query_run) {
		echo "<script> alert('Deleted Successful')</script>";
		echo "<script> window.location.replace('../php/adminmainpage.php')</script>";
	} else {
		echo "<script> alert('Not Deleted Successful')</script>";
		echo "<script> window.location.replace('../php/addmainpage.php')</script>";
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
		<a href="../html/index.html" class="right">Logout</a>
        <a href="newproduct.php" class="right">Add Product</a>
	</div>
	<div class="card-header">
		<h4>Product List</h4>
	</div>
	<div class="card-body">
		<?php
		include 'dbconnect.php';
		
		$add = "SELECT * from tbl_products ORDER BY prid DESC"; 
		$add_run = mysqli_query($con, $add);
		
		if(mysqli_num_rows($add_run) > 0)
		{
			?> 
			<form action=""  method="post" enctype="multipart/form-data">
				<table class="table table-bordered"> <!--Table List-->
					<thead>
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Product Image</th>
							<th scope="col">Product Name</th>
							<th scope="col">Product Type</th>
							<th scope="col">Product Price(RM)</th>
							<th scope="col">Product Quantity</th>
							<th scope="col">EDIT</th>
							<th scope="col">DELETE</th>
						</tr>
					</thead>
					<tbody> <!--Fetch Data From Database into Table List-->
						<?php
						while($add_row = mysqli_fetch_array($add_run))
						{
							?>
							<tr>
								<th> <?php echo $add_row['prid']; ?></th>
								<td> <?php echo "<img src='../images/" . $add_row['image'] . "' height='130' width='150'> "; ?></td>
								<td> <?php echo $add_row['prname']; ?></td>
								<td> <?php echo $add_row['prtype']; ?></td>
								<td> <?php echo $add_row['prprice']; ?></td>
								<td> <?php echo $add_row['prqty']; ?></td>
								<td> 
								<a href="../php/newproduct-edit.php?prid=<?php echo $add_row['prid']; ?>" class="btn btn-info">Edit</a>
								</td>
								<td>
								    <form action="" method="POST">
								        <input type="hidden" name="delete_prid" value="<?php echo $add_row['prid']; ?>">
								        <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                                    </form>
							</tr>
							<?php } ?>
					</tbody>
				</table>
					<?php
				}
				else
				{
					echo "No Records Found";
				}
				?>
	</div>
</body>
</html>
