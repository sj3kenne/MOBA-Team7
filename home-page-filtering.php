<html>
<body>
<form action="raw-data.php" method="get">
<h3> Welcome to M-OBA! </h3>
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
    
echo '<label for="ID">Pick Course: </label>'; 
echo '<br>'; 
echo '<form action="">'; 
while ($stmt->fetch()) 
{
printf ('<input type="checkbox">%s</option>',$scoreusedfor_courseName, $scoreusedfor_courseName); 
printf ('<br>');
}
echo '</form>';  
//-------
echo '<label for="ID">Pick Attribute: </label>'; 
echo '<br>'; 
echo '<form action="">'; 
while ($stmt2->fetch()) 
{
printf ('<input type="checkbox">%s</option>',$scoreusedfor_AttributeName, $scoreusedfor_AttributeName); 
printf ('<br>');
}
echo '</form>';  

$stmt->close(); 
$stmt2->close(); 
$mysqli->close();
$mysqli2->close();
?>
    
<br>
<input type="submit" value="Continue"/>
</br>
</form>
<div class="tron">
      </div>
</body>
</html>