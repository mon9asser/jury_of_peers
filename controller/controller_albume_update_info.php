<?php
ob_start() ;
if(session_id()=='')
    session_start () ;
if(!isset($_SESSION['user_info']))
    return false ;

 $files = dirname(__FILE__)."/../modular/autoload_apps.php";
 if(is_file($files )) require_once $files  ;
   

 
 if(!isset( $_FILES['albumeCover']) ||!isset($_POST['albumTitle']) ||!isset($_POST['typeFFFF']) ||!isset($_POST['selectCustom'])  )
 {
     echo "error";
     return FALSE ;
 }
 
 // $_FILES['albumeCover'].' '.$_POST['albumTitle'].' type :- '.$_POST['typeFFFF'].' '.$_POST['selectCustom']   ;
  $type = trim( $_POST['typeFFFF']);
   $albumCover = $_FILES['albumeCover'] ;
 $albumTitle = trim($_POST['albumTitle']);
  $sharedWith = trim($_POST['selectCustom']);
  $name_untitled = trim('Untitled Album') ;
  $fileName =  $_FILES['albumeCover']['name'];
  $fileTmpLoc = $_FILES["albumeCover"]["tmp_name"]; 
    $type_of_images = [
                        strtolower(trim('image/jpeg'))      ,
                        strtolower(trim('image/gif'))       ,
                        strtolower(trim('image/jpg'))       ,
                        strtolower(trim('image/png'))
                    ];
  
   if(!in_array(  strtolower(trim($_FILES['albumeCover']['type'])) , $type_of_images )){
                         echo "2";
                         return false ;
                      } 
  
                      
               
 $image_rename = rand(2000 , 1000000) . "_" .time() . "_".rand(2000 , 1000000) . "music_cover_juryofpeers_".$fileName; 
    $fileRoot = dirname (__FILE__) . "/../music_albums/music_covers/$image_rename";

                    // upload file to server 
   move_uploaded_file($fileTmpLoc , $fileRoot) ;                    
                      
  $music_album_apis = new music_albums_applications();
     
  $album_name_exist = $music_album_apis->music_albums_check_exist(['album_name'=>$name_untitled,'user_id'=> $_SESSION['user_info']['user_id']]);
   if($album_name_exist == NULL )
   {
        echo 'ssss';
        return false ;
   }
  
 if( trim( $_POST['typeFFFF']) == 'n' )
 {  
      
     $up =  $music_album_apis->music_albums_update_fields(
        
              [
                  'id'=>$album_name_exist->id , 
                  'user_id'=> $_SESSION['user_info']['user_id']    
              ], 
            [
                 'album_name'=>      $albumTitle               ,
                 'timestamps'=>      time()                ,
                 'album_cover'=>  $image_rename
            ]);
     if($up) echo "1" ;
 }else {
     
     
      
 }
 
 
?>
