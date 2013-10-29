<?php
require ("class.homewizard.php");
$hw = new homewizard();

if (!$hw->thermo_graph(0, 'month')) {
	echo 'error reading data!';
	return;
}

//Google api doc: https://google-developers.appspot.com/chart/interactive/docs/gallery/linechart
?>
<div id="header_thermometers">Temperatuur</div>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Maand', 'Min', 'Max'],
         <?php
			foreach ($hw->graph_year as $value) {				
				echo "['".$value->t."',".$value->te_min.','.$value->te_plus.'],'."\n";
			}
		 ?>			 
        ]);

        var options = {
          title: ''
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
</script>

<div id="chart_div" style="width: 500px; height: 450px;"></div>