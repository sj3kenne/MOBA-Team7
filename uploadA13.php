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
    echo "<br> Please upload CSV files. Other file types are not allowed. </br>";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "<br> Upload Incomplete </br>";
    
// if everything is ok, update db
} else {
    
    $contents = file_get_contents($_FILES["fileToUpload"]["tmp_name"]);
    
    $grad = explode(";", $contents);
    //print_r($grad);
    //echo(count($grad));
    if(count($grad) == 1){
        echo('No students in file');
    }
    elseif(count($grad) > 1){
        
  for ($i = 1; $i < count($grad)-1; ++$i) { 
    $toInsert = explode(",", $grad[$i]);
    //print_r($toInsert);
      if($i == 1){
        $sql1= "INSERT INTO Instructors (LastName, FirstName) Values ('" . $toInsert[8] . "','" . $toInsert[9] . "')";
        echo(' </br> Instructor ' . $toInsert[9] . ' ' . $toInsert[8] . ' has been added to Instructors table </br>' );
         //echo($sql1);
        $sql2= "INSERT INTO Courses (Deptcode, CourseNumber, CourseName, CourseTerm, CourseYear, CourseType) Values ('" . $toInsert[5] . "','" . $toInsert[6] . "','" . $toInsert[7] . "','" . $toInsert[10] . "','" . $toInsert[11] . "','" . $toInsert[13] . "')";
        echo(' </br> '. $toInsert[7] . ' has been added to Courses table </br>' );
        //echo($sql2);
         $stmt1= $mysqli-> prepare ($sql1);
         $stmt1->execute (); 

         $stmt2= $mysqli-> prepare ($sql2);
         $stmt2->execute (); 
      }

      $sql3= "INSERT INTO ScoreUsedFor (CourseName, StudentID, Attribute, Indicator, ProgIndicator, score, DeptCode, CourseNumber, LastName, FirstName, CourseTerm, CourseYear, Cohort, CourseType) VALUES ('" . $toInsert[7] . "'," . $toInsert[0] . ",'" . $toInsert[1] . "','" . $toInsert[2] . "','" . $toInsert[3] . "'," . $toInsert[4] . ",'" . $toInsert[5] . "','" . $toInsert[6] . "','" . $toInsert[8] . "','" . $toInsert[9] . "','" . $toInsert[10] . "','" . $toInsert[11] . "','" . $toInsert[12] . "','" . $toInsert[13] . "')";
      //echo('</br> '. $sql3 . '</br>');
      $stmt3= $mysqli-> prepare ($sql3);
      $stmt3->execute (); 
     
    }
          echo(' </br> Scores for all students in file are successfully updated </br>' );
}
}
?>