<?php
// ************SETTINGS***********************
// This page sets all of the needed Z3950 and Stack View configurations necessary to run your Stack View instance
// Here are a few notes about the below settings
// $eventInfo -- Do not edit
// $eventInfo['stackviewRecords'] -- Do not edit
// $eventInfo['callNums'] -- Do not edit
// $eventInfo['Z3950server'] -- Server URL with port and database name -- Example: $eventInfo['server'] = "elibrary.wayne.edu:210/innopac". Do not prepend your $eventInfo['Z3950server'] with http://
// $eventInfo['syntax'] -- Record Syntax. WSU uses opac to retrieve a MARC record and associated holding information.
// 						-- Change according to what your Z3950 service supports. Other syntaxes include usmarc, sutrs, xml, etc
// $eventInfo['attribute'] -- Bib-1/Use attribute; default is 16/LC call number, as WSU Libraries use LC and sorted results represent what is found on the physical shelves
// 						   -- Other Call Numbers could be 13 - Dewey; 17 - NLM; 18 - NAL; 19 - MOS
// 						   -- Consult irspy.indexdata.com for more access points and ones that correspond with your Z3950 instance
// $hidden['element'] -- Edit if needed, otherwise leave blank
// $hidden['username'] -- Edit if needed, otherwise leave blank
// $hidden['group'] -- Edit if needed, otherwise leave blank
// $hidden['password'] -- Edit if needed, otherwise leave blank
// $eventInfo['range'] -- Sets number and order of results for your Z3950 records, which then organizes your stack view shelf; set for 30 results, with the record searched for displayed in the middle of the results (i.e. 15th result)
// $eventInfo['recordLink'] -- URL Link to MARC record
// 							-- Edit to allow your users to a search in your catalog for a selected record.
// 							-- If you have a more exact way of pinpointing your record (perhaps a permanent url is in your MARC record), feel free to update the code accordingly
// 							-- Regardless of your URL, YOU MUST include the variable $query into link below;
// 							-- $query is set by the $eventInfo['attribute'], so for example, if you set sort_by to LC Call Numbers, your $query would be an individual call number and you would make a search below for an LC Call Number.
// 							-- Example using Wayne State University's millennium catalog and assuming an LC Call Number search: $eventInfo['recordLink'] = "http://elibrary.wayne.edu/search/?searchtype=c&searcharg=$query";
// HOW TO DEBUG
// Errors should show through on your stackview page.
// In Firefox/Firebug console, Google Developer Tools console, or the console of your choice, excluding the $hidden[] variables, you can find all of the below settings plus any returned results (and associated errors) in the obj variable.
// Simply type obj (and press enter/return) in the console to see this data.

$eventInfo = array();
$eventInfo['stackviewRecords'] = array();
$eventInfo['callNums'] = array();

$eventInfo['Z3950server'] = "elibrary.wayne.edu:210/innopac";
// $eventInfo['Z3950server'] = "lsu.louislibraries.org:5205/unicorn";
// $eventInfo['Z3950server'] = "z3950.lib.umich.edu:210/miu01_pub";
$eventInfo['syntax'] = "opac"; 
$eventInfo['attribute'] = 16;
$hidden['element'] = "";
$hidden['username'] = "";
$hidden['group'] = "";
$hidden['password'] = "";

$eventInfo['range'] = array(
        "number" => 30,
        "position" => 15,
        "stepSize" => 0
    );

$eventInfo['recordLink'] = "http://elibrary.wayne.edu/search/?searchtype=c&searcharg=$query";

?>
