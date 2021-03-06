<?php
// Start the session
//used to pass variables to graphs.php
session_start();
?>
<html>
    <head>
       <title>View Table</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
<header>
	MSCI OBA
	<img src="waterlooLogo.png" style="height:100%;float:right;"/>
</header>
<body>
<form action="export.php">
<h3> View filtering results in the table below: </h3>
    <div id="sidebar">
            <ul>
                <li><a href="filter-for-graphs.php">Analytics</a></li>
                <li><a href="filter-for-tables.php" class="active">Raw Data</a></li>
                <li><a href="uploading.html">Import</a></li>
            </ul>
        </div>
<br><input type="submit" class="button" value="Export Table"/><br>
<br>

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
	$sql1 = "SELECT s.courseName, s.StudentID, s.Attribute, s.Indicator, s.score
	FROM ScoreUsedFor s 
	WHERE s.Attribute IN ($inlist2)";
}else{
if(count($ID2)==0){
	//if no attributes selected
	$sql1 = "SELECT s.course, s.StudentID, s.Attribute, s.Indicator, s.score
	FROM ScoreUsedFor s 
	WHERE s.courseName IN ($inlist)";
} else {
	$sql1 = "SELECT s.courseName, s.StudentID, s.Attribute, s.Indicator, s.score
	FROM ScoreUsedFor s 
	WHERE s.courseName IN ($inlist) AND s.Attribute IN ($inlist2)";
}
}
// Prepared statement, stage 1: prepare
//$stmt1 = $mysqli->prepare($sql1);
// (2) Handle GET parameters; aid is the name of the hidden textbox in the previous page
$stmt1= $mysqli-> prepare ($sql1); 
$stmt1->execute (); 
// $stmt->execute() function returns boolean indicating success 
$stmt1->bind_result($ScoreUsedFor_courseName, $ScoreUsedFor_StudentID,$ScoreUsedFor_AttributeName, $ScoreUsedFor_IndicatorName, $ScoreUsedFor_score);
echo '<style>';
echo 'table, th, td {
 border: 1px solid black;
}';
echo '</style>';  
echo '<table>';
echo ' <th>Course</th>';
echo '<th>Student ID</th>';
echo ' <th>Attribute</th>';
echo ' <th>Indicator</th>';
echo ' <th>Score</th>';
while ($stmt1->fetch()) 
{
// printf is print format, <li> is list item
echo '<tr>';
echo ' <td>'.$ScoreUsedFor_courseName.'</td>';
echo ' <td>'.$ScoreUsedFor_StudentID.'</td>';
echo ' <td>'.$ScoreUsedFor_AttributeName.'</td>';
echo ' <td>'.$ScoreUsedFor_IndicatorName.'</td>';
echo ' <td>'.$ScoreUsedFor_score.'</td>';
echo ' </tr>';
}
echo '</table>';
echo '';
$_SESSION['courses'] = $ID;
$_SESSION['attributes'] = $ID2;
$_SESSION['sql1'] = $sql1;
//sessions used to pass variables to graphs.php
$stmt1->close();
$mysqli->close();
?>


</form>
<div class="tron">
</div>
</body>
</html>