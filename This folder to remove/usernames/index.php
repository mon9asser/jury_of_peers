<?php
ob_start() ;
if(session_id()=='')
session_start () ;

$files = dirname(__FILE__)."/../modular/autoload_apps.php";
if(is_file($files)) require_once $files ;

$imageProfile = dirname(__FILE__)."/photo_albums/profile_picture/profile_picture.php";
if(is_file($imageProfile)) require_once $imageProfile ;
?>
<!DOCTYPE html> 
<html>
    <head>
        <title>User profile</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
         <!-- Fonts -->
         <link href='https://fonts.googleapis.com/css?family=PT+Serif:400,400italic,700,700italic&subset=latin-ext' rel='stylesheet' type='text/css'>
         <!-- Bootstrap -->
         <link href="../css/bootstrap.min.css" rel="stylesheet">
         <link href="../css/animate.css" rel="stylesheet">
         <link href="../css/header.css" rel="stylesheet">
         <link rel="stylesheet" href="../css/font-awesome.css">
         <link href="../css/profile.css" rel="stylesheet">
         <script type="text/javascript" src="../js/id3-minimized.js"></script>
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
        
        
<?php
  
                               $post_apis = new user_get_more_pagination_package_pst();
                               $profile_pic_apis = new profile_picture_applications();
                               
                               
                                   $clean_apis = new apps() ;
                      
                       $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                      $cleanUrl = trim($clean_apis ->get_string_between($actual_link , 'tv/', '/'));
                        
                       $userAPPS = new user_applications();
                      $u_exist =  $userAPPS->user_application_check_exist(['u_name'=>trim($cleanUrl)]);
                     $user_id = $_SESSION['user_info']['user_id'] ;
                      if($u_exist->id != $_SESSION['user_info']['user_id'])
                        $user_id =  $u_exist->id ;
                      // $usernameClean = ;
                            
