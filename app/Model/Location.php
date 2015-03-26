<?php
/**
*
* Location.php
* The location model representing each location for a weather station.
*
*/

class Location extends AppController {

	// we use the location table
	public $uses = "Location";

	// only relationship is has many with readings
	public $hasMany = "Reading";
}