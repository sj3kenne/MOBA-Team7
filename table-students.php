<?php

// Enable error logging: 
error_reporting(E_ALL ^ E_NOTICE);

// mysqli connection via user-defined function
include('./my_connect.php');
$mysqli = get_mysqli_conn();
$ID = $_GET['ID'];
    
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

$stmt1= $mysqli-> prepare ($sql_students);
$stmt1->execute (); 
$stmt2= $mysqli-> prepare ($sql_InsertStudents);
$stmt2->execute (); 


?>