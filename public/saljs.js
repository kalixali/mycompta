//(document).ready(function()
//{
	$('#salbase').on('click',function(event)
	{
        	//$matricule = $('#matricule').val();
			event.preventDefault();
			var $matricule, $sal;
        	$sal = $("#salbase");
			$matricule = $("input[name=matricule]").val();
			$.ajax({
        	type: "GET",
			url: "{{URL::to('search')}}",
			data:{'matricule': $matricule},
			dataType : 'html',
			success:function(data) {
				console.log(data);
        		$sal.html(data);
        		
				//alert('ok');
    		}
    		});
		
		
		//alert('hello');
	});

//});
    	

