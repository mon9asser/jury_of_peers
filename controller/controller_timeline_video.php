<?php 
ob_start();
if(session_id()=='')
session_start() ;
 

if(isset($_POST))
    {
        if($_POST['proccessType']=='ADD_ALBUM_POST'){
                    // image settings to set dir and store in databases ...
                    $fileName = $_FILES["posted_video"]["name"]; // The file name
                    $fileTmpLoc = $_FILES["posted_video"]["tmp_name"]; // File in the PHP tmp folder
                    $fileType = $_FILES["posted_video"]["type"]; // The type of file it is
                    $fileSize = $_FILES["posted_video"]["size"]; // File size in bytes
                    $fileErrorMsg = $_FILES["posted_video"]["error"]; // 0 for false... and 1 for true
                      $userid_curr = trim($_POST['currentProfileId']) ; 
                    $type_of_images = [
                        strtolower(trim('video/mov')) ,
                        strtolower(trim('video/mp4')) ,
                        strtolower(trim('video/3gp')) ,
                        strtolower(trim('video/ogg'))  
                     ];
                    
                    if(!in_array(  strtolower(trim($fileType)) , $type_of_images )){
                         echo "This is not video file , please upload video with mp4 or 3gp or ogg or mov type";
                         return false ;
                      } 
                    /** here **/
                    $user_applicationst_file  = dirname(__FILE__)."/../modular/applications/user_applications.php";
                    if(is_file($user_applicationst_file)) require_once $user_applicationst_file ;
                    $user_apis = new user_applications();
                    $userExist = $user_apis->user_application_check_exist(['id'=>$userid_curr]);
                    if($userExist  == NULL )
                        return false ; 
                   /** here **/
                    $userName_folder = $userExist->u_name;  
                     $image_rename = rand(2000 , 1000000) . "_" .time() . "_".rand(2000 , 1000000) . "_juryofpeers_".$userName_folder.$fileName; 
                    $fileRoot = dirname (__FILE__) . "/../$userName_folder/video_albums/timeline/$image_rename";

                    // upload file to server 
                    move_uploaded_file($fileTmpLoc , $fileRoot) ;

                    // music album file
                    $music_albums_file = dirname(__FILE__)."/../modular/applications/video_film_categories_applications.php";
                    if(is_file($music_albums_file )) require_once $music_albums_file  ;
                     $music_files = dirname(__FILE__)."/../modular/applications/video_posts_applications.php";
                    if(is_file($music_files)) require_once $music_files ;
                    
                    
                    // post file 
                    $user_post_file  = dirname(__FILE__)."/../modular/applications/user_posts_applications.php";
                    if(is_file($user_post_file)) require_once $user_post_file ;
                    
                    // music apis 
                    $music_apis = new video_posts_applications() ;
                    // albume apis 
                    $album_album_apis = new video_film_categories_applications() ;
                    // user post apps 
                    $user_post_apis = new user_posts_applications();

                     $albumeAppSerial = strtoupper($_SESSION['user_info']['user_id']."_albume_video_timeline_".$_SESSION['user_info']['user_name']) ;
                    $post_serial_id = rand(2000 , 1000000)."_".strtoupper( "albume_video_timeline")."_".rand(1000 , 1000000) . $_SESSION['user_info']['user_id']."_".rand(256 , 10000000) ;
                    
                    // get id of this timline albume 
                    $id_album = $album_album_apis->video_film_categories_check_exist(['app_serial'=>  $albumeAppSerial]);
                    if($id_album == NULL ) {
                    $album_album_apis->video_film_categories_add_new_field([
                        'user_id'=>$userid_curr ,
                        'album_name'=>'timeline' ,
                        'app_serial'=>  $albumeAppSerial,
                        'timestamps'=> time() , 
                        'post_serial_id'=>$post_serial_id,
                        'posted_by_id'=>$_SESSION['user_info']['user_id']
                    ]);
                    }
                    // store music 
                     $id_album = $album_album_apis->video_film_categories_check_exist(['app_serial'=>  $albumeAppSerial]);


                    $img_add = $music_apis->video_posts_add_new_field([
                        'album_id'=> $id_album->id ,
                        'user_id' => $userid_curr,
                         'video_name'=>$_POST['videoTitle']  ,
                         'video_size'=> $_POST['videoSize']  ,
                        'video_src'=> $image_rename ,
                         'app_serial'=>strtoupper($_SESSION['user_info']['user_id']."_video_timeline_".$_SESSION['user_info']['user_name']) ,
                         'post_serial_id'=>$post_serial_id ,
                         'created_on'=> time()  ,
                        'posted_by_id'=>$_SESSION['user_info']['user_id']
                      ]);
                    
                    
                    
                    
                     // addne post include albume id 
                    $user_post_apis->user_posts_add_new_field([
                        'user_id'=>$userid_curr ,
                        'post_type_num'=> 2 ,/*albume like (music => 0 , music => 1  , video  => 2 , null )*/
                        'post_album_id'=> $id_album->id , /*albume like (music albume , music album , video albume)*/
                        'timestamps'=>  time() ,
                        'post_serial_id'=>$post_serial_id,
                        'posted_by_id'=>$_SESSION['user_info']['user_id']
                          ]);
 
                     if($img_add )
                         echo '1';
         
        }else if($_POST['proccessType'] == 'DELETE_ALBUM_POST'){
                    // get last image row from db that added
                    // music album file
                     $music_albums_file = dirname(__FILE__)."/../modular/applications/video_film_categories_applications.php";
                    if(is_file($music_albums_file )) require_once $music_albums_file  ;
                     $music_files = dirname(__FILE__)."/../modular/applications/video_posts_applications.php";
                    if(is_file($music_files)) require_once $music_files ;
                    
                    
                    // post file 
                    $user_post_file  = dirname(__FILE__)."/../modular/applications/user_posts_applications.php";
                    if(is_file($user_post_file)) require_once $user_post_file ;


                   $music_apis = new video_posts_applications() ;
                   $post_apis = new user_posts_applications();

                   $music = $music_apis->video_posts_get_by_values(['user_id'=>$_SESSION['user_info']['user_id']], 'and');

                   if(count($music) != 0 )
                   {
                       $lastRecorded = $music[count($music)-1];
                        //print_r($lastRecorded->post_serial_id);
                       
                        $userName_folder = $_SESSION['user_info']['user_name'] ;
                        
                        // unlink image from user folder
                               $imageDir = dirname(__FILE__)."/../$userName_folder/video_albums/timeline/".$lastRecorded->video_src ;
                             if(@is_file($imageDir ))
                                @unlink($imageDir);
                            
                        // delete post record
                        $pstADDed = $post_apis->user_posts_check_exist(['post_serial_id'=>$lastRecorded->post_serial_id,'user_id'=>$_SESSION['user_info']['user_id']]);
                         if($pstADDed != NULL )
                            {    
                                  $post_apis->user_posts_delete_fields(['id'=>$pstADDed->id]);
                            }
                         // delete image row from db 
                        $delImage = $music_apis->video_posts_delete_fields(['post_serial_id'=>$lastRecorded->post_serial_id,'user_id'=>$_SESSION['user_info']['user_id']]);
                        if($delImage == TRUE )
                            echo '1';
                   }
           
        }
         

 }

  
?>