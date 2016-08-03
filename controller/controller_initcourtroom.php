<?php
ob_start();
if (session_id()=='')
    session_start () ;


   $file = dirname(__FILE__)."/../modular/autoload_apps.php";
   if(is_file($file )) require_once $file  ;
   
   
 //  echo "User Id : " . $_POST['user-id'] . " Post Id : " . $_POST['post-id']. " Title Courtroom : " . $_POST['title-courtroom']. " Cause Courtroom : " . $_POST['cause-courtroom'] . " Settlement Courtroom : " . $_POST['settlement-courtroom'] . " Time Courtroom : " . $_POST['time-courtroom'] ;
   
   
  if(!isset($_POST['user-id']))  
      return false;
  if(!isset($_POST['post-id']))  
      return false;
  if(!isset($_POST['title-courtroom'])) 
      return false;
  if(!isset($_POST['cause-courtroom']))  
      return false;
  if(!isset($_POST['settlement-courtroom']))  
      return false;
  if(!isset($_POST['time-courtroom']))  
      return false;           
  
  $code = rand(2000,50000000).rand(2000,50000000).rand(2000,50000000);
  
  $user_id =  $_POST['user-id']  ;                                
  $post_id =  $_POST['post-id'] ;
  $title_courtroom =  $_POST['title-courtroom'] ;
  $cause_courtroom =  $_POST['cause-courtroom']  ;
  $settlement_courtroom =  $_POST['settlement-courtroom']  ;
  $time_courtroom =  $_POST['time-courtroom']  ;
   
    
   $courtInitApi = new courtroom_init_applications();
   $courtInitApi->courtroom_init_add_new_field([
       'court_title'=>  trim($title_courtroom),
       'court_cause'=>  trim($cause_courtroom),
       'post_id'=>  trim($post_id),
       'user_id'=>  trim($user_id),
       'plaintiff_id'=>  trim($_SESSION['user_info']['user_id']),
       'defedant_id'=>  trim($user_id),
       'setlment_plnf'=>  trim($settlement_courtroom),
        'timestamps'=>  time(),
       'time_estimated'=>  trim($time_courtroom) ,
       'courtroom_code' => trim($code)
    ]); 
   echo trim($code );
   
   
   session_write_close() ;
   ob_end_flush() ;
?>