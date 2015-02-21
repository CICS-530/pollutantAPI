<?php

/**
*
* Test cases for the CategoryController.
* Ideally one test PER method.
*
*/

class CategoryControllerTest extends ControllerTestCase{

	/**
	* Get all categories.
	* Should be HTTP code 200.
	* Should not be an empty array (since data exists)
	*/
	public function test_getAll() {
		$this->testAction('/category/index');
		$result = json_decode($this->result, true);
		var_dump($this->vars);
		$this->assertEquals(25, count($result));
	}
}