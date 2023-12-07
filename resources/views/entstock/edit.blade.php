@extends('layout')
@section('content')

 <div class="container">
 <div class="card">
  <div class="card-header">EDIT Page</div>
  <div class="card-body">
    <div class="row align-items-center">
      
      <form action="{{ url('entstock/' .$entstock->id) }}" method="post">
        {!! csrf_field() !!}
        @method("PATCH")
                
        <input type="hidden" name="id" id="id" value="{{$entstock->id}}" id="id" /> <br/>
        
        <div class="col-md-4">
        <label>ARTICLE</label>
        <input type="text" name="prod" id="prod" class="form-control" value="{{$entstock->prod}}">
        </div>

        <div class="col-md-4">
        <label>QTITE</label>
        <input type="text" name="qtite" id="qtite" class="form-control" value="{{$entstock->qtite}}" autocomplete="off">
        </div>

        <div class="col-md-4">
        <label>PU</label>
        <input type="text" name="pu" id="pu" class="form-control" value="{{$entstock->pu}}" autocomplete="off">
        </div>

        <div class="col-md-4">
        <label>MONTANT</label>
        <input type="text" name="mont" id="mont" class="form-control"  value="{{$entstock->mont}}" autocomplete="off">
        </div>

        <div class="col-md-3 mt-3">
        <input type="submit" value="Modifier" class="form-control btn btn-success"></br>
        </div>
    </form>
   </div>
   </div>
  </div>
</div>
 
 <script src="jquery-3.6.3.min.js"></script>
  <script>
    $("#mont").click(function() {
      ne = parseInt($("#qtite").val());
      nS = parseInt($("#pu").val());
      //$("#idmont").val(0);
      $("#mont").(ne*nS);
    });
    /* $("#idqtite").change(function() {
      ne = parseInt($("#idqtite").val());
      nS = parseInt($("#idpu").val());
      $("#idmont").val(ne*nS);
    }); */
        
  </script>
  
@stop