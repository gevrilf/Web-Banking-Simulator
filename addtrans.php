<?php 
include("dbconfig.php");
session_start();
$login=$_SESSION['x'];
$password=$_SESSION['y'];
$t=$_SESSION['z'];

$con = mysqli_connect($dbhostname, $dbusername, $dbpassword, $dbname);
$sql = "SELECT name from CPS3740.Customers WHERE login='$login' or password ='$password'";
$result = mysqli_query($con, $sql);
$num=mysqli_num_rows($result);
$row=mysqli_fetch_array($result);

Echo "<h2>Add Transaction</h2>";
if($t>0){
$color="color:blue";
echo "".$row['name']." Total balance:  <i style='$color'>$t</i>";
}else if($t<0){
$color="color:red";
echo "".$row['name']." Total balance:  <i style='$color'>$t</i>";
}


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



echo "
<form name ='input' action= 'insert.php' method='post'>
Transaction Code: <input type='text' name='tc'><br>
<input type='radio' id='d' name='t' value='Deposit'>
<label for='d'>Deposit</label>
<input type='radio' id='w'name='t' value='Withdraw'>
<label for='w'>Withdraw</label>
<br> Amount: <input type='text' name='amt'><br>
  <label for='loc'>Source:</label>
  <select id='loc' name='l'>
    <option value='$s1'>$s1</option>
    <option value='$s2'>$s2</option>
    <option value='$s3'>$s3</option>
    <option value='$s4'>$s4</option>
    <option value='$s5'>$s5</option>
    <option value='$s6'>$s6</option>
  </select>
<br> Note: <input type='text' name='no'>
<br>
<input type='submit' name='btnSubmit' value='Submit'>
</form>
";

mysqli_close($con);

?>
<br><br>
<a href='index.html' class='button-class'>Log out</a><br><br>