<?php
if(isset($_POST['del_index'])){
	$del_id = $_POST['del_index'];
	
	$json_file_data = file_get_contents('../json/property.json'); 
	$get_json_data = json_decode($json_file_data, true); 
	
	unset($get_json_data[$del_id]);
	
	$get_json_data = array_values($get_json_data);
	file_put_contents('../json/property.json', json_encode($get_json_data));
	echo 'S';
}

?>
