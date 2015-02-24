<?php

/**
*
* Test cases for the DiseaseController.
* Ideally one test PER method.
* ControllerTestCase is made so that it defaults to POST.
*
*/


class DiseaseControllerTest extends ControllerTestCase{

	/**
	* Get all categories.
	* Should be HTTP code 200.
	* Should not be an empty array (since data exists)
	*/
	public function test_getAll() {
		$this->testAction('/disease/index', array('method'=>'get'));
		// the result of the previous GET action was loaded into $this->vars
		// $this->vars is an array
		// the contents of this array is in form of "categories" => [inner array]
		// the inner array (we expect) to be greater than zero.
		$this->assertTrue(count($this->vars['diseases']) > 0);
	}

	/**
	*
	* Get a single CategoryController.
	* Check to see if the id specified and id of returned category are 
	* the same.
	*/
	public function test_getSingleCategory() {
		$this->testAction('/disease/index/620', array('method'=>'get'));
		$returnedCategory = $this->vars['diseases']['Disease'];
		$this->assertEquals(620, $returnedCategory['id']);
		$this->assertEquals(1, count($this->vars['diseases']));
	}
	/**
	*
	* Get a category with an invalid ID.
	* Using the '@expectedException' annotation to except an error 404.
	* @expectedException NotFoundException 
	*
	*/
	public function test_getNotFound() {
		$this->testAction('/disease/index/1', array('method'=>'get'));
	}

	/**
	*
	* POST to the index method. We don't want it to go through
	* @expectedException MethodNotAllowedException
	*
	*/
	public function test_PostIndex() {
		$this->testAction('/disease/index', array('method' => 'post'));
	}

}