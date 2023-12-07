//$("#salbase").bind("click", function(){
//$("#salbase").click(function() {
//$(this).css("color","red");
//});

//Calcul total avantages en nature
$("#totavtagenat").click(function() {
st = parseInt($("#avg_logement").val());
sr = parseInt($("#avg_vehicule").val());
sp = parseInt($("#avg_otr").val());
if (!st) st = 0, $("#avg_logement").val(0);
if (!sr) sr = 0, $("#avg_vehicule").val(0);
if (!sp) sp = 0, $("#avg_otr").val(0);
$("#totavtagenat").val(st + sr + sp);
});

//Calcul total primes
$("#totprimes").click(function() {
st = parseInt($("#prime_ancien").val());
sr = parseInt($("#prim_risq").val());
sp = parseInt($("#prime_otr").val());
if (!st) st = 0, $("#prime_ancien").val(0);
if (!sr) sr = 0, $("#prim_risq").val(0);
if (!sp) sp = 0, $("#prime_otr").val(0);
$("#totprimes").val(st + sr + sp);
});

//Calcul total indemnités taxables
$("#totindemnitetax").click(function() {
st = parseInt($("#ind_nourriture").val());
sr = parseInt($("#ind_logement").val());
sp = parseInt($("#ind_otrtax").val());
if (!st) st = 0, $("#ind_nourriture").val(0);
if (!sr) sr = 0, $("#ind_logement").val(0);
if (!sp) sp = 0, $("#ind_otrtax").val(0);
$("#totindemnitetax").val(st + sr + sp);
});

//Calcul total indemnités non taxables
$("#totindemnite").click(function() {
st = parseInt($("#ind_trsport").val());
sr = parseInt($("#ind_salissure").val());
sp = parseInt($("#ind_otr").val());
if (!st) st = 0, $("#ind_trsport").val(0);
if (!sr) sr = 0, $("#ind_salissure").val(0);
if (!sp) sp = 0, $("#ind_otr").val(0);
$("#totindemnite").val(st + sr + sp);
});

//Calcul des heures supplementaires
$("#msup15").click(function() {
st = parseInt($("#txhorair").val());
sr = parseInt($("#hsup15").val());
sr1 = parseInt($("#hsup50").val());
sr2 = parseInt($("#hsup75").val());
sr3 = parseInt($("#hsup100").val());
//sp = parseInt($("#ind_otr").val());
if (!st) st = 0, $("#txhorair").val(0);
if (!sr) sr = 0, $("#hsup15").val(0);
if (!sr1) sr1 = 0, $("#hsup50").val(0);
if (!sr2) sr2 = 0, $("#hsup75").val(0);
if (!sr3) sr3 = 0, $("#hsup100").val(0);
//if (!sp) sp = 0;
$("#msup15").val(parseInt((st*1.15) * sr));
$("#msup50").val(parseInt((st*1.5) * sr1));
$("#msup75").val(parseInt((st*1.75) * sr2));
$("#msup100").val(parseInt((st*2) * sr3));
$("#totmhs").val(parseInt((st*2) * sr3)+parseInt((st*1.75) * sr2)+parseInt((st*1.5) * sr1)+parseInt((st*1.15) * sr));
});

