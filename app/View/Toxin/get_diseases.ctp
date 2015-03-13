<?php
	$jsonArray = array();
	$jsonArray['toxin'] = $entireArray['Toxin'];

	$diseaseArray = array();
	foreach($entireArray['Disease'] as $disease) {
		$diseaseDetail = array();
		$diseaseDetail['name'] = $disease['name'];
		$diseaseDetail['notes'] = $disease['notes'];
		$diseaseDetail['evidence_str'] = $disease['DiseasesToxin']['evidence_strength'];

		$diseaseArray[] = $diseaseDetail;
	}
	$jsonArray['diseases'] = $diseaseArray;

	echo json_encode($jsonArray);
