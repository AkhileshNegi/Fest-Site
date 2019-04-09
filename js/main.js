$(document).ready(function(){
	$( "#show_events" ).click(function() {
	  $( "#events" ).show();
	});
	$( "#hide_events" ).click(function() {
	  $( "#events" ).hide();
	});
	$("#check_events").click(function(){
    var id = $(this).data('user_id');
    var id_numbers = new Array();
    jQuery.ajax({
      type: "POST",
      url: "check_event.php",
      data: { 
              id: id,
            },
      cache: false,
        success:function(msg){
          $("#events").html(event(msg));
    },
    dataType:"json"
    });
  });
  function event(msg){
    let myArray = msg;
    var myvar = '<table class="table">'+
                  '  <thead>'+
                    '    <tr>'+
                      '      <th scope="col">Events</th>'+
                    '    </tr>'+
                  '  </thead>'+
                  '  <tbody>';
    for(let i = 0; i < myArray.length; i++){
      myvar += '<tr><td>'+myArray[i]+'</td></tr>';
    }
        myvar +=   '</tbody>'+
                '</table>';
    return myvar
  }
});