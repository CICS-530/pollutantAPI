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
			)
		);
		// override the parent
		parent::init();
	}
}