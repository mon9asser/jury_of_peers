<?php
ob_start() ;
if(session_id()=='')
    session_start () ;
if(!isset($_SESSION['user_info']))
    return false ;
    
  
 $files = dirname(__FILE__)."/../modular/autoload_apps.php";
 if(is_file($files )) require_once $files  ;
    
 $text = $_POST['url-links'];
   $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
 if(!isset($_POST['accessType']))
     return FALSE ;
// Check if there is a url in the text
if(preg_match($reg_exUrl, $text, $url)) {
    $app = new apps() ;
    $fields = $app->extract_link($url[0]);
    
    $links = $url[0] ;
    $imageThumb = $fields['urlImgSrc'];
    $titleThumb = $fields['urlTitle'];
    $descriptionThumb = $fields['urlDescription'];
    $KeyWordsThumb = $fields['urlKeyWords'];
    $urlAutherThumb = $fields['urlAuther'];
    
    $post_serial_id = rand(1000 , 5000) . "POST_links_TEXT" . rand(5000 ,20000) . time() ; 
    
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
       
     
  if ($_POST['accessType'] == 'share_atachments'){
              
            $photo_apis = new images_applications() ;
            $music_apis = new music_posts_applications() ;
            $video_apis = new video_posts_applications();
            $linkApis = new  user_links_applications() ;
             $userid_curr = trim($_POST['currentProfileId']) ; 
            
            $switchedFunc = NULL ;
           
          $linkApis->user_links_add_new_field(
                    [
                        'user_id'=>   $userid_curr          ,
                        'posted_by_id'=>  $_SESSION['user_info']['user_id']  ,
                        'post_serial_id'=> $post_serial_id,
                        'url_links'=> $links  ,
                        'image_src'=>  $imageThumb ,
                        'title'=> $titleThumb  ,
                        'description'=>  $descriptionThumb   ,
                        'keyword'=> $KeyWordsThumb    ,
                        'auther'=>$urlAutherThumb  ,
                        'timestamps'=> time() ,
                    ]
                    );
              $switchedFunc = $linkApis->user_links_get_by_values(
                      [
                         'user_id'=>$userid_curr  
                      ],'and');
            $textId_sy = NULL ;
            if($_POST['status'] != ''){
             $user_text_apis = new user_texts_applications();
              $postTexts = $user_text_apis ->user_texts_applications_add_new_field([
                  'post_text'=> $text ,
                  'user_id'=>$userid_curr ,
                  'app_serial'=>$post_serial_id , 
                  'created_on'=> time() ,
                  'access_permission' =>$_POST['accessPremission'] ,
                  'post_serial_id' =>$post_serial_id,
                  'posted_by_id'=>$_SESSION['user_info']['user_id']
              ]);
              $textId = $user_text_apis->user_texts_applications_get_by_values([
                    'user_id'=>$userid_curr  
              ],'and') ;
              $textId_sy =  $textId[count($textId)-1]->id  ;
              }
              
               
                     // post share 
             $user_post_apis = new user_posts_applications();
             
             // addne post include albume id 
                    $user_post_apis->user_posts_add_new_field([
                        'user_id'=>$userid_curr ,
                        'post_type_num'=> 121 ,/*albume like (music => 0 , music => 1  , video  => 2 , 121 => link)*/
                        'post_album_id'=> $switchedFunc[count($switchedFunc)-1]->id , /*albume like (music albume , music album , video albume)*/
                        'timestamps'=>  time() ,
                        'timeupdates'=>time() ,
                        'post_serial_id'=>$post_serial_id,
                        'posted_by_id'=>$_SESSION['user_info']['user_id']
                          ]);
 
                    
           
               
              
              
          
    }
}
 



  
?>