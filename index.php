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
  if($usrInfo != NULL )
  {     
      
      $genral_setting_apis = new general_settings_applications() ;
     $work_info =  $genral_setting_apis ->general_settings_check_exist(['user_id'=>$usrInfo->id],'and');
      // 4 - 8 => only me 
      /*
      $app_apis = new user_get_more_pagination_package_pst() ;
      $last_id  = 0 ;
      $limit  = 100 ;
      $me_or_asAvisitor = 8 ;
      $appss = $app_apis->load_posts_according_to_args( $last_id ,$limit , $me_or_asAvisitor );
       */
      ?>
<!DOCTYPE html> 
<html>
    <head>
        <title><?php echo $usrInfo->f_name ." ".$usrInfo->s_name;?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href='https://fonts.googleapis.com/css?family=PT+Serif:400,400italic,700,700italic&subset=latin-ext' rel='stylesheet' type='text/css'>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/animate.css" rel="stylesheet">
        <link href="css/header.css" rel="stylesheet">
        <link rel="stylesheet" href="css/fontello.css"> 
        <link rel="stylesheet" href="css/font-awesome.css">
        <link href="css/profile.css" rel="stylesheet">
        <script type="text/javascript" src="js/id3-minimized.js"></script>    
        <!--[if IE 7]><link rel="stylesheet" href="css/fontello-ie7.css"><![endif]-->
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style>
        .frt.fa {
        margin-right: 5px;
        }
        </style>
    </head>
    <body>
                <!-- --------------------------------------- -->
                <!-- ------      Header      --------------- -->
                <!-- --------------------------------------- -->
                 
                 <?php 
                    $headerFile = dirname(__FILE__)."/includes/header.php";
                    if(is_file($headerFile ))  require_once $headerFile ;
                ?>
                
                <!-- --------------------------------------- -->
                <!-- ------      Container   --------------- -->
                <!-- --------------------------------------- -->
                <section class="container-fluid">
                    <div class="row">
                        <!-- --------------------------------------- -->
                        <!-- ------      Sidebar   --------------- -->
                        <!-- --------------------------------------- -->
                        <div class="col-xs-12 col-md-2 sidebar-outer">
                            <?php 
                                $sidebarFile = dirname(__FILE__)."/includes/sidebar.php";
                                if(is_file($sidebarFile ))  require_once $sidebarFile ;
                            ?>
                        </div>
                        <div class="col-xs-12 col-md-8 profile-content">
                            <div class="post-controls">
                                <div class="left-part">
                                    <div class="intro profile-pic-con">
                                         <div class="img-block" style="float: left;background-image:  url(photo_albums/profile_picture/<?php echo checkProfileExists($usrInfo->id);?>);background-size:cover; background-position:100% 100%;border: 5px solid #fff;margin: 0px auto; ">
                                             <i class="fa fa-camera ppimage-"></i>
                                         </div>
                                    </div>
                                </div>
                                <div class="right-part">
                                    <div class="profile-title">
                                        <ul class="men-frds">
                                            <li style="float: left ;">
                                                <h3>
                                                   <?php echo $usrInfo->f_name . " " . $usrInfo->s_name ; ?> 
                                                </h3>
                                            </li>
                                            <?php
                                                if($user_name != $_SESSION['user_info']['user_name'])
                                                {
                                                    
                                                    $friends_apis = new friend_system_applications() ;
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
                                                         $frd_id = $user_adds->id ;
                                                       switch ($user_adds->is_accepted )
                                                        {
                                                           case 1 : //friend
                                                                 ?>
                                                        <li><span onclick="return delete_friend(<?php echo $frd_id ?>,this , '<?php echo $user_name?>');" style="background: white;color: #222; border:1px solid #999;" class="frdadds rebase"><i class="fontello icon-user-delete fa-frds"></i>Delete Friend</span> </li>

                                                                 <?php
                                                                break; 
                                                            case 0 : // pending
                                                                 ?>
                                                        <li><span onclick="return delete_friend(<?php echo $frd_id ?>,this , '<?php echo $user_name?>');" style="background: white;color: #222; border:1px solid #999;" class="frdadds rebase"><i class="fontello icon-user-delete-outline fa-frds"></i>Decline Friend Request</span> </li>
                                                                  <?php
                                                                break;   
                                                          }}else {
                                                              ?>
                                                        <li><span onclick="return add_friend(<?php echo $usrInfo->id ; ?>,this, '<?php echo $user_name ?>');"class="frdadds rebase"><i class="fontello icon-user-6 fa-frds"></i>Add Friend</span></li>
                                                              <?php
                                                          } 
                                                   ?>
                                                        <li><span class="btns msg rebase"><i class="fa fa-comments-o fa-frds"></i>Message</span></li>
                                                   <?php
                                                }
                                            ?>
                                            
                                             
                                        </ul>
                                    </div>
                                    <div class="postAdd">
                                        <div class="post-titles">
                                            <ul class="post-menu">

                                                <li>
                                                    <a class="status-only">
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                        <span>Status</span>
                                                    </a>
                                                </li>

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
                                            </ul>
                                        </div>
                                        <div class="post-contents">
                                            <!-- post status -->
                                            <textarea placeholder="Start to Write new status" class="textareas" id="text-area" rows="2" cols="50"></textarea>
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
                                            </div>
                                        </div>
                                        <div class="post-titles" style="background: #fff; border-top: 1px solid rgb(223, 223, 223);">
                                            <!--
                                            <div class="btn-smile"><i class="fa fa-smile-o" style="font-size: 18px;" aria-hidden="true"></i></div>
                                            <div class="btn-smile"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                                            <div class="btn-smile"><i class="fa fa-user" aria-hidden="true"></i></div>
                                            -->
                                            <div id="butn-add-post" class="btn btn-primary post-btn">Post</div>
                                            <select id="accessPrem" class="btn post-btn">
                                                <option value="0">Public</option>
                                                <option value="1">Only me</option>
                                                <option value="2">Friends</option>
                                            </select>
                                        </div>

                                    </div>
                                    
                                    
                                    
                                    
                                    
                                    
                                      
                                    <!-- Posts loped -->
                                    <?php
                                    
                                        $userId  = trim ($_SESSION['user_info']['user_id'] );
                                        if($usrInfo->id != $_SESSION['user_info']['user_id'])
                                            $userId = $usrInfo->id ; 
                                         $app_apis = new user_get_more_pagination_package_pst() ;
                                         $postinPagin = $app_apis->load_posts_according_to_args( 0 , 2 , $userId );
                                          $pos_apis = new user_posts_applications() ;
                                          $user_exist = $pos_apis->user_posts_check_exist([
                                             'user_id'=>$userId
                                         ]);   
                                         
                                         if( count($user_exist) != 0   )
                                         {
                                               for ($i=0; $i<count($postinPagin); $i++){ 
                                             ?>
                                                <div class="posts-get">
                                                    <div class="profilePics">
                                                        <div class="postTitle">
                                                            <div class="user-image headerimage" style="background-image: url(photo_albums/profile_picture/<?php echo checkProfileExists($postinPagin[$i]->posted_by_id);?>);"></div>
                                                            <div class="user-posts-name">
                                                                <b>
                                                                     
                                                                    <?php echo $postinPagin[$i]->f_name . " " .  $postinPagin[$i]->s_name ; ?>
                                                                    <?php
                                                                        if($postinPagin[$i]->post_type_num == 3 )
                                                                        {   
                                                                               $gender = NULL ; 
                                                                               if($postinPagin[$i]->gender == 1 )
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
                                                                            echo $GeneralApis->time_elapsed_string($postinPagin[$i]->timestamps);
                                                                        ?> 
                                                                    </span>
                                                                    <i class="fa reposition
                                                                       <?php
									   switch ($postinPagin[$i]->access_permission) {
									   case 0:
									   echo "fa-globe";
									   break;
									   case 1:
									   echo "fa-lock sty";
									   break;
									   case 2:
									   echo "fa-user";
									   break;
									   }
									   ?>
                                                                          " aria-hidden="true">
                                                                    </i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="post-conts">
                                                            <?php
                                                                if($postinPagin[$i]->post_text_id != 0)
                                                                    {
                                                                        ?>.
                                                                            <div class="get-text-post">
                                                                            <?php
                                                                                echo $postinPagin[$i]->post_text ;
                                                                            ?>
                                                                            </div>
                                                                        <?php 
                                                                    }
                                                            ?>
                                                            <?php
                                                                switch ($postinPagin[$i]->post_type_num) {
                                                                    case 0 : // Photo
                                                                        ?>
                                                                        <?php if($postinPagin[$i]->img_src != NULL ) { ?>
                                                                        <img class="img-responsive img-posts" src="photo_albums/timeline/<?php echo $postinPagin[$i]->img_src ; ?>" />
                                                                        <?php } ?>
                                                                        <?php
                                                                        break;
                                                                    case 1 : // Music 
                                                                        ?>
                                                                        <?php if($postinPagin[$i]->music_src != NULL ) { ?>
                                                                            <audio controls="controls">
                                                                                <source src="music_albums/timeline/<?php echo substr($postinPagin[$i]->music_src, 0, strrpos( $postinPagin[$i]->music_src, '.'));?>.ogg" type="audio/ogg">
                                                                                <source src="music_albums/timeline/<?php echo $postinPagin[$i]->music_src ; ?>" type="audio/mpeg">
                                                                                Your browser does not support the audio element.
                                                                            </audio>
                                                                        <?php } ?>
                                                                        <?php
                                                                        break;
                                                                    case 2 : // Video 
                                                                        ?>
                                                                        <?php if($postinPagin[$i]->video_src != NULL ) { ?>
                                                                        <div class="videoCotroler">
                                                                        <!-- 
                                                                            <div class="playVideo">
                                                                            <i class="fa fa-play "></i>
                                                                            </div>
                                                                            -->
                                                                            <video width="100%" src="video_albums/timeline/<?php echo $postinPagin[$i]->video_src; ?>"></video>
                                                                        </div>
                                                                        <?php } ?>
                                                                        <?php
                                                                        break;
                                                                       case 3: // Photo
                                                                        ?>
                                                                            <?php if($postinPagin[$i]->photo_src != NULL ) { ?>
                                                                            <img class="img-responsive img-posts" src="photo_albums/profile_picture/<?php echo $postinPagin[$i]->photo_src;?>" />
                                                                            <?php } ?>
                                                                        <?php
                                                                        break;
                                                                }
                                                            ?>
                                                        </div>
                                                        
                                                        <!-- Likes or dislike -->
                                                        <?php
                                
                                                            $likes_dislikes = new user_like_dislikes_applications();
                                                            $liked_disliked = $likes_dislikes->user_like_dislikes_check_exist([
                                                            'liked_by_userid'=> $_SESSION['user_info']['user_id'] ,
                                                            'post_id'=>$postinPagin[$i]->id
                                                            ]);                  
                                                            ?>
                                                        <div class="post-control-set">
                                                            <ul class="menu-cont">
                                                                <li>
                                                                    <a class="likesItem" onclick="return likePost(<?php echo $postinPagin[$i]->id ; ?>);">
                                                                    <?php
                                                                    if( $liked_disliked != NULL   )
                                                                    {
                                                                    if(  $liked_disliked->is_liked == 1)
                                                                    echo "<span style='color:teal;'><i class='fa fa-thumbs-o-up frt' aria-hidden='true'></i>Liked</span>" ;
                                                                    else 
                                                                    echo "<i class='fa fa-thumbs-o-up frt' aria-hidden='true'></i>Like" ;
                                                                    }  
                                                                    else 
                                                                    echo "<i class='fa fa-thumbs-o-up frt' aria-hidden='true'></i>Like" ;
                                                                    ?>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="disliked_items" onclick="return disLikePost(<?php echo $postinPagin[$i]->id ; ?>);">
                                                                    <?php
                                                                    if( $liked_disliked != NULL and  $liked_disliked->is_liked != 1 )
                                                                    echo "<span style='color:teal;'><i class='fa fa-thumbs-o-down frt' aria-hidden='true'></i>Disliked</span>" ;
                                                                    else 
                                                                    echo "<i class='fa fa-thumbs-o-down frt' aria-hidden='true'></i>Dislike" ;
                                                                    ?>  
                                                                    </a>
                                                                </li>
                                                                    <!-- 
                                                                 <li>
                                                                    <a>
                                                                    <i class="fa fa-comment" aria-hidden="true"></i>
                                                                    Comment  
                                                                    </a>
                                                                </li>
                                                                    -->
                                                                 <li>
                                                                     <a class="md-trigger md-setperspective" data-modal="modal-18">
                                                                    <i style="background-image: url(images/constitutional.png)" class="disputs"></i>
                                                                    Dispute  
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                            <div class="clearFix"></div>
                                                            <div class="get-com-dis-lke-dpt">
                                                                <?php
                                                                $likes =  $likes_dislikes->user_like_dislikes_get_by_values(['post_id'=>$postinPagin[$i]->id] ,'and');
                                                                if(count($likes) != 0 ) {
                                                                ?>
                                                                <div class="contpost">
                                                                    <ul class="menu-cont2">
                                                                      <li>
                                                                        <a>
                                                                        <?php
                                                                        $likes =  $likes_dislikes->user_like_dislikes_get_by_values(['post_id'=>$postinPagin[$i]->id , 'is_liked'=> 1] ,'and');
                                                                        if(count($likes) != 0 ) echo  '<i class="fa fa-thumbs-o-up" aria-hidden="true"></i>' ;
                                                                        ?>

                                                                        <span class="countlikes">
                                                                        <?php
                                                                        $likes =  $likes_dislikes->user_like_dislikes_get_by_values(['post_id'=>$postinPagin[$i]->id , 'is_liked'=> 1] ,'and');
                                                                        if(count($likes) != 0 ) echo count($likes) ;
                                                                        ?>
                                                                        </span>
                                                                        </a>
                                                                      </li>
                                                                      <li>
                                                                        <a>
                                                                        <?php
                                                                        $dislikes =  $likes_dislikes->user_like_dislikes_get_by_values(['post_id'=>$postinPagin[$i]->id , 'is_liked'=> 0 ] ,'and');
                                                                        if(count($dislikes) != 0  ) echo' <i class="fa fa-thumbs-o-down" aria-hidden="true"></i>' ;
                                                                        ?>
                                                                        <span class="countDislikes">
                                                                        <?php
                                                                        $dislikes =  $likes_dislikes->user_like_dislikes_get_by_values(['post_id'=>$postinPagin[$i]->id , 'is_liked'=> 0 ] ,'and');
                                                                        if(count($dislikes) != 0  ) echo count($dislikes) ;
                                                                        ?>
                                                                        </span>
                                                                        </a>
                                                                      </li>
                                                                    </ul>
                                                                 </div>
                                                                <?php } ?>
                                                                <div class="clearFix"></div> 
                                                                <div class="add-com" >
                                                                    <?php
                                                                    $userAPPS = new user_applications();
                                                                      $userInfo =  $userAPPS->user_application_check_exist(['id'=>$_SESSION['user_info']['user_id']]);
                                                                      if($userInfo != NULL )
                                                                      $userName = $userInfo->u_name 
                                                                    ?>
                                                                    <div class="user-image" style="background-image:  url(photo_albums/profile_picture/<?php echo checkProfileExists($usrInfo->id);?>);"></div>
                                                                    <textarea id="writeComment" onkeypress="return commentIn(event , this , <?php echo $postinPagin[$i]->id?>);" onkeydown="return resizeComment(this);" class="writeComment textareas" placeholder="Write Comment"></textarea>
                                                                </div>
                                                                 <?php
                                       
                                                                $comment_api = new user_get_more_pagination_comment_package();
                                                                $commentInPosts = $comment_api->load_more_comments_in_timeline_frd(0, 3 ,"(post_id=".$postinPagin[$i]->id.")");
                                                               ?>
                                                              <ul style="padding: 0px;" class="commentContainer this<?php echo $postinPagin[$i]->id ; ?>post">
                                                                <?php
                                                                for( $cmt =0 ; $cmt < count($commentInPosts ); $cmt++  ) { 
                                                                $positionIt = "center center";
                                                                $sizeIt = "100% 100%";
                                                                $profileExixst = new profile_picture_applications();
                                                                $checkProfi = $profileExixst->profile_pictureg_check_exist(['user_id'=>$commentInPosts[$cmt]->user_id]);
                                                                if($checkProfi != NULL )
                                                                {
                                                                $positionIt = $checkProfi->position_y_x;
                                                                $sizeIt = $checkProfi->photo_w_h;
                                                                }else {
                                                                $positionIt = "center center";
                                                                $sizeIt = "100% 100%";
                                                                } 
                                                                $userInfo =  $userAPPS->user_application_check_exist(['id'=>$commentInPosts[$cmt]->user_id]);
                                                                if($userInfo != NULL ){
                                                                $userName = $userInfo->u_name ;
                                                                $fullName = $userInfo->f_name .' '. $userInfo->s_name ;
                                                                }else 
                                                                {
                                                                $fullName = "User of jury of peers" ;
                                                                }
                                                              ?>
                                                                  <li>
                                                                      <div class="add-com msComments" >
                                                                             <div class="user-image sizerComm" style="background-image:  url(../<?php echo $userName ; ?>/photo_albums/profile_picture/<?php echo checkProfileExists($commentInPosts[$cmt]->user_id);?>);background-size:<?php echo $sizeIt ; ?>; background-position:<?php echo $positionIt ; ?>;"></div>
                                                                             <div class="commentBlock">
                                                                                 <b><?php echo $fullName;?></b>
                                                                                 <div class="clearFix"></div>
                                                                                 <span>
                                                                                   <?php echo $commentInPosts[$cmt]->comment_contents;  ?>
                                                                                   <font class="text-right">
                                                                                   <?php
                                                                                   $GeneralApis = new apps();
                                                                                   echo $GeneralApis->time_elapsed_string($commentInPosts[$cmt]->timestamps);
                                                                                   ?> 
                                                                                   </font> 
                                                                                 </span> 
                                                                             </div>
                                                                      </div>
                                                                  </li>
                                                              <?php } ?>
                                                              </ul>
                                                                <div onclick="return loadMoreComment(<?php echo $postinPagin[$i]->id ; ?>,'this<?php echo $postinPagin[$i]->id ; ?>post',<?php echo $commentInPosts[$cmt]->id ; ?>)" class="add-com msComments loadmorecomment" >
                                                                    View more comments
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            
                                            
                                        }
                                         
                                         }
                                        
                                    ?>
                                   
                                    
                                    
                                    
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
                
                
                <div class="md-overlay"></div><!-- the overlay element -->
                
                
                
                
              <script src="js/jquery-1.12.4_1.js"></script>
             <script src="js/bootstrap.min.js"></script>
             <!-- classie.js by @desandro: https://github.com/desandro/classie -->
             <script src="js/classie.js"></script>
            <script src="js/modalEffects.js"></script>

            <!-- for the blur effect -->
            <!-- by @derSchepp https://github.com/Schepp/CSS-Filters-Polyfill -->
            <script>
            // this is important for IEs
            var polyfilter_scriptpath = '/js/';
            </script>
            <script src="js/cssParser.js"></script>
            <script src="js/css-filters-polyfill.js"></script>
            
            
            
             <script type="text/javascript" src="js/id3-minimized.js"></script>
             <script src="js/profile_page.js"></script>
    </body>
</html>

<?php
  }
?>