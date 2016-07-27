<?php
ob_start();
if(session_id()=='')
    session_start ();
 if(!isset($_SESSION))
    return false ;
 
    $file = dirname(__FILE__)."/../modular/autoload_apps.php";
    if(is_file($file ))    require_once $file ;
    
    $profilePic_apis = new profile_picture_applications() ;
   $prfPicExist =  $profilePic_apis->profile_pictureg_check_exist(['user_id'=>$_SESSION['user_info']['user_id']]) ;
   if($prfPicExist  == NULL )
       return false ;
   
   $getLastimageForme = $profilePic_apis->profile_pictureg_get_by_values(
                 [
                     'user_id'=>$_SESSION['user_info']['user_id']
                 ]  ,
                        'and');
   
   
   
   
   
   
   
   
   
   
   // image setting 
   $userId = $_SESSION['user_info']['user_id'];
   $dest_W = 150 ;
   $dest_H = 150 ;
   $src_Y = $_POST['destY'] ;
   $src_X = $_POST['destx'] ; ; 
   
   
     $profile_pic_apis = new profile_picture_applications();  
        $profilePicture = $profile_pic_apis->profile_pictureg_check_exist([
            'user_id'=>$userId , 
            'is_current'=>1
            ]);
       if($profilePicture != NULL )
       {
           $profilePict = $profile_pic_apis->profile_pictureg_get_by_values([
            'user_id'=>$userId , 
            'is_current'=>1
            ],'and');
            
          $img_name =  $profilePict[count($profilePict)-1]->photo_src ;
          $img_file = dirname(__FILE__) . "/../photo_albums/profile_picture/$img_name";
          $preview_folder_dest =("../user_image__croppedpreview/$img_name");
          $image_folder_src =  "../photo_albums/profile_picture/$img_name";
           if(is_file($img_file)) {
                // cropping func 
               
               $dst_image = imagecreatetruecolor($dest_W, $dest_H) ;
               $src_image = imagecreatefromjpeg($image_folder_src);
               imagecopyresampled($dst_image, $src_image, 0, 0 , $src_X, $src_Y, $dest_W, $dest_H, $dest_W , $dest_H);
              
               switch ($profilePict[count($profilePict)-1]->photo_type){
                   case 'image/jpeg':
                       imagejpeg($dst_image ,$preview_folder_dest) ;
                       break; 
                   case 'image/gif':
                       imagegif($dst_image ,$preview_folder_dest) ;
                       break; 
                   case 'image/jpg':
                       imagejpeg($dst_image ,$preview_folder_dest) ;
                       break; 
                   case 'image/png':
                       imagepng($dst_image ,$preview_folder_dest) ;
                       break; 
                }
                
               
                echo "<img id='thmb-image' src='user_image__croppedpreview/".$img_name."' />"  ;
           }else echo "2";
       }else echo "2";

         
?>

 
  