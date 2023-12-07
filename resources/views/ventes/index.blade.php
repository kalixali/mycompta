@extends('layout')
@section('content')
 
 <div class="container">
    <div class="card">
  <div class="card-header">FACTURE DE VENTES</div>
  <div class="card-body">
  
     <div class="row align-items-center">  
      <form action="{{ url('ventes') }}" method="post">
        {!! csrf_field() !!}
        <div class="row gy-2 px-3 py-3 mx-3 my-3 border border-3">
        <div class="col-md-4">
        <label>N° Facture</label>
        <input type="text" name="numfact" id="numfact" class="form-control" value="{{$fv}}">
        <div id="facture_list"> </div>
        </div>
        <div class="col-md-4">
        <label>Client</label>
        <input type="text" name="sigleclt" id="sigleclt" class="form-control" autocomplete="off">
        <div id="client_list"> </div>
        </div>
        <div class="col-md-4">
        <label>Code Article</label>
        <input type="text" name="refprod" id="refprod" class="form-control" autocomplete="off" required>
        <div id="produit_list"> </div>
        </div>
        <div class="col-md-4">
        <label>Article</label>
        <input type="text" name="prod" id="prod" class="form-control">
        </div>
        <div class="col-md-4">
        <label>Qtite</label>
        <input type="number" name="qtite" id="qtite" class="form-control" autocomplete="off" required>
        </div>
        <div class="col-md-4">
        <label>PU</label>
        <input type="text" name="pu" id="pu" class="form-control" autocomplete="off" required>
        </div>
        <div class="col-md-6">
        <label>Montant M/ses</label>
        <input type="number" name="mont" id="mont" class="form-control" autocomplete="off" required>
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
        <label>Net Commercial</label>
        <input type="number" name="netccial" id="netccial" class="form-control" autocomplete="off">
        </div>

        <div class="col-md-6">
            <div class="row">
        
                <div class="col-md-4">   
                <label>Taux Escpte(en %)</label>
                <input type="number" name="t_escpte" id="t_escpte" class="form-control" value="0">
                </div>
                <div class="col-md-8">
                <label>Escompte</label>
                <input type="number" name="escpte" id="escpte" class="form-control" value="0">
                </div>
           </div>
        </div>

        <div class="col-md-6">
        <label>Net Financier</label>
        <input type="number" name="netfcier" id="netfcier" class="form-control" autocomplete="off">
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
        <input type="number" name="mttc" id="mttc" class="form-control" required>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6">   
                <label>Port et autres frais facturés</label>
                <input type="number" name="fr_vte" id="fr_vte" class="form-control" value="0">
                </div>
                <div class="col-md-6">
                <label>Net à payer</label>
                <input type="number" name="netpay" id="netpay" class="form-control" value="0">
                </div>
           </div>
        </div>
        <div class="col-md-6">
            <input type="hidden" name="cptevte" id="cptevte" class="form-control">
        </div>
        <div class="col-md-6">
            <input type="hidden" name="cptec" id="cptec" class="form-control">
        </div>
        
       <div class="col-md-3 mt-3">
        <input type="submit" value="Valider" class="btn btn-success form-control">
        </div>
    </div>
    </form>
  </div>
