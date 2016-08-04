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
    
      ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
         <link rel="stylesheet" type="text/css" href="css/component.css" />
         <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.0/animate.min.css">
	 <script src="js/modernizr.custom.js"></script>
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
              
              <section class="container-fluid dev">
            <div class="row">
                <div class="col-xs-12 col-md-4">
                     <!-- Jury of peers -->
                     <b class="headline-jury headline-setelement" style="background-image: url(img_sliders/constitutional_2.png); padding-left: 30px; background-repeat: no-repeat;background-position: 5px 4px; background-size: 20px 20px; ">
                        Jury of peers
                     </b>
                     <div class="jurylist">
                         <div class="jury-box">
                             <div style="background-image: url(images/jury_1.jpg);" class="jury-profile">
                                 <div class="mask-jp">
                                     <i style="background-image: url(img_sliders/constitutional_2.png);float: left;" class="disputs dis"></i>
                                     <!--   <i class="fa fa-comments" aria-hidden="true" style="float: right; font-size: 20px; margin-right: 20px; margin-top: 8px;color: #ead5ad;" class="disputs dis">
                                      <i class="" aria-hidden="true" style="float: right; font-size: 14px; margin-right: 20px; margin-top: 8px;color: #fff;" class="disputs dis">10</i>
                                     </i>
                                      -->
                                 </div>
                             </div>
                         </div>
                        <div class="jury-box">
                            <div style="background-image: url(images/jury_2.jpg);" class="jury-profile">
                                <div class="mask-jp">
                                     <i style="background-image: url(img_sliders/constitutional_2.png)" class="disputs dis"></i>
                                 </div>
                            </div>
                         </div>
                         <div class="jury-box">
                             <div style="background-image: url(images/jury_3.jpg);" class="jury-profile">
                                 <div class="mask-jp">
                                     <i style="background-image: url(img_sliders/constitutional_2.png)" class="disputs dis"></i>
                                 </div>
                             </div>
                         </div>
                         <div class="jury-box">
                            <div style="background-image: url(images/jury_4.jpg);" class="jury-profile">
                                <div class="mask-jp">
                                     <i style="background-image: url(img_sliders/constitutional_2.png)" class="disputs dis"></i>
                                 </div>
                            </div>
                         </div>
                         <div class="jury-box">
                            <div style="background-image: url(images/jury_5.jpg);" class="jury-profile">
                                <div class="mask-jp">
                                     <i style="background-image: url(img_sliders/constitutional_2.png)" class="disputs dis"></i>
                                 </div>
                            </div>
                         </div>
                     </div>
                     <!-- pln inv and courtroom setting -->
                     <div class="courtroom-setting">
                         <b class="headline-setelement">Settlement Request</b>
                         <div class="container-of-setelement">
                             <div class="setllme text-center">  Plaintiff <br /> Concert Tickets</div>
                             <div class="setImg">
                                 <img src="images/jury_svg.png" class="img-responsive" />
                             </div>
                              <div class="setllme text-center">  Defendant  <br /> PS4 Game</div>
                          </div>
                     </div>
                     <div class="courtroom-setting">
                         <b class="headline-setelement">Stats</b>
                         <div class="container-of-setelement">
                              <table class="table">
                                  <tr>
                                      <td>
                                          <b style="color: #555">Credibility</b>
                                      </td>
                                      <td>95%</td>
                                      <td style="border-left: 1px solid #dfdfdf;">
                                          <b style="color: #555">Sets Heard</b>
                                      </td>
                                      <td>100%</td>
                                  </tr>
                                  <tr>
                                      <td>
                                          <b style="color: #555">Cases Heards </b>
                                      </td>
                                      <td>42</td>
                                      <td style="border-left: 1px solid #dfdfdf;">
                                          <b style="color: #555">Wins </b>
                                      </td>
                                      <td>50</td>
                                  </tr>
                                  <tr>
                                      <td>
                                          <b style="color: #555">Score</b>
                                      </td>
                                      <td>5154</td>
                                      <td style="border-left: 1px solid #dfdfdf;">
                                          <b style="color: #555">Lost</b>
                                      </td>
                                      <td>2</td>
                                  </tr>
                              </table>
                         </div>
                     </div>
                     <div class="courtroom-setting">
                         <b class="headline-setelement">Time Estimated for this courtroom</b>
                         <div class="container-of-setelement">
                             <table class="table">
                                 <tr>
                                     <td>Time Estimated</td>
                                     <td>:- 3 days and 15 hours</td>
                                 </tr>
                                 <tr>
                                     <td>Time Left</td>
                                     <td>:- 22 Hours</td>
                                 </tr>
                             </table>
                          </div>
                     </div>
                     
                </div>
                <div class="col-xs-12 col-md-6 profile-content">
                    <!-- Block of profile cover -->
                    <div class="eviden">
                        <b class="headlineviden">
                            <i style="font-size: 25px; color: #222;" class="fa fa-paperclip" aria-hidden="true"></i>
                            <b style="padding: 5px;">Evidence</b>
                        </b>
                     </div>
                     <div class="main-comments text-center">
                            <h1>
                                Record Area
                            </h1>
                     </div>
                 </div>
                <div class="col-xs-12 col-md-2">
			 
                    <a style="border-radius: 0px;" id="demo01" href="#animatedModal" class="btn btn-primary">Invite your friends</a>
                      
			 <div class="courtroom-setting">
                         <b class="headline-setelement ">Plaintiff Invitations</b>
                         <div class="invitPersons">
                             <div style="background-image: url(images/jury_4.jpg);" class="img-invi"></div>
                             <b class="mmk">
                                 Hlie Patriza
                             </b>
                         </div>
                         <div class="invitPersons">
                             <div style="background-image: url(images/jury_1.jpg);" class="img-invi"></div>
                             <b class="mmk">
                                 Hiamar Jafarie
                             </b>
                         </div>
                         <div class="invitPersons">
                             <div style="background-image: url(images/jury_2.jpg);" class="img-invi"></div>
                             <b class="mmk">
                                 Patrica patchok
                             </b>
                         </div>
                         <div class="invitPersons">
                             <div style="background-image: url(images/jury_5.jpg);" class="img-invi"></div>
                             <b class="mmk">
                                 Polia john
                             </b>
                         </div>
                          
                    </div>
                    
                        <div class="courtroom-setting">
                        <!--Call your modal-->
        
                         <b class="headline-setelement">Defendant invitations</b>
                         <div class="invitPersons">
                             <div style="background-image: url(images/jury_4.jpg);" class="img-invi"></div>
                             <b class="mmk">
                                 Hlie Patriza
                             </b>
                         </div>
                         <div class="invitPersons">
                             <div style="background-image: url(images/jury_1.jpg);" class="img-invi"></div>
                             <b class="mmk">
                                 Hiamar Jafarie
                             </b>
                         </div>
                         <div class="invitPersons">
                             <div style="background-image: url(images/jury_2.jpg);" class="img-invi"></div>
                             <b class="mmk">
                                 Patrica patchok
                             </b>
                         </div>
                         <div class="invitPersons">
                             <div style="background-image: url(images/jury_5.jpg);" class="img-invi"></div>
                             <b class="mmk">
                                 Polia john
                             </b>
                         </div>
                          
                    </div>
                </div> 
            </div>
        </section>
                
            <?php
        }
       ?>
        
        
        
         

        <!--DEMO01-->
        <div style="" id="animatedModal">
            
                <div class="modal-content">
                    <div class="all text-right">
                        <b style="float: left;"> Invite your friend </b>
                        <b class="close-animatedModal stc">
                            <i class="fa fa-remove"></i>
                            Close
                        </b>
                    </div>
                    <div class="mediaIc">
                        <!-- Socila networks -->
                        <div class="socialNET">
                            <div class="icons">
                                <i class="fa fa-facebook-f"></i>
                                 Facebook
                            </div>
                            <div class="icons">
                                <i class="fa fa-twitter"></i>
                                 Twitter
                            </div>
                            <div class="icons">
                                <i class="fa fa-google-plus"></i>
                                 Google
                            </div>
                            
                            <div class="icons">
                                <i class="fa fa-yahoo"></i>
                                 Yahoo
                            </div>
                            
                            <div class="icons">
                                <i class="fa fa-mail-forward"></i>
                                 Hotmail
                            </div>
                            
                        </div>
                          <div class="frdfrd">
                              <div class="frd-inv-container">
                                  <div class="containerMore">
                                       
                                  <?php
                                  $lastId = 0  ;
                                  
                                    $pagination_inffrd = new user_get_more_pagination_package();
                                   $invitFromMyFrd =  $pagination_inffrd->user_friend_invite(0, 5 ,$_SESSION['user_info']['user_id']);
                                   for ($i=0; $i < count($invitFromMyFrd); $i++)
                                   {
                                       
                                       if($invitFromMyFrd[$i]->id_sender != $_SESSION['user_info']['user_id'] )
                                           $InUser_id = $invitFromMyFrd[$i]->id_sender  ;
                                       else if($invitFromMyFrd[$i]->id_receiver != $_SESSION['user_info']['user_id'] )
                                           $InUser_id = $invitFromMyFrd[$i]->id_receiver  ;
                                       
                                       $userAp = new user_applications();
                                       $userInfo = $userAp->user_application_check_exist(['id'=>$InUser_id]);
                                       
                                       $courtroomInvitApis = new courtroom_invitation_applications();
                                       $invtd = $courtroomInvitApis->courtroom_invitations_check_exist(['user_id'=>$InUser_id]);
                                       if($invtd == NULL )
                                       {
                                          ?>
                                            <div class="all">
                                               <b class="name"><?php echo $userInfo->f_name .' ' . $userInfo->s_name ; ; ?></b>
                                               <span onclick="inviteMyFrd(<?php echo $userInfo->id ; ?> , '<?php echo $_GET['code'] ; ?>' , this);" class="btns">Invite</span>
                                             </div>
                                         <?php  
                                       }else {
                                           ?>
                                            <div class="all">
                                               <b class="name"><?php echo $userInfo->f_name .' ' . $userInfo->s_name ; ; ?></b>
                                               <span style="background : none ; color :#999 ;font-weight:bold ;  " class="btns">Invitation Sent !</span>
                                             </div>
                                         <?php  
                                       }
                                       
                                      $lastId = $invitFromMyFrd[$i]->id ;
                                      ?>
                                          <input class="lastId" type="hidden" value="<?php echo $lastId ; ?>" />
                                          <?php
                                   }
                                  ?>
                                 
                                  </div>
                                <div onclick="load_more_invitation_result( <?php echo $lastId ; ?> ,'<?php echo $_GET['code'] ; ?>'  , this);" style="" class="all text-center loadBtn">
                                 <b style="padding: 6px 10px 8px 5px;display: block; color: ">Load more</b>
                               </div>
                              </div>
                           </div> 
                         <div class="frdfrd">
                              
                          </div> 
                    </div>      
                   
                </div>
        </div>
        
        <?php
         
            // here if this court room accpeted
        ?>
             
    <div class="md-overlay"></div><!-- the overlay element -->         
    <script src="js/jquery-1.12.4_1.js"></script>
    <!-- classie.js by @desandro: https://github.com/desandro/classie -->
    <script src="js/classie.js"></script>
    <script src="js/modalEffects.js"></script>
    <!-- for the blur effect -->
    <!-- by @derSchepp https://github.com/Schepp/CSS-Filters-Polyfill -->
    <script>
    // this is important for IEs
    var polyfilter_scriptpath = '/js/';
    </script>
    <script src="js/cssParser.js"></script>
    <script src="js/css-filters-polyfill.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
    <script src="js/animatedModal.min.js" type="text/javascript"></script>
    <script src="js/courtroom_app.js" type="text/javascript"></script>
     
    </body>
</html>