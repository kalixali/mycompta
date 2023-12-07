@extends('layout')
@section('content')
 
 <div class="container">
    <div class="card">
  <div class="card-header">SAISIE PLAN COMPTABLE</div>
  <div class="card-body">
    <div class="row align-items-center">  
      <form action="{{ url('plancpte') }}" method="post">
        {!! csrf_field() !!}
        <div class="col-md-3">
        <label>COMPTE</label>
        <input type="number" name="compte" id="idcompte" class="form-control" autocomplete="off">
        </div>
        
        <div class="col-md-7">
        <label>Libellé</label>
        <input type="text" name="Libelle" id="idLibelle" class="form-control" autocomplete="off">
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
                        <h2>PLAN COMPTABLE</h2>
                    </div>
                    <div class="card-body">
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>COMPTE</th>
                                        <th>Libellé</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($plancpte as $item)
                                    <tr>
                                        <td>{{ $item->compte }}</td>
                                        <td>{{ $item->Libelle }}</td>
                                         
                                        <td>
                                            <a href="{{ url('/plancpte/' . $item->id . '/edit') }}" title="Edit Plan comptable"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
 
                                            <form method="POST" action="{{ url('/plancpte' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
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
    
@stop