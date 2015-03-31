<?php
/**
*
* ReadingController.php
*
*
* The controller for the reading model.
* 
*/

App::uses('AppController', 'Controller');
App::uses('DateLib', 'DateLib');


class ReadingController extends AppController {

	/**
	* Returns the data for the station specified by ID.
	* Returns the most recent entries.
	*
	* The ID goes from 1-25, any other numbers automatically return a 404 error
	*/
	function latestData($id) {
		$this->Reading->recursive = 1;
		if ($id != null) {
			$tempQuery = $this->Reading->findByLocationId($id, array(), array("date" => "desc"));
			
			$latestDate = $tempQuery["Reading"]["date"];

			$readings = $this->Reading->findAllByLocationIdAndDate($id, $latestDate);

		} else {
			throw new BadRequestException("Station ID cannot be empty!");
		}

		if ($this->Reading->getAffectedRows() == 0 ){
			throw new NotFoundException("No readings found for that ID!");
		}
		$this->set('readings', $readings);
	}


	/**
	*
	* Returns the data offset by the number of days previous from the latest recording.
	* 
	* The maximum number of days is 7; any longer and the server takes too long
	* to retrieve the data.
	* 
	* Date is provided as a offset between 1 and 7.
	* Must also provide the ID as well.
	*/

	
	function dataDate($id, $dateOffset) {
		// need to get a range. so if we have a date of 6, 
		// we need to start from the latest date, and get all the data from 6 days ago.
		// i.e. all the readings that are younger than 7 days back, but older than 5 days back. 

		$this->Reading->recursive = 1;
		if ($id != null && $dateOffset != null) {
			// set the date limits on the search
			$latestDate = $this->getLatestDate($id);
			$olderLimit = DateLib::oldestDate($dateOffset, $latestDate);
			$youngerLimit = DateLib::youngestDate($dateOffset, $latestDate);

			$conditions = array("Reading.date <=". $youngerLimit,
				"Reading.date >= ". $olderLimit, 
				"Location.id = " => $id);
			
			// the actual query
			$readings = $this->Reading->find('all', array('conditions' => $conditions, 
				"fields" => array('Reading.date', 'Reading.value', 'Chemical.name', 'Chemical.units',
					'Location.name', 'Location.latitude', 'Location.longitude'))
			);
		} else {
			throw new BadRequestException("ID and date cannot be empty!");
		}

		if ($this->Reading->getAffectedRows() == 0) {
			throw new NotFoundException("No results found!");
		}

		$this->set('readings', $readings);
	}

	/*
	* Get the latest date available from the database.
	*/
	function getLatestDate($id) {
		$tempQuery = $this->Reading->findByLocationId($id, array('date'), array("date" => "desc"));
			
		$latestDate = $tempQuery["Reading"]["date"];
		return $latestDate;
	}
}