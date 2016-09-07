<?php
ob_start() ;

  ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    // or however you get the path
     
 $zipname = dirname(__FILE__)."/../evidence/".$_POST['fileName'];
$zip = new ZipArchive;
$zip->open($zipname, ZipArchive::CREATE);
foreach ($files as $file) {
  $zip->addFile($file);
}
header('Content-Type: application/zip');
header('Content-disposition: attachment; filename='.$zipname);
header('Content-Length: ' . filesize($zipname));
readfile($zipname);
$zip->close();
    ob_end_flush();
 ?>

