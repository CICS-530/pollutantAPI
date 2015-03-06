<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	
	public function beforeFilter() {
		// only get requests allowed
		$this->request->allowMethod(array('get', 'GET'));
	}

	public function beforeRender() {
		$this->layout='';
		$this->response->type("application/json");
	}
	
	public function searchHelper($name, $type, $table) {
		
		switch ($type) {
		
			case "equals":
				$sql = 	"select * from " . $table . " where ucase(name) = '".$name."'";
				break;
		
			case "contains":
				$sql = "select * from " . $table . " where ucase(name) like '%" . $name . "%' order by name";
				break;
					
			case "startswith":
				$sql = 	"select * from " . $table . " where ucase(name) like '".$name . "%' order by name";
				break;
					
			case "endswith":
				$sql = 	"select * from " . $table . " where ucase(name) like '%" . $name . "' order by name";
				break;
		
			default:
				$sql = 	"select * from " . $table . " where ucase(name) = '".$name."'";
				break;
		}

		return $sql;
		
		
	}
	
	public function searchDiseaseToxinHelper($name, $type) {
	
		switch ($type) {
		
			case "equals":
				$wcName = " = '".$name."' ";
				break;
		
			case "contains":
				$wcName = " like '%".$name."%' ";
				break;
					
			case "startswith":
				$wcName = " like '".$name."%' ";
				break;
					
			case "endswith":
				$wcName = " like '%".$name."' ";
				break;
		
			default:
				$wcName = " = '".$name."' ";
				break;
		}
		
		
		$sql = "SELECT 
					  diseases.name,
					  toxins.name,
					  diseases_toxins.evidence_strength
					   
				FROM 
					  diseases_toxins
					  INNER JOIN diseases
					  ON diseases_toxins.disease_id = diseases.id
					  INNER JOIN toxins
					  ON diseases_toxins.toxin_id = toxins.id
				WHERE
   					  ucase(diseases.name)" . $wcName .
					  "ORDER BY diseases.name, diseases_toxins.evidence_strength DESC";
		
		return $sql;	
	
	}
}
