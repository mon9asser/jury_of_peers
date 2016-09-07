<?php
    $file = dirname(__FILE__)."/access_modifiers/protected_access.php";
    if(is_file($file )) require_once $file  ;
    // user name get 
    $username = $_SESSION['user_info']['user_name'];
    if(isset($_GET['user'])){
        $username = $_GET['user'];
    }
    // album id 
    $album_id = NULL ;
    if(isset($_GET['album'])){
        $album_id = $_GET['album'];
    }
    $userApis = new user_applications() ;
    $userInfo = $userApis ->user_application_check_exist(['u_name'=>$username]);
        if($userInfo == NULL )
      header('location: login');
        
              ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

	<!--jQuery-->
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/simple-slider.min.js"></script>
        <script src="js/nice_scrollbar.js"></script>
        <script src="js/jquery.raty.js"></script>
         
	<script type="text/javascript" src="js/jquery.filer.min.js?v=1.0.5"></script>
	<script type="text/javascript" src="js/custom.js?v=1.0.5"></script>
        <script type="text/javascript" src="js/uploadmusic.js"></script>
        
	<!--[if IE]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        
         <link href="css/animate.css" rel="stylesheet">
         <link href="css/header.css" rel="stylesheet">
         <link rel="stylesheet" href="css/font-awesome.css">
         <link rel="stylesheet" href="css/jquery.raty.css">
         <link href="css/profile.css" rel="stylesheet">
         <link href="css/music.css" rel="stylesheet">
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
                <div class="col-xs-12 col-md-8 profile-content">
                    <!-- Music Uploads will be hid -->
                    <div class="containerAlbums">
                        
                        
                        
                        <!-- Get Albums --> 
                        <div class="GetALlAlbums">
                            <!-- Album name -->
                            <?php
                              $musicAlbumApps = new music_albums_applications() ;
                              $albums = $musicAlbumApps->music_albums_get_by_values(['user_id'=>$userInfo->id],'and');
                              
                              for($i=0; $i<count($albums);$i++){
                                  ?>
                                <a href="album_music?id=<?php echo $albums[$i]->id ;?>" style="<?php if($albums[$i]->album_name == 'timeline'){echo 'background:#222;';} ?>background-image:url(music_albums/music_covers/<?php echo $albums[$i]->album_cover ?>)" class="music-cover">
                                         <div class="mask-song">
                                             <div class="song-info">
                                                 <!-- stars --> 
                                                 <b> <?php echo ucfirst( $albums[$i]->album_name );?> </b>
                                                 <center>
                                                     <?php
                                                        if($albums[$i]->album_name != 'timeline') {
                                                             ?>
                                                             <!-- 
                                                                <div data-score='3' class="evaluate"></div> 
                                                             -->
                                                                 <?php
                                                        }
                                                     ?>
                                                   </center>
                                                  
                                              </div>
                                          </div>
                                     </a>
                            
                                   <?php
                              }
                            ?>
                             
                            
                            
                            <!-- Upload --> 
                            <div class="mmGabesd sdsd">
                                <span class="titlsUploads">
                                    <i class="fa fa-music"></i>
                                    <br />
                                    Upload Albums or mp3 file
                                 </span>
                            </div>
                        </div>
                         <!-- Upload Music --> 
                       <div style="display: none;" class="containerUpload">
                              <input class="mmuploads" type="file" name="files[]" id="filer_input2" multiple="multiple">
                       </div>
                    </div>
                    
                    
                   
                 </div>
                 <div class="col-xs-12 col-md-2 sidebar-outer"> 
                </div>
            </div>
        </section>
        
        
        
        
        
        <script type="text/javascript">
            /*
            $(document).ready(function(){
               $('div[class^="evaluate"]').each(function(){
                   var targetElem =  $(this).attr('data-score');
                    $(this).raty({
                    readOnly:  true,
                    score   : targetElem
                  });
               });
               });
            */
        </script>
   
    </body>
</html>
