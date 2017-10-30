<?php

<<<<<<< HEAD:Indicator_Table.php
$local_host = "localhost";
$local_username = "root";
$local_password = "root";
<<<<<<< HEAD
$local_databaseName = "g4lau-msci342-local-db";
=======
$local_databaseName = "MOAB_garvita";
>>>>>>> fb605057d174ce04486871c224e6870d8935c18e
=======
// Enable error logging: 
error_reporting(E_ALL ^ E_NOTICE);
>>>>>>> feb779b194faed60c6fad562cb5aa27fac694809:table-indicators.php

// mysqli connection via user-defined function
include('./my_connect.php');
$mysqli = get_mysqli_conn();
$ID = $_GET['ID'];

//sql coe (Done by Sam)

$sql_CreateIndicators = 
"CREATE TABLE Indicators(IndicatorID INT(4) PRIMARY KEY, IndicatorName VARCHAR(200))";

$sql_InsertIndicators= 
"INSERT INTO Indicators(IndicatorID, IndicatorName)
VALUES (1, 'Recognize the key elements of object-oriented programming using Java'),
(2, 'Describe the main components of decision analysis'),
(3,'Model an optimization problem to replicate a practical situation '),
(4,'Critically evaluate solutions, including performing \"reality checks\" on design problems and solutions'),
(5,'Implement data processing techniques to gather necessary information for critiquing an organizational environment'),
(6,'Recognize and address uncertainty'),
(7,'Diagnose search quality problems and suggest areas of engine improvement for future experiments'),
(8,'Apply analytical techniques to design and improve methods and processes'),
(9,'Design and conduct an experiment to test a proposed system change'),
(10,'Generate a diverse set of candidate engineering design solutions'),
(11,'Build relevant models that provide valuable insights for operational and/or strategic decision making'),
(12,'Implement optimization approaches in real-life applications using different mathematical software (e.g. Matlab, Cplex, Gurobi, Lindo, Excel solver)'),
(13,'Build database applications using the php programming language'),
(14,'Demonstrate leadership abilities through varying roles in a project'),
(15,'Develop interpersonal skills by working with others'),
(16,'Generate an organized and professional report with appropriate page length, section headings, and/or correct spelling and grammar'),
(17,'Prepare and present a solution to a real-life problem')";
    
$stmt1= $mysqli-> prepare ($sql_CreateIndicators);
$stmt1->execute (); 
$stmt2= $mysqli-> prepare ($sql_InsertIndicators);
$stmt2->execute (); 

?>
