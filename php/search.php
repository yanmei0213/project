<?php 
session_start();
?>

<html>
<head>
	<title>Search</title>
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
	<center>
      <form action="" method="POST">
        <div class="container">
          <div class="row">
            <div class="col-md-12 mt-5">
              <div class="card">
                <div class="card-header">
                  <h5>
                    <input type="text" name="search_value" placeholder="Search Products" required/>
                    <input type="submit" name="search_btn" class="btn btn-primary" value="search"></a>
                  </h5>
                </div>
                <div class="card-body">
                  <table class="table table-bordered"> <!--Table List-->
                    <thead>
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Product Image</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Product Type</th>
                        <th scope="col">Product Price(RM)</th>
                        <th scope="col">Product Quantity</th>
                      </tr>
                    </thead>
                    <tbody> <!--Fetch Data From Database into Table List-->
                        <?php
                      include 'dbconnect.php';

                      if (isset($_POST['search_btn']))
                      {
                       $value_search = $_POST['search_value'];
                       $query = "SELECT * FROM tbl_products WHERE CONCAT(prid, image, prname, prtype, prprice, prqty) LIKE '%$value_search%' ORDER BY prid DESC";
                       $query_run = mysqli_query($con, $query);

                       if(mysqli_num_rows($query_run) > 0)
                       {
                        while($row = mysqli_fetch_array($query_run))
                        {

                          ?>
                          <tr>
                            <td><?php echo $row['prid']; ?></td>
                            <th> <?php echo "<img src='../images/" . $row['image'] . "' height='130' width='150'> "; ?></th>
                            <td><?php echo $row['prname']; ?></td>
                            <td><?php echo $row['prtype']; ?></td>
                            <td><?php echo $row['prprice']; ?></td>
                            <td><?php echo $row['prqty']; ?></td>
                          </tr>
                          <?php
                        }

                      }
                      else
                      {
                        ?>
                        <tr>
                          <td colspan="6">No Records Found.</td>
                        </tr>
                        <?php
                      }
                    }
                    ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </tbody>
      </center>
</body>
</html>
