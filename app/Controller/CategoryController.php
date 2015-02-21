<?php
/**
*
* CategoryController.php
*
* The controller for the Category model.
* Presents basic information about the category.
* Does NOT return a view.
*/

class CategoryController extends AppController {
	/**
	* Gets ALL categories and returns a json array
	* containing their ids and names.
	*
	*/
	function index() {
		$this->layout = '';
		$category = $this->Category->find('all');
		$this->set('categories', $category);
		$this->response->type("application/json");
	}
}