
$("#salbase").click(function() {
//$("#salbase").bind("click", function(){
    //event.preventDefault();
    $matricule = $("input[name=matricule]");
    $.ajax({
        url: "{{ URL::to('search') }}",
        method: 'post',
        data:{'matricule': $matricule},
        success: function(data) {
           //$('#salbase').val(data);
            alert('Salut');
            
        }

    });

});