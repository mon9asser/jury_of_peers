<?php
    $file = dirname(__FILE__)."/../access_modifiers/protected_access.php";
  if(is_file($file)) require_once $file  ;
  
   $filed = dirname(__FILE__)."/../modular/autoload_apps.php";
  if(is_file($filed)) require_once $filed  ;
  
  if(!isset($_POST))
      return false ;
  
  
   $me = $_SESSION['user_info']['user_id'];
  if($_POST['type']=='load_viewers'){
      $notifiCationApis = new notification_system_applications();
      $nntfLoad = $notifiCationApis->notification_system_apis_get_all("WHERE ( `id_receiver` = {$me} AND `app_type`= 0 ) AND ( `is_seen`=0 OR `is_seen`= 1 ) GROUP BY id DESC");
      if(count($nntfLoad) > 0){
          echo '<ul class="notificationList">';
      for($i=0;$i<count($nntfLoad);$i++){
          $userApp = new user_applications();
          $userInfo = $userApp->user_application_check_exist(['id'=>$nntfLoad[$i]->id_sender]);
          $apps = new apps();
          $notifiCationApis->notification_system_update_fields(['id'=>$nntfLoad[$i]->id],['is_seen'=>1]);
          ?>
            <li>
              <div class="viewBlock">
                  <div class="img-blockss" style="background: url(photo_albums/profile_picture/<?php echo get_profile_picture($userInfo->id); ?>);background-size: cover;"></div>
                  <div class="infoBlockItem">
                      <a href="http://www.juryofpeers.tv/?user=<?php echo $userInfo->u_name ?>"><b class="userNames"><?php echo $userInfo->f_name .' '.$userInfo->s_name ;?></b></a>
                        <div class="viewContainer">
                                  <font class="userNames ss">
                                  <i class=" icon-eye-3 ey3"></i>
                                  <span style="padding-left: 0px;" class="sfms">has viewed your profile</span>
                                  </font>
                                  <span class="timeAgo">From <?php echo $apps->time_elapsed_string($nntfLoad[$i]->timestamps); ?></span>
                        </div>
                  </div>
              </div>
            </li>
          <?php
           
      }
      echo '</ul>';
      }else echo "<li><center><b style='color:#e52826;margin: 10px auto;display: block;'>There are no Visitors ! </b></center></li>";
  }else if ($_POST['type']=='load_courtNtfs') { 
      $notifiCationApis = new notification_system_applications();
      $courtAcc=" `app_type`=5 " ; // COUR Request
      $courtAcc .=" OR `app_type`=7 " ; // COURT Accepted
      $courtAcc .=" OR `app_type`=8 " ; // COURT Declined
      $courtAcc .=" OR `app_type`=9 " ; // COURT image
      $courtAcc .=" OR `app_type`=10 " ; // COURT musics
      $courtAcc .=" OR `app_type`=11 " ; // COURT Video
    
      
      $nntfLoad = $notifiCationApis->notification_system_apis_get_all("WHERE `id_receiver` = {$me} AND ({$courtAcc}) AND (`is_seen`=0 OR `is_seen`= 1) GROUP BY id DESC");
      if(count($nntfLoad) > 0){
          echo '<ul class="notificationList">';
      for($i=0;$i<count($nntfLoad);$i++){ 
          $userApp = new user_applications();
          $userInfo = $userApp->user_application_check_exist(['id'=>$nntfLoad[$i]->id_sender]);
          $apps = new apps();
          $notifiCationApis->notification_system_update_fields(['id'=>$nntfLoad[$i]->id],['is_seen'=>1]);
          ?>
            <li>
                <div style="cursor: pointer;" class="viewBlock">
                  <div class="img-blockss" style="background: url(photo_albums/profile_picture/<?php echo get_profile_picture($userInfo->id); ?>);background-size: cover;"></div>
                                <?php
                                    $Content = NULL ;
                                    $icon = '<i style="background-position: 2px 2px;" class="courtIcon"></i>' ;
                                    $url = 'http://www.juryofpeers.tv/courtroom?code='.$nntfLoad[$i]->app_con_id ;
                                    
                                    echo "<style>
                                      .sfms{
                                       margin-left: -16px;padding: 5px 0px;padding-left: 0px;
                                      }  
                                    .ic {
                                                         background-position: -10px 2px;     margin-left: 6px; padding: 6px 0px; color:green; }
                                    </style>";
                                    switch ($nntfLoad[$i]->app_type) {
                                            case 5 : // courtroom request 
                                                $Content = " Dispute raised !";
                                                $icon = '<i style="background-position: 2px 2px;" class="courtIcon"></i>' ;
                                                $url = 'http://www.juryofpeers.tv/courtroom?code='.$nntfLoad[$i]->app_con_id ;
                                            break;
                                            case 7 : // courtroom request 
                                                $Content = "Accepted your judgement request";
                                                echo "<style>
                                                     .sfms{ 
                                                            margin-left: 8px;
                                                            padding: 5px 0px;
                                                            padding-left: 0px;
                                                            font-size: 13px;
                                                            }
                                                         
                                                      </style>";
                                                $icon = '<i style="    background-position: 4px 2px;   margin-left: 6px; padding: 6px 0px; color:green;" class="courtIcon"></i>' ;
                                                $url = 'http://www.juryofpeers.tv/courtroom?code='.$nntfLoad[$i]->app_con_id ;
                                            break;
                                             case 8 : // courtroom Declined 
                                                $Content = "Declined your judgement request";
                                                $icon = '<i style="background-position: 2px 2px;    margin-left: 14px;padding: 6px 0px; color:green;" class="icon-cancel-2"></i>' ;
                                                $url = 'http://www.juryofpeers.tv/courtroom?code='.$nntfLoad[$i]->app_con_id ;
                                            break;
                                        
                                            case 9 : //  image
                                                $Content = "Judge your timeline photo";
                                                $icon = '<i style="background-position: 2px 2px; color:green; color: green;float: left;padding: 4px;font-size: 17px;margin-right: 13px;" class="icon-file-image"></i>' ;
                                                $url = 'http://www.juryofpeers.tv/post?id='.$nntfLoad[$i]->app_con_id ;
                                            break;
                                        
                                         case 10 : //  musics
                                                $Content = "Judge your timeline music";
                                                $icon = '<i style="background-position: 2px 2px; color:green; color: green;float: left;padding: 4px;font-size: 17px;margin-right: 13px; color:green;"   class="icon-music-1"></i>' ;
                                                $url = 'http://www.juryofpeers.tv/post?id='.$nntfLoad[$i]->app_con_id ;
                                            break;
                                        
                                        case 11 : //  Video 
                                                $Content = "Judge your timeline Video";
                                                $icon = '<i style="background-position: 2px 2px; color:green; color: green;float: left;padding: 4px;font-size: 17px;margin-right: 13px; color:green;"  class="icon-video-3"></i>' ;
                                                $url = 'http://www.juryofpeers.tv/post?id='.$nntfLoad[$i]->app_con_id ;
                                            break;
                                      }
                                ?> 
                  <div onclick="window.location.href='<?php echo $url ; ?>'" class="infoBlockItem">
                      <a href="http://www.juryofpeers.tv/?user=<?php echo $userInfo->u_name ?>"><b class="userNames"><?php echo $userInfo->f_name .' '.$userInfo->s_name ;?></b></a>
                        <div class="viewContainer">
                                
                                  <font class="userNames ss">
                                    <?php echo $icon ; ?>
                                  <span style="" class="sfms"><?php echo $Content ;?></span>
                                  </font>
                                  
                                  <span class="timeAgo">From <?php echo $apps->time_elapsed_string($nntfLoad[$i]->timestamps); ?></span>
                        </div>
                  </div>
              </div>
            </li>
          <?php
           
      }
      echo '</ul>';
      }else echo "<li><center><b style='color:#e52826;font-size: 13px;margin: 10px auto;display: block;'>There are no Courtroom Requests or notifications ! </b></center></li>";
  }else if ($_POST['type']=='messages_ntfs') { 
         echo "<li><center><b style='color:#e52826;font-size: 13px;margin: 10px auto;display: block;'>There are no Messages ! </b></center></li>";
  }else if ($_POST['type']=='friend_requests') { 
           $userApp = new user_applications();
           $friendRequest = new friend_system_applications() ;
          $friendItem = $friendRequest->friend_system_apis_get_all("WHERE `id_receiver` = {$me} AND `is_accepted`=0 ");
          
         
          if(count($friendItem) > 0){
          echo '<ul class="notificationList">';
      
          for($i=0;$i<count($friendItem);$i++){
              $friendRequest = new friend_system_applications() ;
              $friendRequest->friend_system_update_fields([
              'id'=>$friendItem[$i]->id ,'is_seen'=> 0
          ],[
              'is_seen'=>1
          ]);
          
          $userInfo = $userApp->user_application_check_exist(['id'=>$friendItem[$i]->id_sender]);
          $apps = new apps();
         
          ?>
            <li>
                <div class="viewBlock">
                  <div class="img-blockss" style="background: url(photo_albums/profile_picture/<?php echo get_profile_picture($userInfo->id); ?>);background-size: cover;"></div>
                  <div style="width: 320px;" class="infoBlockItem">
                      <a href="http://www.juryofpeers.tv/?user=<?php echo $userInfo->u_name ?>"><b class="userNames">
                          <?php echo $userInfo->f_name .' '.$userInfo->s_name ;?></b>
                          <span style="width: 100%; display: block;overflow: hidden; color: #999;padding: 0px 0px 0px 10px;font-size: 14px;"><i class="icon-user-add"></i> Sent you a friend request From <?php echo $apps->time_elapsed_string($friendItem[$i]->timestamps); ?> </span>
                      </a>
                        <div class="viewContainer text-right">
                            <span onclick="decline_friend(<?php echo $friendItem[$i]->id ; ?>,this);" class="btns">Decline</span>
                            <span onclick="confirm_friend(<?php echo $friendItem[$i]->id ; ?>,this);" class="btns">Confirm</span>
                         </div>
                  </div>
              </div>
            </li>
          <?php
           
      }
      echo '</ul>';
      }else  echo "<li><center><b style='color:#e52826;font-size: 13px;margin: 10px auto;display: block;'>There are no friend requests ! </b></center></li>";
  }else if ($_POST['type']=='main_notifications') { 
       $notifiCationApis = new notification_system_applications();
      $nntfLoad = $notifiCationApis->notification_system_apis_get_all("WHERE `id_receiver` = {$me} AND `app_type`= 8 AND `is_seen`=0 GROUP BY id DESC");
      if(count($nntfLoad) > 0){
          echo '<ul class="notificationList">';
      for($i=0;$i<count($nntfLoad);$i++){
          $userApp = new user_applications();
          $userInfo = $userApp->user_application_check_exist(['id'=>$nntfLoad[$i]->id_sender]);
          $apps = new apps();
          $notifiCationApis->notification_system_update_fields(['id'=>$nntfLoad[$i]->id],['is_seen'=>1]);
         
          ?>
             <li>
              <div class="viewBlock">
                  <div class="img-blockss" style="background: url(photo_albums/profile_picture/<?php echo get_profile_picture($userInfo->id); ?>);background-size: cover;"></div>
                  <div class="infoBlockItem">
                      <a href="http://www.juryofpeers.tv/?user=<?php echo $userInfo->u_name ?>"><b class="userNames"><?php echo $userInfo->f_name .' '.$userInfo->s_name ;?></b></a>
                        <div class="viewContainer">
                                  <font class="userNames ss">
                                  <i class=" icon-users-1 ey3"></i>
                                  <span style="padding-left: 0px;" class="sfms">Accepted your friend request </span>
                                  </font>
                                  <span class="timeAgo">From <?php echo $apps->time_elapsed_string($nntfLoad[$i]->timestamps); ?></span>
                        </div>
                  </div>
              </div>
            </li>
          <?php
           
      }}else echo "<li><center><b style='color:#e52826;font-size: 13px;margin: 10px auto;display: block;'>There are no Notifications ! </b></center></li>";
  } 
?>