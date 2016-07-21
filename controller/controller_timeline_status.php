<?php 
ob_start();
if(session_id()=='')
session_start() ;
 

if(isset($_POST['accessType']))
    { 
    
    $post_serial_id = rand(1000 , 5000) . "POST_TEXT" . rand(5000 ,20000) . time() ; 
    
      $user_post_file  = dirname(__FILE__)."/../modular/applications/user_posts_applications.php";
      if(is_file($user_post_file)) require_once $user_post_file ;
      
      $user_text_file  = dirname(__FILE__)."/../modular/applications/user_texts_applications.php";
      if(is_file($user_text_file)) require_once $user_text_file ;
      
      
      $user_vid_file  = dirname(__FILE__)."/../modular/applications/video_posts_applications.php";
      if(is_file($user_vid_file)) require_once $user_vid_file ;
      
      
      $user_muc_file  = dirname(__FILE__)."/../modular/applications/music_posts_applcations.php";
      if(is_file($user_muc_file)) require_once $user_muc_file ;
      
      
        $photo_files = dirname(__FILE__)."/../modular/applications/images_application.php";
                    if(is_file($photo_files)) require_once $photo_files ;
       
        // status only 
        if($_POST['accessType'] == 'share_status') {
             
            $_POST['is_shared']; 
            $_POST['accessPremission'];  
            $_POST['status'];
             $userid_curr = trim($_POST['currentProfileId']) ; 
             
              /** here **/
                    $user_applicationst_file  = dirname(__FILE__)."/../modular/applications/user_applications.php";
                    if(is_file($user_applicationst_file)) require_once $user_applicationst_file ;
                    $user_apis = new user_applications();
                    $userExist = $user_apis->user_application_check_exist(['id'=>$userid_curr]);
                    if($userExist  == NULL )
                        return false ; 
                   /** here **/
                    
            if($_POST['is_shared'] == '' || $_POST['accessPremission'] == '' || $_POST['status'] == '')  
                return false ;
             // save status text
              $_POST['accessPremission'] ;
              
              
              // status text 
              $user_text_apis = new user_texts_applications();
              $postTexts = $user_text_apis ->user_texts_applications_add_new_field([
                  'post_text'=> $_POST['status'] ,
                  'user_id'=>$userid_curr  ,
                  'app_serial'=>$post_serial_id , 
                  'created_on'=> time() ,
                  'access_permission' =>$_POST['accessPremission'] ,
                  'post_serial_id' =>$post_serial_id,
                  'posted_by_id'=>$_SESSION['user_info']['user_id']
              ]);
              
              $textId = $user_text_apis->user_texts_applications_apis_get_all() ;
              if(count($textId )!=0)
              {
                  
                  // post share 
                    $share_post = new user_posts_applications();
                    $share_post->user_posts_add_new_field([
                        'user_id'             =>  $userid_curr , 
                        'post_text_id'        =>  $textId[count($textId)-1]->id ,
                        'timestamps'          =>  time()  ,
                        'access_permission'   =>  $_POST['accessPremission'] ,
                        'is_shared'           =>  1 ,
                        'post_serial_id'      =>  $post_serial_id ,
                        'posted_by_id'=>$_SESSION['user_info']['user_id']
                    ]);
              }
               
              echo '1';
        }else if ($_POST['accessType'] == 'share_atachments'){
              
            $photo_apis = new images_applications() ;
            $music_apis = new music_posts_applications() ;
            $video_apis = new video_posts_applications();
             $userid_curr = trim($_POST['currentProfileId']) ; 
            
            $switchedFunc = NULL ;
            switch ($_POST['attachmentType']) {
            case 'img' :
                  $switchedFunc =   $photo_apis->images_applications_apis_get_all();
                break;
            
            case 'mus' :
                 $switchedFunc =   $music_apis->music_posts_apis_get_all();
                break;
            
            case 'vid' :
                 $switchedFunc =   $video_apis->video_posts_apis_get_all() ;
                break;
            }
            
            
            $textId_sy = NULL ;
            if($_POST['status'] != ''){
             $user_text_apis = new user_texts_applications();
              $postTexts = $user_text_apis ->user_texts_applications_add_new_field([
                  'post_text'=> $_POST['status'] ,
                  'user_id'=>$userid_curr ,
                  'app_serial'=>$post_serial_id , 
                  'created_on'=> time() ,
                  'access_permission' =>$_POST['accessPremission'] ,
                  'post_serial_id' =>$post_serial_id,
                  'posted_by_id'=>$_SESSION['user_info']['user_id']
              ]);
              $textId = $user_text_apis->user_texts_applications_apis_get_all() ;
              $textId_sy =  $textId[count($textId)-1]->id ;
              }
              
               
                     // post share 
             $share_post = new user_posts_applications();
             $share_post->user_posts_update_fields(
                     [
                         'post_serial_id'=>$switchedFunc[count($switchedFunc)-1]->post_serial_id  ,
                        'user_id'=>$userid_curr  ,
                     ]
                     , [
                         'timestamps'          =>  time()  ,
                         'access_permission'   =>  $_POST['accessPremission'] ,
                         'is_shared'           =>  1  ,
                         'post_text_id'=>$textId_sy
                     ]);
            
               
              
              
             
        }
        
    }

  
?>