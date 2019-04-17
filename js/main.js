$(document).ready(function(){
	$( "#show_events" ).click(function() {
	  $( "#events" ).show();
	});
	$( "#hide_events" ).click(function() {
	  $( "#events" ).hide();
	});
  $(".event_details").click(function(){
    var eventid = $(this).data('eventid'); 
    jQuery.ajax({
        type: "POST",
        url: "event_detail.php",
        data: { 
          id: eventid,
          },
        cache: false,
        success:function(msg){
          alert("  ")
          // alert(event_detail(msg))
        },
        dataType:"json"
      });
  });
  function event_detail(msg){
  let myArray = msg;
    var myvar = '';
    for(let i = 0; i < myArray.length; i++){
      myvar += '<tr><td>'+myArray[i]+'</td></tr>';
    }
    return myArray['event_name'];
  }
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