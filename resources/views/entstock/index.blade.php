@extends('layout')
@section('content')
 
 <div class="container">
    <div class="card">
  <div class="card-header">ENTREES STOCKS</div>
  <div class="card-body">
    <div class="row  mb-4">
        <form action="{{ url('searchentstock') }}" method="post">
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
      <form action="{{ url('entstock') }}" method="post">
        {!! csrf_field() !!}
        <div class="col-md-4">
        <input type="hidden" name="refprod" id="refprod" class="form-control">
        </div>
        <div class="col-md-4">
        <label>Article</label>
        <input type="text" name="prod" id="idprod" class="form-control">
        </div>
        <div class="col-md-4">
        <label>QTITE</label>
        <input type="text" name="qtite" id="idqtite" class="form-control" autocomplete="off">
        </div>
        <div class="col-md-4">
        <label>PU</label>
        <input type="text" name="pu" id="idpu" class="form-control" autocomplete="off">
        </div>
        <div class="col-md-4">
        <label>Montant</label>
        <input type="text" name="mont" id="idmont" class="form-control" autocomplete="off">
        </div>
        
        <div class="col-md-3 mt-3">
        <input type="submit" value="Valider" class="btn btn-success form-control">
        </div>
    </form>
  </div>
</div>
 </div>

        <div class="row">
 
        <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                <h2>STOCK ENTREES</h2>
            </div>
            <div class="card-body">
                <br/>
                <br/>
  <form action = "{{ url('getentstock') }}" method = "POST">
                      
    {{ csrf_field() }}
<div class="row">
<label>Du</label>
<div class="col-md-4">
<div class="form-group">
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
                                        <th>ARTICLE</th>
                                        <th>QTITE</th>
                                        <th>PU</th>
                                        <th>MONTANT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($entstock as $item)
                                    <tr>
                                        <td>{{ $item->prod }}</td>
                                        <td>{{ $item->qtite }}</td>
                                        <td>{{ $item->pu }}</td>
                                        <td>{{ $item->mont }}</td>
                                         
                                        <td>
                                            
                                         <a href="{{ url('/entstock/' . $item->id . '/edit') }}" title="Edit JOURNAL"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
 
                                            <form method="POST" action="{{ url('/entstock' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
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
                    url: "{{ route('searchent1') }}",
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
            var ii = value.indexOf('-');
            var val1 = value.substring(0,ii-1);
            $("#refprod").val(val1);
            $("#product_list").html(" "); 
        });   
    </script>
    
    <script>
       
        $("#idmont").click(function() {
            ne = parseInt($("#idqtite").val());
            ns = parseInt($("#idpu").val());
            $("#idmont").val(ne*ns);
        });
        
  </script>
@stop