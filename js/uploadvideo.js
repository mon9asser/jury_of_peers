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
     
     
     
     window.saveShareOrOnlyvideo = function (_this) {
         
      
          var CategoryVideo = document.getElementById('CategoryVideo').value;
        var nameOfGroup = document.getElementById('nameOfGroup').value ;
         //  alert(CategoryVideo +' --- ' + nameOfGroup);
          
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
       
 });