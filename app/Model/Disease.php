<?php
/**
* Disease.php
*
* Represents the disease table stored in the database.
* Only thing it stores is disease name and disease ID.
*
* It has a many to many relationship with the Category model,
* as WELL as the Toxins model.
*/

class Disease extends AppModel {
	// needs to be filled in!
	public $useTable = 'Diseases';

	public $hasAndBelongsToMany = array(
			'Category' =>
				array(
					'className' => 'Category',
					'joinTable' => 'Categories_Diseases',
					'foreignKey' => 'diseases_id',
					'associationForeignKey' => 'category_id'
					)
		);

	public $hasMany = array(			
			'DiseaseToxin' =>
				array(
					'className' => 'DiseaseToxin',
					'order' => 'DiseaseToxin.evidence_strength DESC'
					)
	    );
}