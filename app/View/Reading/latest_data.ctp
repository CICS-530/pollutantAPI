<?php
	$jsonArray = array();

	echo json_encode($readings);
	// The location and dates are all the same, so I can
	// Retreive that from the first entry.
	
	$firstReading = $readings[0];
	$jsonArray["station"] = $firstReading["Location"]["name"];
	$jsonArray["latitude"] = $firstReading["Location"]["latitude"];
	$jsonArray["longitude"] = $firstReading["Location"]["longitude"];
	$jsonArray["date"] = $firstReading["Reading"]["date"];


	// get the each chemical entry
	$chemicals = array();
	
	foreach($readings as $value) {
		$chemical = array();
		$chemical["name"] = $value["Chemical"]["name"];
		$chemical["value"] = $value["Reading"]["value"];
		$chemical["units"] = $value["Chemical"]["units"];

		$chemicals[] = $chemical;
	}

	$jsonArray["Chemicals"] = $chemicals;

	echo json_encode($jsonArray);