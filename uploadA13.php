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
    //echo($contents);
    $grad = explode(");", $contents);
    //print_r($grad);
    //echo(count($grad));
    if(count($grad) == 0){
        echo('No students in file');
    }
    elseif(count($grad) == 3){
        $grad[0] = str_replace( '"', '' , $grad[0]);
        $sql1= "INSERT INTO Instructors (LastName, FirstName) Values "  . $grad[0];
        $grad[1] = str_replace( '"', '' , $grad[1]);
        $sql2= "INSERT INTO Courses (Deptcode, CourseNumber, CourseName, CourseTerm, CourseYear, CourseType) Values "  . $grad[1] ;

        echo($sql1);
        echo($sql2);
         $stmt1= $mysqli-> prepare ($sql1);
 
        
    // wrong file format. exit code
        echo($stmt1);
    if(!$stmt1){
    echo('<h2> Error Log: </h2>');
       echo('<h3> Upload Incomplete! Error updating instructors information on line 1 for instructor pair : "' . $grad[0] . '". Please check file format. </h3>');
         echo('<h3>Instructions for expected file format can be found in the documentation files. </h3> ');
        exit();
    }
        
        $stmt1->execute (); 
        
         $stmt2= $mysqli-> prepare ($sql2);
        
    echo('<h2> Sucess messages: </h2> ');
    echo(' <h3> Instructor "'  . $grad[0] .   '" has been successfully updated </h3>' );
  
    // wrong file format. exit code
    if(!$stmt2){
    echo('<h2> Error Log: </h2>');
       echo('<h3> Upload Incomplete! Error updating course information on line 2 for course info : "' . $grad[1] . '". Please check file format. </h3>');
         echo('<h3>Instructions for expected file format can be found in the documentation files. </h3> ');
        exit();
    }
                 $stmt2->execute (); 
                        echo('<h3> Course "'. $grad[1] . '" has been successfully updated<h3>' );
      $grad[2] = str_replace( '"', '' , $grad[2]);
      $sql3= "INSERT INTO ScoreUsedFor (CourseName, StudentID, Attribute, Indicator, ProgIndicator, score, DeptCode, CourseNumber, LastName, FirstName, CourseTerm, CourseYear, Cohort, CourseType) VALUES" . $grad[2];
      //echo('</br> '. $sql3 . '</br>');
      $stmt3= $mysqli-> prepare ($sql3);
 
    if(!$stmt3){
        echo('<h2> Error Log: </h2>');
       echo('<h3> Upload Incomplete! Error updating student grades. Please check file format</h3>');
         echo('<h3>Instructions for expected file format can be found in the documentation files. </h3> ');
        exit();
    }
              $stmt3->execute ();

}
        if(count($grad) > 3){
        echo('Extra arguements found. Please check file format.');
    }
}
?>
    <div class="tron">
      </div>
</body>
</html>