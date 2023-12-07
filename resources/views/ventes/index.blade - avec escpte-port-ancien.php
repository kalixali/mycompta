@extends('layout')
@section('content')
 
 <div class="container">
    <div class="card">
  <div class="card-header">ACHATS</div>
  <div class="card-body">

     <div class="row align-items-center">  
      <form action="" method="post">
        {!! csrf_field() !!}
        <div class="col-md-4">
        <label>Article</label>
        <input type="text" name="prod" id="prod" class="form-control">
        </div>
        <div class="col-md-4">
        <label>Qtite</label>
        <input type="text" name="qtite" id="qtite" class="form-control">
        </div>
        <div class="col-md-4">
        <label>PU</label>
        <input type="text" name="pu" id="pu" class="form-control">
        </div>
        <div class="col-md-4">
        <label>Montant</label>
        <input type="text" name="mont" id="mont" class="form-control">
        </div>
        <div class="col-md-4">
            <div class="row">
        
                <div class="col-md-4">   
                <label>Taux (en %)</label>
                <input type="text" name="tr" id="tr" class="form-control" value="0">
                </div>
                <div class="col-md-8">
                <label>Remise</label>
                <input type="number" name="mtr" id="mtr" class="form-control" value="0">
                </div>
           </div>
        </div>
        <div class="col-md-4">
        <label>Net commercial</label>
        <input type="text" name="nccial" id="nccial" class="form-control">
        </div>
        <div class="col-md-4">
            <div class="row">
        
                <div class="col-md-4">   
                <label>Taux (en %)</label>
                <input type="text" name="tesc" id="tesc" class="form-control" value="0">
                </div>
                <div class="col-md-8">
                <label>Escompte</label>
                <input type="number" name="mtesc" id="mtesc" class="form-control" value="0">
                </div>
           </div>
        </div>
        <div class="col-md-4">
        <label>Net financier</label>
        <input type="text" name="nfcier" id="nfcier" class="form-control">
        </div>
        <div class="col-md-4">
            <div class="row">
        
                <div class="col-md-4">   
                <label>Taux (en %)</label>
                <input type="text" name="ttva" id="ttva" class="form-control" value="0">
                </div>
                <div class="col-md-8">
                <label>TVA</label>
                <input type="number" name="mtva" id="mtva" class="form-control" value="0">
                </div>
           </div>
        </div>
        <div class="col-md-4">
        <label>Montant TTC</label>
        <input type="text" name="mttc" id="mttc" class="form-control">
        </div>
        <div class="col-md-4">
        <label>Port payé</label>
        <input type="text" name="mport" id="mport" class="form-control">
        </div>
        <div class="col-md-4">
        <label>Net à payer</label>
        <input type="text" name="mpay" id="mpay" class="form-control">
        </div>
        
       <div class="col-md-2 mt-3">
        <input type="submit" value="Valider" class="btn btn-success form-control">
        </div>
    </form>
  </div>
</div>
 </div>

        <div class="row">
 
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>ACHATS</h2>
                    </div>
                    <div class="card-body">
                        <br/>
                     
                     <form action = "" method = "POST">
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
                        <br/>
                        
                    </form>       
                    <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Article</th>
                                        <th>Qtite</th>
                                        <th>PU</th>
                                        <th>Montant</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($ach as $item)
                                    <tr>
                                        <td>{{ $item->prod }}</td>
                                        <td>{{ $item->qtite }}</td>
                                        <td>{{ $item->pu }}</td>
                                        <td>{{ $item->montant }}</td>
                                    <td>
                                        <a href="{{ url('/ach/' . $item->id . '/edit') }}" title="Edit Cotisation sociales"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                        <form method="POST" action="{{ url('/ach' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
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
    <script src="mf.js"></script>
    </div>
@stop