<?php
ob_start() ;
if(session_id()=='')
    session_start () ;

          $user_file = dirname(__FILE__)."/../modular/paginations/paginations_users_add.php";
        if(is_file($user_file)) require_once $user_file ;
                             
        $user_pfle_pic_file = dirname(__FILE__)."/../modular/applications/profile_picture_applications.php";
        if(is_file($user_pfle_pic_file)) require_once $user_pfle_pic_file ;
        
        $user_setting_file = dirname(__FILE__)."/../modular/applications/general_settings_applications.php";
        if(is_file($user_setting_file)) require_once $user_setting_file ;
        
        $friend_system_file = dirname(__FILE__)."/../modular/applications/friend_system_applications.php";
        if(is_file($friend_system_file)) require_once $friend_system_file ;
                             
        $user_apis = new user_get_more_pagination_package();
        $users = $user_apis->user_add_new_friend_get_more_by_values(trim($_POST['last-id']) , 8, $_SESSION['user_info']['user_id']  ) ;
        $lastId = trim($_POST['last-id']);
        
        
                             
        if(count($users ) != 0 )
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
                        }else{
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
                else{
                        $user_friend_apis = new friend_system_applications() ;        // { 0=>pending , 1=>accepted , 2=> declined  }
                        $totalfrd = $user_friend_apis->friend_system_apis_get_all("WHERE is_accepted != 1 OR is_accepted != 0  AND `id_sender`={$users[$i]->id} OR `id_receiver`={$users[$i]->id}");
                        $user_setting = count($totalfrd)." Friend(s)";
                    }
                    
                     $lastId = $users[$i]->id ;
                ?> 
                                      
                            
                                    <?php
                                        $friend_system_file = dirname(__FILE__)."/../modular/applications/friend_system_applications.php";
                                        if(is_file($friend_system_file)) require_once $friend_system_file ;  
                                            
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
                                }else {
                                    echo '1' ;
                                }
                              ?>

<?php
  session_write_close() ;
?>