<?php
    $file = dirname(__FILE__)."/access_modifiers/protected_access.php";
    if(is_file($file )) require_once $file  ;
    // user name get 
    $username = $_SESSION['user_info']['user_name'];
    if(isset($_GET['user'])){
        $username = $_GET['user'];
    }
    // album id 
    $album_id = NULL ;
    if(isset($_GET['album'])){
        $album_id = $_GET['album'];
    }
    $userApis = new user_applications() ;
    $userInfo = $userApis ->user_application_check_exist(['u_name'=>$username]);
        if($userInfo == NULL )
      header('location: login');
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

	<!--jQuery-->
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/simple-slider.min.js"></script>
        <script src="js/nice_scrollbar.js"></script>
        <script src="js/jquery.raty.js"></script>
	<script type="text/javascript" src="js/jquery.filer.min.js?v=1.0.5"></script>
        <script type="text/javascript" src="js/photo_cont.js"></script>
        <script type="text/javascript" src="js/uploadphoto.js"></script>
	<!--[if IE]>
          <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        
         <link href="css/animate.css" rel="stylesheet">
         <link href="css/header.css" rel="stylesheet">
         <link rel="stylesheet" href="css/font-awesome.css">
         <link rel="stylesheet" href="css/jquery.raty.css">
         <link href="css/profile.css" rel="stylesheet">
         <link href="css/music.css" rel="stylesheet">
         <link href="scss/loadincss.css" rel="stylesheet">
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
                    <!-- Music Uploads will be hid -->
                    <div class="containerAlbums">
                        
                        
                        <!-- Get Albums --> 
                        <div class="GetALlAlbums">
                            <h3 class="photoAlb">Photo Albums</h3>
                            <div class="loadAlbumsHere">
                            <!-- Upload --> 
                            <div class="mmGabesd mmphoto">
                                <span class="titlsUploads">
                                    <i class="fa fa-image"></i>
                                    <br />
                                    Upload Albums or mp4 file
                                 </span>
                            </div>
                            
                            <?php 
                            
                                 $albumApis = new albums_photos_get_more_pagination_package();
                                  $albumsExist =  $albumApis->albums_of_photo_load_more(0 , 5 , $userInfo->id); 
                                  if(count($albumsExist) != 0)
                                    {
                                            $album = $albumApis->albums_of_photo_load_more(0 , 5 , $userInfo->id); 
                                             if(is_array($album)  ){
                                           for($i=0;$i<count($album);$i++){
                                               $images = new images_applications();
                                               $img = $images->images_applications_get_by_values([
                                                   'album_id'=>$album[$i]->id
                                               ],'and');
                                            
                                               
                                               if(count($img)!= 0 ){
                                                   
                                                  ?>
                                                    <div onclick="openThisAlbum(<?php echo $album[$i]->id ?> , this , '<?php if(trim($album[$i]->album_name) =='timeline' )   echo 'timeline/' ; else NULL ?>'  );" style="background-image: url(photo_albums/<?php if(trim($album[$i]->album_name) =='timeline' )   echo 'timeline/';  ; ?><?php echo $img[count($img)-1]->img_src ; ?>);" class="mmphoto albums">
                                                        <div class="mask-image">
                                                            <b class="titlenames">
                                                              <?php echo ucfirst( $album[$i]->album_name ) ; ?>  
                                                            </b>
                                                         </div> 
                                                    </div>
                                                  <?php  
                                                  $lastId = $album[$i]->id ;
                                               }
                                               
                                           }}
                                     } 
                            ?>
                                <input class="lastIdForm" type="hidden" value="<?php echo $lastId ; ?>" />
                            </div>
                            
                             <div class="loadmore" onclick="return loadMorephotoAlbums(<?php echo $userInfo->id ; ?>,this);">Load more</div>
                        </div>
                         
                        
                        
                         <!-- Upload Music --> 
                       <div style="display: none;" class="containerUpload">
                              <input class="mmuploads" type="file" name="files[]" id="filer_input2" multiple="multiple">
                       </div>
                    </div> 
                   
                 </div>
                 <div class="col-xs-12 col-md-2 sidebar-outer"> 
                </div>
            </div>
        </section>
        
        
        
        
        
      
   
    </body>
</html>
