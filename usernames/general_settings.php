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
         <link href="../css/bootstrap.min.css" rel="stylesheet">
         <link href="../css/animate.css" rel="stylesheet">
         <link href="../css/header.css" rel="stylesheet">
         <link rel="stylesheet" href="../css/font-awesome.css">
          <link href="../css/simple-slider.css" rel="stylesheet" type="text/css" />
         <link href="../css/simple-slider-volume.css" rel="stylesheet" type="text/css" />  
         <link href="../css/profile.css" rel="stylesheet">
         <link href="../css/complete.css" rel="stylesheet">
         
         
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
            $headerFile = dirname(__FILE__)."/../includes/header.php";
            if(is_file($headerFile ))  require_once $headerFile ;
        ?>
        
        
        <!-- --------------------------------------- -->
        <!-- ------      Container   --------------- -->
        <!-- --------------------------------------- -->
        <section class="container-fluid">
            <div class="row">
                <!-- --------------------------------------- -->
                <!-- ------      Sidebar   --------------- -->
                <!-- --------------------------------------- -->
                <div class="col-xs-12 col-md-2 sidebar-outer">
                    <?php 
                        $sidebarFile = dirname(__FILE__)."/../includes/sidebar.php";
                        if(is_file($sidebarFile ))  require_once $sidebarFile ;
                    ?>
		</div>
                <!-- ------------------------------------------- -->
                <!-- ------------   Column  1  ---------------- -->
                <!-- ------------------------------------------- -->
                <div class="col-xs-12 col-md-8 profile-content">
                    <div class="post-controls">
                        <h2 class="compl-headline">
                           General Setting
                        </h2>                        
                    </div>
                    <div class="control-btn general-btn buttons">
                        <h5>Write anything about your self . </h5>
                    </div>
                     <div class="control-btn general-btn buttons">
                        <h5>Write anything about your self . </h5>
                    </div>
                     <div class="control-btn general-btn buttons">
                        <h5>Write anything about your self . </h5>
                    </div>
                     <div class="control-btn general-btn buttons">
                        <h5>Write anything about your self . </h5>
                    </div>
                     <div class="control-btn general-btn buttons">
                        <h5>Write anything about your self . </h5>
                    </div>
                     <div class="control-btn general-btn buttons">
                        <h5>Write anything about your self . </h5>
                    </div>
                    <div class="control-btn general-btn">
                        <button id="saveThenNext">Save & Next</button>
                        <button id="skip">Skip </button>
                    </div>
                </div>
         
            </div>
        </section>
        
        
        
    <script src="../js/jquery-1.12.4_1.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/simple-slider.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
           $('[data-toggle="tooltip"]').tooltip();
          $(window).scroll(function (){
              var topSc = $(this).scrollTop();
             if(topSc > 70)
                 {
                   $('#header').addClass('animated slideInDown navbar-fixed-top');
                 }else {
                     $('#header').removeClass('animated slideInDown navbar-fixed-top');
                  }
             });

        
        });
        
        
         
       
    </script>
    </body>
</html>