<?php
ob_start() ;
if(session_id() =='')
    session_start() ;
      
// log out any user without me 93.168.11.41
 
if(trim( $_SERVER['REMOTE_ADDR'] )    != "178.81.96.245"   )
        { 
            echo "<center>
              <h1>THIS IP ". $_SERVER['REMOTE_ADDR'] ." CAN NOT OPEN OUR WEBSITE</h1>
                </center>";
            
        // header('location: undefine');
            exit(1);
        }      
 
 // cehck if session exist 
 if(!isset($_SESSION['user_info']))
    {
         header("location: ../login");
        exit(1);
    }  
  
      $files  = dirname(__FILE__)."/../modular/autoload_apps.php";
   if(is_file( $files))   require_once $files  ;
    
   $user_apis = new user_applications();
   $userExist = $user_apis->user_application_check_exist(['id'=>trim( $_SESSION['user_info']['user_id'])]);
   if($userExist == NULL )
   {
        header("location: ../login");
      exit(1);
   }
   //check if this user deleted
   
if($userExist->is_activated != 1 )
{
     header("location: ../activation");
    exit(1);
}
if($userExist->is_deleted == 1 )
    {
        header("location: ../undefine");
        exit(1);
    }
?>