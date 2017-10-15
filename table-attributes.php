<?php

// Enable error logging: 
error_reporting(E_ALL ^ E_NOTICE);

// mysqli connection via user-defined function
include('./my_connect.php');
$mysqli = get_mysqli_conn();
$ID = $_GET['ID'];

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

$stmt1= $mysqli-> prepare ($sql_CreateAttributes);
$stmt1->execute (); 
$stmt2= $mysqli-> prepare ($sql_InsertAttributes);
$stmt2->execute (); 

?>
