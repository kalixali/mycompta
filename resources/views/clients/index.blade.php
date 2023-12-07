@extends('layout')
@section('content')
 
 <div class="container">
    <div class="card">
  <div class="card-header">CLIENTS</div>
  <div class="card-body">
  
     <div class="row align-items-center">  
      <form action="{{ url('clients') }}" method="post">
        {!! csrf_field() !!}
        <div class="row gy-2 px-3 py-3 mx-3 my-3 border border-3">
        <div class="col-md-6">
        <label>SIGLE</label>
        <input type="text" name="sigleclt" id="sigleclt" class="form-control" autocomplete="off" required>
        </div>
        <div class="col-md-6">
        <label>CLIENT</label>
        <input type="text" name="client" id="client" class="form-control" autocomplete="off">
        </div>
        <div class="col-md-6">
        <label>COMPTE CLIENT</label>
        <input type="number" name="cptec" id="cptec" class="form-control" required>
        <div id="compte_list"> </div>
        </div>
        <div class="col-md-6">
        <label>CONTACT1</label>
        <input type="text" name="contactc1" id="contactc1" class="form-control">
        </div>
        <div class="col-md-6">
        <label>CONTACT2</label>
        <input type="text" name="contactc2" id="contactc2" class="form-control" autocomplete="off">
        </div>
        <div class="col-md-6">
        <label>EMAIL</label>
        <input type="text" name="emailc" id="emailc" class="form-control" autocomplete="off">
        </div>
        <div class="col-md-6">
        <label>ADRESSE</label>
        <input type="text" name="adressec" id="adressec" class="form-control" autocomplete="off">
        </div>
        <div class="col-md-6">
        <label>SIT. GEO</label>
        <input type="text" name="sitgeoc" id="sitgeoc" class="form-control" autocomplete="off">
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
                        <h2>CLIENTS</h2>
                    </div>
                    <div class="card-body">
                        <br/>
                     
                         
                    <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>SIGLE</th>
                                        <th>CLIENT</th>
                                        <th>CONTACT1</th>
                                        <th>CONTACT2</th>
                                        <th>EMAIL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($clients as $item)
                                    <tr>
                                        <td>{{ $item->sigleclt }}</td>
                                        <td>{{ $item->client }}</td>
                                        <td>{{ $item->contactc1 }}</td>
                                        <td>{{ $item->contactc2 }}</td>
                                        <td>{{ $item->emailc }}</td>
                                    <td>
                                        <a href="{{ url('/clients/' . $item->id . '/edit') }}" title="Edit Clients"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                        <form method="POST" action="{{ url('/clients' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
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
          
        $("#cptec").on('keyup', function() {
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
       
        $(document).on('click', '#compte_list li', function() {
            var value = $(this).text();
            var ii = value.indexOf('-');
            var val1 = value.substring(0,ii-1);
            var val2 = value.substring(ii+1);
            $("#cptec").val(val1);
            $("#compte_list").html(" "); 
        });  
    }); 
</script>
@stop