<?php
	
	$jsonArray = array();
	
	
	foreach($categorydiseases as $categorydisease) {	
						
	   		$jsonArray[] = array(
	      	'category' => $categorydisease['categories']['name'],
	      	'diseases' => array(
	        'disease' => $categorydisease['diseases']['name']));
	        
     }        
	
	echo json_encode($jsonArray);