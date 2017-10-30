<html>
<body>
<form action="stats.php" method="get">
<h3> Search results are as follows: </h3>
<?php
// Enable error logging: 
error_reporting(E_ALL ^ E_NOTICE);
// mysqli connection via user-defined function
include('./my_connect.php');
$mysqli = get_mysqli_conn();
$ID = $_GET['ID'];

$sql1 = "SELECT s.courseNumber, s.score FROM scoreusedfor s WHERE s.courseName = ?, s.AttributeName = ? ";
//question mark indicates a dynamic parameters
//ie. you must specify values for the parameters before the statement is executed

// Prepared statement, stage 1: prepare
//$stmt1 = $mysqli->prepare($sql1);

// (2) Handle GET parameters; aid is the name of the hidden textbox in the previous page
$stmt1= $mysqli-> prepare ($sql1);
    $stmt1->bind_param('s', $ID); 
$stmt1->execute (); 

// $stmt->execute() function returns boolean indicating success 
$stmt1->bind_result($scoreusedfor_courseNumber, $scoreusedfor_score);

echo '<style>';
echo 'table, th, td {
 border: 1px solid black;
}';
echo '</style>';  
echo '<table>';
echo ' <th>Course Number </th>';
echo ' <th>Score </th>';


while ($stmt1->fetch()) 
{
// printf is print format, <li> is list item
//printf ('%s %s %s %s %s %s <br>',$Model_Year,$Model_Model,$Model_Type, $Model_Price, $Cars_Colour, $Discount_Discount_Type);

echo '<tr>';
echo ' <td>'.$scoreusedfor_courseNumber.'</td>';
echo ' <td>'.$scoreusedfor_score.'</td>';
echo ' </tr>';


}
echo '</table>';
echo '';

$stmt1->close();
$mysqli->close();

?>

<br>
<input type="submit" value="Generate Stats"/>
</br>
</form>
<div class="tron">
      </div>
</body>
</html>