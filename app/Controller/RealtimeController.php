<?php
/**
*
* The realtime API controller. 
*
* Currently generates fake data as we don't have real data yet.
*
* 
*/

// Add this line (sort of like a java import statement)
// or a "using namespace::std" in C++.
App::uses('AppController', 'Controller');


class RealTimeController extends AppController {
	var $uses = false; // doesn't use a model


	/*
	* Generate fake data for now.
	* Will need to fill this in later
	*/
	function stationdata() {
		$chemData = array();
		$totalData = array();
		$totalData["station"] = "Vancouver Public Library";
		$totalData["longitude"] = "49.2797";
		$totalData["latitude"] = "-123.1156";
		$totalData["date"] = (string) time(); // need a string for proper json

		$chemData[] = array("name" => "PM25", "value" => "3.3", "units" => "ug/m3s");
		$chemData[] = array("name" => "PM10", "value" => "10.0", "units" => "ug/m3s");
		$chemData[] = array("name" => "O3", "value" => "15.0", "units" => "ppb");
		$chemData[] = array("name" => "NO", "value" => "0.2", "units" => "ppb");
		$chemData[] = array("name" => "NO2", "value" => "9.0", "units" => "ppb");
		$chemData[] = array("name" => "SO2", "value" => "0.2", "units" => "ppb");
		$chemData[] = array("name" => "CO", "value" => "0.21", "units" => "ppm");
		$chemData[] = array("name" => "TRS", "value" => "n/a", "units" => "ppb");

		$totalData["Chemicals"] = $chemData;
		$this->set('data', $totalData);
	}
}