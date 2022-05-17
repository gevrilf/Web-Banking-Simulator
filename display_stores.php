    <?php 
    include "dbconfig.php";
    $con=mysqli_connect($dbhostname, $dbusername, $dbpassword, $dbname)
      or die("<br>Cannot connect to DB\n");
    $query = "select * from CPS3740.Stores;";
    $result = mysqli_query($con,$query) or die("Bad Query: $query");

    echo "<table border='1'>";
    echo "<tr><td>ID</td><td>Name</td><td>Zipcode</td><td>State</td><td>City</td><td>Address</td><td>Latitude</td><td>Longitude</td><tr>";
    
    while($row = mysqli_fetch_assoc($result)){
     

      echo "<tr><td>{$row['sid']}</td><td>{$row['Name']}</td><td>{$row['Zipcode']}</td><td>{$row['State']}</td><td>{$row['city']}</td><td >{$row['address']}</td><td>{$row['latitude']}</td><td>{$row['longitude']}</td><tr>";

    }

    echo"</table>";

    mysqli_close($con);  
    ?> 

    <a href="index.html" target="_blank">Log out</a><br><br>