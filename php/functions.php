<?php

////////////////////////////////////////////////////////////////
// BEGIN Z3950
////////////////////////////////////////////////////////////////
function Z3950Router($yazCall,$query) {
// this function either retrieves a range of results (according to the BIB-1 value set in settings.php) or searches for the MARC records associated with this range
include 'settings.php';
    if ($yazCall == "yaz_scan") {
        $eventInfo['callNums'] = Z3950Call($yazCall,$query);
        return $eventInfo['callNums'];       
    }
    elseif ($yazCall == "yaz_search") {
     $eventInfo['Z3950Results'] = Z3950Call($yazCall,$query);
     return $eventInfo['Z3950Results'];
}
}

////////////////////////////////////////////////////////////////
// Z3950 PROCESSING
////////////////////////////////////////////////////////////////
function Z3950Call($yazCall,$query) {
// this function runs the initial Z3950 call framework and the more specific type of call needed (scan versus search)
    include 'settings.php';
    //if a space is found in the search terms aka, user has done a multiple word search, put it in quotes
    if (strpos($query, ' ') !== false)
    {
        $query = '"'. $query .'"';
    }
    // INITIAL, BASIC YAZ SETUP
    // default search
    if (empty($eventInfo['attribute'])) { $eventInfo['attribute'] = 16;}
    $search = "@attr 1=$eventInfo[attribute] $query";
    $options = array($hidden['username'], $hidden['group'], $hidden['password']);
    $session = yaz_connect($eventInfo['Z3950server'], $options);

    yaz_syntax($session, $eventInfo['syntax']);


    $errno = yaz_errno($session);
    if ($errno !== 0) {
        $eventInfo['Z3950Results'] = "Error: " . yaz_error($session) . ". Connect failed. Check your settings.<br/>";
        return $eventInfo['Z3950Results'];
    }

    if (!empty($hidden['element'])) {
        yaz_element($session, $hidden['element']);
    }
 
    // SPECIFY and RUN specific type of Z3950 query
    if ($yazCall == "yaz_scan") {
        $eventInfo['callNums'] = $eventInfo['range'] = yazScan($yazCall, $session, $search, $query);
        return $eventInfo['callNums'];
    }

    elseif ($yazCall == "yaz_search") {
        $eventInfo['parsedResults'] = yazSearch($yazCall, $session, $search, $query);
        return $eventInfo['parsedResults'];

    }
}

////////////////////////////////////////////////////////////////
// SCAN FOR CALL NUMBERS
////////////////////////////////////////////////////////////////
function yazScan ($yazCall, $session, $search, $query) {
    include 'settings.php';
        $yazCall($session, "rpn", $search, $eventInfo['range']);

    // wait blocks until the query is done
    yaz_wait();
    
    $errno = yaz_errno($session);
    if ($errno == 0) {
        $scanResult = yaz_scan_result($session);
        $scanResults = array();
        while (list($key, list($k, $term)) = each($scanResult)) {
          if (empty($k)) continue;
          $scanResults = $term;
          array_push($eventInfo['callNums'], $scanResults);
        }
    }

    else {
        $eventInfo['Z3950Results'] = "Error: " . yaz_error($session) . ". Scan failed. Check your settings.<br/>";
        return $eventInfo['Z3950Results'];
    }
    
        yaz_close($session);
    
        return $eventInfo['callNums'];
}

////////////////////////////////////////////////////////////////
// SEARCH FOR CALL NUMBERS
////////////////////////////////////////////////////////////////
function yazSearch ($yazCall, $session, $search, $query) {
    include 'settings.php';
    // specify the number of results to fetch
    yaz_range($session, 1, yaz_hits($session));
    yaz_syntax($session, $eventInfo['syntax']);
    yaz_search($session, "rpn", $search);
    // wait blocks until the query is done
    yaz_wait();

    $errno = yaz_errno($session);
    if ($errno == 0) {
        // yaz_hits returns the amount of found records
        if (yaz_hits($session) >! 0){
            return $eventInfo['parsedResults'];
        }
        else {
            for ($p = 1; $p <= yaz_hits($session); $p++) {
            $result = yaz_record($session, $p, "xml");

            // Process all of the MARC Records
            $result = utf8_encode($result);
            $xml = simplexml_load_string($result);
            $XMLArray = XMLtoArray($xml);
            $eventInfo['parsedResults'] = svRecordCreator($XMLArray, $query, $eventInfo);
            return $eventInfo['parsedResults'];
            }
        }
    }

    else {
        $eventInfo['Z3950Results'] = "Error: " . yaz_error($session) . ". Search failed. Check your settings.<br/>";
        return $eventInfo['Z3950Results'];
    }

    yaz_close($session);
}

