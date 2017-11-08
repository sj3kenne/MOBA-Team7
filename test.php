<html>
<body>
<h3> Stats are as follows: </h3>
    <P> Standard deviation for attribute 8 is:</P>
<?php
// Enable error logging: 
error_reporting(E_ALL ^ E_NOTICE);
// mysqli connection via user-defined function
include('./my_connect.php');
$mysqli = get_mysqli_conn();
$ID= $_GET['selectedcourse'];
$ID2 = $_GET['selectedattributes'];

$sql1 = "SELECT s.score FROM scoreUsedFor s WHERE s.AttributeName  = 1";

// Prepared statement, stage 1: prepare
//$stmt1 = $mysqli->prepare($sql1);

// (2) Handle GET parameters; aid is the name of the hidden textbox in the previous page
$stmt1= $mysqli-> prepare ($sql1);
//$stmt1->bind_param('i', $ID); 
$stmt1->execute (); 

// $stmt->execute() function returns boolean indicating success 
$stmt1->bind_result($ScoreUsedFor_score);

    $bin1 = array();
    $bin2 = array();
    $bin3 = array();
    $bin4 = array();
    $bin5 = array();

    //echo ' <p>'.$ScoreUsedFor_score.'<br>'.'does this work'.'</p>';

    while ($stmt1->fetch())
    {   


        //echo ' <p>'.$ScoreUsedFor_score.'<br>'.'yes'.'</p>';
        //echo gettype($ScoreUsedFor_score.'<br.';

        $float= $ScoreUsedFor_score;
        $float=(double)$float;

        //echo ' <p>'.$float.'<br>'.'float'.'</p>';

        if ($float >= 0.8) {
            $bin1[] = $float;
        }elseif($float>=0.7){
            $bin2[] = $float;
        }elseif($float>=0.6){
            $bin3[] = $float;
        }elseif($float>=0.5){
            $bin4[] = $float;
        }elseif($float<0.5){
            $bin5[] = $float;
        } 


    } 

    $count1 = count($bin1);
    $count2 = count($bin2);                   
    $count3 = count($bin3);              
    $count4 = count($bin4);
    $count5 = count($bin5);

    $printstring= $count1 . ' ' . $count2 . '  ' . $count3 . ' ' . $count4 . ' ' . $count5 . ' ';

    echo $printstring;
    
$stmt1->close();
$mysqli->close();
?>

<P> Mean for attribute 8 is:</P>
<?php

$ID= 'TestCourse';
    //$ID = $_GET['ID'];


$sql2 = "select AVG(s.score) FROM ScoreUsedFor s";

// Prepared statement, stage 1: prepare
//$stmt1 = $mysqli->prepare($sql1);

// (2) Handle GET parameters; aid is the name of the hidden textbox in the previous page
$stmt2= $mysqli-> prepare ($sql2);
    //$stmt1->bind_param('i', $ID); 
$stmt2->execute (); 

// $stmt->execute() function returns boolean indicating success 
$stmt2->bind_result($ScoreUsedFor_score);

while ($stmt2->fetch()) 
{
// printf is print format, <li> is list item
//printf ('%s %s %s %s %s %s <br>',$Model_Year,$Model_Model,$Model_Type, $Model_Price, $Cars_Colour, $Discount_Discount_Type);
echo ' <p>'.$ScoreUsedFor_score.'</p>';

}
$stmt2->close();
$mysqli->close();

?>
    
<div class="tron">
      </div>
</body>
</html>