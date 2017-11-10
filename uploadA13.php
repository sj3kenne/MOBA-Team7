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
        
  for ($i = 1; $i < count($grad); ++$i) { 
    $toInsert = explode(",", $contents);
      if($i == 1){
          // add instructor in instructor table
          //add course info in course info table
      }
    for(j = 0; j < count($toInsert), ++$j){
        // and '' around strings
    }
//inset in db 
    }
        echo(' </br> Graduation year for other students in list updated successfully to this year </br>' );
}
}

?>