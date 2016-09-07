<?php
   $file = dirname(__FILE__)."/access_modifiers/protected_access.php";
  if(is_file($file)) require_once $file  ;
  
   $filed = dirname(__FILE__)."/modular/autoload_apps.php";
  if(is_file($filed)) require_once $filed  ;
  
  
  ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



  $user_name = $_SESSION['user_info']['user_name'] ;
  if(isset($_GET['user']))
    $user_name  = $_GET['user'] ; 
  
  $user_apis = new user_applications() ;
  $usrInfo = $user_apis ->user_application_check_exist(['u_name'=>$user_name]);
  if($usrInfo == NULL )
  {
      header('location: undefine');
      exit(1);
  }
      
      if($user_name != $_SESSION['user_info']['user_name'] ) {
          // visit my profile 
          $notificaiton_apis = new notification_system_applications();
         $ntfs = $notificaiton_apis->notification_system_add_new_field([
              'id_sender'=>$_SESSION['user_info']['user_id'],
              'id_receiver'=>$usrInfo->id ,
               'app_type'=>0,
               'timestamps'=>  time()
          ]);
       }
      /*
      $genral_setting_apis = new general_settings_applications() ;
     $work_info =  $genral_setting_apis ->general_settings_check_exist(['user_id'=>$usrInfo->id],'and');
       
      $app_apis = new user_get_more_pagination_package_pst() ;
      $last_id  = 0 ;
      $limit  = 100 ;
      $me_or_asAvisitor = 8 ;
      $appss = $app_apis->load_posts_according_to_args( $last_id ,$limit , $me_or_asAvisitor );
       
      
      return false ;*/  
      ?>
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
         <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
         <script src="assets/js/jquery-1.11.0.min.js"></script>
        
         
         
         
         
 	

	<!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
        
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
        <section style="min-height: 800px;" class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-md-2 sidebar-outer">
                    <?php 
                        $sidebarFile = dirname(__FILE__)."/includes/sidebar.php";
                        if(is_file($sidebarFile ))  require_once $sidebarFile ;
                    ?>
                </div>
                <div id="mortPostAndStories" class="col-xs-12 col-md-5 profile-content">
                    <div id="mainRecentlyStoriess" class="homePostContainer ldMore">
                        <center>
                            <b>
                               Recent Stories
                            </b>                        </center>
                    </div>
                    <!-- Comments here -->
                     <?php

                     $lastTime = 0 ;
                       $pagination_Apis = new user_get_more_pagination_package_pst();
                       $apps = new apps();
                       $profilePageContents = $pagination_Apis->load_posts_according_to_args(0, 3 ,$usrInfo->id);
                     ?>
                    <?php  
                                          //  print_r($profilePageContents);
                        ?>
                    <?php
                   
                      //  echo "<pre>";
                       // print count($profilePageContents);
                       //  echo "</pre>";
                    ?>
                    
                    <div id="loadPosts" style="display: none ;" class="homePostContainer">
                        <center>
                               <div class="cssload-jumping"><span></span><span></span><span></span><span></span><span></span></div>
                         </center>
                    </div>
                    <?php
                                     
                        if(is_array($profilePageContents)){
                            
                    ?>
                   
                    <div class="mstories">
                        
                        <?php for($i=0; $i<count($profilePageContents);$i++){ ?>
                        
                         
                        
                        <div style="" class="postContainer">
                        
                            <ul style="top: 3%;" class="acc">
                            
                             <?php
                            $judgeType = 'txtOnly' ;
                                switch ($profilePageContents[$i]->post_type_num){
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
                                if($profilePageContents[$i]->posted_by_id == $_SESSION['user_info']['user_id']){
                                 ?>
                                        <li data-toggle="tooltip" data-placement="left" title="Delete">
                                            <a onclick="delete_post(<?php echo $profilePageContents[$i]->id;?> , this);">
                                               <i style=" " class="fa fa-remove iconstilsh"></i>
                                           </a>
                                       </li>
                                  <?php   
                                }
                            ?>
                            
                            <li data-toggle="tooltip" data-placement="left" title="Comments">
                                <a onclick="return loadComments('comment_no_<?php echo $profilePageContents[$i]->id;?>',<?php echo $profilePageContents[$i]->id;?>,this);" class="commentIcon_<?php echo $profilePageContents[$i]->id;?>">
                                    <i class="fa fa-comment iconstilsh"></i>
                                </a>
                            </li>
                            <li data-toggle="tooltip" data-placement="left" title="Like">
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
                            <li data-toggle="tooltip" data-placement="left" title="Dislike">
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
                        
                         
                            <div style="position: relative;" id="homePostContainer<?php echo $profilePageContents[$i]->id;?>" class="homePostContainer">
                               
        
                            
                            
                            
                                
                                    
                            
                            
                            
                                
                        
                        
                        
                            
                        
                        
                            
                                    <!-- Start POST -->
                                <div class="userProfileInfo">
                                    <a class="gootoProfil" href="http://www.juryofpeers.tv/?user=<?php echo $profilePageContents[$i]->u_name ;?>">
                                    <div class="user-image headerimage" style="background-image: url(photo_albums/profile_picture/<?php echo get_profile_picture($profilePageContents[$i]->posted_by_id); ?>);"></div>
                                    <div class="user-posts-name">
                                        <b> 

                                            <?php echo $profilePageContents[$i]->u_name    ; ?>

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




                                </div>
                                
                                
                                
                                <!-- add new comment -->
                                <div class="add-com-hp"> 
                                  <div class="user-image" style="background-image:  url(photo_albums/profile_picture/<?php echo get_profile_picture($_SESSION['user_info']['user_id']); ?>);"></div>
                                  <textarea id="writeComment" onkeypress="return commentOn(event , this , <?php echo $profilePageContents[$i]->id ;?>,'comment_no_<?php echo $profilePageContents[$i]->id ;?>');" onkeydown="return resizeComment(this);" class="writeComment textareas" placeholder="Write Comment"></textarea>
                                </div>
                                <!-- Comment -->
                                <div class="loadComments comment_no_<?php echo $profilePageContents[$i]->id ;?>"></div>
                            <!-- End Post -->
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                        
                        
                                </div>
                         </div>
                    <?php
                        $lastTime = $profilePageContents[$i]->id ;
                    ?>
                    <?php } ?>
                     
                        <input type="hidden" class="lastTimess" value="<?php echo $lastTime ;?>" />
                    </div>
                    <!-- Load more -->
                    <div onclick="return loadMorePosts(this , 0 , <?php echo $usrInfo->id ; ?> );" class="homePostContainer ldMore">
                        <center>
                            <b class="loadMore">
                               Load more stories 
                            </b>
                        </center>
                    </div>
                    <?php }else  {
                        
                    ?>
                    <div id="mainRecentlyStoriess" class="homePostContainer ldMore">
                        <center>
                            <b class="loadMore">
                              There are no stories
                            </b>                        </center>
                    </div>
                    <?php
                    }
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
                           print_r($profilePageContents);
                            for ($i=0; $i <count($profilePageContents);$i++){
                              echo  $apps->time_elapsed_string($profilePageContents[$i]->timeupdates)."<br />";
                              
                        }
                       echo "</pre>";
                        * 
                        */
                    ?> 
                </div>
                
                <div class="col-xs-12 col-md-5 sidebar-outer" style=" position: relative;z-index: 1; right:0px; top: 13%;">
                    <div style="padding: 0px;margin: 0px;" class="homePostContainer ldMore">
                         <div class="profilePictureP" style="background-image:  url(photo_albums/profile_picture/<?php echo checkProfileExists($usrInfo->id);?>);">
                             <?php if($usrInfo->id == $_SESSION['user_info']['user_id']){ ?>
                             <a href="profile_picture" class="fa fa-camera ppimage-"></a>
                             <?php } ?>
                         </div>
                         <div class="maininfon">
                             <h3>
                                 <?php echo $usrInfo->u_name; ?> 
                             </h3>
                             <div class="mainAdd">
                                 <?php
                                     $friends_apis = new friend_system_applications() ;
                                     $frdCounts = $friends_apis->friend_system_apis_get_all("WHERE ( id_receiver = ".$usrInfo->id ." OR id_sender = ".$usrInfo->id . " )  AND is_accepted = 1 ");
                                      if(count($frdCounts ) != 0)
                                     echo '<span class="frdInfo">'. count($frdCounts ) . ' Friends'.'</span>';
                                 ?>
                                 <?php
                                    if($user_name != $_SESSION['user_info']['user_name']){
                                       
                                        $u_1 = $friends_apis ->friend_system_check_exist([
                                                        'id_receiver'=>$usrInfo->id,
                                                        'id_sender'=>$_SESSION['user_info']['user_id']
                                        ]);
                                                    
                                        $u_2 = $friends_apis ->friend_system_check_exist([
                                                        'id_sender'=>$usrInfo->id,
                                                        'id_receiver'=>$_SESSION['user_info']['user_id']
                                        ]) ;
                                       
                                        $user_adds = NULL ;
                                         if($u_2 != NULL )
                                         $user_adds = $u_2  ;
                                         else if ($u_1 != NULL )
                                          $user_adds = $u_1 ;
                                          else 
                                          $user_adds = NULL ;
                                          if($user_adds != NULL ){
                                              switch ($user_adds->is_accepted ){
                                                  case 1 :
                                                      ?>
                                                       <span onclick="return decline_friend(<?php echo $user_adds->id ?>,this );" style="background: white;color: #222; border:1px solid #999;" class="frdadds rebase cdffr"><i class="fontello icon-user-delete fa-frds"></i>Delete Friend</span>   
                                                       <?php
                                                      break;
                                                  case 0 :
                                                      ?>
                                                       <?php 
                                                        if($user_adds->id_receiver == $_SESSION['user_info']['user_id']){
                                                            ?>
                                                        <span onclick="return confirm_friend(<?php echo $user_adds->id ;?>,this);" style="background: white;color: #222; border:1px solid #999;
                                                                   background: #e92929;
                                                                    color: #fff;
                                                                    border: 1px solid tomato;
                                                                 
                                                                     width: 45%;
                                                                    text-align: center;
                                                                    margin: 10px;
                                                                    line-height: 2;
                                                                    margin: 25px auto;
                                                                    margin-left: 10px;
                                                                    display: inline-block;
                                                                " class="frdadds rebase cdffr"><i class="fontello icon-users-1 fa-frds"></i>Confirm</span> 
                                                         

                                                          <span onclick="return decline_friend(<?php echo $user_adds->id ;?>,this); " style="background: white;color: #222; border:1px solid #999;
                                                                    background: white;
                                                                    color: #222;
                                                                    border: 1px solid #999;
                                                                    width: 45%;
                                                                    text-align: center;
                                                                    margin: 10px;
                                                                    line-height: 2;
                                                                    margin: 25px auto;
                                                                    display: inline-block;
                                                                " class="frdadds rebase cdffr"><i class="fontello icon-user-delete fa-frds"></i>Decline</span> 
                                                         
                                                               
                                                         <?php
                                                        }else {
                                                           ?>
                                                               
                                                               <span onclick="return decline_friend(<?php echo $user_adds->id ;?> ,this); " style="background: white;color: #222; border:1px solid #999;
                                                                    background: white;
                                                                    color: #222;
                                                                    border: 1px solid #999;
                                                                    width: 100%;
                                                                    text-align: center;
                                                                    margin: 10px;
                                                                    line-height: 2;
                                                                    margin: 25px auto;
                                                                    display: inline-block;
                                                                " class="frdadds rebase cdffr"><i class="fontello icon-user-delete fa-frds"></i>Cancel Request</span> 
                                                         
                                                               <?php 
                                                        }
                                                       
                                                      break;
                                              }
                                          }else {
                                        
                                                ?>
                                                    <span onclick="return add_friend(<?php echo $usrInfo->id ;?> ,this);" style="background: white;color: #222; border:1px solid #999;

                                                                            color: #fff;
                                                                            border: 1px solid #999;
                                                                            width: 100%;
                                                                            text-align: center;
                                                                            margin: 10px;
                                                                            line-height: 2;
                                                                            margin: 15px auto;
                                                                            display: inline-block;
                                                                            background: #e52826;
                                                                            border: 1px solid tomato ;
                                                                            " class="frdadds rebase"><i style="color: #fff;" class="fontello icon-user-6 fa-frds"></i>Add Friend</span> 
                                                                            <?php
                                            }
                                            
                                            
                                            ?>
                                                        
                                                       
                                                       <span id="demo01"  data-toggle="modal" data-target="#myModal" style="background: white;color: #222; border:1px solid #999;
                                                                              border: 1px solid #999;
                                                                            width: 100%;
                                                                            text-align: center;
                                                                             line-height: 2;
                                                                             display: inline-block;
                                                                            background: #fff;
                                                                            border: 1px solid #eee;
                                                                            color: #999;
                                                                            " onclick="loadMessage(<?php echo $usrInfo->id ;?>);" class="frdadds rebase"><i style="color: #999;" class="fontello icon-comment-alt-1 fa-frds"></i>Send Message</span> 
                                                 
                                                
                                             <?php
                                    }   
                                 ?> 
                             </div> 
                          </div>
                     </div>
                    
                    
                    
                    
                    
                    
                    <?php
                        if($usrInfo->id == $_SESSION['user_info']['user_id'])
                        {
                            ?>
                                
                                <div style="padding: 0px;margin: 32px auto 0px auto;" class="homePostContainer arrow_box ">
                                        <div class="postContainer-it">
                                             <!-- post status -->
                                             <textarea onkeydown="return resize_post_textarea(this);" onclick="slideDownIt();" placeholder="Start to Write new status" class="textareas" id="text-area" rows="2" cols="50"></textarea>
                                             
                                             <!--
                                             <div class="inserCOn" style="width: 100%; border-top: 1px solid #dfdfdf;padding-top: 7px;display: block;overflow: hidden; margin: 0px auto; height: auto; ">
                                                 <i style="float: left;color: 888;  display: block; " class="icon-user-1"></i>
                                                 <div class="divss" contenteditable="true" style="width: 50%;padding-left: 5px; float: left;display: inline-block;height: 20px;color: #999;">Tag your Friends</div>
                                             </div>
                                             -->

                                             <div class="post-contents">
                                                   <!-- post images -->
                                                   <input type="file" user-id="<?php echo $usrInfo->id ; ?>" class="file-img-upload" id="file-img-upload" style="display: none ;" />
                                                   <!-- post music -->
                                                   <input type="file" user-id="<?php echo $usrInfo->id ; ?>" class="file-music-upload" id="file-music-upload" style="display: none ;" />
                                                   <!-- post music -->
                                                   <input type="file"  user-id="<?php echo $usrInfo->id ; ?>" class="file-video-upload" id="file-video-upload" style="display: none ;" />
                                                   <!-- include files -->
                                                   <div class="file-uploaded">
                                                   <!-- for images --> 
                                                   <div id="blah">
                                                        <!-- 
                                                        <img class="img-loadd" />
                                                        <i onclick="return deleteThisImage();" class="fa fa-close fa-pos"></i>
                                                        <div class="progressbar">
                                                        <div class="fill-progress"></div>
                                                        </div>
                                                        -->
                                                   </div>
                                                   <!-- music includer -->
                                                   <div class="file-included" style="background-image: url(music_albums/music_covers/default_music.jpg); " >
                                                   <!--
                                                   <div class="muisc-masks"></div>
                                                    <div class="music-info mdoo">
                                                    <ul>
                                                    <li style="background-image: url(music_albums/music_covers/default_music.jpg); " class="img-container img-artist"> </li>
                                                    <li class="info-msc">
                                                    <h4 class="song-name">Undefine song</h4>
                                                    <span class="singer-name">
                                                    Unknown artist
                                                    </span>
                                                    </li>
                                                    </ul>
                                                    </div>
                                                    <ul class="file-uploader-menu mdoo">
                                                    <li><i class="fa fa-music"><span style="padding-left:3px;">-</span></i></i></li>
                                                    <li>
                                                    <div class="fileUpload">
                                                    <div class="fileprogress"></div>
                                                    </div>
                                                    </li>
                                                    <li><i onclick="return remover_musicfile();"  class="fa fa-remove faremove"></i></li>
                                                    </ul>
                                                    -->
                                                    </div>
                                                    <!-- video includer -->
                                                    <div class='file-video-responsed'>
                                                    <!-- 
                                                    <div class="video text-center">
                                                    <i class="fa fa-file-video-o"></i>
                                                    </div>
                                                    <div class="scs">
                                                    <b><i onclick="return remove_thisvideo();" class="fa fa-remove fa-deletevideo"></i> </b>
                                                    <span></span>
                                                    <div class="progrees-vid" disabled>
                                                    <div class="inprog-video"></div>
                                                    </div>
                                                    </div>
                                                    -->
                                                    </div>
                                                     <div class='file-link-responsed'> </div>
                                                    </div>
                                             </div>
                                             <div class="freeIcons">
                                                 <ul class="post-menu">
                                                     <!--
                                                     <li>
                                                     <a class="status-only">
                                                     <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                     <span>Status</span>
                                                     </a>
                                                     </li>
                                                     -->
                                                     <li>
                                                     <a class="upload-event">
                                                     <i class="fa fa-picture-o" aria-hidden="true"></i>
                                                     <span>Images</span>
                                                     </a>
                                                     </li>
                                                     <li>
                                                     <a class="upload-event-video">
                                                     <i class="fa fa-file-video-o" aria-hidden="true"></i>
                                                     <span>Videos</span>
                                                     </a>
                                                     </li>
                                                     <li>
                                                     <a class="upload-event-music">
                                                     <i class="fa fa-music" aria-hidden="true"></i>
                                                     <span>Music</span>
                                                     </a>
                                                     </li>



                                                     <li id="postChild" style="float: right;">
                                                         <a userId='<?php echo $usrInfo->id ; ?>' id="onsho" style="" class="sharPost">
                                                             <i class="fa fa-share-alt iconstilshss"></i>
                                                             Post
                                                         </a> 
                                                     </li>
                                                     <?php if ($usrInfo->id == $_SESSION['user_info']['user_id'] ){ ?>

                                                     <li style="float: right;">
                                                         <a class="sharPosts">
                                                             <select id="accessPrem" class="btn post-btn">
                                                                <option value="0">Friends</option>
                                                                <option value="1">Public</option>
                                                                <option value="2">Only me</option>
                                                            </select>
                                                         </a> 
                                                     </li>
                                                     <?php
                                                     }
                                                     ?>
                                                     </ul>
                                             </div>                        
                                        </div>
                                    </div>
                                
                            <?php
                        }
                    ?>
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                </div>
            </div>
            
            
             
            
        </section>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
                       
        
        
      <!--jQuery-->
        
        
        <script src="assets/js/gsap/main-gsap.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/joinable.js"></script>
	<script src="assets/js/resizeable.js"></script>
	<script src="assets/js/neon-api.js"></script>
	<script src="assets/js/neon-chat.js"></script>
	<script src="assets/js/neon-custom.js"></script> 
	<script src="assets/js/neon-demo.js"></script>
        
         
       
        
           
        
    </body>
</html>

 