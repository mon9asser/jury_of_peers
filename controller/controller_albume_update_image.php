<?php
ob_start() ;
if(session_id()=='')
    session_start () ;
if(!isset($_SESSION['user_info']))
    return false ;
 
 $files = dirname(__FILE__)."/../modular/autoload_apps.php";
 if(is_file($files )) require_once $files  ;
    
   
   // $_FILES['albumeCover'].' '.$_POST['albumTitle'].' type :- '.$_POST['typeFFFF'].' '.$_POST['selectCustom']   ;
    $music_album_apis = new photo_albums_applications();
    $name_untitled = 'Untitled Album'; 
  $album_name_exist = $music_album_apis->photo_albums_check_exist(['album_name'=>$name_untitled,'user_id'=> $_SESSION['user_info']['user_id']]);
   if($album_name_exist == NULL )
   {
        echo 'ssss';
        return false ;
   }
  
  
      
     $up =  $music_album_apis->photo_albums_update_fields(
               [
                  'id'=>$album_name_exist->id , 
                  'user_id'=> $_SESSION['user_info']['user_id']    
              ], 
            [
                'album_name'=>      $_POST['imgAlbumName']               ,
                'timestamps'=>      time()      ,
                'access_permission'=>$_POST['preview-img-access']
            ]);
     if($up) echo "1" ;
 
 
 
?>
