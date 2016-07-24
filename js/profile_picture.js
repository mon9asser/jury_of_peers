 $(document).ready(function(){
      // upload image 
        $('.uploadimage').click(function (){
            $("#upload-image-profile-pic").trigger('click');
        });
        $("#upload-image-profile-pic").change(function (){
             $('.fill-progress-ppic').html('<b>Please wait while progress complete...</b><div class="progress-filler"><div class="color-fill"></div></div>');
             $('.img-profile-pic-change').css('opacity','0.2');
            readURL(this);
             var file = document.getElementById('upload-image-profile-pic').files[0];
             var formdata = new FormData();
             var mainWidthHieghtBg =  $('#profile-image').width();
              var position_y_x =  $('#img-settings').width();
             formdata.append("photo_w_h", mainWidthHieghtBg);
             formdata.append("position_y_x", position_y_x);
             formdata.append("profile_picture", file);
                formdata.append("proccessType","ADD_ALBUM_PROFILE_PICTURE");
                var ajax = new XMLHttpRequest();
               
                // inprogress bar 
               ajax.upload.addEventListener("progress", function (event){
                    var percent = (event.loaded / event.total) * 100;
                   $('.color-fill').css('width',Math.round(percent)+"%");
                } , false);
                ajax.addEventListener("load", function (event){ 
                
                   if($.trim(event.target.responseText) == 1 )
                      { 
                          
                          $('.fill-progress-ppic').html("<b style='color:green'>Profile Picture Saved</b>");
                          $('.img-profile-pic-change').css('opacity','1');
                          
                          // crop image 
                            
                        }else {
                           $('.fill-progress-ppic').html("<span class='errorDisplayed'>There are an errors in uploading , please try again</span>");
                       }
               }, false); 
              ajax.open("POST", "controller/controller_profile_picture.php");
              ajax.send(formdata);
        });
         // preview image. 
        window.readURL = function (input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                     reader.onload = function (e) {
                         $('.img-profile-pic-change').attr('src',e.target.result);
                      }
           reader.readAsDataURL(input.files[0]);
                }
            }
            
            
            
        // cropping this image 
         $('#profile-image').imgAreaSelect({  aspectRatio: '1:1', handles: true , onSelectChange:function (img , selection ){
                var x1 =  selection.x1 ;  
                var y1 = selection.y1 ;
                var x2 = selection.x2 ;
                var y2 = selection.y2 ;
                var width_new = selection.width ;
                var height_new = selection.height ;
          }});
            
 });

