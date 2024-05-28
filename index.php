<!DOCTYPE html>
<html lang="en" >
<head>
<?php 
$title = "Property View";
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
				<h3 class="text-primary text-center">View Of Properties From JSON File</h3>
				<hr>
				<div class="row">
<?php

if($num_prop>0){ 
	for($num_p=0;$num_p<$num_prop;$num_p++){ 
		$pr_tlt = $get_json_data[$num_p]['property_title'];
		$pr_cnt = $get_json_data[$num_p]['property_content'];
		$pr_loc = $get_json_data[$num_p]['property_location'];
		$pr_inr = $get_json_data[$num_p]['property_price'];
		$pr_qual = $get_json_data[$num_p]['property_qualifier'];
		$pr_freq = $get_json_data[$num_p]['property_frequency'];
		$pr_cat = $get_json_data[$num_p]['property_category'];

		$pr_brchr = $get_json_data[$num_p]['contactTelephone'];
		/*$pb_brchr = array();
		for($pb=0;$pb<count($pr_brchr);$pb++){
			$sno = $pb+1;
			$pb_brchr[] = "<strong>".$sno.").</strong> <i>".$pr_brchr[$pb]['path']."</i>";
		}*/

		$pr_feat = $get_json_data[$num_p]['property_features'];
		$pf_list = array();
		for($pf=0;$pf<count($pr_feat);$pf++){
			$pf_list[] = implode(',', array_keys($pr_feat[$pf]))." <i>(".implode(',', $pr_feat[$pf]).")</i>";
		}
		
		$pr_imgs = $get_json_data[$num_p]['property_images'];
		$pi_list = array();
		for($pi=0;$pi<count($pr_imgs);$pi++){
			//$pi_list[] = $pr_imgs[$pi]['caption']." - ".$pr_imgs[$pi]['path']."</br>";
			$pi_list[] = $pr_imgs[$pi]['path'];
		}	
?>

					<div class="container py-3">
						<div class="card">
							<div class="row ">
								<div class="col-md-7 px-3">
									<div class="card-block px-6">
										<h4 class="card-title"><?=$pr_tlt?> <span style="float: right;"><i class="fa fa-inr"></i> <?=$pr_inr?>/-</span></h4>
										<h6 class="card-subtitle mb-2 text-muted"><?=$pr_loc?></h6>
										<p class="card-text"><?=$pr_cnt?></p>
										<div class="row">
											<div class="col-md-6">
												<h6><u>Features:</u></h6>
												<p class="card-text"><?=implode('<br>', $pf_list)?></p>	
											</div>
											<div class="col-md-6 text-right">
												<p class="card-text"><?=$pr_qual." - ".$pr_freq." - ".$pr_cat?></p>
												<?php //if(count($pr_brchr)>0){ ?><p class="card-text">contac: <?=$pr_brchr?></p><?php //} ?>
												<br>
												<a href="#" class="mt-auto btn btn-primary  ">Read More</a>
											</div>
										</div>
									</div>
								</div>
								
								<!-- Carousel start -->
								<div class="col-md-5">
									<div id="CarouselTest<?=$num_p?>" class="carousel slide" data-ride="" style="background: #ddd;">
										<ol class="carousel-indicators">
											<li data-target="#CarouselTest<?=$num_p?>" data-slide-to="0" class="active"></li>
											<li data-target="#CarouselTest<?=$num_p?>" data-slide-to="1"></li>
											<li data-target="#CarouselTest<?=$num_p?>" data-slide-to="2"></li>
										</ol>
										<div class="carousel-inner">
										<?php for($pim=0;$pim<count($pi_list);$pim++){ ?>	
											<div class="carousel-item <?php if($pim==0){ ?>active<?php } ?>">
												<img class="d-block" src="<?=$pi_list[$pim]?>" alt="">
											</div>
										<?php } ?>
											

											<a class="carousel-control-prev" href="#CarouselTest<?=$num_p?>" role="button" data-slide="prev">
												<span class="carousel-control-prev-icon" aria-hidden="true"></span>
												<span class="sr-only">Previous</span>
											</a>
											<a class="carousel-control-next" href="#CarouselTest<?=$num_p?>" role="button" data-slide="next">
												<span class="carousel-control-next-icon" aria-hidden="true"></span>
												<span class="sr-only">Next</span>
											</a>
										</div>
									</div>
								</div>
								<!-- End of carousel -->
							</div>
						</div>						
					</div>

<?php } }else{ ?>	
		<div class="col-md-12 text-center">
			<img src="images/come.png" alt="Comming Soon" style="width: 50%;">
		</div>
<?php } ?>
				</div>
			</div>
			
		</div>
	</div>
	
</body>
</html>

