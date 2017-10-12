<?php

$local_host = "localhost";
$local_username = "root";
$local_password = "root";
$local_databaseName = "g4lau-msci342-local-db";


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


    
$sql_students = "CREATE TABLE Students(StudentID INT(8) PRIMARY KEY, GradYear VARCHAR(2))";
$sql_InsertStudents= "INSERT INTO Students(StudentID, GradYear) VALUES (598829620, 2019), (684014860, 2019), (843228181, 2019), (820549378, 2019), (533572169, 2019), (975325712, 2019), (310082419, 2019), (242132470, 2019), (208248363, 2019), (277055951, 2019), (902907559, 2019), (528297980, 2019), (444882790, 2019), (112085131, 2019), (588642518, 2019),
(414520736, 2019),
(356558346, 2019),
(970698993, 2019),
(633537205, 2019),
(534292868, 2019),
(816787809, 2019),
(220052551, 2019),
(363436152, 2019),
(858571733, 2019)";

$stmt1= $todoAppMySQLConnection-> prepare ($sql_students);
$stmt1->execute (); 
$stmt2= $todoAppMySQLConnection-> prepare ($sql_InsertStudents);
$stmt2->execute (); 


?>