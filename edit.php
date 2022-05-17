<?php 
include "dbconfig.php";
session_start();
$login=$_SESSION['x'];
$password=$_SESSION['y'];
$cid=$_SESSION['id'];
$t=0;
$id=$_GET['id'];

    $con=mysqli_connect($dbhostname, $dbusername, $dbpassword, $dbname)
      or die("<br>Cannot connect to DB\n");
   $sql = "select * from CPS3740_2021S1.Money_fernagev where mid=$id";
    $result = mysqli_query($con,$sql) or die("Bad Query: $sql");
   while($row=mysqli_fetch_array($result)) {
      $note=$row['note'];
      $mid=$row['mid'];
   }
   Echo "<h2>Update Note</h2>";
   echo "
    <form action='' method='post'>
      New Note:   <input type='text' name='note' value='$note'>
      <br>
      <input type='submit' name='submit' value='Update'> </form>
   ";

   if(Isset($_POST['submit'])){
    $note=$_POST['note'];
    $sql = "update CPS3740_2021S1.Money_fernagev set note='$note' where mid=$id";
    $result = mysqli_query($con,$sql) or die("Bad Query: $sql");
    if($result){
      $_SESSION['message'] = "Transaction code $id Note updated Sucessfully";
      header("location:update.php");
    }else
      
      echo "insert failed";
   }

    mysqli_close($con);  
    ?> 

    <br>
    <a href='index.html' class='button-class'>Log out</a><br><br>