 <!-- --------------------------------------------------------------- -->
        <!-- ---------------------      Header      ------------------------ -->
        <!-- --------------------------------------------------------------- -->
        
        <?php
          $file = dirname(__FILE__)."/../access_modifiers/protected_access.php";
            if(is_file($file)) require_once $file  ; 
        ?>
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
                            <a data-toggle="tooltip" data-placement="bottom" title="Visit profile">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                <span class="counts"></span>
                            </a>
                        </li>
                        
                        <li>
                            <a data-toggle="tooltip" data-placement="bottom" title="courtroom requests">
                                <i class="fa fa-sticky-note-o" aria-hidden="true"></i>
                                <span class="counts"></span>
                            </a>
                         </li>
                        <li>
                            <a data-toggle="tooltip" data-placement="bottom" title="Messages">
                                <i class="fa fa-comments-o" aria-hidden="true"></i>
                                <span class="counts"></span>
                             </a>
                        </li>
                        <li>
                            <a data-toggle="tooltip" data-placement="bottom" title="friend requests">
                                <i class="fa fa-user-plus" aria-hidden="true"></i>
                                <span class="counts"></span>
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tooltip" data-placement="bottom" title="Notifications">
                                <i class="fa fa-globe" aria-hidden="true"></i> 
                                <span class="counts"></span>
                            </a>
                        </li>
                        <li>
                            <a style="padding: 6px;" class="user-names">
                                <div class="profile-pics" style="background-position: 72% -20%; background-image:url(photo_albums/profile_picture/<?php echo checkProfileExists($_SESSION['user_info']['user_id']);?>)" ></div>
                                <span> <?php echo $_SESSION['user_info']['user_name'] ; ?> </span>
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tooltip" data-placement="bottom" title="Settings">
                                <i class="fa fa-cog" aria-hidden="true"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>