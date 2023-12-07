@extends('layout')
@section('content')
 
 <div class="container">
            <div class="row">
 
            <div class="col-md-9">
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
                                    <label>Compte</label>
                                    <input type="text" name="from_compte" class="form-group" placeholder="Compte">
                                </div>
                            </div>
                            
                        </div>
                        <br/>
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
                        </div>
                        <br/>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Valider</button>
                                </div>
                            </div>
                        </div>
                    </form>
                     
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
                               
                                @foreach($journal as $item)
                                    <tr>
                                        <td>{{ $item->compte }}</td>
                                        <td>{{ $item->libellé }}</td>
                                        <td>{{ $item->Mdebit }}</td>
                                        <td>{{ $item->Mcredit }}</td>
                                        <td>{{ $item->Mdebit - $item->Mcredit }}</td>
                                    </tr>
                                 @endforeach
                                @foreach($jtotal as $ite)
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th>{{ $ite->Tdebit }}</th>
                                        <th>{{ $ite->Tcredit }}</th>
                                        <th>{{ $ite->solde }}</th>
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