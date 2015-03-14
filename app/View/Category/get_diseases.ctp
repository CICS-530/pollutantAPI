<?php
	
	$jsonArray = array();

	$jsonArray["name"] = $categories['Category']['name'];
	$jsonArray["id"] = $categories['Category']['id'];


	$diseaseArray = array();
	foreach($categories["Disease"] as $disease) {	
		$diseaseDetail = array();
		$diseaseDetail["name"] = $disease["name"];
		$diseaseDetail["notes"] = $disease["notes"];
		$diseaseArray[] = $diseaseDetail;     
	}

	$jsonArray["diseases"] = $diseaseArray;        
	

	echo json_encode($jsonArray);