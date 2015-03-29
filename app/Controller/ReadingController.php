<?php
/**
*
* ReadingController.php
*
*
* The controller for the reading model.
* 
*/


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
			$latestDate = $this->getLatestDate($id);

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

	function dataDate($id, $date) {
		$SECS_DAY = 60 * 60 * 24;
		$multiplier = $date * $SECS_DAY;
		if ($id != null && $date != null) {
			// query goes here
			$latestDate = $this->getLatestDate($id);
			$latestDate -= $multiplier;

			$conditions = array("Reading.date <=". $latestDate, "Location.id = " => $id);
			$readings = $this->Reading->find('all', array('conditions' => $conditions));

		} else {
			throw new BadRequestException("ID and date cannot be empty!");
		}

		if ($this->Reading->getAffectedRows() == 0) {
			throw new NotFoundException("No results found!");
		}

		$this->set('readings', $readings);
	}

	/*
	* Get the latest date available from 
	* the database.
	*/
	function getLatestDate($id) {
		$tempQuery = $this->Reading->findByLocationId($id, array(), array("date" => "desc"));
			
		$latestDate = $tempQuery["Reading"]["date"];

		return $latestDate;
	}
}