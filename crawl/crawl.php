<?php

// DOM parser
include("simple_html_dom.php");

// Interface to the database. See comments there for the required functionality.
include("glue.php");

function convert_to_utc($time_str) {
	$BC_TZ = "America/Vancouver";
	$dt = new DateTime($time_str, new DateTimeZone($BC_TZ));
	$dt->setTimeZone(new DateTimeZone("UTC"));
	return $dt->getTimeStamp(); //Get Unix time. We could also return a string cuz dynamic typing etc.
}

$useLocal = false;
$LOCAL_FILE_COPY = "page.html";
$PAGE_URL = "http://envistaweb.env.gov.bc.ca/DynamicTable.aspx?G_ID=155";

if ($useLocal)
{
	//Read from local copy
	$f = fopen($LOCAL_FILE_COPY, 'r');
	$data = fread($f, 1E6);
	fclose($f);
} else
{
	//WARNING: this requires allow_url_fopen=On  in php.ini
	$f = fopen($PAGE_URL, 'r');
	//fread doesn't work (see man page on php.com for explanation)
	$data = stream_get_contents($f);
	fclose($f);
}

$html = str_get_html($data);
// The html uses a lot of nested tables. Fortunately, we only need the one that has an ID explicitly set: 
$polTbl = $html->find("table[id=C1WebGrid1]",0);
if (! $polTbl) {
	die("Error in CRAWL.PHP: Pollutant table was not found. Either the page failed to load, or the underlying HTML structure has changed.");
}

const ROW_OFFSET = 2; //first two rows are headers
const COL_OFFSET = 2; //first two cols are "stn name" and "date/time"
$TABLE = get_dst_table();

$row_itr = 0;
while(true) { //loop over rows
	$row = $polTbl->find("tr", $row_itr + ROW_OFFSET);
	if (! $row)
		break;
	
	if (use_row_index_for_stations()) {
		$stn_key = $row_itr + 1;
	} else {
		$stn_name  = $row->find("td",0)->find("a",0)->innertext();
		$stn_key = get_station_key(trim($stn_name));
	}
	
	$date_time = $row->find("td",1)->find("div",0)->innertext();
	$date_time = convert_to_utc(trim($date_time));
	 
	$col_itr = 0;
	while(true) { //loop over cols
		
		$value = $row->find("td",$col_itr + COL_OFFSET);
		if (! $value)
			break;
		
		//
		if (use_col_index_for_chemicals()) {
			$chem_key = $col_itr + 1;
		} else {
			$chem_name = $polTbl->find("tr", 0)->find("td", $col_itr + COL_OFFSET)->find("div",0)->innertext();
			$chem_key = get_chemical_key(trim($chem_name));
			//I should probably cache this, but too lazy...
		}
		
		$value = $value->find("div",0)->innertext();
		
		if ($value)
			$value = trim($value);
		
		if ($value && $value != "&nbsp;") { //not always there
			$SQL = "INSERT INTO `$TABLE`(`location_id`, `chemical_id`, `date`, `value`) VALUES ($stn_key, $chem_key, $date_time, $value);";
		} else if (insert_nulls()){
			$SQL = "INSERT INTO `$TABLE`(`location_id`, `chemical_id`, `date`, `value`) VALUES ($stn_key, $chem_key, $date_time, NULL);";
		} else {
			unset($SQL);
		}
		if (isset($SQL))
			run_sql($SQL);
		
		$col_itr++;
	} //end column loop
	$row_itr++;
} //end row loop