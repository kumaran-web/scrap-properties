<!DOCTYPE html>
<html lang="en" >
<head>
<?php 
$title = "Extract Data";
	include("includes/links.php");
?>
</head>

<body>
<?php
	include("includes/header.php");	
?>

	<div class="section">
		<div class="row" style="margin: 10px 0;">
			
			<div class="col-md-12">
				<h3 class="text-primary text-center">Extract Properties And Store Them In Json File.</h3>
				<hr>
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6 text-center" style="margin: 20px 0;">
						<div id="act_res"></div>
						<button type="button" class="btn btn-warning btn-md" onclick="start_extract();" id="btn_sub"><i class="fa fa-get-pocket"></i> Click To Start New Extraction</button>
						</div>
					<div class="col-md-3"></div>
					<div class="col-md-12">
						<h3>Read My Properties Json File Data:</h3>
						<pre><?php print_r($get_json_data); ?></pre>
					</div>
				</div>
			</div>
			
		</div>
	</div>

<script>
function start_extract(){
	if(confirm('Are You Sure Want To Start To Extract Properties Data?')) {
		$('#btn_sub').attr('disabled', true);
		$.ajax({
			type: "POST",
			url: "actions/ext_prop.php",
			data: {start_ext: '1'},
			beforeSend: function() {
				$('#act_res').html('<div class="alert alert-success text-center" role="alert"><h5 class="alert-heading"><i class="fa fa-spinner fa-spin"></i> Please Wait!...We Are Extracting And Saving The Result.</h5></div>');
			},
			success: function(res){
				if(res == 'S'){
					$(window).scrollTop(0);
					$('#act_res').html('<div class="alert alert-primary text-center" role="alert"><h4 class="alert-heading"><i class="fa fa-check"></i> Congratulations, Your Properties Extraction Done Successfully And Stored In Json File.</h4></div>');
					
					window.setTimeout(function(){
						location.reload();
					}, 2500);
				}else{
					$('#act_res').html('<div class="alert alert-danger text-centerr" role="alert"><h4 class="alert-heading">Oops, Retrieving Properties Un-Successfull.</h4></div>');
					$('#btn_sub').attr('disabled', false);
				}
			}
		});
	}
}
</script>

</body>
</html>

