
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
                        <h2>BULLETIN DE SALAIRE - EMPLOYE</h2>
                    </div>
                    <div class="card-body">
                        <br/>
                        
                    <div class="table-responsive">
                            <table class="table">
                                <thead class="sbord">
                                                                          
                                    <tr>
                                        <td>Matricule</td>
                                        <td>{{ $empl->matricule }}</td>
                                        <td>{{$entreprise->sigle}}</td>
                                    </tr>
                                    <tr class = "border-1">
                                        <td class = "w-25">Nom</td>
                                        <td class = "w-25">{{ $empl->nom }}</td>
                                        <td>{{$entreprise->nom_complet}}</td>
                                    </tr>
                                    <tr>
                                        <td>Prénoms</td>
                                        <td>{{ $empl->prenoms }}</td>
                                        <td>Num CC</td>
                                        <td>{{$entreprise->numCC}}</td>
                                    </tr>
                                    <tr>
                                        <td>Catégorie</td>
                                        <td>{{ $empl->categ }}</td>
                                        <td>Num RC</td>
                                        <td>{{$entreprise->numRC}}</td>
                                    </tr>
                                    <tr>
                                        <td>Poste</td>
                                        <td>{{ $empl->poste }}</td>
                                        <td>{{$entreprise->contact1}}</td>
                                       
                                    </tr>
                                   
                                </thead>
                                
                                <tbody class="sbord">
                               
                                    
                                    <tr >
                                        <td>Salaire de base</td>
                                        <td>{{ $empl->salbase }}</td>
                                    </tr>
                                    <tr >
                                        <td>Sursalaire</td>
                                        <td>{{ $empl->sursal }}</td>
                                    </tr>
                                    <tr>
                                        <td>Total primes</td>
                                        <td>{{ $empl->totprimes }}</td>
                                    </tr>
                                    
                                     <tr>
                                        <td>Heure Sup. 15%</td>
                                        <td>{{ $heuresup->msup15 }}</td>
                                    </tr>
                                    <tr>
                                        <td>Heure Sup. 50%</td>
                                        <td>{{ $heuresup->msup50 }}</td>
                                    </tr>
                                    <tr>
                                        <td>Heure Sup. 75%</td>
                                        <td>{{ $heuresup->msup75 }}</td>
                                    </tr>
                                    <tr>
                                        <td>Heure Sup. 1OO%</td>
                                        <td>{{ $heuresup->msup100 }}</td>
                                    </tr>
                                    <tr>
                                        <td>Total H.S.</td>
                                        <td>{{ $empl->totmhs }}</td>
                                       
                                    </tr>
                                
                                    <tr>
                                        <td>Avantages en nat.</td>
                                        <td>{{ $empl->totavtagenat }}</td>
                                       
                                    </tr>
                                    <tr>
                                        <td>Salaire brut imposable</td>
                                        <td>{{ $empl->salbimp }}</td>
                                       
                                    </tr>
                                    <tr>
                                        <td>Retenues sur salaire</td>
                                    </tr>
                                    <tr>
                                        <td>CR</td>
                                        <td>{{ $cotsocemp->cr }}</td>
                                    </tr>
                                    <tr>
                                        <td>CN</td>
                                        <td>{{ $cotficemp->cn }}</td>
                                    </tr>
                                    <tr>
                                        <td>IS</td>
                                        <td>{{ $cotficemp->is }}</td>
                                    </tr>
                                    <tr>
                                        <td>IGR</td>
                                        <td>{{ $cotficemp->igr }}</td>
                                    </tr>
                                    <tr>
                                        <td>Salaire Net</td>
                                        <td>{{ $empl->salnet }}</td>
                                    </tr>
                                    <tr>
                                        <td>Indemnité de transport</td>
                                        <td>{{ $indemnite->ind_trsport }}</td>
                                    </tr>
                                    <tr>
                                        <td>Accompte</td>
                                        <td>{{ $retenues->accompte }}</td>
                                    </tr>
                                    <tr>
                                        <td>Avance</td>
                                        <td>{{ $retenues->avance }}</td>
                                    </tr>
                                    <tr>
                                        <td>Net à payer</td>
                                        <td>{{ $empl->salpay }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
 
                    </div>
                </div>
            </div>
        </div>
      
    </div>
</body>
</html>
    
