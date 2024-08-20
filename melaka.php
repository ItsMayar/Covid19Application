<!DOCTYPE html>
<html>
<head>
<title>Melaka covid statistics</title>
<link rel="stylesheet" href="styletext.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
  <h1> covid cases in Melaka</h1>
  <?php
  include 'databaseconnect.php';
  $connect = databaseconnect();
  //echo "Connected Successfully <br> ";

  $query = "SELECT * FROM melaka"; // stores the sql command to be executed.
  $result = $connect -> query($query); // -> is call to query method
  if(!$result) die($connect->error);
  $rows = $result->num_rows;
  $data = array();
  foreach ($result as $row) {
    $data[] = $row;
  }
  CloseCon($connect);
  ?>

<div class="charts"  style="position: relative; height:30%; width:50%">
	<canvas id="chart"></canvas>
		<canvas id="chart1"></canvas>
			<canvas id="chart2" style="position:absolute; top:0px;left:100%;"></canvas>
</div>

<script>
var jstable = <?php echo json_encode($data) ?>;// table data in JSON format

let dates = jstable.map(row => row.dates); // extract each column to an array.
let recovered = jstable.map(row => row.recovered);
let new_cases = jstable.map(row => row.new_cases);
let deaths = jstable.map(row => row.deaths);
//console.log(jstable)// just making sure all data is filled

var chartdata = []; // deaths / recovered/ new_cases
var chartname = "";
var bgcolor = [];
var red = 'rgba(255, 0, 0, 0.7)';
var orange = 'rgba(255,165,0,0.8)';
var green = 'rgba(0,200,0,0.7)';
function creatchart(chartdata, chartname,chartid,color){

var ctx = document.getElementById ('chart'+chartid).getContext('2d'); // chartid is added when creating charts below
var myChart = new Chart(ctx, {
	type: 'line',
	data: {
		labels: dates,
		datasets: [{
			label: 'Number of '+chartname ,
			data: chartdata,
			backgroundColor: color,
			borderColor: color,
			borderWidth: 2,

		}]
	},
  options: {
		plugins: {
		 legend: {
				 labels: {

						 color: color,

						 font: {
									size: 22,
							}

				 }
		 },
 },
		scales: {
        yAxes: {
            ticks: {
                color: color,
								font: {
										 size: 20,
								 }
            },
        },
        xAxes: {
            ticks: {
                color: color,
                font: {
										 size: 17 ,
								 }
            },
        }
			}
		}
	}) ;
}
creatchart(deaths,"Deaths",'',red); //mychart
creatchart(new_cases,"New cases",'1',green); // mychart1
creatchart(recovered,"Recovered",'2',orange); // mychart2
</script>
</body>
</html>
