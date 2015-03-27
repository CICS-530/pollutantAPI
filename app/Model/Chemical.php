<?php

/**
 * 
 * The Chemical Model.
 * Represents each chemical our database is capable of storing
 * 
 */
 
 class Chemical extends AppModel {
     public $belongsTo = "Reading";
 }