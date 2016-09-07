<?php
    $file = dirname(__FILE__)."/access_modifiers/protected_access.php";
    if(is_file($file )) require_once $file  ;
    
                                            
    
   
   if(!isset($_SESSION['user_info']['user_id']))
       {header('location: login');exit();}
 
   if(!isset($_GET['id']))
       {header('location: video');exit();}
   
        $videoApis = new video_posts_applications() ;
       $videoExist = $videoApis->video_posts_check_exist(['id'=>$_GET['id']]);
          if($videoExist == NULL )
       {header('location: video');exit();}
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
         <link href="css/animate.css" rel="stylesheet">
         <link href="css/header.css" rel="stylesheet">
         <link rel="stylesheet" href="css/font-awesome.css">
         <link href="css/profile.css" rel="stylesheet">
         <link href="css/emu.css" rel="stylesheet">
          <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
         <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
         <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
         <![endif]-->
         <style>
             .mmmnu li {
                 padding: 0px ;
                 margin: 0px;
                 display: inline-block;
             }
             .mmmnu li a {
                 padding: 10px;
                display: block;
                overflow: hidden;
                color: #999;
                cursor: pointer;
                 margin: 0px;
              }
              .mmmnu {
                    width: 100%;
                    padding: 0px;
                    margin: 0px;
                    list-style: none;
                    line-height: 1;
                    background: #f9f9f9;
              }
              .containerListType,.containerFilms {
                  display: block ;
                  width: 100%;
                  overflow: hidden ;
                  margin: 0px;
                  padding: 5px;
                  
              }
              .divationsScore {
                  width: 25%;
                  display: inline-block;
                  
                  float: left;
                  color: #555;
              }
              .divationsFile{
                   width: 66%;
                    display: inline-block;
                    overflow: hidden;
                    float: left;
                    color: #555;
                    cursor: pointer;
                    font-family: arial , sans-serif;
                    font-weight: bold;
                    text-align: left;
                    margin-left: 14px;
                    line-height: 2.3;
                }
              
              
              
              .divationsScore {
                 position: relative;
                 border: 1px solid #c2e1f5;
                padding: 5px 0px;
                }
               
                    .divationsScore:after, .divationsScore:before {
                            left: 100%;
                            top: 50%;
                            border: solid transparent;
                            content: " ";
                            height: 0;
                            width: 0;
                            position: absolute;
                            pointer-events: none;
                    }

                    .divationsScore:after {
                            border-color: rgba(136, 183, 213, 0);
                            border-left-color: #88b7d5;
                            border-width: 8px;
                            margin-top: -8px;
                    }
                    .divationsScore:before {
                            border-color: rgba(194, 225, 245, 0);
                            border-left-color: #c2e1f5;
                            border-width: 9px;
                            margin-top: -9px;
                    }
         </style>
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
                    <div class="col-xs-12 col-md-2 fixed">
                     <?php 
                        $sidebarFile = dirname(__FILE__)."/includes/sidebar.php";
                        if(is_file($sidebarFile ))  require_once $sidebarFile ;
                        
                       
                    ?>
                     </div>
                </div>
                <div class="col-xs-12 col-md-6 profile-content">
                    <div class="block-headline">
                        <h3><?php
                            echo $videoExist->video_name ;
                        ?> </h3>
                         
                        <span>
                            <?php
                                $albumApp = new video_film_categories_applications()  ;
                               $catego =  $albumApp->video_film_categories_check_exist(['id'=>$videoExist->album_id]);
                                $videCat = new apps() ;
                                  $categoryFun = $videCat ->video_category_exist($catego->group_name, $catego->album_name);
                                if($catego->group_name != NULL && $catego->album_name != NULL ){
                              
                                if($categoryFun['category'] != '') 
                                echo $categoryFun['category'];
                                }else echo 'Undefine Title';
                                
                            ?>
                        </span>
                    </div>
                    <div style="min-height: 380px;" class="video-container">
                        <div class="mask-video">
                            <div style="height: 383px; background: none;" class="vi">  
                                 <?php
                                    $videoSrcWMp3 =   $videoExist->video_src ;  
                                  $output = rtrim($videoSrcWMp3, '.mp3');
                                 ?>
                                <video width="100%" height="100%" controls>
                                    <source src="video_albums/<?php if( $categoryFun['category'] =='timeline') { ?>timeline/<?php echo $videoSrcWMp3 ; }else echo $videoSrcWMp3 ;?>" type="video/mp4">
                                    <source src="video_albums/<?php if( $categoryFun['category'] =='timeline') { ?>timeline/<?php echo   $output ;}else echo $output ;?>.ogg" type="video/ogg">
                                    Your browser does not support the video tag.
                                </video>
                                             
                             </div>
                        </div>
                     </div>
                    <div class="video-controler">
                        <ul class="menu-cont update">
                        
                            <li>
                                <a video-type="<?php echo $catego->group_name ; ?>" song-id='<?php echo $videoExist->id ; ?>' id="innVideoRate"></a>
                            </li>
                            <!-- 
                            <li>
                                <a>
                                <i style="background-image: url(img_sliders/constitutional.png)" class="disputs"></i>
                                Dispute  
                                </a>
                            </li>
                            -->
                       </ul>
                    </div>
                    <!-- user write comment 
                    <div contenteditable="true" data-text="Write Comment"  class="video-controler video-controler2"></div>
                    -->
               </div>
                <div class="col-xs-12 col-md-4">
                    <div style="" class="voting text-center">
                        <ul class="mmmnu" style="width: 100%;padding: 0px;margin: 0px;list-style: none ;">
                           <li>
                               <a onclick="load_video_groups(this)" data-load-target='0'> In theater </a>
                           </li>
                           <li>
                                <a onclick="load_video_groups(this)" data-load-target='1'> DVD & streaming </a>
                           </li>
                           <li>
                                <a onclick="load_video_groups(this)" data-load-target='2'> TV SHOWS </a>
                           </li>
                        </ul>
                        
                        <div class="containerListType">
                            
                            <?php
                                $getApiMainArgs = new main_get_app();
                                $videosAccGroup = $getApiMainArgs->get_apps_sum_desc_reviews(2,1/*video type*/);
                                  
                            ?>
                            <?php for ($i=0;$i<count($videosAccGroup);$i++){ 
                                
                                 $vide_post_apis = new video_posts_applications() ;
                                     $videoInfo = $vide_post_apis->video_posts_check_exist(['id'=>$videosAccGroup[$i]->post_id]);
                                ?>
                                <div onclick="window.location.href='video_judge?id=<?php echo $videoInfo->id; ?>'" title="<?php echo $videosAccGroup[$i]->review_counter.' Review(s)'?>" data-toggle="tooltip" data-placement="left"  class="containerFilms">
                                <div class="divationsScore">
                                    Score : 
                                    <span  style="font-weight: bold;line-height: 1;color: teal;">
                                        <?php
                                        
                                              $counts = $videosAccGroup[$i]->review_counter;
                                            $sumRows =$videosAccGroup[$i]->sum_reviews  ;
                                            $fixed = 0.05 ;
                                               if($sumRows != 0 ){
                                               $rowPercent = $counts * $fixed ;
                                               $perccentStar = $sumRows / $rowPercent ;
                                               $starss =     $perccentStar * $fixed     ;
                                               echo substr($starss, 0, 3); 
                                            }else echo 0 ;       
                                        ?>
                                    </span>
                                    <img  src="images/video_on.png" />
                                    
                                </div>
                                <div class="divationsFile">
                                   
                                     <?php
                                              if($videoInfo != NULL )
                                            echo substr($videoInfo->video_name, 0, 30).'...';
                                              else
                                                  echo "Unamed Video";
                                        ?>
                                </div>
                            </div>
                           <?php } ?> 
                            
                            
                        </div>
                    </div>
                    
                </div>
        </section>
     
        <!-- --------------------------------------------------------------- -->
        <!-- ---------------------      Footer      ------------------------ -->
        <!-- --------------------------------------------------------------- -->
        
 
    <script src="js/jquery-1.12.4_1.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.raty.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
             $('[data-toggle="tooltip"]').tooltip();
             
           // color: #555;
           
           window.load_video_groups = function (_THIS) {
               var attributs = $(_THIS).attr('data-load-target');
                 $.ajax({
                        url  : 'controller/controller_video_groups.php' , 
                        data :{'GroupType':attributs} ,
                        type : 'post' ,
                        beforeSend : function(){
                             $('.containerListType').html('<div id="circularG"><div id="circularG_1" class="circularG"></div><div id="circularG_2" class="circularG"></div><div id="circularG_3" class="circularG"></div><div id="circularG_4" class="circularG"></div><div id="circularG_5" class="circularG"></div><div id="circularG_6" class="circularG"></div><div id="circularG_7" class="circularG"></div><div id="circularG_8" class="circularG"></div> </div>  ');
                         }, 
                        success :function (responsedData) {
                            $('.containerListType').html(responsedData);
                        } 
                        }); 
           }
            $('.vid-rating').click(function () {
                
            });
            $('#innVideoRate').raty({
                        starOn:    'images/video_on.png',   
                        starOff:   'images/video_off.png' ,
                        click: function(score, evt) {
                        var dataSting = {
                        'score':score , 
                        'typeOfEvaluate' : 2 ,  // Video
                        'postId' : $(this).attr('song-id') ,
                        'appType' : 1   , 
                        'videoGroup':$(this).attr('video-type') 
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
             
             
           //
             
             
         
          $(window).scroll(function (){
              var topSc = $(this).scrollTop();
             if(topSc > 70)
                 {
                   $('#header').addClass('animated slideInDown navbar-fixed-top');
                 }else {
                     $('#header').removeClass('animated slideInDown navbar-fixed-top');
                  }
          });
        });
    </script>
    </body>
</html>

