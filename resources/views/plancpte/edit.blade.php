@extends('layout')
@section('content')
<div class="container">
<div class="card">
  <div class="card-header">EDIT Page</div>
  <div class="card-body">

      <form action="{{ url('plancpte/' .$plancpte->id) }}" method="post">
        {!! csrf_field() !!}
        @method("PATCH")
        <input type="hidden" name="id" id="id" class="form-control" value="{{$plancpte->id}}" id="id" />
        <div class="col-md-3">
        <label>COMPTE</label></br>
        <input type="number" name="compte" id="idcompte" class="form-control" value="{{$plancpte->compte}}" class="form-control"></br>
        </div>
        <div class="col-md-7">
        <label>LIBELLE</label></br>
        <input type="text" name="Libelle" id="idLibelle" class="form-control" value="{{$plancpte->Libelle}}" class="form-control"></br>
        </div>
        <div class="col-md-3 mt-3">
        <input type="submit" value="Modifier" class="btn btn-success form-control">
        </div>
    </form>
   
  </div>
</div>
</div>
@stop