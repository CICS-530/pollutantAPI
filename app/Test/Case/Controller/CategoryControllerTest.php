<?php

/**
*
* Test cases for the CategoryController.
* Ideally one test PER method.
* ControllerTestCase is made so that it defaults to POST.
*
*/


class CategoryControllerTest extends ControllerTestCase{

	/**
	* Get all categories.
	* Should be HTTP code 200.
	* Should not be an empty array (since data exists)
	*/
	public function test_getAll() {
		$this->testAction('/category/index', array('method'=>'get'));
		// the result of the previous GET action was loaded into $this->vars
		// $this->vars is an array
		// the contents of this array is in form of "categories" => [inner array]
		// the inner array (we expect) to have 25 elements.
		$this->assertEquals(25, count($this->vars["categories"]));
	}

	/**
	*
	* Get a single CategoryController.
	* Check to see if the id specified and id of returned category are 
	* the same.
	*/
	public function test_getSingleCategory() {
		$this->testAction('/category/index/136', array('method'=>'get'));
		$returnedCategory = $this->vars['categories']['Category'];
		$this->assertEquals(136, $returnedCategory['id']);
		$this->assertEquals(1, count($this->vars['categories']));
	}
	/**
	*
	* Get a category with an invalid ID.
	* Using the '@expectedException' annotation to except an error 404.
	* @expectedException NotFoundException 
	*
	*/
	public function test_getNotFound() {
		$this->testAction('/category/index/1', array('method'=>'get'));
	}

	/**
	*
	* POST to the index method. We don't want it to go through
	* @expectedException MethodNotAllowedException
	*
	*/
	public function test_PostIndex() {
		$this->testAction('/category/index', array('method' => 'post'));
	}

	/**
	*
	* Make a get to see if we can find the specified category.
	*
	*/
	public function test_searchName() {
		$this->testAction('/category/search/Cardio-vascular', array('method' => 'get'));
		$returnedCategory = $this->vars['categories']['Category'];

		$this->assertEquals(1, count($this->vars['categories']));
	}
	
	/* 
	 *
	 * Get a category along with its associated diseases
	 *
	 */
	public function test_getDiseases() {
		$this->testAction('/category/getDiseases/Liver', array('method' => 'get'));
	
		$returnedArray = $this->vars['categories'];
		$category = $returnedArray["Category"];
		$this->assertEquals("Liver", $category["name"]);
		$this->assertEquals(10, count($returnedArray["Disease"]));
	} 

}