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
	*
	* Gets ALL categories and returns a json array
	* containing their ids and names.
	* 
	* Check if the parameter passed in is null or not.
	* If null, return all, otherwise return the category specified
	* by ID.
	*/
	function index() {
		// set recursive to level -1 to stop it from joining tables
		$this->Category->recursive = -1;
		if ($this->params['pass'] != null) {
			$id = $this->params['pass'][0];
			$category = $this->Category->findById($id);
		} else {
			$category = $this->Category->find('all');	
		}
		$this->set('categories', $category);
	}
}