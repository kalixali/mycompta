@extends('layout')
@section('content')

 <div class="container">
    <div class="card">
  <div class="card-header">SALAIRE - EMPLOYE</div>
  <div class="card-body">
    <div class="row">
        <form action="{{ url('searchsal') }}" method="post">
        {!! csrf_field() !!}
        <div class="col-md-4">   
        <label>Matricule</label>
        <input type="search" name="matricule" id="matricule" class="form-control" placeholder="Entrez ici le matricule de l'Employé">
        </div>
        <div class="col-md-2">
        <br/>
        <input type="submit" value="OK" class="btn btn-success form-control">
        </div>
        </form>
    </div>

    <div class="row align-items-center">  
      <form action="{{ url('salaire') }}" method="post">
        {!! csrf_field() !!}
        <div class="row gy-2 px-3 py-3 mx-3 my-3 border border-3">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Matricule</label>
                                    <input type="text" name="matricule" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Nom </label>
                                    <input type="text" name="nom" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Prénoms</label>
                                    <input type="text" name="prenoms" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Poste</label>
                                    <input type="text" name="poste" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">catégorie</label>
                                    <input type="text" name="categ" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Nbre part</label>
                                    <input type="number" name="nbrepart" id="nbrepart" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Salaire de base</label>
                                    <input type="number" name="salbase" id="salbase" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Sursalaire</label>
                                    <input type="number" name="sursal" id="sursal" class="form-control">
                                </div>
                            </div>
                                                                                
                        </div>
                       
                        <div class="row gy-2 px-3 py-3 mx-3 my-3 border border-3">
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Logement</label>
                                    <input type="number" name="avg_logement" id="avg_logement" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Vehicule</label>
                                    <input type="number" name="avg_vehicule" id="avg_vehicule" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Autres avantages</label>
                                    <input type="number" name="avg_otr" id="avg_otr" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Total avantages en nat. </label>
                                    <input type="number" name="totavtagenat" id="totavtagenat" class="form-control">
                                </div>
                            </div>
                                                        
                        </div>
                        <div class="row gy-2 px-3 py-3 mx-3 my-3 border border-3">
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Prime Anciennété</label>
                                    <input type="number" name="prime_ancien" id="prime_ancien"class="form-control">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Prime de Risque</label>
                                    <input type="number" name="prim_risq" id="prim_risq" class="form-control">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Autres Primes</label>
                                    <input type="number" name="prime_otr" id="prime_otr" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Total Primes</label>
                                    <input type="number" name="totprimes" id="totprimes" class="form-control">
                                </div>
                            </div>
                            
                            </div>
                            <div class="row gy-2 px-3 py-3 mx-3 my-3 border border-3">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Taux horaires</label>
                                    <input type="number" name="txhorair" id="txhorair" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Heure Sup. 15%</label>
                                    <input type="number" name="hsup15" id="hsup15" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Heure Sup. 50%</label>
                                    <input type="number" name="hsup50" id="hsup50" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Heure Sup. 75%</label>
                                    <input type="number" name="hsup75" id="hsup75" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Heure Sup. 100%</label>
                                    <input type="number" name="hsup100" id="hsup100" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Montant Heure Sup. 15%</label>
                                    <input type="number" name="msup15" id="msup15" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Montant Heure Sup. 50%</label>
                                    <input type="number" name="msup50" id="msup50" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Montant Heure Sup. 75%</label>
                                    <input type="number" name="msup75" id="msup75" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Montant Heure Sup. 100%</label>
                                    <input type="number" name="msup100" id="msup100" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Total Heure Sup.</label>
                                    <input type="number" name="totmhs" id="totmhs" class="form-control">
                                </div>
                            </div>
                        </div>
                       
                        <div class="row gy-2 px-3 py-3 mx-3 my-3 border border-3">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Indemnite de nourriture</label>
                                    <input type="number" name="ind_nourriture" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Indemnite de logement</label>
                                    <input type="number" name="ind_logement" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Autres Indemnites Taxables</label>
                                     <input type="number" name="ind_otrtax" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Total Indemnites Taxables</label>
                                     <input type="number" name="totindemnitetax" id="totindemnitetax" class="form-control">
                                </div>
                            </div>
                            
                            
                        </div>
                       
                    <div class="row gy-2 px-3 py-3 mx-3 my-3 border border-3">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Salaire Brut Imp.</label>
                                    <input type="number" name="salbimp" id="salbimp" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Cotisation Retraite</label>
                                    <input type="number" name="cr" id="cr" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Impôt sur Salaire</label>
                                     <input type="number" name="imps" id="imps" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                  
                                    <label class="form-label">Contribution Nationale</label>
                                     <input type="number" name="cn" id="cn" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Impôt General sur Revenues</label>
                                     <input type="number" name="igr" id="igr" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Total C. Fiscale employé</label>
                                     <input type="number" name="totficemp" id="totficemp" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Salaire Net</label>
                                     <input type="number" name="salnet" id="salnet" class="form-control">
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="row gy-2 px-3 py-3 mx-3 my-3 border border-3">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Indemnite de transport</label>
                                    <input type="number" name="ind_trsport" id="ind_trsport" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Indemnite de salissure</label>
                                    <input type="number" name="ind_salissure" id="ind_salissure" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Autres Indemnites</label>
                                     <input type="number" name="ind_otr" id="ind_otr" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Total Indemnites Non Taxables</label>
                                     <input type="number" name="totindemnite" id="totindemnite" class="form-control">
                                </div>
                            </div>
                            
                        </div>
                    
                    <div class="row gy-2 px-3 py-3 mx-3 my-3 border border-3">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Accompte</label>
                                    <input type="number" name="accompte" id="accompte" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Avance</label>
                                    <input type="number" name="avance" id="avance" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Autres Retenues</label>
                                     <input type="number" name="autres" id="autres" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Total Retenues</label>
                                     <input type="number" name="totretenues" id="totretenues" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                     <label class="form-label">Salaire Payé</label>
                                     <input type="number" name="salpaye" id="salpaye" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="hidden" name="cptabiliser" id="cptabiliser" class="form-control" value="False">
                                </div>
                            </div>
                                                        
                            <div class="col-md-3">
                                <div >
                                    <button type="submit" class="btn btn-primary form-control">Valider</button>
                                </div>
                            </div>
                        </div>
                        
    </form>
  </div>
</div>
 </div>

        <div class="row">
 
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>SALAIRE - EMPLOYE</h2>
                    </div>
                    <div class="card-body">
                        <br/>

                    <form action = "{{ url('getsalaire') }}" method = "POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Du</label>
                                    <input type="date" name="from_date" class="form-group">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Au</label>
                                    <input type="date" name="to_date" class="form-group">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Filtre</button>
                                </div>
                            </div>
                        </div>
                        <br/>
                        
                    </form>
                        
                    <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Matricule</th>
                                        <th>Nom</th>
                                        <th>Prénoms</th>
                                        <th>Salaire de base</th>
                                        <th>Sursalaire</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($salaire as $item)
                                    <tr>
                                        <td>{{ $item->matricule }}</td>
                                        <td>{{ $item->nom }}</td>
                                        <td>{{ $item->prenoms }}</td>
                                        <td>{{ $item->salbase }}</td>
                                        <td>{{ $item->sursal }}</td>
                                    <td>
                                            
                                        <!--    <a href="{{ url('/salaire/' . $item->id . '/edit') }}" title="Edit Salaire brut imp."><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> -->
 
                                            <form method="POST" action="{{ url('/salaire' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i>  Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
 
                    </div>
                </div>
            </div>
        </div>
      <script src="maff.js"></script>
    </div>
    
    
@stop