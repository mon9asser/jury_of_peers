<?php
ob_start() ;
if(session_id()=='')
    session_start () ;
 
$files = dirname(__FILE__)."/../modular/autoload_apps.php"; 
if(is_file($files))    require_once $files; 
 
                              
                                 $albumApis = new albums_photos_get_more_pagination_package();
                                  $albumsExist =  $albumApis->albums_of_photo_load_more($_POST['lastId'] , 3 , $_POST['user_id'] ); 
                                  if(count($albumsExist) != 0)
                                    {
                                     
                                            $album = $albumApis->albums_of_photo_load_more($_POST['lastId'] , 3 , $_POST['user_id'] ); 
                                             if(is_array($album)  ){
                                           for($i=0;$i<count($album);$i++){
                                               $images = new images_applications();
                                               $img = $images->images_applications_get_by_values([
                                                   'album_id'=>$album[$i]->id
                                               ],'and');
                                            
                                               
                                               if(count($img)!= 0 ){
                                                   
                                                  ?>
                                                    <div onclick="openThisAlbum(<?php echo $album[$i]->id ?> , this );" style="background-image: url(photo_albums/<?php if(trim($album[$i]->album_name) =='timeline' )   echo 'timeline/';  ; ?><?php echo $img[count($img)-1]->img_src ; ?>);" class="mmphoto albums">
                                                        <div class="mask-image">
                                                            <b class="titlenames">
                                                              <?php echo ucfirst( $album[$i]->album_name ); ?>  
                                                            </b>
                                                         </div> 
                                                    </div>
                                                  <?php  
                                                  $lastId = $album[$i]->id ;
                                               }
                                               
                                           }}
                                     } 
                            ?>
                                <input class="lastIdForm" type="hidden" value="<?php echo $lastId ; ?>" />
                                <?php

  session_write_close() ;
?>