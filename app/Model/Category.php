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
*/

class Category extends AppModel {
	// Fill this in!
	public $useTable = 'Categories';
	public $hasAndBelongsToMany = array(
			'CategoryDisease' =>
				array(
					'className' => 'Disease',
					'joinTable' => 'Categories_Diseases',
					'foreignKey' => 'category_id',
					'associationForeignKey' => 'diseases_id'
					)
		);
}