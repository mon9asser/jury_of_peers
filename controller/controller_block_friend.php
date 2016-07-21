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
        
         $block_setting_file = dirname(__FILE__)."/../modular/applications/block_setting_applications.php";
        if(is_file($block_setting_file)) require_once $block_setting_file ;  
        // sign up controller
       if($_POST['proccessType']=='block_from_mylist')
           {
                $frd_apis = new friend_system_applications() ;
                $block_apis = new block_setting_applications() ;
                
               
                
               
                $bloker1 = $block_apis ->block_setting_check_exist(['user_id'=> $_SESSION['user_info']['user_id']]) ;
                $blocker2 = $block_apis ->block_setting_check_exist(['user_id'=> $_POST['userId']]) ;
                /*$checkExist1 == NULL and $checkExist2 == NULL  and*/
                     
                     $checkExist1 = $frd_apis->friend_system_check_exist([
                    'id_sender' =>$_SESSION['user_info']['user_id'] ,
                    'id_receiver'=> trim($_POST['userId'])  
                    ], 'and');

                    $checkExist2 = $frd_apis->friend_system_check_exist([
                        'id_sender' =>trim($_POST['userId'])  ,
                        'id_receiver'=>  $_SESSION['user_info']['user_id']
                    ], 'and');
                /*user_id
                blocker_id
                blockee_id
                timestamps*/
                   
                    // blocking this person
                   $blk =  $block_apis->block_setting_add_new_field([
                        'user_id'=>$_SESSION['user_info']['user_id'] , 
                        'blocker_id'=>$_SESSION['user_info']['user_id']  ,
                        'blockee_id'=>$_POST['userId'] , 
                        'timestamps'=> time()
                    ]);
                    
                    // removing this person from my friend list 
                    $deleteUserFromList =  0  ;
                    
                    if($checkExist2 != NULL )
                    $deleteUserFromList = $checkExist2 ;
                    else if($checkExist1 != NULL )
                        $deleteUserFromList = $checkExist1 ;
                    else 
                       $deleteUserFromList = 0 ; // this user not friend in my list ;
                      
                    if($deleteUserFromList != 0 )
                        {
                            $block_apis->friend_system_delete_fields(['id'=>$deleteUserFromList->id]);
                        }
                    
                       if($blk )
                           echo "1" ;
                       
             
                
           }  
        
        session_write_close() ;
         
 ?>
