<?php
/**
*
* ToxinController.php
*
* The controller for the Toxin model.
* Presents basic information about the toxin.
* Does NOT return a view.
*/


// Add this line (sort of like a java import statement)
// or a "using namespace::std" in C++.
App::uses('AppController', 'Controller');
App::uses('NotFoundException', 'Exception');


class ToxinController extends AppController {
	/**
	*
	* Gets ALL toxin and returns a json array
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
		$this->Toxin->recursive = -1;
		// check if we have any URL paramenters.
		// query depends on whether or not we have an ID or not.
		if ($this->params['pass'] != null) {
			$id = $this->params['pass'][0];
			$toxin = $this->Toxin->findById($id);		
		} else {
			$toxin = $this->Toxin->find('all');	
		}

		// throw exception if we can't find anything.
		if ($this->Toxin->getAffectedRows() === 0) {
			throw new NotFoundException('No toxins found!');
		}

		$this->set('toxins', $toxin);
	}
	
	/**
	 * searches for all toxins by name and returns a json array
	 * containing their ids and names and notes.
	 *
	 * This is a wildcard search with equals(default), contains, startswith, endswith
	 *
	 * e.g.
	 * http://localhost:8000/toxin/search
	 * http://localhost:8000/toxin/search?name=acetone
	 * http://localhost:8000/toxin/search?name=acetone&type=equals
	 * http://localhost:8000/toxin/search?name=A&type=startswith
	 * http://localhost:8000/toxin/search?name=A&type=endswith
	 * http://localhost:8000/toxin/search?name=A&type=contains
	 *
	 * Check if the parameters passed in is null or not.
	 * If null, return all, otherwise return the name according to the type of search
	 *
	 *
	 * If nothing was found, an error 404 should be returned.
	 */
	function search() {
		
		// set recursive to level -1 to stop it from joining tables
		$this->Toxin->recursive = - 1;
		
		// check if we have name parameter else display all results
		if (isset ( $_REQUEST ['name'] )) {
			$name = strtoupper ( $_REQUEST ['name'] );
			
			// check if the search type is passed otherwise run a default(equals) search
			if (isset ( $_REQUEST ['type'] )) {
				$searchType = strtolower ( $_REQUEST ['type'] );
				$table = "toxins";
				// get the sql query based on type
				$sql = parent::searchHelper ( $name, $searchType, $table );
			} else {
				// default
				$sql = "select * from toxins where ucase(name) = '" . $name . "'";
			}
			
			$toxins = $this->Toxin->query ( $sql );
		} else {
			$toxins = $this->Toxin->find ( 'all' );
		}
		
		// throw exception if we can't find anything.
		if ($this->Toxin->getAffectedRows () === 0) {
			throw new NotFoundException ( 'No toxins found!' );
		}
		
		$this->set ( 'toxins', $toxins );
	}
}
