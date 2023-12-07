@extends('layout')
@section('content')
 
 <div class="container">
    
        <div class="row">
 
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h2>STOCK ACTUEL</h2>
                    </div>
                    <div class="card-body">
                        <br/>
                        <br/>
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
                                @foreach($stockactu as $item)
                                    <tr>
                                        <td>{{ $item->prod }}</td>
                                        <td>{{ $item->qtite }}</td>
                                        <td>{{ $item->pu }}</td>
                                        <td>{{ $item->mont }}</td>
                                         
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
@stop