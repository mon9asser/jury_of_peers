<?php
ob_start() ;
if(session_id() =='')
    session_start () ;
 
 $files = dirname(__FILE__)."/../modular/autoload_apps.php";
 if(is_file($files )) require_once $files  ;

if(!isset($_SESSION['user_info']['user_id']))
    return FALSE ;

if(!isset($_POST['score'] ))
    return FALSE ;

if(!isset($_POST['typeOfEvaluate']))
    return FALSE ;

if(!isset($_POST['postId']))
    return FALSE ;

if(!isset($_POST['appType']))
    return FALSE ;
 
$programId = NULL ;
$evaluationApi = new reviews_rating_applications() ;
$notifiCationApis = new notification_system_applications() ;
$postApid =  new user_posts_applications() ;

switch ($_POST['appType']) {
        case 0 : // timeline // post
          
           $program_type = trim ($_POST['typeOfEvaluate'])   ;
           $postExist = $postApid ->user_posts_check_exist([
               'id'=>$_POST['postId']
           ]);
            
             $reviewExist = $evaluationApi->reviews_rating_check_exist([
                   'post_id'=>  trim($_POST['postId']) , 
                   'program_type'=> $program_type ,
                   'user_id'=> trim($_SESSION['user_info']['user_id']) 
               ]);
               if($reviewExist == NULL ){
                         $evaluationApi->reviews_rating_add_new_field([
                         'program_type'=> $program_type ,  // timeline // post
                         'post_id'=>  trim($_POST['postId']) , 
                         'user_id'=> trim($_SESSION['user_info']['user_id']) , 
                         'review_number'=> trim($_POST['score']) ,
                         'timestmps'=>  time() 
                    ]);
               }else {
                  $evaluationApi->reviews_rating_update_fields([
                         'program_type'=> $program_type ,  // timeline // post
                         'post_id'=>  trim($_POST['postId']) , 
                         'user_id'=> trim($_SESSION['user_info']['user_id']) , 
                     ], [
                        'review_number'=> trim($_POST['score']) ,
                         'timestmps'=>  time() 
                    ]);
               }
              
                $ntf = NULL ;
                switch ($program_type){
                    case  0 : // image
                        $ntf =  9 ;
                        break;
                    
                    case  1 : // music
                        $ntf =  10  ;
                        break;
                    
                    case  2 : // video
                        $ntf =  11 ;
                        break;
                }
            if($_SESSION['user_info']['user_id'] != $postExist->user_id  ){
               $notifiCationApis->notification_system_add_new_field(
                            [
                                 'id_sender'=>$_SESSION['user_info']['user_id'] ,
                                'id_receiver'=>$postExist->user_id , 
                                'app_type' =>$ntf ,
                                'app_con_id' =>$postExist->id , // post id  ,
                                'timestamps'=> time()
                            ]
                       );
               }
                
               // notification for judge type icon in header 
        break;
 
} 
                        

/*
 *program_type 
 *post_id
 * user_id
 * review_number
 * timestmps
 *  
 * 
 */

    
?>