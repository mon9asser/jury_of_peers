<?php
ob_start() ;
if(session_id()=='')
    session_start () ;

if(!isset($_SESSION['user_info']))
    return false ;


$user_id = $_SESSION['user_info']['user_id'];



$files = dirname(__FILE__)."/../modular/autoload_apps.php";
 if(is_file($files)) require_once $files ;  
  
 
 
 $user_availabilt = new user_available_applications();
 $user_status_exist = $user_availabilt->user_available_check_exist(['user_id'=>$user_id]);
if($user_status_exist == NULL ){
        // add 
    $user_availabilt->user_available_add_new_field([
        'user_id' =>$user_id , 
        'timestamps' =>  time()
    ]);
}else 
{
    // update
    $user_availabilt->user_available_update_fields(['id'=>$user_status_exist->id],[
       'timestamps' =>  time() 
    ]);
}

?>