<?php 
include "dbconfig.php";
session_start();
$id=$_GET['id'];

    $con=mysqli_connect($dbhostname, $dbusername, $dbpassword, $dbname)
      or die("<br>Cannot connect to DB\n");
   $sql = "delete from CPS3740_2021S1.Money_fernagev where mid=$id";
    $result = mysqli_query($con,$sql) or die("Bad Query: $sql");
  
       if($result){
      $_SESSION['message'] = "Transaction $id row Deleted Sucessfully";
      header("location:update.php");
    }else
      
      echo "Delete Failed";

    mysqli_close($con);  
    ?> 
    <br>
    <a href='index.html' class='button-class'>Log out</a><br><br>