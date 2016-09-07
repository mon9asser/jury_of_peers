<?php
ob_start();
session_start() ;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if(!isset($_SESSION['user_info']))
    return false ;
if(!isset($_POST['user_id']))
    return false ;
if(!isset($_POST['messageContent']))
    return false ;;


$msg = $_POST['messageContent'] ;
$receniver = trim ($_POST['user_id']) ;
$me = $_SESSION['user_info']['user_id'];

  $file  = dirname(__FILE__)."/../modular/autoload_apps.php";
  if(is_file($file)) require_once $file  ;
 
  $userApps = new user_applications();
  $userInfo = $userApps ->user_application_check_exist(['id'=>trim($_POST['user_id'])]);
  
  
  $userConversitionAPIS = new conversation_applications();
  $messageConver = new messagae_applications();
  $userConverExist = NULL ;
  $userConverExist1 = $userConversitionAPIS->conversation_check_exist(['id_sender'=>$me ,'id_receiver'=>$receniver]);
  $userConverExist2 = $userConversitionAPIS->conversation_check_exist(['id_sender'=>$receniver ,'id_receiver'=>$me ]);
   if($userConverExist1 != NULL )
       $userConverExist = $userConverExist1 ;
   else if($userConverExist2 != NULL )
       $userConverExist = $userConverExist2 ;
   
   
   
   // add message header 
   
  if($userConverExist == NULL ){
      // add new 
       $userConversitionAPIS = new conversation_applications();
      $userConversitionAPIS->conversation_add_new_field([
          'id_sender'=>$me,
          'id_receiver'=>$receniver ,
           'timestamps'=>  time()
      ]);
  }else {
       $userConversitionAPIS = new conversation_applications();
      // update 
       $userConversitionAPIS->conversation_update_fields(
               [
                   'id'=>$userConverExist->id
               ],
               [
                   'is_seen'=>0 , 
                   'timestamps'=>  time()
               ]
               ) ;
  }
  
  
  
    $userConverExist = NULL ;
  $userConverExist1 = $userConversitionAPIS->conversation_check_exist(['id_sender'=>$me ,'id_receiver'=>$receniver]);
  $userConverExist2 = $userConversitionAPIS->conversation_check_exist(['id_sender'=>$receniver ,'id_receiver'=>$me ]);
   if($userConverExist1 != NULL )
       $userConverExist = $userConverExist1 ;
   else if($userConverExist2 != NULL )
       $userConverExist = $userConverExist2 ;
  
   
   
   // Add message 
$addedd =   $messageConver->messagae_add_new_field([
      'conversation_id'=>$userConverExist->id , 
      'id_sender'=>$me , 
      'id_receiver'=>$receniver ,
      'message_text'=>$msg ,
      'timestamps'=> time()
  ]);

if($addedd)
    echo "1";
?>