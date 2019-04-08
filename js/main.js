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
            events},
      cache: false,
        success:function(msg){
          $("#events").html(events());
    },
    dataType:"json"
    });
  });
  function events(msg){
    html="hello";
    return html;
  }
});