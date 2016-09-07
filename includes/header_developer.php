        <!-- --------------------------------------------------------------- -->
        <!-- ---------------------      Header      ------------------------ -->
        <!-- --------------------------------------------------------------- -->
        <link rel="stylesheet" href="../css/fontello.css"> 
        <script type="text/javascript" src="../js/main_applications.js"></script>
        <link rel="stylesheet" href="../scss/dfddfdf.css"> 
        <link rel="stylesheet" href="../css/headers.css"> 
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
                
                .navbar-default .navbar-nav > li a {
                            height: auto;
                            } 
                            ul.dropdown-menu {
                                width: 240px;
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
                     
                     <ul   class="nav navbar-nav navbar-right">
                       
                        <li>
                          
                            <a href="#"  class="dropdown-toggle user-names" style="padding: 6px;line-height: 3;"  data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">My Apps  </a>
                                <ul style="min-width: 240px;" class="dropdown-menu">
                                    
                                  <li><a href="#">Action</a></li>
                                  <li role="separator" class="divider"></li>
                                  <li><a href="#">Add new app</a></li>
                                </ul>
                        </li>
                        
                         <li> 
                            <a href="http://juryofpeers.tv" style="padding: 6px;" class="user-names">
                                <div class="profile-pics" style="background-position: 72% -20%; background-image:url(http://juryofpeers.tv/photo_albums/profile_picture/<?php echo checkProfileExists($_SESSION['user_info']['user_id']);?>)" ></div>
                                <span style="line-height: 3;"> <?php echo $_SESSION['user_info']['user_name'] ; ?> </span>
                            </a>
                        </li>
                      </ul>
                </div>
            </div>
        </nav>
        