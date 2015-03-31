<?php
	
	//echo json_encode($readings);
	
	$jsonData = array();
	
	$dates = array();
	foreach($readings as $reading) {
		// add a new key for each date
		// values are empty for now 
		$dates[$reading["Reading"]["date"]] = array();
	}

	// get an array of only keys
	$keyArray = array_keys($dates);

	// loop through the dates to find readings that match.
	// there is a maximum of 24 dates per day (theoretically)
	for ($i=0; $i < count($keyArray); $i++) { 
		// now look through the readings array and see if the dates match.
		foreach($readings as $reading) {
			if ($reading["Reading"]["date"] == $keyArray[$i]) {
				// add the object to the array
				$dates[$keyArray[$i]][] = $reading;
			}
		}
	}

	foreach($dates as $sortedReading) {
		$jsonData[] = formatArray($sortedReading);
	}

	echo json_encode($jsonData);

	/**
	* Function that takes an object and creates the specified object for it
	*/
	function formatArray($readingObject) {

		$jsonArray = array();

		$firstReading = $readingObject[0];
		$jsonArray["station"] = $firstReading["Location"]["name"];
		$jsonArray["latitude"] = $firstReading["Location"]["latitude"];
		$jsonArray["longitude"] = $firstReading["Location"]["longitude"];
		$jsonArray["date"] = $firstReading["Reading"]["date"];

		// get the each chemical entry
		$chemicals = array();
		
		foreach($readingObject as $value) {
			$chemical = array();
			$chemical["name"] = $value["Chemical"]["name"];
			$chemical["value"] = $value["Reading"]["value"];
			$chemical["units"] = $value["Chemical"]["units"];

			$chemicals[] = $chemical;
		}

		$jsonArray["Chemicals"] = $chemicals;

		return $jsonArray;

	}