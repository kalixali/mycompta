@extends('layout')
@section('content')
 
 <div class="container text-center">
    <div class="card">
  <div class="card-header">SAISIE DES EMPLOYES</div>
  <div class="card-body">

    <form action = "{{ url('employes') }}" method = "POST" enctype = "multipart/form-data">
                        {{ csrf_field() }}
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
                                    <label class="form-label">Date nais.</label>
                                    <input type="date" name="datenais" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Lieu nais.</label>
                                    <input type="text" name="lieunais" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Nationalité</label>
                                    <input type="text" name="nation" id="nation" class="form-control">
                                </div>
                            </div>
                            
                                                        
                        </div>
                       
                        <div class="row gy-2 px-3 py-3 mx-3 my-3 border border-3">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Poste</label>
                                    <input type="text" name="poste" id="poste" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Date arriv.</label>
                                    <input type="date" name="datearriv" id="datearriv" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Date emb.</label>
                                    <input type="date" name="datemb" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Ancienneté</label>
                                    <input type="text" name="ancien" id="ancien" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                <label class="form-label">Situation Matrimoniale</label>
                                   <select class="form-control" name="sitmat" id="sitmat">
                                        <option value=" " selected class="form-control">--Choisir--</option>
                                        <option value="Marié(e)" class="form-control">Marié(e)</option>
                                        <option value="Célibataire(e)" class="form-control">Célibataire(e)</option>
                                        <option value="Divorcé(e)" class="form-control">Divorcé(e)</option>
                                        <option value="Veuf(ve)" class="form-control">Veuf(ve)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Nbre Enft</label>
                                    <input type="number" name="nbrenft" id="nbrenft" class="form-control">
                                </div>
                            </div>
                            
                            
                        </div>
                        <br/>

                        <div class="row gy-2 px-3 py-3 mx-3 my-3 border border-3">
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Nbre part</label>
                                    <input type="text" name="nbrepart" id="nbrepart"class="form-control">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Catégorie</label>
                                    <input type="text" name="categ" class="form-control">
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
                                    <label class="form-label">Txhoraire</label>
                                    <input type="text" name="txhorair" id="txhorair" class="form-control">
                                </div>
                            </div>
                            
                            </div>
                            <div class="row gy-2 px-3 py-3 mx-3 my-3 border border-3">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Sursalaire</label>
                                    <input type="number" name="sursal" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Photo</label>
                                    <input type="file" name="photo" class="form-control" class="img img-responsive">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <br/>
                        <div class="row gy-2 px-3 py-3 mx-3 my-3 border border-3">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Logement</label>
                                    <input type="number" name="avg_logement" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Vehicule</label>
                                    <input type="number" name="avg_vehicule" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Autres</label>
                                    <input type="number" name="avg_otr" class="form-control">
                                </div>
                            </div>
                            
                        </div>
                        <br/>
                        <div class="row gy-2 px-3 py-3 mx-3 my-3 border border-3">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Prime Anciennété</label>
                                    <input type="number" name="prime_ancien" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Prime Risque</label>
                                    <input type="number" name="prim_risq" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Autres Primes</label>
                                     <input type="number" name="prime_otr" class="form-control">
                                </div>
                            </div>
                            
                        </div>
                        <br/>
                        <div class="row gy-2 px-3 py-3 mx-3 my-3 border border-3">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Indemnite de transport</label>
                                    <input type="number" name="ind_trsport" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Indemnite de salissure</label>
                                    <input type="number" name="ind_salissure" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Autres Indemnites</label>
                                     <input type="number" name="ind_otr" class="form-control">
                                </div>
                            </div>
                            
                        </div>
                        <br/>
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
                            
                            <div class="col-md-3">
                                <div >
                                    <button type="submit" class="btn btn-primary form-control">Valider</button>
                                </div>
                            </div>
                        </div>
                        <br/>
                                
                    </form>
    
</div>
 </div>

        <div class="row">
 
            <!-- <div class="col-md-12"> -->
                <div class="card">
                    <div class="card-header">
                        <h2>LISTE DES EMPLOYES</h2>
                    </div>
                    <div class="card-body">
                        
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Matricule</th>
                                        <th>Nom</th>
                                        <th>Prénoms</th>
                                        <th>Date nais.</th>
                                        <th>Lieu nais.</th>
                                        <th>Nationalité</th>
                                        <th>Date arriv.</th>
                                        <th>Ancienneté</th>
                                        <th>Photo</th>
                                                                                
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($employes as $item)
                                    <tr>
                                        <td>{{ $item->matricule }}</td>
                                        <td>{{ $item->nom }}</td>
                                        <td>{{ $item->prenoms }}</td>
                                        <td>{{ $item->datenais }}</td>
                                        <td>{{ $item->lieunais }}</td>
                                        <td>{{ $item->nation }}</td>
                                        <td>{{ $item->datearriv }}</td>
                                        <td>{{ $item->ancien }}</td>
                                        <td><img src="{{ asset($item->photo) }}" width= '50' height= '50' ></td>
                                                                                 
                                        <td>
                                            
                                        <!--    <a href="{{ url('/employes/' . $item->id . '/edit') }}" title="Edit EMPLOYES"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> -->
 
                                            <form method="POST" action="{{ url('/employes' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
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

                        <form action = "{{ url('EmployesPDF2') }}" method = "POST" enctype = "multipart/form-data">
                        {{ csrf_field() }}
                        
                        <div class="col-md-0">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Imprimer</button>
                            </div>
                        </div>
                    </div>
                </form>
                    </div>
                </div>
            <!-- </div> -->
        </div>
        <script src="maff.js"></script>
    </div>
@stop