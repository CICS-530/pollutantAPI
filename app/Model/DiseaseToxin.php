<?php
/**
* DiseaseToxin.php
*
* Similar to the CategoryDisease model, bridges the relationship
* between the disease and toxin models. Does NOT use the HATBM 
* (Has And Belongs To Many) association found in cakePHP because
* we need to add an extra column (the strength of the relationship)
* to the table, so we need to make a full-blown model.
* 
*/

/*class DiseaseToxin extends AppModel {
	public $useTable = 'Diseases_Toxins';
	public $belongsTo = array('Disease', 'Toxin');
}*/


App::uses('AppModel', 'Model');
/**
 * DiseaseToxin Model
 *
 * @property Disease $Disease
 * @property Toxin $Toxin
*/
class DiseaseToxin extends AppModel {
	
	public $useTable = 'Diseases_Toxins';

	/**
	 * Display field
	 *
	 * @var string
	 */
	public $displayField = 'id';

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public $validate = array(
			'id' => array(
					'notEmpty' => array(
							'rule' => array('notEmpty'),
							//'message' => 'Your custom message here',
							//'allowEmpty' => false,
							//'required' => false,
							//'last' => false, // Stop validation after this rule
							//'on' => 'create', // Limit validation to 'create' or 'update' operations
					),
			),
			'disease_id' => array(
					'numeric' => array(
							'rule' => array('numeric'),
							//'message' => 'Your custom message here',
							//'allowEmpty' => false,
							//'required' => false,
							//'last' => false, // Stop validation after this rule
							//'on' => 'create', // Limit validation to 'create' or 'update' operations
					),
			),
			'toxin_id' => array(
					'numeric' => array(
							'rule' => array('numeric'),
							//'message' => 'Your custom message here',
							//'allowEmpty' => false,
							//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
					),
			),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

	/**
	 * belongsTo associations
	 *
	 * @var array
	*/
	public $belongsTo = array(
			'Disease' => array(
					'className' => 'Disease',
					'foreignKey' => 'disease_id',
					'conditions' => '',
					'fields' => '',
					'order' => ''
			),
			'Toxin' => array(
					'className' => 'Toxin',
					'foreignKey' => 'toxin_id',
					'conditions' => '',
					'fields' => '',
					'order' => ''
			)
	);
}
