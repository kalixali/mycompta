@extends('layout')
@section('content')
 <div class="container">
<div class="card">
  <div class="card-header">EDIT Page</div>
  <div class="card-body">
    <div class="row align-items-center">
      
      <form action="{{ url('produit/' .$produit->id) }}" method="post">
        {!! csrf_field() !!}
        @method("PATCH")
        
        <div class="col-md-4">
        <input type="hidden" name="id" id="id" value="{{$produit->id}}" id="id" /> <br/>
        </div>
        
        <div class="col-md-4">
        <label>Réf. Article</label>
        <input type="text" name="refprod" id="refprod" class="form-control" value="{{$produit->refprod}}">
        </div>
        <div class="col-md-4">
        <label>Article</label>
        <input type="text" name="prod" id="prod" class="form-control" value="{{$produit->prod}}">
        </div>
        <div class="col-md-4">
        <label>PU achat</label>
        <input type="number" name="puach" id="puach" class="form-control" value="{{$produit->puach}}">
        </div>
        <div class="col-md-4">
        <label>PU vente</label>
        <input type="number" name="puvte" id="puvte" class="form-control" value="{{$produit->puvte}}">
        </div>
        <div class="col-md-4">
        <label>Compte Achat</label>
        <input type="text" name="cpteach" id="cpteach" class="form-control" autocomplete="off" value="{{$produit->cpteach}}">
        </div>
        <div class="col-md-4">
        <label>Compte Vente</label>
        <input type="text" name="cptevte" id="cptevte" class="form-control" autocomplete="off" value="{{$produit->cptevte}}">
        </div>
                
        <div class="col-md-3 mt-3">
        <input type="submit" value="Valider" class="btn btn-success form-control">
        </div>
    </form>
   </div>
   </div>
  </div>
</div>
@stop