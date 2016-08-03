$(document).ready(function(){
    
     $('[data-toggle="tooltip"]').tooltip();
          /*
          $('.jurylist').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000 
              });*/
              
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
              $(_this).html ('<div id="floatingCirclesG"><div class="f_circleG" id="frotateG_01"></div><div class="f_circleG" id="frotateG_02"></div><div class="f_circleG" id="frotateG_03"></div><div class="f_circleG" id="frotateG_04"></div><div class="f_circleG" id="frotateG_05"></div><div class="f_circleG" id="frotateG_06"></div><div class="f_circleG" id="frotateG_07"></div><div class="f_circleG" id="frotateG_08"></div></div> Deleting');
          },
          success : function (){
              window.location.href ='courtroom' ;
          }
      });
    }
})
