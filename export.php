<?php
// Start the session
//used to pass variables to graphs.php
session_start();

//get sql from raw data
$sql = $_SESSION['sql1'];

/*******YOU DO NOT NEED TO EDIT ANYTHING BELOW THIS LINE*******/    
//create MySQL connection   
error_reporting(E_ALL ^ E_NOTICE);
// mysqli connection via user-defined function
include('./my_connect.php');
$mysqli = get_mysqli_conn();
$stmt = $mysqli->prepare($sql);
// Prepared statement, stage 2: execute
$stmt->execute();
$stmt->bind_result($ScoreUsedFor_courseName,$ScoreUsedFor_AttributeName, $ScoreUsedFor_IndicatorName, $ScoreUsedFor_score);

//initialize excel file
$file_ending = "xls";
//header info for browser
header("Content-Type: application/xls");    
header("Content-Disposition: attachment; filename= custom_report.xls");  
header("Pragma: no-cache"); 
header("Expires: 0");
/*******Start of Formatting for Excel*******/   
//define separator (defines columns in excel & tabs in word)
$sep = "\t"; //tabbed character
//start of printing column names as names of MySQL fields
   
echo "Course \t";
echo "Attribute \t";
echo "Indicator \t";
echo  "score \t";

print("\n");    
//end of printing column names  
//start while loop to get data
    while($stmt->fetch())
    {
        //print each line of the code and then go to the next line
        echo  $ScoreUsedFor_courseName;
        $schema_insert = $ScoreUsedFor_courseName . "\t" . $ScoreUsedFor_AttributeName. "\t" . $ScoreUsedFor_IndicatorName. "\t" . $ScoreUsedFor_score;
        
        $schema_insert = str_replace($sep."$", "", $schema_insert);
        $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
        $schema_insert .= "\t";
        print(trim($schema_insert));
        print "\n";
    }


?>