<html>
    <head>
       <title>Analytics</title>
       <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
<header>
    M-OBA
    <img src="waterlooLogo.png" style="height:100%;float:right;"/>

</header>
<body>
<form action="raw-data.php" method="get">

    <div id="sidebar">
        
            <ul>
                <li><a href="sidebar.html" class="fa fa-home" style="font-size:30px;color:#ccc;"></a></li>
                <li><a href="filter-for-graphs.php">Analytics</a></li>
                <li><a href="filter-for-tables.php" class="active">Raw Data</a></li>
                <li><a href="uploading.html">Import</a></li>
            </ul>
        </div>



<?php
// Enable error logging: 
error_reporting(E_ALL ^ E_NOTICE);
// mysqli connection via user-defined function
include('./my_connect.php');
$mysqli = get_mysqli_conn();
$ID = $_GET['selectedattributes'];
$ID2 = $_GET['selectedcohorts'];
//$ID3 = $_GET['selectedcourses'];
$ID4 = $_GET['selectedclass'];
$ID5 = $_GET['selectedinstructor'];
//----------------------------------------------------------------------------------------------------
//populated attributes array 
$inlist =  "'" . $ID[0] . "'";
    for ($i = 1; $i < count($ID); ++$i) {
        $inlist =  $inlist . ", '" . $ID[$i] . "'";
    }
print $inlist;
//populated cohorts array 
$inlist2 =  "'" . $ID2[0] . "'";
    for ($i = 1; $i < count($ID2); ++$i) {
        $inlist2 =  $inlist2 . ", '" . $ID2[$i] . "'";
    }
/*//populated courses array 
$inlist3 =  "'" . $ID3[0] . "'";
    for ($i = 1; $i < count($ID3); ++$i) {
        $inlist3 =  $inlist3 . ", '" . $ID3[$i] . "'";
    }
	*/
//populated grad year array 
$inlist4 =  "'" . $ID4[0] . "'";
//populated instructor array 
$inlist5 =  "'" . $ID5[0] . "'";
    for ($i = 1; $i < count($ID5); ++$i) {
        $inlist5 =  $inlist5 . ", '" . $ID5[$i] . "'";
    } 
//-------------------------------------------------------------------------------------------------------- 
//THIS IS THE GRAPHING DATA: 
for ($i = 0; $i < count($ID); ++$i) {
//if all cohorts selected
if($inlist4=="'All Program'"){
	${'sql'.$i} = "SELECT s.score  
	FROM ScoreUsedFor s 
	WHERE s.Attribute IN ('$ID[$i]') AND s.Cohort IN ($inlist2)";
}
else
{
//if one cohort selected
	${'sql'.$i} = "SELECT s.score  
	FROM ScoreUsedFor s JOIN students s1 
	WHERE s.Attribute IN ('$ID[$i]') AND s.Cohort IN ($inlist2) AND s.StudentID=s1.StudentID AND s1.GradYear IN ($inlist4)";
}
print ${'sql'.$i};
echo '<br>'; 
//-------------------------------------------------------------------------------------------------------
// Prepared statement, stage 1: prepare
//$stmt3 = $mysqli->prepare($sql3);
// (2) Handle GET parameters; aid is the name of the hidden textbox in the previous page
${'stmt'.$i}= $mysqli-> prepare (${'sql'.$i});
//$stmt3->bind_param('i', $ID); 
${'stmt'.$i}->execute (); 
// $stmt3->execute() function returns boolean indicating success 
${'stmt'.$i}->bind_result($ScoreUsedFor_score);
    $bin1 = array();
    $bin2 = array();
    $bin3 = array();
    $bin4 = array();
    $bin5 = array();
    //echo ' <p>'.$ScoreUsedFor_score.'<br>'.'does this work'.'</p>';
    while (${'stmt'.$i}->fetch())
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
    
    ${'printstring'.$i}= $count5 . ' ' . $count4 . ' ' . $count3 . ' ' . $count2 . ' ' . $count1 . ' ';
   }
    
    $numofattr = 3;

    
    
//$stmt3->close();
//$mysqli->close();
?>
    
<head>
    <meta charset="utf-8">
     <title>Graph Page</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    .bartext{
      fill: red;
      font: 10px sans-serif;
      text-anchor: middle;
      background-color: red;
      text-align: right;
      padding: 3px;
      margin: 1px;
      color: white;
    }
/*
    .chart text2 {
      fill: black;
      font: 10px sans-serif;
      text-anchor: middle;
    }
    .chart bartext{
      fill: white;
      font: 10px sans-serif;
      text-anchor: middle;
    }                
*/
    </style>
</head>

