@extends('layout')
@section('content')

<div class="container">
<div class="card">
  <div class="card-header">EDIT Page</div>
  <div class="card-body">
    <div class="row align-items-center">
      
      <form action="{{ url('codesjournaux/' .$codesjournaux->id) }}" method="post">
        {!! csrf_field() !!}
        @method("PATCH")
        
        
        <input type="hidden" name="id" id="id" value="{{$codesjournaux->id}}" id="id" /> <br/>


        <div class="col-md-3">
        <label>Code</label>
        <input type="text" name="Code" id="Code" class="form-control" autocomplete="off" value="{{$codesjournaux->Code}}">
            <div id="compte_list"> </div>
        </div>
        <div class="col-md-3">
        <label>Type</label>
        <input type="text" name="Type" id="Type" class="form-control" value="{{$codesjournaux->Type}}">
        </div>
        <div class="col-md-6">
        <label>Désignation</label>
        <input type="text" name="Designation" id="Designation" class="form-control" value="{{$codesjournaux->Designation}}">
        </div>
        
        <div class="col-md-3 mt-3"> 
        <input type="submit" value="Modifier" class="btn btn-success form-control">
        </div>
    </form>
   </div>
   </div>
  </div>
</div>
</div>
@stop
 
