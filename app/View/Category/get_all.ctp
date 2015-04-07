<?php

	$categories = array();
	$categoryNames = array();

	// we need an array of call categories
	foreach($allData as $result) {
		$categoryNames[] = $result["Category"]["name"];
	}

	$categoryNames = array_unique($categoryNames);

	foreach($categoryNames as $name) {
		$categories[]["Category"] = array("name" => $name, "Diseases" => array());
	}



	// we need an array for all diseases in EACH category
	$diseaseNames = array();
	foreach($allData as $result) {
		$diseaseNames[] = $result["Diseases"]["name"];
	}
	$diseaseNames = array_unique($diseaseNames);

	// associate each toxin with a particular disease
	$diseases = array();
	foreach($diseaseNames as $name) {
		$diseases[] = array("name" => $name, "Toxins" => array());
	}

	// associating each disease with an array of toxins.
	foreach($allData as $result) {
		for($i = 0; $i< count($diseases); $i++) {
			if ($result["Diseases"]["name"] == $diseases[$i]["name"]) {
				$diseases[$i]["Toxins"][] = array("name" => $result["Toxins"]["name"], "strength" => $result["Diseases_Toxins"]["evidence_strength"]);
			}
		}
	}


	foreach($allData as $result) {
		for($i = 0; $i< count($categories); $i++) {
			// if the category name matches the result category name
			if ($categories[$i]["Category"]["name"] == $result["Category"]["name"]) {
				// find the disease and put it in the disease array of the category
				$categories[$i]["Category"]["Diseases"] = $diseases;
			}
		}
	}
	
	echo json_encode($categories);