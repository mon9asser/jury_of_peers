<?php
    if(!isset($_GET['imgId']))
       {
           echo 'There are an errors';
           return false ;
       }

       
   $albumId = $_GET['imgId'] ;
   $folderName =   $_GET['folder'] ;
       
       $files = dirname(__FILE__)."/../modular/autoload_apps.php";
       if(is_file($files))
           require_once $files ;
       
       $imageApis = new images_applications() ;
       $img = $imageApis->images_applications_check_exist(['id'=>$albumId]);
       
   ?>
<img class="img-opend" src="photo_albums/<?php if($folderName  == 'timeline/' )   echo 'timeline/';  ; ?><?php echo $img->img_src ; ?>" />
