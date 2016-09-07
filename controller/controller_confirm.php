<?php
 
   $file = dirname(__FILE__)."/../access_modifiers/protected_access.php";
  if(is_file($file)) require_once $file  ;
  
   $filed = dirname(__FILE__)."/../modular/autoload_apps.php";
  if(is_file($filed)) require_once $filed  ;
  
  if(!isset($_POST))
      return false ;
  
  $notificationApis = new notification_system_applications();
  $friendReApis = new friend_system_applications() ;
    $me = $_SESSION['user_info']['user_id'];
    
    if(isset($_POST))
    {
        if($_POST['type'] == 1 ){
            $friendReApis->friend_system_update_fields([
                'id'=> trim($_POST['rowId'] )
            ] , ['is_accepted'=>1]);
         $checkExist = $friendReApis->friend_system_check_exist(['id'=>trim($_POST['rowId'] )]);
         $notificationApis->notification_system_add_new_field([
             'id_sender'=>$me ,
             'id_receiver'=>$checkExist->id_sender ,
             'app_type'=> 8 ,
             'timestamps'=>  time()
         ]);   
        }else if($_POST['type'] == 0 ){
            $friendReApis->friend_system_delete_fields([
                'id'=> trim($_POST['rowId'] )
            ]); 
        }else if ($_POST['type'] == 2 ){
           $friendReApis->friend_system_add_new_field([
               'id_sender' => $me ,
               'id_receiver'=>$_POST['frdId'] ,
               'timestamps'=>  time() 
           ]); 
           
        }
    }
?>
