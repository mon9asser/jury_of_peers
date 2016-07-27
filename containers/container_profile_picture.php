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
        <form class="AjaxForm" method="post"  enctype="multipart/form-data" >
                        <div class="uploadImageController">
                                      <div id="img-settings" class="img-settings default slim" 
                                            data-ratio="4:4"
                                            data-service="server/async.php"
                                            data-size="600,100"
                                            data-label="Drop your avatar here Or click here to upload image"
                                             data-button-edit-label="<i class='fa fa-cog'></i>"
                                            data-button-edit-title="Edit">
                                            <input type="file" name="slim[]">
                                       </div>
                                
                            </div>


                             <div class="uploadImageController">
                                <div class="xx container-btns">
                                     <div class="fill-progress-ppicx text-center">
                                        <div class="fill-progress-ppic">
                                            <b>Chose your image then wait while progress complete</b><div class="progress-filler"><div class="color-fill"></div></div>
                                         </div>
                                     </div>
                                </div>
                            </div>
            <input type="hidden" name="proccessType" value="ADD_ALBUM_PROFILE_PICTURE" />
                <div class="next-save text-right">
                    <a class="savebtn btnskip">Skip this step</a>
                    <button type="submit" class="savebtn">Save & Next</button>
                 </div> 
            </form>
         </div>
   
</div>