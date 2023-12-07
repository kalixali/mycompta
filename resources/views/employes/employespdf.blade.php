
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
                        <h2 class="spolice"><u>LISTE DES EMPLOYES</u></h2>
                    </div>
                    <div class="card-body">
                        <br/>
                        
                    <div class="table-responsive">
                            <table class="table">
                                <thead class="">
                                    <tr >
                                        <td class="" colspan="3">{{$entreprise->sigle}}</td>
                                    </tr>
                                    <tr >
                                        <td class="" colspan="6">{{$entreprise->nom_complet}}</td>
                                    </tr>
                                    <tr >
                                        <td class="">Num CC :</td>
                                        <td class="" colspan="3">{{$entreprise->numCC}}</td>
                                        <th class=""></th>
                                        <td class="">Num RC :</td>
                                        <td class="" colspan="3">{{$entreprise->numRC}}</td>
                                        <th class=""></th>
                                        <td class="">Contact :</td>
                                        <td class="" colspan="3"> {{$entreprise->contact1}}</td>
                                    </tr>
                                    <br/>
                                    <tr>
                                        <th>Matricule</th>
                                        <th>Nom</th>
                                        <th>Prénoms</th>
                                        <th>Date nais.</th>
                                        <th>Lieu nais.</th>
                                        <th>Nationalité</th>
                                        <th>Date arriv.</th>
                                        <th>Date emb.</th>
                                        <th>Ancienneté</th>
                                        <th>Poste</th>
                                        <th>Sit. mat.</th>
                                        <th>nbre Enft</th>
                                        <th>Catégorie</th>
                                        <th>Salaire de base</th>
                                        <th>Txhoraire</th>
                                        <th>Sursalaire</th>
                                                                                                                        
                                    </tr>
                                    
                                   
                                </thead>
                                
                                <tbody >
                                    <h2></h2>
                                    @foreach($employe as $item)
                                    <tr>
                                        <td>{{ $item->matricule }}</td>
                                        <td>{{ $item->nom }}</td>
                                        <td>{{ $item->prenoms }}</td>
                                        <td>{{ $item->datenais }}</td>
                                        <td>{{ $item->lieunais }}</td>
                                        <td>{{ $item->nation }}</td>
                                        <td>{{ $item->datearriv }}</td>
                                        <td>{{ $item->datemb }}</td>
                                        <td>{{ $item->ancien }}</td>
                                        <td>{{ $item->poste }}</td>
                                        <td>{{ $item->sitmat }}</td>
                                        <td>{{ $item->nbrenft }}</td>
                                        <td>{{ $item->categ }}</td>
                                        <td>{{ $item->salbase }}</td>
                                        <td>{{ $item->txhorair }}</td>
                                        <td>{{ $item->sursal }}</td>
                                                                                                                        
                                    </tr>
                                @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
 
                    </div>
                </div>
            </div>
        </div>
   
    </div >
</body class="pbreak">
</html>
    
