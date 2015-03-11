<?php
	
	$jsonArray = array();
	
	
	foreach($diseasetoxins as $diseasetoxin) {	
						
	   		$jsonArray[] = array(
	      	'disease' => $diseasetoxin['diseases']['name'],
	      	'toxins' => array(
	        'toxin' => $diseasetoxin['toxins']['name'],
	        'strength' => $diseasetoxin['diseases_toxins']['evidence_strength']));
	        
     }        
	
	echo json_encode($jsonArray);