<?php 
/**
*
* Associated date functions
*
*/

class DateLib {

	/**
	* Given a UNIX timestamp, reset it to midnight.
	* Returns the UNIX timestamp set to midnight of that day.
	*/
	static function normalizeDate($timestamp) {
		$dateObj = new DateTime();
		$dateObj->setTimestamp($timestamp);

		$dateObj->setTime(00, 00, 00);

		return $dateObj->format('U');
	}

	/**
	*
	* Given a date offset and a unix timestamp
	* Return a unix timestamp representing the earliest date
	* to start looking for results.
	*/
	static function oldestDate($offset, $timestamp) {
		$dateObj = new DateTime();
		$normalizedDate = DateLib::normalizeDate($timestamp);
		$dateObj->setTimestamp($normalizedDate);
		$dateObj->modify("-" . $offset ."day");
		return $dateObj->format('U');
	}

	/**
	*
	* Given a date offset and a unix timestamp
	* Return a unix timestamp representing the latest date 
	* to STOP looking for results.
	*/
	static function youngestDate($offset, $timestamp) {
		$oldestDate = DateLib::oldestDate($offset, $timestamp);
		$dateObj = new DateTime();
		$dateObj->setTimestamp($oldestDate);
		$dateObj->modify("+1 day");
		return $dateObj->format('U');
	}
}