#!/usr/bin/php

<?php

//
// Build Directories to search
//
$base_directory = "/home/web/accounts/";

$files = scandir($base_directory);

//any directory that should be ignored
$exclude_files = "";
$exclude_files[] = ".";
$exclude_files[] = "..";
$exclude_files[] = ".svn";

$account_list = array_diff($files,$exclude_files);

//loop through all of the accounts minus those excluded above
foreach($account_list as $key => $account)
{ 
	$file = $base_directory.$account."/application/menu.xml";
	$data = file($file); // reads an array of lines
	$found = false; $count = 0; $deletekey = 0;

	$data = array_map('replace_a_line',$data);

	//print out to command line if an account does not print
   	if($found == false){
	   	echo $account.PHP_EOL;
   	} else{
   		unset($data[$deletekey]);
		file_put_contents($file, implode('', $data));
	}
}

//function to replace the string in menu.xml
function replace_a_line($data) {
	global $found, $count, $deletekey;
	$count = $count + 1;
	//the first is the line searching for
	//the return will replace the line with the exact lin and then end the line and paste next new line
   	if (stristr($data, '<item name="Print Screen" link="code:chronoFrame.PrintScreen();"/>')) {
		$found = true;
		$deletekey = $count;
		return '';
   	}

   return $data;
}
