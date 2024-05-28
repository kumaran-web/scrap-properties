<!DOCTYPE html>
<html lang="en" >
<head>
<?php 
$title = "Proerty List";
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
				<h3 class="text-success text-center">Table View Of Properties From JSON File</h3>
				<hr>

				<div class="row" style="margin-top: 10px;">
					<div class="col-md-3"></div>
					<div class="col-md-6">
						<div id="act_res" class="text-center"></div>
					</div>
					<div class="col-md-3"></div>
				</div>
				
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10">
						<div class="">          
							<table id="example" class="table table-bordered table-responsive">
								<thead>
									<tr>
										<th>S.No</th>
										<th>Action</th>
									<?php if($num_prop>0){ for($th=0;$th<count($json_cols);$th++){ ?>
										<th><?=$json_cols[$th]?></th>
									<?php } } ?>							
									</tr>
								</thead>
								<tbody>
								<?php
								if($num_prop>0){ 
									$sno = 1; 
									for($num_p=0;$num_p<$num_prop;$num_p++){ 
								?>
									<tr class="success" style="color: #000;">
										<td><?=$sno++?></td>
										<td><button type="button" class="btn btn-danger btn-sm" onclick="myjson_del(<?=$num_p?>)"> Delete </button></td>
								<?php 
									for($td=0;$td<count($json_cols);$td++){ 
										$prop_col = $json_cols[$td];
										$json_val = $get_json_data[$num_p][$prop_col];
										if(!is_array($json_val)){
								?>
										<td><?=$json_val?></td>
								<?php 
									}else{ 
										if($prop_col == 'property_features'){ 
											$property_features = $get_json_data[$num_p]['property_features'];
											$pf_list = array();
											for($pf=0;$pf<count($property_features);$pf++){
												$pfcnt = $pf+1;
												$pf_list[] = $pfcnt."). ".implode(',', array_keys($property_features[$pf]))." <i>(".implode(',', $property_features[$pf]).")</i>";
											}
								?>
										<td><?=implode('<br>', $pf_list)?></td>
								<?php 
										}else{ 
											$rem_dt = array();
											for($pb=0;$pb<count($json_val);$pb++){
												$remcnt = $pb + 1;
												//$rem_dt[] = $remcnt."). ".$json_val[$pb]['caption']." <br><i>[ ".$json_val[$pb]['path']."]</i>";
												$rem_dt[] = $json_val[$pb]['path'];
											}
								?>
										<td><div class="row">
										<?php for($pim=0;$pim<count($rem_dt);$pim++){ ?>
											<div class="col-md-4" style="margin: 10px 0;"><img src="<?=$rem_dt[$pim]?>" alt="" style="width: 30px;height: 30px;"></div>
										<?php } ?>
										</div>
										</td>
								<?php } } } } ?>							
									</tr>
								<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="col-md-1"></div>
				</div>

				
			</div>
			
		</div>
	</div>
	
</body>
</html>
