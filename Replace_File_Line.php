#!/usr/bin/php
<?php
//
// This shell script loops through a directory and replaces a line within the same file in each 
// directoy with both the original line and an additional line
//

//
// Build Base Directories to search
//
$base_directory = "/home/web/accounts/";

$files = scandir($base_directory);

//any directories that should be ignored
$exclude_files = "";
$exclude_files[] = ".";
$exclude_files[] = "..";
$exclude_files[] = "global";
$exclude_files[] = "ZipCodes";

$account_list = array_diff($files,$exclude_files);

//loop through all of the included directories
foreach($account_list as $key => $account)
{ 
	$file = $base_directory.$account."/application/Tracking/menu.xml";	//file path to search
	$data = file($file); // reads an array of lines
	
	$found = false;
	$data = array_map('replace_a_line',$data);

	//print out base directories which sucessful replacement is not made
   	if($found == false){
	   	echo $account.PHP_EOL;
   	}

	file_put_contents($file, implode('', $data));
}

//function to replace the string with return object
function replace_a_line($data) {
	global $found;
	//check for string
   	if (stristr($data, '<item name="CJAD MHI Audit" document="MHIInternal"/>')) {
		$found = true;
     	return '<item name="CJAD MHI Audit" document="MHIInternal"/>'.PHP_EOL.'<item name="CJAD SATF Audit" document="CJADSATFAuditForm"/>'.PHP_EOL;// return new string
   	}
   return $data;
}