
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ma Comptabilité</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="mstyl.css">

  </head>
  @foreach($salaire as $salaire)
  <body>
 <div class="container">
     
    <div class="row">
          <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="spolice"><u>BULLETIN DE SALAIRE - EMPLOYE</u></h2>
                    </div>
                    <div class="card-body">
                        <br/>
                        
                    <div class="table-responsive">
                            <table class="table">
                                <thead class="">

                                    <tr >
                                    <td class="spolice" colspan="8">{{$entreprise->sigle}}</td>
                                    </tr>
                                    <tr >
                                        <td class="uppercase">{{$entreprise->nom_complet}}</td>
                                    </tr>
                                    <tr >
                                        <td class="">Num CC : <span style="padding-right:30px;"> </span></td>
                                        <td class="" ><span style="padding-left:30px;"> </span> {{$entreprise->numCC}} <span style="padding-right:30px;"> </span></td>
                                        <td class=""><span style="padding-left:30px;"> </span>  Num RC : <span style="padding-right:30px;"> </span></td>
                                        <td class=""> {{$entreprise->numRC}} <span style="padding-right:30px;"></span></td>
                                        <td class=""><span style="padding-left:30px;"> </span> Contact : <span style="padding-right:30px;"></span></td>
                                        <td class="" colspan="2">{{$entreprise->contact1}}</td>
                                    </tr>
                                    <br/>
                                    <tr >
                                        <td class="uppercase">MATRICULE :</td>
                                        <td>{{ $salaire->matricule }}</td>
                                    </tr>
                                    <tr class="">
                                        <td class = "uppercase">NOM :</td>
                                        <td class = "">{{ $salaire->nom }}</td>
                                    </tr>
                                    <tr>
                                        <td class = "uppercase">PRENOMS :</td>
                                        <td>{{ $salaire->prenoms }}</td>
                                    </tr>
                                    <tr>
                                        <td class = "uppercase">CATEGORIES :</td>
                                        <td>{{ $salaire->categ }}</td>
                                    </tr>
                                    <tr>
                                        <td class = "uppercase">POSTE :</td>
                                        <td>{{ $salaire->poste }}</td>
                                                                           
                                    </tr>
                                   
                                </thead>
                                
                                <tbody >
                                    <h2></h2>
                                    <tr class="">
                                        <td colspan="4">Salaire de base</td>
                                        <td>{{ $salaire->salbase }}</td>
                                    </tr>
                                    <tr class="">
                                        <td class="" colspan="4">Sursalaire</td>
                                        <td class="">{{ $salaire->sursal }}</td>
                                    </tr>
                                    <tr class="">
                                        <td colspan="4">Total primes</td>
                                        <td>{{ $salaire->totprimes }}</td>
                                    </tr>
                                    <tr class="">
                                        <td colspan="4">Total Indemnités Taxables</td>
                                        <td>{{ $salaire->totindemnitetax }}</td>
                                    </tr>
                                     <tr >
                                        <td colspan="2">Heure Sup. 15%</td>
                                        <td>{{ $salaire->msup15 }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Heure Sup. 50%</td>
                                        <td>{{ $salaire->msup50 }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Heure Sup. 75%</td>
                                        <td>{{ $salaire->msup75 }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Heure Sup. 1OO%</td>
                                        <td>{{ $salaire->msup100 }}</td>
                                    </tr>
                                    <tr class="">
                                        <td colspan="4">Total H.S.</td>
                                        <td>{{ $salaire->totmhs }}</td>
                                       
                                    </tr>
                                
                                    <tr class="">
                                        <td colspan="4">Avantages en nat.</td>
                                        <td>{{ $salaire->totavtagenat }}</td>
                                       
                                    </tr>
                                    <tr class="">
                                        <td colspan="4">Salaire brut imposable</td>
                                        <td>{{ $salaire->salbimp }}</td>
                                       
                                    </tr>
                                    <tr class="">
                                        <td>Retenues sur salaire</td>
                                    </tr>
                                    <tr >
                                        <td colspan="2">CR</td>
                                        <td>{{ $salaire->cr }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">CN</td>
                                        <td>{{ $salaire->cn }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">IS</td>
                                        <td>{{ $salaire->imps }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">IGR</td>
                                        <td>{{ $salaire->igr }}</td>
                                    </tr>
                                    <tr class="">
                                        <td colspan="4">Salaire Net</td>
                                        <td>{{ $salaire->salnet }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Indemnité de transport</td>
                                        <td>{{ $salaire->ind_trsport }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Total Indemnités non taxables</td>
                                        <td>{{ $salaire->totindemnite }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Accompte</td>
                                        <td>{{ $salaire->accompte }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Avance</td>
                                        <td>{{ $salaire->avance }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Autres Retenues</td>
                                        <td>{{ $salaire->autres }}</td>
                                    </tr>
                                    <tr class="">
                                        <td colspan="4"><b>Net à payer</b></td>
                                        <td><b>{{ $salaire->salpaye }}</b></td>
                                    </tr>
                                    <h2></h2>
                                    <tr class="nonborder">
                                        <td colspan="6" class="nonborder"></td>
                                        <td class="nonborder">Signature de l'Employé</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
 
                    </div>
                </div>
            </div>
        </div>
   
    </div >
</body class="pbreak">
@endforeach
</html>
    
