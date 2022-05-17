<?php 
include "dbconfig.php";
echo "<script src='http://code.jquery.com/jquery-2.1.3.min.js'></script>";
session_start();
$login=$_SESSION['x'];
$password=$_SESSION['y'];
$cid=$_SESSION['id'];
$t=0;
$tr=0;

    $con=mysqli_connect($dbhostname, $dbusername, $dbpassword, $dbname)
      or die("<br>Cannot connect to DB\n");
   $sql = "SELECT * from CPS3740_2021S1.Money_fernagev where cid=$cid";
    $result = mysqli_query($con,$sql) or die("Bad Query: $sql");

   //Table

echo "<table border='1'>";
echo "<tr><td>ID</td><td>Code</td><td>type</td><td>amount</td><td>Source</td><td>mydatetime</td><td>note</td><td colspan='2' align='center'>Update/Delete</td></tr>";
   while($row = mysqli_fetch_assoc($result)){
    if($row['sid']==1)
      $source="ATM";
    else if($row['sid']==2)
      $source="Online";
    else if($row['sid']==3)
      $source="Branch";
    else if($row['sid']==4)
      $source="Wired";
    else if($row['sid']==5)
      $source="New5";
    else if($row['sid']==6)
      $source="App";          
    $status = $row['type'];
    if($status=="D"){
      $type = "Deposit";
      $color="color:blue";
    }else{
      $type = "Withdraw";
      $color="color:red";
    }
      $amt=$row['amount'];

    //1:ATM 2:Online 3:Branch 4:Wired 5:New5 6App 
      
      echo "<tr><td>{$row['mid']}</td><td>{$row['code']}</td><td>{$type}</td><td style='$color'>{$row['amount']}</td>
      <td>$source</td>
      <td>{$row['mydatetime']}</td>
      <td bgcolor='yellow'>{$row['note']}</td>
      <td><a href=\"edit.php?id=$row[mid]\"><input type='submit' value='Edit'></a></td>
      <td><a href=\"delete.php?id=$row[mid]\"><input type='submit' value='Delete'></a></td>
      </tr>";

    }


    echo"</table>";
$sql = "select amount, type from CPS3740_2021S1.Money_fernagev where cid='$cid'";
$result = mysqli_query($con, $sql);
while($row = mysqli_fetch_assoc($result)){
  if($row['type']=="D")
    $t=$t+$row['amount'];
  else
    $t=$t-$row['amount'];
}
if($t>0){
$color="color:blue";
echo "Total balance:  <i style='$color'>$t</i>";
}else if($t<0){
$color="color:red";
echo "Total balance:  <i style='$color'>$t</i>";
}
if(!empty($_SESSION['message'])) {
   $message = $_SESSION['message'];
   
   Echo "<br><br>$message!<br><br>";

   }

    mysqli_close($con);  
    ?> 
    <br><br>
    <a href='index.html' class='button-class'>Log out</a><br><br>