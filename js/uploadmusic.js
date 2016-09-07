 $(document).ready(function(){
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
                 console.log(event.target.responseText);
                 if( $.trim(event.target.responseText ) == 1 ){
                 
                 if($(_this).attr('typical') == 'n' )
                      $(_this).html('Save Only');
                  else if ($(_this).attr('typical') == 'y')
                       $(_this).html('Save and Share');
                   window.location.href = "albums" ;
                      }else 
                          {
                              alert("There are an error , Plaes tray later");
                          }
              }, false); 
              // finish ajax request
              ajax.open("POST", "controller/controller_albume_update_info.php");
              ajax.send(formdata);
            
         /*
          * 
          *  var file = document.getElementById('file-img-upload').files[0];
                //alert(file.name+" | "+file.size+" | "+file.type);
               var formdata = new FormData();
          */
         
     }
 });