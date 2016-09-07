<?php
ob_start() ;
if(session_id() =='')
    session_start() ;

   
 $files = dirname(__FILE__)."/../modular/autoload_apps.php";
 if(is_file($files )) require_once $files  ;

if(!isset($_SESSION['user_info']['user_id']))
    return false ;


if(!isset($_POST['switch_type']))
    return FALSE ;
if(!isset($_POST['postId']))
    return FALSE ;


$swichType = $_POST['switch_type'] ;
$last_id = $_POST['postId'] ; 
$postApis = new user_get_more_pagination_package_pst(); 
$paginPost = $postApis ->load_posts_accordin_to_id($last_id);
?> 
<?php
    if($swichType == 0 ){
        ?>

        <?php
            // Information 
            $courInitApis = new courtroom_init_applications();
            $likUlikApis = new user_like_dislikes_applications();
            $commentApis = new comments_applications();
            $evaluationApis = new reviews_rating_applications() ;
           // courtrooms
           $initCourtroom =  $evaluationApis ->reviews_rating_apis_get_sum_of_program( 
                 " WHERE post_id= {$last_id}  AND program_type=0"
              );
           //likes
           $liks = $likUlikApis->user_like_dislikes_get_by_values(['post_id'=>$last_id ,
               'is_liked'=> 1
            ], 'and');
           
           $unliks = $likUlikApis->user_like_dislikes_get_by_values(['post_id'=>$last_id ,
               'is_liked'=> 0
            ], 'and');
           // comments 
           $comments = $commentApis->comments_get_by_values(['post_id'=>$last_id] , 'and')
        ?>

<link rel="stylesheet" href="css/fontello.css"> 
<link rel="stylesheet" href="css/jquery.raty.css">
<script src="js/jquery.raty.js"></script>
<div class="moduleCourtRoom" id="">
        <div class="md-content">
            <b style="font-size: 25px;width: 100%;display: block ;"> Judge this photo </b>
            <div class="ratReviews">
                  <b style="width: 100%;display: block ; border-bottom: 1px solid #eee;">
                    <ul class="mainInfoMenu">
                        <li>
                             Photo Statisitics :
                         </li> 
                        <li aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Likes">
                            
                              <?php
                                echo count ($liks) ;
                             ?>
                            <i class="fa fa-thumbs-o-up"></i>
                             
                        </li>
                        <li aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Unlikes">
                            <?php
                                echo count ($unliks) ;
                             ?>
                            <i class="fa fa-thumbs-o-down"></i>
                        </li>
                        <li aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Comments">
                             <?php
                                echo count ($comments) ;
                             ?>
                            <i class="fa fa-comments"></i>
                        </li>
                        <li aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Photo Judgments">
                            <?php
                                 $counts = $initCourtroom->rows_count ;
                                 $sumRows = $initCourtroom->rows_sum ;
                                 $fixed = 0.05 ;
                                    if($sumRows != 0 ){
                                    $rowPercent = $counts * $fixed ;
                                    $perccentStar = $sumRows / $rowPercent ;
                                    $starss =     $perccentStar * $fixed     ;
                                    echo substr($starss, 0, 3); 
                                 }
                                 
                                 else echo 0 ;
                             ?>
                            <i class="" style="
                                    width: 24px;
                                    height: 25px;
                                    overflow: hidden;
                                    background-size: 18px 18px;
                                    background-repeat: no-repeat;
                                    background-image: url(images/image-on.png);
                                    padding: 9px 13px 11px 13px;
                                    background-position: 1px 8px;
                                    display: inline-block;
                                     margin-top: 5px;
                                    display: inline;
                                    margin-left: 3px;
                                "></i>
                        </li>
                    </ul>
                </b> 
            </div>
            <div class="evaluateContainer evaluatePhoto">
                <div post-id="<?php echo $last_id ; ?>" style="
                       cursor: pointer;
                            padding: 7px;
                        display: block;
                          background-repeat: no-repeat;
                        background-size: 40px 40px;
                        padding-left: 59px;
                        background-position: 7px 30px;
                        float: left; 
                        background-position: 4px 4px;
                         background-image: url(images/1471896826_preview.png);
                        
                     " id="evaluatePhoto<?php echo $last_id ; ?>"></div>
            </div> 
         </div> 
</div>        <?php
    }else {
        // POST 
        ?>
            
            
             <!-- User POST -->
                                <div class="userProfileInfo">
                                    <a class="gootoProfil" href="http://www.juryofpeers.tv/?user=<?php echo $paginPost->u_name ;?>">
                                    <div class="user-image headerimage" style="background-image: url(photo_albums/profile_picture/<?php echo get_profile_picture($paginPost->posted_by_id); ?>);"></div>
                                    <div class="user-posts-name">
                                        <b> 

                                            <?php echo $paginPost->f_name . " " .  $paginPost->s_name ; ?>

                                            <?php
                                                if($paginPost->post_type_num == 3 )
                                                    {   
                                                        $gender = NULL ; 
                                                        if($paginPost->gender == 1 )
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
                                                    echo 'From '. $GeneralApis->time_elapsed_string($paginPost->timestamps);
                                                ?> 
                                            </span>
                                            <i class="fa reposition
                                                <?php
                                                switch ($paginPost->access_permission) {
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
                                                switch ($paginPost->access_permission) {
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
                                        if($paginPost->post_text_id != 0)
                                        {
                                            ?>
                                            <div class="get-text-post">
                                               
                                                <?php $app = new apps(); ?>
                                                <?php echo $app->emoticonsProvider($paginPost->post_text) ; ?>
                                            </div>
                                            <?php
                                        }
                                    ?>

                                    <!-- Image timeline -->
                                    <?php if($paginPost->post_type_num == 0 ){ ?>
                                        <?php if($paginPost->img_src != NULL ) { ?>
                                            <img class="img-responsive img-posts" src="photo_albums/timeline/<?php echo $paginPost->img_src ; ?>" />
                                        <?php } ?>
                                    <?php } ?>
                                            
                                   <!-- Image timeline -->
                                    <?php if($paginPost->post_type_num == 3 ){ ?>
                                        <?php if($paginPost->photo_src != NULL ) { ?>
                                           <img class="img-responsive img-posts" src="photo_albums/profile_picture/<?php echo $paginPost->photo_src;?>" />
                                        <?php } ?>
                                    <?php } ?>     
                                       
                                      <?php
                                       
                                        
                                      ?>
                                  <!-- Video timeline -->
                                    <?php if($paginPost->post_type_num == 2 ){ ?>
                                        <?php if($paginPost->video_src != NULL ) { ?>
                                        <?php
                                            $videoSrcWMp3 =   $paginPost->video_src ;  
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
                                    <?php if($paginPost->post_type_num == 1 ){ ?>
                                        <?php if($paginPost->music_src != NULL ){ ?>
                                            <div class="musicTimeline">
                                                 <div class="musicController">
                                                     <?php
                                                        $bg = NULL ;
                                                        $musicCoverFile =  dirname(__FILE__)."/music_albums/music_covers/".$paginPost->music_cover;  
                                                      ?>
                                                     <div style="background-image: url(<?php echo "music_albums/music_covers/".$paginPost->music_cover ;?>);" class="imgThumnails">
                                                        <i class='fa fa-music mmudisc' style='font-size: 47px;display: block;margin: 0px auto;display: inline;width: 100%;margin-top: 17px;display: inline-block;margin-left: -5px;color: tomato;opacity: 0.5;'></i> 
                                                      </div>
                                                     <div class="songInfo">
                                                         <!-- 
                                                            <font class="icon-googleplay font-music-icon"></font>
                                                         -->
                                                            <b class="sonName">
                                                                <?php
                                                                   if($paginPost->music_name != NULL )
                                                                       echo $paginPost->music_name ;
                                                                   else 
                                                                       echo "Unknown Name";
                                                                 ?>
                                                                <span class="singerName">
                                                                    <?php
                                                                    if($paginPost->singer_name != NULL )
                                                                       echo $paginPost->singer_name ;
                                                                   else 
                                                                       echo "Unknown Singer";
                                                                     ?>
                                                                </span>
                                                            </b>
                                                      </div>  
                                                     <!-- icon-googleplay Play/Pause icon-pause-5 -->
                                                     <div id-attr="song<?php echo $paginPost->id ;?>" id="song<?php echo $paginPost->id ;?>" audio-source='<?php echo $paginPost->music_src ;?>' class="musicOp playthis">
                                                            <font class="icon-googleplay font-music-icon"></font>
                                                      </div>
                                                       <div style='display:none;' id-attr="song<?php echo $paginPost->id ;?>" id="song<?php echo $paginPost->id ;?>" audio-source='<?php echo $paginPost->music_src ;?>' class="musicOp playthispaus">
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
                                  <textarea id="writeComment" onkeypress="return commentOn(event , this , <?php echo $paginPost->id ;?>,'comment_no_<?php echo $paginPost->id ;?>');" onkeydown="return resizeComment(this);" class="writeComment textareas" placeholder="Write Comment"></textarea>
                                </div>
                                <!-- Comment -->
                                <div class="loadComments comment_no_<?php echo $paginPost->id ;?>"></div>
                            
            
            
            
       <?php
    }
?>
 
                         <script>
                                    
                            $(document).ready(function () {
                                 $('[data-toggle="tooltip"]').tooltip();
                                 
                                 
                                  $('#evaluatePhoto<?php echo $last_id ; ?>').raty({
                                        starOn:    'images/image-on.png',   
                                        starOff:   'images/image-off.png' ,
                                        click: function(score, evt) {
                                            var dataSting = {
                                                'score':score , 
                                                'typeOfEvaluate' : 0 ,  // images and photos 
                                                'postId' : $(this).attr('post-id') ,
                                                'appType' : 0 //timeline
                                            }
                                           
                                            $.ajax({
                                                url  : 'controller/controller_evaluate_object.php' , 
                                                data :dataSting ,
                                                type : 'post' ,
                                                 success :function (responsedData) {
                                                    console.log(responsedData);
                                                 } 
                                            }); 
                                        }
                                      });

                                 window.courtroomInit = function (postId , userId , elem){
                                    var titleCourtroom = $('#title-courtroom') ;
                                    var causeCourtroom = $('#cause-courtroom') ;
                                    var settlementCourtroom = $('#settlement-courtroom') ;
                                    var time_estimated = $('#time-courtroom');

                                    if(titleCourtroom.val() == '')
                                        { 
                                            titleCourtroom.css('border-color','red');
                                            return false ;
                                        }else {
                                            titleCourtroom.css('border-color','#dfdfdf');
                                        }

                                     if(causeCourtroom.val() == '')
                                        {
                                            causeCourtroom.css('border-color','red');
                                            return false ;
                                        }else {
                                             causeCourtroom.css('border-color','#dfdfdf');
                                        }


                                         if(settlementCourtroom.val() == '')
                                            {
                                               settlementCourtroom.css('border-color','red');
                                               return false ;
                                            }else {
                                                 settlementCourtroom.css('border-color','#dfdfdf');
                                            }


                                      if(time_estimated.val() == '')
                                            {
                                               time_estimated.css('border-color','red');
                                               return false ;
                                            }else {
                                                 time_estimated.css('border-color','#dfdfdf');
                                            }
                                            $('button.send-req').css({
                                                background: '#fff' ,
                                                border: '#999 1px solid '
                                            });

                                        $.ajax({
                                            url : 'controller/controller_initcourtroom.php',
                                            type : "post" ,
                                            data : {
                                                'user-id':userId,
                                                'post-id':postId,
                                                'title-courtroom':titleCourtroom.val(),
                                                'cause-courtroom':causeCourtroom.val(),
                                                'settlement-courtroom':settlementCourtroom.val(), 
                                                'time-courtroom':time_estimated.val()
                                            } ,
                                            beforeSend : function (){ 
                                              var loading = '<div style="margin: 7px auto 2px auto;" class="cssload-jumping"><span></span><span></span><span></span><span></span><span></span></div>';

                                                  $(elem).html (loading  );
                                           },
                                           success : function (da){
                                                $(elem).html ('Send Request');
                                                window.location.href = "courtroom?code="+$.trim(da);
                                              }
                                         });

                                 }
                            });
                        </script>