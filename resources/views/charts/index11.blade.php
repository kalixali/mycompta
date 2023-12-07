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
 
?>

<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function () {
 
 var chart = new CanvasJS.Chart("chartContainer", {
	 animationEnabled: true,
	 theme: "light2",
	 title:{
		 text: "GRAPH COMPARATIF DES ACHATS ET VENTES DE L'ANNEE ENCOUR"
	 },
	 axisY:{
		 includeZero: true
	 },
	 legend:{
		 cursor: "pointer",
		 verticalAlign: "center",
		 horizontalAlign: "right",
		 itemclick: toggleDataSeries
	 },
	 data: [{
		 type: "column",
		 name: "Achats",
		 indexLabel: "{y}",
		 yValueFormatString: "#0.##CFA",
		 showInLegend: true,
		 dataPoints: <?php echo json_encode($dataPoints_ach, JSON_NUMERIC_CHECK); ?>
	 },{
		 type: "column",
		 name: "Ventes",
		 indexLabel: "{y}",
		 yValueFormatString: "#0.##CFA",
		 showInLegend: true,
		 dataPoints: <?php echo json_encode($dataPoints_vte, JSON_NUMERIC_CHECK); ?>
	 }]
 });
 chart.render();
  
 function toggleDataSeries(e){
	 if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		 e.dataSeries.visible = false;
	 }
	 else{
		 e.dataSeries.visible = true;
	 }
	 chart.render();
 }
  
 }
</script>
</head>
<body>
	<h6>Mon graphique 1</h6>
	<div id="chartContainer" style="height: 370px; width: 100%;"></div>

<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</body>
</html>                              
    
@stop