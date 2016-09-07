<?php
ob_start() ;
if(session_id()=='')
    session_start() ;

    


     $file = dirname(__FILE__)."/../modular/autoload_apps.php";
            if(is_file($file )) require_once $file ;   
            
?>        

<div class="msg-body scroll-msgs">
                     <!--   
                    <div class="loadMore">
                        <center>
                            <b>Load More</b>
                        </center>
                    </div>
                      -->
                    <?php
                    
                    if(!isset($_POST['userId']))
                    {
                        return false ;
                    }
                    $userRec = $_POST['userId'];
                    $userSender = $_SESSION['user_info']['user_id'];
                    $me =  $_SESSION['user_info']['user_id'];
                    
                    
                    $msgApis = new messagae_applications();
                    $loadAllmsg = $msgApis->messagae_apis_get_all("WHERE ( user_from = $userSender and user_to = $userRec ) OR ( user_from = $userRec and user_to = $userSender )  GROUP BY id DESC");
                        $userApps = new user_applications();
                       
                       $other = 0 ;
                        for($i=0; $i <  count($loadAllmsg) ; $i++ ){
                            if($me == $loadAllmsg[$i]->user_from )
                                {
                                    $me = $loadAllmsg[$i]->user_from ;
                                    $other = $loadAllmsg[$i]->user_to ;
                                }
                            else if ($me == $loadAllmsg[$i]->user_to )
                               { $me = $loadAllmsg[$i]->user_to ;
                                $other = $loadAllmsg[$i]->user_from ;
                               }
                         $sender =  $userApps->user_application_check_exist(['id'=>$loadAllmsg[$i]->user_from]);
                        $receiver = $userApps->user_application_check_exist(['id'=>$loadAllmsg[$i]->user_to]);
                              if($me == $loadAllmsg[$i]->user_from  OR $me == $loadAllmsg[$i]->user_to )
                              {  $mesender =  $userApps->user_application_check_exist(['id'=> $me]);
                                  ?>
                                   <div class="sender-user id-sender">
                                        <p class="msgTx">
                                           <div class="userProfileInfo">
                                          <a class="gootoProfil" href="http://www.juryofpeers.tv/?user=mon1">
                                              <div class="user-image headerimage" style="background-image: url(photo_albums/profile_picture/<?php echo get_profile_picture($sender->id)?>);"></div>
                                          </a>
                                          <div class="user-posts-name"><a class="gootoProfil" href="http://www.juryofpeers.tv/?user=<?php echo get_profile_picture($sender->id)?>">
                                          <b> 
                                               <?php
                                                echo $sender->f_name.' '. $sender->s_name.' ' ;
                                               ?>
                                           </b>
                                         <div class="clearFix"></div>
                                         </a><a>
                                         <span class="time-shared">
                                           <?php
                                            $appli = new apps() ;
                                            echo $appli->time_elapsed_string($loadAllmsg[$i]->timestamps);
                                            
                                           ?>
                                         </span>
                                         <i class="fa reposition fontello icon-user-6" title="" data-toggle="tooltip" data-placement="right" aria-hidden="true" data-original-title="">
                                         </i> 
                                         </a>
                                         </div>
                                       </div>
                                        <p>
                                            <?php
                                            
                                            echo  $loadAllmsg[$i]->message_text ;
                                            
                                           ?>  
                                        </p>
                                         
                                  </div>
                                   <?php
                              }else {
                                   $receiverdd = $userApps->user_application_check_exist(['id'=>$other]);
                                  ?>
                                 <div class="sender-user id-receiver">
                         
                              <div class="userProfileInfo">
                           <a class="gootoProfil" href="http://www.juryofpeers.tv/?user=<?php echo $receiverdd->u_name ;?>">
                            <div class="user-image headerimage" style="background-image: url(photo_albums/profile_picture/<?php echo get_profile_picture($receiverdd->id)?>"></div>
                           </a>
                           <div class="user-posts-name"><a class="gootoProfil" href="http://www.juryofpeers.tv/?user=<?php echo $receiverdd->u_name ;?>">
                           <b> 
                                <?php
                                                echo $receiverdd->f_name.' '. $receiverdd->s_name.' ' ;
                                               ?>
                            </b>
                          <div class="clearFix"></div>
                          </a><a>
                          <span class="time-shared">
                            <?php
                                            $appli = new apps() ;
                                            echo $appli->time_elapsed_string($loadAllmsg[$i]->timestamps);
                                            
                                           ?>
                          </span>
                        
                          </a>
                          </div>
                                    <p>
                                        
                                            <?php
                                           
                                            echo $loadAllmsg[$i]->message_text ;
                                            
                                           ?>  
                                        </p>
                                         
                        </div>
                       
                   </div>     
                                 <?php
                              }
                        }
                    ?> 
                    
                    
 </div>