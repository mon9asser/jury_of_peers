<?php
ob_start() ;
if(session_id()=='')
    session_start () ;
if(!isset($_SESSION['user_info']))
    return false ;


if(!isset($_POST['typeFFFF']))
    return false ;

 $files = dirname(__FILE__)."/../modular/autoload_apps.php";
 if(is_file($files )) require_once $files  ;
    

   // $_FILES['albumeCover'].' '.$_POST['albumTitle'].' type :- '.$_POST['typeFFFF'].' '.$_POST['selectCustom']   ;
    $music_album_apis = new video_film_categories_applications();
    $name_untitled = 'Untitled Video'; 
  $album_name_exist = $music_album_apis->video_film_categories_check_exist(['album_name'=>$name_untitled,'user_id'=> $_SESSION['user_info']['user_id']]);
   if($album_name_exist == NULL )
   {
        echo 'ssss';
        return false ;
   }
  
  
      
     $up =  $music_album_apis->video_film_categories_update_fields(
               [
                  'id'=>$album_name_exist->id , 
                  'user_id'=> $_SESSION['user_info']['user_id']    
              ], 
            [
                 'album_name'=>      $_POST['CategoryVideo']               ,
                 'timestamps'=>      time()                ,
                 'group_name'=>$_POST['nameOfGroup']
            ]);
     if($up) echo "1" ;
 
 
 
?>
