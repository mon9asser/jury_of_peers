<?php
  $file = dirname(__FILE__)."/access_modifiers/protected_access.php";
  if(is_file($file)) require_once $file  ;
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
             <link href="css/animate.css" rel="stylesheet">
             <link href="css/header.css" rel="stylesheet">
             <link rel="stylesheet" href="css/font-awesome.css">
              <link href="css/simple-slider.css" rel="stylesheet" type="text/css" />
             <link href="css/simple-slider-volume.css" rel="stylesheet" type="text/css" />  
             <link href="css/profile.css" rel="stylesheet">
              <link rel="stylesheet" href="css/fontello.css"> 
             <link href="css/complete.css" rel="stylesheet">
             <link href="css/emu.css" rel="stylesheet">
             <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
             <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
             <!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
              <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
             <![endif]-->
        </head>
        <body onload="notifications();">
                <!-- --------------------------------------- -->
                <!-- ------      Header      --------------- -->
                <!-- --------------------------------------- -->
                <?php 
                    $headerFile = dirname(__FILE__)."/includes/header.php";
                    if(is_file($headerFile ))  require_once $headerFile ;
                ?>
                
                 <!-- Load container inside this div -->
                <div id="Loaded" class="homePageLoder dataContainer container-fluid"> 
                  <div class="row">
                            <div class="col-xs-12 col-md-2 sidebar-outer">
                                <?php 
                                    $sidebarFile = dirname(__FILE__)."/includes/sidebar.php";
                                    if(is_file($sidebarFile ))  require_once $sidebarFile ;

                                    $file_all = dirname(__FILE__)."/modular/autoload_apps.php";
                                    if(is_file($file_all ))  require_once $file_all ;


                                     $profilePic = dirname(__FILE__)."/photo_albums/profile_picture/profile_picture.php";
                                    if(is_file($profilePic ))  require_once $profilePic  ;
                                ?>
                             </div>
                            <div class="col-xs-12 col-md-8 profile-content">
                                <div class="post-controls">
                                    <h2 class="compl-headline">
                                    Add friends in your Location    
                                    </h2>                        
                               </div>  
                                <div class="friend-addbox">
                                    <div class="block-of-users">
                                        <?php
                                            $user_apis = new user_get_more_pagination_package();
                                            $users = $user_apis->user_add_new_friend_get_more_by_values( 0 , 8 , $_SESSION['user_info']['user_id']  ) ;
                                            if(is_array($users )  )
                                            {
                                                for($i=0; $i < count($users ) ; $i++){
                                                    // profile picture 
                                                     $profile_picture_apis = new profile_picture_applications() ;
                                                     $user_setting = new general_settings_applications();
                                                     // check profile pic exist 
                                                     $profilePicSrc = NULL ;
                                                     $imgSize = NULL ;
                                                     $imgPosition = NULL ;
                                                      $ppExists =   $profile_picture_apis->profile_pictureg_get_by_values(['user_id'=>$users[$i]->id ],'and') ;
                                                      if(count ($ppExists )!= 0)  
                                                      {
                                                           $profilePic__source = "photo_albums/profile_picture/".$ppExists[count($ppExists)-1]->photo_src;
                                                           if (is_file($profilePic__source )){
                                                                        $profilePicSrc = $profilePic__source  ;
                                                                       
                                                            }else{
                                                                    $imgSize ="100% 100%";
                                                                    $imgPosition = "center center";
                                                                    if ($users[$i]->gender == 0 )
                                                                    $profilePicSrc  = "../images/man_avatar.jpg" ;
                                                                    else
                                                                    $profilePicSrc  =  "../images/female_avatar.jpg" ;
                                                                }

                                                      }else {
                                                                if ($users[$i]->gender == 0 )
                                                               $profilePicSrc  = "../images/man_avatar.jpg" ;
                                                                 else
                                                                 $profilePicSrc  =  "../images/female_avatar.jpg" ;
                                                                  $imgSize ="100% 100%";
                                                                 $imgPosition = "center center";
                                                             }
                                                   // check user setting exist 
                                                             $user_setting_apis = new general_settings_applications() ;
                                                             $workExist = $user_setting_apis ->general_settings_check_exist(['user_id'=>$users[$i]->id ]) ;
                                                             if($workExist != NULL )
                                                             $user_setting =  $workExist->job_title ;
                                                             else 
                                                             {
                                                                 $user_friend_apis = new friend_system_applications() ;
                                                                 $totalfrd = $user_friend_apis->friend_system_apis_get_all("WHERE is_accepted = 1 AND `id_sender`={$users[$i]->id} OR `id_receiver`={$users[$i]->id}");
                                                                 $user_setting = count($totalfrd)." Friend(s)";
                                                             }
                                                         $lastId = $users[$i]->id ;  
                                                         $frd_apis = new friend_system_applications() ;
                                                                $checkExist1 = $frd_apis->friend_system_check_exist([
                                                                    'id_sender' =>$_SESSION['user_info']['user_id'] ,
                                                                    'id_receiver'=> $users[$i]->id 
                                                                ], 'and');

                                                                $checkExist2 = $frd_apis->friend_system_check_exist([
                                                                    'id_sender' =>$users[$i]->id ,
                                                                    'id_receiver'=>  $_SESSION['user_info']['user_id']
                                                                ], 'and');
                                                           if ($checkExist1 == NULL and $checkExist2 == NULL and $_SESSION['user_info']['user_id'] != $users[$i]->id ) { 
                                                         ?>
                                                         <div last-id='<?php echo $lastId ;?>' class="friend-block">
                                                                 <div style="background-image:url('<?php echo $profilePicSrc ;?>'); background-size: cover ;   " class="image-block"></div>
                                                                  <div class="frdinfo-block">
                                                                      <h3><?php echo ucfirst($users[$i]->f_name)." ".ucfirst($users[$i]->s_name); ?></h3>
                                                                      <span><?php echo $user_setting ;?></span>
                                                                      <div class="add-msg-controller">
                                                                           <a class="btncontacts frdadd" onclick="return addThisUser(<?php echo $users[$i]->id ;?>,this);">
                                                                              <i class="icon-user-add fa-frd"></i>
                                                                               Add Friend
                                                                           </a>
                                                                           <a class="btncontacts msg-ff" onclick="return blockThisUser(<?php echo $users[$i]->id ;?>,this);">
                                                                               <i class="fa fa-minus-circle fa-frd"></i>
                                                                               Block
                                                                           </a>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                         <?php
                                                 }     
                                                }
                                            }
                                        ?>
                                    </div>
                                </div>
                                            <?php 
                                             if(count($users ) > 1 ){
                                            ?>
                                            <div id="load-more-boxs" last-id="<?php echo $lastId ;?>" class="control-btn general-btn text-center loadMoreBtn">
                                                Load More  
                                            </div>
                                            <?php }else {
                                                ?>
                                            <center><h3>     There are no users   </h3> </center>
                                                <?php 
                                            } ?>
                                            <div class="control-btn general-btn">
                                                <a href="home" id="skip">Skip </a>
                                            </div>
                            </div>
                        </div>
                </div>
                 
                <script src="js/jquery-1.12.4_1.js"></script>
                <!-- Include all compiled plugins (below), or include individual files as needed -->
                <script src="js/bootstrap.min.js"></script>
                <script type="text/javascript" src="js/jquery.imgareaselect.js"></script>
                <script type="text/javascript" src="js/jquery.imgareaselect.pack.js"></script>
                <script src="js/main_app.js"></script>
                <script src="js/addfrd.js"></script> 
        </body>
</html>