<?php
    $file = dirname(__FILE__)."/access_modifiers/protected_access.php";
    if(is_file($file )) require_once $file  ;
    
    
      
    
    ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


    // user name get 
    $username = $_SESSION['user_info']['user_name'];
    if(isset($_GET['user'])){
        $username = $_GET['user'];
    }
    $userApis = new user_applications() ;
    $userInfo = $userApis ->user_application_check_exist(['u_name'=>$username]);
        if($userInfo == NULL )
      header('location: login');
        
        
        
        
        
        
        
        
        
         $albumApis = new music_albums_applications();
     // post_serial_id
         
    if(isset($_GET['id'])) // albume id 
     {
        $albumId = trim($_GET['id']);
       
        $albumInfo = $albumApis->music_albums_check_exist(['id'=>$albumId]);
        if($albumInfo == NULL )
            { 
               echo "<script type='text/javascript'>history.go(-1)</script>";
               exit(1);
            }
     }else if (isset($_GET['code'])){ // music id 
            $code_post_id = $_GET['code'] ;
            $postApis = new user_posts_applications() ;
            $musicsApis = new music_posts_applications() ;
            
            $postExist = $postApis->user_posts_check_exist(['post_serial_id'=>$code_post_id]);
            $musicExis = $musicsApis->music_posts_check_exist(['post_serial_id'=>$code_post_id]);
            $albumInfo = $albumApis->music_albums_check_exist(['id'=>$musicExis->album_id]);
            if($albumInfo == NULL )
                { 
                   echo "<script type='text/javascript'>history.go(-1)</script>";
                   exit(1);
                }
                
         if($musicExis == NULL )
                { 
                   echo "<script type='text/javascript'>history.go(-1)</script>";
                   exit(1);
                }
                
                
                
                
             
                
          
     }else {
          echo "<script type='text/javascript'>history.go(-1)</script>";
        exit(1);
     }
     
     
     
     
     
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
         <link rel="stylesheet" href="css/jquery.raty.css">
         <link href="css/profile.css" rel="stylesheet">
         <link href="css/music.css" rel="stylesheet">
         <link href="css/fontello.css" rel="stylesheet">
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
        <!-- ---------------------      background   ----------------------- -->
        <!-- --------------------------------------------------------------- -->
        
        
        <!-- --------------------------------------------------------------- -->
        <!-- ---------------------      Header      ------------------------ -->
        <!-- --------------------------------------------------------------- -->
         <?php 
            $headerFile = dirname(__FILE__)."/includes/header.php";
            if(is_file($headerFile ))  require_once $headerFile ;
        ?>
        <!-- --------------------------------------------------------------- -->
        <!-- ---------------------      Contents   ------------------------ -->
        <!-- --------------------------------------------------------------- -->
        <section class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-md-2 sidebar-outer">
                     <?php 
                        $sidebarFile = dirname(__FILE__)."/includes/sidebar.php";
                        if(is_file($sidebarFile ))  require_once $sidebarFile ;
                    ?>
                </div>
                <div class="col-xs-12 col-md-10 profile-content">
                    <?php
                        // cover album 
                        $targetImage = 'music_display.jpg'; 
                        if($albumInfo->album_cover != NULL )
                        $targetImage = $albumInfo->album_cover ;
                     
                        $musicApi = new music_posts_applications();
                        $music = $musicApi->music_posts_get_by_values(['album_id'=>$albumInfo->id],'and')
                     ?>
                     <!-- Track cover -->
                     <div style="background-position: 100% 0%;background: url(music_albums/music_covers/<?php echo $targetImage; ?>);background-size: cover ; ;background-repeat: no-repeat ;" class="music-container">
                         <div class="music-container-mask"></div>
                        <!-- All data related this user music -->
                        <div class="music-info-contaienr">
                             <div class="headline-music">
                                <h1 class="music-name">
                                    <?php if (isset($_GET['code'])) echo  $musicExis->music_name ; else   echo $music[0]->music_name ; ?> 
                                      <br />
                                    <span class="artist-name">
                                       <span class="name-artist"> <?php  if (isset($_GET['code'])) echo  $musicExis->singer_name ; else  echo $music[0]->singer_name ; ?> </span>
                                       <span style="" class="song-vot"> 
                                           <span style="
                                                 float: left;
                                                 color: #F4AC00 ;
                                                 font-size: 18px;
                                                 overflow: hidden ;
                                                 "> 
                                           <?php
                                           if (isset($_GET['code']))   $id_music = $musicExis->id ; else   $id_music = $music[0]->id ; 
                                             // courtrooms
                                           $evaluationApis  =new reviews_rating_applications();
                                           
                                           
                                            $initCourtroom =  $evaluationApis ->reviews_rating_apis_get_sum_of_program( 
                                                  " WHERE post_id= {$id_music}  AND program_type=1"
                                               );
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
                                           </span>
                                           <img style="
                                                float: left;
                                                padding: 1px;
                                                padding-left: 3px;
                                                " src="images/star-on.png" />
                                       </span>
                                     </span>
                                 
                                </h1>
                            </div>
                            <div class="action-music">
                                <div class="duration-of-this-track">
                                    <h1 class="durTime">0:00</h1>
                                    <h3>Rate this song now</h3>
                                    <div class="rats">
                                        <div id="evaluateMusic_department" song-id="<?php    if (isset($_GET['code'])) echo  $musicExis->id ; else  echo $music[0]->id ; ?>" class="RatNow"></div>
                                     </div>
                                </div>
                                 <div class="playlist-of-this-track">
                                     <div class="titleAlbum">
                                         <b>
                                             <i class="fa fa-music"></i>
                                            <?php echo $albumInfo->album_name ; ?>
                                         </b>
                                     </div>
                                     <div class="PlayList-for-all">
                                         
                                         <ul class="menulisted">
                                             <?php
                                                for($i=0;$i<count($music);$i++){
                                                    ?>
                                                        <li onclick="play_pNow(this,5,'<?php if($albumInfo->album_name == 'timeline') echo 'timeline/'.$music[$i]->music_src;else echo $music[$i]->music_src ; ?>');">
                                                            <a><i class="fa fa-play pls"></i></a>
                                                            <a>
                                                                <?php
                                                                   echo $music[$i]->music_name ;
                                                                ?> 
                                                                <b />
                                                             </a>
                                                            <!--
                                                            <a class="trac">5:00</a>
                                                            -->
                                                        </li>
                                                   <?php
                                                }
                                             ?>
                                             
                                              
                                         </ul>
                                     </div>
                                 </div>
                            </div>
                        </div>
                        <div class="play-song">
                            <div class="play-pause text-center">
                                <i id="songId" onclick="play_this_song('songId',5,'<?php 
                                if($albumInfo->album_name == 'timeline') {
                                    if (isset($_GET['code']))
                                        echo 'timeline/'.$musicExis->music_src ; 
                                        else 
                                            echo 'timeline/'.$music[0]->music_src ;
                                     } else{ if (isset($_GET['code']))
                                         echo  $musicExis->music_src ; 
                                     else echo $music[0]->music_src ;
                                     } ?>');" class="fa fa-play pl" aria-hidden="true"></i>
                            </div>
                            <div class="play-track">
                                <input id="seekslider" max="100" min="0" value="0" step="1" class="wholeTrack" type="range">
                            </div>
                            <div class="play-volume">
                                <div style="" class="track-voumes">
                                    <input id="volume-slider" type="text" data-slider-highlight="true"  data-slider="true" data-slider-theme="volume" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
      
        <!-- --------------------------------------------------------------- -->
        <!-- ---------------------      Footer      ------------------------ -->
        <!-- --------------------------------------------------------------- -->
        
    <script src="js/jquery-1.12.4.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/simple-slider.min.js"></script>
    <script src="js/nice_scrollbar.js"></script>
    <script src="js/jquery.raty.js"></script>
     
    <script type="text/javascript">
        $(document).ready(function(){
         $(".PlayList-for-all").niceScroll({
              cursorwidth: "6px",
              cursorborder:'0px',
              cursorborderradius:'0px',
              cursorcolor:"#222"
          });
          
          
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
          
          // Rating of this song 
          
          
          $('.song-rating').raty({'readOnly' : true , 'move':5 , 'score':4});
           $('#evaluateMusic_department').raty({
                click: function(score, evt) {
                var dataSting = {
                'score':score , 
                'typeOfEvaluate' : 1 ,  // Music 
                'postId' : $(this).attr('song-id') ,
                'appType' : 1 //timeline
                }
                $.ajax({
                url  : 'controller/controller_evaluate_object_mus_vid_phot.php' , 
                data :dataSting ,
                type : 'post' ,
                success :function (responsedData) {
                console.log(responsedData);
                } 
                }); 
                }
                });
            
            
            var audio, playbtn, mutebtn, seekslider, volumeslider, seeking=false, seekto;
             
            window.init_player = function (){
              audio = new Audio();  
              audio.loop = true;
              seekslider = document.getElementById("seekslider");
              seekslider.addEventListener("mousedown", function(event){ seeking=true; seek(event); });
              seekslider.addEventListener("mousemove", function(event){ seek(event); });
              seekslider.addEventListener("mouseup",function(){ seeking=false;});
            }
               
           window.play_pNow = function (eventType , song_id , soruce){
               if(!audio.paused && !audio.ended){ 
                   $(eventType).children('a').children('i').removeClass('fa-pause');
                   $(eventType).children('a').children('i').addClass('fa-play');
               }else {
                   $(eventType).children('a').children('i').removeClass('fa-play');
                   $(eventType).children('a').children('i').addClass('fa-pause');
               }
               play_this_song (eventType , song_id , soruce);
           }
            // everything related audio 
            window.play_this_song = function (eventType , song_id , soruce) { 
                audio.src = "music_albums/"+soruce ;
             // check if play or paus 
                 playThisSong();    
            }
            window.playThisSong = function(){
                audio.play();
                $('#songId').removeClass('fa-play');
                $('#songId').addClass('fa-pause');
                $('#songId').attr('onclick','pauseThisSong()');
            }
           window.pauseThisSong = function (){
               if(!audio.paused && !audio.ended){
                 audio.pause();
                 $('#songId').addClass('fa-play');
                 $('#songId').removeClass('fa-pause');
                 $('#songId').attr('onclick','playThisSong()');
               }
            }
           
           window.seek= function seek(event){
                if(seeking){
 		    seekslider.value = event.clientX - seekslider.offsetLeft;
                      seekto = audio.duration * (seekslider.value / 100);
                    audio.currentTime = seekto;
                 }
            }    
               
            
           window.load = init_player();    
        });
    </script>
    </body>
</html>
