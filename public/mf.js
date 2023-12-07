//recalcul de la prestation familiale
$("#t_prest_fam").change(function() {
tt = parseInt($("#salbimp").val());
gg = $("#t_prest_fam").val();
$("#t_prest_fam_a").val(gg);
$("#prest_fam").val((parseInt(gg) *  parseInt(tt))/100);
});

//recalcul de l'accident de travail'
$("#t_acc_trv").change(function() {
tt = parseInt($("#salbimp").val());
gg = $("#t_acc_trv").val();
$("#t_acc_trv_a").val(gg);
$("#acc_trv").val((parseInt(gg) *  parseInt(tt))/100);
});

//recalcul de la Cotisation retraite
$("#t_cr_p").change(function() {
tt = parseInt($("#salbimp").val());
gg = $("#t_cr_p").val();
$("#t_cr_p_a").val(gg);
$("#cr_p").val((parseInt(gg) *  parseInt(tt))/100);
});

//recalcul de l'Impôt sur salaire
$("#t_is_p").change(function() {
tt = parseInt($("#salbimp").val());
gg = $("#t_is_p").val();
$("#t_is_p_a").val(gg);
$("#is_p").val((parseInt(gg) *  parseInt(tt))/100);
});
//recalcul de l'Impôt sur salaire 2
$("#t_is_p").ready(function() {
    tt = parseInt($("#salbimp").val());
    //gg = $("#t_is_p").val();
    te = ($("#nation").val());
   if (te!='Ivoirienne') gg = 10.4;
    //$("#t_is_p_a").val(gg);
    $("#t_is_p").val(gg);
    $("#is_p").val((parseInt(gg) *  parseInt(tt))/100);
});

//recalcul de la Taxe d'apprentissage
$("#t_ta_fdfp").change(function() {
tt = parseInt($("#salbimp").val());
gg = $("#t_ta_fdfp").val();
$("#t_ta_fdfp_a").val(gg);
$("#ta_fdfp").val((parseInt(gg) *  parseInt(tt))/100);
});

//recalcul de la Contribution FPC
$("#t_fpc_fdfp").change(function() {
tt = parseInt($("#salbimp").val());
gg = $("#t_fpc_fdfp").val();
$("#t_fpc_fdfp_a").val(gg);
$("#fpc_fdfp").val((parseInt(gg) *  parseInt(tt))/100);
});