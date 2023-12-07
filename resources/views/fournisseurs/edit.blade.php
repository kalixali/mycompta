@extends('layout')
@section('content')
 
 <div class="container">
    <div class="card">
  <div class="card-header">EDIT PAGE</div>
  <div class="card-body">
  

     <div class="row align-items-center">  
     <form action="{{ url('fournisseurs/' .$fournisseurs->id) }}" method="post">
        {!! csrf_field() !!}
        @method("PATCH")
        <div class="row gy-2 px-3 py-3 mx-3 my-3 border border-3">
        <div class="col-md-6">
        <label>SIGLE</label>
        <input type="text" name="siglefourn" id="siglefourn" class="form-control" autocomplete="off" value="{{$fournisseurs->siglefourn}}">
        </div>
        <div class="col-md-6">
        <label>FOURNISSEUR</label>
        <input type="text" name="fournisseur" id="fournisseur" class="form-control" autocomplete="off" value="{{$fournisseurs->fournisseur}}">
        </div>
        <div class="col-md-6">
        <label>COMPTE FOURNISSEUR</label>
        <input type="number" name="cptef" id="cptef" class="form-control" value="{{$fournisseurs->cptef}}" required>
        </div>
        <div class="col-md-6">
        <label>CONTACT1</label>
        <input type="text" name="contactf1" id="contactf1" class="form-control" value="{{$fournisseurs->contactf1}}">
        </div>
        <div class="col-md-6">
        <label>CONTACT2</label>
        <input type="text" name="contactf2" id="contactf2" class="form-control" autocomplete="off" value="{{$fournisseurs->contactf2}}">
        </div>
        <div class="col-md-6">
        <label>EMAIL</label>
        <input type="text" name="emailf" id="emailf" class="form-control" autocomplete="off" value="{{$fournisseurs->emailf}}">
        </div>
        <div class="col-md-6">
        <label>ADRESSE</label>
        <input type="text" name="adressef" id="adressef" class="form-control" autocomplete="off" value="{{$fournisseurs->adressef}}">
        </div>
        <div class="col-md-6">
        <label>SIT. GEO</label>
        <input type="text" name="sitgeof" id="sitgeof" class="form-control" autocomplete="off" value="{{$fournisseurs->sitgeof}}">
        </div>
                       
       <div class="col-md-4 mt-3">
        <input type="submit" value="Valider" class="btn btn-success form-control">
        </div>
    </div>
        
    </form>
  </div>
</div>
 </div>

</div>
        
    <script>
       
        $("#montht").click(function() {
            //calcul du montant total hors taxe
            ne = parseInt($("#qtite").val());
            nS = parseInt($("#pu").val());
            $("#montht").val(ne*nS);
            //calcul du montant ttc
            na = parseInt($("#montht").val());
            no = parseInt($("#ttva").val());
            $("#mtva").val(na*(no/100));
            ni = parseInt($("#mtva").val());
            $("#mttc").val(na+ni);
        });
        $("#mtva").click(function() {
            //calcul de la tva
            na = parseInt($("#montht").val());
            no = parseInt($("#ttva").val());
            $("#mtva").val(na*(no/100));
            //calcul du montant ttc
            ni = parseInt($("#mtva").val());
            $("#mttc").val(na+ni);
        });
  </script>
@stop