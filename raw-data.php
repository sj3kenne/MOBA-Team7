<html>
    <head>
       <title>Selected Tables</title>
    </head>
<body>
<form action="graphs.php" method="get">
<h3> Search results are as follows: </h3>

<?php
// Enable error logging: 
error_reporting(E_ALL ^ E_NOTICE);
// mysqli connection via user-defined function
include('./my_connect.php');
$mysqli = get_mysqli_conn();
$ID = $_GET['selectedcourses'];
$ID2 = $_GET['selectedattributes'];
$inlist =  "'" . $ID[0] . "'";
    for ($i = 1; $i < count($ID); ++$i) {
        $inlist =  $inlist . ", '" . $ID[$i] . "'";
    }
//populated courses array 
$inlist2 =  "'" . $ID2[0] . "'";
    for ($i = 1; $i < count($ID2); ++$i) {
        $inlist2 =  $inlist2 . ", '" . $ID2[$i] . "'";
    }
//populated attributes array 
if(count($ID)==0){
	//if no courses selected
	$sql1 = "SELECT s.courseName, s.AttributeName, s.IndicatorName, s.score
	FROM ScoreUsedFor s 
	WHERE s.AttributeName IN ($inlist2)";
}else{
if(count($ID2)==0){
	//if no attributes selected
	$sql1 = "SELECT s.courseName, s.AttributeName, s.IndicatorName, s.score
	FROM ScoreUsedFor s 
	WHERE s.courseName IN ($inlist)";
} else {
	$sql1 = "SELECT s.courseName, s.AttributeName, s.IndicatorName, s.score
	FROM ScoreUsedFor s 
	WHERE s.courseName IN ($inlist) AND s.AttributeName IN ($inlist2)";
}
}

// Prepared statement, stage 1: prepare
//$stmt1 = $mysqli->prepare($sql1);
// (2) Handle GET parameters; aid is the name of the hidden textbox in the previous page
$stmt1= $mysqli-> prepare ($sql1); 
$stmt1->execute (); 
// $stmt->execute() function returns boolean indicating success 
$stmt1->bind_result($ScoreUsedFor_courseName,$ScoreUsedFor_AttributeName, $ScoreUsedFor_IndicatorName, $ScoreUsedFor_score);
echo '<style>';
echo 'table, th, td {
 border: 1px solid black;
}';
echo '</style>';  
echo '<table>';
echo ' <th>courseName</th>';
echo ' <th>AttributeName</th>';
echo ' <th>IndicatorName</th>';
echo ' <th>Score</th>';
while ($stmt1->fetch()) 
{
// printf is print format, <li> is list item
echo '<tr>';
echo ' <td>'.$ScoreUsedFor_courseName.'</td>';
echo ' <td>'.$ScoreUsedFor_AttributeName.'</td>';
echo ' <td>'.$ScoreUsedFor_IndicatorName.'</td>';
echo ' <td>'.$ScoreUsedFor_score.'</td>';
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