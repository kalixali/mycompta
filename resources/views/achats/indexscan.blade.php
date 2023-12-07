@extends('layout')
@section('content')
 
 <div class="container">
    <div class="card">
  <div class="card-header">FACTURE D'ACHATS</div>
  <div class="card-body">
  
     <div class="row align-items-center">  
      <form action="{{ url('achats') }}" method="post">
        {!! csrf_field() !!}
        <div class="row gy-2 px-3 py-3 mx-3 my-3 border border-3">
        <div class="col-md-6">
        <label>N° Facture</label>
        <input type="text" name="numfact" id="numfact" class="inputbcolor form-control" autocomplete="off" >
        <div id="facture_list"> </div>
        </div>
        <div class="col-md-6">
        <label>Fournisseur</label>
        <input type="text" name="siglefourn" id="siglefourn" class="form-control" autocomplete="off" >
        <div id="fournisseur_list"> </div>
        </div>
        <div class="col-md-6">
        <label>Code Article</label>
        <input type="text" name="refprod" id="refprod" class="form-control" autocomplete="off" value="{{$data->refprod}}">
        <div id="produit_list"> </div>
        </div>
        <div class="col-md-6">
        <label>Article</label>
        <input type="text" name="prod" id="prod" class="form-control" value="{{$data->prod}}">
        </div>
        <div class="col-md-6">
        <label>Qtite</label>
        <input type="number" name="qtite" id="qtite" class="form-control" autocomplete="off">
        </div>
        <div class="col-md-6">
        <label>PU</label>
        <input type="number" name="pu" id="pu" class="form-control" autocomplete="off" value="{{$data->pu}}">
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
            <input type="hidden" name="cptef" id="cptef" class="form-control">
        </div>
        <div class="col-md-6">
            <input type="hidden" name="cpteach" id="cpteach" class="form-control">
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
            @foreach($achat as $item)
                <tr>
                    <td>{{ $item->numfact }}</td>
                    <td>{{ $item->prod }}</td>
                    <td>{{ $item->qtite }}</td>
                    <td>{{ $item->pu }}</td>
                    <td>{{ $item->mttc }}</td>
                    <td>
                    <!-- <a href="{{ url('/achats/' . $item->id . '/edit') }}" title="Edit Cotisation sociales"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> -->
                    <form method="POST" action="{{ url('/achats' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i>  Delete</button>
                    </form>
                    </td>
                </tr>
            @endforeach

            
            </tbody>
        </table>

        <br/>
        <div class="row">
            <form action="{{ url('downloadfactach') }}" method="POST">
            {!! csrf_field() !!}
            <div class="col-md-4">   
            <input type="hidden" name="numfact1" id="numfact1" class="form-control" autocomplete="off" value="{{$acha->numfact}}">
            </div>
            <div class="col-md-2">
            <br/>
            <input type="submit" value="IMPRIMER" class="btn btn-success form-control">
            </div>
            </form>
        </div>
        <br/>
        <div class="row">
            <form action="{{ url('/achats') }}" method="GET">
            {!! csrf_field() !!}
            <div class="col-md-2">
            <input type="submit" value="NOUVELLE FACTURE" class="btn btn-success form-control">
            </div>
            </form>
        </div>
    </div>
<br/>
</div>
 </div>

        
    </div>
    <script src="jquery-3.6.3.js"></script>
    <script>
        $(document).ready(function() {
            $("#siglefourn").on('keyup', function() {
                var value = $(this).val();
                $.ajax({
                    url: "{{ route('searchach1') }}",
                    type: "GET",
                    data: {'siglefourn' : value},
                    success: function(data){
                        $("#fournisseur_list").html(data);
                    }
                });
            });
            $("#refprod").on('keyup', function() {
                var value = $(this).val();
                $.ajax({
                    url: "{{ route('searchach2') }}",
                    type: "GET",
                    data: {'refprod' : value},
                    success: function(data){
                        $("#produit_list").html(data);
                    }
                });
            });

            $("#numfact").on('keyup', function() {
                var value = $(this).val();
                $.ajax({
                    url: "{{ route('searchfactach') }}",
                    type: "GET",
                    data: {'numfact' : value},
                    success: function(data){
                        $("#facture_list").html(data);
                    }
                });
            });
        
        $("#numfact1").on('keyup', function() {
            var value = $(this).val();
                $.ajax({
                    url: "{{ route('searchfactach1') }}",
                    type: "GET",
                    data: {'numfact1' : value},
                    success: function(data){
                        $("#facture_list1").html(data);
                    }
                });
            });
        }); 

        $(document).on('click', '#fournisseur_list li', function() {
            var value = $(this).text();
            var ii = value.indexOf('-');
            var val1 = value.substring(0,ii-1);
            var val2 = value.substring(ii+1);
            $("#siglefourn").val(val1);
            $("#cptef").val(val2);
            $("#fournisseur_list").html(" "); 
        });  
        
        $(document).on('click', '#produit_list li', function() {
            var value = $(this).text();
            var ii = value.indexOf('-');
            var ii1 = value.indexOf('-',ii+1);
            var ii2 = value.indexOf('-',ii1+1);
            var refp = value.substring(0,ii-1);
            var produi = value.substring(ii+1, ii1-1);
            var pua = value.substring(ii1+1, ii2-1);
            var cptea = value.substring(ii2+1);
            $("#refprod").val(refp);
            $("#prod").val(produi);
            $("#pu").val(pua);
            $("#cpteach").val(cptea);
            $("#produit_list").html(" "); 
        }); 
        
        $(document).on('click', '#facture_list li', function() {
            var value = $(this).text();
            //var ii = value.indexOf('-');
            //var val1 = value.substring(0,ii-1);
            $("#numfact").val(value);
            $("#facture_list").html(" "); 
        });   
       
        $(document).on('click', '#facture_list1 li', function() {
            var value = $(this).text();
            //var ii = value.indexOf('-');
            //var val1 = value.substring(0,ii-1);
            $("#numfact1").val(value);
            $("#facture_list1").html(" "); 
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