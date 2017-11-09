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
    $file = fopen($_FILES["fileToUpload"]["tmp_name"] . '.csv', 'r');
while (($line = fgetcsv($file)) !== FALSE) {
   //$line[0] = '1004000018' in first iteration
   print_r( "newline" . $line);
}
fclose($file);
    }
    elseif(count($grad) > 0){
        
   
  for ($i = 0; $i < count($grad); ++$i) { 
    if (strpos($studentlist,'"' . $grad[$i] . '"') !== false) {
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