<?php 
ob_start();
if(session_id()=='')
session_start() ;
 
  if(!isset($_POST['proccessType']))
      return false ;
  
  if($_POST['proccessType']=='ADD_ALBUM_PROFILE_PICTURE' )
    {
        // image settings to set dir and store in databases ...
                    $fileName = $_FILES["profile_picture"]["name"]; // The file name
                    $fileTmpLoc = $_FILES["profile_picture"]["tmp_name"]; // File in the PHP tmp folder
                    $fileType = $_FILES["profile_picture"]["type"]; // The type of file it is
                    $fileSize = $_FILES["profile_picture"]["size"]; // File size in bytes
                    $fileErrorMsg = $_FILES["profile_picture"]["error"]; // 0 for false... and 1 for true
                    
                    $type_of_images = [
                        strtolower(trim('image/jpeg'))      ,
                        strtolower(trim('image/gif'))       ,
                        strtolower(trim('image/jpg'))       ,
                        strtolower(trim('image/png'))
                    ];
                    
                    if(!in_array(  strtolower(trim($fileType)) , $type_of_images )){
                         echo "This is not image , please upload image with png or gif or jpg extensions ";
                         return false ;
                      } 
                    
                    $userName_folder = $_SESSION['user_info']['user_name'] ;
                     $image_rename = rand(2000 , 1000000) . "_" .time() . "_".rand(2000 , 1000000) . "_juryofpeers_".$userName_folder.$fileName; 
                    $fileRoot = dirname (__FILE__) . "/../photo_albums/profile_picture/$image_rename";

                    // upload file to server 
                    move_uploaded_file($fileTmpLoc , $fileRoot) ;

                    // photo album file
                    $photo_albums_file = dirname(__FILE__)."/../modular/applications/photo_albums_application.php";
                    if(is_file($photo_albums_file )) require_once $photo_albums_file  ;
                    // photo inside albums file 
                    $photo_files = dirname(__FILE__)."/../modular/applications/profile_picture_applications.php";
                    if(is_file($photo_files)) require_once $photo_files ;
                    // post file 
                    $user_post_file  = dirname(__FILE__)."/../modular/applications/user_posts_applications.php";
                    if(is_file($user_post_file)) require_once $user_post_file ;

                    // photo apis 
                    $photo_apis = new profile_picture_applications() ;
                    // albume apis 
                    $album_apis = new photo_albums_applications() ;
                    // user post apps 
                    $user_post_apis = new user_posts_applications();

                     $albumeAppSerial = strtoupper($_SESSION['user_info']['user_id']."_profile_picture_".$_SESSION['user_info']['user_name']) ;
                    $post_serial_id = rand(2000 , 1000000)."_".strtoupper( "aprofile_picture")."_".rand(1000 , 1000000) . $_SESSION['user_info']['user_id']."_".rand(256 , 10000000) ;

                    // get id of this timline albume 
                    $id_album = $album_apis->photo_albums_check_exist(['app_serial'=>  $albumeAppSerial]);
                    if($id_album == NULL ) {
                    $album_apis->photo_albums_add_new_field([
                        'user_id'=>$_SESSION['user_info']['user_id'] ,
                        'posted_by_id'=>$_SESSION['user_info']['user_id'] ,
                        'album_name'=>'Profile picture' ,
                        'app_serial'=>  $albumeAppSerial,
                         'timestamps'=> time() , 
                        'post_serial_id'=>$post_serial_id
                    ]);
                    }
                    // store photo 
                     $id_album = $album_apis->photo_albums_check_exist(['app_serial'=>  $albumeAppSerial]);
                      $img_add = $photo_apis->profile_pictureg_add_new_field([
                        'user_id' => $_SESSION['user_info']['user_id'],
                        'album_id'=> $id_album->id ,
                        'photo_name'=> $fileName,
                        'photo_size' => $fileSize,
                        'photo_blob'=>addslashes(file_get_contents($fileRoot)),
                        'photo_src'=> $image_rename ,
                         'photo_type' =>$fileType,
                        'timestamps' =>time() ,
                        'is_current'=>1 ,
                        'post_serial_id'=>$post_serial_id ,
                         'app_serial'=>strtoupper($_SESSION['user_info']['user_id']."_photo_timeline_".$_SESSION['user_info']['user_name']) ,
                         'posted_by_id'=>$_SESSION['user_info']['user_id']  
                      ]);

                     // addne post include albume id 
                    $user_post_apis->user_posts_add_new_field([
                        'user_id'=>$_SESSION['user_info']['user_id'] ,
                        'post_type_num'=> 3 ,/*albume like (photo => 0 , music => 1  , video  => 2 , profile_pic => 3)*/
                        'post_album_id'=> $id_album->id , /*albume like (photo albume , music album , video albume)*/
                        'timestamps'=>  time() ,
                        'post_serial_id'=>$post_serial_id ,
                        'is_shared'=> 1 ,
                        'posted_by_id'=>$_SESSION['user_info']['user_id']
                          ]);
 
                     if($img_add )
                         echo '1';
    }else if($_POST['proccessType']=='croping-image' ) { 
          
    }
                
?>