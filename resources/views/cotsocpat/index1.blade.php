@extends('layout')
@section('content')
 
 <div class="container">
    <div class="card">
  <div class="card-header">SAISIE COTISATIONS SOCIALES - EMPLOYEUR</div>
  <div class="card-body">

    <div class="row">
        <form action="{{ url('search4') }}" method="post">
        {!! csrf_field() !!}
        <div class="col-12 gy-2 px-3 py-3 mx-1 my-3 border border-3">
        <div class="col-md-4">   
        <label>Matricule</label>
        <input type="search" name="matricule" id="matricule" class="form-control" placeholder="Entrez ici le matricule de l'Employé">
        <input type="hidden" name="t_prest_fam_a" id="t_prest_fam_a" class="form-control" value="5.75">
        <input type="hidden" name="t_acc_trv_a" id="t_acc_trv_a" class="form-control" value="2">
        <input type="hidden" name="t_cr_p_a" id="t_cr_p_a" class="form-control" value="7.7">
        </div>
        <div class="col-md-2">
        <br/>
        <input type="submit" value="OK" class="btn btn-success form-control">
        </div>
        </div>
        </form>
    </div>

    <div class="row align-items-center mt-3">  
      <form action="{{ url('cotsocpat') }}" method="post">
        {!! csrf_field() !!}
        <div class="col-12 gy-2 px-3 py-3 mx-1 my-3 border border-3">
        <div class="col-md-4">
        <label>Matricule</label>
        <input type="text" name="matricule" id="idmatricule" class="form-control" value="{{$salbimp->matricule}}">
        </div>
        <div class="col-md-4">
        <label>Nom</label>
        <input type="text" name="nom" id="nom" class="form-control" value="{{$salbimp->nom}}">
        </div>
        <div class="col-md-6">
        <label>Prénoms</label>
        <input type="text" name="prenoms" id="prenoms" class="form-control" value="{{$salbimp->prenoms}}">
        </div>
        
        <div class="col-md-4">
        <label>Salaire brut sociale</label>
        <input type="number" name="salbimp" id="salbimp" class="form-control" value="{{$salbimp->salbimp}}">
        </div>
        <div class="col-md-4">
            <div class="row">
        
                <div class="col-md-4">   
                <label>Taux (en %)</label>
                <input type="text" name="t_prest_fam" id="t_prest_fam" class="form-control" value="{{$salbimp->t_prest_fam}}">
                </div>
                <div class="col-md-8">
                <label>Prestation familiale</label>
                <input type="number" name="prest_fam" id="prest_fam" class="form-control" value="{{$salbimp->prest_fam}}">
                </div>
                
            </div>
        
        </div>

        <div class="col-md-4">

            <div class="row">
        
                <div class="col-md-4">   
                <label>Taux (en %)</label>
                <input type="text" name="t_acc_trv" id="t_acc_trv" class="form-control" value="{{$salbimp->t_acc_trv}}">
                </div>
                <div class="col-md-8">
                <label>Accident de travail</label>
                <input type="number" name="acc_trv" id="acc_trv" class="form-control" value="{{$salbimp->acc_trv}}">
                </div>
                
            </div>

        </div>

        <div class="col-md-4">

            <div class="row">
        
                <div class="col-md-4">   
                <label>Taux (en %)</label>
                <input type="text" name="t_cr_p" id="t_cr_p" class="form-control" value="{{$salbimp->t_cr_p}}">
                </div>
                <div class="col-md-8">
                <label>Cotisation retraite</label>
                <input type="number" name="cr_p" id="cr_p" class="form-control" value="{{$salbimp->cr_p}}">
                </div>
                
            </div>

        </div>

        <div class="col-md-4">
        <input type="hidden" name="cptabiliser_soc" id="cptabiliser_soc" class="form-control" value="False">
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
                        <h2>COTISATIONS SOCIALES - EMPLOYEUR</h2>
                    </div>
                    <div class="card-body">
                        <br/>
                     
                     <form action = "{{ url('getcotsocpat') }}" method = "POST">
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
                                        <th>Salaire brut sociale</th>
                                        <th>Taux P. f.</th>
                                        <th>Prestation familiale</th>
                                        <th>Taux A. t.</th>
                                        <th>Accident de travail</th>
                                        <th>Taux C. r.</th>
                                        <th>Cotisation retraite</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($cotsocpat as $item)
                                    <tr>
                                        <td>{{ $item->matricule }}</td>
                                        <td>{{ $item->salbimp }}</td>
                                        <td>{{ $item->t_prest_fam }}</td>
                                        <td>{{ $item->prest_fam }}</td>
                                        <td>{{ $item->t_acc_trv }}</td>
                                        <td>{{ $item->acc_trv }}</td>
                                        <td>{{ $item->t_cr_p }}</td>
                                        <td>{{ $item->cr_p }}</td>
                                        
                                        <td>
                                            
                                        <!--    <a href="{{ url('/cotsocpat/' . $item->id . '/edit') }}" title="Edit Cotisation sociales"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> -->
 
                                            <form method="POST" action="{{ url('/cotsocpat' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
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