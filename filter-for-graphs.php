<html>
    <head>
       <title>Filter for Graphs</title>
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
$mysqli4 = get_mysqli_conn();
$mysqli5 = get_mysqli_conn();
 $sql = "SELECT DISTINCT s.Cohort,s.Cohort
         FROM scoreusedfor s";
 $sql2 = "SELECT DISTINCT s.Attribute,s.Attribute
         FROM scoreusedfor s";
 $sql3 = "SELECT DISTINCT s.courseName,s.courseName
          FROM scoreusedfor s";
 $sql4 = "SELECT DISTINCT s.FirstName,s.LastName
          FROM scoreusedfor s";
 $sql5 = "SELECT DISTINCT st.GradYear,st.GradYear
          FROM students st";
// Prepared statement, stage 1: prepare
$stmt = $mysqli->prepare($sql);
$stmt2 = $mysqli2->prepare($sql2);
$stmt3 = $mysqli3->prepare($sql3);
$stmt4 = $mysqli4->prepare($sql4);
$stmt5 = $mysqli5->prepare($sql5);
// Prepared statement, stage 2: execute
$stmt->execute();
$stmt2->execute();
$stmt3->execute();
$stmt4->execute();
$stmt5->execute();
// Bind result variables 
$stmt->bind_result($scoreusedfor_cohort, $scoreusedfor_cohort); 
$stmt2->bind_result($scoreusedfor_attribute, $scoreusedfor_attribute);
$stmt3->bind_result($scoreusedfor_courseName, $scoreusedfor_courseName); 
$stmt4->bind_result($scoreusedfor_FirstName, $scoreusedfor_LastName); 
$stmt5->bind_result($students_GradYear, $students_GradYear); 
/* fetch values */ 
//------------------------------------------------------------------------------------------------------------
//User selects class
echo '<h3> Select a Class: </h3>';
echo '<input type="radio" name="selectedclass[]" value="All Program"/>';
echo'<label for="selectedclass[]">All Program</label>';
echo '<br>'; 
while ($stmt5->fetch()) 
{
	echo '<input type="radio" name="selectedclass[]" value="'. $students_GradYear .'"/>';
    echo'<label for="selectedclass[]">' . $students_GradYear . '</label>';
    echo '<br>'; 
}
//------------------------------------------------------------------------------------------------------------
//User selects Cohort
echo '<h3> Select a Cohort/Course: </h3>';
while ($stmt->fetch()) 
{
    echo '<input type="radio" name="selectedcohorts[]" value="'. $scoreusedfor_cohort .'"/>';
    echo'<label for="selectedcohorts[]">' . $scoreusedfor_cohort . '</label>';
    echo '<br>'; 
}
while ($stmt3->fetch()) 
{
    echo '<input type="radio" name="selectedcohorts[]" value="'. $scoreusedfor_courseName .'"/>';
    echo'<label for="selectedcohorts[]">' . $scoreusedfor_courseName . '</label>';
    echo '<br>'; 
}
//-----------------------------------------------------------------------------------------------------------
//User selects Attributes
echo '<h3>Select Attribute(s) and/or Program Indicator(s): </h3>';
while ($stmt2->fetch()) 
{
    echo '<input type="checkbox" name="selectedattributes[]" value="'. $scoreusedfor_attribute .'"/>';
    echo'<label for="selectedattributes[]">' . $scoreusedfor_attribute . '</label>';
	echo '<br>'; 
		//populate attribute's indicators
		$mysqli5 = get_mysqli_conn();
		$sql5 = "SELECT DISTINCT s.ProgIndicator, s.ProgIndicator
			  FROM scoreusedfor s
			  WHERE s.Attribute = '$scoreusedfor_attribute'";
		$stmt5 = $mysqli5->prepare($sql5);
		$stmt5->execute();
		$stmt5->bind_result($scoreusedfor_indicator,$scoreusedfor_indicator); 
		while ($stmt5->fetch()) 
		{
		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
		echo '<input type="checkbox" name="selectedattributes[]" value="'. $scoreusedfor_indicator .'"/>';
		echo'<label for="selectedattributes[]">' . $scoreusedfor_indicator . '</label>';
		echo '<br>'; 
		}
}
//-----------------------------------------------------------------------------------------------------------
//User select a Prof
echo '<h3>Select an Instructor: </h3>';
while ($stmt4->fetch()) 
{
    echo '<input type="checkbox" name="selectedinstructor[]" value="'. $scoreusedfor_FirstName, $scoreusedfor_LastName .'"/>';
    echo'<label for="selectedinstructor[]">' . $scoreusedfor_FirstName, ' ', $scoreusedfor_LastName . '</label>';
    echo '<br>'; 
}
$stmt->close(); 
$stmt2->close(); 
$stmt3->close(); 
$stmt4->close(); 
$stmt5->close(); 
$mysqli->close();
$mysqli2->close();
$mysqli3->close();
$mysqli4->close();
$mysqli5->close();
?>
    
<br>
<input type="submit" value="Next"/>
</br>
</form>
<div class="tron">
      </div>
</body>
</html>