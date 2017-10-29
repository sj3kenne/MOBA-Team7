<html>
<body>
<form action="raw-data.php" method="get">
<h3> Pick Course: </h3>
<?php
// Enable error logging: 
error_reporting(E_ALL ^ E_NOTICE);
// mysqli connection via user-defined function
// mysqli connection via user-defined function
include ('./my_connect.php');
$mysqli = get_mysqli_conn();
    
 $sql = "SELECT DISTINCT c.courseName,c.courseName "
	. "FROM scoreusedfor c";
// Prepared statement, stage 1: prepare
$stmt = $mysqli->prepare($sql);
// Prepared statement, stage 2: execute
$stmt->execute();
// Bind result variables 
$stmt->bind_result($scoreusedfor_courseName, $scoreusedfor_courseName); 
/* fetch values */ 
    
echo '<label for="ID">Pick ID: </label>'; 
echo '<select name="ID">'; 
printf ('<option value="0"> </option>');
while ($stmt->fetch()) 
{
printf ('<option value="%s">%s</option>',$scoreusedfor_courseName, $scoreusedfor_courseName); 
}
echo '</select><br>';  

$stmt->close(); 
$mysqli->close();

?>
    
<br>
<input type="submit" value="Continue"/>
</br>
</form>
<div class="tron">
      </div>
</body>
</html>