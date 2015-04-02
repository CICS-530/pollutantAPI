<?php
/**
*
* Readings.php
* The readings model represents a single station reading that a station
* makes.
*
*/

class Reading extends AppModel {
	public $useTable = "Readings";

	// Reading belongs to BOTH chemical and location
	// The belongsTo is needed because the foreign key for both
	// location and chemical exists within this model, so
	// reading belongs to both the chemical and location models.
	public $belongsTo = array(
		'Chemical' => array('className' => "Chemical", 'foreign_key' => 'chemical_id'),
		'Location' => array('className' => "Location", 'foreign_key' => 'location_id')
		);
}