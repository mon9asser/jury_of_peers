<div class="row">
    <div class="col-xs-12 col-md-2 sidebar-outer">
        <?php 
            $sidebarFile = dirname(__FILE__)."/../includes/sidebar.php";
            if(is_file($sidebarFile ))  require_once $sidebarFile ;
        ?>
     </div>
    <div class="col-xs-12 col-md-8 profile-content">
        <div class="pp-headlins">
            Profile picture
        </div>
        <div class="clearFix"></div>
        <table>
            <tr>
                <td>
                    <div class="post-controls profimge">
                            <div id="img-settings" class="img-settings default">
                                <img id="profile-image" class="img-responsive img-profile-pic-change" src="../photo_albums/profile_picture/female_avatar.jpg" />
                            </div>
                        </div>
                </td>
                <td>
                    <div class="uploadImageController">
                        <div class="xx">
                            <input id="upload-image-profile-pic" style="" type="file" />
                            <div class="fill-progress-ppic text-center"></div>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
        
    </div>
</div>