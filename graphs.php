<html>

<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

	<div id="sidebar">
		
			<ul>
				<li><a href="sidebar.html" class="fa fa-home" style="font-size:30px;color:#ccc;"></a></li>
				<li><a href="graphs.php" class="active">Analytics</a></li>
				<li><a href="raw-data.php">Raw Data</a></li>
				<li><a href="uploading.html">Import</a></li>
			</ul>
		</div>
	</body>

<?php
// Start the session
//used to pass variables from raw-data.php
session_start();
?>

<?php
// Enable error logging: 
error_reporting(E_ALL ^ E_NOTICE);
// mysqli connection via user-defined function
include('./my_connect.php');
$mysqli = get_mysqli_conn();
$ID = $_SESSION['courses'];
$ID2 = $_SESSION['attributes'];

//$ID= $_GET['selectedcourse'];
//$ID2 = $_GET['selectedattributes'];

//populated courses array 
$inlist =  "'" . $ID[0] . "'";
    for ($i = 1; $i < count($ID); ++$i) {
        $inlist =  $inlist . ", '" . $ID[$i] . "'";
    }
//populated attributes array 
$inlist2 =  "'" . $ID2[0] . "'";
    for ($i = 1; $i < count($ID2); ++$i) {
        $inlist2 =  $inlist2 . ", '" . $ID2[$i] . "'";
    }
//THIS IS AVERAGE SCORE        
$sql1 = "SELECT AVG(s.score) 
		 FROM scoreusedfor s
		 WHERE s.courseName IN ($inlist) AND s.AttributeName IN ($inlist2)";

// Prepared statement, stage 1: prepare
//$stmt1 = $mysqli->prepare($sql1);

// (2) Handle GET parameters; aid is the name of the hidden textbox in the previous page
$stmt1= $mysqli-> prepare ($sql1);
    //$stmt1->bind_param('i', $ID); 
$stmt1->execute (); 

// $stmt->execute() function returns boolean indicating success 
$stmt1->bind_result($ScoreUsedFor_score);
echo '<p>'.'Stats are as follows:'.'</p>';
echo '<p>'.'Mean is:'.'</p>';    
while ($stmt1->fetch()) 
{
// printf is print format, <li> is list item
//printf ('%s %s %s %s %s %s <br>',$Model_Year,$Model_Model,$Model_Type, $Model_Price, $Cars_Colour, $Discount_Discount_Type);
echo ' <td>'.$ScoreUsedFor_score.'</td>';
}
$stmt1->close();    

//THIS IS THE STANDARD DEVIATION
$sql2 = "SELECT STDDEV(s.score) 
		 FROM scoreusedfor s
		 WHERE s.courseName IN ($inlist) AND s.AttributeName IN ($inlist2)";

// Prepared statement, stage 1: prepare
//$stmt1 = $mysqli->prepare($sql1);

// (2) Handle GET parameters; aid is the name of the hidden textbox in the previous page
$stmt2= $mysqli-> prepare ($sql2);
    //$stmt1->bind_param('i', $ID); 
$stmt2->execute (); 

// $stmt->execute() function returns boolean indicating success 
$stmt2->bind_result($ScoreUsedFor_score);
echo '<p>'.'Standard deviation is:'.'</p>';
while ($stmt2->fetch()) 
{
// printf is print format, <li> is list item
//printf ('%s %s %s %s %s %s <br>',$Model_Year,$Model_Model,$Model_Type, $Model_Price, $Cars_Colour, $Discount_Discount_Type);
echo ' <p>'.$ScoreUsedFor_score.'</p>';
}
$stmt2->close();        
  
        
//THIS IS THE GRAPHING DATA        
$sql3 = "SELECT s.score 
		 FROM scoreUsedFor s 
		 WHERE s.courseName IN ($inlist) AND s.AttributeName IN ($inlist2)";

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


    <p>Before Graph</p>

    <head>
       <title>Graph Page</title>
    </head>

        
            <meta charset="utf-8">
            <style>    
            .bar {
              fill: steelblue;
            }
            .axis text {
              font: 10px sans-serif;
            }
            .axis path,
            .axis line {
              fill: none;
              stroke: #000;
              shape-rendering: crispEdges;
            }
            .x.axis path {
              display: none;
            }     
            .chart rect {
              fill: steelblue;
            }
/*
            .chart text {
              fill: white;
              font: 10px sans-serif;
              text-anchor: middle;
            }
*/
            </style>
            <svg class="chart"></svg>
            <script src="//d3js.org/d3.v3.min.js" charset="utf-8"></script>
            <script>
            
            //alert("script!");
            function runs(){
                //alert("function begins");

                

                    
                var data = [4, 8, 15, 16, 23];
                
                
                
                
                var svg = d3.select("svg"),
                    margin = {top: 20, right: 30, bottom: 30, left: 40},
                    width = 700 - margin.left - margin.right,
                    height = 500 - margin.top - margin.bottom;
                
                var barHeight = 700;
                
                
                var x = d3.scale.ordinal()
                    .domain(["<60%","60-70%","70%-80%","80%-90%","90-100%"])
                    .rangeBands([0, width]);
                
                var y = d3.scale.linear()
                    .domain([0, d3.max(data)])
                    .range([height, 0]);

                var xAxis = d3.svg.axis()
                    .scale(x)
                    .orient("bottom");
                
                var yAxis = d3.svg.axis()
                    .scale(y)
                    .orient("left");
                
                
                
                
                var chart = d3.select(".chart")
                    .attr("width", width + margin.left + margin.right)
                    .attr("height", height + margin.top + margin.bottom)
                  .append("g")
                    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

//                
//THIS IS THE AXES                
                  chart.append("g")
                      .attr("class", "x axis")
                      .attr("transform", "translate(0," + height + ")")
                      .call(xAxis);

                  chart.append("g")
                      .attr("class", "y axis")
                      .call(yAxis);
                    
                var barWidth = width / data.length;

//THIS IS AN ATTEMPTED MESHING OF THE TWO>>> only creates one column...                
                  chart.selectAll(".bar")
                      .data(data)
                    .enter().append("rect")
                       // .attr("transform", function(d, i) { return "translate(" + i * barWidth + ",0)"; });
                
                //chart.append("rect")
                    .attr("class", "bar")
                      .attr("x", function(d, i) { return i * barWidth; }) //{ return "translate(" + i * barWidth + ",0)"; });
                      .attr("y", function(d) { return y(d); })
                      .attr("height", function(d) { return height - y(d); })
                      .attr("width", x.rangeBand());
       
                
//THIS IS THE WORKING BAR GRAPH COLUMNS                
//                var bar = chart.selectAll("g")
//                    .data(data)
//                  .enter().append("g")
//                    .attr("transform", function(d, i) { return "translate(" + i * barWidth + ",0)"; });
//
//                bar.append("rect")
//                    .attr("y", (function(d) { return y(d); }))
//                    .attr("height", (function(d) {return ((height - y(d)));}))
//                    .attr("width", x.rangeBand());

                
                
                
                
//THIS IS TEXT IN THE BARS                
//                bar.append("text")
//                    .attr("x", x.rangeBand() / 2)
//                    .attr("y", function(d) { return y(d) + 3; })
//                    .attr("dy", ".75em")
//                    .text(function (d) { return d; });
                               

                                                                

                
                //did it work?
                //alert("function is working!");

            }
            runs();
        </script>
    
    
    <p>After Graph</p>    
</html>

           

