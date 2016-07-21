<?php
ob_start() ;
if(session_id() =='')
    session_start() ;


 // cehck if session exist 
 if(!isset($_SESSION['user_info']))
    {
         header("location: ../login.php");
        exit(1);
    }
  if((int) $_SESSION['user_info']['id'] == 0)
      {
         header("location: ../login.php");
        exit(1);
    }
    
  
    
      $user_files = dirname(__FILE__)."/../modular/applications/user_applications.php";
   if(is_file( $user_files))   require_once $user_files  ;
    
   $user_apis = new user_applications();
   $userExist = $user_apis->user_application_check_exist(['id'=>trim( $_SESSION['user_info']['id'])]);
   if($userExist == NULL )
   {
        header("location: ../login.php");
      exit(1);
   }
   //check if this user deleted
if($user_exist->is_deleted == 1 )
    {
        header("location: ../undefine.php");
        exit(1);
    }
?>