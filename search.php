<?php 
include("dbconfig.php");
session_start();
$login=$_SESSION['x'];
$password=$_SESSION['y'];
$cid=$_SESSION['id'];
$t=$_SESSION['z'];
$se=$_POST['search'];

$con = mysqli_connect($dbhostname, $dbusername, $dbpassword, $dbname);
$sql = "SELECT * from CPS3740.Sources";
$result = mysqli_query($con, $sql);
$num=mysqli_num_rows($result);
$row=mysqli_fetch_array($result);

$s1=$row['name'];

while($row=mysqli_fetch_array($result)) {
if($row['id']==1)
$s1=$row['name'];
if($row['id']==2)
$s2=$row['name'];
if($row['id']==3)
$s3=$row['name'];
if($row['id']==4)
$s4=$row['name'];
if($row['id']==5)
$s5=$row['name'];
if($row['id']==6)
$s6=$row['name'];
   }

if($se=="*")
$sql = "SELECT * from CPS3740_2021S1.Money_fernagev WHERE cid='$cid'";
else
$sql = "SELECT * from CPS3740_2021S1.Money_fernagev WHERE cid='$cid' and note like concat('%','$se','%')";
$result = mysqli_query($con, $sql);
$num=mysqli_num_rows($result);
if($num>0){

echo "<table border='1'>";
echo "<tr><td>ID</td><td>Code</td><td>type</td><td>amount</td><td>Source</td><td>mydatetime</td><td>note</td></tr>";
   while($row = mysqli_fetch_array($result)){
    if($row['sid']==1)
      $source=$s1;
    else if($row['sid']==2)
      $source=$s2;
    else if($row['sid']==3)
      $source=$s3;
    else if($row['sid']==4)
      $source=$s4;
    else if($row['sid']==5)
      $source=$s5;
    else if($row['sid']==6)
      $source=$s6;          
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
      
      echo "<br><tr><td>{$row['mid']}</td><td>{$row['code']}</td><td>{$type}</td><td style='$color'>{$row['amount']}</td>
      <td>$source</td>
      <td>{$row['mydatetime']}</td>
      <td>{$row['note']}</td>
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

}else
echo "Could not find $se";



mysqli_close($con);

?>
<br><br>
    <a href='index.html' class='button-class'>Log out</a><br><br>