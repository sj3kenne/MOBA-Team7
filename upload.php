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
      $studentlist = $studentlist . "," . $Students_StudentID;
}
     $studentlist = $studentlist . ",";   
  for ($i = 0; $i < count($grad); ++$i) { 
      //echo($studentlist);
    if (strpos($studentlist,',' . $grad[$i] . ',') !== false) {
    $sql1 = "UPDATE Students SET GradYear = (SELECT EXTRACT(YEAR FROM CURRENT_DATE)) WHERE StudentID = " . $grad[$i];
    $stmt1= $mysqli-> prepare ($sql1);
    $stmt1->execute (); 
   } else {
            echo('<h3> Student ID ' . $grad[$i] . ' is not in current list of students.</h3>');
    } 
    }
        echo(' <h3> Graduation year for other students in list updated successfully to this year </h3>' );
}
}
?>
        <div class="tron">
      </div>
</body>
</html>