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
    
// if everything is ok, update grad year in db
} else {
    $contents = file_get_contents($_FILES["fileToUpload"]["tmp_name"]);
    //echo($contents);
    $grad = preg_split('/\s+/', $contents);
    //print_r($grad);
    //echo(count($grad));
    if(count($grad) == 0){
        echo('No students in file');
    }
    elseif(count($grad) > 0){
        
    //check if students already in students table --> print error if not        
     $sql = "SELECT s.StudentID FROM Students s";

    // Prepared statement, stage 1: prepare
    $stmt = $mysqli->prepare($sql);

    // Prepared statement, stage 2: execute
    $stmt->execute();

    // Bind result variables 
    $stmt->bind_result($Students_StudentID); 

    /* fetch values */ 
    while ($stmt->fetch()) 
    {
      $studentlist = $studentlist . "," . $Students_StudentID;
}
     $studentlist = $studentlist . ",";   
  for ($i = 0; $i < count($grad); ++$i) { 
    if (strpos($studentlist,',' . $grad[$i] . ',') !== false) {
    $sql1 = "UPDATE Students SET GradYear = (SELECT EXTRACT(YEAR FROM CURRENT_DATE)) WHERE StudentID = " . $grad[$i];
    $stmt1= $mysqli-> prepare ($sql1);
    $stmt1->execute (); 
   } else {
            echo('</br> Student ID ' . $grad[$i] . ' is not in current list of students.</br>');
    } 
    }
        echo(' </br> Graduation year for other students in list updated successfully to this year </br>' );
}
}
?>