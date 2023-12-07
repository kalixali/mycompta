@extends('layout')
@section('content')
 
 <div class="container">
            
            <div class="card">
                    <div class="card-header">
                        <h2>GRAND LIVRE</h2>
                    </div>
                    <div class="card-body">
                        <br/>
                        
                    <form action = "{{ url('getlivre') }}" method = "POST">
                        {{ csrf_field() }}

                    <div class="row">
                        <div class="col-md-4">
                        <div class="form-group">
                            <label>Du</label>
                            <input type="number" name="from_compte" id="from_compte" class="form-group" placeholder="Compte">
                            <div id="compte_list"> </div>
                        </div>
                        </div>
                        <div class="col-md-4">
                        <div class="form-group">
                            <label>Au</label>
                            <input type="number" name="to_compte" id="to_compte" class="form-group" placeholder="Compte">
                            <div id="compte_list1"> </div>
                        </div>
                        </div>
                            
                    </div>
                    <br/>
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
                        
                            <div class="col-md-3">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Valider</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <br/>
                     <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Compte</th>
                                        <th>Libellé</th>
                                        <th>MDebit</th>
                                        <th>MCredit</th>
                                        <th>Solde</th>
                                    </tr>
                                </thead>
                                <tbody>
                            
                                @for($i=0;$i<$ncpt;$i++)
                                    @foreach($journal[$i] as $items[$i])
                                        <tr >
                                            <td>{{ $items[$i]->compte }}</td>
                                            <td>{{ $items[$i]->libellé }}</td>
                                            <td>{{ $items[$i]->Mdebit }}</td>
                                            <td>{{ $items[$i]->Mcredit }}</td>
                                            <td>{{ $items[$i]->Solde}}</td>
                                        </tr>
                                    @endforeach
                                    @foreach($jtotal[$i] as $ite[$i])
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th>{{ $ite[$i]->Tdebit }}</th>
                                            <th>{{ $ite[$i]->Tcredit }}</th>
                                            <th>{{ $ite[$i]->solde }}</th>
                                        </tr>
                                    @endforeach
                                @endfor
                                @foreach($totjournal as $iten)
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th>{{ $iten->Sdebit }}</th>
                                        <th>{{ $iten->Scredit }}</th>
                                        <th>{{ $iten->Tsolde }}</th>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <br/>

        <form action = "{{ url('downloadgrdlivre') }}" method = "POST">
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

    <script src="jquery-3.6.3.js"></script>
    <script>
        $(document).ready(function() {
            $("#from_compte").on('keyup', function() {
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

            $("#to_compte").on('keyup', function() {
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
        });
        $(document).on('click', '#compte_list li', function() {
            var value = $(this).text();
            var ii = value.indexOf('-');
            var val1 = value.substring(0,ii-1);
            $("#from_compte").val(val1);
            $("#compte_list").html(" "); 
        }); 
        $(document).on('click', '#compte_list1 li', function() {
            var value = $(this).text();
            var ii = value.indexOf('-');
            var val1 = value.substring(0,ii-1);
            $("#to_compte").val(val1);
            $("#compte_list1").html(" "); 
        }); 
    </script>
@stop