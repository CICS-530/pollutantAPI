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
	* If null, return all, otherwise return the Toxin specified
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
	 *
	 * searches for all categories by name and returns a json array
	 * containing their ids and names.
	 *
	 * Searches need to be exact; no wildcards are allowed here!
	 *
	 * e.g.
	 * http://localhost:8000/Toxin/search/name
	 * 
	 *
	 * Check if the parameters passed in is null or not.
	 * If null, return all, otherwise return the Toxin according to the type of search
	 *
	 *
	 * If nothing was found, an error 404 should be returned.
	 */
	function search($name = null) {
		
		// set recursive to level -1 to stop it from joining tables
		$this->Toxin->recursive = - 1;
		

		if ($name != null) {
			$toxin = $this->Toxin->findByName($name);
		}
		
		// throw exception if we can't find anything.
		if ($this->Toxin->getAffectedRows () === 0) {
			throw new NotFoundException ( 'No toxins found!' );
		}
		
		$this->set ( 'toxins', $toxin );
	}


	/*
	*
	* Find the associated diseases for a certain toxin.
	*
	*
	*/
	function getDiseases($name = null) {
		$this->Toxin->recursive = 1;

		if ($name != null) {
			$toxin = $this->Toxin->findByName($name);
		}

		if ($this->Toxin->getAffectedRows() === 0) {
			throw new NotFoundException ('No toxins found!');
		}

		$this->set('entireArray', $toxin);
	}
	
}
