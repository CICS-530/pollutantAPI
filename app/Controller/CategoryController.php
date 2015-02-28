<?php
/**
*
* CategoryController.php
*
* The controller for the Category model.
* Presents basic information about the category.
* Does NOT return a view.
*/


// Add this line (sort of like a java import statement)
// or a "using namespace::std" in C++.
App::uses('AppController', 'Controller');
App::uses('NotFoundException', 'Exception');


class CategoryController extends AppController {
	/**
	*
	* Gets ALL categories and returns a json array
	* containing their ids and names.
	* 
	* Check if the parameter passed in is null or not.
	* If null, return all, otherwise return the category specified
	* by ID.
	*
	* If nothing was found, an error 404 should be returned.
	*/
	function index() {
		// set recursive to level -1 to stop it from joining tables
		$this->Category->recursive = -1;

		// check if we have any URL paramenters.
		// query depends on whether or not we have an ID or not.
		if ($this->params['pass'] != null) {
			$id = $this->params['pass'][0];
			$category = $this->Category->findById($id);
		} else {
			$category = $this->Category->find('all');	
		}

		// throw exception if we can't find anything.
		if ($this->Category->getAffectedRows() === 0) {
			throw new NotFoundException('No disease categories found!');
		}

		$this->set('categories', $category);
	}
	
	
	/**
	 *
	 * searches for all categories by name and returns a json array
	 * containing their ids and names.
	 *
	 * This is a wildcard search with equals(default), contains, startswith, endswith
	 *
	 * e.g.
	 * http://localhost:8000/category/search
	 * http://localhost:8000/category/search?name=developmental
	 * http://localhost:8000/category/search?name=developmental&type=equals
	 * http://localhost:8000/category/search?name=developmental&type=startswith
	 * http://localhost:8000/category/search?name=developmental&type=endswith
	 * http://localhost:8000/category/search?name=develop&type=contains
	 *
	 * Check if the parameters passed in is null or not.
	 * If null, return all, otherwise return the category according to the type of search
	 *
	 *
	 * If nothing was found, an error 404 should be returned.
	 */
	function search() {
		
		// set recursive to level -1 to stop it from joining tables
		$this->Category->recursive = - 1;
		
		// check if we have name parameter else display all results
		if (isset ( $_REQUEST ['name'] )) {
			$name = strtoupper ( $_REQUEST ['name'] );
			
			// check if the search type is passed otherwise run a default(equals) search
			if (isset ( $_REQUEST ['type'] )) {
				$searchType = strtolower ( $_REQUEST ['type'] );
				$table = "categories";
				// get the sql query based on type
				$sql = parent::searchHelper ( $name, $searchType, $table );
			} else {
				// default
				$sql = "select * from categories where ucase(name) = '" . $name . "'";
			}
			
			$category = $this->Category->query ( $sql );
			
		} else {
			$category = $this->Category->find ( 'all' );
		}
		
		// throw exception if we can't find anything.
		if ($this->Category->getAffectedRows () === 0) {
			throw new NotFoundException ( 'No disease categories found!' );
		}
		
		$this->set ( 'categories', $category );
	}
	
}