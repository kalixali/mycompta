@extends('layout')
@section('content')
 
 <div class="container">
    <div class="card">
  <div class="card-header">FICHE PRODUIT</div>
  <div class="card-body">
    <div class="row align-items-center">  
      <form action="{{ url('produit') }}" method="post" id="formprod">
        {!! csrf_field() !!}
        <div class="row gy-2 px-3 py-3 mx-3 my-3 border border-3">
        <div class="col-md-6">
        <label>Réf. Article</label>
        <input type="text" name="refprod" id="refprod" class="form-control" autocomplete="off" required>
        </div>
        <div class="col-md-6">
        <label>Article</label>
        <input type="text" name="prod" id="prod" class="form-control" autocomplete="off">
        </div>
        <div class="col-md-6">
        <label>PU achat</label>
        <input type="text" name="puach" id="puach" class="form-control" autocomplete="off">
        </div>
        <div class="col-md-6">
        <label>PU vente</label>
        <input type="text" name="puvte" id="puvte" class="form-control" autocomplete="off">
        </div>
        <div class="col-md-6">
        <label>Compte Achat</label>
        <input type="text" name="cpteach" id="cpteach" class="form-control" autocomplete="off">
        <div id="compte_list"> </div>
        </div>
        <div class="col-md-6">
        <label>Compte Vente</label>
        <input type="text" name="cptevte" id="cptevte" class="form-control" autocomplete="off">
        <div id="compte_list1"> </div>
        </div>
        <!-- <div id="essai"> Bonjour
        </div> -->
        
        <div class="col-md-3 mt-3">
        <input type="submit" value="Valider" class="btn btn-success form-control">
        </div>
        </div>
                
    </form>
  </div>
</div>
 </div>

        <div class="row">
 
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h2>LISTE PRODUITS</h2>
                    </div>
                    <div class="card-body">
                        <br/>
                        
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>REF. ARTICLE</th>
                                        <th>ARTICLE</th>
                                        <th>PU ACHAT</th>
                                        <th>PU VENTE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($produit as $item)
                                    <tr>
                                    <td id="ref">{{ $item->refprod }}</td>
                                        <td>{{ $item->prod }}</td>
                                        <td>{{ $item->puach }}</td>
                                        <td>{{ $item->puvte }}</td>
                                    <td>
                                            
                                        <a href="{{ url('/produit/' . $item->id . '/edit') }}" title="Edit Produit"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                        <!-- <a href="" title="Edit JOURNAL"><button class="bout btn btn-primary btn-sm" value="{{ $item->id }}" id="bouton"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> -->
                                            <form method="POST" action="{{ url('/produit' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</button>
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

        <div class="row">
 
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>SCANNER DES PRODUITS</h2>
                    </div>
                    <div class="card-body">
                        <br/>
                        <a class="btn btn-success" href="{{ url('/scan') }}" role="button">IMPRIMER TOUS LES CODES BARRES</a>
                    </div>

                </div>
        </div>

</div>
    </div>
<script src="jquery-3.6.3.js"></script>
<script>
    $(document).ready(function() {
          
        $("#cpteach").on('keyup', function() {
            var value = $(this).val();
            $.ajax({
                url: "{{ route('searchcpte1') }}",
                type: "GET",
                data: {'compte' : value},
                success: function(data){
                    $("#compte_list").html(data);
                }
            });
        });
        $("#cptevte").on('keyup', function() {
            var value = $(this).val();
            $.ajax({
                url: "{{ route('searchcpte1') }}",
                type: "GET",
                data: {'compte' : value},
                success: function(data){
                    $("#compte_list1").html(data);
                }
            });
        });
        $(document).on('click', '#compte_list li', function() {
            var value = $(this).text();
            var ii = value.indexOf('-');
            var val1 = value.substring(0,ii-1);
            var val2 = value.substring(ii+1);
            $("#cpteach").val(val1);
            $("#compte_list").html(" "); 
        }); 
        $(document).on('click', '#compte_list1 li', function() {
            var value = $(this).text();
            var ii = value.indexOf('-');
            var val1 = value.substring(0,ii-1);
            var val2 = value.substring(ii+1);
            $("#cptevte").val(val1);
            $("#compte_list1").html(" "); 
        }); 
    });
</script>
@stop