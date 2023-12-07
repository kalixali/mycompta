@extends('layout')
@section('content')

<div class="container">
<div class="card">
  <div class="card-header">EDIT Page</div>
  <div class="card-body">
    <div class="row align-items-center">
      
      <form action="{{ url('journal/' .$journal->id) }}" method="post">
        {!! csrf_field() !!}
        @method("PATCH")
        
        <div class="col-12 gy-2 px-3 py-3 mx-1 my-3 border border-3">
        <input type="hidden" name="id" id="id" value="{{$journal->id}}" id="id" /> <br/>
        
        <div class="col-md-3">
        <label>Compte</label>
        <input type="number" name="compte" id="idcompte" class="form-control" value="{{$journal->compte}}">
        </div>

        <div class="col-md-6">
        <label>Libellé</label>
        <input type="text" name="libellé" id="idlibellé" class="form-control" value="{{$journal->libellé}}">
        </div>
        <div class="col-md-3">
        <label>Code journal</label>
        <input type="text" name="codejournal" id="codejournal" class="form-control" value="{{$journal->codejournal}}">
        </div>
        <div class="col-md-3">
        <label>Num. pièce</label>
        <input type="text" name="numpiece" id="numpiece" class="form-control" value="{{$journal->numpiece}}">
        </div>
        <div class="col-md-3">
        <label>Montant debit</label>
        <input type="number" name="Mdebit" id="idMdebit" class="form-control" value="{{$journal->Mdebit}}">
        </div>

        <div class="col-md-3">
        <label>Montant credit</label>
        <input type="number" name="Mcredit" id="idMcredit" class="form-control" value="{{$journal->Mcredit}}">
        </div>
        <div class="col-md-3 mt-3"> 
        <input type="submit" value="Modifier" class="btn btn-success form-control">
        </div>
        </div>
    </form>
   </div>
   </div>
  </div>
</div>
</div>
@stop
 
