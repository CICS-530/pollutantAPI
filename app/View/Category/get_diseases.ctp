<?php
	$jsonArray = array();
	foreach($categories as $category) {
		$entireArray[] = $category;
	}

	$jsonArray["Category"] = $entireArray[0];

	// make a new array for each of the inner arrays
	// the each entry in the inner array is a model based on the 
	// categorydisease model.
	$diseaseArray = array();
	foreach($entireArray[1] as $innerArray) {
		// store each toxin in the toxin array
		$diseaseStruct = array();
		$diseaseStruct["disease"] = $innerArray["Diseases"]["name"];
		$diseaseArray[] = $diseaseStruct;
	}

	$jsonArray["diseases"] = $diseaseArray;
	echo json_encode($jsonArray);