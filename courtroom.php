<?php
 
  $fileProtection = dirname(__FILE__)."/access_modifiers/protected_access.php";
  if(is_file($fileProtection)) require_once $fileProtection  ;
 
  
  $file  = dirname(__FILE__)."/modular/autoload_apps.php";
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
                
                
                
                    $intCrtApis = new courtroom_init_applications() ;
                    $intCrt = $intCrtApis->courtroom_init_check_exist(['courtroom_code'=>trim($_GET['code'])]);
                    $apps = new apps();
                       $timeEstimated = $intCrt->time_estimated;
                       $timeStampsCurrent = time() ;
                       $timeEstimatedTimestamps = $intCrt->time_estimated * 24 * 60 * 60 ;
                       $StartedFromTimeStamps =  $intCrt->timestamps ;
                        
                       $timeLeft = ($timeStampsCurrent <= ($StartedFromTimeStamps + $timeEstimatedTimestamps ) ) ? $apps->time_elapsed_string($StartedFromTimeStamps):'Completed'  ;
                   if( $timeLeft == 'Completed')    
                    {
                       $winApis = new courtroom_winned_applications();
                       // register winner 
                        $WinnerExist = $winApis->courtroom_winnedt_check_exist(['courtroom_code'=>$_GET['code']])     ; 
                       if($WinnerExist == NULL )
                       {
                           $courtInitApis = new courtroom_init_applications();
                           $courtVoteApis = new courtroom_votes_applications();
                           
                           $courtInit = $courtInitApis->courtroom_init_check_exist(['courtroom_code'=>trim($_GET['code'])]);
                           $plnId = $courtInit->plaintiff_id ;
                           $dfnId = $courtInit->defedant_id ;
                           
                           $VoteSuccessDfn = $courtVoteApis->courtroom_votes_get_by_values(['courtroom_code'=>trim($_GET['code']),'for_pln_dfn_id'=>$dfnId,'likes_dislikes'=>1],'and');
                           $VoteSuccessPln = $courtVoteApis->courtroom_votes_get_by_values(['courtroom_code'=>trim($_GET['code']),'for_pln_dfn_id'=>$plnId,'likes_dislikes'=>1],'and');
                           $winner_id = NULL ;
                           $lost_id = NULL ;
                           if(count($VoteSuccessDfn)  >  count($VoteSuccessPln))
                            {
                               $winner_id = $dfnId ;
                                $lost_id = $plnId ;
                            }else if (count($VoteSuccessDfn)  <  count($VoteSuccessPln)) {
                               $winner_id = $plnId  ;
                                $lost_id = $dfnId;
                            }
                            if($winner_id != NULL ){
                                
                                //winner
                                $winApis->courtroom_winnedt_add_new_field(['courtroom_code'=>trim($_GET['code']),'winned_id'=>$winner_id,'is_winner'=>1,'timestamps'=>  time()]);
                                // lost
                                $winApis->courtroom_winnedt_add_new_field(['courtroom_code'=>trim($_GET['code']),'winned_id'=>$lost_id,'is_winner'=>0,'timestamps'=>  time()]);
                                // close this court room 
                                $intCrtApis->courtroom_init_update_fields([
                                    'courtroom_code'=>$_GET['code'] 
                                ],[
                                    'is_finished'=>1
                                ]);
                           }
                           
                       }
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
         <link href="css/emu.css" rel="stylesheet">
         <script src='http://connect.facebook.net/en_US/all.js'></script>
            <script>
             FB.init ({
              appId:'1643824655906734',
              cookie:true,
              status:true,
              xfbml:true
             });
             function FacebookInviteFriends () {
              FB.ui ({
               method: 'apprequests',
               message: 'Invite your friends'
              });
             }
            </script>
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
                    <div class="img-pics img-thumbnail img-circle" style="height:80px; width: 80px; margin: 10px; float: left ;  background-image: url(photo_albums/profile_picture/<?php echo checkProfileExists($crtExist->defedant_id);?>)"></div>
                    <div class="dfsdde">
                        <?php
                            $userExist = $userApis->user_application_check_exist(['id'=>$crtExist->defedant_id]);
                            echo $userExist->u_name ;
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
                            Begin Debate
                          </span>
                          <span onclick="acceptRequest(<?php echo $crtExist->id ; ?>,this)" class="btntt btn1">Accept</span>
                      </div>
                        
                
                         <?php }else if($_SESSION['user_info']['user_id'] == $crtExist->plaintiff_id){
                          ?> 
                     <div style="background-image:none;padding-left: 10px; color: navy; border :1px solid navy;margin-top: 10px;" class="mainTitle">
                         <i class="fa fa-warning"></i>
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
                <?php
                  $userExist = $userApis->user_application_check_exist(['id'=>$crtExist->plaintiff_id]);
                ?>
                <div class="contents">
                    <div class="img-pics img-thumbnail img-circle" style="height:80px; width: 80px; margin: 10px; float: left ;  background-image: url(photo_albums/profile_picture/<?php echo checkProfileExists($crtExist->plaintiff_id);?>)"></div>
                    <div class="dfsdde">
                          <?php
                          
                            echo $userExist->u_name ;
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
                             if($txt != NULL )
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
                     <div class="jusCon">
                       
                         
                       <b class="headline-jury headline-setelement" style="background-image: url(img_sliders/constitutional_2.png); padding-left: 30px; background-repeat: no-repeat;background-position: 5px 4px; background-size: 20px 20px; ">
                           Jury of peers
                        </b>
                         <!-- Loadin Part -->
                        <div class="jopContainer">
                            <div class="cssload-jumping">
                                    <span></span><span></span><span></span><span></span><span></span>
                            </div>
                        </div>
                <?php  
               
                     $juryApis = new jury_of_peers_applications();
                        $juries = $juryApis->jury_of_peers_get_by_values([
                         'courtroom_code'=> trim($_GET['code'])  
                        ] , 'and');
                   ?>
                         
                        <div class="jurylist">
                             <?php
                            for($i=0; $i<count($juries);$i++){
                             ?>
                              <div class="jury-box">
                                  <div style="background-image: url(photo_albums/profile_picture/<?php echo get_profile_picture($juries[$i]->jury_id) ?>);" class="jury-profile">
                                        <div class="mask-jp">
                                            <i style="background-image: url(img_sliders/constitutional_2.png);float: left;" class="disputs dis"></i>
                                         </div>
                                  </div>
                              </div>    
                            <?php 
                             }
                             ?>
                        </div>
                  
                        
                     </div>
                     
                     
                     <!--  Settlement requests  -->
                     <!-- pln inv and courtroom setting -->
                     
                     <?php
                     
                        $courInitApis = new courtroom_init_applications();
                       $existSettelements =  $courInitApis ->courtroom_init_check_exist([
                            'courtroom_code'=> trim($_GET['code'])  
                        ]);
               
                     ?>
                     <div class="courtroom-setting">
                         <b class="headline-setelement">Settlement Request</b>
                         <div class="container-of-setelement">
                             <div class="setllme text-center">  Plaintiff <br /> <?php echo $existSettelements->setlment_plnf; ?> </div>
                             <div class="setImg">
                                 <img src="images/jury_svg.png" class="img-responsive" />
                             </div>
                              <div class="setllme text-center">  Defendant <br />  <?php echo $existSettelements->setlment_dfnt; ?> <br />  </div>
                          </div>
                     </div>
                     
                     
                     
                     <?php
                        // check about session pln or dfn
                        $initCourt = new courtroom_init_applications();
                        $intCrt = $initCourt->courtroom_init_check_exist(['courtroom_code'=>$_GET['code']]);
                        $currentUser = $_SESSION['user_info']['user_id'];
                        if($intCrt->plaintiff_id == $currentUser || $intCrt->defedant_id == $currentUser ){
                            ?>
                                <div class="courtroom-setting">
                                    <b class="headline-setelement">Your stats</b>
                                    <div class="container-of-setelement">
                                         <table class="table">
                                             <tr>
                                                 <td>
                                                     <b style="color: #555">Credibility</b>
                                                 </td>
                                                 <td>
                                                      <?php
                                                        // from votes
                                                        $vote_apis = new courtroom_votes_applications();
                                                        $likes = $vote_apis->courtroom_votes_get_by_values(['likes_dislikes'=>1 ,'for_pln_dfn_id'=>$currentUser ],'and');
                                                        $dislikes = $vote_apis->courtroom_votes_get_by_values(['likes_dislikes'=>0 ,'for_pln_dfn_id'=>$currentUser ],'and');
                                                        $und = (ceil(count($dislikes) + count($likes) ) == 0 ) ? 1 : ceil(count($dislikes) + count($likes) ) ;
                                                        echo ceil(ceil(count($likes) * 100 ) / $und ) .'%';
                                                     ?>
                                                 </td>
                                                 <td style="border-left: 1px solid #dfdfdf;">
                                                     <b style="color: #555">Sets Heard</b>
                                                 </td>
                                                 <td>
                                                      <?php
                                                        // from votes
                                                        $inivit_apis = new courtroom_invitation_applications();
                                                        $invitAccespted = $inivit_apis->courtroom_invitations_get_by_values(['sender_id'=>$currentUser , 'is_accept'=>1], 'and');
                                                        $invitNotAccespted = $inivit_apis->courtroom_invitations_get_by_values(['sender_id'=>$currentUser , 'is_accept'=>0], 'and');
                                                        $yun = (ceil(count($invitNotAccespted) + count($invitAccespted) ) == 0 ) ? 1 : ceil(count($invitNotAccespted) + count($invitAccespted) ) ;
                                                        echo ceil( ceil(count($invitAccespted) * 100 ) /  $yun ).'%';
                                                     ?>
                                                 </td>
                                             </tr>
                                             <tr>
                                                 <td>
                                                     <b style="color: #555">Cases Heard </b>
                                                 </td>
                                                 <td>
                                                     <?php
                                                        // القضايا المنظوره                                                        
                                                        $COURTROOMS = $initCourt->courtroom_init_apis_get_all('WHERE plaintiff_id = '.$currentUser.' OR defedant_id = '.$currentUser.' AND is_accepted = 1');
                                                        echo count($COURTROOMS);
                                                     ?>
                                                 </td>
                                                 <td style="border-left: 1px solid #dfdfdf;">
                                                     <b style="color: #555">Wins </b>
                                                 </td>
                                                 <td>
                                                     <?php
                                                        // winners 
                                                        $winnerApis = new courtroom_winned_applications();
                                                        $winns = $winnerApis->courtroom_winnedt_get_by_values(['winned_id'=>$currentUser,'is_winner'=>1], 'and');
                                                        echo count($winns);  
                                                     ?>
                                                 </td>
                                             </tr>
                                             <tr>
                                                 <td>
                                                     <b style="color: #555">Score</b>
                                                 </td>
                                                 <td>
                                                     <?php
                                                         echo ceil( 3 * count($likes) );  
                                                     ?>
                                                 </td>
                                                 <td style="border-left: 1px solid #dfdfdf;">
                                                     <b style="color: #555">Lost</b>
                                                 </td>
                                                 <td>
                                                      <?php
                                                        // Lost 
                                                         
                                                        $Lost = $winnerApis->courtroom_winnedt_get_by_values(['winned_id'=>$currentUser,'is_winner'=>0], 'and');
                                                        echo count($Lost);  
                                                     ?>
                                                 </td>
                                             </tr>
                                         </table>
                                    </div>
                                </div>
                            <?php
                        }
                     ?>
                     
                     
                     
                     
                    
                    
                     <div class="courtroom-setting">
                         <b class="headline-setelement">Time Estimated for this courtroom</b>
                         <div class="container-of-setelement">
                             <table class="table">
                                 <tr>
                                     <td>Time Estimated</td>
                                     <td>:- <?php   echo $timeEstimated ." Days" ;?> </td>
                                 </tr>
                                 <tr>
                                     <td>Time Left</td>
                                     <td>:- 
                                         <?php
                                            
                                            echo $timeLeft ; 
                                         
                                         ?> </td>
                                 </tr>
                             </table>
                          </div>
                     </div>
                     
                </div>
                <div class="col-xs-12 col-md-6 profile-content">
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    <?php
                    if($timeLeft != 'Completed'){
                    ?>
                    
                    <!-- Block of profile cover -->
                    <div class="eviden">
                        <b class="headlineviden">
                            <i style="font-size: 25px; color: #222;" class="fa fa-paperclip" aria-hidden="true"></i>
                            <b style="padding: 5px;">Evidence</b>
                        </b>
                     </div>
                     <div class="main-comments text-center">
                         <div class="status-incourtroom">
                             <?php
                                $courtInitApis = new courtroom_init_applications(); 
                                $courtExist = $courtInitApis->courtroom_init_check_exist(['courtroom_code'=>trim($_GET['code'])]);
                                $userApps = new user_applications() ;
                                $pln = $userApps->user_application_check_exist(['id'=>$courtExist->plaintiff_id]);
                                $dfn = $userApps->user_application_check_exist(['id'=>$courtExist->defedant_id]);
                             ?>
                             
                             <div style="width: 100%; display: block;overflow: hidden ;">
                                  <div class="courtpersons">
                                      <div class="containerStatus">
                                        <img class="prof pln-img" src="photo_albums/profile_picture/<?php echo get_profile_picture($courtExist->plaintiff_id); ?>" />
                                        <b class="pln-titles">
                                            <?php echo $pln->u_name; ?>
                                                <span class="setType">
                                                Plaintiff
                                                </span>
                                        </b>
                                      </div>
                                  </div>
                                  <div style="border-left: 1px solid #f9f9f9;" class="courtpersons">
                                        <div class="containerStatus">
                                            <img class="prof dfn-img" src="photo_albums/profile_picture/<?php echo get_profile_picture($courtExist->defedant_id); ?>" />
                                            <b class="dfn-titles">
                                            <?php echo $dfn->u_name; ?>
                                            <span class="setType">
                                            Defendant 
                                            </span>
                                            </b>
                                        </div>
                                  </div>
                                </div>
                             
                             
                              
                                         <div class="courtpersons">
                                              <div class="status-cause-pln">
                                                  <?php
                                                    echo $courtExist->court_cause ;
                                                  ?>
                                              </div>
                                         </div>
                                         
                                         <div style="border-left: 1px solid #f9f9f9;" class="courtpersons">
                                              
                                             <div class="status-cause-pln">
                                                 <?php
                                                     $postApis = new user_posts_applications();
                                                    $textApis = new  user_texts_applications();
                                                    $postinPagin = $postApis->user_posts_check_exist(['id'=>$courtExist->post_id ]);
                                                    $txt =  $textApis->user_texts_applications_check_exist(['id'=>$postinPagin->post_text_id ]);
                                                    print($txt->post_text);
                                                 ?>
                                              </div>
                                         </div>
                                         <?php
                                             $courtCode = trim($_GET['code']) ;
                                         ?>
                                        <div class="juryCntr">
                                            <div class="vote-pln">
                                                 <ul style="position: relative;margin-top: -6px;" class="acc">
                                                     <!-- 
                                                     background: rgb(220, 220, 220) none repeat scroll 0% 0%; border: 1px solid rgb(220, 220, 220); color: darkcyan;
                                                     background: floralwhite none repeat scroll 0% 0%; border: 1px solid rgb(220, 220, 220); color: tomato;
                                                     -->
                                                        <?php
                                                            $courtroomVote = new courtroom_votes_applications();
                                                            $courtInitApis = new courtroom_init_applications(); 
                                                            $courtExist = $courtInitApis->courtroom_init_check_exist(['courtroom_code'=>trim($_GET['code'])]);
                                                        
                                                            $crtVoteExist = $courtroomVote->courtroom_votes_check_exist(['courtroom_code'=>$courtCode , 'user_id'=>$_SESSION['user_info']['user_id'] , 'likes_dislikes'=>1 ,'for_pln_dfn_id'=>$courtExist->plaintiff_id]);
                                                            $crtVoteExistDis = $courtroomVote->courtroom_votes_check_exist(['courtroom_code'=>$courtCode , 'user_id'=>$_SESSION['user_info']['user_id'] , 'likes_dislikes'=>0 ,'for_pln_dfn_id'=>$courtExist->plaintiff_id]);
                                                            $crtVoteExists = $courtroomVote->courtroom_votes_check_exist(['courtroom_code'=>$courtCode , 'user_id'=>$_SESSION['user_info']['user_id'] , 'likes_dislikes'=>1 ]);
                                                            $crtVoteExistsDis = $courtroomVote->courtroom_votes_check_exist(['courtroom_code'=>$courtCode , 'user_id'=>$_SESSION['user_info']['user_id'] , 'likes_dislikes'=>0 ]);
                                                            
                                                        ?>
                                                         <li>
                                                            <a onclick="<?php if( $crtVoteExists == NULL  ) { ?> like_dislike_pln('<?php echo $courtCode; ?>' , 1 , 'pln', this); <?php } ?>">
                                                                <i style="
                                                                   <?php
                                                                    if($crtVoteExist != NULL )
                                                                    {
                                                                        echo "background: floralwhite none repeat scroll 0% 0%; border: 1px solid rgb(220, 220, 220); color: tomato;";
                                                                    }
                                                                   ?>
                                                                   " class="fa iconstilsh fa-thumbs-o-up"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a  onclick="<?php if( $crtVoteExistsDis == NULL  ) { ?> like_dislike_pln('<?php echo $courtCode; ?>' ,0 ,   'pln' , this);<?php } ?>">
                                                                <i style="
                                                                   <?php
                                                                    if($crtVoteExistDis != NULL )
                                                                    {
                                                                        echo "background: floralwhite none repeat scroll 0% 0%; border: 1px solid rgb(220, 220, 220); color: tomato;";
                                                                    }
                                                                   ?>
                                                                   " class="fa fa-thumbs-o-down iconstilsh fa-thumbs-o-up"></i>
                                                            </a>
                                                        </li>
                                                 </ul>
                                            </div>
                                            
                                            <?php
                                           
                                                $isJuryApis = new jury_of_peers_applications() ;
                                                $juryExist = $isJuryApis->jury_of_peers_check_exist(['jury_id'=>$_SESSION['user_info']['user_id'] , 'courtroom_code'=>$courtCode]);
                                            ?>
                                            
                                                        
                                                    
                                            
                                            <div class="vote-pln" style="float: right;">
                                                <ul style="position: relative;margin-top: -6px;" class="acc">
                                                     <?php
                                                      $courtInitApis = new courtroom_init_applications(); 
                                                        $courtExist = $courtInitApis->courtroom_init_check_exist(['courtroom_code'=>trim($_GET['code'])]);
                                                        $crtVoteExist = $courtroomVote->courtroom_votes_check_exist(['courtroom_code'=>$courtCode , 'user_id'=>$_SESSION['user_info']['user_id'] , 'likes_dislikes'=>1 , 'for_pln_dfn_id'=>$courtExist->defedant_id ]);
                                                     $crtVoteExistDis = $courtroomVote->courtroom_votes_check_exist(['courtroom_code'=>$courtCode , 'user_id'=>$_SESSION['user_info']['user_id'] , 'likes_dislikes'=>0 , 'for_pln_dfn_id'=>$courtExist->defedant_id ]);
                                                     ?>
                                                         <li>
                                                            <a onclick="<?php if( $crtVoteExists == NULL  ) { ?>like_dislike_pln('<?php echo $courtCode; ?>' ,1 ,   'dfn' , this); <?php } ?>">
                                                                <i style="
                                                                   <?php
                                                                    if($crtVoteExist != NULL )
                                                                    {
                                                                        echo "background: floralwhite none repeat scroll 0% 0%; border: 1px solid rgb(220, 220, 220); color: tomato;";
                                                                    }
                                                                   ?>
                                                                   " class="fa iconstilsh fa-thumbs-o-up"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a onclick="<?php if( $crtVoteExistsDis == NULL  ) { ?>like_dislike_pln('<?php echo $courtCode; ?>' ,0 ,   'dfn' , this);  <?php } ?>">
                                                                <i style="
                                                                   <?php
                                                                    if($crtVoteExistDis != NULL )
                                                                    {
                                                                        echo "background: floralwhite none repeat scroll 0% 0%; border: 1px solid rgb(220, 220, 220); color: tomato;";
                                                                    }
                                                                   ?>
                                                                   " class="fa fa-thumbs-o-down iconstilsh fa-thumbs-o-up"></i>
                                                            </a>
                                                        </li>
                                                 </ul>
                                            </div>
                                        </div>
                             
                             
                             <!-- Start Comments From jury of peers --> 
                             <div class="cmtOfjop">
                                 <b court-code='<?php echo $courtCode ; ?>' class="evedSee">Load all evidence</b>
                             </div>
                              <!-- End Comments From jury of peers --> 
                          </div>
                     </div>
                    
                    
                    
                    
                    
                    <?php
                    }else {
                        ?>
                     <!-- Winners -->
                    <div class="winnerBlock">
                       <?php
                            $whoIs = new courtroom_winned_applications();
                            $winner = $whoIs->courtroom_winnedt_check_exist(['courtroom_code'=>$_GET['code'],'is_winner'=>1]);
                            $lost = $whoIs->courtroom_winnedt_check_exist(['courtroom_code'=>$_GET['code'],'is_winner'=>0]);
                            $whoIsExists = $whoIs->courtroom_winnedt_check_exist(['courtroom_code'=>$_GET['code']]);
                             if($whoIsExists != NULL ){
                                   
                                 $userApp = new user_applications();
                                 $userInfoWinner = $userApp->user_application_check_exist(['id'=>$winner->winned_id]);
                                 $userInfoLost = $userApp->user_application_check_exist(['id'=>$lost->winned_id]);
                                 
                                 
                                 $voteApis = new courtroom_votes_applications();
                                 $voteWinner = $voteApis->courtroom_votes_get_by_values(['for_pln_dfn_id'=>$winner->winned_id,'likes_dislikes'=>1,'courtroom_code'=>$_GET['code']],'and');
                                 $votLost = $voteApis->courtroom_votes_get_by_values(['for_pln_dfn_id'=>$winner->winned_id,'likes_dislikes'=>0,'courtroom_code'=>$_GET['code']],'and' );
                              ?>
                                     
                                <div class="winnnnner">
                                    <b class="mmm">Winner</b>
                                    
                                    <div class="userProfileInfo">
                                        <a class="gootoProfil gotP" href="http://www.juryofpeers.tv/?user=<?php echo $userInfoWinner->u_name ; ?>">
                                            <div class="user-image headerimage mnmnmn" style="background-image: url(photo_albums/profile_picture/<?php echo get_profile_picture($winner->winned_id); ?>);"></div>
                                        </a>
                                        <div class="user-posts-name"><a class="gootoProfil" href="http://www.juryofpeers.tv/?user=<?php echo $userInfoWinner->u_name ; ?>">
                                                <b style="margin-left: 12px;" class="ccc"> 
                                                 <?php
                                                    echo $userInfoWinner->u_name ;
                                                 ?>
                                             </b>

                                            <div class="clearFix"></div>
                                            </a><a>
                                                <span style="font-size: 15px;" class="time-shared">
                                                    Votes : <?php echo count($voteWinner);?>
                                                </span>
                                             </a>
                                         </div>

                                    </div>
                                    
                                    
                                    <br />
                                    <b class="mmm">Lost</b>
                                     <div class="userProfileInfo">
                                        <a class="gootoProfil gotP" href="http://www.juryofpeers.tv/?user=<?php echo $userInfoLost->u_name ; ?>">
                                        <div class="user-image headerimage mnmnmn" style="background-image: url(photo_albums/profile_picture/<?php echo get_profile_picture($lost->winned_id); ?>);"></div>
                                        </a>
                                        <div class="user-posts-name"><a class="gootoProfil" href="http://www.juryofpeers.tv/?user=<?php echo $userInfoLost->u_name ; ?>">
                                                <b  style="margin-left: 12px;" class="ccc"> 
                                                  <?php
                                                    echo $userInfoLost->u_name ;
                                                 ?>
                                             </b>

                                            <div class="clearFix"></div>
                                            </a><a>
                                                <span style="font-size: 15px;" class="time-shared">
                                                   Votes : <?php echo count($votLost);?>
                                                </span>
                                             </a>
                                         </div>

                                    </div>
                                </div>
                                     
                                     
                                <?php
                             }else {
                                 ?>
                                     <center><b>There are no winners for this courtroom !</b></center> 
                                 <?php
                             }
                       ?>
                    </div> 
                    
                      <?php
                    }
                    ?>
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                 </div>
                <div class="col-xs-12 col-md-2">
                    <?php
                        
                        $courtRoomInit = new courtroom_init_applications();
                        $courtCode = trim($_GET['code']) ;
                        $courtExist = $courtRoomInit->courtroom_init_check_exist(['courtroom_code'=>$courtCode]);
                        
                    ?> 
                    
                    
                    <?php
                        if($_SESSION['user_info']['user_id'] == $courtExist->plaintiff_id OR $_SESSION['user_info']['user_id'] ==  $courtExist->defedant_id ){
                            
                            ?>
                            
                                <?php
                                    if($timeLeft != 'Completed'){
                                       ?>
                                       
                                        <!-- Button to invitation -->
                               <a style="border-radius: 0px; width: 100%;" class="btn btn-primary">Invite your friends</a>
                               
                                       <?php
                                    }
                                ?>
                              
                               
                                


                                
                                <!-- Defendant -->
                                 <?php if($_SESSION['user_info']['user_id'] == $courtExist->defedant_id){ ?>
                                
                                 <div class="courtroom-setting dfnInvites">
                                      <b class="headline-setelement ">Defendant invitations</b>
                                         <!-- Load all names -->
                                          <div class="appended">
                                          <?php
                                        $userApps = new user_applications();
                                        $plnInvitation = new user_get_more_pagination_invitation_package() ;
                                        $plaintiffInv = $plnInvitation->load_more_invitation_list(0 , 5 , "sender_id = " . $_SESSION['user_info']['user_id'] . " AND  courtroom_code = ".$courtCode );
                                       if(is_array($plaintiffInv)   ) {
                                      
                                        for($i=0;$i < count($plaintiffInv) ; $i++){
                                             $userInfos = $userApps->user_application_check_exist(['id'=>$plaintiffInv[$i]->user_id]);
                                             if($userInfos != NULL )
                                                 {
                                             ?>
                                                 <div class="invitPersons ">
                                                  <b class="mmk"><div style="background-image: url(photo_albums/profile_picture/<?php echo get_profile_picture($plaintiffInv[$i]->user_id) ?>);" class="img-invi"></div>
                                                     <span class="infoR">
                                                        <?php echo $userInfos->u_name; ?>
                                                         <br />
                                                         <?php if($plaintiffInv[$i]->is_accept == 0 ) {  //is_accept ?>
                                                         <span style="" class="statusInvite"> <i class=" icon-right-open-2"></i> Pending Request </span>  
                                                          <br>
                                                         <?php }  ?>
                                                          <?php if($plaintiffInv[$i]->is_accept == 1 ) {  //is_accept ?>
                                                              <?php
                                                                if($timeLeft != 'Completed'){
                                                                   ?>
                                                                    <!-- Button to invitation -->
                                                          <a onclick="send_to_jury_of_peers('<?php echo $courtCode ; ?>' , <?php echo $userInfos->id ; ?> , this)" class="addjop">Add to jury of peers</a>
                                                          <?php } } ?>
                                                     </span> 

                                                  </b>
                                                  
                                               </div> 
                                              
                                              <!-- Load here -->
                                          
                                     <?php  
                                     
                                                 }else {
                                                      echo "<center><h3>
                                                        There are no invitations to your courtroom ! 
                                                   </h3></center>";
                                                 }
                                     $lstid =  $plaintiffInv[$i]->id  ;
                                     }  
                                       }else {
                                            echo "<center><h3>
                                                 There are no invitations to your courtroom ! 
                                            </h3></center>";
                                        }
                                      ?><input class="lastIdCourt" value="<?php echo $lstid ; ?>" type="hidden" />
                                          </div>
                                         <?php
                                            if(is_array($plaintiffInv)) {
                                                ?>
                                            <div onclick="load_mor_invitation_dfn('<?php echo $courtCode ; ?>' , this);" class="loadMoreBtn ldinv">Load More</div>      

                                                <?php
                                            }
                                         ?>
                                 </div>
                                <?php } ?>
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                <!-- Defendant -->
                                 <?php if($_SESSION['user_info']['user_id'] == $courtExist->plaintiff_id){ ?>
                                
                                 <div class="courtroom-setting dfnInvites">
                                      <b class="headline-setelement ">Plaintiff invitations</b>
                                         <!-- Load all names -->
                                          <div class="appended">
                                          <?php
                                        $userApps = new user_applications();
                                        $plnInvitation = new user_get_more_pagination_invitation_package() ;
                                        $plaintiffInv = $plnInvitation->load_more_invitation_list(0 , 5 , "sender_id = " . $_SESSION['user_info']['user_id'] . " AND  courtroom_code = ".$courtCode );
                                                        
                                                         
                                                         
                                        
                                             if(is_array($plaintiffInv)) {
                                                        for($i=0;$i < count($plaintiffInv) ; $i++){
                                                         $userInfos = $userApps->user_application_check_exist(['id'=>$plaintiffInv[$i]->user_id]);
                                                        
                                                         if($userInfos != NULL ){
                                                          ?>
                                                             <div class="invitPersons ">
                                                              <b class="mmk"><div style="background-image: url(photo_albums/profile_picture/<?php echo get_profile_picture($plaintiffInv[$i]->user_id) ?>);" class="img-invi"></div>
                                                                 <span class="infoR">
                                                                    <?php echo $userInfos->u_name ; ?>
                                                                     <br />
                                                                     <?php if($plaintiffInv[$i]->is_accept == 0 ) {  //is_accept ?>
                                                                     <span style="" class="statusInvite"> <i class=" icon-right-open-2"></i> Pending Request </span>  
                                                                      <br>
                                                                     <?php }  ?>

                                                                       <?php if($plaintiffInv[$i]->is_accept == 1 ) {  //is_accept ?>
                                                                        <?php
                                                                        if($timeLeft != 'Completed'){
                                                                           ?>
                                                                            <!-- Button to invitation -->
                                                                      <a onclick="send_to_jury_of_peers('<?php echo $courtCode ; ?>' , <?php echo $userInfos->id ; ?> , this)" class="addjop">Add to jury of peers</a>
                                                                      <?php } } ?>
                                                                 </span> 

                                                              </b>

                                                           </div> 

                                                          <!-- Load here -->

                                                 <?php  }else    echo "<center><h3>
                                                 There are no invitations to your courtroom ! 
                                            </h3></center>";
                                                  $lstid =  $plaintiffInv[$i]->id  ;
                                                 }  
                                     }else {
                                         echo "<center><h3>
                                                 There are no invitations to your courtroom ! 
                                            </h3></center>";
                                     }
                                     
                                     
                                     
                                     
                                      ?><input class="lastIdCourt" value="<?php echo $lstid ; ?>" type="hidden" />
                                          </div>
                                         <?php
                                            if(is_array($plaintiffInv))
                                            { ?>
                                               <div onclick="load_mor_invitation_pln('<?php echo $courtCode ; ?>' , this);" class="loadMoreBtn ldinv">Load More</div>      
 
                                          <?php  }
                                         ?>
                                 </div>
                                <?php } ?>
                                
                                
                                
                                
                                
                                
                                
                                
                                  
                             <?php
                        }
                    ?>
                   
                    
                    
                    
                    
                    
                    
                    
                    
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
                            <!-- Facebook -->
                            <div id='fb-root'></div>
                            <div onclick="FacebookInviteFriends ();" class="icons">
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
                                       $invtd = $courtroomInvitApis->courtroom_invitations_check_exist(['user_id'=>$InUser_id , 'sender_id'=>$_SESSION['user_info']['user_id'] , 'courtroom_code'=>$_GET['code'] ] , 'and');
                                       if($invtd == NULL   )
                                       {  
                                             // $courtExist->defedant_id ;
                                             // $courtExist->plaintiff_id ;
                                                ?>
                                                <div class="all">
                                                   <b class="name"><?php echo $userInfo->u_name ; ?></b>
                                                   <span onclick="inviteMyFrd(<?php echo $userInfo->id ; ?> , '<?php echo $_GET['code'] ; ?>' , this);" class="btns">Invite</span>
                                                 </div>
                                             <?php  
                                           
                                         
                                       }else {
                                           ?>
                                            <div class="all">
                                               <b class="name"><?php echo $userInfo->u_name ; ?></b>
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
                        <div class="error-list-invt"></div>
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
     <style>
 .MBT-FB a {
  font-family: tahoma, verdana, arial, sans-serif !important;
  font-weight:bold !important;
  font-size:12px !important;
  width:150px !important;
  border:solid #29447e 1px !important;
  border-bottom:solid #29447e 1px !important;
  cursor:pointer !important;
  padding:6px 6px 6px 6px !important;
  background-color:#5c75a9 !important;
  border-top:solid #8a9cc2 1px !important;
  text-align:center !important;
  color:#fff !important;
  text-decoration:none  ! important;
 }
 .MBT-FB a:active {
  background-color:#4f6aa3 !important;
 }
</style>
 
<script type='text/javascript'>
 if (top.location != self.location) {
  top.location = self.location
 }
</script>
    </body>
</html>