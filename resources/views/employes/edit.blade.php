@extends('layout')
@section('content')
<div class="container text-center">
<div class="card">
  <div class="card-header">EDIT Page</div>
  <div class="card-body">
          
      <form action="{{ url('employes/' .$employes->id) }}" method="post">
        {!! csrf_field() !!}
        @method("PATCH")
        
       <div class="row gy-2 px-3 py-3 mx-3 my-3 border border-3"> 
        <input type="hidden" name="id" id="id" value="{{$employes->id}}" id="id" /> <br/>
        
          <div class="row gy-2 px-3 py-3 mx-3 my-3 border border-3">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Matricule</label>
                                    <input type="text" name="matricule" class="form-control" value="{{$employes->matricule}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Nom </label>
                                    <input type="text" name="nom" class="form-control" value="{{$employes->nom}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Prénoms</label>
                                    <input type="text" name="prenoms" class="form-control" value="{{$employes->prenoms}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Date nais.</label>
                                    <input type="date" name="datenais" class="form-control" value="{{$employes->datenais}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Lieu nais.</label>
                                    <input type="text" name="lieunais" class="form-control" value="{{$employes->lieunais}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Nationalité</label>
                                    <input type="text" name="nation" class="form-control" value="{{$employes->nation}}">
                                </div>
                            </div>
                            
                                                        
                        </div>
                       
                        <div class="row gy-2 px-3 py-3 mx-3 my-3 border border-3">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Poste</label>
                                    <input type="text" name="poste" class="form-control" value="{{$employes->poste}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Date arriv.</label>
                                    <input type="date" name="datearriv" class="form-control" value="{{$employes->datearriv}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Date emb.</label>
                                    <input type="date" name="datemb" class="form-control" value="{{$employes->datemb}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Ancienneté</label>
                                    <input type="text" name="ancien" class="form-control" value="{{$employes->ancien}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">   Sit. mat. </label>
                                    <input type="text" name="sitmat" class="form-control" value="{{$employes->sitmat}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">nbre Enft</label>
                                    <input type="number" name="nbrenft" class="form-control" value="{{$employes->nbrenft}}">
                                </div>
                            </div>
                            
                            
                        </div>
                        <br/>

                        <div class="row gy-2 px-3 py-3 mx-3 my-3 border border-3">
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Nbre part</label>
                                    <input type="text" name="nbrepart" class="form-control" value="{{$employes->nbrepart}}">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Catégorie</label>
                                    <input type="text" name="categ" class="form-control" value="{{$employes->categ}}">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Salaire de base</label>
                                    <input type="number" name="salbase" id="salbase" class="form-control" value="{{$employes->salbase}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Txhoraire</label>
                                    <input type="text" name="txhorair" id="txhorair" class="form-control" value="{{$employes->txhorair}}">
                                </div>
                            </div>
                            
                            </div>
                            <div class="row gy-2 px-3 py-3 mx-3 my-3 border border-3">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Sursalaire</label>
                                    <input type="number" name="sursal" class="form-control" value="{{$employes->sursal}}">
                                </div>
                            </div>
                            <br/>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Photo</label>
                                    <img src="{{ asset($employes->photo) }}" width= '100' height= '100' >
                                </div>
                            </div>
                            <br/>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" class="form-control" value="{{$employes->description}}"></textarea>
                                </div>
                            </div>
                            
                        </div>

                    <br/>
                        <div class="row gy-2 px-3 py-3 mx-3 my-3 border border-3">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Logement</label>
                                    <input type="number" name="avg_logement" class="form-control" value="{{$employes->avg_logement}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Vehicule</label>
                                    <input type="number" name="avg_vehicule" class="form-control" value="{{$employes->avg_vehicule}}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Autres</label>
                                    <input type="number" name="avg_otr" class="form-control" value="{{$employes->avg_otr}}">
                                </div>
                            </div>
                            
                        </div>
                        <br/>
                        <div class="row gy-2 px-3 py-3 mx-3 my-3 border border-3">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Prime Anciennété</label>
                                    <input type="number" name="prime_ancien" class="form-control" value="{{$employes->prime_ancien}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Prime Risque</label>
                                    <input type="number" name="prim_risq" class="form-control" value="{{$employes->prim_risq}}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Autres Primes</label>
                                     <input type="number" name="prime_otr" class="form-control" value="{{$employes->prime_otr}}">
                                </div>
                            </div>
                            
                        </div>
                        <br/>
                        <div class="row gy-2 px-3 py-3 mx-3 my-3 border border-3">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Indemnite de transport</label>
                                    <input type="number" name="ind_trsport" class="form-control" value="{{$employes->ind_trsport}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Indemnite de salissure</label>
                                    <input type="number" name="ind_salissure" class="form-control" value="{{$employes->ind_salissure}}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Autres Indemnites</label>
                                     <input type="number" name="ind_otr" class="form-control" value="{{$employes->ind_otr}}">
                                </div>
                            </div>
                            
                        </div>
                        <br/>
                        <div class="row gy-2 px-3 py-3 mx-3 my-3 border border-3">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Indemnite de nourriture</label>
                                    <input type="number" name="ind_nourriture" class="form-control" value="{{$employes->ind_nourriture}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Indemnite de logement</label>
                                    <input type="number" name="ind_logement" class="form-control" value="{{$employes->ind_logement}}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Autres Indemnites Taxables</label>
                                     <input type="number" name="ind_otrtax" class="form-control" value="{{$employes->ind_otrtax}}">
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
  </div>
  <script src="maff.js"></script>
</div>
 
@stop