?>  
        
        <!-- --------------------------------------- -->
        <!-- ------      Header      --------------- -->
        <!-- --------------------------------------- -->
        <?php 
            $headerFile = dirname(__FILE__)."/../includes/header.php";
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
                        $sidebarFile = dirname(__FILE__)."/../includes/sidebar.php";
                        if(is_file($sidebarFile ))  require_once $sidebarFile ;
                    ?>
		</div>
                <!-- ------------------------------------------- -->
                <!-- ------------   Column  1  ---------------- -->
                <!-- ------------------------------------------- -->
                <div class="col-xs-12 col-md-8 profile-content">
                    <div class="post-controls">
                        <!-- left side -->
                        <div class="left-part">
                            <div class="intro profile-pic-con">
                                 <!-- Profile Pictures -->
                                 <?php
                                 
                                  $positionIt = "center center";
                                        $sizeIt = "100% 100%";
                                    $profileExixst = new profile_picture_applications();
                                    $checkProfi = $profileExixst->profile_pictureg_check_exist(['user_id'=>$_SESSION['user_info']['user_id']]);
                                    if($checkProfi != NULL )
                                    {
                                        $positionIt = $checkProfi->position_y_x;
                                        $sizeIt = $checkProfi->photo_w_h;
                                    }else {
                                        $positionIt = "center center";
                                        $sizeIt = "100% 100%";
                                    }
                                 ?>
                                <div class="img-block" style="background-image:  url(photo_albums/profile_picture/<?php echo checkProfileExists($user_id);?>);background-size:<?php echo $sizeIt ; ?>; background-position:<?php echo $positionIt ; ?>; "></div>
                                 
                                 <!-- 
                                <div class="profile-title text-center">
                                      Available
                                </div>
                                -->
                            </div>
                            <div class="intro">
                                <div class="headtitle-intro">
                                    <!--
                                    <i class="fa fa-info-circle" aria-hidden="true"></i>
                                    -->
                                    <b>About me</b>
                                </div>
                                <div class="intro-content">
                                    <ul class="menu-introduction">
                                        <li>
                                            <a>
                                               <i class="fa fa-suitcase" aria-hidden="true"></i>
                                                 <span>Web Designer</span>
                                                <font>at</font>
                                                <span>Company name</span>
                                            </a>
                                        </li>
                                        
                                        <li>
                                            <a>
                                               <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                                                 <span>Studied </span>
                                                <font>at</font>
                                                <span>College Name</span>
                                            </a>
                                        </li>
                                        
                                        <li>
                                            <a>
                                               <i class="fa fa-globe" aria-hidden="true"></i>
                                                 <span>Lives </span>
                                                <font>in</font>
                                                <span>Country name</span>
                                            </a>
                                        </li>
                                        
                                        <li>
                                            <a>
                                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                 <span>From</span>
                                                 <span>country,city</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="clearFix"></div>
                            <div class="friend-list-profile">
                              
                                <div class="friend_title">
                                     <b>Profile setting</b>
                                </div>
                                <div class="friend_lists">
                                    <ul>
                                        <li>
                                            <a>
                                                <i class="fa fa-sticky-note-o" aria-hidden="true"></i>
                                                Manage courtrooms
                                            </a>
                                        </li>
                                        <li>
                                            <a>
                                                <i class="fa fa-pencil-square" aria-hidden="true"></i>
                                                Edit profile
                                            </a>
                                        </li>
                                        <li>
                                            <a>
                                                <i class="fa fa-object-group" aria-hidden="true"></i>
                                                Manage groups
                                            </a>
                                        </li>
                                        <li>
                                            <a>
                                                <i class="fa fa-minus" aria-hidden="true"></i>
                                                Manage Apps
                                            </a>
                                        </li>
                                        <li>
                                            <a>
                                                <i class="fa fa-users" aria-hidden="true"></i>
                                                Add new friends
                                            </a>
                                        </li>
                                    </ul>
                                 </div>
                                
                               
                            </div>
                        </div>
                        <!-- right side -->
                        <div class="right-part">
                             
                                        <div class="profile-title">
                                        <ul class="men-frds">
                                            <li style="float: left ;">
                                                <h3>
                                                    <?php echo $u_exist->f_name.' '.$u_exist->s_name ;?>
                                                </h3>
                                            </li>
                                            
                                 <?php
                                 if($user_id != $_SESSION['user_info']['user_id']){
                                 $frd_apis = new friend_system_applications();
                                    $frd1 = $frd_apis->friend_system_check_exist(['id_sender'=>$user_id , 'id_receiver'=>$_SESSION['user_info']['user_id']]);
                                    $frd2 = $frd_apis->friend_system_check_exist(['id_sender'=>$_SESSION['user_info']['user_id'] , 'id_receiver'=>$user_id]);
                                    if($frd1 == NULL or $frd2 == NULL ){
                                        ?>
                                            <li><span  class="frdadds"><i class="fa fa fa-plus-circle fa-frds"></i>Add friend</span></li>
                                            <li><span class="btns"><i class="fa fa fa fa-comments-o fa-frds"></i>Message</span></li>
                                          <?php
                                    }
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
                                    <input type="file" class="file-img-upload" id="file-img-upload" style="display: none ;" />
                                   <!-- post music -->
                                    <input type="file" class="file-music-upload" id="file-music-upload" style="display: none ;" />
                                    <!-- post music -->
                                    <input type="file" class="file-video-upload" id="file-video-upload" style="display: none ;" />
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
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                      <?php  
                    
                    $postinPagin =  $post_apis->load_more_posts_in_timeline_frd(0 , 2 , "(posted_by_id = {$user_id} OR posted_by_id != {$user_id} ) AND (user_id = {$user_id})  " );
                    $frieds_api = new friend_system_applications();
            ?> <?php for ($i=0; $i<count($postinPagin); $i++){ ?>
                <?php
                
                    $sender_frd = $frieds_api->friend_system_check_exist([
                         'id_sender'=> $user_id ,
                         'id_receiver'=> $_SESSION['user_info']['user_id'] ,
                         'is_accepted'=> 1
                    ]) ; 
                    $receiver_frd =$frieds_api->friend_system_check_exist([
                         'id_receiver'=> $user_id ,
                         'id_sender'=> $_SESSION['user_info']['user_id'] ,
                         'is_accepted'=> 1
                    ]) ;    
                    
                    /* ($sender_frd != NULL || $receiver_frd != NULL ) AND */
                    if( ($postinPagin[$i]->access_permission == 1 || $postinPagin[$i]->access_permission == 0) || ( $_SESSION['user_info']['user_id'] == $user_id)) {
                ?>
                     <!-- post --> 
                    <div class="posts-get">
                        <div class="profilePics">
                            <div class="postTitle">
                                <div class="user-image headerimage" style="background-image: url(photo_albums/profile_picture/<?php echo checkProfileExists($postinPagin[$i]->posted_by_id);?>);"></div>
                                <div class="user-posts-name">
                                  <b>
                                    <!-- User name -->
                                    <?php
                                    $user_apps_apis = new user_applications();
                                    $userName =  $user_apps_apis->user_application_check_exist(['id'=>$postinPagin[$i]->posted_by_id]);
                                    if($userName != NULL )
                                    echo $userName->f_name.' '.$userName->s_name ;
                                    else 
                                    echo "Unknown Name";
                                    if($postinPagin[$i]->post_type_num == 3 )
                                    {
                                    $gender = NULL ; 
                                    if($userName->gender == 1 )
                                    $gender = 'her' ;
                                    else 
                                    $gender = 'his';
                                    ?>
                                    <span class="descrip-profile">changed <?php echo $gender ;?> profile picture </span> 
                                    <?php
                                    }
                                    ?>
                                 </b>
                                 <div class="clearFix"></div>
                                 <a>
                                  <!-- posted in time -->
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
                                   " aria-hidden="true"></i>
                                 </a>
                                </div>
                                
                            </div>
                            <div class="post-conts">
                                <?php 
                                 // check if 
                                 if($postinPagin[$i]->post_text_id != 0)
                                 {
                                 ?>.
                                 <div class="get-text-post">
                                 <?php
                                 $user_text_apis = new user_texts_applications(); 
                                 $text = $user_text_apis->user_texts_applications_check_exist(['id'=>$postinPagin[$i]->post_text_id]);
                                 echo $text->post_text ;
                                 ?>
                                 </div>
                                 <?php 
                                 }
                                 switch ($postinPagin[$i]->post_type_num) {
                                  case 0 : // Photo
                                  ?>
                                  <?php
                                  // get image from database 
                                  $imageApis = new images_applications() ; //post_album_id
                                  $imgExist = $imageApis->images_applications_check_exist(['post_serial_id'=>$postinPagin[$i]->post_serial_id]);
                                  if($imgExist != NULL )   {
                                  ?><img class="img-responsive img-posts" src="photo_albums/timeline/<?php echo $imgExist->img_src?>" /><?php
                                  }
                                  ?>  
                                  <?php
                                  break;
                                  case 1 : // Music 
                                  $musicAPis = new music_posts_applications();
                                  $musicExist = $musicAPis->music_posts_check_exist(['post_serial_id'=>$postinPagin[$i]->post_serial_id]);
                                  if($musicExist != NULL ){ 
                                  ?>
                                  <audio controls="controls">
                                  <source src="music_albums/timeline/<?php echo substr($musicExist->music_src, 0, strrpos( $musicExist->music_src, '.'));?>.ogg" type="audio/ogg">
                                  <source src="music_albums/timeline/<?php echo $musicExist->music_src ; ?>" type="audio/mpeg">
                                  Your browser does not support the audio element.
                                  </audio>
                                  <?php
                                  }
                                  ?> 
                                  
                                  <?php
                                  break;
                                  case 2 : // Video 
                                  $videoApis = new video_posts_applications() ;
                                  $videoExist = $videoApis->video_posts_check_exist(['post_serial_id'=>$postinPagin[$i]->post_serial_id]);
                                  if($videoExist != NULL ) {
                                  ?>
                                  <div class="videoCotroler">
                                  <!-- 
                                  <div class="playVideo">
                                  <i class="fa fa-play "></i>
                                  </div>
                                  -->
                                  <video width="100%" src="video_albums/timeline/<?php echo $videoExist->video_src; ?>"></video>
                                  </div>
                                  <?php }
                                  break;
                                  case 3: // Photo
                                  ?>
                                  <?php
                                  // get image from database 
                                  $profileImageApis = new profile_picture_applications() ; //post_album_id
                                  $profileImageApisExist = $profileImageApis->profile_pictureg_check_exist(['post_serial_id'=>$postinPagin[$i]->post_serial_id]);
                                  if($profileImageApisExist != NULL )   {
                                  ?>
                                  <img class="img-responsive img-posts" src="photo_albums/profile_picture/<?php echo $profileImageApisExist->photo_src;?>" /><?php
                                  }
                                  ?>  
                                  <?php
                                  break;
                                  }
                                 ?>
                             </div>
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
                                        <a>
                                        <i style="background-image: url(../images/constitutional.png)" class="disputs"></i>
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
                                          $userInfo =  $userAPPS->user_application_check_exist(['id'=>$_SESSION['user_info']['user_id']]);
                                          if($userInfo != NULL )
                                          $userName = $userInfo->u_name 
                                        ?>
                                        <div class="user-image" style="background-image: url(../<?php echo $userName; ?>/photo_albums/profile_picture/<?php echo checkProfileExists($_SESSION['user_info']['user_id']);?>); "></div>
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
                             } // end if statment (Permissions)
                } // end for loop
              ?>
                            
                            
                            
                            
                            
                            
                            
                            
                             
                              
                              
                             
                              
                              
                              
                              
                              
                              
                              
                              
                              
                    </div>
                </div>
                
                
                
                <!-- ------------------------------------------- -->
                <!-- ------------   Column  2  ---------------- -->
                <!-- -------------------------------------------  
                <div class="col-xs-12 col-md-2 updating">
                    <div class="col-xs-12 col-md-2 fixed vfr">
                        <div class="comments-frds">
                            <div class="headline-jury nrf-headline">
                                Recent comment
                            </div>
                            <div class="con-recent">
                                <div style="background-image: url(profile_pics/profile-test.jpg);" class="rcntcmnt">
                                   commented on fgrt courtroom
                                </div>
                                <div style="background-image: url(profile_pics/profile-test.jpg);" class="rcntcmnt">
                                   commented on fgrt courtroom
                                </div>
                                <div style="background-image: url(profile_pics/profile-test.jpg);" class="rcntcmnt">
                                   commented on fgrt courtroom
                                </div>
                                <div style="background-image: url(profile_pics/profile-test.jpg);" class="rcntcmnt">
                                   commented on fgrt courtroom
                                </div>
                                <div style="background-image: url(profile_pics/profile-test.jpg);" class="rcntcmnt">
                                   commented on fgrt courtroom
                                </div>
                                <div style="background-image: url(profile_pics/profile-test.jpg);" class="rcntcmnt">
                                   commented on fgrt courtroom
                                </div>
                                <div style="background-image: url(profile_pics/profile-test.jpg);" class="rcntcmnt">
                                   commented on fgrt courtroom
                                </div>
                                <div style="background-image: url(profile_pics/profile-test.jpg);" class="rcntcmnt">
                                   commented on fgrt courtroom
                                </div>
                                <div style="background-image: url(profile_pics/profile-test.jpg);" class="rcntcmnt">
                                   commented on fgrt courtroom
                                </div>
                                <div style="background-image: url(profile_pics/profile-test.jpg);" class="rcntcmnt">
                                   commented on fgrt courtroom
                                </div>
                                <div style="background-image: url(profile_pics/profile-test.jpg);" class="rcntcmnt">
                                   commented on fgrt courtroom
                                </div>
                                <div style="background-image: url(profile_pics/profile-test.jpg);" class="rcntcmnt">
                                   commented on fgrt courtroom
                                </div>
                                <div style="background-image: url(profile_pics/profile-test.jpg);" class="rcntcmnt">
                                   commented on fgrt courtroom
                                </div>
                                <div style="background-image: url(profile_pics/profile-test.jpg);" class="rcntcmnt">
                                   commented on fgrt courtroom
                                </div>
                                <div style="background-image: url(profile_pics/profile-test.jpg);" class="rcntcmnt">
                                   commented on fgrt courtroom
                                </div>
                                <div style="background-image: url(profile_pics/profile-test.jpg);" class="rcntcmnt">
                                   commented on fgrt courtroom
                                </div>
                                <div style="background-image: url(profile_pics/profile-test.jpg);" class="rcntcmnt">
                                   commented on fgrt courtroom
                                </div>
                                <div style="background-image: url(profile_pics/profile-test.jpg);" class="rcntcmnt">
                                   commented on fgrt courtroom
                                </div>
                                <div style="background-image: url(profile_pics/profile-test.jpg);" class="rcntcmnt">
                                   commented on fgrt courtroom
                                </div>
                                <div style="background-image: url(profile_pics/profile-test.jpg);" class="rcntcmnt">
                                   commented on fgrt courtroom
                                </div>
                                <div style="background-image: url(profile_pics/profile-test.jpg);" class="rcntcmnt">
                                   commented on fgrt courtroom
                                </div>
                                <div style="background-image: url(profile_pics/profile-test.jpg);" class="rcntcmnt">
                                   commented on fgrt courtroom
                                </div>
                                <div style="background-image: url(profile_pics/profile-test.jpg);" class="rcntcmnt">
                                   commented on fgrt courtroom
                                </div>
                                <div style="background-image: url(profile_pics/profile-test.jpg);" class="rcntcmnt">
                                   commented on fgrt courtroom
                                </div>
                                <div style="background-image: url(profile_pics/profile-test.jpg);" class="rcntcmnt">
                                   commented on fgrt courtroom
                                </div>
                            </div>
                        </div>
                     </div>    
                </div> 
                -->
                
                
                
            </div>
        </section>
        
        
        
    <script src="../js/jquery-1.12.4_1.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function (){
               
         
          window.commentIn = function (ev , thisdata , postId){
             if(ev.keyCode == 13 )
                 {
                     if(thisdata.value == '' )
                     return false ;
                     var dataStrings =  {
                            'postId':postId ,
                            'comment-text':thisdata.value
                         }
                         console.log(dataStrings);
                     $.ajax({
                         url : '../controller/controller_comment.php' ,
                         data :dataStrings ,
                         type : 'post' ,
                         beforeSend : function () {} ,
                         success :function () {}
                     });
                    
                     $(thisdata).val(null);
                     return false ;
                 }
                
          }
          window.likePost = function(postId){
              $.ajax({
                  url : "../controller/controller_like_dislike.php" , 
                  type : "post" , 
                  data : {
                      'is_like' : 1 , 
                      'post_id' : postId
                  } ,
                  dataType: 'json',
                  cache: false,
                  success : function (respond){
                       $('.countDislikes').html(respond[0]);
                      $('.countlikes').html(respond[1]);
                       
                       if(respond[2] == 1)
                           {
                             
                                $('.likesItem').html ("<span style='color:teal;'><i class='fa fa-thumbs-o-up frt' aria-hidden='true'></i>Liked</span>");
                                $('.disliked_items').html ("<i class='fa fa-thumbs-o-down frt' aria-hidden='true'></i>Dislike");
                           }else  {
                                $('.likesItem').html ("<i class='fa fa-thumbs-o-up frt' aria-hidden='true'></i>Like");
                           }
                     
                  }
              });
          }
           window.disLikePost = function(postId){
               $.ajax({
                  url : "../controller/controller_like_dislike.php" , 
                  type : "post" , 
                  data : {
                      'is_like' : 0 , 
                      'post_id' : postId
                  } ,
                  dataType: 'json',
                  cache: false,
                  success : function (respond){
                     $('.countDislikes').html(respond[0]);
                      $('.countlikes').html(respond[1]);
                      
                      if(respond[2] == 0)
                           {
                                 $('.likesItem').html ("<i class='fa fa-thumbs-o-up frt' aria-hidden='true'></i>Like");
                                $('.disliked_items').html ("<span style='color:teal;'><i class='fa fa-thumbs-o-down frt' aria-hidden='true'></i>Disliked</span>");
                           }else {
                               $('.disliked_items').html ("<i class='fa fa-thumbs-o-down frt' aria-hidden='true'></i>Dislike");
                           }
                  }
          }); }
          
            
          $('[data-toggle="tooltip"]').tooltip();
          $(window).scroll(function (){
              var topSc = $(this).scrollTop();
             if(topSc > 70)
                 {
                   $('#header').addClass('animated slideInDown navbar-fixed-top');
                 }else {
                     $('#header').removeClass('animated slideInDown navbar-fixed-top');
                  }
          });
          
          /****************************************************************/
          /****************  Auto height the textarea   *******************/
          /****************************************************************/
              var textarea = document.querySelector('textarea');
             textarea.addEventListener('keydown', autosize);
             function autosize(){
              var el = this;
              setTimeout(function(){
                el.style.cssText = 'height:auto; padding:0';
                // for box-sizing other than "content-box" use:
                // el.style.cssText = '-moz-box-sizing:content-box';
                el.style.cssText = 'height:' + el.scrollHeight + 'px';
              },0);
            }
            
            
            window.resizeComment = function (elem){
                
                var el = elem;
              setTimeout(function(){
                el.style.cssText = 'height:auto; padding:0';
                // for box-sizing other than "content-box" use:
                // el.style.cssText = '-moz-box-sizing:content-box';
                el.style.cssText = 'height:' + el.scrollHeight + 'px';
                el.style.lineHeight = "15px";
              },0);
            }
          /****************************************************************/
          /************  Preview image after select from pc   *************/
          /****************************************************************/
           window.readURL = function (input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                     reader.onload = function (e) {
                        $('.img-loadd').attr('src',e.target.result);
                        $('#blah').addClass('etHW');
                        $('#blah').css('display','block');
                    }
                     reader.readAsDataURL(input.files[0]);
                }
            }
            $(".file-img-upload").change(function(){
                readURL(this);
            });
           // event of upload 
          $('.upload-event').click( function (){
              $('.file-img-upload').trigger('click');
          }) ;
          
          $('.upload-event-music').click( function (){
              $('.file-music-upload').trigger('click');
          }) ;
          
           $('.upload-event-video').click( function (){
              $('.file-video-upload').trigger('click');
          }) ;
          
          
          /********************************************************************************/
          /******  Upload-Add image - video - music  after select images via jquery  *****/
          /*******************************************************************************/
          
          // 1- images
          $('.file-img-upload').change(function(){
              
                $('.file-music-upload').val(null);
                $('.file-included').html('<div class="muisc-masks"></div><div class="music-info mdoo"><ul><li style="background-image: url(music_albums/music_covers/default_music.jpg); " class="img-container img-artist"> </li><li class="info-msc"><h4 class="song-name">Song Name</h4><span class="singer-name"></span></li></ul></div><ul class="file-uploader-menu mdoo"><li><i class="fa fa-music"><span style="padding-left:3px;">-</span></i></i></li><li><div class="fileUpload"><div class="fileprogress"></div></div></li><li><i onclick="return remover_musicfile();"  class="fa fa-remove faremove"></i></li></ul>').css('display','none');  ;

                 
                $('.file-video-upload').val(null);
                $('.file-video-responsed').html('<div class="video text-center"><i class="fa fa-file-video-o"></i></div><div class="scs"><b><span></span><i onclick="return remove_thisvideo();" class="fa fa-remove fa-deletevideo"></i> </b><span></span><div class="progrees-vid"><div class="inprog-video"></div></div></div>').css('display','none')  ;
 
                
                
              $('#blah').html('<img class="img-loadd" /><i onclick="return deleteThisImage();" class="fa fa-close fa-pos"></i><div class="progressbar"><div class="fill-progress"></div></div>');
             // file object 
              var file = document.getElementById('file-img-upload').files[0];
                //alert(file.name+" | "+file.size+" | "+file.type);
               var formdata = new FormData();
              formdata.append("posted_image", file);
              formdata.append("currentProfileId",<?php echo $user_id ;?>);
              formdata.append("proccessType","ADD_ALBUM_POST");
               var ajax = new XMLHttpRequest();
                // inprogress bar 
               ajax.upload.addEventListener("progress", function (event){
                 
                  $('#butn-add-post').addClass('disabled');
                  var percent = (event.loaded / event.total) * 100;
                   $('.fill-progress').css('width',Math.round(percent)+"%");
                } , false);
              // image upload completed 
              ajax.addEventListener("load", function (event){ 
                 // alert($.trim(event.target.responseText));
                    if($.trim(event.target.responseText) == 1 )
                      { 
                          // show image transparent after uploaded
                          $('.img-loadd').css({
                              'opacity' : '0.8'
                          });
                          $('.fill-progress').attr('isCompleted','1')
                          // allow post button active 
                           $('#butn-add-post').removeClass('disabled');
                      }else {
                          $('#blah').html("<span style='color:red;'>"+$.trim(event.target.responseText)+"</span>")  ;
                         $('.file-img-upload').val(null);
                            $('.file-music-upload').val(null);
                            $('.file-video-upload').val(null);
                      }
                      
              }, false); 
              // finish ajax request
              ajax.open("POST", "../controller/controller_timeline_images.php");
              ajax.send(formdata);
          });
          
           // 2- music
           $('.file-music-upload').change(function (){
           
                
                $('.file-img-upload').val(null);
                $('#blah').html('<img class="img-loadd" /><i onclick="return deleteThisImage();" class="fa fa-close fa-pos"></i><div class="progressbar"><div class="fill-progress"></div></div>').css('display','none');

                
                $('.file-video-upload').val(null);
                $('.file-video-responsed').html('<div class="video text-center"><i class="fa fa-file-video-o"></i></div><div class="scs"><b><span></span><i onclick="return remove_thisvideo();" class="fa fa-remove fa-deletevideo"></i> </b><span></span><div class="progrees-vid"><div class="inprog-video"></div></div></div>').css('display','none')  ;
 
                
                 
                  var file = document.getElementById('file-music-upload').files[0];
                 if(file.type =='audio/mpeg' || file.type == "audio/x-mpeg" || file.type == "audio/mp3" || file.type == "audio/x-mp3" || file.type == "audio/mpeg3" || file.type == "audio/mpg" || file.type == "audio/x-mpg" || file.type == "audio/x-mpegaudio"  || file.type == "audio/x-mpeg3" ){
                    
                 
                
                                                $('.file-included').html('<div class="muisc-masks"></div><div class="music-info mdoo"><ul><li style="background-image: url(music_albums/music_covers/default_music.jpg); " class="img-container img-artist"> </li><li class="info-msc"><h4 class="song-name">Song Name</h4><span class="singer-name"></span></li></ul></div><ul class="file-uploader-menu mdoo"><li><i class="fa fa-music"><span style="padding-left:3px;">-</span></i></i></li><li><div class="fileUpload"><div class="fileprogress"></div></div></li><li><i onclick="return remover_musicfile();"  class="fa fa-remove faremove"></i></li></ul>')  ;
                                               $('.file-included').css('display', 'block');
                                               /***********************************************/
                                               // reading mp3 file 
                                               var  url = file.urn || file.name;

                                                       ID3.loadTags(url, function() {
                                                             var tags = ID3.getAllTags(url);
                                                               console.log(tags);
                                                              /* 
                                                               document.getElementById('title').textContent = tags.title || "";
                                                               document.getElementById('artist').textContent = tags.artist || "";
                                                               document.getElementById('album').textContent = tags.album || "";
                                                              */
                                                              var image = tags.picture;
                                                              var base64 = null ;
                                                               if (image) {
                                                                 var base64String = "";
                                                                 for (var i = 0; i < image.data.length; i++) {
                                                                     base64String += String.fromCharCode(image.data[i]);
                                                                 }
                                                                   base64 = "data:" + image.format + ";base64," +
                                                                         window.btoa(base64String);


                                                               //  document.getElementById('picture').setAttribute('src',base64);
                                                               }  
                                                           if( base64   === null )
                                                                base64 = "music_albums/music_covers/default_music.jpg" ;

                                                         $('.file-included').css('background-image','url('+base64+')');
                                                         $('.img-artist').css('background-image','url('+base64+')');
                                                       var  songTitle = tags.title ;
                                                       //alert(songTitle);
                                                       var artisName =  tags.artist ;
                                                        if(tags.title ==null)
                                                             songTitle = 'Undefine song';
                                                       if(tags.artist == null)
                                                           artisName = 'Unknown artist';
                                                         $('.song-name').html(songTitle);
                                                         $('.singer-name').html(artisName);

                                                      // $('#imguoplk').attr('src', base64 );


                                                         var formdata = new FormData();
                                                           formdata.append("posted_image", file);
                                                           formdata.append("proccessType","ADD_ALBUM_POST");
                                                          formdata.append("currentProfileId",<?php echo $user_id ;?>);
                                                           formdata.append("artisName",artisName );
                                                           formdata.append("songTitle",songTitle);
                                                             formdata.append("base64",base64);

                                                           var ajax = new XMLHttpRequest();
                                                            // inprogress bar 
                                                         ajax.upload.addEventListener("progress", function (event){

                                                            $('#butn-add-post').addClass('disabled');
                                                            var percent = (event.loaded / event.total) * 100;
                                                             $('.fileprogress').css('width',Math.round(percent)+"%");
                                                          } , false);
                                                          // image upload completed 
                                                        ajax.addEventListener("load", function (event){ 
                                                           // alert($.trim(event.target.responseText));
                                                              if($.trim(event.target.responseText) == 1 )
                                                                { 

                                                                    $('.fileprogress').attr('isCompleted','1')
                                                                    // allow post button active 
                                                                     $('#butn-add-post').removeClass('disabled');
                                                                }else {
                                                                    $('.file-included').html("<span style='color:red;'>"+$.trim(event.target.responseText)+"</span>")  ;
                                                                    $('.file-img-upload').val(null);
                                                                    $('.file-music-upload').val(null);
                                                                    $('.file-video-upload').val(null);
                                                                 }



                                                        }, false); 
                                                        // finish ajax request
                                                        ajax.open("POST", "../controller/controller_timeline_musics.php");
                                                        ajax.send(formdata);



                                                       }, {
                                                         tags: ["title","artist","album","picture"],
                                                         dataReader: ID3.FileAPIReader(file)
                                                       });
                                               /***********************************************/

                 }else {
                 $('.file-included').html("<span style='color:red;'>This is not audio file , please upload audio with mp3 extension</span>").css('background-image','none').fadeIn()  ;
                   $('.file-img-upload').val(null);
                    $('.file-music-upload').val(null);
                    $('.file-video-upload').val(null);
                 }
                
           });
           
           // 3- video 
           $('.file-video-upload').change(function (){
                
                $('.file-music-upload').val(null);
                $('.file-included').html('<div class="muisc-masks"></div><div class="music-info mdoo"><ul><li style="background-image: url(music_albums/music_covers/default_music.jpg); " class="img-container img-artist"> </li><li class="info-msc"><h4 class="song-name">Song Name</h4><span class="singer-name"></span></li></ul></div><ul class="file-uploader-menu mdoo"><li><i class="fa fa-music"><span style="padding-left:3px;">-</span></i></i></li><li><div class="fileUpload"><div class="fileprogress"></div></div></li><li><i onclick="return remover_musicfile();"  class="fa fa-remove faremove"></i></li></ul>').css('display','none');  ;

                $('.file-img-upload').val(null);
                $('#blah').html('<img class="img-loadd" /><i onclick="return deleteThisImage();" class="fa fa-close fa-pos"></i><div class="progressbar"><div class="fill-progress"></div></div>').css('display','none');

                 
                
                 var file = document.getElementById('file-video-upload').files[0];
                   if(file.type =='video/mov' || file.type == "video/mp4" || file.type == "video/3gp" || file.type == "video/ogg"){
                       var fileName = file.name.substring(0, file.name.indexOf('.'));
                       var FileSize = file.size ;
                        $('.file-video-responsed').html('<div class="video text-center"><i class="fa fa-file-video-o"></i></div><div class="scs"><b><span></span><i onclick="return remove_thisvideo();" class="fa fa-remove fa-deletevideo"></i> </b><span></span><div class="progrees-vid"><div class="inprog-video"></div></div></div>')  ;
                        $('.file-video-responsed').css('display', 'block');
                        $('.scs > b > span').html(fileName);
                        $('.scs > span').html(Math.round((file.size/1024)/1024) + " Mb");
                        var formdata = new FormData();
                        formdata.append("proccessType", "ADD_ALBUM_POST");
                        formdata.append("posted_video", file);
                        formdata.append("videoTitle", fileName );
                        formdata.append("currentProfileId",<?php echo $user_id ;?>);
                        formdata.append("videoSize", FileSize );
                        var ajax = new XMLHttpRequest();
                        // inprogress bar 
                        ajax.upload.addEventListener("progress", function (event){
                          
                        $('#butn-add-post').addClass('disabled');
                        var percent = (event.loaded / event.total) * 100;
                        $('.inprog-video').css('width',Math.round(percent)+"%");
                        } , false);
                        // image upload completed 
                        ajax.addEventListener("load", function (event){ 
                        // alert($.trim(event.target.responseText));
                        if($.trim(event.target.responseText) == 1 )
                        { 
                         $('.inprog-video').attr('isCompleted','1')
                         // allow post button active 
                         $('#butn-add-post').removeClass('disabled');
                         }else {
                         $('.file-video-responsed').html("<span style='color:red;font-size: 12px;'>"+$.trim(event.target.responseText)+"</span>")  ;
                         $('.file-img-upload').val(null);
                         $('.file-music-upload').val(null);
                         $('.file-video-upload').val(null);
                         }}, false);  
                          ajax.open("POST", "../controller/controller_timeline_video.php");
                          ajax.send(formdata);
                   }else {
                            $('.file-video-responsed').html("<span style='color:red;font-size: 12px;'>This is not video file , please upload video with mp4 or 3gp or ogg or mov type</span>").css('background-image','none').fadeIn()  ;
                            $('.file-img-upload').val(null);
                            $('.file-music-upload').val(null);
                            $('.file-video-upload').val(null);
                        }
           });
                
            
                  
          /****************************************************************/
          /*******************  Delete image that addedd  *****************/
          /****************************************************************/
          // 1- photo
          window.deleteThisImage = function (){
                    $('.file-img-upload').val(null);
                    $('.file-music-upload').val(null);
                    $('.file-img-upload').val(null);
                // delete the latest image that stored in database by this user 
               $.ajax({
                   url : '../controller/controller_timeline_images.php' ,
                   type : 'POST' , 
                   data :{"proccessType":"DELETE_ALBUM_POST"} , 
                   success : function (response){
                      // alert(response);
                        var isDeleted = $.trim(response);
                       if(isDeleted == 1)
                            {
                                // delete image from this node insid post 
                                $('#blah').html(null)  ;
                                $('#blah').append('<img class="img-loadd" /><i onclick="return deleteThisImage();" class="fa fa-close fa-pos"></i><div class="progressbar"><div class="fill-progress"></div></div>');
                            }
                    }
               });
               $('.file-img-upload').val(null);
                    $('.file-music-upload').val(null);
                    $('.file-video-upload').val(null);
             } 
             
           // 2- music
           window.remover_musicfile = function (){
            $('.file-img-upload').val(null);
                    $('.file-music-upload').val(null);
                    $('.file-img-upload').val(null);
                // delete the latest image that stored in database by this user 
               $.ajax({
                   url : '../controller/controller_timeline_musics.php' ,
                   type : 'POST' , 
                   data :{"proccessType":"DELETE_ALBUM_POST"} , 
                   success : function (response){
                      // alert(response);
                        var isDeleted = $.trim(response);
                       if(isDeleted == 1)
                            {
                                $('.file-included').css('display','none');
                                // delete image from this node insid post 
                                $('.file-included').html('<div class="muisc-masks"></div><div class="music-info mdoo"><ul><li style="background-image: url(music_albums/music_covers/default_music.jpg); " class="img-container img-artist"> </li><li class="info-msc"><h4 class="song-name">Song Name</h4><span class="singer-name"></span></li></ul></div><ul class="file-uploader-menu mdoo"><li><i class="fa fa-music"><span style="padding-left:3px;">-</span></i></i></li><li><div class="fileUpload"><div class="fileprogress"></div></div></li><li><i onclick="return remover_musicfile();"  class="fa fa-remove faremove"></i></li></ul>');
                             }
                    }
               });
               $('.file-img-upload').val(null);
                    $('.file-music-upload').val(null);
                    $('.file-video-upload').val(null);
             }
           // 3- video 
           window.remove_thisvideo = function () {
                   
                $.ajax({
                        url : '../controller/controller_timeline_video.php' ,
                        type : 'POST' , 
                        data :{"proccessType":"DELETE_ALBUM_POST"} , 
                        success : function (response){
                           // alert(response);
                             var isDeleted = $.trim(response);
                            if(isDeleted == 1)
                                 {
                                     $('.file-video-responsed').css('display','none');
                                     // delete image from this node insid post 
                                     $('.file-video-responsed').html('<div class="video text-center"><i class="fa fa-file-video-o"></i></div><div class="scs"><b><span></span><i onclick="return remove_thisvideo();" class="fa fa-remove fa-deletevideo"></i> </b><span></span><div class="progrees-vid"><div class="inprog-video"></div></div></div>')  ;
                                  }
                         }
                    });
                    $('.file-img-upload').val(null);
                    $('.file-music-upload').val(null);
                    $('.file-video-upload').val(null);
           }
           /****************************************************************/
          /***************  Add new post (text with ) img vid mus  ********/
          /****************************************************************/
           
           window.postStatus = function (paragraph , accessPremission , postedWith){
                // in this case will be text only 
               if(postedWith == '' )
                   {
                       if(paragraph != '' )
                           {    
                               $.ajax({
                                   url : '../controller/controller_timeline_status.php' ,
                                   type : 'post' ,
                                   data : {
                                       'is_shared' : '1' ,
                                       'accessPremission' :accessPremission  , 
                                       'status' : paragraph  ,
                                       'accessType' : 'share_status',
                                       'currentProfileId': <?php echo $user_id ;?> 
                                   } ,
                                   success : function (responsed){
                                      
                                   }
                               });
                           }
                           
                           
                      $('#text-area').val(null);    
                    $('.file-img-upload').val(null);
                    $('.file-music-upload').val(null);
                    $('.file-video-upload').val(null);
                    
                    $('#blah').html('<img class="img-loadd" /><i onclick="return deleteThisImage();" class="fa fa-close fa-pos"></i><div class="progressbar"><div class="fill-progress"></div></div>').css('display','none')  ; 
                    $('.file-included').html('<div class="muisc-masks"></div><div class="music-info mdoo"><ul><li style="background-image: url(music_albums/music_covers/default_music.jpg); " class="img-container img-artist"> </li><li class="info-msc"><h4 class="song-name">Song Name</h4><span class="singer-name"></span></li></ul></div><ul class="file-uploader-menu mdoo"><li><i class="fa fa-music"><span style="padding-left:3px;">-</span></i></i></li><li><div class="fileUpload"><div class="fileprogress"></div></div></li><li><i onclick="return remover_musicfile();"  class="fa fa-remove faremove"></i></li></ul>').css('display','none')  ; 
                    $('.file-video-responsed').html('<div class="video text-center"><i class="fa fa-file-video-o"></i></div><div class="scs"><b><span></span><i onclick="return remove_thisvideo();" class="fa fa-remove fa-deletevideo"></i> </b><span></span><div class="progrees-vid"><div class="inprog-video"></div></div></div>').css('display','none')  ;
                   
                        return false ;
                        
                   }
                   
                   // in this case will be found attachement 
                   var statusParagraph = '' ;
                    if(paragraph != '' )
                         statusParagraph = paragraph ;
                    
                    $.ajax({
                         url : '../controller/controller_timeline_status.php' ,
                         type : 'post' ,
                         data : {
                         'is_shared' : '1' ,
                         'accessPremission' :accessPremission  , 
                         'status' : statusParagraph  ,
                         'accessType' : 'share_atachments' , 
                         'attachmentType' : postedWith ,
                          'currentProfileId': <?php echo $user_id ;?> 
                         } ,
                         success : function (responsed){
                         
                         } 
                    });
                    
                    $('#text-area').val(null);    
                    $('.file-img-upload').val(null);
                    $('.file-music-upload').val(null);
                    $('.file-video-upload').val(null);
                    
                    $('#blah').html('<img class="img-loadd" /><i onclick="return deleteThisImage();" class="fa fa-close fa-pos"></i><div class="progressbar"><div class="fill-progress"></div></div>').css('display','none')  ; 
                    $('.file-included').html('<div class="muisc-masks"></div><div class="music-info mdoo"><ul><li style="background-image: url(music_albums/music_covers/default_music.jpg); " class="img-container img-artist"> </li><li class="info-msc"><h4 class="song-name">Song Name</h4><span class="singer-name"></span></li></ul></div><ul class="file-uploader-menu mdoo"><li><i class="fa fa-music"><span style="padding-left:3px;">-</span></i></i></li><li><div class="fileUpload"><div class="fileprogress"></div></div></li><li><i onclick="return remover_musicfile();"  class="fa fa-remove faremove"></i></li></ul>').css('display','none')  ; 
                    $('.file-video-responsed').html('<div class="video text-center"><i class="fa fa-file-video-o"></i></div><div class="scs"><b><span></span><i onclick="return remove_thisvideo();" class="fa fa-remove fa-deletevideo"></i> </b><span></span><div class="progrees-vid"><div class="inprog-video"></div></div></div>').css('display','none')  ;
                   
           }
           
            $('#butn-add-post').click(function(){
                var texts = $('#text-area').val() ;
                var accessPremissions = $('#accessPrem').val() ;
                 // check if is there an image 
                 if($('.file-img-upload').val() != '' ){
                          postStatus(texts,accessPremissions,'img');
                         return false ;
                     }else if ($('.file-music-upload').val() != ''){
                          postStatus(texts,accessPremissions,'mus');
                         return false ;
                     }else if ($('.file-video-upload').val() != ''){
                          postStatus(texts,accessPremissions,'vid');
                        return false ;
                     } 
                     postStatus(texts,accessPremissions,'');  
                     
                     
                     
                 });
            
        window.loadMoreComment = function (postId,P_ClassName,CMT_lastId){
              $.ajax({
                  url : '../controller/controller_load_more_comments.php',
                  data : {
                      'last-id':CMT_lastId , 
                      'post-id':postId  
                   } ,
                   type : 'post' , 
                   success : function (respond){
                       alert(respond);
                   }
              });
          } 
        });
    </script>
    </body>
</html>