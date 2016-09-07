<?php
    
 $files = dirname(__FILE__)."/../../modular/autoload_apps.php";
 if(is_file($files )) require_once $files  ;
  


?>

<div class="mmMainApps">
                <h4>Create a New App ID</h4>
                <p id="mainError">
                    Get started integrating Juryofpeers into your app 
                </p>
            </div>
            <div class="mmMainApps">
                <div class="mmMainApps">
                    <b>Display Name</b>
                    <input placeholder="Application Name" type="text" id="appName" />
                </div>
                <div class="mmMainApps">
                    <b style="width: auto; float: left;line-height: 3.6;">http://apps.juryofpeers.tv/?n=</b>
                    <input style="width: 50%; float: left" placeholder="Ex: AppName" type="text" id="userNameApp" />
                </div>
                <div class="mmMainApps">
                    <b style="width: auto; float: left;line-height: 3.6;">Website URL</b>
                    <input style="width: 70%; float: left" placeholder="Ex: www.Example.com/app_page_name" type="text" id="webSiteUrl" />
                </div>
                <div class="mmMainApps">
                    <b>Thumbnail Image</b>
                    <input type="file" id="appThumbnails" />
                </div>
                 <div class="mmMainApps"> 
                    <b>App Details</b>
                    <textarea id="applicationInfo" placeholder="Application Info"></textarea>
                </div>
                
                 <div class="mmMainApps"> 
                    <b>Application Type or Category</b>
                    <select id="appCategory">
                        <?php
                        $applicationTypeApis = new app_typ_applications();
                        ?>
                        <?php
                        $appType = $applicationTypeApis->app_typ_application_apis_get_all();    
                        for($i=0; $i<count($appType) ; $i++ ){
                            ?>
                             <option value="<?php echo $appType[$i]->id;?>"><?php echo $appType[$i]->app_type_name;?></option>                                
                            <?php
                        }
                        ?>
                       
                    </select>
                </div>
                <div class="mmMainApps text-right"> 
                    <a onclick="close(this);" style="
                        border: 0px;
                        border-radius: 0px;
                        padding: 6px 10px;
                        margin-top: 12px;
                       " class="btn btn-danger" href="#close-modal" rel="modal:close">Cancel</a>
                       
                       <a onclick="createCredentialApp(this);" style="
                        border: 0px;
                        border-radius: 0px;
                        padding: 6px 10px;
                        margin-top: 12px;
                       " class="btn btn-success">Create App ID</a>
                </div>
            </div>



<script>
    window.close = function (it) {
        $('#ex7').fadeOut();
    }
     window.createCredentialApp = function (thisElement){
                  var appName = document.getElementById('appName').value;
                  var appThumbnails  = $('#appThumbnails').get(0).files[0] ;
           
                  var applicationInfo = document.getElementById('applicationInfo').value;
                  var appCategory  = document.getElementById('appCategory').value;
                  var userNameApp = document.getElementById('userNameApp').value;
                  var webSiteUrl  = document.getElementById('webSiteUrl').value;
                  
                  var formData = new FormData();
                  formData.append('appName', appName  ) ;
                  formData.append('appThumbnails', appThumbnails  ) ;
                   formData.append('applicationInfo', applicationInfo  ) ;
                  formData.append('appCategory', appCategory  ) ;
                  formData.append('userNameApp', userNameApp  ) ;
                  formData.append('webSiteUrl', webSiteUrl  ) ;
                  formData.append('AccType', 'add_app'  ) ;
                  
                  /*{
                            'appName'         : appName     ,
                            'appThumbnails'   : appThumbnails,
                            'appCoverImage'   : appCoverImage,
                            'applicationInfo' : applicationInfo,
                            'appCategory'     : appCategory,
                            'userNameApp'     : userNameApp ,
                            'AccType'         : 'add_app'
                        }*/
                  $.ajax({
                        url : 'controller/controller_add_new_app.php' ,
                        type:'post' , 
                        data : formData ,
                        cache:false,
                        contentType: false,
                        processData: false,
                        beforeSend : function (){
                             var loading = '<div class="loadingRR" style="top:0px;bottom: 0px;right: 0px;left: 0px; position: absolute;background-color:rgba(250,250,250,0.9);z-index: 2000;"><div style="position: absolute;width: 120px;height: 14px;margin: 19px auto;left: 0px;right: 0px;top: 45%;bottom: 0px;"  id="fountainG"><div id="fountainG_1" class="fountainG"></div><div id="fountainG_2" class="fountainG"></div><div id="fountainG_3" class="fountainG"></div><div id="fountainG_4" class="fountainG"></div><div id="fountainG_5" class="fountainG"></div><div id="fountainG_6" class="fountainG"></div><div id="fountainG_7" class="fountainG"></div><div id="fountainG_8" class="fountainG"></div></div></div>';
                            $('#ex7').append(loading);
                        },
                        success:function (response){
                            console.log(response);
                             if($.trim(response) == 1){
                                 $('#ex7').html(response);
                             }else if ($.trim(response) == 404){
                                 $('#userNameApp').css({
                                     border:'1px solid red'
                                 });
                                 $('#mainError').css({
                                        width:'100%',
                                        display:'block',
                                        textAlign:'center',
                                        color : 'red' ,
                                        fontWeight: 'bold',
                                        border:'1px solid red',
                                        padding:'3px 10px'
                                    });
                                  $('#mainError').html('App url name no valid !');
                             }else if($.trim(response) == 204) {
                                 $('.loadingRR').remove();
                                   $('#mainError').html('All Fields are required');
                                    $('#mainError').css({
                                        width:'100%',
                                        display:'block',
                                        textAlign:'center',
                                        color : 'red' ,
                                        fontWeight: 'bold',
                                        border:'1px solid red',
                                        padding:'3px 10px'
                                    });
                             }else {
                                 $('#ex7').html(response);
                             }
                         }
                    });
                }
</script>