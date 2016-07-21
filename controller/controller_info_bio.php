<?php
ob_start() ;
if(session_id()=='')
    session_start () ;
 
 
$args = [] ;
 
if(!isset( $_SESSION['user_info']['user_id']  ))
    return false ;
 
if(isset( $_POST['mobile'])){
    if($_POST['mobile']!= '')
    $args['mobile'] = $_POST['mobile'] ;

}

if(isset(  $_POST['country'] )){
     if($_POST['country']!= '')
$args['country'] = $_POST['country'] ;}

if(isset(  $_POST['city'] )){
    if($_POST['city']!='')
$args['city'] = $_POST['city'] ;}

if(isset(  $_POST['jobTitle'] )){
    if($_POST['jobTitle'] !='')
$args['job_title'] = $_POST['jobTitle'] ;}

if(isset(  $_POST['company']  )){
    if( $_POST['company'] !='')
$args['at_company'] = $_POST['company'] ;}

if(isset(  $_POST['bioInfo']  )){
    if($_POST['bioInfo']  != '')
$args['about'] = $_POST['bioInfo'] ;}



  $args['user_id'] = $_SESSION['user_info']['user_id'] ;
  
  

 $settings_file = dirname(__FILE__)."/../modular/applications/general_settings_applications.php";
 if(is_file($settings_file)) require_once $settings_file ; 
    
 $genral_apis = new general_settings_applications() ;
 $bioExist = $genral_apis->general_settings_check_exist(['user_id'=>$_SESSION['user_info']['user_id']]);
 if($bioExist == NULL ){
 $gg = $genral_apis->general_settings_add_new_field($args);
 if ($gg ) echo "1";
 }
 
        session_write_close() ;
         
 ?>
