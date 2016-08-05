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
                      $('.error-list-invt').css('display' ,"none");
                 }else if(reaponsed == '2'){ // if this user with another dfn or pln 
                      $(_this).html('Invite');    
                      $('.error-list-invt').html ('<span style="padding:10px 5px; color:red;   display:block; overflow:hidden ; margin-top:10px; border:1px solid red;"><center>This user is mutual with your competitor and he is invited by him  , <br /> you can resend invitation to this user if he declined the invitation from your competitor .</center></span>').slideDown();
                 }
            //  window.location.href ='courtroom?code='+CourtroomCode ;
          }
      });
    }
    
    window.load_mor_invitation_dfn = function (CourtroomCode,  _this ){ 
          var last_id = $('.lastIdCourt:last-child').val()
         $.ajax({
          url :'controller/controller_court_invitation.php' ,
          type : 'post' , 
          data : {'lastId':last_id ,'accType':'loadMorePlnDfn' ,'courtCode':CourtroomCode} ,
          beforeSend : function (){
              $(_this).html ('<b style="padding: 6px 10px 8px 5px;display: block; color: ">Loading more ... </b>');
          },
          success : function (respond){  
              if($.trim(respond) == 0)
                  {
                      $(_this).removeAttr('onclick');
                      $(_this).html('<b style="padding: 6px 10px 8px 5px;display: block; color: ">There are no records . </b>');
                      return false ;
                  }
               $(_this).html('<b style="padding: 6px 10px 8px 5px;display: block; color: ">Load more</b>');
                $('.appended').append(respond) ;
             //  window.location.href ='courtroom?code='+CourtroomCode ;
          }
      });
    }
  
  
  
  
  window.load_mor_invitation_pln = function (CourtroomCode,  _this ){ 
          var last_id = $('.lastIdCourt:last-child').val()
         $.ajax({
          url :'controller/controller_court_invitation.php' ,
          type : 'post' , 
          data : {'lastId':last_id ,'accType':'loadMorePlnPln' ,'courtCode':CourtroomCode} ,
          beforeSend : function (){
              $(_this).html ('<b style="padding: 6px 10px 8px 5px;display: block; color: ">Loading more ... </b>');
          },
          success : function (respond){  
              if($.trim(respond) == 0)
                  {
                      $(_this).removeAttr('onclick');
                      $(_this).html('<b style="padding: 6px 10px 8px 5px;display: block; color: ">There are no records . </b>');
                      return false ;
                  }
               $(_this).html('<b style="padding: 6px 10px 8px 5px;display: block; color: ">Load more</b>');
                $('.appended').append(respond) ;
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
    
    
    
    window.send_to_jury_of_peers = function (courtroom_code ,   jury_id , _this){
       $.ajax({
          url :'controller/controller_jury_of_peers_box.php' ,
          type : 'post' , 
          data : {'jury_id':jury_id ,'accType':'jury_add' ,'courtCode':courtroom_code} ,
          beforeSend : function (){
              $('.jopContainer ').fadeIn();
           },
          success : function (respond){
               $('.jopContainer ').fadeOut();
               if($.trim(respond) == 404 ){
                    alert("This Jury Already Added");
               } else if($.trim(respond) == 505 ){
                   alert("You have to add 3 Juries Only");
               }else{
                    $('.jusCon').html('') ;
                    $('.jusCon').append('<b class="headline-jury headline-setelement" style="background-image: url(img_sliders/constitutional_2.png); padding-left: 30px; background-repeat: no-repeat;background-position: 5px 4px; background-size: 20px 20px; ">Jury of peers</b><div class="jopContainer"><div class="cssload-jumping"><span></span><span></span><span></span><span></span><span></span></div></div>'+respond);    
                    $('.jurylist').slick({
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        autoplay: true,
                        autoplaySpeed: 2000 
                    }); 
                }
          }
      });
    }
})
