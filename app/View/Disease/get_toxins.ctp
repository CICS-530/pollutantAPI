<?php
	$jsonArray = array();
	foreach($diseases as $disease) {
		$entireArray[] = $disease;
	}

	$jsonArray["Disease"] = $entireArray[0];

	// make a new array for each of the inner arrays
	// the each entry in the inner array is a model based on the 
	// diseasetoxin model.
	$toxinArray = array();
	foreach($entireArray[1] as $innerArray) {
		// store each toxin in the toxin array
		$toxinStruct = array();
		$toxinStruct["toxin"] = $innerArray["Toxin"]["name"];
		$toxinStruct["cas_no"] = $innerArray["Toxin"]["cas_no"];
		$toxinStruct["evidence_str"] = $innerArray["evidence_strength"];

		// if there is no cas_no, then we can skip adding this to the array
		if(strlen($toxinStruct["cas_no"]) < 1) {
			continue;
		}

		$toxinArray[] = $toxinStruct;
	}


	$jsonArray["toxins"] = $toxinArray;

	echo json_encode($jsonArray);