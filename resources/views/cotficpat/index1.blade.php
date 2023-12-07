@extends('layout')
@section('content')
 
 <div class="container">
    <div class="card">
  <div class="card-header">SAISIE COTISATIONS FISCALES - EMPLOYEUR</div>
  <div class="card-body">

    <div class="row">
        <form action="{{ url('search3') }}" method="post">
        {!! csrf_field() !!}
        <div class="col-12 gy-2 px-3 py-3 mx-1 my-3 border border-3">
        <div class="col-md-4">   
        <label>Matricule</label>
        <input type="search" name="matricule" id="matricule" class="form-control" placeholder="Entrez ici le matricule de l'Employé">
        <input type="hidden" name="t_is_p_a" id="t_is_p_a" class="form-control" value="1.2">
        <input type="hidden" name="t_ta_fdfp_a" id="t_ta_fdfp_a" class="form-control" value="0.4">
        <input type="hidden" name="t_fpc_fdfp_a" id="t_fpc_fdfp_a" class="form-control" value="0.6">
        </div>
        <div class="col-md-2">
        <br/>
        <input type="submit" value="OK" class="btn btn-success form-control">
        </div>
        </div>
        </form>
        
    </div>
 

    <div class="row align-items-center mt-3">  
      <form action="{{ url('cotficpat') }}" method="post">
        {!! csrf_field() !!}
        <div class="col-12 gy-2 px-3 py-3 mx-1 my-3 border border-3">
        <div class="col-md-4">
        <label>Matricule</label>
        <input type="text" name="matricule1" id="matricule1" class="form-control" value="{{$salbimp->matricule}}">
        </div>
        <div class="col-md-4">
        <label>Nom</label>
        <input type="text" name="nom" id="nom" class="form-control" value="{{$salbimp1->nom}}">
        </div>
        <div class="col-md-6">
        <label>Prénoms</label>
        <input type="text" name="prenoms" id="prenoms" class="form-control" value="{{$salbimp1->prenoms}}">
        </div>
        <div class="col-md-4">
        <label>Nationalité</label>
        <input type="text" name="nation" id="nation" class="form-control" value="{{$salbimp1->nation}}">
        </div>
        <div class="col-md-4">
        <label>Salaire brut imposable</label>
        <input type="number" name="salbimp" id="salbimp" class="form-control" value="{{$salbimp->salbimp}}">
        </div>
        
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-4">   
                <label>Taux (en %)</label>
                <input type="text" name="t_is_p" id="t_is_p" class="form-control" value="{{$salbimp->t_is_p}}">
                </div>
                <div class="col-md-8">
                <label>Impôt sur salaire</label>
                <input type="number" name="is_p" id="is_p" class="form-control" value="{{$salbimp->is_p}}">
                </div>
                
            </div>
        
        </div>

        <div class="col-md-4">

            <div class="row">
        
                <div class="col-md-4">   
                <label>Taux (en %)</label>
                <input type="text" name="t_ta_fdfp" id="t_ta_fdfp" class="form-control" value="{{$salbimp->t_ta_fdfp}}">
                </div>
                <div class="col-md-8">
                <label>Taxe d'apprentissage</label>
                <input type="number" name="ta_fdfp" id="ta_fdfp" class="form-control" value="{{$salbimp->ta_fdfp}}">
                </div>
                
            </div>

        </div>

        <div class="col-md-4">

            <div class="row">
        
                <div class="col-md-4">   
                <label>Taux (en %)</label>
                <input type="text" name="t_fpc_fdfp" id="t_fpc_fdfp" class="form-control" value="{{$salbimp->t_fpc_fdfp}}">
                </div>
                <div class="col-md-8">
                <label>Contribution FPC</label>
                <input type="number" name="fpc_fdfp" id="fpc_fdfp" class="form-control" value="{{$salbimp->fpc_fdfp}}">
                </div>
                
            </div>

        </div>

        <div class="col-md-4">
        <input type="hidden" name="cptabiliser_fisc" id="cptabiliser_fisc" class="form-control" value="False">
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
                        <h2>COTISATIONS FISCALES - EMPLOYEUR</h2>
                    </div>
                    <div class="card-body">
                        <br/>
                    
                    <form action = "{{ url('getcotficpat') }}" method = "POST">
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
                                        <th>Matricule</th>
                                        <th>Salaire brut imposable</th>
                                        <th>Taux I. S.</th>
                                        <th>Impôt sur salaire</th>
                                        <th>Taux T. A.</th>
                                        <th>Taxe d'apprentissage</th>
                                        <th>Taux C. FPC</th>
                                        <th>Contribution FPC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($cotficpat as $item)
                                    <tr>
                                        <td>{{ $item->matricule }}</td>
                                        <td>{{ $item->salbimp }}</td>
                                        <td>{{ $item->t_is_p }}</td>
                                        <td>{{ $item->is_p }}</td>
                                        <td>{{ $item->t_ta_fdfp }}</td>
                                        <td>{{ $item->ta_fdfp }}</td>
                                        <td>{{ $item->t_fpc_fdfp }}</td>
                                        <td>{{ $item->fpc_fdfp }}</td>
                                        <td>
                                            
                                        <!--    <a href="{{ url('/cotficpat/' . $item->id . '/edit') }}" title="Edit Cotisation fiscales"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> -->
 
                                            <form method="POST" action="{{ url('/cotficpat' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
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