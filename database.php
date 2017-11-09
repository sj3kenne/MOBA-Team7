<?php

// Enable error logging: 
error_reporting(E_ALL ^ E_NOTICE);

// mysqli connection via user-defined function
include('./my_connect.php');
$mysqli = get_mysqli_conn();
$ID = $_GET['ID'];
    
$sql_students = "CREATE TABLE Students(StudentID INT(8) PRIMARY KEY, GradYear VARCHAR(4))";
$sql_InsertStudents= "INSERT INTO Students(StudentID, GradYear) VALUES (310082419,2019),(242132470,2019),(208248363,2019),(277055951,2019),(902907559,2019),(528297980,2019),(444882790,2019),(112085131,2019),(588642518,2019),(414520736,2019),(356558346,2019),(970698993,2019),(633537205,2019),(534292868,2019),(816787809,2019),(220052551,2019),(858571733,2019),(363436152,2019),(393495083,2019),(769635714,2019),(373048949,2019),(357061292,2019),(837310284,2019),(815854164,2019),(315378369,2019),(564410540,2019),(126539887,2019),(563937624,2019),(684291511,2019)";

$sql_Insert_Not_Grad="INSERT INTO Students(StudentID, GradYear) VALUES (598829620, NULL),(684014860, NULL),(843228181, NULL),(820549378, NULL),(533572169, NULL),(975325712, NULL)";

$stmt1= $mysqli-> prepare ($sql_students);
$stmt1->execute (); 
$stmt2= $mysqli-> prepare ($sql_InsertStudents);
$stmt2->execute (); 
$stmtx= $mysqli-> prepare ($sql_Insert_Not_Grad);
$stmtx->execute (); 

$sql_CreateCourses = "CREATE TABLE Courses(courseName VARCHAR(40), courseTerm VARCHAR(6), courseYear INT(4), DeptCode CHAR(5), courseNumber INT(3), courseType VARCHAR(20), PRIMARY KEY(courseName,courseTerm,courseYear,courseNumber))";

$sql_InsertInfo = "INSERT INTO Courses(courseName, courseTerm, courseYear, DeptCode, courseNumber, courseType) VALUES ('Calculus', 'Spring', 2016, 'MSCI', 271, 'Optional'), ('Intro To Software Engineering', 'Fall', 2016, 'MSCI', 342, 'Mandatory'),('Data Mining', 'Winter', 2017, 'MSCI', 446, 'Optional'), ('Algorithms and Data Structures', 'Summer', 2015, 'MSCI', 240, 'Mandatory')";

$stmt3= $mysqli-> prepare ($sql_CreateCourses);
$stmt3->execute (); 
//$stmt4= $mysqli-> prepare ($sql_InsertInfo);
//$stmt4->execute ();

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
$stmt8= $mysqli-> prepare ($sql_InsertInfo);
$stmt8-> execute ();

//Create relationship table
$sql_ScoreUsedFor = "CREATE TABLE ScoreUsedFor(courseName VARCHAR(40), StudentID INT(8),Attribute VARCHAR(30),Indicator VARCHAR(70), ProgIndicator VARCHAR(70),score float(3), DeptCode CHAR(5) , CourseNumber INT(3), LastName VARCHAR(50), FirstName VARCHAR(50), courseTerm VARCHAR(6), courseYear INT(4), Cohort VARCHAR(2), courseType VARCHAR(20), PRIMARY KEY(StudentID,Attribute,Indicator,ProgIndicator,DeptCode,courseNumber,courseName,LastName,FirstName,courseTerm,courseYear,Cohort,courseType))";


	$sql_alterscoreusedfor= "ALTER TABLE `ScoreUsedFor`
  ADD KEY `StudentID` (`StudentID`),
  ADD KEY `DeptCode` (`DeptCode`),
  ADD KEY `courseType` (`courseType`),
  ADD KEY `courseTerm` (`courseTerm`),
  ADD KEY `courseYear` (`courseYear`),
  ADD KEY `courseName` (`courseName`),
  ADD KEY `FirstName` (`FirstName`),
  ADD KEY `LastName` (`LastName`),
  ADD KEY `courseNumber` (`courseNumber`);" ;
