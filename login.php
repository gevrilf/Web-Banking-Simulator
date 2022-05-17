<a href='index.html' class='button-class'>Log out</a><br><br>

<?php 
error_reporting(0);
ini_set('display_errors', 0);
include("dbconfig.php");
session_start();
if($_POST['login']==null&&$_POST['password']==null)
header("location:index.html");
$login=$_POST['login'];
$password=$_POST['password'];


$con = mysqli_connect($dbhostname, $dbusername, $dbpassword, $dbname);

$sql = "SELECT login, password, name, id from CPS3740.Customers WHERE login='$login' or password ='$password'" ;


$result = mysqli_query($con, $sql) or die("Bad Query: $sql");
$num=mysqli_num_rows($result);
$row=mysqli_fetch_array($result);
$t=0;
$_SESSION['z']=$t;
$color="";

if($login==""||$password==""){
	echo"<br>Username and password can not be blank<br>";
	
}
if($row['login']==$login && $row['password']!=$password){
	echo "<br>Login: ".$row['login']." is right but password is wrong.";
	
}
if($row['login']!=$login){
	echo "Login is not in database";
	
}

if($num>0&&$login==$row['login']&&$password==$row['password']){
$t=0;
$_SESSION['z']=$t;
$color="";
$_SESSION['id']=$row['id'];
$_SESSION['x']=$login;
$_SESSION['y']=$password;
$id = $row['id'];
$name = $row['name'];
$ip = $_SERVER['REMOTE_ADDR'];
echo "IP: $ip\n\n<br>";
if ((substr($_SERVER['REMOTE_ADDR'],0,8) == "192.168.") || ($_SERVER['REMOTE_ADDR'] == "127.0.0.1")) {
    echo "You are on Kean Campus<br>";
} else {
    echo "You are not on Kean Campus<br>";
}
echo $_SERVER['HTTP_USER_AGENT'] . "\n\n";
echo "<br>Welcome Customer: ".$row['name']."<br>";
$sql = "SELECT TIMESTAMPDIFF(YEAR, DOB, CURDATE()) as DOB from CPS3740.Customers";
$result = mysqli_query($con, $sql);
$row=mysqli_fetch_array($result);
echo "age: ".$row['DOB']."<br>";
$sql = "select concat(street,' ',city,' ',state,', ',zipcode) as adr from CPS3740.Customers";
$result = mysqli_query($con, $sql);
$row=mysqli_fetch_array($result);
echo "Address: ".$row['adr']."<br>";
$sql = "select img from CPS3740.Customers where login='$login'" ;
$result = mysqli_query($con, $sql) or die("Bad Query: $sql");
$row=mysqli_fetch_array($result);
echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['img'] ).'"/>';
echo "<br>";

$sql = "SELECT count(amount) as myct from CPS3740_2021S1.Money_fernagev where cid='$id'";
$result = mysqli_query($con, $sql);
$row=mysqli_fetch_assoc($result);
echo "<br>";
echo "There are ".$row['myct']." transactions for customer $name";

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

//Table
$sql = "select * from CPS3740_2021S1.Money_fernagev where cid=$id";
$result = mysqli_query($con, $sql);
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
      
      echo "<tr><td>{$row['mid']}</td><td>{$row['code']}</td><td>{$type}</td><td style='$color'>{$row['amount']}</td>
      <td>$source</td>
      <td>{$row['mydatetime']}</td>
      <td>{$row['note']}</td>
      </tr>";

    }
    echo"</table>";
$sql = "select amount, type from CPS3740_2021S1.Money_fernagev where cid='$id'";
$result = mysqli_query($con, $sql);
while($row = mysqli_fetch_array($result)){
	if($row['type']=="D")
		$t=$t+$row['amount'];
	else
		$t=$t-$row['amount'];
}
$_SESSION['z']=$t;
if($t>0){
$color="color:blue";
echo "Total balance:  <i style='$color'>$t</i>";
}else if($t<0){
$color="color:red";
echo "Total balance:  <i style='$color'>$t</i>";
}

echo "<br><br>";

echo "<a href='addtrans.php' class='button-class'>Add Transation</a>      ";
echo "<br>";
echo "<a href='update.php' class='button-class'>Display and Update Transactions</a>      ";
echo "<br>";
echo "<a href='display_stores.php' class='button-class'>Display Stores</a>";

echo "<br><br>";
echo "
<form name ='input' action= 'search.php' method='post'>
<br>Search: <input type='text' name='search' value=''>
<input type='submit' name='btnSubmit' value='Submit'>
</form>
";
	mysqli_close($con); 

 }


?>

<br><br>

