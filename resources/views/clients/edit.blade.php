@extends('layout')
@section('content')
 
 <div class="container">
    <div class="card">
  <div class="card-header">EDIT PAGE</div>
  <div class="card-body">
  

     <div class="row align-items-center">  
     <form action="{{ url('clients/' .$clients->id) }}" method="post">
        {!! csrf_field() !!}
        @method("PATCH")
        <div class="row gy-2 px-3 py-3 mx-3 my-3 border border-3">
        <div class="col-md-6">
        <label>SIGLE</label>
        <input type="text" name="sigleclt" id="sigleclt" class="form-control" autocomplete="off" value="{{$clients->sigleclt}}">
        </div>
        <div class="col-md-6">
        <label>CLIENT</label>
        <input type="text" name="client" id="client" class="form-control" autocomplete="off" value="{{$clients->client}}">
        </div>
        <div class="col-md-6">
        <label>COMPTE CLIENT</label>
        <input type="number" name="cptec" id="cptec" class="form-control" value="{{$clients->cptec}}" required>
        </div>
        <div class="col-md-6">
        <label>CONTACT1</label>
        <input type="text" name="contactc1" id="contactc1" class="form-control" value="{{$clients->contactc1}}">
        </div>
        <div class="col-md-6">
        <label>CONTACT2</label>
        <input type="text" name="contactc2" id="contactc2" class="form-control" autocomplete="off" value="{{$clients->contactc2}}">
        </div>
        <div class="col-md-6">
        <label>EMAIL</label>
        <input type="text" name="emailc" id="emailc" class="form-control" autocomplete="off" value="{{$clients->emailc}}">
        </div>
        <div class="col-md-6">
        <label>ADRESSE</label>
        <input type="text" name="adressec" id="adressec" class="form-control" autocomplete="off" value="{{$clients->adressec}}">
        </div>
        <div class="col-md-6">
        <label>SIT. GEO</label>
        <input type="text" name="sitgeoc" id="sitgeoc" class="form-control" autocomplete="off" value="{{$clients->sitgeoc}}">
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