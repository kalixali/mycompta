@extends('layout')
@section('content')

 <div class="container">
    <div class="card">
  <div class="card-header">SALAIRE BRUT IMPOSABLE - EMPLOYE</div>
  <div class="card-body">

    <div class="row">
        <form action="{{ url('search') }}" method="post">
        {!! csrf_field() !!}
        <div class="col-md-4">   
        <label>Matricule</label>
        <input type="search" name="matricule" id="matricule" class="form-control" placeholder="Entrez ici le matricule de l'Employé" >
        </div>
        <div class="col-md-2">
        <br/>
        <input type="submit" value="OK" class="btn btn-success form-control">
        </div>
        </form>
    </div>

    <div class="row">
        <form action="{{ url('downloadPDF') }}" method="post">
        {!! csrf_field() !!}
        <div class="col-md-4">   
        <label>Matricule</label>
        <input type="search" name="matricule" id="matricule" class="form-control" placeholder="Entrez ici le matricule de l'Employé" >
        </div>
        <div class="col-md-2">
        <br/>
        <input type="submit" value="Imprimer" class="btn btn-success form-control">
        </div>
        </form>
    </div>

    <div class="row align-items-center">  
      <form action="{{ url('salbrutimp') }}" method="post">
        {!! csrf_field() !!}
        
        <div class="col-md-4">   
        <label>Matricule</label>
        <input type="text" name="matricule" id="matricule" class="form-control" value="{{$empl->matricule}}">
        </div>

        <div class="col-md-4">
        <label>Salaire de base</label>
        <input type="number" name="salbase" id="salbase" class="form-control" value="{{$empl->salbase}}">
        </div>
        <div class="col-md-4">
        <label>Sursalaire</label>
        <input type="number" name="sursal" id="idsursal" class="form-control" value="{{$empl->sursal}}">
        </div>
        <div class="col-md-4">
        <label>Total primes</label>
        <input type="number" name="totprimes" id="idtotprimes" class="form-control" value="{{$salbrutimp->totprimes}}">
        </div>
        <div class="col-md-4">
        <label>Avantages en nat.</label>
        <input type="number" name="totavtagenat" id="idtotavtagenat" class="form-control" value="{{$salbrutimp->totavtagenat}}">
        </div>
        <div class="col-md-4">
        <label>Tot H.S.</label>
        <input type="number" name="totmhs" id="idtotmhs" class="form-control" value="{{$salbrutimp->totmhs}}">
        </div>
        <div class="col-md-4">
        <label>Salaire b. imp.</label>
        <input type="number" name="salbimp" id="idsalbimp" class="form-control" value="{{$salbrutimp->salbimp}}">
        </div>
        <div class="col-md-4">
        <label>CR</label>
        <input type="number" name="totcotsocemp" id="idtotcotsocemp" class="form-control" value="{{$salbrutimp->totcotsocemp}}">
        </div>
        <div class="col-md-4">
        <label>TOT. Fiscales</label>
        <input type="number" name="totcotficemp" id="idtotcotficemp" class="form-control" value="{{$salbrutimp->totcotficemp}}">
        </div>
        <div class="col-md-4">
        <label>Salaire net</label>
        <input type="number" name="salnet" id="idsalnet" class="form-control" value="{{$salbrutimp->salnet}}">
        </div>
        <div class="col-md-4">
        <label>Tot. retenues</label>
        <input type="number" name="totretenues" id="idtotretenues" class="form-control" value="{{$salbrutimp->totretenues}}">
        </div>
        <div class="col-md-4">
        <label>Salaire à payer</label>
        <input type="number" name="salpaye" id="idsalpaye" class="form-control" value="{{$salbrutimp->salpaye}}">
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
                        <h2>SALAIRE BRUT IMPOSABLE - EMPLOYE</h2>
                    </div>
                    <div class="card-body">
                        <br/>

                    <form action = "{{ url('getsalbrutimp') }}" method = "POST">
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
                                        <th>Salaire de base</th>
                                        <th>Sursalaire</th>
                                        <th>Total primes</th>
                                        <th>Avantages en nat.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($salbrutimp as $item)
                                    <tr>
                                        <td>{{ $item->matricule }}</td>
                                        <td>{{ $item->salbase }}</td>
                                        <td>{{ $item->sursal }}</td>
                                        <td>{{ $item->totprimes }}</td>
                                        <td>{{ $item->totavtagenat }}</td>
                                        <td>
                                            
                                            <a href="{{ url('/salbrutimp/' . $item->id . '/edit') }}" title="Edit Salaire brut imp."><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
 
                                            <form method="POST" action="{{ url('/salbrutimp' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
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
      <script src="ope.js"></script>
      <script src="maff.js"></script>
    </div>
    
    
@stop