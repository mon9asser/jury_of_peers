<?php
    if(!isset($_GET['album']))
       {
           echo 'There are an errors';
           return false ;
       }

       
   $albumId = $_GET['album'] ;
   $folderName =   $_GET['folder'] ;
       
       $files = dirname(__FILE__)."/../modular/autoload_apps.php";
       if(is_file($files))
           require_once $files ;
       
       $imageApis = new images_applications() ;
       $img = $imageApis->images_applications_get_by_values(['album_id'=>$albumId], 'and');
       
   ?>

<?php for($i=0;$i<count($img);$i++) { ?>
<div onclick="openThisImage(<?php echo $img[$i]->id ?> ,'<?php echo $folderName ?>' , this );" style="background-image: url(photo_albums/<?php if($folderName  == 'timeline/' )   echo 'timeline/';  ; ?><?php echo $img[$i]->img_src ; ?>);" class="mmphoto albums"></div>
<?php } ?>