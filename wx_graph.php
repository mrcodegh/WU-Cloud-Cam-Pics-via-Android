<html>
  <head>
	<script>
	 function downloadURI(uri, name) {
	  var link = document.createElement("a");
	  link.download = name;
	  link.href = uri;
	  document.body.appendChild(link);
	  link.click();
	  document.body.removeChild(link);
	  delete link;
	}
	</script>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
		var data = new google.visualization.DataTable();
		data.addColumn('datetime', 'Time');
		data.addColumn('number','Temp');
		data.addColumn('number','Dew Point');
		data.addColumn('number','4 inch Soil Temp');
		data.addColumn('number','Soil Moisture %');
		data.addRows([
 <?php
	$conn_wx = new mysqli('127.0.0.1', 'username', 'password', "wxdata");
	if ($conn_wx->connect_error) {
		die("Connect failed: " . $conn_wx->error);
	}
	$conn_soil = new mysqli('127.0.0.1', 'username', 'password', "soildata");
	if ($conn_soil->connect_error) {
		die("Connect failed: " . $conn_soil->error);
	}	

	$sql = 'Select reg_date, tempf, dewptf FROM ws1400 WHERE (id%240 = 0 AND reg_date>date_sub(now(), interval 6 day)) ORDER BY id';
	$result_wx = $conn_wx->query($sql);
	$sql = 'Select reg_date, temperature, moisture_percent FROM SoilDataLog WHERE reg_date>date_sub(now(), interval 6 day) ORDER BY id';
	$result_soil = $conn_soil->query($sql);
	$output = array();
	if ($result_wx->num_rows > 0 && $result_soil->num_rows > 0) {
		while($row_wx = $result_wx->fetch_array(MYSQLI_ASSOC)) {
			$temp = array();
			 
			// add the data
			$temp[0] = 'new Date(' . (strtotime($row_wx["reg_date"])+date('Z')) * 1000 . ')';
			//$temp[0] = $row_wx["reg_date"];
			$temp[1] = $row_wx['tempf'];
			$temp[2] = $row_wx['dewptf'];
			while ($row_soil = $result_soil->fetch_array(MYSQLI_ASSOC)) {
				if (strtotime($row_soil["reg_date"]) - strtotime($row_wx["reg_date"]) > -15*60) {
					$temp[3] = $row_soil["temperature"];
					$temp[4] = $row_soil["moisture_percent"];
					// implode the temp array into a comma-separated list and add to the output array
					$output[] = '[' . implode(', ', $temp) . ']';
					break;
				}			
			}
		}
	}
	$result_soil->close();
	$conn_soil->close();
	$result_wx->close();
	$conn_wx->close();
	echo implode(",\n", $output);

?> 
        ]);
        var options = {
			backgroundColor: 'transparent',
			legendTextStyle: {color:'#FFFFFF'},
		    series: {
			  0: { color: '#3366FF' },
			  1: { color: '#FF3912' },
			  2: { color: '#FF9900' },
			  3: { color: '#10FF18' }
		    },
			vAxis: {
			  baselineColor: '#CCCCCC',
			  gridlineColor: '#CCCCCC',
			  textStyle: {
				color: "#FFFFFF"
			  }
			},
			hAxis: {
			  baselineColor: '#CCCCCC',
			  textStyle: {
				color: "#FFFFFF"
			  },
			  gridlines: {
				color: '#CCCCCC', //'#1E4D6B',
				count: -1,
				units: {
				  days: {format: ['MMM dd']},
				  hours: {format: ['HH:mm', 'ha']},
				}
			  },
			  minorGridlines: {
				units: {
				  hours: {format: ['hh:mm:ss a', 'ha']},
				  minutes: {format: ['HH:mm a Z', ':mm']}
				}
			  }
			}
		};
        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
		google.visualization.events.addListener(chart, 'ready', function () {
		var imgUri = chart.getImageURI();
			downloadURI(imgUri, "wx_graph.png");
		});
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="chart_div" style="width: 1080px; height: 300px;"></div>
  </body>
</html>