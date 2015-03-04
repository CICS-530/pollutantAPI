<?php
	$jsonArray = array();
	foreach($toxins as $toxin) {
		$jsonArray[] = $toxin;
	}
	echo json_encode($jsonArray);