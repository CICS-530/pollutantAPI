<?php 
class AppSchema extends CakeSchema {

	public function before($event = array()) {
		return true;
	}

	public function after($event = array()) {
	}

	public $Categories = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 6, 'unsigned' => true, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	public $Categories_Diseases = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 6, 'unsigned' => true, 'key' => 'primary'),
		'diseases_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 6, 'unsigned' => true, 'key' => 'index'),
		'category_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 6, 'unsigned' => true, 'key' => 'index'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'category_id' => array('column' => 'diseases_id', 'unique' => 0),
			'diseases_id' => array('column' => 'category_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	public $Diseases = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 6, 'unsigned' => true, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'notes' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 1000, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	public $Diseases_Toxins = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 6, 'unsigned' => true, 'key' => 'primary'),
		'disease_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 6, 'unsigned' => true, 'key' => 'index'),
		'toxin_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 6, 'unsigned' => true, 'key' => 'index'),
		'evidence_strength' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 1, 'unsigned' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'disease_id' => array('column' => 'disease_id', 'unique' => 0),
			'toxin_id' => array('column' => 'toxin_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	public $Toxins = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 6, 'unsigned' => true, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'cas_no' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

}
