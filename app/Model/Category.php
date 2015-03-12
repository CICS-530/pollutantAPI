<?php
/**
* Category.php
*
* Represents the category table stored in the database.
* Only thing that this table stores is the category name and ID.
*
* It has a many-to-many relationship with the Disease model, where
* many diseases can belong in many categories, and many categories
* have many diseases.
*
*
* The hasAndBelongsToMany array makes this model return an array
* with ALL it's associated diseases, so you will have to filter
* out the result (as in, strip away the associated diseases if you
* don't need them).
*/

class Category extends AppModel {
	public $useTable = 'Categories';
	public $hasAndBelongsToMany = array(
			'Disease' =>
				array(
					'className' => 'Disease',
					'joinTable' => 'Categories_Diseases',
					'foreignKey' => 'category_id',
					'associationForeignKey' => 'diseases_id'
					)
		);

	// we set this so we don't have to return the associated
	// disease data unless we want to.
	public $actsAs = array('Containable'); 
	
	public $hasMany = array('CategoryDiseases');
}