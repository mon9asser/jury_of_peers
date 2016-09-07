<?php
ob_start(); 
 session_start () ;
ini_set("session.cookie_domain", ".juryofpeers.tv"); 
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 
 if(!isset($_SESSION['user_info']))
{
    header('location: http://juryofpeers.tv/login');
    exit(1);
}  





      $file = dirname(__FILE__)."/../modular/autoload_apps.php";
    if(is_file($file )) require_once $file  ;
    
    // user name get 
    $username = $_SESSION['user_info']['user_name'];
    
  
    
    $userApis = new user_applications() ;
    $userInfo = $userApis ->user_application_check_exist(['u_name'=>$username]);
        if($userInfo == NULL )
      header('location: login');
        
              ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!--
    Web designed by : Montasser Mossallem
    skype Name : moun2030
    up_work : url->  http://www.upwork.com/o/profiles/users/_~01943d20d212eecc03
-->
<!DOCTYPE html>
<html>
    <head>
        <title>User profile</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
         <!-- Fonts -->
         <link href='https://fonts.googleapis.com/css?family=PT+Serif:400,400italic,700,700italic&subset=latin-ext' rel='stylesheet' type='text/css'>
         <!-- Bootstrap -->
         <link href="http://juryofpeers.tv/css/bootstrap.min.css" rel="stylesheet">
         <link href="http://juryofpeers.tv/css/s_music.css"rel="stylesheet" type="text/css" />
        
         <link href="http://juryofpeers.tv/css/simple-slider.css" rel="stylesheet" type="text/css" />
         <link href="http://juryofpeers.tv/css/simple-slider-volume.css" rel="stylesheet" type="text/css" />  
         
         
         <!--Stylesheets-->
	<link href="http://juryofpeers.tv/css/jquery.filer.css" type="text/css" rel="stylesheet" />
	<link href="http://juryofpeers.tv/css/themes/jquery.filer-dragdropbox-theme.css" type="text/css" rel="stylesheet" />

	
	<!--[if IE]>
          <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        
         <link href="http://juryofpeers.tv/css/animate.css" rel="stylesheet">
         <link href="http://juryofpeers.tv/css/header.css" rel="stylesheet">
         <link rel="stylesheet" href="http://juryofpeers.tv/css/font-awesome.css">
         <link rel="stylesheet" href="http://juryofpeers.tv/css/jquery.raty.css">
         <link href="http://juryofpeers.tv/css/profile.css" rel="stylesheet">
         <link rel="stylesheet" href="http://juryofpeers.tv/css/fontello.css"> 
          <link href="http://juryofpeers.tv/css/music.css" rel="stylesheet">
          <link href="http://juryofpeers.tv/scss/loadincss.css" rel="stylesheet">
         <link rel="stylesheet" href="http://juryofpeers.tv/scss/dfddfdf.css"> 
         <link rel="stylesheet" href="http://juryofpeers.tv/css/fontello.css"> 
        <script type="text/javascript" src="http://juryofpeers.tv/js/main_applications.js"></script>
        <link rel="stylesheet" href="http://juryofpeers.tv/scss/dfddfdf.css"> 
        <link rel="stylesheet" href="http://juryofpeers.tv/css/headers.css"> 
         <link href="http://juryofpeers.tv/css/emu.css" rel="stylesheet">
         <!--jQuery-->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="http://juryofpeers.tv/js/bootstrap.min.js"></script>
         <link rel="stylesheet" href="http://juryofpeers.tv/css/jquery.modal.min.css" type="text/css" media="screen" />
        <script src="http://juryofpeers.tv/js/jquery.modal.min.js"></script>
        
         
         <style>
             .modal {
                display: none;
              }
            .mainAps {
                width: 450px;
                overflow: hidden ;
                margin: 0px auto ;
                display: block;
                background: red;
                height: auto;
                z-index: 25252;
            }
        </style>
         <style>
             .homePostContainer {
                width: 95.4%;
                margin-bottom: 12px;
                 box-shadow: 0px 0px 5px 0px #999;
                border-radius: 0px;
                float: left;
            }
            .navbar-navs {
                list-style: none; 
                display: block ;
                overflow: hidden ;
            }
            .navbar-navs li {
                display: inline-block ;
            }
            .navbar-navs li a {
                padding: 5px 10px;
                display: block;
                cursor: pointer ;
            }
            .mainResponseContainer {
                    width: 95%;
                    display: block;
                    overflow: hidden;
                    margin: 0px auto;
                }
                .mmmmu {
                    display: inline-block;
                      margin: 0px auto;
                      overflow: hidden ;
                    list-style: none;
                }
                .mmmmu li {
                    display: inline-block ;
                     text-align: center;
                   margin: 40px;
                }   
                .mmmmu li a {
                    font-size: 18px;
                    display: block;
                }
                #lean_overlay {
                    position: fixed;
                    z-index:100;
                    top: 0px;
                    left: 0px;
                    height:100%;
                    width:100%;
                    background: #000;
                    display: none;
                }
         </style>
          <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
         <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
         <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
         <![endif]-->
    </head>
    <body style="">
        
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
                            
                            .blocker {
                                z-index: 5;
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
                                  <?php
                                $files = dirname(__FILE__).
                                        "/../modular/autoload_apps.php";
                                if(is_file($files )) require_once $files  ;
                            ?>
                            
                            
                            
                            <?php
                                $ppsApis = new app_s_program() ;
                                $applications =$ppsApis->app_s_get_by_values([ 'user_id'=>$_SESSION['user_info']['user_id'] , 'app_type'=>1 ], 'and');
                            ?>
                                  <?php
                                    if(count($applications) == 0 ){
                                         ?>
                                         
                                                 <b style="color: tomato; width: 100%;  ">
                                                     <center> There are no Apps </center>
                                                 </b>
                                              
                                        <?php
                                    }
                                  ?>
                                  <?php for($i=0;$i<count($applications);$i++){
                                      ?>
                                         <li>
                                              <a style="padding-left: 5px;" >
                                                   <img width="25px;" src="app_files/<?php echo $applications[$i]->app_thumbnails;?>" />
                                                   <b>
                                                       <?php echo $applications[$i]->app_name;?>
                                                   </b>
                                               </a>
                                         </li>
                                       <?php
                                  }?>
                                 
                                  <li role="separator" class="divider"></li>
                                  <li><a rel="leanModal" href="#ex7">Add new app</a></li>
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
        
          
        
        <style>
            .mmMainApps{
                width: 100%;
                display: block;
                overflow: hidden ;
                padding: 0px;
                margin: 0px;
            }
            input , textarea , select {
                width: 97%;
                padding: 5px;
                border: 1px solid #dfdfdf;
                resize: none;
                margin: 10px;
            }
        </style>
        <div id="ex7" style="
                top: 5%;
                margin: 0px auto;
                opacity: 1;
                 bottom: unset;
                position: absolute;
                overflow: initial;
                width: 500px; 
                padding: 15px 20px;
                border-radius: 0px;
                overflow: hidden;
                min-height: 100px;
             " class="modal">
            <!-- Load pages here -->
       </div>
        
        
        <div class="container text-center">
             <p class="" style="font-size: 17px;color: #555; ">
                 Start to design your application page according to our category , Games or Business and Book
             </p>
        </div>
        <div style="  background-size: cover ;
            background-repeat: no-repeat ;
            background-position: center center ;
            position: relative;
            display: block;
            min-height: 350px;
            margin-top: 0px;
            background-attachment: fixed ;
            background-image: url(images/bg.jpg);" class="container-fluid">
            <div class="mask-image"></div>
            <center>
                <h1 style="line-height: 350px;color: #fff;position: relative;z-index: 2;">Build, grow and monetize your apps with Jury of peers</h1>
            </center>
         </div>
        
        <div class="container text-center">
           <p style="font-size: 17px;color: #555; padding: 50px;">
                Integrating your website or web app with Juryofpeers makes it more social. From simple features such as Games , book , Business , to real identity through Juryofpeers Login, the Juryofpeers platform provides the tools you need to design your apps as you like !
            </p>
             
            <ul class="mmmmu">
                <li>
                    <img style="width: 70%; display: inline-block; overflow: hidden; margin: 0px auto;" class="img-responsive" src="images/book-app.png" />
                    <br />
                    <h3>Book</h3>
                </li>
                <li>
                   <img style="width: 70%; display: inline-block; overflow: hidden; margin: 0px auto;" class="img-responsive" src="images/businness-app.png" />
                    <br />
                    <h3>Business</h3>
                </li>
                <li>
                    <img style="width: 70%; display: inline-block; overflow: hidden; margin: 0px auto;" class="img-responsive" src="images/games-app.png" />
                    <br />
                    <h3>Games</h3>
                </li>
            </ul>
             
        </div>
        
        <script>
            $(document).ready(function(){
                 $('a[href="#ex7"]').click(function(event) {
                    event.preventDefault();
                    $(this).modal({
                      fadeDuration: 250 
                    });
                    $.ajax({
                        url : 'include/create_app_credential_id.php' ,
                        type:'post' , 
                         beforeSend : function (){
                            var loadding = null ;
                            $('#ex7').html(loadding);
                             var loading = '<div style="top:0px;bottom: 0px;right: 0px;left: 0px; position: absolute;background-color:rgba(250,250,250,0.9);z-index: 2000;"><div style="position: absolute;width: 120px;height: 14px;margin: 19px auto;left: 0px;right: 0px;top: 30%;bottom: 0px;"  id="fountainG"><div id="fountainG_1" class="fountainG"></div><div id="fountainG_2" class="fountainG"></div><div id="fountainG_3" class="fountainG"></div><div id="fountainG_4" class="fountainG"></div><div id="fountainG_5" class="fountainG"></div><div id="fountainG_6" class="fountainG"></div><div id="fountainG_7" class="fountainG"></div><div id="fountainG_8" class="fountainG"></div></div></div>';
                            $('#ex7').html(loading);
                        },
                        success:function (response){
                            $('#ex7').html(response);
                        }
                    });
                  });
                  
                  
             
               
            });
        </script>
    </body>
</html>
