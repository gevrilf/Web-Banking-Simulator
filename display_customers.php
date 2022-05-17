    <?php 
    include "dbconfig.php";
    $con=mysqli_connect($dbhostname, $dbusername, $dbpassword, $dbname)
      or die("<br>Cannot connect to DB\n");
    $query = "select * from CPS3740.Customers";
    $result = mysqli_query($con,$query) or die("Bad Query: $query");

    echo "<table border='1'>";
    echo "<tr><td>ID</td><td>Name</td><td>login</td><td>password</td><td>dob</td><td>gender</td><td>street</td><td>city</td><td>state</td><td>zipcode</td><tr>";
    
    while($row = mysqli_fetch_assoc($result)){
      
      echo "</tr><td>{$row['id']}</td><td>{$row['name']}</td><td>{$row['login']}</td><td>{$row['password']}</td><td>{$row['DOB']}</td><td>{$row['gender']}</td>
      <td>{$row['street']}</td>
      <td>{$row['city']}</td>
      <td>{$row['state']}</td>
      <td>{$row['zipcode']}</td>
      <tr>
      ";

    }

    echo"</table>";

    mysqli_close($con);  
    ?> 