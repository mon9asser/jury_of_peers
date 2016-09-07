<?php
    $file = dirname(__FILE__)."/access_modifiers/protected_access.php";
    if(is_file($file )) require_once $file  ;
    
      $file = dirname(__FILE__)."/modular/autoload_apps.php";
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
         <link href="css/bootstrap.min.css" rel="stylesheet">
         <link href="css/s_music.css"rel="stylesheet" type="text/css" />
        
         <link href="css/simple-slider.css" rel="stylesheet" type="text/css" />
         <link href="css/simple-slider-volume.css" rel="stylesheet" type="text/css" />  
         
         
         <!--Stylesheets-->
	<link href="css/jquery.filer.css" type="text/css" rel="stylesheet" />
	<link href="css/themes/jquery.filer-dragdropbox-theme.css" type="text/css" rel="stylesheet" />

	
	<!--[if IE]>
          <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        
         <link href="css/animate.css" rel="stylesheet">
         <link href="css/header.css" rel="stylesheet">
         <link rel="stylesheet" href="css/font-awesome.css">
         <link rel="stylesheet" href="css/jquery.raty.css">
         <link href="css/profile.css" rel="stylesheet">
         <link rel="stylesheet" href="css/fontello.css"> 
          <link href="css/music.css" rel="stylesheet">
          <link href="scss/loadincss.css" rel="stylesheet">
         <link rel="stylesheet" href="scss/dfddfdf.css"> 
         <link href="css/emu.css" rel="stylesheet">
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
         </style>
          <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
         <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
         <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
         <![endif]-->
    </head>
    <body onload="notifications();">
         <!-- --------------------------------------------------------------- -->
        <!-- ---------------------      Header      ------------------------ -->
        <!-- --------------------------------------------------------------- -->
         <?php 
            $headerFile = dirname(__FILE__)."/includes/header.php";
            if(is_file($headerFile ))  require_once $headerFile ;
        ?>
        <!-- End header banner here -->
        <section class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-md-2 sidebar-outer">
                    <?php 
                        $sidebarFile = dirname(__FILE__)."/includes/sidebar.php";
                        if(is_file($sidebarFile ))  require_once $sidebarFile ;
                    ?>
                </div>
                <div class="col-xs-12 col-md-8 profile-content">
                     <div class="homePostContainer ldMore">
                         <ul class="navbar-navs">
                             <li>
                                 <a onclick="gotonewfeeds(this)" href-data="http://feeds.bbci.co.uk/news/rss.xml">BBC News</a>
                             </li>
                             <li>
                                 <a onclick="gotonewfeeds(this)"  href-data="http://rss.msnbc.msn.com/id/3032091/device/rss/rss.xml">NBC News</a>
                             </li>
                              <li>
                                 <a onclick="gotonewfeeds(this)"  href-data="http://news.google.com/news?ned=us&topic=h&output=rss">Google News</a>
                             </li>
                             
                             <li>
                                 <a onclick="gotonewfeeds(this)"  href-data="ttp://www.cbc.ca/cmlink/rss-world">CBC News</a>
                             </li>
                             <li>
                                 <a onclick="gotonewfeeds(this)"  href-data="http://feeds.reuters.com/reuters/topNews">Reuters News</a>
                             </li>
                             <li>
                                 <a onclick="gotonewfeeds(this)"  href-data="http://feeds.bbci.co.uk/news/rss.xml">BBCI News</a>
                             </li>
                          </ul>
                    </div>
                    
                    <div style="overflow: hidden; position: relative;" class="mainResponseContainer">
                        <!-- Default rss -->
                        
                         <ul class="">
                        <?php
                            $xml = ("http://feeds.bbci.co.uk/news/rss.xml");
                            
                            $xmlDoc = new DOMDocument();
                            $xmlDoc->load($xml);
                            $xmlDoc = new DOMDocument();
                                $xmlDoc->load($xml);

                                //get elements from "<channel>"
                                $channel=$xmlDoc->getElementsByTagName('channel')->item(0);
                                $channel_title = $channel->getElementsByTagName('title')
                                ->item(0)->childNodes->item(0)->nodeValue;
                                $channel_link = $channel->getElementsByTagName('link')
                                ->item(0)->childNodes->item(0)->nodeValue;
                                $channel_desc = $channel->getElementsByTagName('description')
                                ->item(0)->childNodes->item(0)->nodeValue;

                                //output elements from "<channel>"
                               /* echo("<p><a href='" . $channel_link
                                  . "'>" . $channel_title . "</a>");
                                echo("<br>");
                                echo($channel_desc . "</p>");
                                        */
                                //get and output "<item>" elements
                                $x=$xmlDoc->getElementsByTagName('item');
                                for ($i=0; $i<=12; $i++) {
                                  $item_title=$x->item($i)->getElementsByTagName('title')
                                  ->item(0)->childNodes->item(0)->nodeValue;
                                  $item_link=$x->item($i)->getElementsByTagName('link')
                                  ->item(0)->childNodes->item(0)->nodeValue;
                                  $item_desc=$x->item($i)->getElementsByTagName('description')
                                  ->item(0)->childNodes->item(0)->nodeValue;
                                  ?>
                                  <li>
                                      <?php
                                            echo ("<p><a href='" . $item_link
                                            . "'>" . $item_title . "</a>");
                                            echo ("<br>");
                                            echo ($item_desc . "</p>");
                                    ?>
                                  </li>
                                  <?php
                                  
                                }

                        ?>
                        
                             
                         </ul>
                    </div>
                
                </div>
        </section>
        
        
        
        
      <!--jQuery-->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
         <script>
            $(document).ready(function(){
              window.gotonewfeeds =  function  (_ele){
                    var url = $(_ele).attr('href-data');
                    var targetContainer = $('.mainResponseContainer') ;
                     $.ajax({
                     url : 'controller/controller_news.php' ,
                    data : {'newsUrl':url} ,
                    type : 'post' ,
                    beforeSend : function () {
                        var loading = '<div style="top:0px;bottom: 0px;right: 0px;left: 0px; position: absolute;background-color:rgba(250,250,250,0.9);z-index: 2000;"><div style="position: absolute;width: 120px;height: 14px;margin: 19px auto;left: 0px;right: 0px;top: 40%;bottom: 0px;"  id="fountainG"><div id="fountainG_1" class="fountainG"></div><div id="fountainG_2" class="fountainG"></div><div id="fountainG_3" class="fountainG"></div><div id="fountainG_4" class="fountainG"></div><div id="fountainG_5" class="fountainG"></div><div id="fountainG_6" class="fountainG"></div><div id="fountainG_7" class="fountainG"></div><div id="fountainG_8" class="fountainG"></div></div></div>';
                         targetContainer.append(loading).fadeIn();
                    } ,
                    success :function (responsedData) {
                        targetContainer.html(responsedData);
                     } 
                        });
                }
            });
        </script>
    </body>
</html>
