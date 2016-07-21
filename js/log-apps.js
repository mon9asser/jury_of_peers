$(document).ready(function (){
    
    // LOGIN NEW USER APP
   window.loginuser = function (_this){
               var useroremail = $("#usernameoremail");
               var password = $("#passworduser");
               var loadingTag = '<div id="fountainG"><div id="fountainG_1" class="fountainG"></div><div id="fountainG_2" class="fountainG"></div><div id="fountainG_3" class="fountainG"></div><div id="fountainG_4" class="fountainG"></div><div id="fountainG_5" class="fountainG"></div><div id="fountainG_6" class="fountainG"></div><div id="fountainG_7" class="fountainG"></div><div id="fountainG_8" class="fountainG"></div></div>';
               if(useroremail.val() ==''   )
                   {  
                       $('.error-logs').html(null);
                       // $('.error-logs').css('display','block');
                       $('.error-logs').slideDown();
                       $('.error-logs').append('All fileds required to login') ;
                       return false ;
                   }
                if(  password.val() == '' )
                   {
                       $('.error-logs').html(null);
                     //  $('.error-logs').css('display','block');
                       $('.error-logs').slideDown();
                       $('.error-logs').append('All fileds required to login') ;
                       return false ;
                   }    
                   var dataStrings = {
                       'proccessType' : 'login_user' ,
                        'user_name' :useroremail.val() ,
                        'password' :password.val() 
                   };
                $.ajax({
                     url :'controller/controller_logs.php',
                     type : 'POST' , 
                     data : dataStrings  , 
                     beforeSend : function (){
                         $(_this).html(loadingTag);
                     },
                     success :function (response) {
                          $(_this).html("Login");
                         $('.error-logs').html(response);
                         $('.error-logs').slideDown();
                          if($.trim(response) ==1){
                             $('.error-logs').css('display','none');
                             window.location.href ='home' ;
                         }
                         
                     } 
                 });
            }
});