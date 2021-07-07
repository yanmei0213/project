<?php
include 'dbconnect.php';

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
