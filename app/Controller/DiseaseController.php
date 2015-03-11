<?php
/**
*
* DiseaseController.php
*
* The controller for the Category model.
* Presents basic information about the category.
* Does NOT return a view.
*/


// Add this line (sort of like a java import statement)
// or a "using namespace::std" in C++.
App::uses('AppController', 'Controller');
App::uses('NotFoundException', 'Exception');


class DiseaseController extends AppController {
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
		$this->Disease->recursive = -1;
		// check if we have any URL paramenters.
		// query depends on whether or not we have an ID or not.
		if ($this->params['pass'] != null) {
			$id = $this->params['pass'][0];
			$disease = $this->Disease->findById($id);		
		} else {
			$disease = $this->Disease->find('all');	
		}

		// throw exception if we can't find anything.
		if ($this->Disease->getAffectedRows() === 0) {
			throw new NotFoundException('No diseases found!');
		}

		$this->set('diseases', $disease);
	}
	
	/**
	 *
	 * searches for all diseases by name and returns a json array
	 * 
	 *
	 * Searches need to be exact; no wildcards are allowed here!
	 *
	 * e.g.
	 * http://localhost:8000/disease/search/name
	 * 
	 *
	 * Check if the parameters passed in is null or not.
	 * If null, return all, otherwise return the disease according to the type of search
	 *
	 *
	 * If nothing was found, an error 404 should be returned.
	 */
	function search($name = null) {
		
		// set recursive to level -1 to stop it from joining tables
		$this->Disease->recursive = - 1;
		

		if ($name != null) {
			$disease = $this->Disease->findByName($name);
		} else {
			$disease = $this->Disease->find('all');
		}
		
		// throw exception if we can't find anything.
		if ($this->Disease->getAffectedRows () === 0) {
			throw new NotFoundException ( 'No diseases found!' );
		}
		
		$this->set ( 'diseases', $disease );
	}

	/**
	* Get the associated toxins AS WELL AS the disease information.
	*
	*/
	function getToxins($name = null) {
		// leave reursive level to 2.

		$this->Disease->recursive = 2;

		$disease = $this->Disease->findByName($name); 

		if ($this->Disease->getAffectedRows() === 0) {
			throw new NotFoundException ('No diseases found!');
		}

		$this->set ('diseases', $disease);
	}
	
}
