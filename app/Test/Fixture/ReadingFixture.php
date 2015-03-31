<?php 
/**
* Fixture file used for testing the ReadingController
*
*/
class ReadingFixture extends CakeTestFixture {
	public $import = "Reading";


	/**
	* Dynamic data for testing dates
	*
	*/
	public function init() {
		$initialDate = new DateTime();
		$initialDate->setTimestamp(date('U'));
		$initialDate->modify('-1 day');
		
		$forwardDate = new DateTime();
		$forwardDate->setTimestamp(date('U'));

		$forwardHour = new DateTime();
		$forwardHour->setTimestamp($forwardDate->getTimeStamp());
		$forwardHour->modify('+1 hour');

		$this->records = array(
			array('id' => 1,
				'location_id' => '25',
				'chemical_id' => '4',
				'date' => $initialDate->getTimeStamp(),
				'value' => '0.3'
			),
			array('id' => 2,
				'location_id' => '25',
				'chemical_id' => '2',
				'date' => $initialDate->getTimeStamp(),
				'value' => '5.5'
			),
			array('id' => 3,
				'location_id' => '25', 
				'chemical_id' => '7', 
				'date' => $forwardDate->getTimeStamp(),
				'value' => '4.3'
			),
			array('id' => 4,
				'location_id' => '25',
				'chemical_id' => '7',
				'date' => $forwardHour->getTimeStamp(),
				'value' => '0.5'
			),
			array('id' => 5,
				'location_id' => '25',
				'chemical_id' => '6',
				'date' => $forwardHour->getTimeStamp(),
				'value' => '4.4'
			)
		);
		// override the parent
		parent::init();
	}
}