@extends('layout')
@section('content')
 
 <div class="container">
        <div class="row">
 
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h2>COMPTE DE RESULTAT</h2>
                    </div>
                    <div class="card-body">
                        <br/>
                        
                    <form action = "{{ url('getcpteresultat') }}" method = "POST">
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
                        
                    </form>
                    <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Charges</th>
                                        <th>Produits</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{$charges[0]->charge}}</td>
                                        <td>{{$produits[0]->produit}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{$charges81[0]->charge}}</td>
                                        <td>{{$produits80[0]->produit}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{$charges83[0]->charge}}</td>
                                        <td>{{$produits82[0]->produit}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{$charges85[0]->charge}}</td>
                                        <td>{{$produits84[0]->produit}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{$charges87[0]->charge}}</td>
                                        <td>{{$produits86[0]->produit}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{$charges89[0]->charge}}</td>
                                        <td>{{$produits88[0]->produit}}</td>
                                    </tr>
                                    <tr>
                                        <td>RESULTAT</td>
                                        <td>{{$resultat}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
 
                    </div>
                </div>
            </div>
        </div>
    </div>
     
@stop