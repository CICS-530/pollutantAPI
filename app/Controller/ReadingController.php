<?php
/**
*
* ReadingController.php
*
*
* The controller for the reading model.
* 
* 
*
*/


class ReadingController extends AppController {


	/**
	* Returns the data for the station specified by ID.
	*
	* The ID goes from 1-25, any other numbers automatically return a 404 error
	*/
	function latestData($id) {
		$this->Reading->recursive = 1;
		if ($id != null) {
			$readings = $this->Reading->findByLocationId($id, array(), 
				array("time" => "desc")
				);

		} else {
			throw new BadRequestException("Station ID cannot be empty!");
		}

		if ($this->Reading->getAffectedRows() == 0 ){
			throw new NotFoundException("No readings found for that ID!");
		}
		$readings['id'] = $id;
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
		if ($id != null && $date != null) {
			// query goes here


		} else {
			throw new BadRequestException("ID and date cannot be empty!");
		}

		$this->set('readings', $readings);
	}
}