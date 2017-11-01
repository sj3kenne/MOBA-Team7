<?php

// Enable error logging: 
error_reporting(E_ALL ^ E_NOTICE);

// mysqli connection via user-defined function
include('./my_connect.php');
$mysqli = get_mysqli_conn();
$ID = $_GET['ID'];
    
$sql_students = "CREATE TABLE Students(StudentID INT(8) PRIMARY KEY, GradYear VARCHAR(4))";
$sql_InsertStudents= "INSERT INTO Students(StudentID, GradYear) VALUES (598829620,2019),(684014860,2019),(843228181,2019),(820549378,2019),(533572169,2019),(975325712,2019),(310082419,2019),(242132470,2019),(208248363,2019),(277055951,2019),(902907559,2019),(528297980,2019),(444882790,2019),(112085131,2019),(588642518,2019),(414520736,2019),(356558346,2019),(970698993,2019),(633537205,2019),(534292868,2019),(816787809,2019),(220052551,2019),(858571733,2019),(363436152,2019),(393495083,2019),(769635714,2019),(373048949,2019),(357061292,2019),(837310284,2019),(815854164,2019),(315378369,2019),(564410540,2019),(126539887,2019),(563937624,2019),(684291511,2019)";

$stmt1= $mysqli-> prepare ($sql_students);
$stmt1->execute (); 
$stmt2= $mysqli-> prepare ($sql_InsertStudents);
$stmt2->execute (); 

$sql_CreateCourses = "CREATE TABLE Courses(courseName VARCHAR(40), courseTerm VARCHAR(6), courseYear INT(4), courseDept CHAR(4), courseNumber INT(3), courseType VARCHAR(20), PRIMARY KEY(courseName,courseTerm,courseYear,courseNumber))";

$sql_InsertInfo = "INSERT INTO Courses(courseName, courseTerm, courseYear, courseDept, courseNumber, courseType) VALUES ('Calculus', 'Spring', 2016, 'MSCI', 271, 'Optional'), ('Intro To Software Engineering', 'Fall', 2016, 'MSCI', 342, 'Mandatory'),('Data Mining', 'Winter', 2017, 'MSCI', 446, 'Optional'), ('Algorithms and Data Structures', 'Summer', 2015, 'MSCI', 240, 'Mandatory')";

$stmt3= $mysqli-> prepare ($sql_CreateCourses);
$stmt3->execute (); 
$stmt4= $mysqli-> prepare ($sql_InsertInfo);
$stmt4->execute ();

//create instructor table
$sql_CreateInstructor = 
"CREATE TABLE Instructors(FirstName VARCHAR(50), LastName VARCHAR(50), PRIMARY KEY(FirstName, LastName))";

//insert instructors into table
$sql_InsertInstructors=
"INSERT INTO Instructors(FirstName, LastName) 
VALUES ('Merhdad', 'Pirnia'), ('Mark', 'Smucker'), ('Lucas', 'Golab'), ('Mark', 'Hancock')";


$stmt5= $mysqli-> prepare ($sql_CreateInstructor);
$stmt5->execute (); 

$stmt6= $mysqli-> prepare ($sql_InsertInstructors);
$stmt6->execute (); 

$sql_TeachesCourse = "CREATE TABLE TeachesCourse(courseName VARCHAR(40), courseTerm VARCHAR(6), courseYear INT(4), courseNumber INT(3), FirstName VARCHAR(50), LastName VARCHAR(50), PRIMARY KEY(courseName,courseTerm,courseYear,courseNumber, FirstName, LastName))";
$sql_InsertInfo = "INSERT INTO TeachesCourse(courseName, courseTerm, courseYear, courseNumber, FirstName, LastName) VALUES ('Calculus', 'Spring', 2016, 271, 'Merhdad', 'Pirnia'), ('Intro To Software Engineering', 'Fall', 2016, 342, 'Mark', 'Smucker'), ('Data Mining', 'Winter', 2017, 446, 'Lucas', 'Golab'), ('Algorithms and Data Structures', 'Summer', 2015, 240, 'Mark', 'Hancock')";

$stmt7= $mysqli-> prepare ($sql_TeachesCourse);
$stmt7->execute (); 
$stmt7->execute (); 
$stmt8= $mysqli-> prepare ($sql_InsertInfo);
$stmt8-> execute ();


$sql_ScoreUsedFor = "CREATE TABLE ScoreUsedFor(courseName VARCHAR(40), courseTerm VARCHAR(6), courseYear INT(4), courseNumber INT(3),StudentID INT(8), AttributeName VARCHAR(30), IndicatorName VARCHAR(70), score float(3), PRIMARY KEY(courseName,courseTerm,courseYear,courseNumber,StudentID,AttributeName,IndicatorName))";

