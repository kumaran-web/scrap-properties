<?php
$json_file_data = file_get_contents('json/property.json'); 
$get_json_data = json_decode($json_file_data, true); 

$num_prop = count($get_json_data);
	if($num_prop>0){ 
		$json_cols = array_keys($get_json_data[0]); 		
	}else{ 
		$json_cols = ''; 
	}
?>