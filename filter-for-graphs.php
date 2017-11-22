<html>
    <head>
       <title>Graph Filters</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
<header>
	M-OBA
	<img src="waterlooLogo.png" style="height:100%;float:right;"/>
</header>
<body>
    <div id="sidebar">
            <ul>
                <li><a href="filter-for-graphs.php" class="active">Analytics</a></li>
                <li><a href="filter-for-tables.php">Raw Data</a></li>
                <li><a href="uploading.html">Import</a></li>
            </ul>
        </div>
<form action="graphs.php" method="get">
<h2> Welcome to M-OBA! </h2>
<?php
// Enable error logging: 
error_reporting(E_ALL ^ E_NOTICE);
// mysqli connection via user-defined function
// mysqli connection via user-defined function
include ('./my_connect.php');
$mysqli = get_mysqli_conn();
$mysqli2 = get_mysqli_conn();
$mysqli3 = get_mysqli_conn();
 $sql = "SELECT DISTINCT s.Attribute,s.Attribute "
    . "FROM scoreusedfor s";
 $sql2 = "SELECT DISTINCT s.Cohort,s.Cohort "
    . "FROM scoreusedfor s";
 $sql3 = "SELECT DISTINCT s.courseName,s.courseName "
    . "FROM scoreusedfor s";
// Prepared statement, stage 1: prepare
$stmt = $mysqli->prepare($sql);
$stmt2 = $mysqli2->prepare($sql2);
$stmt3 = $mysqli3->prepare($sql3);
// Prepared statement, stage 2: execute
$stmt->execute();
$stmt2->execute();
$stmt3->execute();
// Bind result variables 
$stmt->bind_result($scoreusedfor_AttributeName, $scoreusedfor_AttributeName); 
$stmt2->bind_result($students_GradYear, $students_GradYear); 
$stmt3->bind_result($scoreusedfor_courseName, $scoreusedfor_courseName);
/* fetch values */ 
//User selects Attributes
echo '<h3>Select Attribute(s): </h3>';
while ($stmt->fetch()) 
{
    echo '<input type="checkbox" name="selectedattributes[]" value="'. $scoreusedfor_AttributeName .'"/>';
    echo'<label for="selectedattributes[]">' . $scoreusedfor_AttributeName . '</label>';
    echo '<br>'; 
}
    echo "</table><br>";
echo '</select><br>';  
//User selects Cohorts
echo '<h3>Select Cohort(s): </h3>';
while ($stmt2->fetch()) 
{
    echo '<input type="checkbox" name="selectedcohorts[]" value="'. $students_GradYear .'"/>';
    echo'<label for="selectedcohorts[]">' . $students_GradYear . '</label>';
    echo '<br>'; 
}
    echo "</table><br>";
echo '</select><br>';  
//User selects Courses
echo '<h3> Pick a Course: </h3>';
while ($stmt3->fetch()) 
{
    echo '<input type="checkbox" name="selectedcourses[]" value="'. $scoreusedfor_courseName .'"/>';
    echo'<label for="selectedcourses[]">' . $scoreusedfor_courseName . '</label>';
    echo '<br>'; 
}
$stmt->close(); 
$stmt2->close(); 
$stmt3->close(); 
$mysqli->close();
$mysqli2->close();
$mysqli3->close();
?>
    
<br>
<input type="submit" value="Analyze Data"/>
</br>
</form>
<div class="tron">
      </div>
</body>
</html>