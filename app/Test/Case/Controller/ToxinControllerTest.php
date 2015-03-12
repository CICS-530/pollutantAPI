<?php

/**
*
* Test cases for the ToxinController.
* Ideally one test PER method.
* ControllerTestCase is made so that it defaults to POST.
*
*/


class ToxinControllerTest extends ControllerTestCase{

	/**
	* Get all categories.
	* Should be HTTP code 200.
	* Should not be an empty array (since data exists)
	*/
	public function test_getAll() {
		$this->testAction('/toxin/index', array('method'=>'get'));
		// the result of the previous GET action was loaded into $this->vars
		// $this->vars is an array
		// the contents of this array is in form of "categories" => [inner array]
		// the inner array (we expect) to be greater than zero.
		$this->assertTrue(count($this->vars['toxins']) > 0);
	}

	/**
	*
	* Get a single ToxinController.
	* Check to see if the id specified and id of returned category are 
	* the same.
	*/
	public function test_getSingleToxin() {
		$this->testAction('/toxin/index/2321', array('method'=>'get'));
		$returnedToxin = $this->vars['toxins']['Toxin'];
		$this->assertEquals(2321, $returnedToxin['id']);
		$this->assertEquals(1, count($this->vars['toxins']));
	}
	/**
	*
	* Get a category with an invalid ID.
	* Using the '@expectedException' annotation to except an error 404.
	* @expectedException NotFoundException 
	*
	*/
	public function test_getNotFound() {
		$this->testAction('/Toxin/index/1', array('method'=>'get'));
	}

	/**
	*
	* POST to the index method. We don't want it to go through
	* @expectedException MethodNotAllowedException
	*
	*/
	public function test_PostIndex() {
		$this->testAction('/toxin/index', array('method' => 'post'));
	}

	/**
	*
	* Make a get to see if we can find the specified category.
	*
	*/
	public function test_searchName() {
		$this->testAction('/toxin/search/lead', array('method' => 'get'));
		$returnedToxin = $this->vars['toxins']['Toxin'];

		$this->assertEquals(1, count($this->vars['toxins']));
	}

}