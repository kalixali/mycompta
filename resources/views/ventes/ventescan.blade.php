@extends('layout')
@section('content')
 
 <div class="container">
 <div class="card">
  <div class="card-header">VENTES</div>
  <div class="card-body">


  <div id="reader" width="600px" class="gy-2 px-3 py-3 mx-3 my-3 border border-3"></div>

  </div>
  </div>
  
  <div class="card">
  <div class="card-header">FACTURE DE VENTE</div>
  <div class="card-body">
  
     <div class="row align-items-center">  
      <form action="{{ url('ventes') }}" method="post">
        {!! csrf_field() !!}
        <div class="row gy-2 px-3 py-3 mx-3 my-3 border border-3">
        <div class="col-md-6">
        <label>N° Facture</label>
        <input type="text" name="numfact" id="numfact" class="inputbcolor form-control" autocomplete="off" value="{{$fa}}">
        <div id="facture_list"> </div>
        </div>
        <div class="col-md-6">
        <label>Client</label>
        <input type="text" name="sigleclt" id="sigleclt" class="form-control" autocomplete="off" >
        <div id="client_list"> </div>
        </div>
        <div class="col-md-6">
        <label>Code Article</label>
        <input type="text" name="refprod" id="refprod" class="form-control" autocomplete="off" >
        <div id="produit_list"> </div>
        </div>
        <div class="col-md-6">
        <label>Article</label>
        <input type="text" name="prod" id="prod" class="form-control">
        </div>
        <div class="col-md-6">
        <label>PU</label>
        <input type="number" name="pu" id="pu" class="form-control" autocomplete="off">
        </div>
        <div class="col-md-6">
        <label>Qtite</label>
        <input type="number" name="qtite" id="qtite" class="form-control" autocomplete="off">
        </div>
        <div class="col-md-6">
        <label>Montant M/ses</label>
        <input type="number" name="mont" id="mont" class="form-control" autocomplete="off">
        </div>
                
        <div class="col-md-6">
            <div class="row">
        
                <div class="col-md-4">   
                <label>Taux TVA(en %)</label>
                <input type="number" name="ttva" id="ttva" class="form-control" value="18">
                </div>
                <div class="col-md-8">
                <label>TVA</label>
                <input type="number" name="mtva" id="mtva" class="form-control" value="0">
                </div>
           </div>
        </div>

        <div class="col-md-6">
        <label>Montant TTC</label>
        <input type="number" name="mttc" id="mttc" class="form-control">
        </div>

        <div class="col-md-6">
            <div class="row">
                <div class="col-md-8">
                <label>Net à payer</label>
                <input type="number" name="netpay" id="netpay" class="form-control" value="0">
                </div>
           </div>
        </div>

        <div class="col-md-6">
            <input type="hidden" name="cptec" id="cptec" class="form-control">
        </div>
        <div class="col-md-6">
            <input type="hidden" name="cptevte" id="cptevte" class="form-control">
        </div>
        
       <div class="col-md-3 mt-3">
        <input type="submit" value="Valider" class="btn btn-success form-control">
        </div>
        
    </div>
    </form>
  </div>

  <div class="table-responsive">
        <table class="table"> 
            <thead>
                <tr>
                    <th>Num. Fact.</th>
                    <th>Article</th>
                    <th>Qtite</th>
                    <th>PU</th>
                    <th>Montant TTC</th>
                </tr>
            </thead>
            <tbody>
            
            
            </tbody>
        </table>

        <br/>
        
    </div>
<br/>
</div>
</div>
  </div>
  <script src="jquery-3.6.3.js"></script>
  <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
  <script>
function onScanSuccess(decodedText, decodedResult) {
	//alert(decodedText);
	//$('#result').val(decodedText);
	var idd = decodedText;
	var ii = idd.indexOf("-");
    var id = idd.substring(0,ii);
	//alert(idd);
	$.ajax({
		url: "{{ route('searchach3') }}",
		type: "GET",
		data: {'id' : id},
		success: function(data){
			var idd = data;
			var ii = idd.indexOf("-");
			var id = idd.substring(0,ii);
			var ii1 = idd.indexOf('-',ii+1);
			var id1 = idd.substring(ii+1, ii1);
            var ii2 = idd.indexOf('-',ii1+1);
            var id2 = idd.substring(ii1+1, ii2);
			var id3 = idd.substring(ii2+1);

            $("#refprod").val(id);
			$("#prod").val(id1);
			$("#pu").val(id2);
            $("#cptevte").val(id3);
			//alert(data);
		}
	});
	
	
}

function onScanFailure(error) {
	console.warn('Code scan error = ${error}');
}

let html5QrcodeScanner = new Html5QrcodeScanner(
  "reader",
  {
    fps: 10,
    qrbox: { width: 250, height: 250 } },
  /* verbose= */ false);
html5QrcodeScanner.render(onScanSuccess);
</script>
<script>
    $(document).ready(function() {
        $("#sigleclt").on('keyup', function() {
            var value = $(this).val();
            $.ajax({
                url: "{{ route('searchvte1') }}",
                type: "GET",
                data: {'sigleclt' : value},
                success: function(data){
                    $("#client_list").html(data);
                }
            });
        });

        $(document).on('click', '#client_list li', function() {
            var value = $(this).text();
            var ii = value.indexOf('-');
            var val1 = value.substring(0,ii-1);
            var val2 = value.substring(ii+1);
            $("#sigleclt").val(val1);
            $("#cptec").val(val2);
            $("#client_list").html(" "); 
        });  
    });
</script>
<script>
       
       $("#mont").click(function() {
            //calcul du montant total hors taxe
            ne = parseInt($("#qtite").val());
            nS = parseInt($("#pu").val());
            $("#mont").val(parseInt(ne*nS));
            
        });

        $("#mtva").click(function() {
            //calcul de la tva
            na = parseInt($("#mont").val());
            no = parseInt($("#ttva").val());
            $("#mtva").val(parseInt(na*(no/100)));
            //calcul du montant ttc
            ni = parseInt($("#mtva").val());
            $("#mttc").val(parseInt(na+ni));
            $("#netpay").val(parseInt(na+ni));
        });
        
  </script>
@stop