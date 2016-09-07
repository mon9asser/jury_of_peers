<?php
    $file = dirname(__FILE__)."/access_modifiers/protected_access.php";
    if(is_file($file )) require_once $file  ;
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
         
          <style>
                                .playInfo {
                                    display: inline-block;
                                    overflow: hidden;
                                    float: left;
                                     padding: 13px 10px;
                                     font-size: 22px;
                                     padding-right: 60px;
                                }
                                .music-cover {
                                    display: inline-block;
                                    overflow: hidden;
                                    height: 150px;
                                    width: 150px;
                                     margin: 5px;
                                    background-size: cover;
                                    background-repeat: no-repeat;
                                    background-position: 80% 0%;
                                    overflow: hidden;
                                    position: relative;
                                    cursor: pointer;
                                    float: left;
                                }
                                .titleVideo {
                                    margin-top: 5px;
                                    width: 100%;
                                    display: block ;
                                    overflow: hidden ;
                                }
                                .sss {
                                    font-size: 15px;
                                    color: #999;
                                }
                                .videoIncluder {
                                   max-width: 500px;
                                    background: #fff;
                                }
                                .music-cover {
                                    background: none;
                                }
                                .mmGabesd {
                                    margin: 0px;
                                    padding: 5px;
                                    height: auto;
                                    width: auto;line-height: 2;
                                    overflow: hidden;
                                }
                            </style>
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
                <div class="col-xs-12 col-md-10 profile-content">
                    <!-- Music Uploads will be hid -->
                    <div class="containerAlbums">
                         
                        
                        
                      
                        <div class="GetALlAlbums">
                           
                            <div class="wholeRow">
                                <h1 style="line-height: 2;padding: 0px 10px; margin: 0px; font-size: 20px; float: left ; ">
                                    My Videos
                                </h1>
                             <div class="mmGabesd">
                                     Upload Albums or mp4 file
                             </div>
                            </div>
                           
                            
                            
                            <?php
                            
                                $videoPostApis = new video_posts_applications() ;
                                $videos = $videoPostApis ->video_posts_get_by_values([
                                    'user_id'=>$_SESSION['user_info']['user_id'] , 'posted_by_id'=>$_SESSION['user_info']['user_id']
                                ],'or');
                            ?>
                           <?php
                           
                            for($i=0;$i<count($videos);$i++){
                                ?>
                            <div onclick="window.location.href='video_judge?id=<?php echo $videos[$i]->id ; ?>'" style="border: 1px solid #dfdfdf;margin: 10px 10px;cursor: pointer;" class="videoIncluder">
                                <div style="
                                        background-image: url(images/video_play.png);
                                         background-size: 80% 80%;
                                        background-position: 48% 47%;
                                        background-repeat: no-repeat;
                                        box-shadow: 0px 0px 0px 0px ;
                                        border: 0px;
                                    " class="music-cover">
                                    
                                </div>
                                <div class="playInfo">
                                    <b style="margin-top: 11px;" class="titleVideo">
                                       <?php
                                       $nm = NULL ;
                                         if( $videos[$i]->video_name == NULL ) 
                                             $nm =  "Undefine Name";
                                         else $nm =  $videos[$i]->video_name ;
                                          
                                        echo substr($nm, 0, 20).'...';
                                       ?>
                                    </b>
                                      <!--
                                    <span id="ratingVideo" class="titleVideo sss ratingVideo"></span>
                                      -->
                                    <span class="titleVideo sss">
                                        <i>File size : <?php
                                            echo ceil($videos[$i]->video_size/1024) ;
                                        ?> Mb </i>
                                    </span>
                                </div>
                            </div>     
                                    
                               <?php
                            }
                           ?>
                            
                            
                            
                            
                              
                            
                            
                             
                             
                            
                             
                        </div>
                          
                        
                         <!-- Upload Music --> 
                       <div style="display: none;" class="containerUpload">
                            <input class="mmuploads" type="file" name="files[]" id="filer_input2" multiple="multiple">
                       </div>
                    </div>
                    
                    
                   
                 </div>
                
                 
            </div>
        </section>
        
        
        
        
        
      <!--jQuery-->
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/simple-slider.min.js"></script>
        <script src="js/nice_scrollbar.js"></script>
        <script src="js/jquery.raty.js"></script>
	<script type="text/javascript" src="js/jquery.filer.min.js?v=1.0.5"></script>
        <script type="text/javascript" src="js/video_cont.js"></script>
        <script type="text/javascript" src="js/uploadvideo.js"></script>
        <script>
            $(document).ready(function (){
                    $('.ratingVideo').raty({
                        starOn:    'images/video_on.png',   
                        starOff:   'images/video_off.png'  ,
                         readOnly: true , 
                         'score':4
                     });
            });
        </script>
    </body>
</html>

