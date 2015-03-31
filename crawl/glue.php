<?php
// This file serves as the crawler's interface to the database.
// This way the crawler is insulated from changes to the backbone and vice versa.

const TABLENAME = "Readings";

//REQUIRED: Return the name of the table where the entries should be written into.
function get_dst_table() {
	return TABLENAME;
}

//REQUIRED: a flag as to whether to use the row index for a station as its DB key when generating INSERT statements.
//	If this fcn returns true, the row index in the html table (starting at 1!) will serve as PK. 
//	If this fcn returns false, the next fcn must be implemented.
function use_row_index_for_stations() {
	return true;
}

 
///OPTIONAL: This function should return the DB key associated with a station.
function get_station_key($name) {
	//Optional - TODO - Query the locations table to find the primary key of a station given its name. 
	//This stub will return the name as-is.
	return $name;
}


//REQUIRED: a flag as to whether to use the row index for a station as its DB key when generating INSERT statements.
//	If this fcn returns true, the row index in the html table (starting at 1!) will serve as PK. 
//	If this fcn returns false, the next fcn must be implemented.
function use_col_index_for_chemicals() {
	return true;
}

///OPTIONAL: This function should return the DB key associated with a station.
function get_chemical_key($name) {
	//Optional - TODO - Query the chemical table to find the primary key of a chemical given its name. 
	//This stub will return the name as-is.
	return $name;
}


//REQUIRED: a flag as to whether to generate INSERT statements if there is no value in the table.
//If this returns true, the value for the corresponding INSERT will be NULL.
function insert_nulls() {
	//Based on the table definition I've seen, this should be false.
	return false;
}

//REQUIRED: This function will be called with each SQL statement generated by the crawler.
//The statement will be in the form INSERT INTO Tblname VALUES (station-id, chemical-id, timestamp, value)
//
//WARNING: the provided string is NOT guarded against SQL injection, but that should never be an issue in this context.
function run_sql($sql_stmt) {
	//TODO: Open a SQL connection and run the statement.
	//Testing impl: write to a file
	file_put_contents("sql_log.sql", $sql_stmt . "\r\n", FILE_APPEND);
}