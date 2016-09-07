<?php
ob_start() ;
if(session_id()=='')
    session_start() ;

  

if(!isset($_SESSION['user_info']))
    return false ;

if(!isset($_POST['userId']) or !isset($_POST['textMsg'])or !isset($_POST['conversation_id'])) 
    return false ;
//print ( $_POST['userId'].' ' .$_POST['textMsg'].' ' .$_POST['conversation_id'])  ;
             $file = dirname(__FILE__)."/../modular/autoload_apps.php";
            if(is_file($file )) require_once $file ;   
            
            
           $msg_app = new messagae_applications();
           $add = $msg_app->messagae_add_new_field([
                'conversation_id'=>$_POST['conversation_id'],
                'user_from'=>$_SESSION['user_info']['user_id'],
                'user_to'=>$_POST['userId'],
                'message_text'=>$_POST['textMsg'],
                'timestamps'=>time()
            ]);
           if($add) echo '1';
            
ob_end_flush() ;
session_write_close();
  ?>