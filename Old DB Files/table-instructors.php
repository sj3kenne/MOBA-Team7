<?php

// Enable error logging: 
error_reporting(E_ALL ^ E_NOTICE);
// mysqli connection via user-defined function
include('./my_connect.php');
$mysqli = get_mysqli_conn();
$ID = $_GET['ID'];

//sql code (Done by Sheila)

//create instructor table
$sql_CreateInstructor = 
"CREATE TABLE Instructors(instructorID INT(4) PRIMARY KEY, FirstName VARCHAR(50), LastName VARCHAR(50))";

//insert instructors into table
$sql_InsertInstructors=
"INSERT INTO Instructors(InstructorID, FirstName, LastName) 
VALUES (1,'Merhdad', 'Pirnia')";


$stmt1= $mysqli-> prepare ($sql_CreateInstructor);
$stmt1->execute (); 

$stmt2= $mysqli-> prepare ($sql_InsertInstructors);
$stmt2->execute (); 

?>
