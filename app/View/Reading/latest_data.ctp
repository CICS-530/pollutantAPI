<?php
	$jsonArray = array();
	$jsonArray["station"] = $readings["Location"]["name"];
	$jsonArray["latitude"] = $readings["Location"]["latitude"];
	$jsonArray["longitude"] = $readings["Location"]["longitude"];
	$jsonArray["date"] = $readings["Reading"]["time"];

	$chemicals[] = array("name" => "NO2", "reading" => $readings["Reading"]["reading"]);

	$jsonArray["Chemicals"] = $chemicals;
	echo json_encode($jsonArray);