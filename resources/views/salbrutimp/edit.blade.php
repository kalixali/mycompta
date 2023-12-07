@extends('layout')
@section('content')

<div class="container">
 
<div class="card">
  <div class="card-header">EDIT Page</div>
  <div class="card-body">
    <div class="row align-items-center">
      
      <form action="{{ url('salbrutimp/' .$salbrutimp->id) }}" method="post">
        {!! csrf_field() !!}
        @method("PATCH")
                
        <div class="col-md-4">
        <input type="hidden" name="id" id="id" value="{{$salbrutimp->id}}" id="id" class="form-control"/>
        </div>
        
        <div class="col-md-4">
        <label>Matricule</label>
        <input type="text" name="matricule" id="matricule" class="form-control" value="{{$salbrutimp->matricule}}">
        </div>
        <div class="col-md-4">
        <label>Salaire de base</label>
        <input type="number" name="salbase" id="idsalbase" class="form-control" value="{{$salbrutimp->salbase}}">
        </div>
        <div class="col-md-4">
        <label>Sursalaire</label>
        <input type="number" name="sursal" id="idsursal" class="form-control" value="{{$salbrutimp->sursal}}">
        </div>
        <div class="col-md-4">
        <label>Total primes</label>
        <input type="number" name="totprimes" id="idtotprimes" class="form-control" value="{{$salbrutimp->totprimes}}">
        </div>
        <div class="col-md-4">
        <label>Avantages en nat.</label>
        <input type="number" name="totavtagenat" id="idtotavtagenat" class="form-control" value="{{$salbrutimp->totavtagenat}}">
        </div>
        <div class="col-md-4">
        <label>Tot H.S.</label>
        <input type="number" name="totmhs" id="idtotmhs" class="form-control" value="{{$salbrutimp->totmhs}}">
        </div>
        <div class="col-md-4">
        <label>Salaire b. imp.</label>
        <input type="number" name="salbimp" id="idsalbimp" class="form-control" value="{{$salbrutimp->salbimp}}">
        </div>
        
        <div class="col-md-2 mt-3">
        <input type="submit" value="Valider" class="btn btn-success form-control">
        </div>
    </form>
   </div>
   </div>
  </div>
</div>

</div>
@stop