//Calcul du salaire brut imposable
$("#salbimp").click(function() {
rr = parseInt($("#salbase").val());
rr1 = parseInt($("#sursal").val());
rr2 = parseInt($("#totavtagenat").val());
rr3 = parseInt($("#totprimes").val());
rr4 = parseInt($("#totindemnitetax").val());
rr5 = parseInt($("#totmhs").val());
if (!rr) rr = 0, $("#salbase").val(0);
if (!rr1) rr1 = 0, $("#sursal").val(0);
if (!rr2) rr2 = 0, $("#totavtagenat").val(0);
if (!rr3) rr3 = 0, $("#totprimes").val(0);
if (!rr4) rr4 = 0, $("#totindemnitetax").val(0);
if (!rr5) rr5 = 0, $("#totmhs").val(0);
$("#salbimp").val(parseInt(rr + rr1 + rr2 + rr3 + rr4 + rr5));
//calcul de la cotisation retraite (cr)
ct = parseInt($("#salbimp").val());
if (!ct) ct = 0;
ct1 = ct * 0.063;
$("#cr").val(parseInt(ct1));
//calcul de l'impot fiscal (is)
ee = parseInt($("#salbimp").val());
if (!ee) ee = 0;
$("#imps").val(parseInt(ee * 0.012));
//calcul de la contribution nationale (cn)
et = parseInt($("#salbimp").val());
if (!et) et = 0;
et1 = et * 0.8;
if (et1 <= 50000) {
  et2 = 0;
} else if (et1 <= 130000) {
  et2 = (et1 - 50000) * 0.015;
} else if (et1 <= 200000) {
  et2 = 1200 + (et1 - 130000) * 0.05;
} else if (et1 > 200000) {
  et2 = 1200 + 3500 + (et1 - 200000) * 0.1;
}
$("#cn").val(parseInt(et2));
//
//calcul de l'impot general sur le revenu (igr)
gg = parseInt($("#salbimp").val());
gg1 = parseInt($("#cn").val());
gg3 = parseInt($("#imps").val());
gg4 = parseInt($("#nbrepart").val());
if (!gg) gg = 0, $("#salbimp").val(0);
if (!gg1) gg1 = 0, $("#cn").val(0);
if (!gg3) gg3 = 0, $("#imps").val(0);
if (!gg4) gg4 = 0, $("#nbrepart").val(0);
gg2 = gg * 0.8;
rr = (gg2-(gg1 + gg3)) * 0.85;
qq = rr/gg4;
if (qq < 25000) {
  gg5 = 0;
} else if (qq <= 45583) {
  gg5 = rr * 10/110 - 2273 * gg4;
} else if (qq <= 81583) {
  gg5 = rr * 15/115 - 4076 * gg4;
} else if (qq <= 126583) {
  gg5 = rr * 20/120 - 7031 * gg4;
} else if (qq <= 220333) {
  gg5 = rr * 25/125 - 11250 * gg4;
} else if (qq <= 389083) {
  gg5 = rr * 35/135 - 24306 * gg4;
} else if (qq <= 842166) {
  gg5 = rr * 45/145 - 44181 * gg4;
} else if (qq > 842166) {
  gg5 = rr * 60/160 - 98633 * gg4;
}
$("#igr").val(parseInt(gg5));
//calcul du total cotisation fiscale employé
rv = parseInt($("#imps").val());
rv1 = parseInt($("#cn").val());
rv2 = parseInt($("#igr").val());
if (!rv) rv = 0, $("#imps").val(0);
if (!rv1) rv1 = 0, $("#cn").val(0);
if (!rv2) rv2 = 0, $("#igr").val(0);
$("#totficemp").val(parseInt(rv + rv1 + rv2));
//calcul du salaire net
ru = parseInt($("#salbimp").val());
ru1 = parseInt($("#cr").val());
ru2 = parseInt($("#totficemp").val());
avt = parseInt($("#totavtagenat").val());
if (!ru) ru = 0, $("#salbimp").val(0);
if (!ru1) ru1 = 0, $("#cr").val(0);
if (!ru2) ru2 = 0, $("#totficemp").val(0);
if (!avt) avt = 0, $("#totavtagenat").val(0);
$("#salnet").val(parseInt(ru - ru1 - ru2 - avt));
});
/*
//Calcul de la cotisation retraite
$("#cr").click(function() {
ct = parseInt($("#salbimp").val());
if (!ct) ct = 0;
ct1 = ct * 0.063;
$("#cr").val(parseInt(ct1));
});
//Calcul de l'impôt sur le salaire
$("#is").click(function() {
ee = parseInt($("#salbimp").val());
if (!ee) ee = 0;
$("#is").val(parseInt(ee * 0.012));

});


//Calcul de la contribution nationale
$("#cn").click(function() {
et = parseInt($("#salbimp").val());
if (!et) et = 0;
et1 = et * 0.8;
if (et1 <= 50000) {
  et2 = 0;
} else if (et1 <= 130000) {
  et2 = (et1 - 50000) * 0.015;
} else if (et1 <= 200000) {
  et2 = 1200 + (et1 - 130000) * 0.05;
} else if (et1 > 200000) {
  et2 = 1200 + 3500 + (et1 - 200000) * 0.1;
}
$("#cn").val(parseInt(et2));
});

//Calcul de l'igr'
$("#igr").click(function() {
gg = parseInt($("#salbimp").val());
gg1 = parseInt($("#cn").val());
gg3 = parseInt($("#is").val());
gg4 = parseInt($("#nbrepart").val());
if (!gg) gg = 0;
if (!gg1) gg1 = 0;
if (!gg3) gg3 = 0;
if (!gg4) gg4 = 0;
gg2 = gg * 0.8;
rr = (gg2-(gg1 + gg3)) * 0.85;
qq = rr/gg4;
if (qq < 25000) {
  gg5 = 0;
} else if (qq <= 45583) {
  gg5 = rr * 10/110 - 2273 * gg4;
} else if (qq <= 81583) {
  gg5 = rr * 15/115 - 4076 * gg4;
} else if (qq <= 126583) {
  gg5 = rr * 20/120 - 7031 * gg4;
} else if (qq <= 220333) {
  gg5 = rr * 25/125 - 11250 * gg4;
} else if (qq <= 389083) {
  gg5 = rr * 35/135 - 24306 * gg4;
} else if (qq <= 842166) {
  gg5 = rr * 45/145 - 44181 * gg4;
} else if (qq > 842166) {
  gg5 = rr * 60/160 - 98633 * gg4;
}
$("#igr").val(parseInt(gg5));
});

//Calcul du total cotisation fiscales
$("#totficemp").click(function() {
rv = parseInt($("#is").val());
rv1 = parseInt($("#cn").val());
rv2 = parseInt($("#igr").val());
if (!rv) rv = 0;
if (!rv1) rv1 = 0;
if (!rv2) rv2 = 0;
$("#totficemp").val(parseInt(rv + rv1 + rv2));
});

//Calcul du salaire net
$("#salnet").click(function() {
rr = parseInt($("#salbimp").val());
rr1 = parseInt($("#cr").val());
rr2 = parseInt($("#totficemp").val());
if (!rr) rr = 0;
if (!rr1) rr1 = 0;
if (!rr2) rr2 = 0;
$("#salnet").val(parseInt(rr - rr1 - rr2));
});
*/
//Calcul des indemnites non taxables
$("#totindemnite").click(function() {
rr = parseInt($("#ind_trsport").val());
rr1 = parseInt($("#ind_salissure").val());
rr2 = parseInt($("#ind_otr").val());
if (!rr) rr = 0, $("#ind_trsport").val(0);
if (!rr1) rr1 = 0, $("#ind_salissure").val(0);
if (!rr2) rr2 = 0, $("#ind_otr").val(0);
$("#totindemnite").val(parseInt(rr + rr1 + rr2));
});

