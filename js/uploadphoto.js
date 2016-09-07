 $(document).ready(function(){
     /*
     window.saveShareOrOnly = function (  _this){
         // 0 => save only 
         // 1 => save and share 
         var albumeCover = document.getElementById('image-albume-cover').files[0];
        var selectCustom = document.getElementById('accessPrem').value ;
         var albumTitle = $('.albumTitleNameH') ;
          
         if(albumTitle.val() == '' || document.getElementById('image-albume-cover').files.length == 0 )
             {
                 alert('Pleas Fill all Info required , Album cover image and Album Name .. ');
                 return false ;
             }
             
            var formdata = new FormData();
            formdata.append("albumeCover", albumeCover);
            formdata.append("albumTitle", albumTitle.val());
            formdata.append("typeFFFF", $(_this).attr('typical'));
            formdata.append("selectCustom", selectCustom);
           
            $(_this).html('Saving info ... ');
            var ajax = new XMLHttpRequest();
                // inprogress bar 
               ajax.upload.addEventListener("progress", function (event){
                  
                } , false);
                 ajax.addEventListener("load", function (event){ 
                     console.log (event.target.responseText);
                  if( $.trim(event.target.responseText ) == 1 ){
                 
                 if($(_this).attr('typical') == 'n' )
                      $(_this).html('Save Only');
                  else if ($(_this).attr('typical') == 'y')
                       $(_this).html('Save and Share');
                   window.location.href = "musics" ;
                      }else 
                          {
                              alert("There are an error , Plaes tray later");
                          }
              }, false); 
              // finish ajax request
              ajax.open("POST", "controller/controller_albume_video_upload.php");
              ajax.send(formdata);
          
         
     }
     
     */
     
     
     //imgAlbumName
     
     /*
     window.saveShareOrOnlyvideo = function (_this) {
         
      
          var CategoryVideo = document.getElementById('CategoryVideo').value;
        var nameOfGroup = document.getElementById('nameOfGroup').value ;
           alert(CategoryVideo +' --- ' + nameOfGroup);
          
         if(CategoryVideo == '' || nameOfGroup=='' ) 
             {
                 alert('Pleas Fill all Info required ');
                 return false ;
             }
             $.ajax({
               url : 'controller/controller_albume_update_video.php' , 
               type : 'post' ,
               data : {
                   'nameOfGroup':nameOfGroup  ,
                   'CategoryVideo':CategoryVideo ,
                   'typeFFFF':$(_this).attr('typical')
               } ,
               beforeSend : function () {
                   $(_this).html('Saving info ... ');
               } ,
               success : function (responsed){
                   console.log(responsed);
                  if($.trim(responsed) == 1 )
                      window.location.href = 'video';
               }
           });
      }
       */
       window.loadMorephotoAlbums = function (user_id , _this){
           var lastId = $('.lastIdForm:last-child').val();
          
          if(lastId != ''){
               $.ajax({
                     type : 'post' ,
                    data : {
                        'user_id':user_id    ,
                        'lastId' : lastId
                     } ,
                     url : 'controller/controller_load_more_photo_albums.php',
                    beforeSend : function () {  
                        $(_this).html('<div id="circularG"><div id="circularG_1" class="circularG"></div><div id="circularG_2" class="circularG"></div><div id="circularG_3" class="circularG"></div><div id="circularG_4" class="circularG"></div><div id="circularG_5" class="circularG"></div><div id="circularG_6" class="circularG"></div><div id="circularG_7" class="circularG"></div><div id="circularG_8" class="circularG"></div></div>');
                    } ,
                    success : function (responsed){
                       
                             if($.trim(responsed) == 1 )
                                 {
                                    $(_this).removeAttr('onclick');
                                    $(_this).html("There are no Albums else .");
                                     return false ;
                                 }
                            $('.loadAlbumsHere').append(responsed) ;
                            $(_this).html("Load More");
                    }
                });
          }else {
              $(_this).removeAttr('onclick');
              $(_this).html("There are an errors , try later .");
          }
    
      }
      
      
      
      
      window.openThisImage = function ( imgId , folder , __this ) {
            $.ajax({
                    type : 'get' ,
                    data : {
                        'imgId':imgId   ,
                        'folder':folder
                      } ,
                     url : 'controller/controller_image.php',
                    beforeSend : function () {  
                         $(__this).find('.mask-image').children('.titlenames').html('<div id="circularG"><div id="circularG_1" class="circularG"></div><div id="circularG_2" class="circularG"></div><div id="circularG_3" class="circularG"></div><div id="circularG_4" class="circularG"></div><div id="circularG_5" class="circularG"></div><div id="circularG_6" class="circularG"></div><div id="circularG_7" class="circularG"></div><div id="circularG_8" class="circularG"></div></div>');
                    } ,
                    success : function (responsed){
                        $('.GetALlAlbums').addClass('animated bounceOutUp');
                       
                        setTimeout(function(){
                            $('.GetALlAlbums').removeClass('animated bounceOutUp');
                             $('.GetALlAlbums').html(responsed);
                             $('.GetALlAlbums').addClass('animated bounceInDown');
                           //$(_this).parent('.GetALlAlbums').fadeOut();
                        } ,1000 );
                          
                    }
                });
      }
      window.openThisAlbum = function (albumId,_this , folder ){
          
               $.ajax({
                    type : 'get' ,
                    data : {
                        'album':albumId   ,
                        'folder':folder
                      } ,
                     url : 'controller/controller_images_of_albums.php',
                    beforeSend : function () {  
                        $(_this).find('.mask-image').children('.titlenames').css( {
                             marginTop  : '39%' ,
                            opacity: '0.6' 
                        });
                        $(_this).find('.mask-image').children('.titlenames').html('<div id="circularG"><div id="circularG_1" class="circularG"></div><div id="circularG_2" class="circularG"></div><div id="circularG_3" class="circularG"></div><div id="circularG_4" class="circularG"></div><div id="circularG_5" class="circularG"></div><div id="circularG_6" class="circularG"></div><div id="circularG_7" class="circularG"></div><div id="circularG_8" class="circularG"></div></div>');
                    } ,
                    success : function (responsed){
                        $('.GetALlAlbums').addClass('animated bounceOutLeft');
                       
                        setTimeout(function(){
                            $('.GetALlAlbums').removeClass('animated bounceOutLeft');
                             $('.GetALlAlbums').html(responsed);
                             $('.GetALlAlbums').addClass('animated bounceInRight');
                           //$(_this).parent('.GetALlAlbums').fadeOut();
                        } ,1000 );
                          
                    }
                });
         
      }
      
      window.saveShareOrOnlyimg= function (_this){
            var imgAlbumName = document.getElementById('imgAlbumName').value;
        
         
          
         if(imgAlbumName == ''   ) 
             {
                 alert('Pleas Fill all Info required ');
                 return false ;
             }
             $.ajax({
               url : 'controller/controller_albume_update_image.php' , 
               type : 'post' ,
               data : {
                   'imgAlbumName':imgAlbumName    ,
                   'preview-img-access' : $('#accessPrem').val()
                } ,
               beforeSend : function () {
                   $(_this).html('Saving info ... ');
               } ,
               success : function (responsed){
                   console.log(responsed);
                  if($.trim(responsed) == 1 )
                      window.location.href = 'photo';
               }
           });
      }
      
      
      
     
 });