<?php
ob_start() ;
if(session_id()=='')
 session_start () ;

 if(!isset($_POST['passwordtochange']))
 {
     echo "Password Fields are Required .";
     return FALSE ;
 }
 
  $fileDirs = dirname(__FILE__)."/../modular/autoload_apps.php";
    if(is_file($fileDirs )) require_once $fileDirs  ;

    
    $emailOrUser = md5(trim(($_POST['passwordtochange']) ) );
    
   $userApps = new user_applications() ;
   $userExist = NULL ;
   $user1 =  $userApps->user_application_check_exist(['id'=>$_SESSION['user_info']['user_id']]);
   if($user1 != NULL )
   {
       $connx = new connections_db();
      $ch=  $userApps->user_application_update_fields(['id'=>$user1->id],[
           'p_assword'=> mysqli_real_escape_string($connx->open_connection() ,$emailOrUser) 
       ]);
      if($ch) echo "1";
   }
   
   
   
    
     
    ?>
