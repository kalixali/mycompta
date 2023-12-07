@extends('layout')
@section('content')

<div class="container">
 
<div class="card">
  <div class="card-header">EDIT Page</div>
  <div class="card-body">
    <div class="row align-items-center">
      
      <form action="{{ url('cotficpat/' .$cotficpat->id) }}" method="post">
        {!! csrf_field() !!}
        @method("PATCH")
        
        <div class="col-12 gy-2 px-3 py-3 mx-1 my-3 border border-3">
        <div class="col-md-4">
        <input type="hidden" name="id" id="id" value="{{$cotficpat->id}}" id="id" class="form-control"/>
        </div>
        
        <div class="col-md-4">
        <label>Matricule</label>
        <input type="text" name="matricule" id="matricule" class="form-control" value="{{$cotficpat->matricule}}">
        </div>
        <div class="col-md-6">
        <label>Nom</label>
        <input type="text" name="nom" id="nom" class="form-control" value="{{$cotficpat->nom}}">
        </div>
        <div class="col-md-6">
        <label>Prénoms</label>
        <input type="text" name="prenoms" id="prenoms" class="form-control" value="{{$cotficpat->prenoms}}">
        </div>
        <div class="col-md-4">
        <label>Nationalité</label>
        <input type="text" name="nation" id="nation" class="form-control" value="{{$cotficpat->nation}}">
        </div>

        <div class="col-md-4">
        <label>Salaire brut imposable</label>
        <input type="number" name="salbimp" id="salbimp" class="form-control" value="{{$cotficpat->salbimp}}">
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-4">   
                <label>Taux (en %)</label>
                <input type="text" name="t_is_p" id="t_is_p" class="form-control" value="{{$cotficpat->t_is_p}}">
                </div>
                <div class="col-md-8">
                <label>Impôt sur salaire</label>
                <input type="number" name="is_p" id="is_p" class="form-control" value="{{$cotficpat->is_p}}">
                </div>
                
            </div>
        
        </div>

        <div class="col-md-4">

            <div class="row">
        
                <div class="col-md-4">   
                <label>Taux (en %)</label>
                <input type="text" name="t_ta_fdfp" id="t_ta_fdfp" class="form-control" value="{{$cotficpat->t_ta_fdfp}}">
                </div>
                <div class="col-md-8">
                <label>Taxe d'apprentissage</label>
                <input type="number" name="ta_fdfp" id="ta_fdfp" class="form-control" value="{{$cotficpat->ta_fdfp}}">
                </div>
                
            </div>

        </div>

        <div class="col-md-4">

            <div class="row">
        
                <div class="col-md-4">   
                <label>Taux (en %)</label>
                <input type="text" name="t_fpc_fdfp" id="t_fpc_fdfp" class="form-control" value="{{$cotficpat->t_fpc_fdfp}}">
                </div>
                <div class="col-md-8">
                <label>Contribution FPC</label>
                <input type="number" name="fpc_fdfp" id="fpc_fdfp" class="form-control" value="{{$cotficpat->fpc_fdfp}}">
                </div>
                
            </div>

        </div>
        
        <div class="col-md-2 mt-3">
        <input type="submit" value="Valider" class="btn btn-success form-control">
        </div>
        </div>
    </form>
   </div>
   </div>
  </div>
</div>

</div>
@stop