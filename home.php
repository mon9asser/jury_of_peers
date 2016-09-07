<?php
    $file = dirname(__FILE__)."/access_modifiers/protected_access.php";
    if(is_file($file )) require_once $file  ;
    
      $file = dirname(__FILE__)."/modular/autoload_apps.php";
    if(is_file($file )) require_once $file  ;
    
    // user name get 
    $username = $_SESSION['user_info']['user_name'];
    
  
    
    $userApis = new user_applications() ;
    $userInfo = $userApis ->user_application_check_exist(['u_name'=>$username]);
        if($userInfo == NULL )
      header('location: login');
        
             
?>
<!--
    Web designed by : Montasser Mossallem
    skype Name : moun2030
    up_work : url->  http://www.upwork.com/o/profiles/users/_~01943d20d212eecc03
-->
<!DOCTYPE html>
<html>
    <head>
        <title>User profile</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
         <!-- Fonts -->
         <link href='https://fonts.googleapis.com/css?family=PT+Serif:400,400italic,700,700italic&subset=latin-ext' rel='stylesheet' type='text/css'>
         <!-- Bootstrap -->
         <link href="css/bootstrap.min.css" rel="stylesheet">
         <link href="css/s_music.css"rel="stylesheet" type="text/css" />
        
         <link href="css/simple-slider.css" rel="stylesheet" type="text/css" />
         <link href="css/simple-slider-volume.css" rel="stylesheet" type="text/css" />  
         
         
         <!--Stylesheets-->
	<link href="css/jquery.filer.css" type="text/css" rel="stylesheet" />
	<link href="css/themes/jquery.filer-dragdropbox-theme.css" type="text/css" rel="stylesheet" />

	
	<!--[if IE]>
          <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css"/>
         <!-- Add the slick-theme.css if you want default styling -->
         <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick-theme.css"/>
         <link href="css/animate.css" rel="stylesheet">
         <link href="css/header.css" rel="stylesheet">
         <link rel="stylesheet" href="css/font-awesome.css">
         <link rel="stylesheet" href="css/jquery.raty.css">
         <link href="css/profile.css" rel="stylesheet">
         <link rel="stylesheet" href="css/fontello.css"> 
          <link href="css/music.css" rel="stylesheet">
          <link href="scss/loadincss.css" rel="stylesheet">
         <link rel="stylesheet" href="scss/dfddfdf.css"> 
         <link href="css/emu.css" rel="stylesheet">
          <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
         <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
         <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
         <![endif]-->
    </head>
    <body onload="notifications();">
         <!-- --------------------------------------------------------------- -->
        <!-- ---------------------      Header      ------------------------ -->
        <!-- --------------------------------------------------------------- -->
         <?php 
            $headerFile = dirname(__FILE__)."/includes/header.php";
            if(is_file($headerFile ))  require_once $headerFile ;
        ?>
        <!-- End header banner here -->
        <section class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-md-2 sidebar-outer">
                    <?php 
                        $sidebarFile = dirname(__FILE__)."/includes/sidebar.php";
                        if(is_file($sidebarFile ))  require_once $sidebarFile ;
                    ?>
                </div>
                <div class="col-xs-12 col-md-5 profile-content">
                     <div class="homePostContainer ldMore">
                        <center>
                            <b class="loadMore">
                               Recent Stories
                            </b>
                        </center>
                    </div>
                    <!-- Comments here -->
                     <?php
                     $lastTime = 0 ;
                       $pagination_Apis = new user_get_more_pagination_package_pst();
                       $apps = new apps();
                       $homePageContents = $pagination_Apis->home_page_load_contents(0, 2 , $_SESSION['user_info']['user_id']);
                     ?>
                    <?php
                   
                      //  echo "<pre>";
                      //  print_r($homePageContents);
                       // echo "</pre>";
                    ?>
                    
                    <div class="mstories">
                    <?php
                                     
                        if(is_array($homePageContents)){
                    ?>
                    <?php for($i=0; $i<count($homePageContents);$i++){ 
                      ?>
                        
                        
                        
                        
                        
                        
                        <div style="" class="postContainer">
                        
                            <ul style="top: 3%;" class="acc">
                            
                             <?php
                            $judgeType = 'txtOnly' ;
                                switch ($homePageContents[$i]->post_type_num){
                                    case  '' :  // TEXTS
                                         $judgeType = 808;
                                        break ;
                                    case  0 :   // IMAGES - PHOTOS
                                         $judgeType = 22;
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
                            
                            <li data-toggle="tooltip" data-placement="left" title="Comments">
                                <a onclick="return loadComments('comment_no_<?php echo $homePageContents[$i]->id;?>',<?php echo $homePageContents[$i]->id;?>,this);" class="commentIcon_<?php echo $homePageContents[$i]->id;?>">
                                    <i class="fa fa-comment iconstilsh"></i>
                                </a>
                            </li>
                            <li data-toggle="tooltip" data-placement="left" title="Like">
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
                            <li data-toggle="tooltip" data-placement="left" title="Dislike">
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
                          
                            
                            
                            
                            <?php if ($_SESSION['user_info']['user_id'] != $homePageContents[$i]->posted_by_id){ ?>
                            
                            <li data-toggle="tooltip" data-placement="left" title="Judge">
                                 <a
                                   
                                    is_isset='0' onclick="<?php
                                        if ($judgeType == 808){
                                             echo "judge_this_story(".$homePageContents[$i]->id.",'homePostContainer".$homePageContents[$i]->id."',".$judgeType.",this)";
                                        }else if($judgeType == 1 ){ // music
                                            echo "window.location.href='album_music?code=".$homePageContents[$i]->post_serial_id ."'";
                                        }else if ($judgeType == 2 ) { // video
                                             echo "window.location.href='video_judge?id=".$homePageContents[$i]->video_id ."'";
                                         }else if ($judgeType == 22){
                                               echo "judge_this_story(".$homePageContents[$i]->id.",'homePostContainer".$homePageContents[$i]->id."',".$judgeType.",this)";
                                         }
                                             
                                    ?>" class="">
                                    <i style="background-image: url(images/hconstitutional.png);" class="iconstilsh disputs dyt"></i>
                                </a>
                            </li>
                            <?php } ?>
                        </ul>
                        
                         
                            <div style="position: relative;" id="homePostContainer<?php echo $homePageContents[$i]->id;?>" class="homePostContainer">
                               
        
                            
                            
                            
                                
                                    
                            
                            
                            
                                
                        
                        
                        
                            
                        
                        
                            
                                    <!-- Start POST -->
                                <div class="userProfileInfo">
                                    <a class="gootoProfil" href="http://juryofpeers.tv/?user=<?php echo $homePageContents[$i]->u_name ;?>">
                                    <div class="user-image headerimage" style="background-image: url(photo_albums/profile_picture/<?php echo get_profile_picture($homePageContents[$i]->posted_by_id); ?>);"></div>
                                    <div class="user-posts-name">
                                        <b> 

                                            <?php echo $homePageContents[$i]->u_name    ; ?>

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
                    ?>
                    <?php } ?>
                    <input type="hidden" class="lastTimess" value="<?php echo $lastTime ;?>" />
                    
                    </div>
                   <!-- Load more -->
                    <div onclick="return loadMoreStories(this);" class="homePostContainer ldMore">
                        <center>
                            <b class="loadMore">
                               Load more stories 
                            </b>
                        </center>
                    </div>
                    <?php }else echo "<center><b>There are no stories</b></center>";
                        
                    ?>
                    
                    <?php
                          // music timeline => 1 * 
                          
                          // image timeline => 0 * 
                           
                          // video timeline => 2
                          
                          // texts only => 0 for his column
           
            //------------------------------------------------
           
                          // profile picture => 3
                            
                          // image albums => 4
                            
                          // video albums  => 5
                            
                          // music album  =>  6
                           
                          // links timeline=> 7
                           
                         
                          
                             
                            
                       /*
                            echo "<pre>";
                           print_r($homePageContents);
                            for ($i=0; $i <count($homePageContents);$i++){
                              echo  $apps->time_elapsed_string($homePageContents[$i]->timeupdates)."<br />";
                              
                        }
                       echo "</pre>";
                        * 
                        */
                    ?> 
                    
                    
                </div>
                
                
                <?php 
                
                     if(is_array($homePageContents)){ 
                ?>
                 <div class="col-xs-12 col-md-5 sidebar-outer">
                     <div class="homePostContainer ldMore">
                        <center>
                            <b class="loadMore">
                               My Friend courtrooms
                            </b>
                        </center>
                    </div>
                     <?php
                        $paginApps = new user_get_more_pagination_package_pst() ;
                        $pain = $paginApps->load_more_court_rooms(0 , 4 , $_SESSION['user_info']['user_id']);
                        ?>
                     <div class="homePostContainer">
                         <?php
                        if(is_array($pain )){
                             ?>
                        
                            <?php for($i=0; $i<count($pain); $i++){ ?>
                            <?php
                                $userApps = new user_applications();
                                $user_pln = $userApps->user_application_check_exist(['id'=>$pain[$i]->plaintiff_id]);
                                $user_dfn = $userApps->user_application_check_exist(['id'=>$pain[$i]->defedant_id]);
                            ?>
                         <div class="courtActNoy">
                                <!-- User info -->
                                <div class="userProfileInfo">
                                    <a class="gootoProfil" href="http://juryofpeers.tv/?user=<?php echo $user_pln->u_name; ?>">
                                        <div class="user-image headerimage" style="background-image: url(photo_albums/profile_picture/<?php echo get_profile_picture($pain[$i]->plaintiff_id) ?>);"></div>
                                    </a><div class="user-posts-name"><a class="gootoProfil" href="http://juryofpeers.tv/?user=<?php echo $user_pln->u_name; ?>">
                                        <b> 

                                            <?php
                                                echo $user_pln->u_name ;
                                            ?>
                                            
                                        </b>

                                        <div class="clearFix"></div>
                                        </a><a>
                                            <span class="time-shared">
                                                <?php
                                                    $app = new apps() ;
                                                    echo $app ->time_elapsed_string($pain[$i]->timestamps);
                                                ?>
                                            </span>
                                            <i class="fa reposition fontello icon-user-6 " title="" data-toggle="tooltip" data-placement="right" aria-hidden="true" data-original-title="Shared with Friends Only"> </i> 
                                        </a>
                                     </div>
                                     
                                </div>
                                <div class="courtRecentAct">
                                    <i class="courtIcon"></i>
                                    <a href="http://juryofpeers.tv/?user=<?php echo $user_pln->u_name; ?>" class="userNamesh1" data-toggle="tooltip" data-placement="bottom" aria-hidden="true" title="Plaintiff">
                                         <?php
                                                echo $user_dfn->u_name  ;
                                            ?> 
                                     </a> 
                                        Started courtroom with 
                                        <a href="http://juryofpeers.tv/?user=<?php echo $user_dfn->u_name; ?>" class="userNamesh1" data-toggle="tooltip" data-placement="top" aria-hidden="true" title="Defendant">
                                         <?php
                                                echo $user_dfn->u_name  ;
                                            ?>
                                     </a> 
                                        <a href="http://juryofpeers.tv/courtroom?code=<?php echo $pain[$i]->courtroom_code  ;?>" class="mmGovote" data-toggle="tooltip" data-placement="bottom" aria-hidden="true" title="Vote and help them">Go to <i class="icon-thumbs-up-alt"></i></a>
                                </div>
                                </div> 
                    
                            <?php
                            }
                        }else {
                            echo '<center><b>There are no courtrooms . </b></center>';
                        }
                     ?>
                     
                     
                     
                     </div>    
                     
                     <style>
                         .appContainer,.content-apps {
                             width: 96%;
                             display: block ;
                             overflow: hidden ;
                               height: auto;
                              margin: 0px auto;
                              padding: 0px;
                              background: #dfdfdf ;
                              border: 1px solid #e9e9e9;
                         } 
                         .appContainer h6 {
                             padding: 0px; 
                             margin: 0px;
                             overflow: hidden; 
                             padding: 5px 10px;
                             width: 100%;
                             display: block;
                             font-size: 14px;
                         }
                         .content-apps {
                             
                             overflow: hidden;
                             display: block;
                             background: #fff;
                             border: 3px solid #dfdfdf;
                             padding: 5px;
                           
                         }
                         .listGames {
                             width: 50px;
                             height: 50px;
                             display: block;
                             overflow: hidden;
                          }
                          .appName {
                              display: block;
                              width: 100%;
                              height: 100%;
                              overflow: hidden;
                          }
                          .trndingMenu {
                             display: block;
                                list-style: none;
                                overflow: hidden;
                                width: 100%;
                                padding: 0px;
                                margin: 0px;
                          }
                          .trndingMenu li {
                              display: inline-block;
                              overflow: hidden;
                              float: right;
                          }
                          .trndingMenu li:first-child{
                              float: left;
                          }
                          .trndingMenu li a {
                              cursor: pointer ;
                          }
                          .uloadedTrings {
                              width: 100%;
                              display: block;
                              overflow: hidden;
                              width: 100%;
                                display: block;
                                height: auto;
                                margin-top: 5px;
                                background: transparent;
                                border-top: 1px solid #eee;
                          }
                          .Appss {
                                width: 120;
                                height: auto;
                                background: transparent;
                                margin-top: 5px;
                                display: inline-block;
                                cursor: pointer;
                                background-size: cover;
                                background-repeat: no-repeat;
                              
                          }
                          .app1{
                                width: 80px;
                                height: 80px;
                                background: transparent;
                                margin-top: 5px;
                                display: inline-block;
                                cursor: pointer;
                                background-size: cover;
                                background-repeat: no-repeat;
                                border-radius: 50%;
                          }
                     </style>
                     
                     
                     <div class="appContainer">
                            
                             
                         <div style="width: 100%;" class="content-apps">
                             <ul class="trndingMenu">
                                 <li>Game trending</li><!--
                                 <li>
                                     <a class="icon-gamepad"></a>
                                 </li>
                                  <li>
                                     <a class=" icon-video-3"></a>
                                 </li>
                                  <li>
                                     <a class="icon-music-1"></a>
                                 </li>
                                 <li>
                                     <a class="icon-thumbs-up-5"></a>
                                 </li>
                                -->
                             </ul>  
                             <div class="uloadedTrings">
                                 <?php
                                    $pplications = new pagination_apps();
                                    $pp = $pplications->app_trends(6);
                                    for($i=0;$i<count($pp);$i++){
                                        ?>
                                 <div style="padding: 5px; border: 1px solid #eee; margin: 5px;" onclick="window.location.href='http://apps.juryofpeers.tv/?n=<?php echo $pp[$i]->app_username;?>'"  class="Appss">
                                                <div style="background-image:url(developers/app_files/<?php echo $pp[$i]->app_thumbnails; ?>)" class="app1"></div>
                                                <br /> 
                                                <b style="font-size: 11px;"> <?php   echo $pp[$i]->app_name ; ?></b>
                                            </div>
                                        <?php
                                    }
                                 ?>
                                 
                             </div>
                         </div>
                     
                     
                     
                     
                     
                     <?php
                      if(is_array($pain ) and count($pain) >= 4 ){
                     ?>
                     <!-- Load mor -->
                     <div onclick="return loadMoreStories(this);" class="homePostContainer ldMore">
                        <center>
                            <b class="loadMore">
                               Load more courtrooms 
                            </b>
                        </center>
                    </div>
                     <?php } ?>
                     <!--
                     <b class="text-left musicTitleUpload" style="text-align: left;">
                         trends
                     </b>
                     <div class="trackintrnds trds">
                         <ul class="trendMusics">
                             <li>
                                 <a class="fa fa-star-o"></a>
                             </li>
                             <li>
                                 <a class="fa fa-headphones"></a>
                             </li>
                             <li>
                                 <a class="fa fa-commenting-o"></a>
                             </li>
                             <li>
                                 <a class="fa fa-bookmark-o"></a>
                             </li>
                          </ul>
                         <div class="containerTrends arrow"> 
                             <b class="titleoftrendtype">
                                 <a class="fa fa-star-o"></a>
                                 Reviews
                             </b>
                             <ul class="trendTracks">
                                 <li>
                                     <div>
                                         Song info
                                     </div>
                                 </li>
                                  <li>
                                     <div>
                                         Song info
                                     </div>
                                 </li>
                                  <li>
                                     <div>
                                         Song info
                                     </div>
                                 </li>
                             </ul>
                         </div>
                     </div>
                     
                      <b class="text-left musicTitleUpload" style="text-align: left;">
                        Recently comments and courtrooms
                     </b>
                     <div class="trackintrnds trds">
                         
                         <div class="containerTrends arrow"> 
                              
                             <ul class="trendTracks">
                                 <li>
                                     <div>
                                         Song info
                                     </div>
                                 </li>
                                  <li>
                                     <div>
                                         Song info
                                     </div>
                                 </li>
                                  <li>
                                     <div>
                                         Song info
                                     </div>
                                 </li>
                             </ul>
                         </div>
                     </div>
                     -->
                </div>
                 
                
                
                <?php 
                  } 
                ?>
                
                
                
                
            </div>
        </section>
        
        
        
        
      <!--jQuery-->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script> 
        <script src="js/jquery.raty.js"></script>
        <script src="js/nice_scrollbar.js"></script>
 	<script type="text/javascript" src="js/jquery.filer.min.js?v=1.0.5"></script>
        <script type="text/javascript" src="js/photo_cont.js"></script>
        <script type="text/javascript" src="js/uploadphoto.js"></script>  
        <script type="text/javascript" src="js/audioPlay.js"></script>
        <script src="js/profile_page.js"></script>
        <script>
            $(document).ready(function(){
                /* $('.content-apps').slick({
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    autoplay: false,
                    autoplaySpeed: 2000 
                  }); */
            });
        </script>
    </body>
</html>
