@extends('layout')
@section('content')
 
 <div class="container">
 <div class="card">
  <div class="card-header">ACHATS</div>
  <div class="card-body">


  <div id="reader" width="600px" class="gy-2 px-3 py-3 mx-3 my-3 border border-3"></div>

  </div>
  </div>
  </div>
  <script src="jquery-3.6.3.js"></script>
  <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
  <script>
function onScanSuccess(decodedText, decodedResult) {
	//alert(decodedText);
	//$('#result').val(decodedText);
	var idd = decodedText;
	var ii = idd.indexOf("-");
    var id = idd.substring(0,ii);
	alert(idd);
	$.ajax({
		url: "{{ route('searchach3') }}",
		type: "GET",
		data: {'id' : id},
		success: function(data){
			//$("#product_list").html(data);
			alert(data);
		}
	});
	
	// html5QrcodeScanner.clear().then(_ => {
	// 	var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
	// 	$.ajax({
	// 		url: "{{ route('searchach3') }}",
	// 		type: 'POST',
	// 		//data: {'id' : id},
	// 		data: {
	// 			_method: "POST",
	// 			_token: CSRF_TOKEN,
	// 			'qr_code': id
	// 		},

	// 		success: function (data) {
	// 			alert(data);
				
    //         }
    //     });
//});
}

function onScanFailure(error) {
	console.warn('Code scan error = ${error}');
}

let html5QrcodeScanner = new Html5QrcodeScanner(
  "reader",
  {
    fps: 10,
    qrbox: { width: 250, height: 250 } },
  /* verbose= */ false);
html5QrcodeScanner.render(onScanSuccess);
</script>
@stop