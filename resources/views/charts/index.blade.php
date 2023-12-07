@extends('layout')
@section('content')

<?php
 
$dataPoints_ach = array(
	array("y" => $ach[0], "label" => "Jan"),
	array("y" => $ach[1], "label" => "Fev"),
	array("y" => $ach[2], "label" => "Mars"),
	array("y" => $ach[3], "label" => "Avril"),
	array("y" => $ach[4], "label" => "Mai"),
	array("y" => $ach[5], "label" => "Juin"),
	array("y" => $ach[6], "label" => "Juil"),
	array("y" => $ach[7], "label" => "Aout"),
	array("y" => $ach[8], "label" => "Sept"),
	array("y" => $ach[9], "label" => "Oct"),
	array("y" => $ach[10], "label" => "Nov"),
	array("y" => $ach[11], "label" => "Déc"),
);

$dataPoints_vte = array(
	array("y" => $vte[0], "label" => "Jan"),
	array("y" => $vte[1], "label" => "Fev"),
	array("y" => $vte[2], "label" => "Mars"),
	array("y" => $vte[3], "label" => "Avril"),
	array("y" => $vte[4], "label" => "Mai"),
	array("y" => $vte[5], "label" => "Juin"),
	array("y" => $vte[6], "label" => "Juil"),
	array("y" => $vte[7], "label" => "Aout"),
	array("y" => $vte[8], "label" => "Sept"),
	array("y" => $vte[9], "label" => "Oct"),
	array("y" => $vte[10], "label" => "Nov"),
	array("y" => $vte[11], "label" => "Déc"),
);
$j = 0;
foreach($actupro as $item) {
	
	$dataPoints_actu[] = array("y" => $actumont[$j], "label" => $item);
		
	$j = $j+1;
}
//print_r(json_encode($dataPoints_actu));
?>

<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer_ach", {
	title: {
		text: "Les Achats de M/ses de l'année encour"
	},
	axisY: {
		title: "Valeurs TTC des dépenses par mois"
	},
	data: [{
		type: "line",
		dataPoints: <?php echo json_encode($dataPoints_ach, JSON_NUMERIC_CHECK); ?>
	}]
});

var chart1 = new CanvasJS.Chart("chartContainer_vte", {
	 title: {
		 text: "Les Ventes de M/ses de l'année encour"
	 },
	 axisY: {
		 title: "Valeurs TTC des ventes par mois"
	 },
	 data: [{
		 type: "line",
		 dataPoints: <?php echo json_encode($dataPoints_vte, JSON_NUMERIC_CHECK); ?>
	 }]
 });

 var chart2 = new CanvasJS.Chart("chartContainer_actu", {
	 title: {
		 text: "Le Stock Actuel"
	 },
	 axisY: {
		 title: "Valeurs TTC du Stock Actuel"
	 },
	 data: [{
		 type: "line",
		 dataPoints: <?php echo json_encode($dataPoints_actu, JSON_NUMERIC_CHECK); ?>
	 }]
 });

 chart.render();
 chart1.render();
 chart2.render();
}
</script>
</head>
<body>
	
	<div id="chartContainer_ach" style="height: 370px; width: 100%;"></div>
	<!-- <h6></h6> -->
	<div id="chartContainer_vte" style="height: 370px; width: 100%;"></div>
	<div></div>

	<div id="chartContainer_actu" style="height: 370px; width: 100%;"></div>

<!-- <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script> -->
<script src="canvasjs-chart-3.7.11/canvasjs.min.js"></script>
</body>
</html>                              
    
@stop