//Calcul total retenues
$("#totretenues").click(function() {
  st = parseInt($("#accompte").val());
  sr = parseInt($("#avance").val());
  sp = parseInt($("#autres").val());
  if (!st) st = 0, $("#accompte").val(0);
  if (!sr) sr = 0, $("#avance").val(0);
  if (!sp) sp = 0, $("#autres").val(0);
  $("#totretenues").val(st + sr + sp);
  //Calcul du salaire à payer
  rr = parseInt($("#salnet").val());
  rr1 = parseInt($("#totindemnite").val());
  rr2 = parseInt($("#totretenues").val());
  if (!rr) rr = 0, $("#salnet").val(0);
  if (!rr1) rr1 = 0, $("#totindemnite").val(0);
  if (!rr2) rr2 = 0, $("#totretenues").val(0);
$("#salpaye").val(parseInt(rr + rr1 - rr2));
  });

//Calcul du salaire à payer
$("#salpaye").click(function() {
rr = parseInt($("#salnet").val());
rr1 = parseInt($("#totindemnite").val());
rr2 = parseInt($("#totretenues").val());
if (!rr) rr = 0, $("#salnet").val(0);
if (!rr1) rr1 = 0, $("#totindemnite").val(0);
if (!rr2) rr2 = 0, $("#totretenues").val(0);
$("#salpaye").val(parseInt(rr + rr1 - rr2));
});
//Calcul du taux horaire
//$("#txhorair").bind("click", function(){
$("#txhorair").click(function() {
ss = $("#salbase").val();
$("#txhorair").val(Math.round(ss/173.33* 100) / 100);
});

//Calcul du nombre de part
//$("#txhorair").bind("click", function(){
$("#nbrepart").click(function() {
sm = $("#sitmat").val();
ne = $("#nbrenft").val();
nn = parseInt(ne);
np = $("#nbrepart").val();
npp = parseFloat(np);
if ((sm == "Marié(e)") && (nn == 0)) {
  $("#nbrepart").val(2);
} else if ((sm == "Marié(e)") && (nn > 0)) {
  $("#nbrepart").val(2 + (nn*0.5));
} else if ((sm == "Célibataire(e)") && (nn == 0)) {
  $("#nbrepart").val(1);
} else if ((sm == "Célibataire(e)") && (nn > 0)) {
  $("#nbrepart").val(1 + (nn*0.5));
} else if ((sm == "Divorcé(e)") && (nn == 0)) {
  $("#nbrepart").val(1);
} else if ((sm == "Divorcé(e)") && (nn > 0)) {
  $("#nbrepart").val(1 + (nn*0.5));
} else if ((sm == "Veuf(ve)") && (nn == 0)) {
  $("#nbrepart").val(1);
} else if ((sm == "Veuf(ve)") && (nn > 0)) {
  $("#nbrepart").val(2 + (nn*0.5));
	
} 
});
//Le nombre de part ne doit pas exceder 5
$("#nbrepart").focusout(function() {
np = $("#nbrepart").val();
npp = parseFloat(np);
if (npp > 5 ) {
	$("#nbrepart").val(5);
} 
});

// calcul de l'ancieneté
$("#ancien").click(function() {

var aDate = new Date($("#datearriv").val()); // date d'embauche de l'employé
var jDate = new Date(); // date actuelle
var diff = Math.abs(jDate.getTime() - aDate.getTime()); // différence entre les deux dates en ms
//var anc = Math.ceil(timeDiff / (1000 * 3600 * 24 * 365)); // ancienneté en années
var years = Math.floor(diff / 31536000000);
var months = Math.floor((diff % 31536000000) / 2628000000);
var days = Math.floor(((diff % 31536000000) % 2628000000) / 86400000);
//$("#ancien").val(years);
$("#ancien").val(years + " ans " + months + " mois " + days + " jours");

});

// Determiner la nationalité
$("#nation").click(function() {
  nat = $("#nation").val();
  if (!nat) $("#nation").val('Ivoirienne');
  });

 