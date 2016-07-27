  $(document).ready(function(){
     
  });
  /*
   $('form.AjaxForm').on('submit',  function() {    
         $.ajax({
            url     : $(this).attr('action'),
            type    : $(this).attr('method'),
             data    : $(this).serialize(),
            success : function( data ) {
                         console.log(data);
              },
            error   : function( xhr, err ) {
             }
        });    
        return false;
    });
    */
 // upload image 
       /* $('.uploadimage').click(function (){
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
                          
                            $('.is_enabled').css({
                                height : $('#thmb-image').height()+'px',
                                 width : $('#thmb-image').width()+'px'
                            });
                          $('.windows8').css('margin-top','25%');
                          $('.fill-progress-ppic').html("<b style='color:green'>Profile Picture Saved</b>");
                          $('.img-profile-pic-change').css('opacity','1');
                          
                          // cropping this image 
                            
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
          // value to crop image or prifle picture 
           function savePosition (img , selection ){
                 $("#x1").val(selection.x1);
                $("#y1").val(selection.y1);
                $("#x2").val(selection.x2);
                $("#y2").val(selection.y2);
                $("#w").val(selection.width);
                $("#h").val(selection.height);
               $('#img-height').val(img.height);
               $('#img-width').val(img.width);
          }
       $('.is_enabled').css({
           height : $('#thmb-image').height()+'px',
            width : $('#thmb-image').width()+'px'
       });
        $('.windows8').css('margin-top','25%');
        $('#profile-image').imgAreaSelect({   x1: 120, y1: 90, x2: 280, y2: 210 , aspectRatio: '1:1' , handles: true , onSelectChange:savePosition });
          //crop_and_saveimage 
          window.crop_and_saveimage = function (_this){
              var x1 =   $("#x1").val();
              var y1 =   $("#y1").val();
              var x2 =   $("#x2").val();
              var y2 =  $("#y2").val();
              var width_ =   $("#w").val();
              var height_ =   $("#h").val();
              var imgHeight  =   $("#img-height").val();
              var imgWidth  =   $("#img-width").val();
             // alert(' x1 :- '+ x1 +' y1 :- ' +y1+ ' x2 :- '+ x2 +' y2 :- ' +y2+ ' width :- '+ width_+' imgWidth = '+imgWidth+ ' height :- '+ height_+ ' imgHeight =  '+imgHeight)
              if(x1 == '' || imgHeight =='' || imgWidth =='' || y1 == '' || x2 == '' || y2 == '' || width_  == '' || height_ == ''  ||width_ == 0 || height_ == 0 )
                    {
                      // save image as uploaded and transfeer user 
                    }else 
                       { 
                           var dataImageString = {
                                  'x1' :x1 ,
                                  'y1' :y1 ,
                                  'x2': x2 , 
                                  'y2':  y2 ,
                                  'width_':width_ ,
                                  'height_': height_  ,
                                  'imgHeight' :imgHeight,
                                  'imgWidth':imgWidth,
                                  'proccessType':'croping_image'
                           }
                            $.ajax({
                               url : 'controller/controller_profile_picture.php' ,
                               type : 'post' , 
                               data : dataImageString ,
                               beforeSend : function (){
                                   $('.is_enabled').fadeIn();
                               },
                               success :function (respons){ //photo_albums/profile_picture
                                    $('.is_enabled').fadeOut();
                                    $('#thmb-image').attr('src','photo_albums/profile_picture/'+$.trim(respons));
                               }
                           });
                       }
                   
               //  window.location.href = "home" ;
          }*/
 

