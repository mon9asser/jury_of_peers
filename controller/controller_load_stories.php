<?php
ob_start() ;
if (session_id()=='')
    session_start () ;

    
    
    $filesD = dirname(__FILE__)."/../modular/autoload_apps.php";
    if(is_file($filesD)) require_once $filesD ;
     
?>

<?php

    $pagination_Apis = new user_get_more_pagination_package_pst();
   $apps = new apps();
   $homePageContents = NULL ;
   if( isset($_POST['appType'] ) AND $_POST['appType'] == 0){
       if(!isset($_POST['lastId']))
           return FALSE ;
          $homePageContents = $pagination_Apis->load_posts_according_to_args($_POST['lastId'], 3 ,$_POST['user-id']);
    }else
    {
        if(!isset($_POST['lastTime']))
        return false ;
        
           $homePageContents = $pagination_Apis->home_page_load_contents($_POST['lastTime'], 3 , $_SESSION['user_info']['user_id']);

    }
   
   
   if($homePageContents == NULL ){
       echo '1';
       return false ;
       }
 ?>
<?php
    if(is_array($homePageContents) ){ 
        for($i=0; $i<count($homePageContents);$i++){ 
                      ?>
                        
                        
                        
                        
                        
                        <div style="" class="postContainer">
                        
                        <ul class="acc">
                            
                             <?php
                            $judgeType = 'txtOnly' ;
                                switch ($homePageContents[$i]->post_type_num){
                                    case  '' :  // TEXTS
                                         $judgeType = 'txtOnly';
                                        break ;
                                    case  0 :   // IMAGES - PHOTOS
                                         $judgeType = 0;
                                        break ;
                                    case  1 : // Music
                                         $judgeType = 1;
                                        break ;
                                    case  2 : // Video
                                         $judgeType =2 ;
                                        break ;
                                    case  3 :
                                         $judgeType = 3;
                                        break ;
                                   case  4:
                                         $judgeType = 4;
                                        break ;
                                   case  5 :
                                         $judgeType = 5;
                                        break ;
                                  case  6 :
                                         $judgeType = 6;
                                        break ;
                                  case  7 :
                                         $judgeType = 7;
                                        break ;
                                }
                            ?>
                            <?php
                                if($homePageContents[$i]->posted_by_id == $_SESSION['user_info']['user_id']){
                                 ?>
                                        <li data-toggle="tooltip" data-placement="left" title="Delete">
                                            <a onclick="delete_post(<?php echo $homePageContents[$i]->id;?> , this);">
                                               <i style=" " class="fa fa-remove iconstilsh"></i>
                                           </a>
                                       </li>
                                  <?php   
                                }
                            ?>
                            <li>
                                <a onclick="return loadComments('comment_no_<?php echo $homePageContents[$i]->id;?>',<?php echo $homePageContents[$i]->id;?>,this);" class="commentIcon_<?php echo $homePageContents[$i]->id;?>">
                                    <i class="fa fa-comment iconstilsh"></i>
                                </a>
                            </li>
                            <li>
                                <?php
                                $likes_dislikes= new user_like_dislikes_applications();
                                $islikeSys = $likes_dislikes->user_like_dislikes_check_exist(['liked_by_userid'=>$_SESSION['user_info']['user_id'],'post_id'=>$homePageContents[$i]->id]);
                                ?>
                                <a onclick="like_dislike1(<?php echo $homePageContents[$i]->id;?> , 1 , this);">
                                    <i style="
                                        <?php
                                        if($islikeSys != NULL ){
                                            if($islikeSys->is_liked == 1){
                                                echo "
                                                background: floralwhite ;
                                                border: 1px solid #dcdcdc ;
                                                color: tomato ;
                                                " ;
                                            }
                                        }
                                       ?>
                                       " class="fa fa-thumbs-o-up iconstilsh"></i>
                                </a>
                            </li>
                            <li>
                                <a onclick="like_dislike2(<?php echo $homePageContents[$i]->id;?> , 0 , this);">
                                    <i style="
                                       <?php
                                        if($islikeSys != NULL ){
                                            if($islikeSys->is_liked == 0){
                                                echo "
                                                background: floralwhite ;
                                                border: 1px solid #dcdcdc ;
                                                color: tomato ;
                                                " ;
                                            }
                                        }
                                       ?>
                                       " class="fa fa-thumbs-o-down iconstilsh"></i>
                                </a>
                            </li>
                             <li>
                                
                                <a is_isset='0' onclick=" <?php if ($judgeType == 'txtOnly') { ?> judge_this_story(<?php echo $homePageContents[$i]->id;?> ,'homePostContainer<?php echo $homePageContents[$i]->id;?>' ,'<?php echo $judgeType;?>', this)  <?php } ?> 
                                    <?php
                                          if($judgeType == 1 ){ // music
                                            echo "window.location.href='album_music?code=".$homePageContents[$i]->post_serial_id ."'";
                                        }else if ($judgeType == 2 ) { // video
                                             echo "window.location.href='video_judge?id=".$homePageContents[$i]->video_id ."'";
                                         } 
                                    ?>
                                    " class="">
                                    <i style="background-image: url(images/hconstitutional.png);" class="iconstilsh disputs dyt"></i>
                                </a>
                            </li>
                        </ul>
                        
                         
                            <div style="position: relative;" id="homePostContainer<?php echo $homePageContents[$i]->id;?>" class="homePostContainer">
                               
        
                            
                            
                            
                                
                                    
                            
                            
                            
                                
                        
                        
                        
                            
                        
                        
                            
                                    <!-- Start POST -->
                                <div class="userProfileInfo">
                                    <a class="gootoProfil" href="http://www.juryofpeers.tv/?user=<?php echo $homePageContents[$i]->u_name ;?>">
                                    <div class="user-image headerimage" style="background-image: url(photo_albums/profile_picture/<?php echo get_profile_picture($homePageContents[$i]->posted_by_id); ?>);"></div>
                                    <div class="user-posts-name">
                                        <b> 

                                            <?php echo $homePageContents[$i]->u_name ; ?>

                                            <?php
                                                if($homePageContents[$i]->post_type_num == 3 )
                                                    {   
                                                        $gender = NULL ; 
                                                        if($homePageContents[$i]->gender == 1 )
                                                        $gender = 'her' ;
                                                        else 
                                                        $gender = 'his';
                                                        echo '<span class="descrip-profile">changed '.$gender.' profile picture </span> ';
                                                    }
                                            ?>

                                        </b>

                                        <div class="clearFix"></div>
                                        <a>
                                            <span class="time-shared">
                                                <?php
                                                    $GeneralApis = new apps();
                                                    echo 'From '. $GeneralApis->time_elapsed_string($homePageContents[$i]->timestamps);
                                                ?> 
                                            </span>
                                            <i class="fa reposition
                                                <?php
                                                switch ($homePageContents[$i]->access_permission) {
                                                case 1:
                                                echo "fa-globe";
                                                break;
                                                case 2:
                                                echo "fa-lock sty";
                                                break;
                                                case 0:
                                                echo "fontello icon-user-6";
                                                break;
                                                }
                                                ?>
                                                " title="
                                                <?php
                                                switch ($homePageContents[$i]->access_permission) {
                                                case 0:
                                                echo "Shared with Friends Only";
                                                break;
                                                case 1:
                                                echo "Shared with Public";
                                                break;
                                                case 2:
                                                echo "Shared with Only me";
                                                break;
                                                }
                                                ?>
                                                " data-toggle="tooltip" data-placement="right" aria-hidden="true">
                                             </i> 
                                        </a>
                                     </div>
                                    </a>
                                </div>
                                <div class="post-conts">
                                    <!-- Text Only timeline -->
                                    <?php
                                        if($homePageContents[$i]->post_text_id != 0)
                                        {
                                            ?>
                                            <div class="get-text-post">
                                              
                                                <?php $app = new apps(); ?>
                                                <?php echo $app->emoticonsProvider($homePageContents[$i]->post_text) ; ?>
                                            </div>
                                            <?php
                                        }
                                    ?>

                                    <!-- Image timeline -->
                                    <?php if($homePageContents[$i]->post_type_num == 0 ){ ?>
                                        <?php if($homePageContents[$i]->img_src != NULL ) { ?>
                                            <img class="img-responsive img-posts" src="photo_albums/timeline/<?php echo $homePageContents[$i]->img_src ; ?>" />
                                        <?php } ?>
                                    <?php } ?>
                                            
                                   <!-- Image timeline -->
                                    <?php if($homePageContents[$i]->post_type_num == 3 ){ ?>
                                        <?php if($homePageContents[$i]->photo_src != NULL ) { ?>
                                           <img class="img-responsive img-posts" src="photo_albums/profile_picture/<?php echo $homePageContents[$i]->photo_src;?>" />
                                        <?php } ?>
                                    <?php } ?>     
                                       
                                      <?php
                                       
                                        
                                      ?>
                                  <!-- Video timeline -->
                                    <?php if($homePageContents[$i]->post_type_num == 2 ){ ?>
                                        <?php if($homePageContents[$i]->video_src != NULL ) { ?>
                                        <?php
                                            $videoSrcWMp3 =   $homePageContents[$i]->video_src ;  
                                            $output = rtrim($videoSrcWMp3, '.mp3');
                                        ?>
                                            <!-- $variable = substr(strrchr($path, "."), 1); -->
                                             <div class="videoContainerDisplay">
                                                 <video width="100%" height="100%" controls>
                                                    <source src="video_albums/timeline/<?php echo $videoSrcWMp3 ?>" type="video/mp4">
                                                    <source src="video_albums/timeline/<?php echo $output ;?>.ogg" type="video/ogg">
                                                    Your browser does not support the video tag.
                                                  </video>
                                             </div>
                                         <?php } ?>
                                    <?php } ?>               
                                            
                                        
                                            
                                            
                                       <!-- Links timeline -->
                                    <?php if($homePageContents[$i]->post_type_num == 121 ){ ?>
                                        <?php if($homePageContents[$i]->url_links != NULL ) { ?>
                                            <?php
                                                // Read youtube Or Vimeo
                                                if(strpos($homePageContents[$i]->url_links, 'youtube.com') > 0  OR strpos($homePageContents[$i]->url_links, 'vimeo.com') > 0){
                                                    $apps = new apps() ;
                                                    $apps->embed_vimeo_youtube_video($homePageContents[$i]->url_links);
                                                }else { // Read another Links  
                                                    ?>
                                                <div style="cursor: pointer;" onclick="window.location.href='<?php echo $homePageContents[$i]->url_links  ;?>'">

                                                         <div style="background-image: url(<?php echo $homePageContents[$i]->image_src ;?>)" class="thumbnails-image">
                                                        <div class="mask-image"></div>
                                                         <a class="url-links"><?php echo substr($homePageContents[$i]->url_links , 0, 53);  ?>   </a>
                                                        </div>
                                                        <div class="thumbnails-text-links">
                                                            <h3> <?php echo  $homePageContents[$i]->title ;  ?></h3>
                                                            <p>
                                                               <?php 
                                                                 echo substr( $homePageContents[$i]->description, 0, 152 );

                                                               ?>
                                                           </p>
                                                        </div>
                                                </div>
                                                        <?php
                                                }
                                            ?>
                                         <?php } ?>
                                    <?php } ?>  

                                    
                                            
                                            
                                            
                                    <!-- Music timeline -->
                                    <?php if($homePageContents[$i]->post_type_num == 1 ){ ?>
                                        <?php if($homePageContents[$i]->music_src != NULL ){ ?>
                                            <div class="musicTimeline">
                                                 <div class="musicController">
                                                     <?php
                                                        $bg = NULL ;
                                                        $musicCoverFile =  dirname(__FILE__)."/music_albums/music_covers/".$homePageContents[$i]->music_cover;  
                                                      ?>
                                                     <div style="background-image: url(<?php echo "music_albums/music_covers/".$homePageContents[$i]->music_cover ;?>);" class="imgThumnails">
                                                        <i class='fa fa-music mmudisc' style='font-size: 47px;display: block;margin: 0px auto;display: inline;width: 100%;margin-top: 17px;display: inline-block;margin-left: -5px;color: tomato;opacity: 0.5;'></i> 
                                                      </div>
                                                     <div class="songInfo">
                                                         <!-- 
                                                            <font class="icon-googleplay font-music-icon"></font>
                                                         -->
                                                            <b class="sonName">
                                                                <?php
                                                                   if($homePageContents[$i]->music_name != NULL )
                                                                       echo $homePageContents[$i]->music_name ;
                                                                   else 
                                                                       echo "Unknown Name";
                                                                 ?>
                                                                <span class="singerName">
                                                                    <?php
                                                                    if($homePageContents[$i]->singer_name != NULL )
                                                                       echo $homePageContents[$i]->singer_name ;
                                                                   else 
                                                                       echo "Unknown Singer";
                                                                     ?>
                                                                </span>
                                                            </b>
                                                      </div>  
                                                     <!-- icon-googleplay Play/Pause icon-pause-5 -->
                                                     <div id-attr="song<?php echo $homePageContents[$i]->id ;?>" id="song<?php echo $homePageContents[$i]->id ;?>" audio-source='<?php echo $homePageContents[$i]->music_src ;?>' class="musicOp playthis">
                                                            <font class="icon-googleplay font-music-icon"></font>
                                                      </div>
                                                       <div style='display:none;' id-attr="song<?php echo $homePageContents[$i]->id ;?>" id="song<?php echo $homePageContents[$i]->id ;?>" audio-source='<?php echo $homePageContents[$i]->music_src ;?>' class="musicOp playthispaus">
                                                            <font class="icon-pause-5 font-music-icon"></font>
                                                      </div>
                                                  </div>
                                                <!-- 
                                                <input max="100" min="0" value="0" step="1" class="wholeTrack" type="range">
                                                --> 
                                             </div>
                                        <?php } ?>
                                    <?php } ?>




                                </div>
                                
                                
                                
                                <!-- add new comment -->
                                <div class="add-com-hp"> 
                                  <div class="user-image" style="background-image:  url(photo_albums/profile_picture/<?php echo get_profile_picture($_SESSION['user_info']['user_id']); ?>);"></div>
                                  <textarea id="writeComment" onkeypress="return commentOn(event , this , <?php echo $homePageContents[$i]->id ;?>,'comment_no_<?php echo $homePageContents[$i]->id ;?>');" onkeydown="return resizeComment(this);" class="writeComment textareas" placeholder="Write Comment"></textarea>
                                </div>
                                <!-- Comment -->
                                <div class="loadComments comment_no_<?php echo $homePageContents[$i]->id ;?>"></div>
                            <!-- End Post -->
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                        
                        
                                </div>
                         </div>
                    <?php
                        $lastTime = $homePageContents[$i]->timeupdates ;
        }
    }else {
        echo '1';
        return false ;
    }
?>




<?php
    if (!isset($_POST['appType']))
    {
        ?>
<input type="hidden" class="lastTimess" value="<?php echo $homePageContents[count($homePageContents)-1]->timeupdates ;?>" />
        <?php
    }else {
    if($_POST['appType'] == 0){ 
?>
<input type="hidden" class="lastTimess" value="<?php echo $homePageContents[count($homePageContents)-1]->id ;?>" />
   <?php }  } ?>
<script src="../js/audioPlay.js"></script>