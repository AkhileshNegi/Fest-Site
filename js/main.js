$(document).ready(function(){
	$( "#show_events" ).click(function() {
	  $( "#events" ).show();
	});
	$( "#hide_events" ).click(function() {
	  $( "#events" ).hide();
	});
	$("#check_events").click(function(){
    var id = $(this).data('user_id');
    alert(id);
  });
});