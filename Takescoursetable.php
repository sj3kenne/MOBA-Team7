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

$sql_TakesCourse = "CREATE TABLE TakesCourse(CourseID INT(4),StudentID INT(8), PRIMARY KEY(CourseID,StudentID), FOREIGN KEY(CourseID) REFERENCES courses(CourseID), FOREIGN KEY(StudentID) REFERENCES students(StudentID))";

$stmt1= $todoAppMySQLConnection-> prepare ($sql_TakesCourse);
$stmt1->execute (); 

 
 ?>