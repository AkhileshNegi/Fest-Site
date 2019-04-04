$(document).ready(function(){
	$( "#show_events" ).click(function() {
	  $( "#events" ).show();
	});
	$( "#hide_events" ).click(function() {
	  $( "#events" ).hide();
	});
	$("#check_events").click(function(){
    var id = $(this).data('user_id');
    alert("clicked");
    jQuery.ajax({
      type: "POST",
      url: "check_event.php",
      data: { 
              id: id,
            },
      cache: false,
      success: function(data){
       alert("hello"); 
      }
    });
  });
});