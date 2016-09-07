$(document).ready(function(){
     $(".notificationList").niceScroll({
              cursorwidth: "6px",
              cursorborder:'0px',
              cursorborderradius:'0px',
              cursorcolor:"#dfdfdf"
          });
          
    window.resize_post_textarea = function (elem){
                var textLive = $(elem).val();
               
                if(new RegExp("([a-zA-Z0-9]+://)?([a-zA-Z0-9_]+:[a-zA-Z0-9_]+@)?([a-zA-Z0-9.-]+\\.[A-Za-z]{2,4})(:[0-9]+)?(/.*)?").test(textLive)) {
                        
                        if($.trim ($('.file-link-responsed').html()).length == 0){ 
                            // response and send here 
                            $.ajax({
                                    url : "controller/controller_extract_links_topreview.php" , 
                                    type : "post" , 
                                    data : {'url-links':textLive} ,
                                      beforeSend : function (){
                                        var loading = '<div id="fountainG"><div id="fountainG_1" class="fountainG"></div><div id="fountainG_2" class="fountainG"></div><div id="fountainG_3" class="fountainG"></div><div id="fountainG_4" class="fountainG"></div><div id="fountainG_5" class="fountainG"></div><div id="fountainG_6" class="fountainG"></div><div id="fountainG_7" class="fountainG"></div><div id="fountainG_8" class="fountainG"></div></div>';
                                        $('.file-link-responsed').html('<center>'+loading+'</center>');
                                    } ,
                                    success :function (respond){
                                        $('.file-link-responsed').html (respond);
                                    }
                            });
                           // $('.file-link-responsed').html('Hello Link ?');
                             
                        }
                           
                    }
               // tag system 
            /* if(textLive.split('@')[1]){
                
                
                    $.ajax({
                        url : "controller/controller_tag_get.php" , 
                        type : "post" , 
                        data : {'url-links':textLive} ,
                        beforeSend : function (){
                        var loading = '<div id="fountainG"><div id="fountainG_1" class="fountainG"></div><div id="fountainG_2" class="fountainG"></div><div id="fountainG_3" class="fountainG"></div><div id="fountainG_4" class="fountainG"></div><div id="fountainG_5" class="fountainG"></div><div id="fountainG_6" class="fountainG"></div><div id="fountainG_7" class="fountainG"></div><div id="fountainG_8" class="fountainG"></div></div>';
                        $('.file-link-responsed').html('<center>'+loading+'</center>');
                        } ,
                        success :function (respond){
                        $('.file-link-responsed').html (respond);
                        } 
                 });
                 
             }*/




                $('.sharPost').attr('id', 'onsho');
               if($('input[type="file"]').val() == '' )
                   {
                       $('.sharPost').attr('id', 'butn-add-post');
                       $('.sharPost').attr('onclick', 'share_status()');
                   }else {
                       if($(elem).val() == '')
                        $('.sharPost').attr('id', 'onsho');
                    $('.sharPost').removeAttr('onclick');
                   }
           var el = elem;
              setTimeout(function(){
                el.style.cssText = 'height:auto; padding:0';
                // for box-sizing other than "content-box" use:
                // el.style.cssText = '-moz-box-sizing:content-box';
                el.style.cssText = 'height:' + el.scrollHeight + 'px';
               // el.style.lineHeight = "15px";
              },0);
            }
            
    $('[data-toggle="tooltip"]').tooltip();
     window.like_dislike1 = function (postId , isLike , thisElem){
             $.ajax({
                  url : "controller/controller_like_dislike.php" , 
                  type : "post" , 
                  data : {
                      'is_like' : isLike , 
                      'post_id' : postId
                  } ,
                  dataType: 'json',
                  cache: false,
                  beforeSend : function (){
                      //class="fa fa-spinner fa-pulse fa-3x fa-fw margin-bottom"
                       $(thisElem).children('i.iconstilsh').removeClass('fa-thumbs-o-up');
                       $(thisElem).children('i.iconstilsh').addClass('fa-spinner fa-pulse fa-3x fa-fw margin-bottom');
                  } ,
                  success : function (respond){
                     var resuluts = respond ;
                     var islike = $.trim(resuluts[2])// 1=> like , 0=> dislike;
                     if(islike == 1){
                         
                         $(thisElem).children('i.iconstilsh').addClass('fa-thumbs-o-up');
                       $(thisElem).children('i.iconstilsh').removeClass('fa-spinner fa-pulse fa-3x fa-fw margin-bottom');
                       
                        $(thisElem).children('i.iconstilsh').css({
                            background: 'floralwhite',
                            border: '1px solid #dcdcdc',
                            color: 'tomato'
                        });
                         $(thisElem).parent('li').next('li').children('a').children('.fa-thumbs-o-down').css({
                            background: '#dcdcdc',
                            border: '1px solid #dcdcdc',
                            color: 'darkcyan'
                        });
                     }else {
                          $(thisElem).children('i.iconstilsh').addClass('fa-thumbs-o-up');
                       $(thisElem).children('i.iconstilsh').removeClass('fa-spinner fa-pulse fa-3x fa-fw margin-bottom');
                       
                        $(thisElem).children('i.iconstilsh').css({
                            background: '#dcdcdc',
                            border: '1px solid transparent',
                            color: 'darkcyan'
                        }); 
                     }
                     
                      
                     
                  }
          });  
     }
     
     
     window.like_dislike2 = function (postId , isLike , thisElem){
             $.ajax({
                  url : "controller/controller_like_dislike.php" , 
                  type : "post" , 
                  data : {
                      'is_like' : isLike , 
                      'post_id' : postId
                  } ,
                  dataType: 'json',
                  cache: false,
                  beforeSend : function (){
                      //class="fa fa-spinner fa-pulse fa-3x fa-fw margin-bottom"
                       $(thisElem).children('i.iconstilsh').removeClass('fa-thumbs-o-up');
                       $(thisElem).children('i.iconstilsh').addClass('fa-spinner fa-pulse fa-3x fa-fw margin-bottom');
                  } ,
                  success : function (respond){
                     var resuluts = respond ;
                     var islike = $.trim(resuluts[2])// 1=> like , 0=> dislike;
                     if(islike == 0){
                        $(thisElem).children('i.iconstilsh').addClass('fa-thumbs-o-up');
                        $(thisElem).children('i.iconstilsh').removeClass('fa-spinner fa-pulse fa-3x fa-fw margin-bottom');
                       
                        $(thisElem).children('i.iconstilsh').css({
                            background: 'floralwhite',
                            border: '1px solid #dcdcdc',
                            color: 'tomato'
                        });
                        $(thisElem).parent('li').prev('li').children('a').children('i.fa-thumbs-o-up').css({
                            background: '#dcdcdc',
                            border: '1px solid #dcdcdc',
                            color: 'darkcyan'
                        });
                     }else {
                       $(thisElem).children('i.iconstilsh').addClass('fa-thumbs-o-up');
                       $(thisElem).children('i.iconstilsh').removeClass('fa-spinner fa-pulse fa-3x fa-fw margin-bottom');
                       
                       $(thisElem).children('i.iconstilsh').css({
                            background: '#dcdcdc',
                            border: '1px solid transparent',
                            color: 'darkcyan'
                        }); 
                     }
                      
                  }
          });  
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
            
         
    window.commentOn = function (ev , thisdata , postId ,idElem){
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
                         success :function (day) {
                             console.log(day);
                              var this_ = 'commentIcon_'+postId
                                loadComments(idElem , postId , this_);
                         }
                     });
                    
                     $(thisdata).val(null);
                    
                     return false ;
                 }
                
          }       
            
            
            
       window.loadComments = function (postPlace , postId , this_){
           
            if($('.'+postPlace).html()== ''){
                     $.ajax({
                    url : 'controller/controller_load_comments.php' ,
                    data :{
                        'postId':postId
                    } ,
                    type : 'post' ,
                    beforeSend : function () {
                        var loading = '<div id="fountainG"><div id="fountainG_1" class="fountainG"></div><div id="fountainG_2" class="fountainG"></div><div id="fountainG_3" class="fountainG"></div><div id="fountainG_4" class="fountainG"></div><div id="fountainG_5" class="fountainG"></div><div id="fountainG_6" class="fountainG"></div><div id="fountainG_7" class="fountainG"></div><div id="fountainG_8" class="fountainG"></div></div>';
                        $('.'+postPlace).html('<center>'+loading+'</center>');
                    } ,
                    success :function (data) {
                         $('.'+postPlace).html(data);
                        $(this_).children('i').css({
                            background: 'floralwhite',
                            border: '1px solid #dcdcdc',
                            color: 'tomato'
                        }); 
                    } 
                });  
                }else {$('.'+postPlace).html(null);
                    $(this_).children('i').css({
                             background: '#dcdcdc',
                            border: '1px solid transparent',
                            color: 'darkcyan'
                        }); 
                }
                
                
                
       }     
       
       
       
       window.loadMoreStories = function (th ){
           var lastTime = document.getElementsByClassName('lastTimess')
             $.ajax({
                    url : 'controller/controller_load_stories.php' ,
                    data :{
                        'lastTime':lastTime[lastTime.length -1].value
                    } ,
                    type : 'post' ,
                    beforeSend : function () {
                        var loading = '<div class="cssload-jumping"><span></span><span></span><span></span><span></span><span></span></div>';
                        $(th).html('<center>'+loading+'</center>');
                    }  ,
                    success :function (data) {
                         $(th).html('<center>'+'<b class="loadMore">Load more stories </b>'+'</center>');
                        if($.trim(data) == 1 ){
                             $(th).removeAttr('onclick');
                             $(th).html("<center><b>There are no Stories</b></center>");
                            return false ;
                        }else 
                         $('.mstories').append(data);
                         
                    } 
                 });
       }
       
        window.loadMorePosts = function (th , ForD  , userId ){
           var lastTime = document.getElementsByClassName('lastTimess')
             $.ajax({
                    url : 'controller/controller_load_stories.php' ,
                    data :{
                        'lastId':lastTime[lastTime.length -1].value ,
                        'appType':ForD ,
                        'user-id' : userId 
                    } ,
                    type : 'post' ,
                    beforeSend : function () {
                        var loading = '<div class="cssload-jumping"><span></span><span></span><span></span><span></span><span></span></div>';
                        $(th).html('<center>'+loading+'</center>');
                    }  ,
                    success :function (data) {
                         $(th).html('<center>'+'<b class="loadMore">Load more stories </b>'+'</center>');
                        if($.trim(data) == 1 ){
                             $(th).removeAttr('onclick');
                             $(th).html("<center><b>There are no Stories</b></center>");
                            return false ;
                        }else 
                         $('.mstories').append(data);
                         
                    } 
                 });
       }
            
    ////////////////////////// AUDIOS        
   var audio ;
   var playbtn ;
   audio = new Audio();
  
  $('.playthis').click(function(){
       var audioSource = $(this).attr('audio-source');
      audio.src = "music_albums/timeline/"+audioSource;
      audio.play();
       $(this).hide();  
       $(this).next('.playthispaus').show();
   });
  
  $('.playthispaus').click(function(){
      /*icon-pause-5
   
   icon-googleplay*/
         if(!audio.paused && !audio.ended){
                       audio.pause();
                       $(this).children('.font-music-icon').removeClass('icon-pause-5');
                       $(this).children('.font-music-icon').addClass('icon-googleplay');
                   }else {
                   audio.play();
                    $(this).children('.font-music-icon').removeClass('icon-googleplay');
                       $(this).children('.font-music-icon').addClass('icon-pause-5');
                 }
    });
    
    // play - pause 
  window.playPause = function () {
      if(!audio.paused && !audio.ended){
                       audio.pause();
                   }else {
                   audio.play();
                 }
  }
  
  window.delete_post = function(Postid,thisElem){
      if(confirm('Are you sure that you like to delete this post ?')){
           $.ajax({
                url : 'controller/controller_post_delete.php'  ,
                    data :{'postId':Postid} ,
                    type : 'post' ,
                    beforeSend : function () {
                        //class="fa fa-spinner fa-pulse fa-3x fa-fw margin-bottom"
                       $(thisElem).children('i.iconstilsh').removeClass('fa-remove');
                       $(thisElem).children('i.iconstilsh').addClass('fa-spinner fa-pulse fa-3x fa-fw margin-bottom');
                    } ,
                    success :function (responsedData) {
                       
                        if($.trim( responsedData) == 1){
                         $(thisElem).parent('li').parent('ul').parent('.postContainer').addClass('animated lightSpeedOut');
                          $(thisElem).parent('li').parent('ul').parent('.postContainer').remove();} 
                    } 
            });
      }
     
  }
  //<?php echo $profilePageContents[$i]->id;?> ,'homePostContainer<?php echo $profilePageContents[$i]->id;?>
  window.judge_this_story = function(postId , postHashId , judgeType ,  __thisElem){
     var judgeType = $.trim(judgeType);
     var is_isset = $(__thisElem).attr('is_isset') ;
     
             var dataSting = {
                 'switch_type' : is_isset , 
                 'postId':postId 
             }
             var urlF = null ; 
             // judeg
             switch (judgeType){
                 case '808' : //  texts only 
                      urlF = 'controller_switch_courtroom_text_post.php';
                      break ;
                 case  '22' :  //  images - photo 
                       urlF = 'controller_switch_courtroom_image_post.php';
                        break ;
                 case  '1' : //  Music
                      urlF = 'controller_switch_courtroom_music_post.php';
                     return window.location.href = "index";
                       break ;
                 case  '2' :  //  video 
                      urlF = 'controller_switch_courtroom_video_post.php';
                      return window.location.href = "index";
                       break ;
            
              }
              
             
            $.ajax({
                     url : 'controller/'+urlF ,
                    data :dataSting ,
                    type : 'post' ,
                    beforeSend : function () {
                        var loading = '<div style="top:0px;bottom: 0px;right: 0px;left: 0px; position: absolute;background-color:rgba(250,250,250,0.9);z-index: 2000;"><div style="position: absolute;width: 120px;height: 14px;margin: 19px auto;left: 0px;right: 0px;top: 40%;bottom: 0px;"  id="fountainG"><div id="fountainG_1" class="fountainG"></div><div id="fountainG_2" class="fountainG"></div><div id="fountainG_3" class="fountainG"></div><div id="fountainG_4" class="fountainG"></div><div id="fountainG_5" class="fountainG"></div><div id="fountainG_6" class="fountainG"></div><div id="fountainG_7" class="fountainG"></div><div id="fountainG_8" class="fountainG"></div></div></div>';
                         $('#'+postHashId).append(loading).fadeIn();
                    } ,
                    success :function (responsedData) {
                        console.log(responsedData);
                        $('#'+postHashId).html(responsedData);
                    } 
            });   
         
         
         
          if(is_isset == 0 )
                  $(__thisElem).attr('is_isset','1') ;
              else 
              $(__thisElem).attr('is_isset','0') ;
  }
   /*
         playbtn = document.getElementById(_this);
       
        
       
        
         if(!audio.paused && !audio.ended){
                       audio.pause();
                   }else {
                   audio.play();
                 }
      
     */
 
   
 
 $('.divss').on('activate', function() {
    $(this).empty();
    var range, sel;
    if ( (sel = document.selection) && document.body.createTextRange) {
        range = document.body.createTextRange();
        range.moveToElementText(this);
        range.select();
    }
});

$('.divss').focus(function() {
    if (this.hasChildNodes() && document.createRange && window.getSelection) {
        $(this).empty();
        var range, sel;
        range = document.createRange();
        range.selectNodeContents(this);
        sel = window.getSelection();
        sel.removeAllRanges();
        sel.addRange(range);
    }
});                              
                                      
});