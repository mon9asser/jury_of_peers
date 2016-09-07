<?php 
ob_start();
if(session_id()=='')
session_start() ;
 

if(isset($_POST))
    {
        if($_POST['proccessType']=='ADD_ALBUM_POST'){
                    // image settings to set dir and store in databases ...
                    $fileName = $_FILES["posted_image"]["name"]; // The file name
                    $fileTmpLoc = $_FILES["posted_image"]["tmp_name"]; // File in the PHP tmp folder
                    $fileType = $_FILES["posted_image"]["type"]; // The type of file it is
                    $fileSize = $_FILES["posted_image"]["size"]; // File size in bytes
                    $fileErrorMsg = $_FILES["posted_image"]["error"]; // 0 for false... and 1 for true
                     /** here **/
                    $userid_curr = trim($_POST['currentProfileId']) ;
                    /** here **/
                    
                    $type_of_images = [
                        strtolower(trim('image/jpeg'))      ,
                        strtolower(trim('image/gif'))       ,
                        strtolower(trim('image/jpg'))       ,
                        strtolower(trim('image/png'))
                    ];
                   /** here **/
                    $user_applicationst_file  = dirname(__FILE__)."/../modular/applications/user_applications.php";
                    if(is_file($user_applicationst_file)) require_once $user_applicationst_file ;
                    $user_apis = new user_applications();
                    $userExist = $user_apis->user_application_check_exist(['id'=>$userid_curr]);
                    if($userExist  == NULL )
                        return false ; 
                   /** here **/
                    if(!in_array(  strtolower(trim($fileType)) , $type_of_images )){
                         echo "This is not image , please upload image with png or gif or jpg extensions ";
                         return false ;
                      } 
                    /** here **/
                    $userName_folder = $userExist->u_name; ;
                     $image_rename = rand(2000 , 1000000) . "_" .time() . "_".rand(2000 , 1000000) . "_juryofpeers_".$userName_folder.$fileName; 
                    $fileRoot = dirname (__FILE__) . "/../photo_albums/timeline/$image_rename";

                    // upload file to server 
                    move_uploaded_file($fileTmpLoc , $fileRoot) ;

                    // photo album file
                    $photo_albums_file = dirname(__FILE__)."/../modular/applications/photo_albums_application.php";
                    if(is_file($photo_albums_file )) require_once $photo_albums_file  ;
                    // photo inside albums file 
                    $photo_files = dirname(__FILE__)."/../modular/applications/images_application.php";
                    if(is_file($photo_files)) require_once $photo_files ;
                    // post file 
                    $user_post_file  = dirname(__FILE__)."/../modular/applications/user_posts_applications.php";
                    if(is_file($user_post_file)) require_once $user_post_file ;

                    // photo apis 
                    $photo_apis = new images_applications() ;
                    // albume apis 
                    $album_apis = new photo_albums_applications() ;
                    // user post apps 
                    $user_post_apis = new user_posts_applications();

                     $albumeAppSerial = strtoupper($_SESSION['user_info']['user_id']."_albume_photo_timeline_".$_SESSION['user_info']['user_name']) ;
                    $post_serial_id = rand(2000 , 1000000)."_".strtoupper( "albume_photo_timeline")."_".rand(1000 , 1000000) . $_SESSION['user_info']['user_id']."_".rand(256 , 10000000) ;

                    // get id of this timline albume 
                    $id_album = $album_apis->photo_albums_check_exist(['app_serial'=>  $albumeAppSerial]);
                    if($id_album == NULL ) {
                    $album_apis->photo_albums_add_new_field([
                        'user_id'=>  trim($_POST['currentProfileId']) ,
                        'album_name'=>'timeline' ,
                        'app_serial'=>  $albumeAppSerial,
                         'timestamps'=> time() , 
                        'post_serial_id'=>$post_serial_id ,
                        'posted_by_id'=>$_SESSION['user_info']['user_id']
                    ]);
                    }
                    // store photo 
                     $id_album = $album_apis->photo_albums_check_exist(['app_serial'=>  $albumeAppSerial]);


                    $img_add = $photo_apis->images_applications_add_new_field([
                        'user_id' => trim($_POST['currentProfileId']) ,
                        'album_id'=> $id_album->id ,
                         'app_serial'=>strtoupper($_SESSION['user_info']['user_id']."_photo_timeline_".$_SESSION['user_info']['user_name']) ,
                        'img_size'=> $fileSize ,
                        'img_blob'=> addslashes(file_get_contents($fileRoot)),
                        'img_src'=> $image_rename ,
                        'img_type'=> $fileType ,
                        'created_on'=> time() ,
                        'post_serial_id'=>$post_serial_id,
                        'posted_by_id'=>$_SESSION['user_info']['user_id']
                     ]);

                     // addne post include albume id 
                    $user_post_apis->user_posts_add_new_field([
                        'user_id'=>trim($_POST['currentProfileId'])  ,
                        'post_type_num'=> 0 ,/*albume like (photo => 0 , music => 1  , video  => 2)*/
                        'post_album_id'=> $id_album->id , /*albume like (photo albume , music album , video albume)*/
                        'timestamps'=>  time() ,
                        'timeupdates'=>time() ,
                        'post_serial_id'=>$post_serial_id,
                        'posted_by_id'=>$_SESSION['user_info']['user_id']
                          ]);
 
                     if($img_add )
                         echo '1';
         
        }else if($_POST['proccessType'] == 'DELETE_ALBUM_POST'){
                    // get last image row from db that added
                    $photo_files = dirname(__FILE__)."/../modular/applications/images_application.php";
                    if(is_file($photo_files)) require_once $photo_files ;
                    
                     $user_post_file  = dirname(__FILE__)."/../modular/applications/user_posts_applications.php";
                     if(is_file($user_post_file)) require_once $user_post_file ;


                   $photo_apis = new images_applications() ;
                   $post_apis = new user_posts_applications();

                   $images = $photo_apis->images_applications_get_by_values(['user_id'=>$_SESSION['user_info']['user_id']], 'and');

                   if(count($images) != 0 )
                   {
                       $lastRecorded = $images[count($images)-1];
                        //print_r($lastRecorded->post_serial_id);
                       
                        $userName_folder = $_SESSION['user_info']['user_name'] ;
                        
                        // unlink image from user folder
                               $imageDir = dirname(__FILE__)."/../photo_albums/timeline/".$lastRecorded->img_src ;
                             if(@is_file($imageDir ))
                                @unlink($imageDir);
                            
                        // delete post record
                        $pstADDed = $post_apis->user_posts_check_exist(['post_serial_id'=>$lastRecorded->post_serial_id,'user_id'=>$_SESSION['user_info']['user_id']]);
                         if($pstADDed != NULL )
                            {    
                                  $post_apis->user_posts_delete_fields(['id'=>$pstADDed->id]);
                            }
                         // delete image row from db 
                        $delImage = $photo_apis->images_applications_delete_fields(['post_serial_id'=>$lastRecorded->post_serial_id,'user_id'=>$_SESSION['user_info']['user_id']]);
                        if($delImage == TRUE )
                            echo '1';
                   }
           
        }
         

 }

  
?>