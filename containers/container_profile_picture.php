<div class="row">
    <div class="col-xs-12 col-md-2 sidebar-outer">
        <?php 
            $sidebarFile = dirname(__FILE__)."/../includes/sidebar.php";
            if(is_file($sidebarFile ))  require_once $sidebarFile ;
            
            $file_all = dirname(__FILE__)."/../modular/autoload_apps.php";
            if(is_file($file_all ))  require_once $file_all ;
            
            
             $profilePic = dirname(__FILE__)."/../photo_albums/profile_picture/profile_picture.php";
            if(is_file($profilePic ))  require_once $profilePic  ;
        ?>
     </div>
    <div class="col-xs-12 col-md-8 profile-content">
        <div class="pp-headlins">
            Profile picture
        </div>
        <div class="clearFix"></div>
       
                    <div class="post-controls profimge">
                            <div id="img-settings" class="img-settings default">
                                <img id="profile-image" class="img-responsive img-profile-pic-change" src="../photo_albums/profile_picture/<?php echo checkProfileExists($_SESSION['user_info']['user_id']); ?>" />
                            </div>
                    </div>
               
                    <div class="uploadImageController">
                        <div class="xx container-btns">
                            
                             <input id="upload-image-profile-pic" style="" type="file" />
                            <div class="fill-progress-ppic text-center">
                                <b>Chose your image then wait while progress complete</b><div class="progress-filler"><div class="color-fill"></div></div>
                            </div>
                        </div>
                    </div>
                  
    </div>
   
   
</div>