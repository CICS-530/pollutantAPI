<?php
/**
*
* DiseasestoxinToxinController.php
*
* The controller for the DiseasestoxinToxin model.
* Presents basic information about the Diseasestoxin and the Toxins associated.
* Does NOT return a view.
*/


// Add this line (sort of like a java import statement)
// or a "using namespace::std" in C++.
App::uses('AppController', 'Controller');
App::uses('NotFoundException', 'Exception');


class DiseasetoxinController extends AppController {
	
	
	/**
	 * searches for all diseasetoxins and associated toxins by diseasetoxin name and returns a json array
	 * containing their names.
	 *
	 * This is a wildcard search with equals(default), contains, startswith, endswith
	 *
	 * e.g.
	 * http://localhost:8000/diseasetoxin/search
	 * http://localhost:8000/diseasetoxin/search?name=Acute%20tubular%20necrosis
	 * http://localhost:8000/diseasetoxin/search?name=Acute%20tubular%20necrosis&type=equals
	 * http://localhost:8000/diseasetoxin/search?name=A&type=startswith
	 * http://localhost:8000/diseasetoxin/search?name=A&type=endswith
	 * http://localhost:8000/diseasetoxin/search?name=A&type=contains
	 *
	 * Check if the parameters passed in is null or not.
	 * If null, return all, otherwise return the name according to the type of search
	 *
	 *
	 * If nothing was found, an error 404 should be returned.
	 */
	function search() {
		
		// set recursive to level -1 to stop it from joining tables
		$this->Diseasetoxin->recursive = - 1;
		
		// check if we have name parameter else display all results
		if (isset ( $_REQUEST ['name'] )) {
			$name = strtoupper ( $_REQUEST ['name'] );
			
			// check if the search type is passed otherwise run a default(equals) search
			if (isset ( $_REQUEST ['type'] )) {
				$searchType = strtolower ( $_REQUEST ['type'] );
				
				// get the sql query based on type
				$sql = parent::searchDiseaseToxinHelper ( $name, $searchType);
			} else {
				// default
				$sql = parent::searchDiseaseToxinHelper ( $name, $searchType);
			}
			
			$diseasetoxins = $this->Diseasetoxin->query ( $sql );
		} else {
			$sql = parent::searchDiseaseToxinHelper ( null, "contains");
			$diseasetoxins = $this->Diseasetoxin->query ( $sql );
		}
		
		// throw exception if we can't find anything.
		if ($this->Diseasetoxin->getAffectedRows () === 0) {
			throw new NotFoundException ( 'No diseasetoxins found!' );
		}
		
		$this->set ( 'diseasetoxins', $diseasetoxins);
	}
}