<body>


	<div id="sidebar">
		
			<ul>
				<li><a href="sidebar.html" class="fa fa-home" style="font-size:30px;color:#ccc;"></a></li>
				<li><a href="filter-for-graphs.php" class="active">Analytics</a></li>
				<li><a href="filter-for-tables.php">Raw Data</a></li>
				<li><a href="uploading.html">Import</a></li>
			</ul>
		</div>
            <div id="area0"></div>
            <div id="area1"></div>
            <div id="area2"></div>
            <div id="area3"></div>
            <div id="area4"></div>
            <div id="area5"></div>
            <div id="area6"></div>
            <div id="area7"></div>
            <div id="area8"></div>
            <div id="area9"></div>
            <div id="area10"></div>
            <div id="area11"></div>
            <div id="area12"></div>
            <div id="area13"></div>
            <div id="area14"></div>
            <div id="area15"></div>
            <div id="area16"></div>
            <div id="area17"></div>
            <div id="area18"></div>
            <div id="area19"></div>
            <div id="area20"></div>
            <div id="area21"></div>
            <div id="area22"></div>
            <div id="area23"></div>
            <div id="area24"></div>
            <div id="area25"></div>
            <div id="area26"></div>
            <div id="area27"></div>
            <div id="area28"></div>
            <div id="area29"></div>
            <div id="area30"></div>
            <div id="area31"></div>
            <div id="area32"></div>
            <div id="area33"></div>
            <div id="area34"></div>
            <div id="area35"></div>
            <div id="area36"></div>
            <div id="area37"></div>
            <div id="area38"></div>
            <div id="area39"></div>
            <div id="area40"></div>
            <div id="area41"></div>
            <div id="area42"></div>
            <div id="area43"></div>
            <div id="area44"></div>
            <div id="area45"></div>
            <div id="area46"></div>
            <div id="area47"></div>
            <div id="area48"></div>
            <div id="area49"></div>
            <div id="area50"></div>
            <div id="area51"></div>
            <div id="area52"></div>
            <div id="area53"></div>
            <div id="area54"></div>
            <div id="area55"></div>
            <div id="area56"></div>
            <div id="area57"></div>
            <div id="area58"></div>
            <div id="area59"></div>
            <div id="area60"></div>
            <div id="area61"></div>
            <div id="area62"></div>
            <div id="area63"></div>
            <div id="area64"></div>
            <div id="area65"></div>
            <div id="area66"></div>
            <div id="area67"></div>
            <div id="area68"></div>
            <div id="area69"></div>
            <div id="area70"></div>
            <div id="area71"></div>
            <div id="area72"></div>
            <div id="area73"></div>
            <div id="area74"></div>
            <div id="area75"></div>
            <div id="area76"></div>
            <div id="area77"></div>
            <div id="area78"></div>
            <div id="area79"></div>
            <div id="area80"></div>
            <div id="area81"></div>
            <div id="area82"></div>
            <div id="area83"></div>
            <div id="area84"></div>
            <div id="area85"></div>
            <div id="area86"></div>
            <div id="area87"></div>
            <div id="area88"></div>
            <div id="area89"></div>
            <div id="area90"></div>
            <div id="area91"></div>
            <div id="area92"></div>
            <div id="area93"></div>
            <div id="area94"></div>
            <div id="area95"></div>
            <div id="area96"></div>
            <div id="area97"></div>
            <div id="area98"></div>
            <div id="area99"></div>
            <div id="area100"></div>
            <div id="area101"></div>
            <div id="area102"></div>
            <div id="area103"></div>
            <div id="area104"></div>
            <div id="area105"></div>
            <div id="area106"></div>
            <div id="area107"></div>
            <div id="area108"></div>
            <div id="area109"></div>
            <div id="area110"></div>
            <div id="area111"></div>
            <div id="area112"></div>
            <div id="area113"></div>
            <div id="area114"></div>
            <div id="area115"></div>
            <div id="area116"></div>
            <div id="area117"></div>
            <div id="area118"></div>
            <div id="area119"></div>
            <div id="area120"></div>
            <div id="area121"></div>
            <div id="area122"></div>
            <div id="area123"></div>
            <div id="area124"></div>
            <div id="area125"></div>
            <div id="area126"></div>
            <div id="area127"></div>
            <div id="area128"></div>
            <div id="area129"></div>
            <div id="area130"></div>
            <div id="area131"></div>
            <div id="area132"></div>
            <div id="area133"></div>
            <div id="area134"></div>
            <div id="area135"></div>
            <div id="area136"></div>
            <div id="area137"></div>
            <div id="area138"></div>
            <div id="area139"></div>
            <div id="area140"></div>
            <div id="area141"></div>
            <div id="area142"></div>
            <div id="area143"></div>
            <div id="area144"></div>
            <div id="area145"></div>
            <div id="area146"></div>
            <div id="area147"></div>
            <div id="area148"></div>
            <div id="area149"></div>
    
     <svg class="chart"></svg>
            <script src="//d3js.org/d3.v3.min.js" charset="utf-8"></script>
    
            <script>
            // Adapted from http://martin.ankerl.com/2009/12/09/how-to-create-random-colors-programmatically
            var randomColour = (function(){
              var golden_ratio_conjugate = 0.618033988749895;
              var h = Math.random();

              var hslToRgb = function (h, s, l){
                  var r, g, b;

                  if(s == 0){
                      r = g = b = l; // achromatic
                  }else{
                      function hue2rgb(p, q, t){
                          if(t < 0) t += 1;
                          if(t > 1) t -= 1;
                          if(t < 1/6) return p + (q - p) * 6 * t;
                          if(t < 1/2) return q;
                          if(t < 2/3) return p + (q - p) * (2/3 - t) * 6;
                          return p;
                      }

                      var q = l < 0.5 ? l * (1 + s) : l + s - l * s;
                      var p = 2 * l - q;
                      r = hue2rgb(p, q, h + 1/3);
                      g = hue2rgb(p, q, h);
                      b = hue2rgb(p, q, h - 1/3);
                  }
                  return '#'+Math.round(r * 255).toString(16)+Math.round(g * 255).toString(16)+Math.round(b * 255).toString(16);
              };
              return function(){
                h += golden_ratio_conjugate;
                h %= 1;
                return hslToRgb(h, 0.5, 0.60);
              };
            })();
            </script>

            <script>  
                
            function graphs(stringtosplitA, stringtosplitB, histotitle, progtitle, attrNum){
                //alert("function begins");  

                //Split php strings into javascript arrays
                var histogramarray = stringtosplitA.split(" ");
                for(var i=0;i<histogramarray.length;i++){histogramarray[i]= parseInt(histogramarray[i],10);}
                histogramarray.pop();
                
                //Split php strings into javascript arrays
                var progressionarray = stringtosplitB.split(" ");
                for(var i=0;i<progressionarray.length;i++){progressionarray[i]= parseInt(progressionarray[i],10);}
                progressionarray.pop();
                
                //Variable progression axis length
                var progxaxis = ["1A","1B","2A","2B","3A","3B","4A","4B"];
                while (progxaxis.length>progressionarray.length){
                    progxaxis.pop();
                }
                
                var barPadding = 3;
                
                
                //For the First Chart
                var svg = d3
                .select("svg"),
                    margin = {top: 25, right: 30, bottom: 40, left: 40},
                    width = 400 - margin.left - margin.right, //330
                    height = 250 - margin.top - margin.bottom; //185

                var barWidth = width / histogramarray.length;
                var x = d3.scale.ordinal()
                    .domain(["<60%","60-70%","70%-80%","80%-90%","90-100%"])
                    .rangeBands([0, width]);
                var y = d3.scale.linear()
                    .domain([0, d3.max(histogramarray)])
                    .range([height, 0]);
                var xAxis = d3.svg.axis()
                    .scale(x)
                    .orient("bottom");
                var yAxis = d3.svg.axis()
                    .scale(y)
                    .orient("left");       
                //Declare the first Chart
                var chart = d3.select("#area"+attrNum)
                    .append("svg")
                    .attr("width", width + margin.left + margin.right)
                    .attr("height", height + margin.top + margin.bottom)
                  .append("g")
                    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");
                //THIS IS THE AXES                
                chart.append("g")
                      .attr("class", "x axis")
                      .attr("transform", "translate(0," + height + ")")
                      .call(xAxis);
                chart.append("g")
                      .attr("class", "y axis")
                      .call(yAxis);
                //This is the bars themselves
                chart.selectAll(".bar")
                      .data(histogramarray)
                    .enter().append("rect")
                      .attr("class", "bar")
                      .attr("x", function(d, i) { return i * barWidth; }) //{ return "translate(" + i * barWidth + ",0)"; });
                      .attr("y", function(d) { return y(d); })
                      .attr("height", function(d) { return height - y(d); })
                      .attr("width", x.rangeBand() - barPadding)
                      .style({fill: randomColour});
                //Bar Text
                chart.selectAll("g")
                    .data(histogramarray)
                    //.enter()
                    .append("text")
                        .attr("x", //barWidth-(barWidth/2))
                            function(d, i) {
                            if(i!=0){
                                return (barWidth)-barPadding
                            } else { 
                                return (barWidth/2)-barPadding
                            }}) 
                        .attr("y", function(d) {return y(d) - 200;})
                        .attr("dy", "1.4em")
                        .text(function (d, i) { return d; })  
                        .style("font-size", "10px")
                        .style("fill", "black");
                //Y-axis
                chart.append("text")
                        .attr("text-anchor", "middle")
                        .attr("transform", "translate("+ (-20) + ","+ (height/2) + ") rotate(-90)")
                        .text("Number of Students")
                        .style("font-size", "10px");
                //X-axis
                chart.append("text")
                        .attr("text-anchor", "middle")
                        .attr("transform", "translate("+ (width/2) + ","+ (height+30) + ")")
                        .text("Attribute Proficiency")
                        .style("font-size", "10px");
                //Title
                chart.append("text")
                        .attr("text-anchor", "middle")
                        .attr("transform", "translate("+ (width/2) + ","+ (-13) + ")")
                        .text(histotitle + " Histogram of Students");  


                

                //For the second chart
                var svg2 = d3.select("svg"),
                    margin2 = {top: 25, right: 420, bottom: 40, left: 40},
                    width2 = 770 - margin2.left - margin2.right, //330
                    height2 = 250 - margin2.top - margin2.bottom; //185
                var barWidth2 = width2 / progressionarray.length;
                var x2 = d3.scale.ordinal()
                    .domain(progxaxis)
                    .rangeBands([0, width2]);
                var y2 = d3.scale.linear()
                    .domain([0, d3.max(progressionarray)])
                    .range([height2, 0]);
                var xAxis2 = d3.svg.axis()
                    .scale(x2)
                    .orient("bottom");
                var yAxis2 = d3.svg.axis()
                    .scale(y2)
                    .orient("left");                
                //Declare the second Chart
                var chart2 = d3.select("#area"+attrNum)
                    .append("svg")
                    .attr("width", width2 + margin2.left + margin2.right)
                    .attr("height", height2 + margin2.top + margin2.bottom)
                  .append("g")
                    .attr("transform", "translate(" + margin2.left + "," + margin2.top + ")");
                //THIS IS THE AXES                
                chart2.append("g")
                      .attr("class", "x axis")
                      .attr("transform", "translate(0," + height2 + ")")
                      .call(xAxis2);
                chart2.append("g")
                      .attr("class", "y axis")
                      .call(yAxis2);
                //Split php strings into javascript arrays
                chart2.selectAll(".bar")
                      .data(progressionarray)
                    .enter().append("rect") 
                    .attr("class", "bar")
                      .attr("x", function(d, i) { return i * barWidth2; }) 
                      .attr("y", function(d) { return y2(d); })
                      .attr("height", function(d) { return height2 - y2(d); })
                      .attr("width", x2.rangeBand() - barPadding)
                    .style({fill: randomColour});
                //Bar text
                chart2.selectAll("g")
                    .data(progressionarray)
                    //.enter()
                    .append("text")
                        .attr("x", 
                            function(d, i) {
                            if(i!=0){
                                return (barWidth2)-2*barPadding
                            } else { 
                                return (barWidth2/2)-2*barPadding
                            }}) 
                        .attr("y", function(d) {return y2(d) - 200;})
                        .attr("dy", "1.4em")
                        .text(function (d, i) { return d; })  
                        .style("font-size", "10px")
                        .style("fill", "black");
                //Title
                chart2.append("text")
                        .attr("text-anchor", "middle")
                        .attr("transform", "translate("+ (-25) + ","+ (height2/2) + ") rotate(-90)")
                        .text("Weighted Average Score")
                        .style("font-size", "10px");
                //X-axis
                chart2.append("text")
                        .attr("text-anchor", "middle")
                        .attr("transform", "translate("+ (width2/2) + ","+ (height2+30) + ")")
                        .text("Semester")
                        .style("font-size", "10px");
                //Title
                chart2.append("text")
                        .attr("text-anchor", "middle")
                        .attr("transform", "translate("+ (width2/2) + ","+ (-13) + ")")
                        .text(histotitle + " Progression of " + progtitle + " Cohort");  
                
            }
                
            
            var numofattr = parseInt( "<?php echo $numofattr?>"); 
            
            var graphs1 = {0:"6 5 5 6 7 ", 1:"3 4 2 1 19 ", 2:"34 12 12 2 4 "};
            var graphs2 = {0:"4 8 15 16 23 ", 1:"9 0 23 2 1 2 4 ", 2:" 23 32 4 " };
            
            for (i=0; i < numofattr; i++){

                graphs(graphs1[i],graphs2[i],"Knowledge Base","2A",i);//, x, y, xAxis[i], yAxis[i]);

            }
                
            for (var key in graphs1){
                
            }
                
                
        </script>   

	</body>
  
</html>

