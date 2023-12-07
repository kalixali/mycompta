@extends('layout')
@section('content')
 
 <div class="container">
    <div class="card">
  <div class="card-header">JOURNAL DE SAISIE</div>
  <div class="card-body">
    <div class="row align-items-center">  
      <form action="{{ url('journal') }}" method="post">
        {!! csrf_field() !!}
        <div class="col-md-3">
        <label>Compte</label>
        <input type="number" name="compte" id="compte" class="form-control" autocomplete="off">
            <div id="compte_list"> </div>
        </div>
        <div class="col-md-6">
        <label>Libellé</label>
        <input type="text" name="libellé" id="libellé" class="form-control">
        </div>
        <div class="col-md-3">
        <label>Code journal</label>
        <input type="text" name="codejournal" id="codejournal" class="form-control" autocomplete="off">
            <div id="codejournal_list"> </div>
        </div>
        <div class="col-md-3">
        <label>Num. pièce</label>
        <input type="text" name="numpiece" id="numpiece" class="form-control">
        </div>
        <div class="col-md-3">
        <label>Montant debit</label>
        <input type="number" name="Mdebit" id="idMdebit" class="form-control" value="0">
        </div>

        <div class="col-md-3">
        <label>Montant credit</label>
        <input type="number" name="Mcredit" id="idMcredit" class="form-control" value="0">
        </div>
        
        <div class="col-md-3 mt-3">
        <input type="submit" value="Valider" id="idvalider" class="btn btn-success form-control">
        </div>
    </form>
  </div>
</div>
 </div>

        <div class="row">
 
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>JOURNAL</h2>
                    </div>
                    <div class="card-body">
                        <br/>
                        
                    <form action = "{{ url('getjournal') }}" method = "POST">
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
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Du</label>
                                    <input type="number" name="from_compte" class="form-group" placeholder="Compte">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Au</label>
                                    <input type="number" name="to_compte" class="form-group" placeholder="Compte">
                                </div>
                            </div>
                        
                            <div class="col-md-4">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Filtre</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Code J.</th>
                                        <th>Num. pièce</th>
                                        <th>Compte</th>
                                        <th>Libellé</th>
                                        <th>MDebit</th>
                                        <th>MCredit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($journal as $item)
                                    <tr>
                                        <td>{{ date('d/m/Y', strtotime($item->Date)) }}</td>
                                        <td>{{ $item->codejournal }}</td>
                                        <td>{{ $item->numpiece }}</td>
                                        <td>{{ $item->compte }}</td>
                                        <td>{{ $item->libellé }}</td>
                                        <td>{{ $item->Mdebit }}</td>
                                        <td>{{ $item->Mcredit }}</td>
 
                                        <td>
                                            
                                            <a href="{{ url('/journal/' . $item->id . '/edit') }}" title="Edit JOURNAL"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
 
                                            <form method="POST" action="{{ url('/journal' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
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
                    
                        <br/>

        <form action = "{{ url('downloadjournal') }}" method = "POST">
        {{ csrf_field() }}
        <div class="row">
        <div class="col-md-4">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Imprimer</button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="hidden" name="from_date1" class="form-group" value="{{ $from_date }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                       <input type="hidden" name="to_date1" class="form-group" value="{{ $to_date }}">
                    </div>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="hidden" name="from_compte1" class="form-group" placeholder="Compte" value="{{ $from_compte }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="hidden" name="to_compte1" class="form-group" placeholder="Compte" value="{{ $to_compte }}">
                    </div>
                </div>
            </div>

                
        </div>
        <br/>

        </form>
        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="jquery-3.6.3.js"></script>
    <script>
        $(document).ready(function() {
            $("#compte").on('keyup', function() {
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

            $("#codejournal").on('keyup', function() {
                var value = $(this).val();
                $.ajax({
                    url: "{{ route('searchcodejournal') }}",
                    type: "GET",
                    data: {'codejournal' : value},
                    success: function(data){
                        $("#codejournal_list").html(data);
                    }
                });
            });
        }); 
        $(document).on('click', '#compte_list li', function() {
            var value = $(this).text();
            var ii = value.indexOf('-');
            var val1 = value.substring(0,ii-1);
            var val2 = value.substring(ii+1);
            $("#compte").val(val1);
            $("#libellé").val(val2);
            $("#compte_list").html(" "); 
        }); 
        
        $(document).on('click', '#codejournal_list li', function() {
            var value = $(this).text();
            var ii = value.indexOf('-');
            var val1 = value.substring(0,ii-1);
            $("#codejournal").val(val1);
            $("#codejournal_list").html(" ");
        });   
    </script>
     <script>
        
        $("#idlibellé").click(function() {
            nt = $("#idcompte").val();
            nr = nt.toString();
            nl = nr.length;
            if (nl < 3) {
            alert("Ce numéro de compte n'est pas valide");
            $("#idcompte").val("");
            $("#idcompte").focus();
           } 
            
        });

        $("#idvalider").focus(function() {
            nt = $("#idcompte").val();
            nr = nt.toString();
            nl = nr.length;
            le = $("#idlibellé").val();
            lo = le.toString();
            li = lo.length;

            ns = parseInt($("#idMdebit").val());
            ne = parseInt($("#idMcredit").val());
                   
            if (nl < 3) {
                alert("Ce numéro de compte n'est pas valide");
                $("#idcompte").val("");
                $("#idcompte").focus();
            } 
            else if (li == 0) {
                alert('Renseignez le libellé');
                $("#idlibellé").focus();
                
            }
                   
            else if (ne == 0 && ns == 0) {
                alert('Les montants au debit et au credit sont nulls');
                $("#idMdebit").focus();
                
            }
            else if (ne != 0 && ns != 0) {
                alert('Une opération ne peut être debité et credité');
                $("#idMdebit").val(0);
                $("#idMcredit").val(0);
                $("#idMdebit").focus();
                
            }

        });

    </script>
@stop