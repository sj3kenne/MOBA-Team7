<html>
    <head>
       <title>Table Filters</title>
	   <link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
<header>
	M-OBA
	<img src="waterlooLogo.png" style="height:100%;float:right;"/>
</header>
<body>
<form action="raw-data.php" method="get">
<h2> Welcome to M-OBA! </h2>

	<div id="sidebar">
		
			<ul>
				<li><a href="sidebar.html" class="fa fa-home" style="font-size:30px;color:#ccc;"></a></li>
				<li><a href="filter-for-graphs.php">Analytics</a></li>
				<li><a href="filter-for-tables.php" class="active">Raw Data</a></li>
				<li><a href="uploading.html">Import</a></li>
			</ul>
		</div>

<?php
// Enable error logging: 
error_reporting(E_ALL ^ E_NOTICE);
// mysqli connection via user-defined function
// mysqli connection via user-defined function
include ('./my_connect.php');
$mysqli = get_mysqli_conn();
$mysqli2 = get_mysqli_conn();
$mysqli3 = get_mysqli_conn();
$mysqli4 = get_mysqli_conn();
 $sql2 = "SELECT DISTINCT s.Attribute,s.Attribute "
    . "FROM scoreusedfor s";
 $sql3 = "SELECT DISTINCT s.Cohort,s.Cohort "
    . "FROM scoreusedfor s";
 $sql = "SELECT DISTINCT s.courseName,s.courseName "
    . "FROM scoreusedfor s";
 $sql4 = "SELECT DISTINCT s.FirstName,s.LastName "
    . "FROM scoreusedfor s";
// Prepared statement, stage 1: prepare
$stmt = $mysqli->prepare($sql);
$stmt2 = $mysqli2->prepare($sql2);
$stmt3 = $mysqli3->prepare($sql3);
$stmt4 = $mysqli4->prepare($sql4);
// Prepared statement, stage 2: execute
$stmt->execute();
$stmt2->execute();
$stmt3->execute();
$stmt4->execute();
// Bind result variables 
$stmt->bind_result($scoreusedfor_courseName, $scoreusedfor_courseName); 
$stmt2->bind_result($scoreusedfor_AttributeName, $scoreusedfor_AttributeName); 
$stmt3->bind_result($students_GradYear, $students_GradYear); 
$stmt4->bind_result($instructors_FirstName, $instructors_LastName); 
/* fetch values */ 
//User selects an Attribute
echo '<h3>Select Attribute(s): </h3>';
while ($stmt2->fetch()) 
{
    echo '<input type="checkbox" name="selectedattributes[]" value="'. $scoreusedfor_AttributeName .'"/>';
    echo'<label for="selectedattributes[]">' . $scoreusedfor_AttributeName . '</label>';
    echo '<br>'; 
}
    echo "</table><br>";
echo '</select><br>';  
//User selects a cohort
echo '<h3>Select Cohort(s): </h3>';
while ($stmt3->fetch()) 
{
    echo '<input type="checkbox" name="selectedattributes[]" value="'. $students_GradYear .'"/>';
    echo'<label for="selectedattributes[]">' . $students_GradYear . '</label>';
    echo '<br>'; 
}
    echo "</table><br>";
echo '</select><br>';  
//User selects a Course
echo '<h3> Pick a Course: </h3>';
while ($stmt->fetch()) 
{
    echo '<input type="checkbox" name="selectedcourses[]" value="'. $scoreusedfor_courseName .'"/>';
    echo'<label for="selectedcourses[]">' . $scoreusedfor_courseName . '</label>';
    echo '<br>'; 
}
    
//User select a Prof
echo '<h3>Select an Instructor: </h3>';
while ($stmt4->fetch()) 
{
    echo '<input type="checkbox" name="selectedattributes[]" value="'. $instructors_FirstName, $instructors_LastName .'"/>';
    echo'<label for="selectedattributes[]">' . $instructors_FirstName, ' ', $instructors_LastName . '</label>';
    echo '<br>'; 
}
    echo "</table><br>";
echo '</select><br>'; 
$stmt->close(); 
$mysqli->close();
?>



    
<br>
<input type="submit" value="View Tables"/>
</br>
</form>
<div class="tron">
      </div>
</body>
</html>