<?php 
ob_start() ;
if(session_id()=='')
    session_start () ;
if(!isset($_SESSION['user_info']))
    return false ;

 $files = dirname(__FILE__)."/../modular/autoload_apps.php";
 if(is_file($files )) require_once $files  ;
 
if(isset($_POST['file'])){
    $file = '../uploads/' . $_POST['file'];
    if(file_exists($file)){
        unlink($file);
    }
}
?>