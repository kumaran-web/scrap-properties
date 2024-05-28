$(document).ready(function() {
	$('#example').DataTable();
     
});
function myjson_del(del_id){
	if(confirm('Are You Sure Want To Delete This Property Data?')) {
		$.ajax({
			type: "POST",
			url: "actions/propert_del.php",
			data: {del_index: del_id},
			success: function(res){
				if(res == 'S'){
					$(window).scrollTop(0);
					$('#act_res').html('<div class="alert alert-warning" role="alert"><h4 class="alert-heading">Success! Property Data Deleted.</h4></div>');
					
					window.setTimeout(function(){
						location.reload();
					}, 2500);
				}
			}
		});
	}
}