$sql_InsertInfo = "INSERT INTO ScoreUsedFor(courseName, courseTerm, courseYear, courseNumber, StudentID, AttributeName, IndicatorName, score) 
VALUES ('Calculus','Spring',2016,271,598829620,'Knowledge Base','Recognize the key elements of object-oriented programming using Java',0.2),
('Calculus','Spring',2016,271,684014860,'Knowledge Base','Recognize the key elements of object-oriented programming using Java',0.54),
('Calculus','Spring',2016,271,843228181,'Knowledge Base','Recognize the key elements of object-oriented programming using Java',0.66),
('Calculus','Spring',2016,271,820549378,'Knowledge Base','Recognize the key elements of object-oriented programming using Java',0.4),
('Calculus','Spring',2016,271,533572169,'Knowledge Base','Recognize the key elements of object-oriented programming using Java',0.35),
('Calculus','Spring',2016,271,975325712,'Knowledge Base','Recognize the key elements of object-oriented programming using Java',0.47),
('Calculus','Spring',2016,271,310082419,'Knowledge Base','Recognize the key elements of object-oriented programming using Java',0.18),
('Calculus','Spring',2016,271,242132470,'Knowledge Base','Recognize the key elements of object-oriented programming using Java',0.24),
('Calculus','Spring',2016,271,208248363,'Knowledge Base','Recognize the key elements of object-oriented programming using Java',0.59),
('Calculus','Spring',2016,271,277055951,'Knowledge Base','Recognize the key elements of object-oriented programming using Java',0.34),
('Calculus','Spring',2016,271,902907559,'Knowledge Base','Recognize the key elements of object-oriented programming using Java',0.82),
('Calculus','Spring',2016,271,528297980,'Knowledge Base','Recognize the key elements of object-oriented programming using Java',0.62),
('Calculus','Spring',2016,271,444882790,'Knowledge Base','Recognize the key elements of object-oriented programming using Java',0.32),
('Calculus','Spring',2016,271,112085131,'Knowledge Base','Recognize the key elements of object-oriented programming using Java',0.15),
('Calculus','Spring',2016,271,588642518,'Knowledge Base','Recognize the key elements of object-oriented programming using Java',0.63),
('Calculus','Spring',2016,271,414520736,'Knowledge Base','Recognize the key elements of object-oriented programming using Java',0.74),
('Calculus','Spring',2016,271,356558346,'Knowledge Base','Recognize the key elements of object-oriented programming using Java',0.54),
('Calculus','Spring',2016,271,970698993,'Knowledge Base','Recognize the key elements of object-oriented programming using Java',0.83),
('Calculus','Spring',2016,271,633537205,'Knowledge Base','Recognize the key elements of object-oriented programming using Java',0.27),
('Calculus','Spring',2016,271,534292868,'Knowledge Base','Recognize the key elements of object-oriented programming using Java',0.75),
('Calculus','Spring',2016,271,816787809,'Knowledge Base','Recognize the key elements of object-oriented programming using Java',0.61),
('Calculus','Spring',2016,271,220052551,'Knowledge Base','Recognize the key elements of object-oriented programming using Java',0.71),
('Calculus','Spring',2016,271,858571733,'Knowledge Base','Recognize the key elements of object-oriented programming using Java',0.26),
('Calculus','Spring',2016,271,363436152,'Knowledge Base','Recognize the key elements of object-oriented programming using Java',0.32),
('Calculus','Spring',2016,271,393495083,'Knowledge Base','Recognize the key elements of object-oriented programming using Java',0.74),
('Calculus','Spring',2016,271,769635714,'Knowledge Base','Recognize the key elements of object-oriented programming using Java',0.8),
('Calculus','Spring',2016,271,373048949,'Knowledge Base','Recognize the key elements of object-oriented programming using Java',0.77),
('Calculus','Spring',2016,271,357061292,'Knowledge Base','Recognize the key elements of object-oriented programming using Java',0.32),
('Calculus','Spring',2016,271,837310284,'Knowledge Base','Recognize the key elements of object-oriented programming using Java',0.37),
('Calculus','Spring',2016,271,815854164,'Knowledge Base','Recognize the key elements of object-oriented programming using Java',0.68),
('Calculus','Spring',2016,271,315378369,'Knowledge Base','Recognize the key elements of object-oriented programming using Java',0.2),
('Calculus','Spring',2016,271,564410540,'Knowledge Base','Recognize the key elements of object-oriented programming using Java',0.31),
('Calculus','Spring',2016,271,126539887,'Knowledge Base','Recognize the key elements of object-oriented programming using Java',0.28),
('Calculus','Spring',2016,271,563937624,'Knowledge Base','Recognize the key elements of object-oriented programming using Java',0.28),
('Calculus','Spring',2016,271,684291511,'Knowledge Base','Recognize the key elements of object-oriented programming using Java',0.46),
('Calculus','Spring',2016,271,598829620,'Knowledge Base','Describe the main components of decision analysis',0.32),
('Calculus','Spring',2016,271,684014860,'Knowledge Base','Describe the main components of decision analysis',0.65),
('Calculus','Spring',2016,271,843228181,'Knowledge Base','Describe the main components of decision analysis',0.52),
('Calculus','Spring',2016,271,820549378,'Knowledge Base','Describe the main components of decision analysis',0.4),
('Calculus','Spring',2016,271,533572169,'Knowledge Base','Describe the main components of decision analysis',0.33),
('Calculus','Spring',2016,271,975325712,'Knowledge Base','Describe the main components of decision analysis',0.41),
('Calculus','Spring',2016,271,310082419,'Knowledge Base','Describe the main components of decision analysis',0.14),
('Calculus','Spring',2016,271,242132470,'Knowledge Base','Describe the main components of decision analysis',0.23),
('Calculus','Spring',2016,271,208248363,'Knowledge Base','Describe the main components of decision analysis',0.45),
('Calculus','Spring',2016,271,277055951,'Knowledge Base','Describe the main components of decision analysis',0.27),
('Calculus','Spring',2016,271,902907559,'Knowledge Base','Describe the main components of decision analysis',0.88),
('Calculus','Spring',2016,271,528297980,'Knowledge Base','Describe the main components of decision analysis',0.62),
('Calculus','Spring',2016,271,444882790,'Knowledge Base','Describe the main components of decision analysis',0.21),
('Calculus','Spring',2016,271,112085131,'Knowledge Base','Describe the main components of decision analysis',0.25),
('Calculus','Spring',2016,271,588642518,'Knowledge Base','Describe the main components of decision analysis',0.89),
('Calculus','Spring',2016,271,414520736,'Knowledge Base','Describe the main components of decision analysis',0.64),
('Calculus','Spring',2016,271,356558346,'Knowledge Base','Describe the main components of decision analysis',0.45),
('Calculus','Spring',2016,271,970698993,'Knowledge Base','Describe the main components of decision analysis',0.91),
('Calculus','Spring',2016,271,633537205,'Knowledge Base','Describe the main components of decision analysis',0.38),
('Calculus','Spring',2016,271,534292868,'Knowledge Base','Describe the main components of decision analysis',0.9),
('Calculus','Spring',2016,271,816787809,'Knowledge Base','Describe the main components of decision analysis',0.42),
('Calculus','Spring',2016,271,220052551,'Knowledge Base','Describe the main components of decision analysis',0.57),
('Calculus','Spring',2016,271,858571733,'Knowledge Base','Describe the main components of decision analysis',0.34),
('Calculus','Spring',2016,271,363436152,'Knowledge Base','Describe the main components of decision analysis',0.2),
('Calculus','Spring',2016,271,393495083,'Knowledge Base','Describe the main components of decision analysis',0.86),
('Calculus','Spring',2016,271,769635714,'Knowledge Base','Describe the main components of decision analysis',0.85),
('Calculus','Spring',2016,271,373048949,'Knowledge Base','Describe the main components of decision analysis',0.72),
('Calculus','Spring',2016,271,357061292,'Knowledge Base','Describe the main components of decision analysis',0.09),
('Calculus','Spring',2016,271,837310284,'Knowledge Base','Describe the main components of decision analysis',0.34),
('Calculus','Spring',2016,271,815854164,'Knowledge Base','Describe the main components of decision analysis',0.91),
('Calculus','Spring',2016,271,315378369,'Knowledge Base','Describe the main components of decision analysis',0.21),
('Calculus','Spring',2016,271,564410540,'Knowledge Base','Describe the main components of decision analysis',0.25),
('Calculus','Spring',2016,271,126539887,'Knowledge Base','Describe the main components of decision analysis',0.29),
('Calculus','Spring',2016,271,563937624,'Knowledge Base','Describe the main components of decision analysis',0.29),
('Calculus','Spring',2016,271,684291511,'Knowledge Base','Describe the main components of decision analysis',0.33),
('Calculus','Spring',2016,271,598829620,'Problem Analysis','Model an optimization problem to replicate a practical situation',0.15),
('Calculus','Spring',2016,271,684014860,'Problem Analysis','Model an optimization problem to replicate a practical situation',0.56),
('Calculus','Spring',2016,271,843228181,'Problem Analysis','Model an optimization problem to replicate a practical situation',0.61),
('Calculus','Spring',2016,271,820549378,'Problem Analysis','Model an optimization problem to replicate a practical situation',0.32),
('Calculus','Spring',2016,271,533572169,'Problem Analysis','Model an optimization problem to replicate a practical situation',0.3),
('Calculus','Spring',2016,271,975325712,'Problem Analysis','Model an optimization problem to replicate a practical situation',0.4),
('Calculus','Spring',2016,271,310082419,'Problem Analysis','Model an optimization problem to replicate a practical situation',0.04),
('Calculus','Spring',2016,271,242132470,'Problem Analysis','Model an optimization problem to replicate a practical situation',0.11),
('Calculus','Spring',2016,271,208248363,'Problem Analysis','Model an optimization problem to replicate a practical situation',0.51)";

$stmt9= $mysqli-> prepare ($sql_ScoreUsedFor);
$stmt9->execute (); 
$stmt10= $mysqli-> prepare ($sql_InsertInfo);
$stmt10-> execute ();


?>