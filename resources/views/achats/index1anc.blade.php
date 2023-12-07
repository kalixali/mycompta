@extends('layout')
@section('content')
 
 <div class="container">
    <div class="card">
  <div class="card-header">FACTURE D'ACHATS</div>
  <div class="card-body">
  <div class="row">
        <form action="{{ url('searchach') }}" method="post">
        {!! csrf_field() !!}
        <div class="col-md-4">   
        <label>Réf. Produit</label>
        <input type="search" name="refprod" id="refprod" class="form-control" placeholder="Entrez ici la reference du produit" autocomplete="off">
            <div id="product_list"> </div>
        </div>
        <div class="col-md-2">
        <br/>
        <input type="submit" value="OK" class="btn btn-success form-control">
        </div>
        </form>
    </div>

     <div class="row align-items-center">  
      <form action="{{ url('achats') }}" method="post">
        {!! csrf_field() !!}
        <div class="row gy-2 px-3 py-3 mx-3 my-3 border border-3">
        <div class="col-md-6">
        <label>N° Facture</label>
        <input type="text" name="numfact" id="numfact" class="form-control" >
        </div>
        <div class="col-md-6">
        <label>Code Article</label>
        <input type="text" name="refprod" id="refprod" class="form-control" value="{{$produit->refprod}}">
        </div>
        <div class="col-md-6">
        <label>Article</label>
        <input type="text" name="prod" id="prod" class="form-control" value="{{$produit->prod}}">
        </div>
        <div class="col-md-6">
        <label>Qtite</label>
        <input type="number" name="qtite" id="qtite" class="form-control" autocomplete="off">
        </div>
        <div class="col-md-6">
        <label>PU</label>
        <input type="number" name="pu" id="pu" class="form-control" value="{{$produit->puach}}" autocomplete="off">
        </div>
        <div class="col-md-6">
        <label>Montant M/ses</label>
        <input type="number" name="mont" id="mont" class="form-control" autocomplete="off">
        </div>
        
        <div class="col-md-6">
            <div class="row">
        
                <div class="col-md-4">   
                <label>Taux Remise(en %)</label>
                <input type="number" name="t_remise" id="t_remise" class="form-control" value="0">
                </div>
                <div class="col-md-8">
                <label>Remise</label>
                <input type="number" name="remise" id="remise" class="form-control" value="0">
                </div>
           </div>
        </div>
        
       <div class="col-md-6">
            <div class="row">
        
                <div class="col-md-4">   
                <label>Taux (en %)</label>
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
                <div class="col-md-4">   
                <label>Frais sur achat</label>
                <input type="number" name="fr_ach" id="fr_ach" class="form-control" value="0">
                </div>
                <div class="col-md-8">
                <label>Net à payer</label>
                <input type="number" name="netpay" id="netpay" class="form-control" value="0">
                </div>
           </div>
        </div>

        <div class="col-md-6">
            <input type="hidden" name="cpteach" id="cpteach" class="form-control" value="{{$produit->cpteach}}">
        </div>
        <div class="col-md-6">
            <input type="hidden" name="cptefourn" id="cptefourn" class="form-control" value="{{$produit->cptefourn}}">
        </div>
        <div class="col-md-6">
            <input type="hidden" name="fourn" id="fourn" class="form-control" value="{{$produit->fourn}}">
        </div>
        
       <div class="col-md-2 mt-3">
        <input type="submit" value="Valider" class="btn btn-success form-control">
        </div>
        </div>
    </form>
  </div>
</div>
 </div>

        <div class="row">
 
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>ACHATS</h2>
                    </div>
                    <div class="card-body">
                        <br/>
                     
                     <form action = "{{ url('getachats') }}" method = "POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Du</label>
                                    <input type="date" name="from_date" class="form-group">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Au</label>
                                    <input type="date" name="to_date" class="form-group">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Filtre</button>
                                </div>
                            </div>
                        </div>
                        <br/>
                        
                    </form>       
                    <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Réf. Article</th>
                                        <th>Article</th>
                                        <th>Qtite</th>
                                        <th>PU</th>
                                        <th>Montant TTC</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($achats as $item)
                                    <tr>
                                        <td>{{ $item->refprod }}</td>
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
                        </div>
 
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="jquery-3.6.3.js"></script>
    <script>
        $(document).ready(function() {
            $("#refprod").on('keyup', function() {
                var value = $(this).val();
                $.ajax({
                    url: "{{ route('searchach1') }}",
                    type: "GET",
                    data: {'refprod' : value},
                    success: function(data){
                        $("#product_list").html(data);
                    }
                });
            });
        }); 
        $(document).on('click', 'li', function() {
            var value = $(this).text();
            $("#refprod").val(value);
            $("#product_list").html(" "); 
        });   
    </script>
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
        $("#netpay").click(function() {
            //calcul de la tva
            na = parseInt($("#mttc").val());
            no = parseInt($("#fr_ach").val());
            $("#netpay").val(na+no);
            
        });
  </script>
@stop