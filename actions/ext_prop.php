<?php
$url = 'https://www.rightmove.co.uk/property-for-sale/find/Dee-Atkinson-and-Harrison/Driffield.html?locationIdentifier=BRANCH%5E9607&includeSSTC=true&_includeSSTC=on';
function read_curl($my_url)
{
	$my_user_agent= $_SERVER['HTTP_USER_AGENT'];
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_VERBOSE, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_USERAGENT, $my_user_agent);
	curl_setopt($ch, CURLOPT_URL, $my_url);
	$result=curl_exec($ch);
	curl_close($ch);
	return $result;
}
$curl_res = read_curl($url);
//echo $curl_res;

if(isset($_POST['start_ext'])){
	libxml_use_internal_errors(true);
	$dom = new DOMDocument; 
	@$dom->loadHTML($curl_res); 

	$dom_path = new DOMXPath($dom);
		$dom_qry = '//script[starts-with(normalize-space(.), "window.jsonModel")]';
	$dom_req = $dom_path->query($dom_qry)->item(0)->nodeValue;

	if($dom_req){
		$jsonStart = strpos($dom_req, '{');
		$jsonEnd = strrpos($dom_req, '}');
		$collections = json_decode(substr($dom_req, $jsonStart, $jsonEnd - $jsonStart + 1), true);
		$curl_json_properties = json_encode($collections['properties']); 
		//echo $curl_json_properties;
		
		$get_json_data = json_decode($curl_json_properties, true); 
		$num_prop = count($get_json_data);

		for($k=0;$k<$num_prop;$k++){
			$img_dt = $get_json_data[$k]['propertyImages']['images'];
			$imgsdd = array();
			for($imgs=0;$imgs<count($img_dt);$imgs++){
				$imgsdd[] = array(
				'caption' => $img_dt[$imgs]['url'], 'path' => $img_dt[$imgs]['srcUrl']
				);
			}
			//echo $get_json_data[$k]['propertyTypeFullDescription']."<br>";
			
			$output[] = array(
				'property_id' => $get_json_data[$k]['id'],
				'property_title' => $get_json_data[$k]['propertyTypeFullDescription'],
				'property_content' => $get_json_data[$k]['summary'],
				'property_features' => [ array('bedroom' => $get_json_data[$k]['bedrooms']),
										 array('floors' => $get_json_data[$k]['numberOfFloorplans']),
										 array('vt' => $get_json_data[$k]['numberOfVirtualTours'])
									   ],
				'property_price' => $get_json_data[$k]['price']['amount'],
				'property_qualifier' => $get_json_data[$k]['price']['displayPrices'][0]['displayPriceQualifier'],
				'property_location' => $get_json_data[$k]['displayAddress'],
				'property_frequency' => $get_json_data[$k]['price']['frequency'],
				'property_category' => $get_json_data[$k]['propertySubType'],
				'property_images' => $imgsdd,	
				'contactTelephone' => $get_json_data[$k]['customer']['contactTelephone']
			);
		}
		$json_output = json_encode($output);
		//echo $json_output;
		file_put_contents('../json/property.json', $json_output);
		$msg = "S";
	}else{
		$msg = "F";
	}
echo $msg;
}

?>
