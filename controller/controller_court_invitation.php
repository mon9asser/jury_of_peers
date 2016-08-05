<?php
ob_start() ;
if(session_id()=='')
    session_start () ;
if(!isset($_SESSION['user_info']))
    return false ;

 $files = dirname(__FILE__)."/../modular/autoload_apps.php";
 if(is_file($files )) require_once $files  ;
 
    if(isset($_POST['accType'])) {
      if($_POST['accType'] == 'sendInvitationFrd'){
            $userId = trim($_POST['userId']);
            $courtCode =trim( $_POST['courtCode']); 
             // apis  
             $courtInitApis = new courtroom_init_applications();
             $userApis = new user_applications();
             $notificaiton_apis = new notification_system_applications();
             $courtroomInvitApis = new courtroom_invitation_applications();
             
             $courtInitInfo = $courtInitApis->courtroom_init_check_exist(['courtroom_code'=>$courtCode]);
             if($courtInitInfo != NULL){
                   
                 
                 $inv = $courtroomInvitApis->courtroom_invitations_check_exist([
                    'user_id' => $userId ,
                    'court_id'=>$courtInitInfo->id 
                 ],'and');    
                 if($inv == NULL ){
                     $invitation =  $courtroomInvitApis->courtroom_invitations_add_new_field([
                            'court_id'=>$courtInitInfo->id         ,
                            'courtroom_code'=>$courtCode           ,
                            'post_id' => $courtInitInfo->post_id   ,
                            'user_id' => $userId                   ,
                           'sender_id'=>$_SESSION['user_info']['user_id'] ,
                            'timestmps' => time()                  
                        ]);
                       if($invitation) 
                        echo "1";
                 }else echo "2";
                
                
                 /******************************************************************/
                 /*************************  Notification  *************************/
                 /******************************************************************/
                 
                 // plaintiff 
                /* if($courtInitInfo->plaintiff_id == $_SESSION['user_info']['user_id'] )
                 {
                     
                 }
                 // defendant
                 if($courtInitInfo->defedant_id == $_SESSION['user_info']['user_id'] )
                 {
                     
                 }*/
             } 
       }else if ( $_POST['accType'] == 'loadMore'){
            $lastId = trim($_POST['lastId']);
            $courtCode =trim( $_POST['courtCode']); 
            
             $pagination_inffrd = new user_get_more_pagination_package();
              $invitFromMyFrd =  $pagination_inffrd->user_friend_invite($lastId , 3 ,$_SESSION['user_info']['user_id']);
            
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
                <span onclick="inviteMyFrd(<?php echo $userInfo->id ; ?> , '<?php echo$courtCode ; ?>' , this);" class="btns">Invite</span>
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
              if(count($invitFromMyFrd) == 0 )
              echo count($invitFromMyFrd ) ;
       }else if($_POST['accType'] == 'loadMorePlnDfn'){
            
           $courtCode = trim ($_POST['courtCode']); 
            $userI =$_SESSION['user_info']['user_id'] ;
           
            $lastId = trim ($_POST['lastId']); 
            $param =  " `sender_id` = {$userI} AND  `courtroom_code` = {$courtCode}" ; 
            $userApps = new user_applications();
            $plnInvitation = new user_get_more_pagination_invitation_package() ;
            $plaintiffInv = $plnInvitation->load_more_invitation_list($lastId  , 3 , $param );
           // print_r($plaintiffInv);
            $lstid = 0;
            for($i=0;$i < count($plaintiffInv) ; $i++){
            $userInfos = $userApps->user_application_check_exist(['id'=>$plaintiffInv[$i]->user_id]);
            
             if(count($userInfos) != 0 ){
             ?>
            <!-- Load all names -->
               <div class="invitPersons ">
                <b class="mmk"><div style="background-image: url(photo_albums/profile_picture/<?php echo get_profile_picture($plaintiffInv[$i]->user_id) ?>);" class="img-invi"></div>
                <span class="infoR">
                <?php echo $userInfos->f_name . ' ' . $userInfos->s_name ; ?>
                <br />
                <?php if($plaintiffInv[$i]->is_accept == 0 ) {  //is_accept ?>
                <span style="" class="statusInvite"> <i class=" icon-right-open-2"></i> Pending Request </span>  
                <br>
                <?php }  ?>
                <a  onclick="send_to_jury_of_peers('<?php echo $courtCode ; ?>' , <?php echo $userInfos->id ; ?> , this)" class="addjop">Add to jury of peers</a>
                </span> 
                </b>
                
               </div> 
                <?php
                $lstid =  $plaintiffInv[$i]->id  ;
                ?> <input class="lastIdCourt" value="<?php echo $lstid ; ?>" type="hidden" /><?php
                }else {
                    echo "0";
                }
            }
            ?>
               
            <?php
            }else if($_POST['accType'] == 'loadMorePlnPln'){
            
           $courtCode = trim ($_POST['courtCode']); 
            $userI =$_SESSION['user_info']['user_id'] ;
           
            $lastId = trim ($_POST['lastId']); 
            $param =  " `sender_id` = {$userI} AND  `courtroom_code` = {$courtCode}" ; 
            $userApps = new user_applications();
            $plnInvitation = new user_get_more_pagination_invitation_package() ;
            $plaintiffInv = $plnInvitation->load_more_invitation_list($lastId  , 3 , $param );
           // print_r($plaintiffInv);
            $lstid = 0;
            for($i=0;$i < count($plaintiffInv) ; $i++){
            $userInfos = $userApps->user_application_check_exist(['id'=>$plaintiffInv[$i]->user_id]);
            
             if(count($userInfos) != 0 ){
             ?>
            <!-- Load all names -->
               <div class="invitPersons ">
                <b class="mmk"><div style="background-image: url(photo_albums/profile_picture/<?php echo get_profile_picture($plaintiffInv[$i]->user_id) ?>);" class="img-invi"></div>
                <span class="infoR">
                <?php echo $userInfos->f_name . ' ' . $userInfos->s_name ; ?>
                <br />
                <?php if($plaintiffInv[$i]->is_accept == 0 ) {  //is_accept ?>
                <span style="" class="statusInvite"> <i class=" icon-right-open-2"></i> Pending Request </span>  
                <br>
                <?php }  ?>
                <a  onclick="send_to_jury_of_peers('<?php echo $courtCode ; ?>' , <?php echo $userInfos->id ; ?> , this)" class="addjop">Add to jury of peers</a>
                </span> 
                </b>
                
               </div> 
                <?php
                $lstid =  $plaintiffInv[$i]->id  ;
                ?> <input class="lastIdCourt" value="<?php echo $lstid ; ?>" type="hidden" /><?php
                }else {
                    echo "0";
                }
            }
            ?>
               
            <?php
            }
    }
?>