<?php

$local_host = "localhost";
$local_username = "root";
$local_password = "root";
$local_databaseName = "MOAB_garvita";


// Production Database Connection Details:
//$databaseConnectURL = "mysql://bec9224a3c2850:feb6f6a3@us-cdbr-iron-east-04.cleardb.net/heroku_81f997698bd0911?reconnect=true";
// CLEARDB_DATABASE_URL needs to be set in Heroku.  
$databaseConnectURL = getenv("CLEARDB_DATABASE_URL");

$possibleLocalhosts = array('127.0.0.1', "::1");
if(in_array($_SERVER['REMOTE_ADDR'], $possibleLocalhosts)) // If our REMOTE_ADDR is a localhost, do this:
{
	// Open a connection with our local database
	$todoAppMySQLConnection = mysqli_connect($local_host, $local_username, $local_password, $local_databaseName);
} 

else // If our REMOTE_ADDR wasn't a localhost, we must be working remotely.
{ 
	// Parse our $databaseConnectURL so that we can pull out the key's we neeed
	$parsedDatabaseConnectUrl = parse_url($databaseConnectURL);
	$remote_host = $parsedDatabaseConnectUrl["host"];
	$remote_username = $parsedDatabaseConnectUrl["user"];
	$remote_password = $parsedDatabaseConnectUrl["pass"];
	$remote_databaseName = substr($parsedDatabaseConnectUrl["path"], 1);

	// Open a connection with our remote database
	$todoAppMySQLConnection = mysqli_connect($remote_host, $remote_username, $remote_password, $remote_databaseName);
}

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
    
$stmt1= $todoAppMySQLConnection-> prepare ($sql_CreateIndicators);
$stmt1->execute (); 
$stmt2= $todoAppMySQLConnection-> prepare ($sql_InsertIndicators);
$stmt2->execute (); 

?>
