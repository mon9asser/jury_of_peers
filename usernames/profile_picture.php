<!--
    Web designed by : Montasser Mossallem
    skype Name : moun2030
    up_work : url->  http://www.upwork.com/o/profiles/users/_~01943d20d212eecc03
-->
<?php

$files = dirname(__FILE__)."/../modular/autoload_apps.php";
if(is_file($files)) require_once $files ;
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
          <link href="../css/simple-slider.css" rel="stylesheet" type="text/css" />
         <link href="../css/simple-slider-volume.css" rel="stylesheet" type="text/css" />  
         <link href="../css/profile.css" rel="stylesheet">
         <link href="../css/complete.css" rel="stylesheet">
         
         
         <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
         <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
         <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
         <![endif]-->
    </head>
    <body>
        
        
        
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
                        <h1 class="compl-headline">
                           Upload profile picture
                        </h1>                        
                    </div>
                    <div class="post-controls profimge">
                        <div style="background-image: url(photo_albums/profile_picture/female_avatar.jpg);" id="img-settings" class="img-settings default">
                            
                            <!-- after completed -->
                            
                            <div class="slideResize">
                                <span class="title-zoom">
                                    Zooming : 
                                </span>
                                <div id="zooming-image" data-slider-highlight="true" data-slider-step="0.1" data-slider="true" class=""></div>
                            </div>
                           
                            
                            <!-- in-progress -->
                            <!-- 
                            <div style="background: rgba(250,250,250,.9);" class="mask-image">
                                <div class="fill-progress-ppic text-center">
                                <b>Please wait while progress complete...</b>
                                <div class="progress-filler">
                                    <div class="color-fill"></div>
                                </div>
                            </div>
                            </div>
                            -->
                         </div>
                       <!-- img profile here -->
                    </div> 
                    <input id="uploader" type="file" name="profile_pics" />
                    <div class="control-btn">
                        <button id="saveThenNext">Save & Next</button>
                        <button id="skip">Skip </button>
                    </div>
                </div>
                
                
                 
                
                
            </div>
        </section>
        
        
     <script src="../js/jquery-1.12.4_1.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/simple-slider.min.js"></script>
     <script type="text/javascript">
        $(document).ready(function(){
            
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
          
        
        
          
        // upload image 
        $("#uploader").change(function (){
              readURL(this);
           //inprogress file 
           var file = document.getElementById('uploader').files[0];
           
           var formdata = new FormData();
           
           
            var highlight_track = $('.highlight-track').width()  ;
            var main_track =  $('.slider').width() ;
            var  zoomResult = Math.round ( (highlight_track *  100 ) / main_track  ) ;
            var mainWidthHieghtBg =  $('#img-settings').css('background-size');
            var position_y_x =  $('#img-settings').css('background-position');
                
            formdata.append("photo_w_h", mainWidthHieghtBg);
             formdata.append("position_y_x", position_y_x);
             
            
            
           formdata.append("profile_picture", file);
           formdata.append("proccessType","ADD_ALBUM_PROFILE_PICTURE");
           var ajax = new XMLHttpRequest();
            // inprogress bar 
               ajax.upload.addEventListener("progress", function (event){
                 $('#img-settings').append('<div style="background: rgba(250,250,250,.9);" class="mask-image"><div class="fill-progress-ppic text-center"><b>Please wait while progress complete...</b><div class="progress-filler"><div class="color-fill"></div></div></div></div>');
                   var percent = (event.loaded / event.total) * 100;
                   $('.color-fill').css('width',Math.round(percent)+"%");
                } , false);
              ajax.addEventListener("load", function (event){ 
                 
                   if($.trim(event.target.responseText) == 1 )
                      { 
                          // alert($.trim(event.target.responseText));
                        $('.mask-image').css('display','none');
                        $('.slideResize').css('display','block');
                       }else {
                           $('.mask-image').html("<span class='errorDisplayed'>There are an errors in uploading , please try again</span>");
                       }
                      
              }, false); 
              
              ajax.open("POST", "../controller/controller_profile_picture.php");
              ajax.send(formdata);
              
              
        });
        
      
       
         
        // preview image. 
        window.readURL = function (input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                     reader.onload = function (e) {
                          $('.img-settings').css({
                              'background-image':'url('+e.target.result+')'   
                          });
                     }
                     reader.readAsDataURL(input.files[0]);
                }
            }
            
            
          
             $("#zooming-image").bind("slider:ready slider:changed", function (event, data){
                 var main_track =  $('.slider').width() ;
                var highlight_track = $('.highlight-track').width()  ;
                var  zoomResult = Math.round ( (highlight_track *  100 ) / main_track  ) ;
                var fix = zoomResult+100 ;
                $('.img-settings').css('background-size',fix+'% '+fix+'%');
                 $('.img-settings').css('background-position','50% 50%');
                
                
                 
              } );  
            
          
          
            $('#saveThenNext').click(function (){
                   var mainWidthHieghtBg =  $('#img-settings').css('background-size');
                  var position_y_x =  $('#img-settings').css('background-position');
                   $.ajax({
                     url : "../controller/controller_profile_picture.php" , 
                     type : "post" , 
                     data : {
                        'photo_w_h':mainWidthHieghtBg,
                        'position_y_x':position_y_x , 
                        'proccessType':'UPDATE_IMAGE_RESOUTION'
                     },
                     success : function (response){
                         if($.trim(response) == 1){
                             window.location.href = "add_friends.php"
                         }
                     }
                 }); 
            });
             $('#skip').click(function (){
                window.location.href = "add_friends.php" ;
             });
            
        });
        
        
        
         
       
    </script>
    </body>
</html>