<?php
ob_start() ;
if(session_id()=='')
    session_start () ;

?>
<!DOCTYPE html>
<html>
    <head>
        <title>User profile</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
         <!-- Fonts -->
         
            <!-- Fonts -->
            <link href='https://fonts.googleapis.com/css?family=PT+Serif:400,400italic,700,700italic&subset=latin-ext' rel='stylesheet' type='text/css'>
            <!-- Bootstrap -->
            <link href="css/bootstrap.min.css" rel="stylesheet">
            <link href="css/animate.css" rel="stylesheet">
            <link href="css/main.css" rel="stylesheet">
            <link href="css/logs.css" rel="stylesheet">
          <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
         <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
         <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
         <![endif]-->
    </head>
    <body>
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
                                <span class="counts">10</span>
                            </a>
                        </li>
                        
                        <li>
                            <a data-toggle="tooltip" data-placement="bottom" title="courtroom requests">
                                <i class="fa fa-sticky-note-o" aria-hidden="true"></i>
                                <span class="counts">10</span>
                            </a>
                         </li>
                        <li>
                            <a data-toggle="tooltip" data-placement="bottom" title="Messages">
                                <i class="fa fa-comments-o" aria-hidden="true"></i>
                                <span class="counts">10</span>
                             </a>
                        </li>
                        <li>
                            <a data-toggle="tooltip" data-placement="bottom" title="friend requests">
                                <i class="fa fa-user-plus" aria-hidden="true"></i>
                                <span class="counts">10</span>
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tooltip" data-placement="bottom" title="Notifications">
                                <i class="fa fa-globe" aria-hidden="true"></i>
                                <span class="counts">10</span>
                            </a>
                        </li>
                        <li>
                            <a style="padding: 6px;" class="user-names">
                                <div class="profile-pics" style="background-image: url(profile_pics/user_profile_pic.jpg)" ></div>
                                <span> Username </span>
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
        <div class="container-fluid">
            <div class="container">
                <input style="padding: 8px 20px; border: 1px solid #eee;" placeholder="Activation code" type="text" />
                <button class="btn btn-primary">Activate my account</button>
            </div>
        </div>
      
           <!-- 
    jQuery (necessary for Bootstrap's JavaScript plugins)
    https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js
    -->
    <script src="js/jquery-1.12.4_1.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/log-slides.js"></script>
    </body>
</html>

  <?php
            //print_r($_SESSION['user_info']);
            session_write_close();
            ob_end_flush();
        ?>
        