@extends('layout')
@section('content')
 
 <div class="container">
            <div class="row">
 
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h2>BULLETIN</h2>
                    </div>
                    <div class="card-body">
                        <br/>
                        
                    <form action = "{{ url('downloadPDF2') }}" method = "POST" >
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
                                    <input type="text" name="from_matricule" id="from_matricule" class="form-group" placeholder="Matricule" autocomplete="off">
                                    <div id="mat_listfrom"> </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Au</label>
                                    <input type="text" name="to_matricule" id="to_matricule" class="form-group" placeholder="Matricule" autocomplete="off">
                                    <div id="mat_listo"> </div>
                                </div>
                            </div>
                        
                            <div class="col-md-4">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Imprimer</button>
                                </div>
                            </div>
                        </div>
                    </form>
                     
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="jquery-3.6.3.js"></script>
    <script>
        $(document).ready(function() {
            $("#from_matricule").on('keyup', function() {
                var value = $(this).val();
                $.ajax({
                    url: "{{ route('searchfromat') }}",
                    type: "GET",
                    data: {'mat1' : value},
                    success: function(data){
                        $("#mat_listfrom").html(data);
                    }
                });
            });
        }); 
        //#aa - represente l'id du li dans la fonction searchfromat
        $(document).on('click', '#aa', function() {
            var value = $(this).text();
            var ii = value.indexOf('-');
            var val1 = value.substring(0,ii-1);
            //var val2 = value.substring(ii+1);
            $("#from_matricule").val(val1);
            //$("#libellé").val(val2);
            $("#mat_listfrom").html(" "); 
        }); 
        
    </script>

<script>
                
        $(document).ready(function() {
            $("#to_matricule").on('keyup', function() {
                var value = $(this).val();
                $.ajax({
                    url: "{{ route('searchtomat') }}",
                    type: "GET",
                    data: {'mat2' : value},
                    success: function(data){
                        $("#mat_listo").html(data);
                    }
                });
            });
        }); 
         //#bb - represente l'id du li dans la fonction searchtomat
        $(document).on('click', '#bb', function() {
            var value1 = $(this).text();
            var ii = value1.indexOf('-');
            var val1a = value1.substring(0,ii-1);
            //var val2a = value1.substring(ii+1);
            $("#to_matricule").val(val1a);
            //$("#libellé").val(val2);
            $("#mat_listo").html(" "); 
        });   
    </script>
@stop