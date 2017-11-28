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

$target_file =  basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$csvFileType = pathinfo($target_file,PATHINFO_EXTENSION);

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats (only csv)
if($csvFileType != "csv") {
    echo "<h3> Please upload CSV files. Other file types are not allowed. </h3>";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "<h3> Upload Incomplete </h3>";
    
// if everything is ok, update db
} else {
    $contents = file_get_contents($_FILES["fileToUpload"]["tmp_name"]);
    //echo($contents);
    $grad = preg_split('/\s+/', $contents);
    //print_r($grad);
    //echo(count($grad));
    if(count($grad) == 0){
        echo('<h3> No students in file </h3>');
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
        //concatenate all lists of students in db already into one long string
      $studentlist = $studentlist . "," . $Students_StudentID;
}
     $studentlist = $studentlist . ",";   
  for ($i = 0; $i < count($grad)-1; ++$i) { 
      $count =0;
      $studentPair = explode(',', $grad[$i]);
      
    //check if student in each row of csv file has a corresponding student id in the students table in db  //if id found in db, update graduation year
    if (strpos($studentlist,',' . $studentPair[0] . ',') !== false) {
  
    $sql1 = "UPDATE Students SET GradYear = " . ($studentPair[1]). " WHERE StudentID = " . $studentPair[0];
          $stmt1= $mysqli-> prepare ($sql1);
        
    // wrong file format. exit code
    if(!$stmt1){
       echo('<h3> Error updating students after line ' . ($i + 1) . ' for student : "' . ($studentPair[0]). '" and year: "'  . ($studentPair[1]). '". Please check file format. </h3>');
         echo('<h3>Instructions for expected file format can be found in the documentation files. </h3> ');
        exit();
    }
 
    $stmt1->execute (); 
        
    // if error encountered where student nt found in db            
   } else {
        $count++;
        if($count == 1){
            echo('<h2> Error log: </h2> ');
        }
        //if id not found in db, print error message to user
            echo('<h3> Student ID ' . $studentPair[0] . ' is not in current list of students.</h3>');
    }

    }
         // if no error encountered in db  
        if($count == 0){
            echo('<h3> Graduation years for all students in file updated </h3> ');
        }
         // if errors printed and other rows ok
        else if ($count >0 ){
            echo('<h2> Sucess messages: </h2> ');
            echo('<h3> Graduation years for remaining students in file updated </h3> ');
        }

}
}
?>
        <div class="tron">
      </div>
</body>
</html>