<?php
 
  $fileProtection = dirname(__FILE__)."/access_modifiers/protected_access.php";
  if(is_file($fileProtection)) require_once $fileProtection  ;
 
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
         <link href="css/profile.css" rel="stylesheet">
         <link href="scss/loadincss.css" rel="stylesheet">
         <link href="css/msg.css" rel="stylesheet">
         <link href="css/emu.css" rel="stylesheet">
          <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
         <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
         <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
         <![endif]-->
         </head>
    <body>
        
        <!-- --------------------------------------------------------------- -->
        <!-- ---------------------      background   ----------------------- -->
        <!-- --------------------------------------------------------------- -->
        <?php
             $file = dirname(__FILE__)."/modular/autoload_apps.php";
            if(is_file($file )) require_once $file ;  
        ?>
        
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
        <div class="message-contents">
             
            <div class="message-names">
                 <div class="name-container scroll-msgs">
                     <?php
                    $userId = $_SESSION['user_info']['user_id'];
                        $converApis = new conversation_applications();
                       $userConver =  $converApis->conversation_apis_get_all("WHERE `user_one` = {$userId} OR `user_two` = {$userId} ");
                        for ($i=0; $i<count($userConver);$i++){
                            $otherId= 0;
                            if($userId != $userConver[$i]->user_one)
                                $otherId = $userConver[$i]->user_one ;
                            else 
                                $otherId = $userConver[$i]->user_two ;
                            
                            $userApp = new user_applications();
                            $userInfo = $userApp->user_application_check_exist(['id'=>$otherId]);
                            ?>
                                <!-- Message names -->
                                <div style="cursor: pointer;" onclick="load_this_conver(<?php echo $userInfo->id; ?>, <?php echo $userConver[$i]->id ; ?>)" class="names-msg" >
                                    <table>
                                        <tr>
                                            <td>
                                                <div style="background-image: url(photo_albums/profile_picture/<?php echo get_profile_picture($otherId); ?>);" class="img-msg-data"></div>
                                             </td>
                                            <td>
                                                  <div class="username-info">
                                                   <b><?php echo $userInfo->f_name.' '.$userInfo->s_name ;?></b>
                                                   <div class="clearFix"></div>
                                                   <font>
                                                   <?php
                                                        $appl = new apps();
                                                        echo $appl ->time_elapsed_string($userConver[$i]->timestamps);
                                                   ?>
                                                   </font>
                                                  </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                           <?php
                        }
                    ?>
                    
                    <div class="loadMore">
                        <center>
                            <b>Load more</b>
                        </center>
                    </div>
               </div>
            </div>
            <div class="message-content-data">
                 <!-- Headtitle -->
                 <!--
                <div class="headtitls-msg">
                    <h3>
                        <div class="hertz"> Julian Magnon </div>
                        <div style="cursor: pointer;" class="online rtl" data-toggle="tooltip" data-placement="right" title="Online"></div>
                     </h3>
                    <font>
                         <font> England </font>
                     </font>
                </div>
                 -->
                <div class="dfdfdfdfdfdfe"></div>
                <div class="writ-messages"> 
                    <textarea id="messageText" placeholder="Write your Message then hit enter" class="msg-box" ></textarea>
                 </div>
            </div>
            <div class="user-informations"></div>
        </div>
     
        <!-- --------------------------------------------------------------- -->
        <!-- ---------------------      Footer      ------------------------ -->
        <!-- --------------------------------------------------------------- -->
        
 
    <script src="js/jquery-1.12.4_1.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/nice_scrollbar.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            window.load_this_conver = function (userId,conversation_id){
                     // alert(evedenc + courtCode);
                     $.ajax({
                        url : 'controller/controller_message_body_load.php' ,
                        type : 'post' , 
                        data : {'userId':userId} ,
                        beforeSend : function (){
                         },
                        success : function (response){
                            $('.dfdfdfdfdfdfe').html(response);
                            $('#messageText').attr('user-id',userId);
                            $('#messageText').attr('conversation_id',conversation_id);
                        }
                        
                    });
             }
            $('#messageText').keydown(function(e){
                if(e.keyCode == 13) {
                    var textMsg = $(this).val();
                   var userId = $(this).attr('user-id');
                   var conversation_id = $(this).attr('conversation_id');
                   $.ajax({
                        url : 'controller/controller_send_msg.php' ,
                        type : 'post' , 
                        data : {'userId':userId,'textMsg':textMsg,'conversation_id':conversation_id} ,
                        beforeSend : function (){
                         },
                        success : function (response){
                            $('.dfdfdfdfdfdfe').html(response);
                            $('#messageText').attr('user-id',userId);
                            console.log(response);  
                            if($.trim(response) == 1)
                                {
                                    load_this_conver   (userId,$('#messageText').attr('conversation_id'));
                                    $('#messageText').val(null);
                                }
                        }
                        
                    });
                   return false ;
                }
            });
            
             $('[data-toggle="tooltip"]').tooltip(); 
          $(".scroll-msgs").niceScroll({
              cursorwidth: "6px",
              cursorborder:'0px',
              cursorborderradius:'0px',
              cursorcolor:"#dfdfdf"
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
        });
    </script>
    </body>
</html>
