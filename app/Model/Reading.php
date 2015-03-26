<?php
/**
*
* Readings.php
* The readings model represents a single station reading that a station
* makes.
*
*/

class Reading extends AppModel {

	// we use the location table
	public $uses = "Chemical_Readings";

	// only one reading per station
	public $belongsTo = "Location";
}