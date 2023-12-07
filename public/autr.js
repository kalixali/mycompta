//Calcul du nombre de part
sm = $("#sitmat").val();
ne = $("#nbrenft").val();
$("#nbrepart").click(function() {
if ((sm = "Marié(e)") && (ne = "0")) {
    $("#nbrepart").val(2);
} else {
    $("#nbrepart").val(1);
 }
 });