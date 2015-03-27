<?php
/**
*
* Location.php
* The location model representing each location for a weather station.
*
*/

class Location extends AppModel {

	// we use the location table
	public $useTable = "Location";

	// only relationship is has many with readings
	public $hasMany = "Reading";
}