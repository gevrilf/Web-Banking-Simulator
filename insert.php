<?php

include("dbconfig.php");
session_start();
$login=$_SESSION['x'];
$password=$_SESSION['y'];
$t=$_SESSION['z'];

$con = mysqli_connect($dbhostname, $dbusername, $dbpassword, $dbname);
$sql="select id from CPS3740.Customers where login='$login' or password='$password'";
$result=mysqli_query($con, $sql);
$row=mysqli_fetch_array($result);
$cid = $row['id'];
if($con->connect_error) die("Connection failed: ".$con->connect_error);


//get inputs
if($_POST['t']==null)
$type='';
else
$type=$_POST['t'];
$code=$_POST['tc'];
$amt=$_POST['amt'];
$note=$_POST['no'];
$source=$_POST['l'];
if($amt<0 or $amt=='' or $amt==null){
	echo "<br>Error: Please enter a positive amount.";
}else if ($_POST['t']==null or $_POST['t']='') {
	echo "<br><br><br>Error: Please select a type of transaction";
}elseif ($source=='' or $source ==null) {
	echo "<br>Error: Please type select a source";
}elseif ($amt>$t && $type=='Withdraw') {
	echo "<br>Error: Amount you are attempting to withdraw is more than your balance.";
}else{

//1:ATM 2:Online 3:Branch 4:Wired 5:New5 6App	
$sql="select id from CPS3740.Sources where name='$source'";
$result=mysqli_query($con, $sql);
$row=mysqli_fetch_assoc($result);

$source=$row['id'];


if($type=='Deposit')
	$type='D';
else
	$type='W';

//$name_escape = mysqli_real_escape_string($con, $name);
//$tel_escape = mysqli_real_escape_string($con, $tel);
//$code_escape = mysqli_real_escape_string($con, $code);
$sql="INSERT INTO CPS3740_2021S1.Money_fernagev VALUES ('null', '$code', '$cid', '$source', '$type', '$amt', concat(CURDATE(), ' ', CURTIME()), '$note')";
$result=mysqli_query($con, $sql);

if($result)
	echo "<br>Transaction successful\n";
else
	echo "Transaction failed data entered is wrong or missing or transaction code is a duplicate";

}


mysqli_close($con);

?>

<br><br>
<a href='index.html' class='button-class'>Log out</a><br><br>