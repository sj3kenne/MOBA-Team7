<?php

$local_host = "localhost";
$local_username = "root";
$local_password = "root";
$local_databaseName = "j2attieh";


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

//sql code (Done by Juana)

$sql_ScoreUsedFor = "CREATE TABLE ScoreUsedFor(courseName VARCHAR(40), courseTerm VARCHAR(6), courseYear INT(4), courseNumber INT(3),StudentID INT(8), AttributeID Int(4), IndicatorID int(4), score float(3), PRIMARY KEY(courseName,courseTerm,courseYear,courseNumber,StudentID,AttributeID,IndicatorID))";

$sql_InsertInfo = "INSERT INTO ScoreUsedFor(courseName, courseTerm, courseYear, courseNumber, StudentID, AttributeID, IndicatorID, score) 
VALUES
('TestCourse', 'Spring', 2016, 271, 356558346, 8, 12, 0.2),
('TestCourse', 'Spring', 2016, 271, 970698993, 8, 12, 0.3),
('TestCourse', 'Spring', 2016, 271, 633537205, 8, 12, 0.2),
('TestCourse', 'Spring', 2016, 271, 534292868, 8, 12, 0.7),
('TestCourse', 'Spring', 2016, 271, 816787809, 8, 12, 0.75),
('TestCourse', 'Spring', 2016, 271, 220052551, 8, 12, 0.68),
('TestCourse', 'Spring', 2016, 271, 363436152, 8, 12, 0.52),
('TestCourse', 'Spring', 2016, 271, 858571733, 8, 12, 0.62),
('TestCourse', 'Spring', 2016, 271, 684014860, 8, 12, 0.49),
('TestCourse', 'Spring', 2016, 271, 598829620, 8, 12, 0.89),
('TestCourse', 'Spring', 2016, 271, 843228181, 8, 12, 0.9),
('TestCourse', 'Spring', 2016, 271, 820549378, 8, 12, 0.52),
('TestCourse', 'Spring', 2016, 271, 533572169, 8, 12, 0.28),
('TestCourse', 'Spring', 2016, 271, 975325712, 8, 12, 0.85),
('TestCourse', 'Spring', 2016, 271, 310082419, 8, 12, 0.69),
('TestCourse', 'Spring', 2016, 271, 242132470, 8, 12, 0.79),
('TestCourse', 'Spring', 2016, 271, 208248363, 8, 12, 0.56),
('TestCourse', 'Spring', 2016, 271, 277055951, 8, 12, 0.71),
('TestCourse', 'Spring', 2016, 271, 902907559, 8, 12, 0.63),
('TestCourse', 'Spring', 2016, 271, 528297980, 8, 12, 0.51),
('TestCourse', 'Spring', 2016, 271, 112085131, 8, 12, 0.34)";

$stmt1= $todoAppMySQLConnection-> prepare ($sql_ScoreUsedFor);
$stmt1->execute (); 
$stmt2= $todoAppMySQLConnection-> prepare ($sql_InsertInfo);
$stmt2-> execute ();

 ?>
