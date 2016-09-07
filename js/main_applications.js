

window.notifications = function (){
    
    load_count('viewProfile','#my_profile_view');
    
    load_count('messages','#message_count');
     
    load_count('friend_requests','#frd_cou_ntf');
     
    load_count('main_notifications','#countMainNotifications');
     
    load_count('InitCourtroom','#courtInit');
     
     
      
    user_status();
    // check every 5 scs 
    retimeMe();
}
 
 window.load_count = function(type , targetElement){
       $.ajax({
         url: 'controller/controller_notification_counts.php',
         type: "post",
         data : {'ntf_type':type},
         success : function (respond){
             $(targetElement).html(respond)
         }
    });
     
 }
window.retimeMe = function (){
    window.setTimeout(function(){
        notifications();
    } , 5000); 
}
 window.user_status = function(){
       $.ajax({
         url: 'controller/controller_user_status.php',
         type: "post",
         success : function (respond){
           
         }
    });
  } 
 window.load_notification_contents = function(type , targetElement){
       $.ajax({
         url: 'controller/controller_load_notifications.php',
         type: "post",
         data : {'type':type},
         beforeSend : function (){
             var loader = '<div id="fountainG"><div id="fountainG_1" class="fountainG"></div><div id="fountainG_2" class="fountainG"></div><div id="fountainG_3" class="fountainG"></div><div id="fountainG_4" class="fountainG"></div><div id="fountainG_5" class="fountainG"></div><div id="fountainG_6" class="fountainG"></div><div id="fountainG_7" class="fountainG"></div><div id="fountainG_8" class="fountainG"></div></div>';
             $(targetElement).html('<li><center>'+loader+'</center></li>');
        } ,
         success : function (respond){
             $(targetElement).html(respond)
         }
    });
  }
  
  window.confirm_friend = function ( rowId , thisElement){
     $.ajax({
         url: 'controller/controller_confirm.php',
         type: "post",
         data : {'type': 1 , 'rowId':rowId},
         beforeSend : function (){
             var loader = '<div style="margin:3.5px auto;" id="fountainG"><div id="fountainG_1" class="fountainG"></div><div id="fountainG_2" class="fountainG"></div><div id="fountainG_3" class="fountainG"></div><div id="fountainG_4" class="fountainG"></div><div id="fountainG_5" class="fountainG"></div><div id="fountainG_6" class="fountainG"></div><div id="fountainG_7" class="fountainG"></div><div id="fountainG_8" class="fountainG"></div></div>';
             $(thisElement).html('<li><center>'+loader+'</center></li>');
        } ,
         success : function (respond){
            
                $(thisElement).html('Confirmed');
                $(thisElement).css({
                    background : 'teal' ,
                    border : '1px solid teal' 
                });
             
         }
     });
  }
  
  
    window.decline_friend = function ( rowId , thisElement){
     $.ajax({
         url: 'controller/controller_confirm.php',
         type: "post",
         data : {'type': 0 , 'rowId':rowId},
         beforeSend : function (){
             var loader = '<div style="margin:3.5px auto;" id="fountainG"><div id="fountainG_1" class="fountainG"></div><div id="fountainG_2" class="fountainG"></div><div id="fountainG_3" class="fountainG"></div><div id="fountainG_4" class="fountainG"></div><div id="fountainG_5" class="fountainG"></div><div id="fountainG_6" class="fountainG"></div><div id="fountainG_7" class="fountainG"></div><div id="fountainG_8" class="fountainG"></div></div>';
             $(thisElement).html('<li><center>'+loader+'</center></li>');
        } ,
         success : function (respond){
             
                $(thisElement).html('Confirmed');
                $(thisElement).css({
                    background : 'teal' ,
                    border : '1px solid teal' 
                });
             
         }
     });
  }
  
    window.add_friend = function ( frdId , thisElement){
     $.ajax({
         url: 'controller/controller_confirm.php',
         type: "post",
         data : {'type': 2 , 'frdId':frdId},
         beforeSend : function (){
             var loader = '<div style="margin:3.5px auto;" id="fountainG"><div id="fountainG_1" class="fountainG"></div><div id="fountainG_2" class="fountainG"></div><div id="fountainG_3" class="fountainG"></div><div id="fountainG_4" class="fountainG"></div><div id="fountainG_5" class="fountainG"></div><div id="fountainG_6" class="fountainG"></div><div id="fountainG_7" class="fountainG"></div><div id="fountainG_8" class="fountainG"></div></div>';
             $(thisElement).html('<li><center>'+loader+'</center></li>');
        } ,
         success : function (respond){
             
                $(thisElement).html('Friend Request Sent');
                $(thisElement).css({
                    background : 'teal' ,
                    border : '1px solid teal' 
                });
             
         }
     });
  }
  
  window.slideDownIt = function (){
      $('.freeIcons').slideDown();
  }
  
  /****************************************************************/
          /****************  Auto height the textarea   *******************/
          /****************************************************************/
             