@extends('layout')
@section('content')
 
 <div class="container">
    <div class="card">
  <div class="card-header">FICHE PRODUIT</div>
  <div class="card-body">
    <div class="row align-items-center">  
      <form action="{{ url('produit') }}" method="post">
        {!! csrf_field() !!}
        <div class="col-md-4">
        <label>Réf. Article</label>
        <input type="text" name="refprod" id="refprod" class="form-control">
        </div>
        <div class="col-md-4">
        <label>Article</label>
        <input type="text" name="prod" id="prod" class="form-control">
        </div>
        <div class="col-md-4">
        <label>PU achat</label>
        <input type="text" name="puach" id="puach" class="form-control">
        </div>
        <div class="col-md-4">
        <label>PU vente</label>
        <input type="text" name="puvte" id="puvte" class="form-control">
        </div>
        <div class="col-md-4">
        <label>Compte Achat</label>
        <input type="text" name="cpteach" id="cpteach" class="form-control" autocomplete="off">
        </div>
        <div class="col-md-4">
        <label>Compte Vente</label>
        <input type="text" name="cptevte" id="cptevte" class="form-control" autocomplete="off">
        </div>
        <div class="col-md-4">
        <label>Compte Fournisseur</label>
        <input type="text" name="cptefourn" id="cptefourn" class="form-control" autocomplete="off">
        </div>
        <div class="col-md-4">
        <label>Fournisseur</label>
        <input type="text" name="fourn" id="fourn" class="form-control" autocomplete="off">
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
                        <h2>LISTE PRODUIT</h2>
                    </div>
                    <div class="card-body">
                        <br/>
                        
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>REF. ARTICLE</th>
                                        <th>ARTICLE</th>
                                        <th>PU ACHAT</th>
                                        <th>PU VENTE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($produit as $item)
                                    <tr>
                                    <td>{{ $item->refprod }}</td>
                                        <td>{{ $item->prod }}</td>
                                        <td>{{ $item->puach }}</td>
                                        <td>{{ $item->puvte }}</td>
                                    <td>
                                            
                                        <a href="{{ url('/produit/' . $item->id . '/edit') }}" title="Edit JOURNAL"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                            <form method="POST" action="{{ url('/produit' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
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
    </div>

@stop