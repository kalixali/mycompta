@extends('layout')
@section('content')

<div class="container">
 
<div class="card">
  <div class="card-header">EDIT Page</div>
  <div class="card-body">
    <div class="row align-items-center">
      
      <form action="{{ url('cotsocpat/' .$cotsocpat->id) }}" method="post">
        {!! csrf_field() !!}
        @method("PATCH")
        <div class="col-12 gy-2 px-3 py-3 mx-1 my-3 border border-3">
        
        <div class="col-md-4">
        <input type="hidden" name="id" id="id" value="{{$cotsocpat->id}}" id="id" class="form-control"/>
        </div>
        
        <div class="col-md-4">
        <label>Matricule</label>
        <input type="text" name="matricule" id="idmatricule" class="form-control" value="{{$cotsocpat->matricule}}">
        </div>
        <div class="col-md-6">
        <label>Nom</label>
        <input type="text" name="nom" id="nom" class="form-control" value="{{$cotsocpat->nom}}">
        </div>
        <div class="col-md-6">
        <label>Prénoms</label>
        <input type="text" name="prenoms" id="prenoms" class="form-control" value="{{$cotsocpat->prenoms}}">
        </div>
        <div class="col-md-4">
        <label>Salaire brut sociale</label>
        <input type="number" name="salbimp" id="idsalbimp" class="form-control" value="{{$cotsocpat->salbimp}}">
        </div>
        <div class="col-md-4">
            <div class="row">
        
                <div class="col-md-4">   
                <label>Taux (en %)</label>
                <input type="text" name="t_prest_fam" id="t_prest_fam" class="form-control" value="{{$cotsocpat->t_prest_fam}}">
                </div>
                <div class="col-md-8">
                <label>Prestation familiale</label>
                <input type="number" name="prest_fam" id="idprest_fam" class="form-control" value="{{$cotsocpat->prest_fam}}">
                </div>
                
            </div>
        
        </div>

        <div class="col-md-4">

            <div class="row">
        
                <div class="col-md-4">   
                <label>Taux (en %)</label>
                <input type="text" name="t_acc_trv" id="t_acc_trv" class="form-control" value="{{$cotsocpat->t_acc_trv}}">
                </div>
                <div class="col-md-8">
                <label>Accident de travail</label>
                <input type="number" name="acc_trv" id="idacc_trv" class="form-control" value="{{$cotsocpat->acc_trv}}">
                </div>
                
            </div>

        </div>

        <div class="col-md-4">

            <div class="row">
        
                <div class="col-md-4">   
                <label>Taux (en %)</label>
                <input type="text" name="t_cr_p" id="t_cr_p" class="form-control" value="{{$cotsocpat->t_cr_p}}">
                </div>
                <div class="col-md-8">
                <label>Cotisation retraite</label>
                <input type="number" name="cr_p" id="idcr_p" class="form-control" value="{{$cotsocpat->cr_p}}">
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