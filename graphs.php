<html>
    <head>
       <title>Graph Page</title>
    </head>
    <body>
        
        <p>Before Graph</p>
        <div class="chart"></div>
        <p>After Graph</p>
        
        <style>
            .chart div {
                font: 10px sans-serif;
                background-color: steelblue;
                text-align: right;
                padding: 3px;
                margin: 1px;
                color: white;
            }
        </style>
        
<?php
// Enable error logging: 
error_reporting(E_ALL ^ E_NOTICE);
// mysqli connection via user-defined function
include('./my_connect.php');
$mysqli = get_mysqli_conn();
$ID= $_GET['selectedcourse'];
$ID2 = $_GET['selectedattributes'];

//THIS IS THE STANDARD DEVIATION
$sql1 = "select STDDEV(s.score) FROM ScoreUsedFor s";

// Prepared statement, stage 1: prepare
//$stmt1 = $mysqli->prepare($sql1);

// (2) Handle GET parameters; aid is the name of the hidden textbox in the previous page
$stmt1= $mysqli-> prepare ($sql1);
    //$stmt1->bind_param('i', $ID); 
$stmt1->execute (); 

// $stmt->execute() function returns boolean indicating success 
$stmt1->bind_result($ScoreUsedFor_score);
echo '<p>'.'Stats are as follows:'.'</p>';
echo '<p>'.'Standard deviation for attribute 8 is:'.'</p>';
while ($stmt1->fetch()) 
{
// printf is print format, <li> is list item
//printf ('%s %s %s %s %s %s <br>',$Model_Year,$Model_Model,$Model_Type, $Model_Price, $Cars_Colour, $Discount_Discount_Type);
echo ' <p>'.$ScoreUsedFor_score.'</p>';

}
$stmt1->close();        

//THIS IS AVERAGE SCORE        
$sql2 = "select AVG(s.score) FROM ScoreUsedFor s";

// Prepared statement, stage 1: prepare
//$stmt1 = $mysqli->prepare($sql1);

// (2) Handle GET parameters; aid is the name of the hidden textbox in the previous page
$stmt2= $mysqli-> prepare ($sql2);
    //$stmt1->bind_param('i', $ID); 
$stmt2->execute (); 

// $stmt->execute() function returns boolean indicating success 
$stmt2->bind_result($ScoreUsedFor_score);

echo '<p>'.'Mean for attribute 8 is:'.'</p>';    
while ($stmt2->fetch()) 
{
// printf is print format, <li> is list item
//printf ('%s %s %s %s %s %s <br>',$Model_Year,$Model_Model,$Model_Type, $Model_Price, $Cars_Colour, $Discount_Discount_Type);
echo ' <p>'.$ScoreUsedFor_score.'</p>';

}
$stmt2->close();      
        
//THIS IS THE GRAPHING DATA        
$sql3 = "SELECT s.score FROM scoreUsedFor s WHERE s.AttributeName  = 1";

// Prepared statement, stage 1: prepare
//$stmt3 = $mysqli->prepare($sql3);

// (2) Handle GET parameters; aid is the name of the hidden textbox in the previous page
$stmt3= $mysqli-> prepare ($sql3);
//$stmt3->bind_param('i', $ID); 
$stmt3->execute (); 

// $stmt3->execute() function returns boolean indicating success 
$stmt3->bind_result($ScoreUsedFor_score);

    $bin1 = array();
    $bin2 = array();
    $bin3 = array();
    $bin4 = array();
    $bin5 = array();

    //echo ' <p>'.$ScoreUsedFor_score.'<br>'.'does this work'.'</p>';

    while ($stmt3->fetch())
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

    $printstring= $count1 . ' ' . $count2 . ' ' . $count3 . ' ' . $count4 . ' ' . $count5 . ' ';

$stmt3->close();
$mysqli->close();
?>         
        
        <script src="https://d3js.org/d3.v3.min.js" charset="utf-8"></script>
        <script>
            //alert("script!");
            function runs(){
                //alert("function begins");

                
                var stringtosplit = "<?php echo $printstring?>"; 
                
                //var stringtosplit = "1 2 3 4 5 " 
                //alert((stringtosplit));
                var data1 = stringtosplit.split(" ");
                for(var i=0;i<data1.length;i++){data1[i]= parseInt(data1[i],10);}
                data1.pop();
                
                //alert(data1[2]);
            
                var data = data1;
                    
                //var data = [4,6,78,6,4];
                
                d3.select("body")
                    .style("color", "black")
                    .style("background-color", "white");
                d3.select(".chart")
                  .selectAll("div")
                  .data(data)
                  .enter().append("div")
                  .style("width", function(d) { return d * 15 + "px"; })
                  .text(function(d) { return d; });
                
                //did it work?
                //alert("function is working!");

            }
            runs();
        </script>


    </body>
</html>


           

