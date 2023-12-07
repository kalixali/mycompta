@extends('layout')
@section('content')
 
 <div class="container">
 <div class="col-md-9">
<div class="card">
    <div class="card-header">
        <h2>BALANCE</h2>
    </div>
    <div class="card-body">
        <br/>

    <form action = "{{ url('getBalance') }}" method = "POST">
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
       
            <div class="col-md-4">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Filtre</button>
                </div>
            </div>
        </div>
    </form>
    <br/>
    <br/>
   
    <div class="row">
 
            
<br/>
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Compte</th>
                <th>Libellé</th>
                <th>TDebit</th>
                <th>TCredit</th>
                <th>Solde</th>
            </tr>
        </thead>
        <tbody>
        @foreach($balance as $item)
            <tr>
                <td>{{ $item->compte }}</td>
                <td>{{ $item->libellé }}</td>
                <td>{{ $item->Tdebit }}</td>
                <td>{{ $item->Tcredit }}</td>
                <td>{{ $item->solde }}</td>
                
            </tr>
        @endforeach

        @foreach($bal as $ite)
        <tr>
                <th></th>
                <th></th>
                <th>{{ $ite->Sdebit }}</th>
                <th>{{ $ite->Scredit }}</th>
                <th>{{ $ite->Tsolde }}</th>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>


                        <br/>

        <form action = "{{ url('downloadbalance') }}" method = "POST">
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