////////////////////////////////////////////////////////////////
// Z3950 PROCESSING AFTER SUCCESFUL SEARCH
////////////////////////////////////////////////////////////////
function XMLtoArray ( $xmlObject, $out = array () ) {
    // place raw xml into array
    if (isset($xmlObject)) {
        foreach ( json_decode(json_encode($xmlObject), true) as $index => $node )
            $out['fullRecords'][$index] = ( is_object ( $node ) ) ? XMLtoArray ( $node ) : $node;
        return $out;
    }
    else {
        $out = '';
         return $out;
    }
}

function svRecordCreator($MARC, $query, $eventInfo) {
    // Create Stack View record for each MARC record
    if (isset($MARC['fullRecords'])) {
        foreach ($MARC['fullRecords']['bibliographicRecord']['record']['datafield'] as $record){
            switch ($record['@attributes']['tag']) {
                case "100":
                    $MARC['stackviewRecords']['creator'] = svSub1($record);
                    break;
                case "245":
                    $MARC['stackviewRecords']['title'] = svSub1($record);
                    break;
                case "260":
                    $temp = svSub1($record);
                    $MARC['stackviewRecords']['pub_date'] = substr(intval(trim(preg_replace('*[^0-9]*', '', $temp))), 0, 4);
                    break;
                case "300":
                    $temp = svSub1($record);
                    $MARC['stackviewRecords']['measurement_page_numeric'] = svSub2($temp);
                    $height_cm = trim(preg_replace('*[^\s]+[^0-9]*', '', trim(preg_replace('*[^0-9 ]*', '', $temp))));
                    $MARC['stackviewRecords']["measurement_height_numeric"] = intval($height_cm);
                    break;
                default:
                    continue;
                    break;
            }
            if (isset($MARC['stackviewRecords']['title']) === FALSE ) {
                switch ($record['@attributes']['tag']) {
                    case "110":
                        $MARC['stackviewRecords']['title'] = svSub1($record);
                        break;
                    case "111":
                        $MARC['stackviewRecords']['title'] = svSub1($record);
                        break;
                    default:
                        continue;
                        break;
                }
            }
        } //ends foreach
    } //ends isset
    $MARC['fullRecords']['link'] = $eventInfo['recordLink'];
    $MARC['recordLinks'] = $eventInfo['recordLink'];

   $stackviewNames = array ("title", "creator", "measurement_height_numeric", "measurement_page_numeric", "pub_date"); 
   foreach ($stackviewNames as $k => $v){
    if (isset($MARC['stackviewRecords'][$v]) == FALSE){$MARC['stackviewRecords'][$v] = "NA";};
    }

    //Adding in shelfrank manually until each record shows usage stats
    $MARC['stackviewRecords']["shelfrank"] = 40;
    $MARC['stackviewRecords']['link'] = "#";
    return $MARC;

  }

function svSub1($record) {
    if (sizeof($record['subfield']) > 1) {
        return implode(" ", $record['subfield']);
    }
    else {
        return $record['subfield'];
    }
}

function svSub2($temp) {
    preg_match('/(\d*\sp.)/', $temp, $matches);
    if (isset($matches[0])) {
        trim(preg_replace('*[^0-9]*', '', $matches[0]));
        return intval(trim(preg_replace('*[^0-9]*', '', $matches[0])));
    }
    else {
        return 20;
    }
}

////////////////////////////////////////////////////////////////
// OTHER UTILITIES
////////////////////////////////////////////////////////////////
function cleaner(){
// CLEANS up temp json file inside /json/temp folder
// Define the folder to clean
// (keep trailing slashes)
$folder = '../json/temp/';
 
// Files to check
$files = '*.json';
 
// minutes before files are up for deletion
$expireTime = 1; 
 
// Find all files of the given file type
foreach (glob($folder . $files) as $fileName) {
 
    // Read file creation time
    $fileCreationTime = filectime($fileName);
 
    // Calculate file age in seconds
    $fileAge = time() - $fileCreationTime; 
 
    // Is file older than 1 minute?
    if ($fileAge > ($expireTime * 60)){
        unlink($fileName);
    }
}
}

?>