<?php
	$jsonArray = array();
	$categories = array();
	
	foreach($allData as $category) {
		$jsonArray[] = $category;
		$categories[$category["Category"]["name"]] = array("Diseases" => array());
	}

	$categoryKeyArray = array_keys($categories);


	for($i = 0; $i < count($categoryKeyArray); $i++){
		$diseases = array();

		// get all diseases for each category
		foreach($allData as $category) {
			if ($allData["Category"]["name"] == $categoryKeyArray[i]) {
				$categories[$categoryKeyArray[i]]["Diseases"][] = $allData["Disease"]["name"];
			}
		}
	}


	echo json_encode($jsonArray);
	echo json_encode($categories);