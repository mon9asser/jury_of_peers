<?php

   $file = dirname(__FILE__)."/../access_modifiers/protected_access.php";
  if(is_file($file)) require_once $file  ;
  
   $filed = dirname(__FILE__)."/../modular/autoload_apps.php";
  if(is_file($filed)) require_once $filed  ;
  
  if(!isset($_POST))
      return false ;
  
  $notificationApis = new notification_system_applications();
   
    $me = $_SESSION['user_info']['user_id'];
  
  if($_POST['ntf_type'] == 'viewProfile'){     // FOR ( Profile View )
      $viewFunc = $notificationApis->notification_system_apis_get_all("WHERE `id_receiver`={$me} AND `app_type`=0 AND `is_seen`=0"); 
     if(count($viewFunc) != 0 )
     echo '<span class="counts">'. count($viewFunc).'</span>';
  }else if ($_POST['ntf_type'] == 'InitCourtroom'){ // FOR ( Courtroom initialization )  
      $courtApp =" `app_type`=5 "; // court init request
       $courtApp .=" OR `app_type`=9 "; // images photo 
        $courtApp .=" OR `app_type`=10 "; // music
         $courtApp .=" OR `app_type`=11 "; // video 
         $courtApp .=" OR `app_type`=8 "; // Decline Court room
         $courtApp .=" OR `app_type`=7"; // Accept Court room
      
      $viewFunc = $notificationApis->notification_system_apis_get_all("WHERE `id_receiver`={$me} AND ( {$courtApp} ) AND `is_seen`=0"); 
     if(count($viewFunc) != 0 )
     echo '<span class="counts">'. count($viewFunc).'</span>';
  }else if ($_POST['ntf_type'] == 'messages'){ // FOR ( Messages )  
      $viewFunc = $notificationApis->notification_system_apis_get_all("WHERE `id_receiver`={$me} AND `app_type`=6 AND `is_seen`=0"); 
     if(count($viewFunc) != 0 )
     echo '<span class="counts">'. count($viewFunc).'</span>';
  }else if ($_POST['ntf_type'] == 'friend_requests'){ // FOR ( Friend confirmed - Request )  
      $userAddRequest = new friend_system_applications();
      $friendRequest = $userAddRequest->friend_system_apis_get_all("WHERE `id_receiver`={$me} AND `is_accepted`=0 AND `is_seen`=0");
        if(count($friendRequest)  !=  0 )
        echo '<span class="counts">'. count($friendRequest)  .'</span>';
  }else if ($_POST['ntf_type'] == 'main_notifications'){  
      $paramitars = "`app_type`=2 "; // POST COMMENTS
       $paramitars .= " OR " ;
      $paramitars .= "`app_type`=3 "; // POST LIKE DISLIKE
       $paramitars .= " OR " ;
      $paramitars .= "`app_type`=8 "; // Friend Success
      
      
       $viewFunc = $notificationApis->notification_system_apis_get_all("WHERE `id_receiver`={$me} AND {$paramitars} AND `is_seen`=0"); 
     if(count($viewFunc) != 0 )
     echo '<span class="counts">'. count($viewFunc).'</span>';
  }
  
?>
