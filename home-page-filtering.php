<html>
<body>
<form action="raw-data.php" method="get">
<h2> Welcome to M-OBA! </h2>
<?php
// Enable error logging: 
error_reporting(E_ALL ^ E_NOTICE);
// mysqli connection via user-defined function
// mysqli connection via user-defined function
include ('./my_connect.php');
$mysqli = get_mysqli_conn();
$mysqli2 = get_mysqli_conn();

 $sql = "SELECT DISTINCT s.courseName,s.courseName "
	. "FROM scoreusedfor s";
 $sql2 = "SELECT DISTINCT s.AttributeName,s.AttributeName "
	. "FROM scoreusedfor s";
// Prepared statement, stage 1: prepare
$stmt = $mysqli->prepare($sql);
$stmt2 = $mysqli2->prepare($sql2);
// Prepared statement, stage 2: execute
$stmt->execute();
$stmt2->execute();
// Bind result variables 
$stmt->bind_result($scoreusedfor_courseName, $scoreusedfor_courseName); 
$stmt2->bind_result($scoreusedfor_AttributeName, $scoreusedfor_AttributeName); 
/* fetch values */ 
echo '<h3> Pick a Course: </h3>';
while ($stmt->fetch()) 
{
    echo '<input type="checkbox" name="selectedcourses[]" value="'. $scoreusedfor_courseName .'"/>';
    echo'<label for="selectedcourses[]">' . $scoreusedfor_courseName . '</label>';
	echo '<br>'; 
}
echo '<h3> Pick an Attribute: </h3>';
while ($stmt2->fetch()) 
{
    echo '<input type="checkbox" name="selectedattributes[]" value="'. $scoreusedfor_AttributeName .'"/>';
    echo'<label for="selectedattributes[]">' . $scoreusedfor_AttributeName . '</label>';
	echo '<br>'; 
}
    echo "</table><br>";
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