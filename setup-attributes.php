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

//sql code (Done by Gordon)

$sql_CreateAttributes = 
"CREATE TABLE Attributes(AttributeID INT(4) PRIMARY KEY, AttributeName VARCHAR(50))";

$sql_InsertAttributes=
"INSERT INTO Attributes(AttributeID, AttributeName) 
VALUES (1,'Knowledge Base'),
(2,'Problem Analysis'),
(3,'Investigation'),
(4,'Design'),
(5,'Use of Engineering Tools'),
(6,'Individual and Team Work'),
(7,'Communication Skills'),
(8,'Professionalism'),
(9,'Impact On Society'),
(10,'Ethics and Equity'),
(11,'Economics and Project Management'),
(12,'Life Long Learning')";

$stmt1= $todoAppMySQLConnection-> prepare ($sql_CreateAttributes);
$stmt1->execute (); 
$stmt2= $todoAppMySQLConnection-> prepare ($sql_InsertAttributes);
$stmt2->execute (); 

?>
