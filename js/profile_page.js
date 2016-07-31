$(document).ready(function (){
    
    // add new user ... 
    window.add_friend = function (id,elem ,returnd){
         var userId = id  ;
                  var parentOfcurrElement = $(elem);
                  $.ajax({
                      url: "controller/controller_add_friend.php" , 
                        type : "post" ,
                        data : {'userId':$.trim(userId) , 'proccessType':"add_to_mylist"} , 
                        beforeSend : function (){ 
                            $(elem).html ('<div id="floatingCirclesG"><div class="f_circleG" id="frotateG_01"></div><div class="f_circleG" id="frotateG_02"></div><div class="f_circleG" id="frotateG_03"></div><div class="f_circleG" id="frotateG_04"></div><div class="f_circleG" id="frotateG_05"></div><div class="f_circleG" id="frotateG_06"></div><div class="f_circleG" id="frotateG_07"></div><div class="f_circleG" id="frotateG_08"></div></div>Sending request');
                        },
                        success : function (result){
                             var res =  $.trim(result);
                            if(res == 1 ) //<i class="fa fa fa-plus-circle fa-frd"></i>
                                { 
                                    $(elem).html('Friend request sent');
                                    $(elem).css({
                                        'background' : 'teal' ,
                                        'border' : '1px solid teal'
                                    });
                                      parentOfcurrElement.addClass('animated rotateOutUpLeft') ;
                                    setTimeout(function (){
                                        parentOfcurrElement.remove() ;    
                                    } , 1000) ; 
                                    window.location.href= "http://juryofpeers.tv/?user="+returnd ;
                                   
                                }else if (res ==  2 ) {
                                     $(elem).html('you already sent request');
                                 }
                        }
                    });
    }
    
    
    // delete this user from my friend list 
    window.delete_friend = function (id,elem,returnd){
         var userId = id  ;
                  var parentOfcurrElement = $(elem);
                  $.ajax({
                      url: "controller/controller_add_friend.php" , 
                        type : "post" ,
                        data : {'userId':$.trim(userId) , 'proccessType':"delete_from_mylist"} , 
                        beforeSend : function (){ 
                            $(elem).html ('<div id="floatingCirclesG"><div class="f_circleG" id="frotateG_01"></div><div class="f_circleG" id="frotateG_02"></div><div class="f_circleG" id="frotateG_03"></div><div class="f_circleG" id="frotateG_04"></div><div class="f_circleG" id="frotateG_05"></div><div class="f_circleG" id="frotateG_06"></div><div class="f_circleG" id="frotateG_07"></div><div class="f_circleG" id="frotateG_08"></div></div>Deleting .. ');
                        },
                        success : function (result){
                             var res =  $.trim(result);
                            if(res == 1 ) //<i class="fa fa fa-plus-circle fa-frd"></i>
                                { 
                                    $(elem).html('Deleted from your list success');
                                    $(elem).css({
                                        'background' : 'tan' ,
                                        'border' : '1px solid tan' ,
                                        'color' : '#fff'
                                    });
                                      parentOfcurrElement.addClass('animated rotateOutUpLeft') ;
                                    setTimeout(function (){
                                        parentOfcurrElement.remove() ;    
                                    } , 1000) ; 
                                     window.location.href= "http://juryofpeers.tv/?user="+returnd ;
                                }else if (res ==  2 ) {
                                     $(elem).html('your request is deleted .. ');
                                 }
                        }
                    });
    }
    
    
    
    window.commentIn = function (ev , thisdata , postId){
             if(ev.keyCode == 13 )
                 {
                     if(thisdata.value == '' )
                     return false ;
                     var dataStrings =  {
                            'postId':postId ,
                            'comment-text':thisdata.value
                         }
                         console.log(dataStrings);
                     $.ajax({
                         url : 'controller/controller_comment.php' ,
                         data :dataStrings ,
                         type : 'post' ,
                         beforeSend : function () {} ,
                         success :function () {}
                     });
                    
                     $(thisdata).val(null);
                     return false ;
                 }
                
          }
          
          
          window.likePost = function(postId){
              $.ajax({
                  url : "controller/controller_like_dislike.php" , 
                  type : "post" , 
                  data : {
                      'is_like' : 1 , 
                      'post_id' : postId
                  } ,
                  dataType: 'json',
                  cache: false,
                  success : function (respond){
                       $('.countDislikes').html(respond[0]);
                      $('.countlikes').html(respond[1]);
                       
                       if(respond[2] == 1)
                           {
                             
                                $('.likesItem').html ("<span style='color:teal;'><i class='fa fa-thumbs-o-up frt' aria-hidden='true'></i>Liked</span>");
                                $('.disliked_items').html ("<i class='fa fa-thumbs-o-down frt' aria-hidden='true'></i>Dislike");
                           }else  {
                                $('.likesItem').html ("<i class='fa fa-thumbs-o-up frt' aria-hidden='true'></i>Like");
                           }
                     
                  }
              });
          }
          
          window.disLikePost = function(postId){
               $.ajax({
                  url : "controller/controller_like_dislike.php" , 
                  type : "post" , 
                  data : {
                      'is_like' : 0 , 
                      'post_id' : postId
                  } ,
                  dataType: 'json',
                  cache: false,
                  success : function (respond){
                     $('.countDislikes').html(respond[0]);
                      $('.countlikes').html(respond[1]);
                      
                      if(respond[2] == 0)
                           {
                                 $('.likesItem').html ("<i class='fa fa-thumbs-o-up frt' aria-hidden='true'></i>Like");
                                $('.disliked_items').html ("<span style='color:teal;'><i class='fa fa-thumbs-o-down frt' aria-hidden='true'></i>Disliked</span>");
                           }else {
                               $('.disliked_items').html ("<i class='fa fa-thumbs-o-down frt' aria-hidden='true'></i>Dislike");
                           }
                  }
          }); }
      
      $('[data-toggle="tooltip"]').tooltip();
          $(window).scroll(function (){
              var topSc = $(this).scrollTop();
             if(topSc > 70)
                 {
                   $('#header').addClass('animated slideInDown navbar-fixed-top');
                 }else {
                     $('#header').removeClass('animated slideInDown navbar-fixed-top');
                  }
          });
          
          
          
          /****************************************************************/
          /****************  Auto height the textarea   *******************/
          /****************************************************************/
              var textarea = document.querySelector('textarea');
             textarea.addEventListener('keydown', autosize);
             function autosize(){
              var el = this;
              setTimeout(function(){
                el.style.cssText = 'height:auto; padding:0';
                // for box-sizing other than "content-box" use:
                // el.style.cssText = '-moz-box-sizing:content-box';
                el.style.cssText = 'height:' + el.scrollHeight + 'px';
              },0);
            }
            
            
            window.resizeComment = function (elem){
                
                var el = elem;
              setTimeout(function(){
                el.style.cssText = 'height:auto; padding:0';
                // for box-sizing other than "content-box" use:
                // el.style.cssText = '-moz-box-sizing:content-box';
                el.style.cssText = 'height:' + el.scrollHeight + 'px';
                el.style.lineHeight = "15px";
              },0);
            }
          
          
          /****************************************************************/
          /************  Preview image after select from pc   *************/
          /****************************************************************/
           window.readURL = function (input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                     reader.onload = function (e) {
                        $('.img-loadd').attr('src',e.target.result);
                        $('#blah').addClass('etHW');
                        $('#blah').css('display','block');
                    }
                     reader.readAsDataURL(input.files[0]);
                }
            }
            $(".file-img-upload").change(function(){
                readURL(this);
            });
           // event of upload 
          $('.upload-event').click( function (){
              $('.file-img-upload').trigger('click');
          }) ;
          
          $('.upload-event-music').click( function (){
              $('.file-music-upload').trigger('click');
          }) ;
          
           $('.upload-event-video').click( function (){
              $('.file-video-upload').trigger('click');
          }) ;
          
          
          /********************************************************************************/
          /******  Upload-Add image - video - music  after select images via jquery  *****/
          /*******************************************************************************/
          $('.file-img-upload').change(function(){
             $('.file-music-upload').val(null);
                $('.file-included').html('<div class="muisc-masks"></div><div class="music-info mdoo"><ul><li style="background-image: url(music_albums/music_covers/default_music.jpg); " class="img-container img-artist"> </li><li class="info-msc"><h4 class="song-name">Song Name</h4><span class="singer-name"></span></li></ul></div><ul class="file-uploader-menu mdoo"><li><i class="fa fa-music"><span style="padding-left:3px;">-</span></i></i></li><li><div class="fileUpload"><div class="fileprogress"></div></div></li><li><i onclick="return remover_musicfile();"  class="fa fa-remove faremove"></i></li></ul>').css('display','none');  ;

                 
                $('.file-video-upload').val(null);
                $('.file-video-responsed').html('<div class="video text-center"><i class="fa fa-file-video-o"></i></div><div class="scs"><b><span></span><i onclick="return remove_thisvideo();" class="fa fa-remove fa-deletevideo"></i> </b><span></span><div class="progrees-vid"><div class="inprog-video"></div></div></div>').css('display','none')  ;
 
                
                
              $('#blah').html('<img class="img-loadd" /><i onclick="return deleteThisImage();" class="fa fa-close fa-pos"></i><div class="progressbar"><div class="fill-progress"></div></div>');
             // file object 
              var file = document.getElementById('file-img-upload').files[0];
                //alert(file.name+" | "+file.size+" | "+file.type);
               var formdata = new FormData();
              formdata.append("posted_image", file);
              formdata.append("currentProfileId",$('.file-img-upload').attr('user-id'));
               formdata.append("proccessType","ADD_ALBUM_POST");
               var ajax = new XMLHttpRequest();
                // inprogress bar 
               ajax.upload.addEventListener("progress", function (event){
                 
                  $('#butn-add-post').addClass('disabled');
                  var percent = (event.loaded / event.total) * 100;
                   $('.fill-progress').css('width',Math.round(percent)+"%");
                } , false);
              // image upload completed 
              ajax.addEventListener("load", function (event){ 
                 // alert($.trim(event.target.responseText));
                    if($.trim(event.target.responseText) == 1 )
                      { 
                          // show image transparent after uploaded
                          $('.img-loadd').css({
                              'opacity' : '0.8'
                          });
                          $('.fill-progress').attr('isCompleted','1')
                          // allow post button active 
                           $('#butn-add-post').removeClass('disabled');
                      }else {
                          $('#blah').html("<span style='color:red;'>"+$.trim(event.target.responseText)+"</span>")  ;
                         $('.file-img-upload').val(null);
                            $('.file-music-upload').val(null);
                            $('.file-video-upload').val(null);
                      }
                      
              }, false); 
              // finish ajax request
              ajax.open("POST", "controller/controller_timeline_images.php");
              ajax.send(formdata);
          });
         
        
        
         $('.file-music-upload').change(function (){
              $('.file-img-upload').val(null);
                $('#blah').html('<img class="img-loadd" /><i onclick="return deleteThisImage();" class="fa fa-close fa-pos"></i><div class="progressbar"><div class="fill-progress"></div></div>').css('display','none');

                
                $('.file-video-upload').val(null);
                $('.file-video-responsed').html('<div class="video text-center"><i class="fa fa-file-video-o"></i></div><div class="scs"><b><span></span><i onclick="return remove_thisvideo();" class="fa fa-remove fa-deletevideo"></i> </b><span></span><div class="progrees-vid"><div class="inprog-video"></div></div></div>').css('display','none')  ;
                var file = document.getElementById('file-music-upload').files[0];
                 if(file.type =='audio/mpeg' || file.type == "audio/x-mpeg" || file.type == "audio/mp3" || file.type == "audio/x-mp3" || file.type == "audio/mpeg3" || file.type == "audio/mpg" || file.type == "audio/x-mpg" || file.type == "audio/x-mpegaudio"  || file.type == "audio/x-mpeg3" ){
                       $('.file-included').html('<div class="muisc-masks"></div><div class="music-info mdoo"><ul><li style="background-image: url(music_albums/music_covers/default_music.jpg); " class="img-container img-artist"> </li><li class="info-msc"><h4 class="song-name">Song Name</h4><span class="singer-name"></span></li></ul></div><ul class="file-uploader-menu mdoo"><li><i class="fa fa-music"><span style="padding-left:3px;">-</span></i></i></li><li><div class="fileUpload"><div class="fileprogress"></div></div></li><li><i onclick="return remover_musicfile();"  class="fa fa-remove faremove"></i></li></ul>')  ;
                        $('.file-included').css('display', 'block');
                                               
                        // reading mp3 file 
                         var  url = file.urn || file.name;
                          ID3.loadTags(url, function() {
                            var tags = ID3.getAllTags(url);
                                                              
                                                              /* 
                                                               document.getElementById('title').textContent = tags.title || "";
                                                               document.getElementById('artist').textContent = tags.artist || "";
                                                               document.getElementById('album').textContent = tags.album || "";
                                                              */
                                                              var image = tags.picture;
                                                              var base64 = null ;
                                                               if (image) {
                                                                 var base64String = "";
                                                                 for (var i = 0; i < image.data.length; i++) {
                                                                     base64String += String.fromCharCode(image.data[i]);
                                                                 }
                                                                   base64 = "data:" + image.format + ";base64," +
                                                                         window.btoa(base64String);


                                                               //  document.getElementById('picture').setAttribute('src',base64);
                                                               }  
                                                           if( base64   === null )
                                                                base64 = "music_albums/music_covers/default_music.jpg" ;

                                                         $('.file-included').css('background-image','url('+base64+')');
                                                         $('.img-artist').css('background-image','url('+base64+')');
                                                       var  songTitle = tags.title ;
                                                       //alert(songTitle);
                                                       var artisName =  tags.artist ;
                                                        if(tags.title ==null)
                                                             songTitle = 'Undefine song';
                                                       if(tags.artist == null)
                                                           artisName = 'Unknown artist';
                                                         $('.song-name').html(songTitle);
                                                         $('.singer-name').html(artisName);

                                                      // $('#imguoplk').attr('src', base64 );


                                                         var formdata = new FormData();
                                                           formdata.append("posted_image", file);
                                                           formdata.append("file_type", file.type);
                                                           formdata.append("proccessType","ADD_ALBUM_POST");
                                                          formdata.append("currentProfileId",$('#file-music-upload').attr('user-id'));
                                                           formdata.append("artisName",artisName );
                                                           formdata.append("songTitle",songTitle);
                                                             formdata.append("base64",base64);

                                                           var ajax = new XMLHttpRequest();
                                                            // inprogress bar 
                                                         ajax.upload.addEventListener("progress", function (event){

                                                            $('#butn-add-post').addClass('disabled');
                                                            var percent = (event.loaded / event.total) * 100;
                                                             $('.fileprogress').css('width',Math.round(percent)+"%");
                                                          } , false);
                                                          // image upload completed 
                                                        ajax.addEventListener("load", function (event){ 
                                                             console.log(event.target.responseText);
                                                           // alert($.trim(event.target.responseText));
                                                              if($.trim(event.target.responseText) == 1 )
                                                                { 

                                                                    $('.fileprogress').attr('isCompleted','1')
                                                                    // allow post button active 
                                                                     $('#butn-add-post').removeClass('disabled');
                                                                }else {
                                                                    $('.file-included').html("<span style='color:red;'>"+$.trim(event.target.responseText)+"</span>")  ;
                                                                    $('.file-img-upload').val(null);
                                                                    $('.file-music-upload').val(null);
                                                                    $('.file-video-upload').val(null);
                                                                 }



                                                        }, false); 
                                                        // finish ajax request
                                                        ajax.open("POST", "controller/controller_timeline_musics.php");
                                                        ajax.send(formdata);



                                                       }, {
                                                         tags: ["title","artist","album","picture"],
                                                         dataReader: ID3.FileAPIReader(file)
                                                       });                      
                    }else {
                 $('.file-included').html("<span style='color:red;'>This is not audio file , please upload audio with mp3 extension</span>").css('background-image','none').fadeIn()  ;
                   $('.file-img-upload').val(null);
                    $('.file-music-upload').val(null);
                    $('.file-video-upload').val(null);
                 }
                 
         });
         
         // 3- video 
           $('.file-video-upload').change(function (){
                
                $('.file-music-upload').val(null);
                $('.file-included').html('<div class="muisc-masks"></div><div class="music-info mdoo"><ul><li style="background-image: url(music_albums/music_covers/default_music.jpg); " class="img-container img-artist"> </li><li class="info-msc"><h4 class="song-name">Song Name</h4><span class="singer-name"></span></li></ul></div><ul class="file-uploader-menu mdoo"><li><i class="fa fa-music"><span style="padding-left:3px;">-</span></i></i></li><li><div class="fileUpload"><div class="fileprogress"></div></div></li><li><i onclick="return remover_musicfile();"  class="fa fa-remove faremove"></i></li></ul>').css('display','none');  ;

                $('.file-img-upload').val(null);
                $('#blah').html('<img class="img-loadd" /><i onclick="return deleteThisImage();" class="fa fa-close fa-pos"></i><div class="progressbar"><div class="fill-progress"></div></div>').css('display','none');

                 
                
                 var file = document.getElementById('file-video-upload').files[0];
                   if(file.type =='video/mov' || file.type == "video/mp4" || file.type == "video/3gp" || file.type == "video/ogg"){
                       var fileName = file.name.substring(0, file.name.indexOf('.'));
                       var FileSize = file.size ;
                        $('.file-video-responsed').html('<div class="video text-center"><i class="fa fa-file-video-o"></i></div><div class="scs"><b><span></span><i onclick="return remove_thisvideo();" class="fa fa-remove fa-deletevideo"></i> </b><span></span><div class="progrees-vid"><div class="inprog-video"></div></div></div>')  ;
                        $('.file-video-responsed').css('display', 'block');
                        $('.scs > b > span').html(fileName);
                        $('.scs > span').html(Math.round((file.size/1024)/1024) + " Mb");
                        var formdata = new FormData();
                        formdata.append("proccessType", "ADD_ALBUM_POST");
                        formdata.append("posted_video", file);
                        formdata.append("videoTitle", fileName );
                        formdata.append("currentProfileId",$('#file-video-upload').attr('user-id'));
                        formdata.append("videoSize", FileSize );
                        var ajax = new XMLHttpRequest();
                        // inprogress bar 
                        ajax.upload.addEventListener("progress", function (event){
                          
                        $('#butn-add-post').addClass('disabled');
                        var percent = (event.loaded / event.total) * 100;
                        $('.inprog-video').css('width',Math.round(percent)+"%");
                        } , false);
                        // image upload completed 
                        ajax.addEventListener("load", function (event){ 
                        // alert($.trim(event.target.responseText));
                        if($.trim(event.target.responseText) == 1 )
                        { 
                         $('.inprog-video').attr('isCompleted','1')
                         // allow post button active 
                         $('#butn-add-post').removeClass('disabled');
                         }else {
                         $('.file-video-responsed').html("<span style='color:red;font-size: 12px;'>"+$.trim(event.target.responseText)+"</span>")  ;
                         $('.file-img-upload').val(null);
                         $('.file-music-upload').val(null);
                         $('.file-video-upload').val(null);
                         }}, false);  
                          ajax.open("POST", "controller/controller_timeline_video.php");
                          ajax.send(formdata);
                   }else {
                            $('.file-video-responsed').html("<span style='color:red;font-size: 12px;'>This is not video file , please upload video with mp4 or 3gp or ogg or mov type</span>").css('background-image','none').fadeIn()  ;
                            $('.file-img-upload').val(null);
                            $('.file-music-upload').val(null);
                            $('.file-video-upload').val(null);
                        }
           });
           
           
           /****************************************************************/
          /*******************  Delete image that addedd  *****************/
          /****************************************************************/
          // 1- photo
          window.deleteThisImage = function (){
                    $('.file-img-upload').val(null);
                    $('.file-music-upload').val(null);
                    $('.file-img-upload').val(null);
                // delete the latest image that stored in database by this user 
               $.ajax({
                   url : 'controller/controller_timeline_images.php' ,
                   type : 'POST' , 
                   data :{"proccessType":"DELETE_ALBUM_POST"} , 
                   success : function (response){
                      // alert(response);
                        var isDeleted = $.trim(response);
                       if(isDeleted == 1)
                            {
                                // delete image from this node insid post 
                                $('#blah').html(null)  ;
                                $('#blah').append('<img class="img-loadd" /><i onclick="return deleteThisImage();" class="fa fa-close fa-pos"></i><div class="progressbar"><div class="fill-progress"></div></div>');
                            }
                    }
               });
               $('.file-img-upload').val(null);
                    $('.file-music-upload').val(null);
                    $('.file-video-upload').val(null);
             }
          // 2- music
           window.remover_musicfile = function (){
            $('.file-img-upload').val(null);
                    $('.file-music-upload').val(null);
                    $('.file-img-upload').val(null);
                // delete the latest image that stored in database by this user 
               $.ajax({
                   url : 'controller/controller_timeline_musics.php' ,
                   type : 'POST' , 
                   data :{"proccessType":"DELETE_ALBUM_POST"} , 
                   success : function (response){
                      // alert(response);
                        var isDeleted = $.trim(response);
                       if(isDeleted == 1)
                            {
                                $('.file-included').css('display','none');
                                // delete image from this node insid post 
                                $('.file-included').html('<div class="muisc-masks"></div><div class="music-info mdoo"><ul><li style="background-image: url(music_albums/music_covers/default_music.jpg); " class="img-container img-artist"> </li><li class="info-msc"><h4 class="song-name">Song Name</h4><span class="singer-name"></span></li></ul></div><ul class="file-uploader-menu mdoo"><li><i class="fa fa-music"><span style="padding-left:3px;">-</span></i></i></li><li><div class="fileUpload"><div class="fileprogress"></div></div></li><li><i onclick="return remover_musicfile();"  class="fa fa-remove faremove"></i></li></ul>');
                             }
                    }
               });
               $('.file-img-upload').val(null);
                    $('.file-music-upload').val(null);
                    $('.file-video-upload').val(null);
             }
           // 3- video 
           window.remove_thisvideo = function () {
                   
                $.ajax({
                        url : 'controller/controller_timeline_video.php' ,
                        type : 'POST' , 
                        data :{"proccessType":"DELETE_ALBUM_POST"} , 
                        success : function (response){
                           // alert(response);
                             var isDeleted = $.trim(response);
                            if(isDeleted == 1)
                                 {
                                     $('.file-video-responsed').css('display','none');
                                     // delete image from this node insid post 
                                     $('.file-video-responsed').html('<div class="video text-center"><i class="fa fa-file-video-o"></i></div><div class="scs"><b><span></span><i onclick="return remove_thisvideo();" class="fa fa-remove fa-deletevideo"></i> </b><span></span><div class="progrees-vid"><div class="inprog-video"></div></div></div>')  ;
                                  }
                         }
                    });
                    $('.file-img-upload').val(null);
                    $('.file-music-upload').val(null);
                    $('.file-video-upload').val(null);
           }  
             
            /****************************************************************/
          /***************  Add new post (text with ) img vid mus  ********/
          /****************************************************************/
           
           window.postStatus = function (paragraph , accessPremission , postedWith , id_user){
                // in this case will be text only 
               if(postedWith == '' )
                   {
                       if(paragraph != '' )
                           {    
                               $.ajax({
                                   url : 'controller/controller_timeline_status.php' ,
                                   type : 'post' ,
                                   data : {
                                       'is_shared' : '1' ,
                                       'accessPremission' :accessPremission  , 
                                       'status' : paragraph  ,
                                       'accessType' : 'share_status',
                                       'currentProfileId': id_user
                                   } ,
                                   success : function (responsed){
                                      
                                   }
                               });
                           }
                           
                           
                      $('#text-area').val(null);    
                    $('.file-img-upload').val(null);
                    $('.file-music-upload').val(null);
                    $('.file-video-upload').val(null);
                    
                    $('#blah').html('<img class="img-loadd" /><i onclick="return deleteThisImage();" class="fa fa-close fa-pos"></i><div class="progressbar"><div class="fill-progress"></div></div>').css('display','none')  ; 
                    $('.file-included').html('<div class="muisc-masks"></div><div class="music-info mdoo"><ul><li style="background-image: url(music_albums/music_covers/default_music.jpg); " class="img-container img-artist"> </li><li class="info-msc"><h4 class="song-name">Song Name</h4><span class="singer-name"></span></li></ul></div><ul class="file-uploader-menu mdoo"><li><i class="fa fa-music"><span style="padding-left:3px;">-</span></i></i></li><li><div class="fileUpload"><div class="fileprogress"></div></div></li><li><i onclick="return remover_musicfile();"  class="fa fa-remove faremove"></i></li></ul>').css('display','none')  ; 
                    $('.file-video-responsed').html('<div class="video text-center"><i class="fa fa-file-video-o"></i></div><div class="scs"><b><span></span><i onclick="return remove_thisvideo();" class="fa fa-remove fa-deletevideo"></i> </b><span></span><div class="progrees-vid"><div class="inprog-video"></div></div></div>').css('display','none')  ;
                   
                        return false ;
                        
                   }
                   
                   // in this case will be found attachement 
                   var statusParagraph = '' ;
                    if(paragraph != '' )
                         statusParagraph = paragraph ;
                    
                    $.ajax({
                         url : 'controller/controller_timeline_status.php' ,
                         type : 'post' ,
                         data : {
                         'is_shared' : '1' ,
                         'accessPremission' :accessPremission  , 
                         'status' : statusParagraph  ,
                         'accessType' : 'share_atachments' , 
                         'attachmentType' : postedWith ,
                          'currentProfileId': id_user
                         } ,
                         success : function (responsed){
                         
                         } 
                    });
                    
                    $('#text-area').val(null);    
                    $('.file-img-upload').val(null);
                    $('.file-music-upload').val(null);
                    $('.file-video-upload').val(null);
                    
                    $('#blah').html('<img class="img-loadd" /><i onclick="return deleteThisImage();" class="fa fa-close fa-pos"></i><div class="progressbar"><div class="fill-progress"></div></div>').css('display','none')  ; 
                    $('.file-included').html('<div class="muisc-masks"></div><div class="music-info mdoo"><ul><li style="background-image: url(music_albums/music_covers/default_music.jpg); " class="img-container img-artist"> </li><li class="info-msc"><h4 class="song-name">Song Name</h4><span class="singer-name"></span></li></ul></div><ul class="file-uploader-menu mdoo"><li><i class="fa fa-music"><span style="padding-left:3px;">-</span></i></i></li><li><div class="fileUpload"><div class="fileprogress"></div></div></li><li><i onclick="return remover_musicfile();"  class="fa fa-remove faremove"></i></li></ul>').css('display','none')  ; 
                    $('.file-video-responsed').html('<div class="video text-center"><i class="fa fa-file-video-o"></i></div><div class="scs"><b><span></span><i onclick="return remove_thisvideo();" class="fa fa-remove fa-deletevideo"></i> </b><span></span><div class="progrees-vid"><div class="inprog-video"></div></div></div>').css('display','none')  ;
                   
           }
           
           
           
            $('#butn-add-post').click(function(){
                var texts = $('#text-area').val() ;
                var accessPremissions = $('#accessPrem').val() ;
                 // check if is there an image 
                 if($('.file-img-upload').val() != '' ){
                          postStatus(texts,accessPremissions,'img',$('#file-img-upload').attr('user-id'));
                         return false ;
                     }else if ($('.file-music-upload').val() != ''){
                          postStatus(texts,accessPremissions,'mus',$('#file-music-upload').attr('user-id'));
                         return false ;
                     }else if ($('.file-video-upload').val() != ''){
                          postStatus(texts,accessPremissions,'vid',$('#file-img-upload').attr('user-id'));
                        return false ;
                     } 
                     postStatus(texts,accessPremissions,'',$('#file-img-upload').attr('user-id'));  
                  });
});