<?php

	 // FILE:          catalog.php
	 // TITLE:         Stackview Z3950 Script
	 // AUTHOR:        Cole Hudson, WSULS Digital Publishing Librarian
	 // CREATED:       August 2013
	 //
	 // PURPOSE:
	 // This file receives data from stackview viewer (by default, in the form of an lc call number) and uses a Z3950 and associated calls to return a range of range of related texts found the physical stacks
	 //

require_once('functions.php');
require_once('settings.php');
// ****USE THESE************
// Uncomment the below (change $query to whatever you've configured) then uncomment the other non-query variables.
// $query = 'M39';
// $callback = '';
// $count = '';
// $offset = 0;
// *****END OF USE THESE**********

// Comment out the below variables when testing with the above
$query = $_POST['query'];
$callback = $_POST['callback'];
$offset = $_POST['start'];
$count = $_POST['limit'];

// You don't need to mess with the code below here
$eventInfo = Z3950($eventInfo, $query);
if (!isset($eventInfo['error_response'])) {
	$records = stackView($eventInfo, $callback, $count, $offset);
	$eventInfo = returnData($eventInfo, $records);
}
$json = json_encode($eventInfo);
echo $json;


function Z3950($eventInfo, $query) {
		// Querying begins
		if (isset($query)) {
			$eventInfo['callNumber'] = $query;
			$eventInfo['callNums'] = Z3950Router("yaz_scan",$eventInfo['callNumber']);
			// bubble up any errors
			if (is_array($eventInfo['callNums']) === false && substr($eventInfo['callNums'], 0, 5) === "Error") { $eventInfo['error_response'] = $eventInfo['callNums']; return $eventInfo;}

			$eventInfo['fullRecords'] = array();
			$eventInfo['recordLinks'] = array();
			foreach($eventInfo['callNums'] as $query){
				// fixes whitespace
				if (strpos($query, ' ') !== false)
				{
					$query = urlencode($query);
				}
				$eventInfo['Z3950Results'] = Z3950Router("yaz_search",$query);
				// bubble up any errors
				if (is_array($eventInfo['Z3950Results']) === false && substr($eventInfo['Z3950Results'], 0, 5) === "Error") { $eventInfo['error_response'] = $eventInfo['Z3950Results']; return $eventInfo;}

				if(!empty($eventInfo['Z3950Results']['stackviewRecords'])) { array_push($eventInfo['stackviewRecords'], $eventInfo['Z3950Results']['stackviewRecords']); }
				if(!empty($eventInfo['Z3950Results']['fullRecords'])) { array_push($eventInfo['fullRecords'], $eventInfo['Z3950Results']['fullRecords']); }
				if(!empty($eventInfo['Z3950Results']['recordLinks'])) { array_push($eventInfo['recordLinks'], $eventInfo['Z3950Results']['recordLinks']); }
			}
		}
		else {
				$eventInfo['error_response'] = "Error: enter valid search query";
		}
				unset($eventInfo['Z3950Results']);
				$eventInfo['recordLinks'] = array_reverse($eventInfo['recordLinks']);
				return $eventInfo;
}

function stackView ($eventInfo, $callback, $count, $offset) {
		//now check results number, set it to the count variable and decide what the start value should be
		$last = $offset + 10;

		//now create json which concatenates start position, limit of results, number found, and the records themselves
		if (count($eventInfo['stackviewRecords']) == 0 || $last == -1) {
			return $records = json_encode('({"start": "-1", "num_found": "0", "limit": "0", "docs": ""})');
		}

		elseif (count($eventInfo['stackviewRecords']) >= 1) {
			return $records = json_encode('{"start": "' . -1 . '", "limit": "' . 30 . '", "num_found": "' . count($eventInfo['stackviewRecords']) . '", "docs": ' . json_encode($eventInfo['stackviewRecords']) . '}');
		}

		else {
			// NOTE: start usually equals $last but to disable infinite scroll, start was set to -1
			return $records = json_encode('({"start": "' . -1 . '", "limit": "' . $count . '", "num_found": "' . count($eventInfo['stackviewRecords'])  . '", "docs": ' . json_encode($eventInfo['stackviewRecords']) . '})');
		}
}

function returnData($eventInfo, $records) {
// Make json file and send marc contents back to the index page
			$r = rand();
			$tmpfname = "$r.json";
			$tmpdir = "../json/temp/";
			$tmpfile = $tmpdir.$tmpfname;
			$file_handle = fopen($tmpfile, "w");
			$eventInfo['tempfile'] = $tmpfname;
			$file_contents = $records;
			fwrite($file_handle, trim(stripslashes($file_contents), '"'));
			fclose($file_handle);
			return $eventInfo;
}


//run temp file cleaner
cleaner();

?>
