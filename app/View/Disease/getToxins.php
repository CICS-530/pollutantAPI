<?php
	$jsonArray = array();
	foreach($diseases as $disease) {
		$jsonArray[] = $disease;
	}
	echo json_encode($jsonArray);