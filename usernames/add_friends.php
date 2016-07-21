<?php
ob_start() ;
if(session_id()=='')
session_start () ;

$files = dirname(__FILE__)."/../modular/autoload_apps.php";
if(is_file($files)) require_once $files ;
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
                        <h2 class="compl-headline">
                           Add friends in your Location    
                        </h2>                        
                    </div>
                    <div class="friend-addbox">
                        <!-- friend block system -->
                        <div class="block-of-users">
                            <!-- all user frd -->
                            
                          <?php
                             
                             
                             $user_apis = new user_get_more_pagination_package();
                             $users = $user_apis->user_add_new_friend_get_more_by_values( 0 , 8 , $_SESSION['user_info']['user_id']  ) ;
                             $lastId = 0 ;
                             if(count($users ) > 1 )
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
                                 //  print_r( $ppExists);
                                   if(count ($ppExists )!= 0)  
                                    {
                                       
                                       
                                       
                                       
                                       
                                       
                                                $profilePic__source = "../".$users[$i]->u_name ."/photo_albums/profile_picture/".$ppExists[count($ppExists)-1]->photo_src;
                                        if (is_file($profilePic__source ))
                                            {
                                                $profilePicSrc = $profilePic__source  ;
                                                  $imgSize = $ppExists[count($ppExists)-1]->photo_w_h;
                                                  $imgPosition = $ppExists[count($ppExists)-1]->position_y_x;
                                            }
                                             
                                            else 
                                                {
                                               
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
                                    ?> 
                            
                            
                            
                            
                                    
                            
                            
                                    <?php
                                            
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
                                         <div style="background-image:url('<?php echo $profilePicSrc ;?>'); background-size: <?php echo $imgSize ; ?> ; background-position: <?php echo $imgPosition  ; ?>   ;" class="image-block"></div>
                                          <div class="frdinfo-block">
                                              <h3><?php echo ucfirst($users[$i]->f_name)." ".ucfirst($users[$i]->s_name); ?></h3>
                                              <span><?php echo $user_setting ;?></span>
                                              <div class="add-msg-controller">
                                                   <a class="btncontacts frdadd" onclick="return addThisUser(<?php echo $users[$i]->id ;?>,this);">
                                                      <i class="fa fa fa-plus-circle fa-frd"></i>
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
                         
                       
                        
                        <!-- block to loading more -->
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
                
                // load more results
                $('#load-more-boxs').click(function (){
                    var lastId =  $('.friend-block:last-child').attr('last-id')  ;
                 
                    if($('.friend-block').length == 0 )  
                          lastId = $('#load-more-boxs').attr('last-id');
                    
                      
                  // alert(lastId);
                   $.ajax({
                       url: "../controller/controller_load_more_add_friend.php" , 
                       data : {'last-id':lastId} , 
                       type :'post' ,
                       beforeSend : function (){
                             $('#load-more-boxs').html('<div id="circularG"><div id="circularG_1" class="circularG"></div><div id="circularG_2" class="circularG"></div><div id="circularG_3" class="circularG"></div><div id="circularG_4" class="circularG"></div><div id="circularG_5" class="circularG"></div><div id="circularG_6" class="circularG"></div><div id="circularG_7" class="circularG"></div><div id="circularG_8" class="circularG"></div> </div>  ');
                       } ,
                       success : function (resp){
                            $('#load-more-boxs').html('Load More');
                           var result = $.trim(resp) ;
                           if(result == 1)
                               {
                                  $('#load-more-boxs').html('There are no results..');
                               }else 
                                $('.block-of-users').append(resp);
                       }
                   });
                });
              // add new friend
              window.addThisUser = function (id , elem){
                  var userId = id  ;
                  var parentOfcurrElement = $(elem).parent('.add-msg-controller').parent('.frdinfo-block').parent('.friend-block');
                    // parentOfcurrElement.fadeOut() ;
                    $.ajax({
                      url: "../controller/controller_add_friend.php" , 
                        type : "post" ,
                        data : {'userId':$.trim(userId) , 'proccessType':"add_to_mylist"} , 
                        beforeSend : function (){ 
                            $(elem).html ('<div id="floatingCirclesG"><div class="f_circleG" id="frotateG_01"></div><div class="f_circleG" id="frotateG_02"></div><div class="f_circleG" id="frotateG_03"></div><div class="f_circleG" id="frotateG_04"></div><div class="f_circleG" id="frotateG_05"></div><div class="f_circleG" id="frotateG_06"></div><div class="f_circleG" id="frotateG_07"></div><div class="f_circleG" id="frotateG_08"></div></div>Sending request');
                        },
                        success : function (result){
                           
                            var res =  $.trim(result);
                            if(res == 1 ) //<i class="fa fa fa-plus-circle fa-frd"></i>
                                { 
                                    $(elem).html('Friend request sent');
                                    $(elem).css({
                                        'background' : 'teal' ,
                                        'border' : '1px solid teal'
                                    });
                                     
                                     
                                    parentOfcurrElement.addClass('animated rotateOutUpLeft') ;
                                    setTimeout(function (){
                                        parentOfcurrElement.remove() ;    
                                    } , 1000) ; 
                                   
                                }else if (res ==  2 ) {
                                     $(elem).html('you already sent request');
                                      
                                     
                                }
                        }
                    });
              }
              
              
              
              
              
              
              
              
              
               // Block this User
              window.blockThisUser = function (id , elem){
                  var userId = id  ;
                  var parentOfcurrElement = $(elem).parent('.add-msg-controller').parent('.frdinfo-block').parent('.friend-block');
                    // parentOfcurrElement.fadeOut() ;
                    $.ajax({
                      url: "../controller/controller_block_friend.php" , 
                        type : "post" ,
                        data : {'userId':$.trim(userId) , 'proccessType':"block_from_mylist"} , 
                        beforeSend : function (){ 
                            $(elem).html ('<div id="floatingCirclesG"><div class="f_circleG" id="frotateG_01"></div><div class="f_circleG" id="frotateG_02"></div><div class="f_circleG" id="frotateG_03"></div><div class="f_circleG" id="frotateG_04"></div><div class="f_circleG" id="frotateG_05"></div><div class="f_circleG" id="frotateG_06"></div><div class="f_circleG" id="frotateG_07"></div><div class="f_circleG" id="frotateG_08"></div></div>Blocking this user');
                        },
                        success : function (result){
                           
                            var res =  $.trim(result);
                            if(res == 1 ) //<i class="fa fa fa-plus-circle fa-frd"></i>
                                { 
                                    $(elem).html('Block is done');
                                    $(elem).css({
                                        'background' : 'teal' ,
                                        'border' : '1px solid teal'
                                    });
                                     
                                     
                                    parentOfcurrElement.addClass('animated rotateOutDownRight') ;
                                    setTimeout(function (){
                                        parentOfcurrElement.remove() ;    
                                    } , 1000) ; 
                                   
                                }else if (res ==  2 ) {
                                     $(elem).html('you already Block thid user');
                                      
                                     
                                }
                        }
                    });
              }
        });
        
        
         
       
    </script>
    </body>
</html>