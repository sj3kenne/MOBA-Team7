<html>
    <head>
       <title>Graph Filters</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
<header>
	M-OBA
	<img src="waterlooLogo.png" style="height:100%;float:right;"/>
</header>
<body>
    <div id="sidebar">
            <ul>
                <li><a href="sidebar.html" class="fa fa-home" style="font-size:30px;color:#ccc;"></a></li>
                <li><a href="filter-for-graphs.php" class="active">Analytics</a></li>
                <li><a href="filter-for-tables.php">Raw Data</a></li>
                <li><a href="uploading.html">Import</a></li>
            </ul>
        </div>
    <h2> Import Status </h2>
<?php
// Enable error logging: 
error_reporting(E_ALL ^ E_NOTICE);
// mysqli connection via user-defined function
include('./my_connect.php');
$mysqli = get_mysqli_conn();

//$currentDir = getcwd();
//$target_dir = $currentDir;
$target_file =  basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$csvFileType = pathinfo($target_file,PATHINFO_EXTENSION);

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($csvFileType != "csv") {
    echo "<h3> Please upload CSV files. Other file types are not allowed. <h3>";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "<br> Upload Incomplete </br>";
    
// if everything is ok, update db
} else {
    $contents = file_get_contents($_FILES["fileToUpload"]["tmp_name"]);
    
    $grad = explode(";", $contents);
    if(count($grad) == 1){
        echo('No students in file');
    }
    elseif(count($grad) > 1){
        
    for ($i = 1; $i < count($grad)-1; ++$i) { 
    $toInsert = explode(",", $grad[$i]);
      // on the first line add instructor and course information to the database
        if($i == 1){
          $correct = 0;
        $sql1= "INSERT INTO Instructors (LastName, FirstName) Values ('" . $toInsert[8] . "','" . $toInsert[9] . "')";
        $sql2= "INSERT INTO Courses (Deptcode, CourseNumber, CourseName, CourseTerm, CourseYear, CourseType) Values ('" . $toInsert[5] . "','" . $toInsert[6] . "','" . $toInsert[7] . "','" . $toInsert[10] . "','" . $toInsert[11] . "','" . $toInsert[13] . "')";
         $stmt1= $mysqli-> prepare ($sql1);
        
        // if error encountered, print error message to tell the user what went wrong
        if(!$stmt1){
        echo('<h2> Error Log: </h2>');
        echo('<h3> Upload Incomplete! Error updating instructors information on line 1 for instructor pair : "' . $toInsert[8] . ' ' . toInsert[9] . '". Please check file format. </h3>');
         echo('<h3>Instructions for expected file format can be found in the documentation files. </h3> ');
        exit();
    }
          //print success message if code executes correctly
         $stmt1->execute (); 
          $correct ++;
        echo('<h2> Sucess messages: </h2> ');
        echo(' <h3> Instructor '  . $toInsert[9] . ' ' . $toInsert[8] .   ' has been successfully added to the database </h3>' );
          
         $stmt2= $mysqli-> prepare ($sql2);
          
    // wrong file format. exit code
   // if error encountered, print error message to tell the user what went wrong
    if(!$stmt2){
    echo('<h2> Error Log: </h2>');
       echo('<h3> Upload Incomplete! Error updating course information for course info : "' . $toInsert[7] . '". Please check file format. </h3>');
         echo('<h3>Instructions for expected file format can be found in the documentation files. </h3> ');
        exit();
    }  
    //print success message if code executes correctly        
    $stmt2->execute (); 
          if($correct == 0){
             echo('<h2> Sucess messages: </h2> '); 
          }
    echo('<h3> Course '. $toInsert[7] . ' has been successfully added to the database<h3>' );
          
      }
    //for each line add student to student table and add student score to score used for table
      $sql3= "INSERT INTO ScoreUsedFor (CourseName, StudentID, Attribute, Indicator, ProgIndicator, score, DeptCode, CourseNumber, LastName, FirstName, CourseTerm, CourseYear, Cohort, CourseType) VALUES ('" . $toInsert[7] . "'," . $toInsert[0] . ",'" . $toInsert[1] . "','" . $toInsert[2] . "','" . $toInsert[3] . "'," . $toInsert[4] . ",'" . $toInsert[5] . "','" . $toInsert[6] . "','" . $toInsert[8] . "','" . $toInsert[9] . "','" . $toInsert[10] . "','" . $toInsert[11] . "','" . $toInsert[12] . "','" . $toInsert[13] . "')";
      $sqls = "INSERT INTO Students (StudentID) Values (" . $toInsert[0] . ")";
      $stmts= $mysqli-> prepare ($sqls);
      $stmt3= $mysqli-> prepare ($sql3);

        // if error encountered, print error message to tell the user what went wrong    
    if(!$stmt3 or !$sqls){
        
    echo('<h2> Error Log: </h2>');
       echo('<h3> Upload Incomplete! Error adding score information on line  ' . $i . " for student: '" . $toInsert[0] . "' and program indicator '" . $toInsert[3] . "'. Please check file format. </h3>");
         echo('<h3>Instructions for expected file format can be found in the documentation files. </h3> ');
        exit();
    }  
        
      $stmt3->execute (); 
      $stmts->execute ();
     
    }
        //print success message if code executes correctly   
         echo('<h3>Scores for all students in the file has been added to the database.</h3> ');
          
}
}
?>
    <div class="tron">
      </div>
</body>
</html>