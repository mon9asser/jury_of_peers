    <?php
        $file = dirname(__FILE__)."/../access_modifiers/protected_access.php";
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
             <link href="../css/bootstrap.min.css" rel="stylesheet">

             <link href="../css/animate.css" rel="stylesheet">
             <link href="../css/header.css" rel="stylesheet">
             <link rel="stylesheet" href="../css/font-awesome.css">
             <link rel="stylesheet" href="../css/jquery.raty.css">
             <link href="../css/profile.css" rel="stylesheet">
             <link href="../css/music.css" rel="stylesheet">
             <link href="../css/emu.css" rel="stylesheet">
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
                        <div class="mainAppContainer">
                            <h3>
                                <i class="icon-th-4"></i>
                                My applications
                            </h3>
                            
                            
                            
                            
                            
                            
                            
                            <?php
                                $files = dirname(__FILE__).
                                        "/modular/autoload_apps.php";
                                if(is_file($files )) require_once $files  ;
                            ?>
                            
                            
                            
                            <?php
                                $app_file_logs = new my_apps_login() ;
                                $pps = new app_s_program();
                                
                                $user_logs = $app_file_logs->my_apps_login_get_by_values(['user_id_logged'=>$_SESSION['user_info']['user_id']], 'and');
                                for ($i=0; $i < count($user_logs);$i++){
                                    $appInfo = $pps->app_s_check_exist(['id'=>$user_logs[$i]->app_id,'app_type'=>0]);
                                    if($appInfo != NULL ){
                                    ?>  
                                     <div class="AppStore">
                                        <div class="imagAppContainers">
                                            <?php
                                                if($appInfo->app_type == 1 ){ 
                                            ?>
                                            <i onclick="remve_thisApp(<?php echo $user_logs[$i]->id ; ?> , this )" class="fa fa-remove" style="float: right;"></i>
                                            <?php
                                                }
                                            ?>
                                            
                                            <center>
                                                <img class="img-responsive imgs" src="app_files/app_images/<?php echo $appInfo->app_thumbnails ; ?>" />
                                            </center>
                                         </div>
                                         <div class="imagAppContainer">
                                             <b><?php echo $appInfo->app_name ; ?></b>
                                         </div>
                                     </div>
                                    <?php
                                    }
                                }
                            ?>
                           
                            
                            
                            
                            
                            
                            
                            
                            
                            <?php
                                $app_file_logs = new my_apps_login() ;
                                $pps = new app_s_program();
                                
                                $user_logs = $app_file_logs->my_apps_login_get_by_values(['user_id_logged'=>$_SESSION['user_info']['user_id']], 'and');
                                for ($i=0; $i < count($user_logs);$i++){
                                    $appInfo = $pps->app_s_check_exist(['id'=>$user_logs[$i]->app_id,'app_type'=>1]);
                                    if($appInfo != NULL ){
                                    ?>  
                                     <div class="AppStore">
                                        <div class="imagAppContainers">
                                            <?php
                                                if($appInfo->app_type == 1 ){ 
                                            ?>
                                            <i onclick="remve_thisApp(<?php echo $user_logs[$i]->id ; ?> , this )" class="fa fa-remove" style="float: right;"></i>
                                            <?php
                                                }
                                            ?>
                                            
                                            <center>
                                                <img class="img-responsive imgs" src="developers/images/<?php echo $appInfo->app_thumbnails ; ?>" />
                                            </center>
                                         </div>
                                         <div class="imagAppContainer">
                                             <b><?php echo $appInfo->app_name ; ?></b>
                                         </div>
                                     </div>
                                    <?php
                                    }
                                }
                            ?>
                           
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                        </div>
                    </div>
            </section>

            <!-- --------------------------------------------------------------- -->
            <!-- ---------------------      Footer      ------------------------ -->
            <!-- --------------------------------------------------------------- -->

        <script src="../js/jquery-1.12.4.js"></script>
         <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/simple-slider.min.js"></script>
        <script src="../js/nice_scrollbar.js"></script> 
        <script src="../js/jquery.raty.js"></script>
        <script>
            window.remve_thisApp = function (id,_this){
                $.ajax({
                    url : 'controller/controller_delete_app.php' ,
                    data : {'app_log_id': id} ,
                    type : 'post' , 
                    beforeSend: function (){
                        
                    } , 
                    success: function (response){
                        console.log(response);
                        if($.trim(response)==1)
                            $(_this).parent('.imagAppContainers').parent('.AppStore').remove();
                    }
                });
            }
        </script>
        </body>
    </html>
