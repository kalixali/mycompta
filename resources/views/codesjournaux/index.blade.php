@extends('layout')
@section('content')
 
 <div class="container">
    <div class="card">
  <div class="card-header">SAISIE  DES CODES JOURNAUX</div>
  <div class="card-body">
    <div class="row align-items-center">  
      <form action="{{ url('codesjournaux') }}" method="post">
        {!! csrf_field() !!}
        <div class="col-md-3">
        <label>Code</label>
        <input type="text" name="Code" id="Code" class="form-control" autocomplete="off">
            <div id="compte_list"> </div>
        </div>
        <div class="col-md-3">
        <label>Type</label>
        <input type="text" name="Type" id="Type" class="form-control">
        </div>
        <div class="col-md-6">
        <label>Désignation</label>
        <input type="text" name="Designation" id="Designation" class="form-control">
        </div>
               
        <div class="col-md-3 mt-3">
        <input type="submit" value="Valider" id="idvalider" class="btn btn-success form-control">
        </div>
    </form>
  </div>
</div>
 </div>

<div class="row">

<div class="col-md-9">
<div class="card">
<div class="card-header">
<h2>CODES JOURNAUX</h2>
</div>
<div class="card-body">
<br/>

<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Code</th>
                <th>Type</th>
                <th>Désignation</th>
                
            </tr>
        </thead>
        <tbody>
        @foreach($codesjournaux as $item)
            <tr>
                <td>{{ $item->Code }}</td>
                <td>{{ $item->Type }}</td>
                <td>{{ $item->Designation }}</td>
                <td>
                    
                    <a href="{{ url('/codesjournaux/' . $item->id . '/edit') }}" title="Edit CODES JOURNAUX"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                    <form method="POST" action="{{ url('/codesjournaux' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
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

<br/>

      
</div>
    </div>
    </div>
    </div>
    
    
@stop