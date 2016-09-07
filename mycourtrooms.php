<?php
    $file = dirname(__FILE__)."/access_modifiers/protected_access.php";
    if(is_file($file )) require_once $file  ;
     
    ?>
<!DOCTYPE html>
<html>
    <head>
        <title>User profile</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
         <!-- Fonts -->
         <link href='https://fonts.googleapis.com/css?family=PT+Serif:400,400italic,700,700italic&subset=latin-ext' rel='stylesheet' type='text/css'>
         <!-- Bootstrap -->
         <link href="css/bootstrap.min.css" rel="stylesheet">
          
         <link href="css/animate.css" rel="stylesheet">
         <link href="css/header.css" rel="stylesheet">
         <link rel="stylesheet" href="css/font-awesome.css">
         <link rel="stylesheet" href="css/jquery.raty.css">
         <link href="css/profile.css" rel="stylesheet">
         <link href="css/music.css" rel="stylesheet">
         <link href="css/emu.css" rel="stylesheet">
          <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
         <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
         <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
         <![endif]-->
    </head>
    <body onload="notifications();">
        
        <!-- --------------------------------------------------------------- -->
        <!-- ---------------------      background   ----------------------- -->
        <!-- --------------------------------------------------------------- -->
        
        
        <!-- --------------------------------------------------------------- -->
        <!-- ---------------------      Header      ------------------------ -->
        <!-- --------------------------------------------------------------- -->
         <?php 
            $headerFile = dirname(__FILE__)."/includes/header.php";
            if(is_file($headerFile ))  require_once $headerFile ;
        ?>
        <!-- --------------------------------------------------------------- -->
        <!-- ---------------------      Contents   ------------------------ -->
        <!-- --------------------------------------------------------------- -->
        <section class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-md-2 sidebar-outer">
                     <?php 
                        $sidebarFile = dirname(__FILE__)."/includes/sidebar.php";
                        if(is_file($sidebarFile ))  require_once $sidebarFile ;
                    ?>
                </div>
                <div class="col-xs-12 col-md-10 profile-content">
                    <h3 class="mainIt">
                        My Courtrooms
                    </h3>
                    <?php
                        $courApis = new courtroom_init_applications() ;
                        $courts = $courApis->courtroom_init_apis_get_all("WHERE plaintiff_id=".$_SESSION['user_info']['user_id']." OR defedant_id=".$_SESSION['user_info']['user_id']);
                        if(count($courts)!=0){
                            for($i=0;$i<count($courts);$i++){
                            ?>
                                <a href="courtroom?code=<?php echo $courts[$i]->courtroom_code;?>" class="mainIt">
                                   <b>
                                       <?php echo $courts[$i]->court_title; ?>
                                   </b>
                                   <span> With
                                       <?php
                                        $who = NULL ;
                                        if( $courts[$i]->plaintiff_id == $_SESSION['user_info']['user_id']){
                                            {$u = $courts[$i]->defedant_id ; $who = "defendant"; }
                                        }else 
                                             {$u = $courts[$i]->plaintiff_id ; $who = "plaintiff"; }
                                        echo $who .' : ' ;
                                        $userApps = new user_applications() ;
                                        $usersInfo = $userApps ->user_application_check_exist(['id'=>$u]);
                                        if($usersInfo != NULL )
                                            echo $usersInfo->f_name .' '.$usersInfo->s_name . " ( ".$usersInfo->u_name." ) " ;
                                       ?>
                                   </span>
                                </a>  
                                
                           <?php
                            }
                        }
                     ?>
                   
                </div>
        </section>
      
        <!-- --------------------------------------------------------------- -->
        <!-- ---------------------      Footer      ------------------------ -->
        <!-- --------------------------------------------------------------- -->
        
    <script src="js/jquery-1.12.4.js"></script>
     <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/simple-slider.min.js"></script>
    <script src="js/nice_scrollbar.js"></script>
    <script src="js/jquery.raty.js"></script>
    
    </body>
</html>
