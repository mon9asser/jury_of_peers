<?php
ob_start() ;
if(session_id()=='')
    session_start () ;

if(!isset($_POST['proccessType']))
    return false ;
if(!isset($_POST['userId']))
    return false ;

    // check about session 
        $friend_system_file = dirname(__FILE__)."/../modular/applications/friend_system_applications.php";
        if(is_file($friend_system_file)) require_once $friend_system_file ;  
        
        $notification_system_file = dirname(__FILE__)."/../modular/applications/notification_system_applications.php";
        if(is_file($notification_system_file)) require_once $notification_system_file ;  
        // sign up controller
       if($_POST['proccessType']=='add_to_mylist')
           {
                $frd_apis = new friend_system_applications() ;
                $checkExist1 = $frd_apis->friend_system_check_exist([
                    'id_sender' =>$_SESSION['user_info']['user_id'] ,
                    'id_receiver'=> trim($_POST['userId'])  
                ], 'and');
                
                $checkExist2 = $frd_apis->friend_system_check_exist([
                    'id_sender' =>trim($_POST['userId'])  ,
                    'id_receiver'=>  $_SESSION['user_info']['user_id']
                ], 'and');
                
                if ($checkExist1 == NULL and $checkExist2 == NULL ) {
                       $addFrd =  $frd_apis->friend_system_add_new_field([
                            'id_sender' =>$_SESSION['user_info']['user_id'] ,
                            'id_receiver'=> trim($_POST['userId']) ,
                            'timestamps'=>  time()
                        ]);
                       $last = $frd_apis->friend_system_get_by_values(['id_sender' =>$_SESSION['user_info']['user_id']] , 'and') ;
                       if($addFrd){
                             // send notification sys
                           $notificaiton_apis = new notification_system_applications() ;
                           $notificaiton_apis->notification_system_add_new_field([
                               'id_sender'=>$_SESSION['user_info']['user_id'] ,
                               'id_receiver'=> trim($_POST['userId']) ,
                               'app_type'=>  0 ,  // {0=>friend system }
                               'app_con_id'=>$last[count($last)-1]->id , 
                               'timestamps'=>  time() 
                            ]);
                            // notify js 
                           echo "1" ;
                       }
                }else echo "2";
                
           }  
        
        session_write_close() ;
         
 ?>
