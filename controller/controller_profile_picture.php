<?php 
ob_start();
if(session_id()=='')
session_start() ;
 

$file_apis_crop = dirname(__FILE__)."/../server/slim.php";
if(is_file($file_apis_crop )) require_once $file_apis_crop  ;
//$images = Slim::getImages('slim');
$image = $images[0];
//sprint_r($image['actions']['crop']);
 
  
 
 $name = $image['input']['name'];
$data = $image['output']['data'];
 

 
 
  if(!isset($_POST['proccessType']))
   
  
  if($_POST['proccessType']=='ADD_ALBUM_PROFILE_PICTURE' )
    {
        // image settings to set dir and store in databases ...
                    $fileName = $name; // The file name
                    $fileTmpLoc = $data ; // File in the PHP tmp folder
                     $fileType = $image['input']['type']    ; // The type of file it is
                    $fileSize = $image['input']['size'] ; // File size in bytes
                    
                 
                     
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
                    
                    $fileRoot = dirname (__FILE__) . "/../photo_albums/profile_picture/";
                    $file = Slim::saveFile($data, $name, $fileRoot  );
                     $image_rename = $file['name'] ; 
                    // upload file to server 
                  //   move_uploaded_file($fileTmpLoc , $fileRoot) ;
                   
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
                        'photo_blob'=>$data,
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
                        'timeupdates'=>time() ,
                        'post_serial_id'=>$post_serial_id ,
                        'is_shared'=> 1 ,
                        'posted_by_id'=>$_SESSION['user_info']['user_id']
                          ]);
 
                     if($img_add )
                         echo '1';
    }else if($_POST['proccessType']=='croping_image' ) { 
         
                  $photo_files = dirname(__FILE__)."/../modular/applications/profile_picture_applications.php";
                    if(is_file($photo_files)) require_once $photo_files ;
                    $imgpp_apis = new profile_picture_applications() ;
                     
                    $profilePict = $imgpp_apis->profile_pictureg_get_by_values([
                    'user_id'=>$_SESSION['user_info']['user_id']  
                    ],'and');
                    if(count($profilePict) != 0 ){
                             $filename = "../photo_albums/profile_picture/" . $profilePict[count($profilePict)-1]->photo_src ;
                   $filesource = dirname(__FILE__).'/'.$filename  ;
                   if(is_file($filesource))
                        {   //cropped_src
                                $rename_image = $_SESSION['user_info']['user_id']."__Cropped__". $profilePict[count($profilePict)-1]->photo_src;
                                $sourc_img = "../photo_albums/profile_picture/".$rename_image ;
                                
                               // crop settings
                                $dst_x = 0;
                                $dst_y  = 0 ;
                                $src_x = $_POST['x1'];
                                $src_y =  $_POST['y1'];
                                $dst_w = 150;
                                $dst_h = 150;
                                $src_w = $_POST['width_'];
                                $src_h = $_POST['height_'];
                                
                                $dst_image = imagecreatetruecolor($dst_w, $dst_h);
                                $src_image = imagecreatefromjpeg($filename);
                                imagecopyresampled($dst_image, $src_image, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h) ;
                                
                                 switch ($profilePict[count($profilePict)-1]->photo_type){
                                    case 'image/jpeg':
                                        imagejpeg($dst_image ,$sourc_img) ;
                                        break; 
                                    case 'image/gif':
                                        imagegif($dst_image ,$sourc_img) ;
                                        break; 
                                    case 'image/jpg':
                                        imagejpeg($dst_image ,$sourc_img) ;
                                        break; 
                                    case 'image/png':
                                        imagepng($dst_image ,$sourc_img) ;
                                        break; 
                                 }
                                 echo $rename_image ;
                        }
                    }
               
                   
    }
                
?>