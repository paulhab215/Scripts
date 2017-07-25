#!/usr/bin/php
<?php
//
// Build Directories to search
//
$base_directory = "/home/web/";

$files = scandir($base_directory);p

//any directory that should be ignored
$exclude_files = "";
$exclude_files[] = ".";
$exclude_files[] = "..";
$exclude_files[] = ".svn";
$exclude_files[] = "routines";

$account_list = array_diff($files,$exclude_files);

//loop through all of the included directories
foreach($account_list as $key => $directory)
{ 
  echo "processing $directory".PHP_EOL; 
  $file = $base_directory.$directory."/data/file1.php";

  $file2 = $base_directory.$directory."/data/file2.php";
  passthru("svn mv $file $file2");  // keep svn properties
  passthru("svn revert $file");
}
