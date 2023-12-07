<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ma Comptabilité</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="mstyl.css">

  </head>
  
  <body>
 <div class="container">
     
    <div class="row">
          <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center"><u>RESULTAT COMPTABLE </u></h2>
                    </div>
                    <div class="card-body">
                        <br/>
                    
                    <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th colspan="12">{{$exec0}}</th>
                                    </tr>
                                    <tr>
                                        <th>REF.</th>
                                        <th>LIBELLE</th>
                                        <th>NOTES</th>
                                        <th>SIGNE OP.</th>
                                        <th>{{$exec}}</th>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>TA</td>
                                        <td>VENTES DE MARCHANDISES</td>
                                        <td></td>
                                        <td>+</td>
                                        <td>{{$produits[0]->produit}}</td>
                                        
                                    </tr>
                                    <tr>
                                        <td>RA</td>
                                        <td>ACHATS DE MARCHANDISES</td>
                                        <td></td>
                                        <td>-</td>
                                        <td>{{$charges[0]->charge}}</td>
                                        
                                    </tr>
                                    <tr>
                                        <td>RB</td>
                                        <td>VARIATION DE STOCKS</td>
                                        <td></td>
                                        <td>-</td>
                                        <td>{{$varstock[0]->varstock}}</td>
                                        
                                    </tr>
                                    <tr>
                                        <th>TB</th>
                                        <th>MARGE COMMERCIALE</th>
                                        <th></th>
                                        <th></th>
                                        <th>{{$MC}}</th>
                                        
                                    </tr>
                                    <tr>
                                        <td>TC</td>
                                        <td>VENTES DE PRODUITS FABRIQUES</td>
                                        <td></td>
                                        <td>+</td>
                                        <td>{{$produitsf[0]->produitsf}}</td>
                                        
                                    </tr>
                                    <tr>
                                        <td>TD</td>
                                        <td>TRAVAUX SERVICES VENDUS</td>
                                        <td></td>
                                        <td>+</td>
                                        <td>{{$produitsv[0]->produitsv}}</td>
                                        
                                    </tr>
                                    <tr>
                                        <td>TE</td>
                                        <td>PRODUCTION IMMOBILISEE</td>
                                        <td></td>
                                        <td>+</td>
                                        <td>{{$produitimo[0]->produitimo}}</td>
                                        
                                    </tr>
                                    <tr>
                                        <td>TF</td>
                                        <td>PRODUITS ACCESSOIRES</td>
                                        <td></td>
                                        <td>+</td>
                                        <td>{{$produitacc[0]->produitacc}}</td>
                                        
                                    </tr>
                                    <tr>
                                        <td>TH</td>
                                        <td>SUBVENTION D'EXPLOITATION</td>
                                        <td></td>
                                        <td>+</td>
                                        <td>{{$subvexpl[0]->subvexpl}}</td>
                                        
                                    </tr>
                                    <tr>
                                        <td>TL</td>
                                        <td>AUTRES PRODUITS</td>
                                        <td></td>
                                        <td>+</td>
                                        <td>{{$autrprod[0]->autrprod}}</td>
                                        
                                    </tr>
                                    <tr>
                                        <th>TI</th>
                                        <th>CHIFFRE D'AFFAIRE</th>
                                        <th></th>
                                        <th></th>
                                        <th>{{$ca}}</th>
                                        
                                    </tr>
                                    <tr>
                                        <td>RC</td>
                                        <td>ACHATS MAT. PREMIERES ET FOURNITURES</td>
                                        <td></td>
                                        <td>-</td>
                                        <td>{{$achmat[0]->achmat}}</td>
                                        
                                    </tr>
                                    <tr>
                                        <td>RC</td>
                                        <td>VARIATION STOCK MAT. PREMIERES ET FOURNITURES</td>
                                        <td></td>
                                        <td>-</td>
                                        <td>{{$varstockm[0]->varstockm}}</td>
                                        
                                    </tr>
                                    <tr>
                                        <td>RD</td>
                                        <td>AUTRES ACHATS</td>
                                        <td></td>
                                        <td>-</td>
                                        <td>{{$autrch[0]->autrch}}</td>
                                        
                                    </tr>
                                    <tr>
                                        <td>RE</td>
                                        <td>VARIATION STOCK AUTRES ACHATS</td>
                                        <td></td>
                                        <td>-</td>
                                        <td>{{$varstocka[0]->varstocka}}</td>
                                        
                                    </tr>
                                    <tr>
                                        <td>RH</td>
                                        <td>TRANSPORT</td>
                                        <td></td>
                                        <td>-</td>
                                        <td>{{$trsport[0]->trsport}}</td>
                                        
                                    </tr>
                                    <tr>
                                        <td>RI</td>
                                        <td>SERVICES EXTERIEURS</td>
                                        <td></td>
                                        <td>-</td>
                                        <td>{{$scext[0]->scext}}</td>
                                        
                                    </tr>
                                    <tr>
                                        <td>RJ</td>
                                        <td>IMPOTS ET TAXES</td>
                                        <td></td>
                                        <td>-</td>
                                        <td>{{$imptax[0]->imptax}}</td>
                                        
                                    </tr>
                                    <tr>
                                        <td>RK</td>
                                        <td>AUTRES CHARGES</td>
                                        <td></td>
                                        <td>-</td>
                                        <td>{{$autrchg[0]->autrchg}}</td>
                                        
                                    </tr>
                                    <tr>
                                        <th>TN</th>
                                        <th>VALEUR AJOUTEE</th>
                                        <th></th>
                                        <th></th>
                                        <th>{{$valajoute}}</th>
                                        
                                    </tr>
                                    <tr>
                                        <td>RP</td>
                                        <td>CHARGES DE PERSONNEL</td>
                                        <td></td>
                                        <td>-</td>
                                        <td>{{$chargpers[0]->chargpers}}</td>
                                        
                                    </tr>
                                    <tr>
                                        <th>TQ</th>
                                        <th>EXCEDENT BRUT D'EXPLOITATION</th>
                                        <th></th>
                                        <th></th>
                                        <th>{{$exbrutexpl}}</th>
                                        
                                    </tr>
                                    <tr>
                                        <td>TS</td>
                                        <td>REPRISES DE PROVISIONS - DE DEPRECIATIONS ET AUTRES</td>
                                        <td></td>
                                        <td>+</td>
                                        <td>{{$repprov[0]->repprov}}</td>
                                        
                                    </tr>
                                    <tr>
                                        <td>TT</td>
                                        <td>TRANSFERT DE CHARGES</td>
                                        <td></td>
                                        <td>+</td>
                                        <td>{{$trsfcharg[0]->trsfcharg}}</td>
                                       
                                    </tr>
                                    <tr>
                                        <td>RS</td>
                                        <td>DOTATIONS AUX AMORTISSEMENTS</td>
                                        <td></td>
                                        <td>-</td>
                                        <td>{{$dotamort[0]->dotamort}}</td>
                                        
                                    </tr>
                                    <tr>
                                        <td>RT</td>
                                        <td>DOTATIONS AUX PROVISIONS ET AUX DEPRECIATIONS</td>
                                        <td></td>
                                        <td>-</td>
                                        <td>{{$dotprovdep[0]->dotprovdep}}</td>
                                        
                                    </tr>
                                    <tr>
                                        <th>TX</th>
                                        <th>RESULTAT D'EXPLOITATION</th>
                                        <th></th>
                                        <th></th>
                                        <th>{{$resultexpl}}</th>
                                        
                                    </tr>
                                    <tr>
                                        <td>UF</td>
                                        <td>REVENUS FINANCIERS ET PRODUITS ASSIMILES</td>
                                        <td></td>
                                        <td>+</td>
                                        <td>{{$revfcierpa[0]->revfcierpa}}</td>
                                        
                                    </tr>
                                    <tr>
                                        <td>SF</td>
                                        <td>FRAIS FINANCIERS ET CHARGES ASSIMILES</td>
                                        <td></td>
                                        <td>-</td>
                                        <td>{{$frfciercha[0]->frfciercha}}</td>
                                        
                                    </tr>
                                    <tr>
                                        <th>UG</th>
                                        <th>RESULTAT FINANCIER</th>
                                        <th></th>
                                        <th></th>
                                        <th>{{$resultfcier}}</th>
                                        
                                    </tr>
                                    <tr>
                                        <th>UI</th>
                                        <th>RESULTAT COURANT</th>
                                        <th></th>
                                        <th></th>
                                        <th>{{$resultcour}}</th>
                                        
                                    </tr>
                                    <tr>
                                        <td>UJ</td>
                                        <td>PRODUIT DE CESSIONS DES IMMO.</td>
                                        <td></td>
                                        <td>+</td>
                                        <td>{{$prodcessimmo[0]->prodcessimmo}}</td>
                                        
                                    </tr>
                                    <tr>
                                        <td>UK</td>
                                        <td>PRODUIT NON COURANTS CONSTATES</td>
                                        <td></td>
                                        <td>+</td>
                                        <td>{{$prodnoncourc[0]->prodnoncourc}}</td>
                                       
                                    </tr>
                                    <tr>
                                        <td>UM</td>
                                        <td>REPRISES NON COURANTS</td>
                                        <td></td>
                                        <td>+</td>
                                        <td>{{$repnoncour[0]->repnoncour}}</td>
                                        
                                    </tr>
                                    <tr>
                                        <th>UN</th>
                                        <th>TOTAL PRODUITS NON COURANT</th>
                                        <th></th>
                                        <th></th>
                                        <th>{{$totprodnoncour}}</th>
                                        
                                    </tr>
                                    <tr>
                                        <td>SJ</td>
                                        <td>VALEURS COMPTABLE DES CESSIONS D'IMMOBILISATION</td>
                                        <td></td>
                                        <td>-</td>
                                        <td>{{$vcptcess[0]->vcptcess}}</td>
                                        
                                    </tr>
                                    <tr>
                                        <td>SK</td>
                                        <td>CHARGES NON COURANTS CONSTATEES</td>
                                        <td></td>
                                        <td>-</td>
                                        <td>{{$chargnoncourc[0]->chargnoncourc}}</td>
                                        
                                    </tr>
                                    <tr>
                                        <td>SM</td>
                                        <td>DOTATIONS NON COURANTS</td>
                                        <td></td>
                                        <td>-</td>
                                        <td>{{$dotnoncour[0]->dotnoncour}}</td>
                                        
                                    </tr>
                                    <tr>
                                        <th>SN</th>
                                        <th>TOTAL CHARGES NON COURANTES</th>
                                        <th></th>
                                        <th></th>
                                        <th>{{$totchargnoncour}}</th>
                                        
                                    </tr>
                                    <tr>
                                        <th>UP</th>
                                        <th>RESULTAT AVANT PRELEVEMENT</th>
                                        <th></th>
                                        <th></th>
                                        <th>{{$resultavpre}}</th>
                                        
                                    </tr>
                                    <tr>
                                        <td>SQ</td>
                                        <td>PARTICIPATION DES TRAVAILLEURS</td>
                                        <td></td>
                                        <td>-</td>
                                        <td>{{$partitravr[0]->partitravr}}</td>
                                        
                                    </tr>
                                    <tr>
                                        <td>SR</td>
                                        <td>IMPOTS SUR LE RESULTAT</td>
                                        <td></td>
                                        <td>-</td>
                                        <td>{{$imporesult[0]->imporesult}}</td>
                                        
                                    </tr>
                                    <tr>
                                        <th>UZ</th>
                                        <th>RESULTAT NET</th>
                                        <th></th>
                                        <th></th>
                                        <th>{{$resultnet}}</th>
                                        
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                     </div>
                </div>
            </div>
        </div>
   
    </div >
</body>
</html>