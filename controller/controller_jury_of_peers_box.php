<?php

ob_start() ;
if(session_id()=='')
    session_start () ;
 
if(!isset($_POST['accType']))
       return FALSE ;
   
 $files = dirname(__FILE__)."/../modular/autoload_apps.php";
 if(is_file($files )) require_once $files  ;
 
   
   
   
   if($_POST['accType'] == 'jury_add'){
      $jury_id =  trim($_POST['jury_id']) ;
      $court_code =  trim($_POST['courtCode']) ;
      
      
      $courtInitApis = new courtroom_init_applications();
             $userApis = new user_applications();
             $notificaiton_apis = new notification_system_applications();
             $courtroomInvitApis = new courtroom_invitation_applications();
             $juryApis = new jury_of_peers_applications();
             $courtInitInfo = $courtInitApis->courtroom_init_check_exist(['courtroom_code'=>$court_code]);
            
            if($courtInitInfo != NULL){ 
                // check user exist 
                $juryExist = $juryApis->jury_of_peers_check_exist([
                    'courtroom_code'=> $court_code  , 
                    'jury_id' => $jury_id
                ],'and');
                if($juryExist != NULL )
                {
                    echo "404" ;
                    return FALSE ;
                }
                
                
                
                // check count of this compatitor to be only 3
               $juryCount = $juryApis->jury_of_peers_get_by_values([
                    'courtroom_code'=> $court_code  , 
                    'user_id' => $_SESSION['user_info']['user_id']
                ],'and'); 
               if(count($juryCount) >= 3 )
               {
                   echo "505" ;
                   return false ;
               }
               $type = 0 ; // PLN 
               $pln= $courtInitApis->courtroom_init_check_exist(['plaintiff_id'=> $_SESSION['user_info']['user_id'] ,'courtroom_code'=>$courtCode ]);
               $dfn= $courtInitApis->courtroom_init_check_exist(['defedant_id'=> $_SESSION['user_info']['user_id'] ,'courtroom_code'=>$courtCode ]);
               if($pln != NULL )
                   $type = 0 ; 
               else if($dfn != NULL )
                   $type = 1 ;
              $juryOfPeers =  $juryApis->jury_of_peers_add_new_field([
                        'user_id'  => $_SESSION['user_info']['user_id'] ,  
                        'court_id' => $courtInitInfo->id ,   
                        'pln_or_dfn'=> $type , 
                        'post_id'=> $courtInitInfo->post_id, 
                        'courtroom_code'=> $court_code , 
                        'jury_id'=>  $jury_id
                       ]);
              if($juryOfPeers) {
                  
                  
                  $juries = $juryApis->jury_of_peers_get_by_values([
                         'courtroom_code'=> $court_code  
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
                    <?php
              }
              return false ;
             }
   }
    
    
       
  
    
?>