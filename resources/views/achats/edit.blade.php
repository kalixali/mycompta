@extends('layout')
@section('content')
 
 <div class="container">
    <div class="card">
  <div class="card-header">EDIT PAGE</div>
  <div class="card-body">
  

     <div class="row align-items-center">  
     <form action="{{ url('achats/' .$achats->id) }}" method="post">
        {!! csrf_field() !!}
        @method("PATCH")
        <div class="row gy-2 px-3 py-3 mx-3 my-3 border border-3">
        <div class="col-md-6">
        <label>N° Facture</label>
        <input type="text" name="numfact" id="numfact" class="form-control" value="{{$achats->numfact}}">
        </div>
        <div class="col-md-6">
        <label>Code Article</label>
        <input type="text" name="refprod" id="refprod" class="form-control" value="{{$achats->refprod}}">
        </div>
        <div class="col-md-6">
        <label>Article</label>
        <input type="text" name="prod" id="prod" class="form-control" value="{{$achats->prod}}">
        </div>
        <div class="col-md-6">
        <label>Qtite</label>
        <input type="number" name="qtite" id="qtite" class="form-control" autocomplete="off" value="{{$achats->qtite}}">
        </div>
        <div class="col-md-6">
        <label>PU</label>
        <input type="number" name="pu" id="pu" class="form-control" autocomplete="off" value="{{$achats->pu}}">
        </div>
        <div class="col-md-6">
        <label>Montant</label>
        <input type="number" name="montht" id="montht" class="form-control" autocomplete="off" value="{{$achats->montht}}">
        </div>
        
        <div class="col-md-6">
            <div class="row">
        
                <div class="col-md-4">   
                <label>Taux (en %)</label>
                <input type="number" name="ttva" id="ttva" class="form-control" value="18">
                </div>
                <div class="col-md-8">
                <label>TVA</label>
                <input type="number" name="mtva" id="mtva" class="form-control" value="{{$achats->mtva}}">
                </div>
           </div>
        </div>
        <div class="col-md-6">
        <label>Montant TTC</label>
        <input type="number" name="mttc" id="mttc" class="form-control" value="{{$achats->mttc}}">
        </div>
        <div class="col-md-6">
            <input type="hidden" name="cpteach" id="cpteach" class="form-control" value="{{$achats->cpteach}}">
        </div>
        <div class="col-md-6">
            
        </div>
        
        <div class="col-md-3 mt-3">
        <input type="submit" value="Modifier" class="form-control btn btn-success"></br>
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