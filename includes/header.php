<?php
function akr_MyPage(){
	return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);		
}
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<a class="navbar-brand" href="index.php" style="border: 1px solid;border-radius: 8px;padding: 2px 8px;"><i class="fa fa-home"></i> Real Estate Task</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item <?php if(akr_MyPage() == 'index.php'){ ?>active<?php } ?>">
				<a class="nav-link" href="index.php">Grid View</a>
			</li>
			<li class="nav-item <?php if(akr_MyPage() == 'table_view.php'){ ?>active<?php } ?>">
				<a class="nav-link" href="table_view.php">Table View</a>
			</li>
			<li class="nav-item <?php if(akr_MyPage() == 'extract_property.php'){ ?>active<?php } ?>">
				<a class="nav-link" href="extract_property.php">Extract Properties</a>
			</li>			
		</ul>			
	</div>
</nav>
<?php include("includes/get_property.php"); ?>
