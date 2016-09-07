<?php
ob_start() ;
if(session_id() == '')
    session_start() ;

 
 $files = dirname(__FILE__)."/../modular/autoload_apps.php";
 if(is_file($files )) require_once $files  ;


if(!isset($_SESSION['user_info']['user_id']))
{
    echo "<center>
            <b>There are an error in load last post ! , pleas try later </b>
        </center> ";
    return false ;
}
if(!isset($_POST['userId']))
{
    echo "<center>
            <b>There are an error in load last post ! , pleas try later </b>
        </center> ";
    return false ;
}

$userId = $_POST['userId'] ;
?>

<?php
                     $lastTime = 0 ;
                       $pagination_Apis = new user_get_more_pagination_package_pst();
                       $apps = new apps();
                       $profilePageContents = $pagination_Apis->load_posts_according_to_args(0, 1 ,$userId);
                     ?>
                    <?php
                   
                      //  echo "<pre>";
                      //  print_r($profilePageContents);
                       // echo "</pre>";
                    ?>
 
<div  class="mstories asas ">
                    <?php
                                     
                        if(is_array($profilePageContents)){
                    ?>
                    <?php for($i=0; $i<count($profilePageContents);$i++){
                        
                        
                        ?>
     <?php
                            $judgeType = 'txtOnly' ;
                                switch ($profilePageContents[$i]->post_type_num){
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
                    <div class="postContainer">
                        <ul class="acc">
                            <li>
                                <a onclick="return loadComments('comment_no_<?php echo $profilePageContents[$i]->id;?>',<?php echo $profilePageContents[$i]->id;?>,this);" class="commentIcon_<?php echo $profilePageContents[$i]->id;?>">
                                    <i class="fa fa-comment iconstilsh"></i>
                                </a>
                            </li>
                            <li>
                                <?php
                                $likes_dislikes= new user_like_dislikes_applications();
                                $islikeSys = $likes_dislikes->user_like_dislikes_check_exist(['liked_by_userid'=>$_SESSION['user_info']['user_id'],'post_id'=>$profilePageContents[$i]->id]);
                                ?>
                                <a onclick="like_dislike1(<?php echo $profilePageContents[$i]->id;?> , 1 , this);">
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
                                <a onclick="like_dislike2(<?php echo $profilePageContents[$i]->id;?> , 0 , this);">
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
                              <?php if ($_SESSION['user_info']['user_id'] != $profilePageContents[$i]->posted_by_id){ ?>
                            <li data-toggle="tooltip" data-placement="left" title="Judge">
                                 <a
                                     is_isset='0' onclick="<?php
                                        if ($judgeType == 808){
                                             echo "judge_this_story(".$profilePageContents[$i]->id.",'homePostContainer".$profilePageContents[$i]->id."',".$judgeType.",this)";
                                        }else if($judgeType == 1 ){ // music
                                            echo "window.location.href='album_music?code=".$profilePageContents[$i]->post_serial_id ."'";
                                        }else if ($judgeType == 2 ) { // video
                                             echo "window.location.href='video_judge?id=".$profilePageContents[$i]->video_id ."'";
                                        }else if ($judgeType == 22){
                                               echo "judge_this_story(".$profilePageContents[$i]->id.",'homePostContainer".$profilePageContents[$i]->id."',".$judgeType.",this)";
                                        }
                                             
                                    ?>" class="">
                                    <i style="background-image: url(images/hconstitutional.png);" class="iconstilsh disputs dyt"></i>
                                </a>
                            </li>
                            <?php } ?>
                        </ul>
                                
                         
                             <div class="homePostContainer">
                                <!-- User info -->
                                <div class="userProfileInfo">
                                    <a class="gootoProfil" href="http://www.juryofpeers.tv/?user=<?php echo $profilePageContents[$i]->u_name ;?>">
                                    <div class="user-image headerimage" style="background-image: url(photo_albums/profile_picture/<?php echo get_profile_picture($profilePageContents[$i]->posted_by_id); ?>);"></div>
                                    <div class="user-posts-name">
                                        <b> 

                                            <?php echo $profilePageContents[$i]->u_name ; ?>

                                            <?php
                                                if($profilePageContents[$i]->post_type_num == 3 )
                                                    {   
                                                        $gender = NULL ; 
                                                        if($profilePageContents[$i]->gender == 1 )
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
                                                    echo 'From '. $GeneralApis->time_elapsed_string($profilePageContents[$i]->timestamps);
                                                ?> 
                                            </span>
                                            <i class="fa reposition
                                                <?php
                                                switch ($profilePageContents[$i]->access_permission) {
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
                                                switch ($profilePageContents[$i]->access_permission) {
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
                                        if($profilePageContents[$i]->post_text_id != 0)
                                        {
                                            ?>
                                            <div class="get-text-post">
                                                
                                                <?php $app = new apps(); ?>
                                                <?php echo $app->emoticonsProvider($profilePageContents[$i]->post_text) ; ?>
                                            </div>
                                            <?php
                                        }
                                    ?>

                                    <!-- Image timeline -->
                                    <?php if($profilePageContents[$i]->post_type_num == 0 ){ ?>
                                        <?php if($profilePageContents[$i]->img_src != NULL ) { ?>
                                            <img class="img-responsive img-posts" src="photo_albums/timeline/<?php echo $profilePageContents[$i]->img_src ; ?>" />
                                        <?php } ?>
                                    <?php } ?>
                                            
                                   <!-- Image timeline -->
                                    <?php if($profilePageContents[$i]->post_type_num == 3 ){ ?>
                                        <?php if($profilePageContents[$i]->photo_src != NULL ) { ?>
                                           <img class="img-responsive img-posts" src="photo_albums/profile_picture/<?php echo $profilePageContents[$i]->photo_src;?>" />
                                        <?php } ?>
                                    <?php } ?>     
                                       
                                      <?php
                                       
                                        
                                      ?>
                                  <!-- Video timeline -->
                                    <?php if($profilePageContents[$i]->post_type_num == 2 ){ ?>
                                        <?php if($profilePageContents[$i]->video_src != NULL ) { ?>
                                        <?php
                                            $videoSrcWMp3 =   $profilePageContents[$i]->video_src ;  
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

                                    <!-- Music timeline -->
                                    <?php if($profilePageContents[$i]->post_type_num == 1 ){ ?>
                                        <?php if($profilePageContents[$i]->music_src != NULL ){ ?>
                                            <div class="musicTimeline">
                                                 <div class="musicController">
                                                     <?php
                                                        $bg = NULL ;
                                                        $musicCoverFile =  dirname(__FILE__)."/music_albums/music_covers/".$profilePageContents[$i]->music_cover;  
                                                      ?>
                                                     <div style="background-image: url(<?php echo "music_albums/music_covers/".$profilePageContents[$i]->music_cover ;?>);" class="imgThumnails">
                                                        <i class='fa fa-music mmudisc' style='font-size: 47px;display: block;margin: 0px auto;display: inline;width: 100%;margin-top: 17px;display: inline-block;margin-left: -5px;color: tomato;opacity: 0.5;'></i> 
                                                      </div>
                                                     <div class="songInfo">
                                                         <!-- 
                                                            <font class="icon-googleplay font-music-icon"></font>
                                                         -->
                                                            <b class="sonName">
                                                                <?php
                                                                   if($profilePageContents[$i]->music_name != NULL )
                                                                       echo $profilePageContents[$i]->music_name ;
                                                                   else 
                                                                       echo "Unknown Name";
                                                                 ?>
                                                                <span class="singerName">
                                                                    <?php
                                                                    if($profilePageContents[$i]->singer_name != NULL )
                                                                       echo $profilePageContents[$i]->singer_name ;
                                                                   else 
                                                                       echo "Unknown Singer";
                                                                     ?>
                                                                </span>
                                                            </b>
                                                      </div>  
                                                     <!-- icon-googleplay Play/Pause icon-pause-5 -->
                                                     <div id-attr="song<?php echo $profilePageContents[$i]->id ;?>" id="song<?php echo $profilePageContents[$i]->id ;?>" audio-source='<?php echo $profilePageContents[$i]->music_src ;?>' class="musicOp playthis">
                                                            <font class="icon-googleplay font-music-icon"></font>
                                                      </div>
                                                       <div style='display:none;' id-attr="song<?php echo $profilePageContents[$i]->id ;?>" id="song<?php echo $profilePageContents[$i]->id ;?>" audio-source='<?php echo $profilePageContents[$i]->music_src ;?>' class="musicOp playthispaus">
                                                            <font class="icon-pause-5 font-music-icon"></font>
                                                      </div>
                                                  </div>
                                                <!-- 
                                                <input max="100" min="0" value="0" step="1" class="wholeTrack" type="range">
                                                --> 
                                             </div>
                                        <?php } ?>
                                    <?php } ?>

                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    <!-- Links timeline -->
                                    <?php if($profilePageContents[$i]->post_type_num == 121 ){ ?>
                                        <?php if($profilePageContents[$i]->url_links != NULL ) { ?>
                                            <?php
                                                // Read youtube Or Vimeo
                                                if(strpos($profilePageContents[$i]->url_links, 'youtube.com') > 0  OR strpos($profilePageContents[$i]->url_links, 'vimeo.com') > 0){
                                                    $apps = new apps() ;
                                                    $apps->embed_vimeo_youtube_video($profilePageContents[$i]->url_links);
                                                }else { // Read another Links  
                                                    ?>
                                                <div style="cursor: pointer;" onclick="window.location.href='<?php echo $profilePageContents[$i]->url_links  ;?>'">

                                                         <div style="background-image: url(<?php echo $profilePageContents[$i]->image_src ;?>)" class="thumbnails-image">
                                                        <div class="mask-image"></div>
                                                         <a class="url-links"><?php echo substr($profilePageContents[$i]->url_links , 0, 53);  ?>   </a>
                                                        </div>
                                                        <div class="thumbnails-text-links">
                                                            <h3> <?php echo  $profilePageContents[$i]->title ;  ?></h3>
                                                            <p>
                                                               <?php 
                                                                 echo substr( $profilePageContents[$i]->description, 0, 152 );

                                                               ?>
                                                           </p>
                                                        </div>
                                                </div>
                                                        <?php
                                                }
                                            ?>
                                         <?php } ?>
                                    <?php } ?>  

                                    
                                </div>
                                
                                
                                
                                <!-- add new comment -->
                                <div class="add-com-hp"> 
                                  <div class="user-image" style="background-image:  url(photo_albums/profile_picture/<?php echo get_profile_picture($_SESSION['user_info']['user_id']); ?>);"></div>
                                  <textarea id="writeComment" onkeypress="return commentOn(event , this , <?php echo $profilePageContents[$i]->id ;?>,'comment_no_<?php echo $profilePageContents[$i]->id ;?>');" onkeydown="return resizeComment(this);" class="writeComment textareas" placeholder="Write Comment"></textarea>
                                </div>
                                <!-- Comment -->
                                <div class="loadComments comment_no_<?php echo $profilePageContents[$i]->id ;?>"></div>
                            </div>
                         </div>
                    <?php
                        $lastTime = $profilePageContents[$i]->id ;
                    ?>
                    <?php } ?>
                     
                    <input type="hidden" class="lastTimess" value="<?php echo $lastTime ;?>" />
                    </div>
<?php 
                        }
?>


<script type="text/javascript" src="js/audioPlay.js"></script>