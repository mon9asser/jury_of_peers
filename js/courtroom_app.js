$(document).ready(function(){
   
     $("#demo01").animatedModal();
     $('[data-toggle="tooltip"]').tooltip();
           
          $('.jurylist').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000 
              }); 
              
    window.deleteRequest = function (id,_this){
      $.ajax({
          url :'controller/controller_court_init.php' ,
          type : 'post' , 
          data : {'id':id,'accType':'decline'} ,
          beforeSend : function (){
              $(_this).html ('<div id="floatingCirclesG"><div class="f_circleG" id="frotateG_01"></div><div class="f_circleG" id="frotateG_02"></div><div class="f_circleG" id="frotateG_03"></div><div class="f_circleG" id="frotateG_04"></div><div class="f_circleG" id="frotateG_05"></div><div class="f_circleG" id="frotateG_06"></div><div class="f_circleG" id="frotateG_07"></div><div class="f_circleG" id="frotateG_08"></div></div> Deleting');
          },
          success : function (){
              window.location.href ='courtroom' ;
          }
      });
    }
    
    
     window.acceptRequest = function (id,_this){
         
         if($('#dfnSele').val() == '' ){
             $('#dfnSele').css('border','red');
             return false ;
            }
         else 
             $('#dfnSele').css('border','#eee');
      $.ajax({
          url :'controller/controller_court_init.php' ,
          type : 'post' , 
          data : {'id':id,'accType':'accept','setlmentdfn':$('#dfnSele').val()} ,
          beforeSend : function (){
              $(_this).html ('<div id="floatingCirclesG"><div class="f_circleG" id="frotateG_01"></div><div class="f_circleG" id="frotateG_02"></div><div class="f_circleG" id="frotateG_03"></div><div class="f_circleG" id="frotateG_04"></div><div class="f_circleG" id="frotateG_05"></div><div class="f_circleG" id="frotateG_06"></div><div class="f_circleG" id="frotateG_07"></div><div class="f_circleG" id="frotateG_08"></div></div> Sending Request');
          },
          success : function (){
              window.location.href ='courtroom' ;
          }
      });
    }
    
    window.inviteMyFrd = function (userId ,CourtroomCode,_this){
        $.ajax({
          url :'controller/controller_court_invitation.php' ,
          type : 'post' , 
          data : {'userId':userId,'courtCode':CourtroomCode,'accType':'sendInvitationFrd'} ,
          beforeSend : function (){
              $(_this).html ('<div style="margin-top: 3px;" id="floatingCirclesG"><div class="f_circleG" id="frotateG_01"></div><div class="f_circleG" id="frotateG_02"></div><div class="f_circleG" id="frotateG_03"></div><div class="f_circleG" id="frotateG_04"></div><div class="f_circleG" id="frotateG_05"></div><div class="f_circleG" id="frotateG_06"></div><div class="f_circleG" id="frotateG_07"></div><div class="f_circleG" id="frotateG_08"></div></div> Sending Invitation');
          },
          success : function (respond){
              var reaponsed = $.trim(respond) ;
              
              if(reaponsed == '1')
                 {
                     $(_this).css({
                         background : 'none' ,
                         color : '#999'  
                     }).css('font-weight' ,  'bold');
                     $(_this).removeAttr('onclick'); 
                      $(_this).html ('Invitation Sent !');
                 } 
            //  window.location.href ='courtroom?code='+CourtroomCode ;
          }
      });
    }
    window.load_more_invitation_result = function (lastId , CourtroomCode,  _this ){
              
        var last_id = $('.lastId:last-child').val()
         $.ajax({
          url :'controller/controller_court_invitation.php' ,
          type : 'post' , 
          data : {'lastId':last_id ,'accType':'loadMore' ,'courtCode':CourtroomCode} ,
          beforeSend : function (){
              $(_this).html ('<b style="padding: 6px 10px 8px 5px;display: block; color: ">Loading more ... </b>');
          },
          success : function (respond){
              
              if(respond == 0 ) 
                  { 
                      $(_this).removeAttr('onclick');
                      $(_this).html('<b style="padding: 6px 10px 8px 5px;display: block; color: ">There are no records !</b>');
                      return false ;
                  }
              $(_this).html('<b style="padding: 6px 10px 8px 5px;display: block; color: ">Load more</b>');
              var reaponsed =  respond ;
              $(_this).html('Load More');
              $('.containerMore').append(reaponsed) ;
             //  window.location.href ='courtroom?code='+CourtroomCode ;
          }
      });
    }
})
