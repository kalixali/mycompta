@extends('layout')
@section('content')
 
<div class="card">
  <div class="card-header">EDIT Page</div>
  <div class="card-body">
    <div class="row align-items-center">
      
      <form action="{{ url('sortistock/' .$sortistock->id) }}" method="post">
        {!! csrf_field() !!}
        @method("PATCH")
        
        
        <input type="hidden" name="id" id="id" value="{{$sortistock->id}}" id="id" /> <br/>
        
        <div class="col-md-auto">
        <label>ARTICLE</label>
        <input type="text" name="prod" id="idprod" class="form-control" value="{{$sortistock->prod}} " disabled="disabled" >
        </div>

        <div class="col-md-auto">
        <label>QTITE</label>
        <input type="text" name="qtite" id="idqtite" class="form-control" value="{{$sortistock->qtite}}">
        </div>

        <div class="col-md-auto">
        <label>PU</label>
        <input type="text" name="pu" id="idpu" class="form-control" value="{{$sortistock->pu}}">
        </div>

        <div class="col-md-auto">
        <label>MONTANT</label>
        <input type="text" name="mont" id="idmont" class="form-control" value="{{$sortistock->mont}}">
        </div>

        <input type="submit" value="Modifier" class="btn btn-success"></br>
    </form>
   </div>
   </div>
  </div>
</div>
 
@stop