<?php 
	$jsonArray = array();
	foreach($categories as $category) {
		// we filter out the CategoryDiseases as it isn't needed yet.
		unset($category["CategoryDisease"]);
		$jsonArray[] =  $category;
	}
	echo json_encode($jsonArray);
