<?php
  $file = dirname(__FILE__)."/access_modifiers/protected_access.php";
  if(is_file($file)) require_once $file  ;
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
         <link href="css/simple-slider.css" rel="stylesheet" type="text/css" />
         <link href="css/simple-slider-volume.css" rel="stylesheet" type="text/css" />  
         <link href="css/profile.css" rel="stylesheet">
           
         <link href="slim/slim.min.css" rel="stylesheet"> 
         <link href="css/complete.css" rel="stylesheet"> 
         
          <style>
                .slim {
                  width: 400px;
                  height: auto;
                }
               .slim-popover {
                    background-color:rgba(0,0,0,0.5);
                }

                .slim-image-editor-btn {
                    color:#999;
                }

                .slim-image-editor-btn:focus,
                .slim-image-editor-btn:hover {
                    color:#777;
                }

                .slim-image-editor-preview::after {
                    background-color: rgba(0, 0, 0, 0.8);
                }
                .slim-image-editor .slim-btn-group button {
                    border-radius: 0px;
                    border: 1px solid #dfdfdf;
                    background: #eee;
                    color: #222;
                }
                
            </style>
         <script src="js/is_mobile.js"></script>
         <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
         <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
         <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
         <![endif]-->
         
    </head>
    <body>
        <!-- --------------------------------------- -->
        <!-- ------      Header      --------------- -->
        <!-- --------------------------------------- -->
        <?php 
            $headerFile = dirname(__FILE__)."/includes/header.php";
            if(is_file($headerFile ))  require_once $headerFile ;
        ?>
        <!-- End header banner here -->
        
     
        <!-- Load container inside this div -->
         <div id="Loaded" class="homePageLoder dataContainer container-fluid"> 
            <!-- Load pages here -->
            <?php
               $file = dirname(__FILE__)."/containers/container_profile_picture.php" ;
               if(is_file($file )) require_once $file;
            ?> 
         </div>
         
    <script src="js/jquery-1.12.4_1.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main_app.js"></script>
    <script src="js/profile_picture.js"></script>
    <script src="slim/slim.jquery.js"></script>
     <script src="slim/slim.kickstart.js"></script>
         
</html>