<html>
    <head>
       <title>Stats Page</title>
    </head>
<body>
<h3> Stats are as follows: </h3>
    <P> Standard deviation for attribute 8 is:</P>
<?php
// Enable error logging: 
error_reporting(E_ALL ^ E_NOTICE);
// mysqli connection via user-defined function
include('./my_connect.php');
$mysqli = get_mysqli_conn();
$ID= 'TestCourse';
    //$ID = $_GET['ID'];


$sql1 = "select STDDEV(s.score) FROM ScoreUsedFor s";

// Prepared statement, stage 1: prepare
//$stmt1 = $mysqli->prepare($sql1);

// (2) Handle GET parameters; aid is the name of the hidden textbox in the previous page
$stmt1= $mysqli-> prepare ($sql1);
    //$stmt1->bind_param('i', $ID); 
$stmt1->execute (); 

// $stmt->execute() function returns boolean indicating success 
$stmt1->bind_result($ScoreUsedFor_score);

while ($stmt1->fetch()) 
{
// printf is print format, <li> is list item
//printf ('%s %s %s %s %s %s <br>',$Model_Year,$Model_Model,$Model_Type, $Model_Price, $Cars_Colour, $Discount_Discount_Type);
echo ' <p>'.$ScoreUsedFor_score.'</p>';

}
$stmt1->close();
?>

<P> Mean for attribute 8 is:</P>
<?php

$ID= 'TestCourse';
    //$ID = $_GET['ID'];


$sql2 = "select AVG(s.score) FROM ScoreUsedFor s";

// Prepared statement, stage 1: prepare
//$stmt1 = $mysqli->prepare($sql1);

// (2) Handle GET parameters; aid is the name of the hidden textbox in the previous page
$stmt2= $mysqli-> prepare ($sql2);
    //$stmt1->bind_param('i', $ID); 
$stmt2->execute (); 

// $stmt->execute() function returns boolean indicating success 
$stmt2->bind_result($ScoreUsedFor_score);

while ($stmt2->fetch()) 
{
// printf is print format, <li> is list item
//printf ('%s %s %s %s %s %s <br>',$Model_Year,$Model_Model,$Model_Type, $Model_Price, $Cars_Colour, $Discount_Discount_Type);
echo ' <p>'.$ScoreUsedFor_score.'</p>';

}
$stmt2->close();
$mysqli->close();

?>
    
<div class="tron">
      </div>
</body>
</html>