<?php
 

$file_tbl_get = dirname(__FILE__)."/main_get_app.php";
if(is_file($file_tbl_get)) require_once $file_tbl_get ;

$file_tbl_add = dirname(__FILE__)."/main_add_app.php";
if(is_file($file_tbl_add)) require_once $file_tbl_add ;

$file_tbl_delete = dirname(__FILE__)."/main_delete_app.php";
if(is_file($file_tbl_delete)) require_once $file_tbl_delete ;

$file_tbl_update = dirname(__FILE__)."/main_update_app.php";
if(is_file($file_tbl_update)) require_once $file_tbl_update ;
 

?>