$sql_foreignkey= "ALTER TABLE `ScoreUsedFor`
  ADD CONSTRAINT `scoreusedfor_ibfk_1` FOREIGN KEY (`courseName`) REFERENCES `Courses` (`courseName`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `scoreusedfor_ibfk_2` FOREIGN KEY (`StudentID`) REFERENCES `Students` (`StudentID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `scoreusedfor_ibfk_3` FOREIGN KEY (`DeptCode`) REFERENCES `Courses` (`DeptCode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `scoreusedfor_ibfk_4` FOREIGN KEY (`courseType`) REFERENCES `Courses` (`courseType`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `scoreusedfor_ibfk_3` FOREIGN KEY (`FirstName`) REFERENCES `Instructors` (`FirstName`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `scoreusedfor_ibfk_4` FOREIGN KEY (`LastName`) REFERENCES `Instructors` (`LastName`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `scoreusedfor_ibfk_5` FOREIGN KEY (`courseTerm`) REFERENCES `Courses` (`courseTerm`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `scoreusedfor_ibfk_6` FOREIGN KEY (`courseYear`) REFERENCES `Courses` (`courseYear`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `scoreusedfor_ibfk_7` FOREIGN KEY (`courseNumber`) REFERENCES `Courses` (`courseNumber`) ON DELETE CASCADE ON UPDATE CASCADE;" ;

/*$sql_InsertInfo = "INSERT INTO ScoreUsedFor(courseName, courseTerm, courseYear, courseNumber, StudentID, AttributeName, IndicatorName, score) 
VALUES 
('Calculus','Spring',2016,271,598829620,'Knowledge Base','Recognize the key elements of object-oriented programming using Java',0.2),
('Calculus','Spring',2016,271,598829620,'Problem Analysis','Model an optimization problem to replicate a practical situation',0.15),
('Calculus','Spring',2016,271,208248363,'Investigation','Model an optimization problem to replicate a practical situation',0.51),
('Calculus','Spring',2016,271,208248363,'Design','Model an optimization problem to replicate a practical situation',0.51),
('Calculus','Spring',2016,271,208248363,'Use of Engineering Tools','Model an optimization problem to replicate a practical situation',0.51),
('Calculus','Spring',2016,271,208248363,'Individual and team work','Model an optimization problem to replicate a practical situation',0.51),
('Calculus','Spring',2016,271,208248363,'Communication Skills','Model an optimization problem to replicate a practical situation',0.51),
('Calculus','Spring',2016,271,208248363,'Professionalism','Model an optimization problem to replicate a practical situation',0.51),
('Calculus','Spring',2016,271,208248363,'Impact of engineering on society and the environment','Model an optimization problem to replicate a practical situation',0.51),
('Calculus','Spring',2016,271,208248363,'Ethics and Equity','Model an optimization problem to replicate a practical situation',0.51),
('Calculus','Spring',2016,271,208248363,'Economics and Project Management','Model an optimization problem to replicate a practical situation',0.51),
('Calculus','Spring',2016,271,208248363,'Life-long Learning','Model an optimization problem to replicate a practical situation',0.51)



/*('Calculus','Spring',2016,271,598829620,'Knowledge Base','Recognize the key elements of object-oriented programming using Java',0.2),
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
('Calculus','Spring',2016,271,208248363,'Investigation','Model an optimization problem to replicate a practical situation',0.51),
('Calculus','Spring',2016,271,598829620,'Investigation','Model an optimization problem to replicate a practical situation',0.15),
('Calculus','Spring',2016,271,684014860,'Investigation','Model an optimization problem to replicate a practical situation',0.56),
('Calculus','Spring',2016,271,843228181,'Investigation','Model an optimization problem to replicate a practical situation',0.61),
('Calculus','Spring',2016,271,820549378,'Investigation','Model an optimization problem to replicate a practical situation',0.32),
('Calculus','Spring',2016,271,533572169,'Investigation','Model an optimization problem to replicate a practical situation',0.3),
('Calculus','Spring',2016,271,975325712,'Investigation','Model an optimization problem to replicate a practical situation',0.4),
('Calculus','Spring',2016,271,310082419,'Investigation','Model an optimization problem to replicate a practical situation',0.04),
('Calculus','Spring',2016,271,242132470,'Investigation','Model an optimization problem to replicate a practical situation',0.11),
('Calculus','Spring',2016,271,208248363,'Investigation','Model an optimization problem to replicate a practical situation',0.51),
('Calculus','Spring',2016,271,208248363,'Design','Model an optimization problem to replicate a practical situation',0.51),
('Calculus','Spring',2016,271,598829620,'Design','Model an optimization problem to replicate a practical situation',0.15),
('Calculus','Spring',2016,271,684014860,'Design','Model an optimization problem to replicate a practical situation',0.56),
('Calculus','Spring',2016,271,843228181,'Design','Model an optimization problem to replicate a practical situation',0.61),
('Calculus','Spring',2016,271,820549378,'Design','Model an optimization problem to replicate a practical situation',0.32),
('Calculus','Spring',2016,271,533572169,'Design','Model an optimization problem to replicate a practical situation',0.3),
('Calculus','Spring',2016,271,975325712,'Design','Model an optimization problem to replicate a practical situation',0.4),
('Calculus','Spring',2016,271,310082419,'Design','Model an optimization problem to replicate a practical situation',0.04),
('Calculus','Spring',2016,271,242132470,'Design','Model an optimization problem to replicate a practical situation',0.11),
('Calculus','Spring',2016,271,208248363,'Design','Model an optimization problem to replicate a practical situation',0.51),
('Calculus','Spring',2016,271,208248363,'Use of Engineering Tools','Model an optimization problem to replicate a practical situation',0.51),
('Calculus','Spring',2016,271,598829620,'Use of Engineering Tools','Model an optimization problem to replicate a practical situation',0.15),
('Calculus','Spring',2016,271,684014860,'Use of Engineering Tools','Model an optimization problem to replicate a practical situation',0.56),
('Calculus','Spring',2016,271,843228181,'Use of Engineering Tools','Model an optimization problem to replicate a practical situation',0.61),
('Calculus','Spring',2016,271,820549378,'Use of Engineering Tools','Model an optimization problem to replicate a practical situation',0.32),
('Calculus','Spring',2016,271,533572169,'Use of Engineering Tools','Model an optimization problem to replicate a practical situation',0.3),
('Calculus','Spring',2016,271,975325712,'Use of Engineering Tools','Model an optimization problem to replicate a practical situation',0.4),
('Calculus','Spring',2016,271,310082419,'Use of Engineering Tools','Model an optimization problem to replicate a practical situation',0.04),
('Calculus','Spring',2016,271,242132470,'Use of Engineering Tools','Model an optimization problem to replicate a practical situation',0.11),
('Calculus','Spring',2016,271,208248363,'Use of Engineering Tools','Model an optimization problem to replicate a practical situation',0.51),
('Calculus','Spring',2016,271,208248363,'Individual and team work','Model an optimization problem to replicate a practical situation',0.51),
('Calculus','Spring',2016,271,598829620,'Individual and team work','Model an optimization problem to replicate a practical situation',0.15),
('Calculus','Spring',2016,271,684014860,'Individual and team work','Model an optimization problem to replicate a practical situation',0.56),
('Calculus','Spring',2016,271,843228181,'Individual and team work','Model an optimization problem to replicate a practical situation',0.61),
('Calculus','Spring',2016,271,820549378,'Individual and team work','Model an optimization problem to replicate a practical situation',0.32),
('Calculus','Spring',2016,271,533572169,'Individual and team work','Model an optimization problem to replicate a practical situation',0.3),
('Calculus','Spring',2016,271,975325712,'Individual and team work','Model an optimization problem to replicate a practical situation',0.4),
('Calculus','Spring',2016,271,310082419,'Individual and team work','Model an optimization problem to replicate a practical situation',0.04),
('Calculus','Spring',2016,271,242132470,'Individual and team work','Model an optimization problem to replicate a practical situation',0.11),
('Calculus','Spring',2016,271,208248363,'Communication Skills','Model an optimization problem to replicate a practical situation',0.51),
('Calculus','Spring',2016,271,208248363,'Communication Skills','Model an optimization problem to replicate a practical situation',0.51),
('Calculus','Spring',2016,271,598829620,'Communication Skills','Model an optimization problem to replicate a practical situation',0.15),
('Calculus','Spring',2016,271,684014860,'Communication Skills','Model an optimization problem to replicate a practical situation',0.56),
('Calculus','Spring',2016,271,843228181,'Communication Skills','Model an optimization problem to replicate a practical situation',0.61),
('Calculus','Spring',2016,271,820549378,'Communication Skills','Model an optimization problem to replicate a practical situation',0.32),
('Calculus','Spring',2016,271,533572169,'Communication Skills','Model an optimization problem to replicate a practical situation',0.3),
('Calculus','Spring',2016,271,975325712,'Communication Skills','Model an optimization problem to replicate a practical situation',0.4),
('Calculus','Spring',2016,271,310082419,'Communication Skills','Model an optimization problem to replicate a practical situation',0.04),
('Calculus','Spring',2016,271,242132470,'Communication Skills','Model an optimization problem to replicate a practical situation',0.11),
('Calculus','Spring',2016,271,208248363,'Communication Skills','Model an optimization problem to replicate a practical situation',0.51),
('Calculus','Spring',2016,271,208248363,'Professionalism','Model an optimization problem to replicate a practical situation',0.51),
('Calculus','Spring',2016,271,598829620,'Professionalism','Model an optimization problem to replicate a practical situation',0.15),
('Calculus','Spring',2016,271,684014860,'Professionalism','Model an optimization problem to replicate a practical situation',0.56),
('Calculus','Spring',2016,271,843228181,'Professionalism','Model an optimization problem to replicate a practical situation',0.61),
('Calculus','Spring',2016,271,820549378,'Professionalism','Model an optimization problem to replicate a practical situation',0.32),
('Calculus','Spring',2016,271,533572169,'Professionalism','Model an optimization problem to replicate a practical situation',0.3),
('Calculus','Spring',2016,271,975325712,'Professionalism','Model an optimization problem to replicate a practical situation',0.4),
('Calculus','Spring',2016,271,310082419,'Professionalism','Model an optimization problem to replicate a practical situation',0.04),
('Calculus','Spring',2016,271,242132470,'Professionalism','Model an optimization problem to replicate a practical situation',0.11),
('Calculus','Spring',2016,271,208248363,'Professionalism','Model an optimization problem to replicate a practical situation',0.51),
('Calculus','Spring',2016,271,208248363,'Impact of engineering on society and the environment','Model an optimization problem to replicate a practical situation',0.51),
('Calculus','Spring',2016,271,598829620,'Impact of engineering on society and the environment','Model an optimization problem to replicate a practical situation',0.15),
('Calculus','Spring',2016,271,684014860,'Impact of engineering on society and the environment','Model an optimization problem to replicate a practical situation',0.56),
('Calculus','Spring',2016,271,843228181,'Impact of engineering on society and the environment','Model an optimization problem to replicate a practical situation',0.61),
('Calculus','Spring',2016,271,820549378,'Impact of engineering on society and the environment','Model an optimization problem to replicate a practical situation',0.32),
('Calculus','Spring',2016,271,533572169,'Impact of engineering on society and the environment','Model an optimization problem to replicate a practical situation',0.3),
('Calculus','Spring',2016,271,975325712,'Impact of engineering on society and the environment','Model an optimization problem to replicate a practical situation',0.4),
('Calculus','Spring',2016,271,310082419,'Impact of engineering on society and the environment','Model an optimization problem to replicate a practical situation',0.04),
('Calculus','Spring',2016,271,242132470,'Impact of engineering on society and the environment','Model an optimization problem to replicate a practical situation',0.11),
('Calculus','Spring',2016,271,208248363,'Impact of engineering on society and the environment','Model an optimization problem to replicate a practical situation',0.51),
('Calculus','Spring',2016,271,208248363,'Ethics and Equity','Model an optimization problem to replicate a practical situation',0.51),
('Calculus','Spring',2016,271,598829620,'Ethics and Equity','Model an optimization problem to replicate a practical situation',0.15),
('Calculus','Spring',2016,271,684014860,'Ethics and Equity','Model an optimization problem to replicate a practical situation',0.56),
('Calculus','Spring',2016,271,843228181,'Ethics and Equity','Model an optimization problem to replicate a practical situation',0.61),
('Calculus','Spring',2016,271,820549378,'Ethics and Equity','Model an optimization problem to replicate a practical situation',0.32),
('Calculus','Spring',2016,271,533572169,'Ethics and Equity','Model an optimization problem to replicate a practical situation',0.3),
('Calculus','Spring',2016,271,975325712,'Ethics and Equity','Model an optimization problem to replicate a practical situation',0.4),
('Calculus','Spring',2016,271,310082419,'Ethics and Equity','Model an optimization problem to replicate a practical situation',0.04),
('Calculus','Spring',2016,271,242132470,'Ethics and Equity','Model an optimization problem to replicate a practical situation',0.11),
('Calculus','Spring',2016,271,208248363,'Ethics and Equity','Model an optimization problem to replicate a practical situation',0.51),
('Calculus','Spring',2016,271,208248363,'Economics and Project Management','Model an optimization problem to replicate a practical situation',0.51),
('Calculus','Spring',2016,271,598829620,'Economics and Project Management','Model an optimization problem to replicate a practical situation',0.15),
('Calculus','Spring',2016,271,684014860,'Economics and Project Management','Model an optimization problem to replicate a practical situation',0.56),
('Calculus','Spring',2016,271,843228181,'Economics and Project Management','Model an optimization problem to replicate a practical situation',0.61),
('Calculus','Spring',2016,271,820549378,'Economics and Project Management','Model an optimization problem to replicate a practical situation',0.32),
('Calculus','Spring',2016,271,533572169,'Economics and Project Management','Model an optimization problem to replicate a practical situation',0.3),
('Calculus','Spring',2016,271,975325712,'Economics and Project Management','Model an optimization problem to replicate a practical situation',0.4),
('Calculus','Spring',2016,271,310082419,'Economics and Project Management','Model an optimization problem to replicate a practical situation',0.04),
('Calculus','Spring',2016,271,242132470,'Economics and Project Management','Model an optimization problem to replicate a practical situation',0.11),
('Calculus','Spring',2016,271,208248363,'Economics and Project Management','Model an optimization problem to replicate a practical situation',0.51),
('Calculus','Spring',2016,271,208248363,'Life-long Learning','Model an optimization problem to replicate a practical situation',0.51),
('Calculus','Spring',2016,271,598829620,'Life-long Learning','Model an optimization problem to replicate a practical situation',0.15),
('Calculus','Spring',2016,271,684014860,'Life-long Learning','Model an optimization problem to replicate a practical situation',0.56),
('Calculus','Spring',2016,271,843228181,'Life-long Learning','Model an optimization problem to replicate a practical situation',0.61),
('Calculus','Spring',2016,271,820549378,'Life-long Learning','Model an optimization problem to replicate a practical situation',0.32),
('Calculus','Spring',2016,271,533572169,'Life-long Learning','Model an optimization problem to replicate a practical situation',0.3),
('Calculus','Spring',2016,271,975325712,'Life-long Learning','Model an optimization problem to replicate a practical situation',0.4),
('Calculus','Spring',2016,271,310082419,'Life-long Learning','Model an optimization problem to replicate a practical situation',0.04),
('Calculus','Spring',2016,271,242132470,'Life-long Learning','Model an optimization problem to replicate a practical situation',0.11),
('Calculus','Spring',2016,271,208248363,'Life-long Learning','Model an optimization problem to replicate a practical situation',0.51)*/

$stmt9= $mysqli-> prepare ($sql_ScoreUsedFor);
$stmt9->execute (); 
$stmt10= $mysqli-> prepare ($sql_InsertInfo);
$stmt10-> execute ();

?>