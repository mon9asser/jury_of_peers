<?php
ob_start() ;
if(session_id() =='')
    session_start() ;


 $files = dirname(__FILE__)."/../modular/autoload_apps.php";
 if(is_file($files )) require_once $files  ;

if(!isset($_POST['app_log_id']))
    return false ;

$id = trim($_POST['app_log_id']);
$my_apps = new my_apps_login();

$logout = $delete = $my_apps->my_apps_login_delete_fields([
    'id'=>$id
]);

if($logout )
    echo "1";
session_write_close() ;
ob_end_flush();
?>
