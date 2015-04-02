<?php

/**
 * 
 * The Chemical Model.
 * Represents each chemical our database is capable of storing.
 * Each chemical belongs to many readings.
 */
 
 class Chemical extends AppModel {
 	public $useTable = "Chemicals";

 	public $hasMany = "Reading";
 }