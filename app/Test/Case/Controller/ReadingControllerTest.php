<?php
/**
* ReadingController tests
*
*/
class ReadingControllerTest extends ControllerTestCase {

	public $fixtures = array('app.reading');

	/**
	* Testing the datedata method
	*/
	public function test_dateData() {
		$this->testAction('/reading/dataDate/25/0', array('method' => 'get'));
		$results = $this->vars;
		$this->assertEquals(3, count($results["readings"]));
	}

	/**
	* Test for bad request
	* @expectedException NotFoundException
	*/
	public function test_badRequest() {
		$this->testAction('/reading/dataDate/25/3', array('method' => 'get'));
	}


	/**
	* Testing the datedata method
	*/
	public function test_dateBefore() {
		$this->testAction('/reading/dataDate/25/1', array('method' => 'get'));
		$results = $this->vars;
		$this->assertEquals(2, count($results["readings"]));
	}

	/**
	*
	* Testing the latestData method
	*/
	public function test_latestData() {
		$this->testAction('/reading/latestData/25', array('method' => 'get'));
	}
}