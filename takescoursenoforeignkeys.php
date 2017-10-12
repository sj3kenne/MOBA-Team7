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

$sql_TakesCourse = "CREATE TABLE TakesCourse(courseName VARCHAR(40), courseTerm VARCHAR(6), courseYear INT(4), courseNumber INT(3), StudentID INT(8), PRIMARY KEY(courseName,courseTerm,courseYear,courseNumber,StudentID))";
$sql_InsertInfo = "INSERT INTO TakesCourse(courseName,courseTerm,courseYear,courseNumber,StudentID) VALUES ('TestCourse', 'Spring', 2016, 271, 598829620),
('TestCourse', 'Spring', 2016, 271,684014860),
('TestCourse', 'Spring', 2016, 271,843228181),
('TestCourse', 'Spring', 2016, 271,820549378),
('TestCourse', 'Spring', 2016, 271,533572169),
('TestCourse', 'Spring', 2016, 271,975325712),
('TestCourse', 'Spring', 2016, 271,310082419),
('TestCourse', 'Spring', 2016, 271,242132470),
('TestCourse', 'Spring', 2016, 271,208248363),
('TestCourse', 'Spring', 2016, 271,277055951),
('TestCourse', 'Spring', 2016, 271,902907559),
('TestCourse', 'Spring', 2016, 271,528297980),
('TestCourse', 'Spring', 2016, 271,112085131),
('TestCourse', 'Spring', 2016, 271,588642518),
('TestCourse', 'Spring', 2016, 271,414520736)";


$stmt1= $todoAppMySQLConnection-> prepare ($sql_TakesCourse);
$stmt1->execute (); 
$stmt2= $todoAppMySQLConnection-> prepare ($sql_InsertInfo);
$stmt2-> execute ();

 
 ?>