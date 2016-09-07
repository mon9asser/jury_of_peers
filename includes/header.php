<?php
ob_start();
if(session_id()=='')
    session_start();
if(!isset($_SESSION['user_info']))
    return false ;

$me = $_SESSION['user_info']['user_id'];
?>       

<!-- --------------------------------------------------------------- -->
        <!-- ---------------------      Header      ------------------------ -->
        <!-- --------------------------------------------------------------- -->
         
        <?php
            
 $files = dirname(__FILE__)."/modular/autoload_apps.php";
 if(is_file($files )) require_once $files  ;
        ?>
 
        <link rel="stylesheet" href="css/fontello.css"> 
        <script type="text/javascript" src="js/main_applications.js"></script>
        <link rel="stylesheet" href="scss/dfddfdf.css"> 
         <link rel="stylesheet" href="assets/css/neon-core.css">
        <link rel="stylesheet" href="css/headers.css"> 
        <style>
            .dropdown .dropdown-menu:hover,.dropdown .dropdown-menu:focus{
                    display: block;
                }
                .btns {
                    padding: 4px 8px;
                    overflow: hidden;
                    border-radius: 0px;
                    border: 1px solid #eee;
                    display: inline-block;
                     cursor: pointer ;
                }
                .btns:last-child {
                    background: #e92929;
                    color: #fff;
                    border: 1px solid tomato;
                }
        </style>
         
        <nav id="header" class="navbar navbar-default ">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button  class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand logo logo-in-header" style="color: #000;" href="#">
                         JURY <span style="background: #e52826; color: #fff; padding: 0px 5px;   display: inline-block;">OF</span> PEERS
                     </a>
                </div>
                 <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                     
                     <ul class="nav navbar-nav navbar-right">
                       <li>
                                <a href="home" data-toggle="tooltip" data-placement="bottom" title="Last Stories">
                                     <i class="fa fa-home" aria-hidden="true"></i>
                                </a>  
                           
                         </li>
                          
                         <li style="display: none;" data-toggle="tooltip" data-placement="bottom" title="Visit profile"> 
                             <div class="dropdown">
                                 <a onclick="load_notification_contents('load_viewers','#loadView');" data-toggle="dropdown" >
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                    <span id="my_profile_view"></span>
                                 </a>
                                 <div id="loadView" class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                     <!-- Loading here -->
                                 </div>
                              </div>
                            
                        </li>
                         
                        <li  data-toggle="tooltip" data-placement="bottom" title="courtroom requests">
                            <div class="dropdown">
                                <a onclick="load_notification_contents('load_courtNtfs','#loadcourtInit');" data-toggle="dropdown" >
                                   <i class="fa fa-sticky-note-o" aria-hidden="true"></i>
                                   <span id="courtInit"></span>
                                </a>
                                <div id="loadcourtInit" class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                        <!-- Loading here -->
                                </div>
                             </div>
                         </li>
                        <li  data-toggle="tooltip" data-placement="bottom" title="Messages">
                                 <div class="dropdown">
                                <a   onclick="load_notification_contents('messages_ntfs','#messages_ntfs');" <?php 
                              // echo  ' data-toggle="dropdown" '; 
                                     $notificationApis = new conversation_applications();
                                     $viewFunc = $notificationApis->conversation_apis_get_all("WHERE `id_receiver`={$me} OR `id_sender`={$me}"); 
                                     if(count($viewFunc) != 0 )
                                       echo 'data-toggle="chat" data-animate="0"';  
                                     else 
                                         echo 'data-toggle="dropdown"';
                              // data-toggle="chat" data-animate="0" ;   
                                 
                                ?> class="loadMore" >
                                   <i class="icon-comment-alt-1" aria-hidden="true"></i>
                                   <span id="message_count"></span>
                                </a>
                                     <div  id="messages_ntfs" class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                        <!-- Loading here -->
                                </div>
                             </div>
                        </li>
                        
                        
                        
                        <li data-toggle="tooltip" data-placement="bottom" title="friend requests">
                               <div class="dropdown">
                                <a onclick="load_notification_contents('friend_requests','#friend_requests');" data-toggle="dropdown" >
                                   <i class=" icon-users-1" aria-hidden="true"></i>
                                   <span id="frd_cou_ntf"></span>
                                </a>
                                <div style="width:410px;" id="friend_requests" class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                        <!-- Loading here -->
                                </div>
                             </div>
                        </li>
                        <li data-toggle="tooltip" data-placement="bottom" title="Notifications">
                              <div class="dropdown">
                                <a onclick="load_notification_contents('main_notifications','#main_notifications');" data-toggle="dropdown" >
                                    <i class="fa fa-globe" aria-hidden="true"></i> 
                                   <span id="countMainNotifications"></span>
                                </a>
                                <div id="main_notifications" class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                        <!-- Loading here -->
                                </div>
                             </div>
                        </li>
                        <li>
                            <a href="http://juryofpeers.tv" style="padding: 6px;" class="user-names">
                                <div class="profile-pics" style="background-position: 72% -20%; background-image:url(photo_albums/profile_picture/<?php echo checkProfileExists($_SESSION['user_info']['user_id']);?>)" ></div>
                                <span> <?php echo $_SESSION['user_info']['user_name'] ; ?> </span>
                            </a>
                        </li>
                        
                        <li data-toggle="tooltip" data-placement="bottom" title="Logout">
                           
                            <a href="logout">
                                    <i class="fa fa-arrow-right" aria-hidden="true"></i> 
                              </a>
                                
                        </li>
                        <!-- 
                        <li data-toggle="tooltip" data-placement="bottom" title="Settings">
                            <div class="dropdown">
                                <a onclick="load_notification_contents('logout','#main_notifications');" data-toggle="dropdown" >
                                    <i class="fa fa-cog" aria-hidden="true"></i>
                                   <span id="courtInit"></span>
                                </a>
                                <div id="main_notifications" class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                       
                                </div>
                             </div>
                         </li>
                        -->
                    </ul>
                </div>
            </div>
        </nav>
        
        
        
        
        
        
        
        
        
        
        
        
        
           <!-- Open Chat
         
           <div style=" " id="chat" class="fixed" data-current-user="Art Ramadani" data-order-by-status="1" data-max-chat-history="25">
             
                        <div class="chat-inner">
                            <h2 style="margin-top: 60px; padding: 30px 35px 10px 35px;;" class="chat-header">
                                <a href="#" class="chat-close" data-animate="1">
                                    <i class="entypo-cancel">
                                        <i onclick="closeThisRightTab(this)" class="fa fa-remove"></i>
                                    </i>
                                </a>
                                     <i class="entypo-users"></i>
                                    Chat
                             </h2>
                            <div style="margin-top: 0px;" class="chat-group" id="group-1">
                                <?php
                                    $app = new pagination_chat_message();
                                    $mChat = $app ->chat_availablity(54550);
                                    $availabilityStatus = new user_available_applications();
                                   $timeNow = time();
                                   // $time_ofme = $availabilityStatus ->user_available_check_exist(['user_id'=>$me]);
                                    for($i=0; $i<count($mChat) ;$i++){ 
                                         ?>
                                            <a href="#"><span id="user_application_availaibilt" class="user-status 
                                                           <?php
                                                                // to exists ajax get the-others by time 
                                                                // Online
                                                                if(($mChat[$i]->time_available + 60) >= $timeNow ) 
                                                                    echo "is-online";
                                                                else 
                                                                    echo "is-offline";
                                                            ?>
                                                           "></span> <em><?php echo $mChat[$i]->u_name;?></em></a>    
                                                          <?php
                                    }
                                ?>
                            </div>
                            
                              
                        </div>
                
                 
            
                    
                    <div class="chat-conversation">

                            <div class="conversation-header">
                                    <a href="#" class="conversation-close"><i class="entypo-cancel"></i></a>

                                    <span class="user-status"></span>
                                    <span class="display-name"></span> 
                                    <small></small>
                            </div>

                            <ul class="conversation-body">	
                            </ul>

                            <div class="chat-textarea">
                                <textarea class="form-control autogrow" placeholder="Type your message"></textarea>
                                <i style=" 
                                color: #bec0c2;
                                right: 35px;
                                top: 25px;
                                font-size: 17px;
                                position: absolute;" class="fa fa-comment-o"></i>
                            </div>

                    </div>
                    </div>
                        
                    
                    <ul class="chat-history" id="sample_history">
                            <li>
                                    <span class="user">Art Ramadani</span>
                                    <p>Are you here?</p>
                                    <span class="time">09:00</span>
                            </li>

                            <li class="opponent">
                                    <span class="user">Catherine J. Watkins</span>
                                    <p>This message is pre-queued.</p>
                                    <span class="time">09:25</span>
                            </li>

                            <li class="opponent">
                                    <span class="user">Catherine J. Watkins</span>
                                    <p>Whohoo!</p>
                                    <span class="time">09:26</span>
                            </li>

                            <li class="opponent unread">
                                    <span class="user">Catherine J. Watkins</span>
                                    <p>Do you like it?</p>
                                    <span class="time">09:27</span>
                            </li>
                    </ul>


 
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                     --> 
                    
                    
                    
      <!-- Modal -->
                  <div class="modal fade" id="myModal" role="dialog">
                      <div style="" class="modal-dialog">

                          <!-- Load Message Here -->
                            <!-- Modal content-->
                            <div id="modelMessageContainer" style="border-radius: 0px; overflow: hidden; background: #fff;min-height: 140px;" class="modal-content">
                              <!-- lOAD HERE -->
                            </div>
                        </div>
                  </div>               
                    
     
       
        <script src="assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
        <script src="js/jquery.raty.js"></script>
        <script src="js/nice_scrollbar.js"></script>
        <script src="js/animatedModal.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="js/id3-minimized.js"></script>
 	<script type="text/javascript" src="js/jquery.filer.min.js?v=1.0.5"></script>
       <!-- <script type="text/javascript" src="js/photo_cont.js"></script> -->
        <script type="text/javascript" src="js/uploadphoto.js"></script>  
        <script type="text/javascript" src="js/audioPlay.js"></script>
        <script src="js/profile_page.js"></script>
       <script>
            $(document).ready(function (){
               window.closeThisRightTab = function (dat){
                    $('#chat').css({
                         visibility: 'hidden' 
                     });
               }
               
                        $('#chat').css({       
                               display: 'block',
                               visibility: 'inherit',
                               opacity: '1',
                               top: '0.05px' 
                               });
                window.loadMessage = function (userId){
                      $.ajax({
                     url : 'controller/controller_send_message.php',
                        data :{'user_id':userId} ,
                        type : 'post' ,
                        beforeSend : function () {
                            var loading = '<div style="top:0px;bottom: 0px;right: 0px;left: 0px; position: absolute;background-color:rgba(250,250,250,0.9);z-index: 2000;"><div style="position: absolute;width: 120px;height: 14px;margin: 19px auto;left: 0px;right: 0px;top: 40%;bottom: 0px;"  id="fountainG"><div id="fountainG_1" class="fountainG"></div><div id="fountainG_2" class="fountainG"></div><div id="fountainG_3" class="fountainG"></div><div id="fountainG_4" class="fountainG"></div><div id="fountainG_5" class="fountainG"></div><div id="fountainG_6" class="fountainG"></div><div id="fountainG_7" class="fountainG"></div><div id="fountainG_8" class="fountainG"></div></div></div>';
                             $('#modelMessageContainer').html(loading) ;
                        } ,
                        success :function (responsedData) {
                           $('#modelMessageContainer').html(responsedData) ;
                        } 
                });   
                }
             
            });
        </script>
                
      
   