</div>
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
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            
            </tbody>
        </table>
    </div>

        <div class="row">
 
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>HISTORIQUE DES VENTES</h2>
                    </div>
                    <div class="card-body">
                        <br/>
                     
                     <form action = "{{ url('getventes') }}" method = "POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Du</label>
                                    <input type="date" name="from_date" id="from_date" class="form-group">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Au</label>
                                    <input type="date" name="to_date" id="to_date" class="form-group">
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
                                        <th>Article</th>
                                        <th>Qtite</th>
                                        <th>PU</th>
                                        <th>Montant TTC</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($ventes as $item)
                                    <tr>
                                        <td>{{ $item->prod }}</td>
                                        <td>{{ $item->qtite }}</td>
                                        <td>{{ $item->pu }}</td>
                                        <td>{{ $item->mttc }}</td>
                                    <td>
                                 <a href="{{ url('/ventes/' . $item->id . '/edit') }}" title="Edit Cotisation sociales"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                        <form method="POST" action="{{ url('/ventes' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i>  Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                        <th>TOTAL VENTES</th>
                                        <th>{{ $vte[0]->Tvmttc }}</th>
                                        <th>TOTAL ACHATS</th>
                                        <th>{{ $ach[0]->Tmttc }}</th>
                                        <th>MARGE</th>
                                        <th>{{ $marg }}</th>
                                </tr>
                                
                                </tbody>
                            </table>
                        </div>

                        <form action = "{{ url('downloadvte') }}" method = "POST">
                        {{ csrf_field() }}
                        <div class="row">
                        <div class="col-md-4">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Imprimer</button>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    
                                    <input type="hidden" name="from_date1" id="from_date1" class="form-group" value="{{ $from_date }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    
                                    <input type="hidden" name="to_date1" id="to_date1" class="form-group" value="{{ $to_date }}">
                                </div>
                            </div>

                            
                        </div>
                        <br/>
                        
                    </form>


                    </div>
                    
                </div>
            </div>
        <div class="row">
 
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>RECHERCHE DE FACTURE - VENTES</h2>
                    </div>
                    <div class="card-body">
                        <br/>
                        <div class="row">
                            <form action="{{ url('downloadfactvte') }}" method="POST">
                            {!! csrf_field() !!}
                            <div class="col-md-4">   
                            <label>N° Facture</label>
                            <input type="text" name="numfact1" id="numfact1" class="form-control" autocomplete="off" placeholder="Entrez ici le numéro de la facture">
                            <div id="facture_list1"> </div>
                            </div>
                            <div class="col-md-2">
                            <br/>
                            <input type="submit" value="IMPRIMER" class="btn btn-success form-control">
                            </div>
                            </form>
                        </div>
                    </div>
    
                </div>
            </div>
    
        </div>
        </div>
    
    </div>

    <script src="jquery-3.6.3.js"></script>
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
            $("#refprod").on('keyup', function() {
                var value = $(this).val();
                $.ajax({
                    url: "{{ route('searchvte2') }}",
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
                    url: "{{ route('searchfactvte') }}",
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
                    url: "{{ route('searchfactvte1') }}",
                    type: "GET",
                    data: {'numfact1' : value},
                    success: function(data){
                        $("#facture_list1").html(data);
                    }
                });
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
        
        $(document).on('click', '#produit_list li', function() {
            var value = $(this).text();
            var ii = value.indexOf('-');
            var ii1 = value.indexOf('-',ii+1);
            var ii2 = value.indexOf('-',ii1+1);
            var refp = value.substring(0,ii-1);
            var produi = value.substring(ii+1, ii1-1);
            var puv = value.substring(ii1+1, ii2-1);
            var cptev = value.substring(ii2+1);
            $("#refprod").val(refp);
            $("#prod").val(produi);
            $("#pu").val(puv);
            $("#cptevte").val(cptev);
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
            $("#mont").val(ne*nS);
            
        });

        $("#remise").click(function() {
            //calcul de la remise
            na = parseInt($("#mont").val());
            no = parseInt($("#t_remise").val());
            $("#remise").val(na*(no/100));
        });

        $("#netccial").click(function() {
            //calcul du net ccial
            na = parseInt($("#mont").val());
            no = parseInt($("#remise").val());
            $("#netccial").val(na - no);
        });

        $("#escpte").click(function() {
            //calcul de l'escpte
            na = parseInt($("#netccial").val());
            no = parseInt($("#t_escpte").val());
            $("#escpte").val(parseInt(na*(no/100)));
        });

        $("#netfcier").click(function() {
            //calcul du netfcier
            na = parseInt($("#netccial").val());
            no = parseInt($("#escpte").val());
            $("#netfcier").val(na - no);
        });

        $("#mtva").click(function() {
            //calcul de la tva
            na = parseInt($("#netfcier").val());
            no = parseInt($("#ttva").val());
            $("#mtva").val(parseInt(na*(no/100)));
            //calcul du montant ttc
            ni = parseInt($("#mtva").val());
            $("#mttc").val(na+ni);
        });

        $("#netpay").click(function() {
            //calcul de la tva
            na = parseInt($("#mttc").val());
            no = parseInt($("#fr_vte").val());
            $("#netpay").val(na+no);
            
        });
  </script>
@stop