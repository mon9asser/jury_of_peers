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
                   <!-- Load pages here -->
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
                                    My Friends
                                    </h2>                        
                               </div>  
                                <div class="friend-addbox">
                                    <div class="block-of-users">
                                      <?php
                                      $userFrieds = new friend_system_applications() ;
                                      $frd = $userFrieds->friend_system_apis_get_all("WHERE (id_sender=".$_SESSION['user_info']['user_id']." OR id_receiver =".$_SESSION['user_info']['user_id'].") AND (is_accepted = 1) ");
                                        if(count($frd) != 0 ){
                                            $userApps = new user_applications();
                                            $ThisId = 0 ;
                                            for($i=0;$i<count($frd);$i++){
                                                if($frd[$i]->id_sender == $_SESSION['user_info']['user_id'])  
                                                    $ThisId = $frd[$i]->id_receiver ;
                                                else 
                                                    $ThisId = $frd[$i]->id_sender ;
                                              $userInfo = $userApps->user_application_check_exist(['id'=>$ThisId]);
                                            ?>
                                        <div style="cursor: pointer;width: 380px;" onclick="got_this_link('user=<?php echo $userInfo->u_name; ?>')" last-id='' class="friend-block">
                                                    <div style="background-image:url(photo_albums/profile_picture/<?php echo get_profile_picture($userInfo->id); ?>); background-size: cover;" class="image-block"></div>
                                                        <div class="frdinfo-block">
                                                            <h3><?php echo $userInfo->f_name . ' ' .$userInfo->s_name ;?></h3>
                                                            <span><?php echo $userInfo->u_name ; ?></span>
                                                            
                                                            <div class="add-msg-controller">
                                                                <a class="btncontacts msg-ff" onclick="return blockThisUser(<?php $userInfo->id ;?>,this);">
                                                                <i class="fa fa-user fa-frd"></i>
                                                                </a>
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
                </div>
                 
                <script src="js/jquery-1.12.4_1.js"></script>
                <!-- Include all compiled plugins (below), or include individual files as needed -->
                <script src="js/bootstrap.min.js"></script>
                <script type="text/javascript" src="js/jquery.imgareaselect.js"></script>
                <script type="text/javascript" src="js/jquery.imgareaselect.pack.js"></script>
                <script src="js/main_app.js"></script>
                <script src="js/addfrd.js"></script> 
                <script>
                function got_this_link (link){
                    return window.location.href = "http://juryofpeers.tv/?"+link;
                }  
                </script>
        </body>
</html>