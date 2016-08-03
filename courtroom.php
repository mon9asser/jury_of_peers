<?php
 
  $file = dirname(__FILE__)."/access_modifiers/protected_access.php";
  if(is_file($file)) require_once $file  ;
 
   $files = dirname(__FILE__)."/modular/autoload_apps.php";
  if(is_file($files)) require_once $files  ;

    if(!isset($_GET['code']))  
    {
        header('location: home');
        exit(1);
    }
?>
 <?php
        
            // here will be accept or declline request 
            $courInitApis = new courtroom_init_applications();
            $userApis = new user_applications();
            
            
            $crtExist = $courInitApis->courtroom_init_check_exist([
                'courtroom_code'=>trim($_GET['code'])
            ]);
            
            if($crtExist == NULL )
                {
                    header('location: undefine');
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
         <link href="css/profile.css" rel="stylesheet">
         <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css"/>
         <!-- Add the slick-theme.css if you want default styling -->
         <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick-theme.css"/>
         <link href="css/courtrom.css" rel="stylesheet">
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
        <!-- 
        <div class="mask-layer"></div>
        -->
        <!-- --------------------------------------- -->
        <!-- ------      Header      --------------- -->
        <!-- --------------------------------------- -->
        <?php 
        $headerFile = dirname(__FILE__)."/includes/header.php";
        if(is_file($headerFile ))  require_once $headerFile ;
        

        ?>
        
       <?php
        if($crtExist->is_accepted != 1 )
        {
              ?>
             
               <div class="accPanel">
            <div class="mainTitle">
                <span class="span">
                   <?php echo $crtExist->court_title ?>
                </span>
                 <?php
                    if($_SESSION['user_info']['user_id'] == $crtExist->defedant_id)
                        { ?> <span onclick="deleteRequest(<?php echo $crtExist->id ; ?>,this)" class="btntt btn2">Decline This Dispute</span> <?php }else if($_SESSION['user_info']['user_id'] == $crtExist->plaintiff_id){
                       ?> <span onclick="deleteRequest(<?php echo $crtExist->id ; ?>,this)" class="btntt btn2">Cancel this dispute</span> <?php 
                    }
                 ?>
                
             </div>
             <div style="border-left: 0px;" class="courPersons">
                <div class="title-court text-center">
                    <b>Defendant</b>
                </div>
                <div class="contents">
                    <div class="img-pics img-thumbnail img-circle" style="height:80px; width: 80px; margin: 10px; float: left ;  background-image: url(photo_albums/profile_picture/579f2409b9635_ssssss.jpg)"></div>
                    <div class="dfsdde">
                        <?php
                            $userExist = $userApis->user_application_check_exist(['id'=>$crtExist->defedant_id]);
                            echo $userExist->f_name ." ". $userExist->s_name ;
                        ?>
                        <br />
                        <?php
                           echo "Username :- ".$userExist->u_name ;
                        ?>
                    </div>
                </div>
                <div class="contents vvvv">
                    <b>Settlement Request</b>
                    
                    
                    
                  <?php
                       if($_SESSION['user_info']['user_id'] == $crtExist->defedant_id)
                       { ?>
                        <p>
                            <textarea id="dfnSele" style="margin: 10px auto; display: inline-block; " rows="6" cols="60"></textarea>
                      </p>
                      <div style="background-position: 4% 47%;padding-left: 41px;" class="mainTitle">
                          <span class="span">
                            I am agree to start
                          </span>
                          <span onclick="acceptRequest(<?php echo $crtExist->id ; ?>,this)" class="btntt btn1">Accept</span>
                      </div>
                        
                
                         <?php }else if($_SESSION['user_info']['user_id'] == $crtExist->plaintiff_id){
                          ?> 
                     <div style="background-image:none;padding-left: 41px;" class="mainTitle">
                          Pending Request
                      </div>     
                          
                         <?php 
                       }
                    ?>
                      
                      
                </div>
            </div>
            <div  class="courPersons">
                 <div class="title-court text-center">
                     <b>Plaintiff</b> 
                  </div>
                <div class="contents">
                    <div class="img-pics img-thumbnail img-circle" style="height:80px; width: 80px; margin: 10px; float: left ;  background-image: url(photo_albums/profile_picture/579f2409b9635_ssssss.jpg)"></div>
                    <div class="dfsdde">
                          <?php
                            $userExist = $userApis->user_application_check_exist(['id'=>$crtExist->plaintiff_id]);
                            echo $userExist->f_name ." ". $userExist->s_name ;
                        ?>
                        <br />
                        <?php
                           echo "Username :- ".$userExist->u_name ;
                        ?>
                    </div>
                </div>
                <div class="contents vvvv">
                     <b>Settlement Request</b>
                     <p>
                        <?php 
                            echo $crtExist->setlment_plnf ;
                        ?>
                     </p>
                </div>
                
                <div class="contents vvvv">
                     <b>Time Estimated</b>
                     <p>
                         <?php 
                            echo $crtExist->time_estimated . " Days from Accepting this dispute" ;
                         ?>
                     </p>
                </div>
                
                <div class="contents vvvv">
                     <b>Dispute will be in this status</b>
                     <p>
                        <?php 
                         
                            $postApis = new user_posts_applications();
                            $postinPagin = $postApis->user_posts_check_exist(['id'=>$crtExist->post_id]);
                            $textApis = new user_texts_applications();
                             $txt =  $textApis->user_texts_applications_check_exist(['id'=>$postinPagin->post_text_id]);
                             echo $txt->post_text ;
                         ?>
                         <?php
                                
                        // print_r($postinPagin);
                          ?>
                     </p>
                </div>
            </div>
        </div>
                
            <?php
        }else {
            ?>
             <div class="mask-layer"></div>
                
                
                
            <?php
        }
       ?>
        
        
        
        
        
        <?php
         
            // here if this court room accpeted
        ?>
             
             
          <script src="js/jquery-1.12.4_1.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
    <script src="js/courtroom_app.js" type="text/javascript"></script>
    </body>
</html>