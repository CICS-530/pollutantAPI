<?php
	$jsonArray = array();
	foreach($categories as $category) {
		$jsonArray[] = $category;
	}
	echo json_encode($jsonArray);