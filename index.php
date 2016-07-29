<?php   
  $file = dirname(__FILE__)."/access_modifiers/protected_access.php";
  if(is_file($file)) require_once $file  ;
   
  $user_name = $_SESSION['user_info']['user_name'] ;
  if(isset($_GET['user']))
    $user_name  = $_GET['user'] ; 
  
  $user_apis = new user_applications() ;
  $usrInfo = $user_apis ->user_application_check_exist(['u_name'=>$user_name]);
  if($usrInfo != NULL )
  {     
      // 4 - 8 => only me 
      /*
      $app_apis = new user_get_more_pagination_package_pst() ;
      $last_id  = 0 ;
      $limit  = 100 ;
      $me_or_asAvisitor = 8 ;
      $appss = $app_apis->load_posts_according_to_args( $last_id ,$limit , $me_or_asAvisitor );
       */
      ?>
      <!DOCTYPE html> 
        <html>
            <head>
                <title><?php echo $usrInfo->f_name ." ".$usrInfo->s_name;?></title>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                <link href='https://fonts.googleapis.com/css?family=PT+Serif:400,400italic,700,700italic&subset=latin-ext' rel='stylesheet' type='text/css'>
                <link href="css/bootstrap.min.css" rel="stylesheet">
                <link href="css/animate.css" rel="stylesheet">
                <link href="css/header.css" rel="stylesheet">
                <link rel="stylesheet" href="css/font-awesome.css">
                <link href="css/profile.css" rel="stylesheet">
                <script type="text/javascript" src="js/id3-minimized.js"></script>         
                <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
                <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
                <!--[if lt IE 9]>
                 <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
                 <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
                <![endif]-->
                <style>
                    .frt.fa {
                       margin-right: 5px;
                    }
                </style>
            </head>
            <body>
                <!-- --------------------------------------- -->
                <!-- ------      Header      --------------- -->
                <!-- --------------------------------------- -->
                <?php 
                    $headerFile = dirname(__FILE__)."/includes/header.php";
                    if(is_file($headerFile ))  require_once $headerFile ;
                ?>
                
            </body>
        </html>
      <?php
  }else  
      header('location: home');
 ?>

 