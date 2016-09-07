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
                        'password' :password.val() ,
                        'redirectUrl':$(_this).attr('rediectUrl')
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
                             var refire = $(_this).attr('rediectUrl');
                             if(refire != 0 )
                                window.location.href = 'http://'+ refire;  
                            else 
                                window.location.href = 'home';  
                         }
                         
                     } 
                 });
            }
            window.sign_up_new_user = function (_this) {
            var loadingTag = '<div id="fountainG"><div id="fountainG_1" class="fountainG"></div><div id="fountainG_2" class="fountainG"></div><div id="fountainG_3" class="fountainG"></div><div id="fountainG_4" class="fountainG"></div><div id="fountainG_5" class="fountainG"></div><div id="fountainG_6" class="fountainG"></div><div id="fountainG_7" class="fountainG"></div><div id="fountainG_8" class="fountainG"></div></div>';

                $('.error-logs').css('display','none');
                 // Create my account now
                var firstName , secondName , userName , email ,password ,dateBirth , gender ,errorList = [] ;
                firstName = $('.fname').val();
                secondName = $('.sname').val();
                userName  = $('.usname').val(); 
                email = $('.emails').val();  
                password = $('.Password').val(); 
                
                var dateBirthYear= $('.dateBirthYear').val();
                var dateBirthMonth= $('.dateBirthMonth').val();
                var dateBirthDay= $('.dateBirthDay').val();
               
                gender = $('input[name=gender]:checked').val(); 
                
                 $('.fname , .sname , .usname , .emails , .dateBirthYear,.dateBirthMonth,.dateBirthDay').css({
                         'border-bottom':'1px solid #eee'
                     });
                     
                     $('.Password').parent().css( 'border-bottom','1px solid #eee');   
                if(firstName == '' && secondName == '' || userName == '' || email =='' || password =='' || dateBirthYear =='' || dateBirthMonth =='' || dateBirthDay =='' || gender =='')
                    {
                        $('.error-logs').slideDown();
                         // case errors
                       $('.error-logs').html("Please fill all data");
                     }
                     
                      $('.checklines').css('color','#999');
                   if(firstName =='' ){
                       errorList[errorList.length] = 'err'
                      $('.fname').css('border-bottom','1px solid tomato'); 
                   }  
                   
                    if(secondName =='' ){
                       errorList[errorList.length] = 'err'
                      $('.sname').css('border-bottom','1px solid tomato'); 
                   }  
                   
                   if(userName =='' ){
                       errorList[errorList.length] = 'err'
                      $('.usname').parent().css('border-bottom','1px solid tomato'); 
                   }  
                   
                   if(email =='' ){
                       errorList[errorList.length] = 'err'
                      $('.emails').parent().css('border-bottom','1px solid tomato'); 
                   }
                   
                   if(password =='' ){
                       errorList[errorList.length] = 'err'
                      $('.Password').parent().css('border-bottom','1px solid tomato'); 
                   }
                   if(dateBirthDay=='' || dateBirthYear =='' || dateBirthMonth =='' ){
                       errorList[errorList.length] = 'err'
                      $('.dateBirthDay').parent().css('border-bottom','1px solid tomato'); 
                   }
                  //checklines
                  if( $('input[type=checkbox]:checked').length == 0)
                        {
                            errorList[errorList.length] = 'err'
                            $('.checklines').css('color','tomato');
                          
                             if( $('#error-logs').css('display') == 'none')
                                 {
                                     $('#error-logs').html(null);
                                     $('#error-logs').slideDown();
                                     $('#error-logs').append('please read our agreement') ;
                                 }else
                           $('#error-logs').append('<br />please read our agreement') ;
                        }
                     
                      if(errorList.length > 0 ){
                         return false ;}
                  
                   var dataStrings = {
                       'proccessType' : 's_up_add' ,
                       'firstName' : firstName , 
                       'lastName' : secondName , 
                       'user_name' : userName , 
                       'password': password , 
                       'birthDay' : dateBirthDay+"/"+dateBirthMonth+"/"+dateBirthYear , 
                       'gender' : gender  , 
                       'mail' :email
                   };
                   $.ajax({
                     url :'controller/controller_logs.php',
                     type : 'POST' , 
                     data : dataStrings  , 
                      beforeSend : function (){
                         $(_this).html(loadingTag);
                     },
                     success :function (response) {
                         $(_this).html('Create my account now');
                         $('.error-logs').html(response);
                         $('.error-logs').slideDown();
                         console.log(response);
                         if($.trim(response) ==1){
                             $('.error-logs').css('display','none');
                             window.location.href ='home' ;
                         }
                     } 
                 });
            }
            
            window.resendActivationCode = function ( _this) {
                 $('.error-logs').css('background','tomato');
               var loadingTag = '<div id="fountainG"><div id="fountainG_1" class="fountainG"></div><div id="fountainG_2" class="fountainG"></div><div id="fountainG_3" class="fountainG"></div><div id="fountainG_4" class="fountainG"></div><div id="fountainG_5" class="fountainG"></div><div id="fountainG_6" class="fountainG"></div><div id="fountainG_7" class="fountainG"></div><div id="fountainG_8" class="fountainG"></div></div>';
                 $.ajax({
                     url :'controller/controller_resend_activation.php',
                     type : 'POST' , 
                     data : {
                         'userOrEmail' :  $("#usernameoremail").val()
                     }  , 
                      beforeSend : function (){
                         $(_this).html(loadingTag);
                     },
                     success :function (response) {
                         
                         $(_this).html('Re-send Activation Code');
                          
                         $('.error-logs').html(response);
                         $('.error-logs').slideDown();
                         
                         if($.trim(response) ==1){
                             $('.error-logs').css('background','mediumseagreen');
                             $('.error-logs').html('Activation code has been sent to your email');
                          }
                     } 
                 });
            }
            
            window.changepassword = function (_this){
                
                var pass = $("#tpassword").val();
                var repass = $("#rtpassword").val();
                
                if( pass != repass || pass == "" || repass == "" )
                    {
                        $('.error-logs').html("Password not correct or something error");
                        return false ;
                    }
                
                
                 $('.error-logs').css('background','tomato');
               var loadingTag = '<div id="fountainG"><div id="fountainG_1" class="fountainG"></div><div id="fountainG_2" class="fountainG"></div><div id="fountainG_3" class="fountainG"></div><div id="fountainG_4" class="fountainG"></div><div id="fountainG_5" class="fountainG"></div><div id="fountainG_6" class="fountainG"></div><div id="fountainG_7" class="fountainG"></div><div id="fountainG_8" class="fountainG"></div></div>';
                 $.ajax({
                     url :'controller/controller_rechange_password.php',
                     type : 'POST' , 
                     data : {
                         'passwordtochange' :  pass  
                     }  , 
                      beforeSend : function (){
                         $(_this).html(loadingTag);
                     },
                     success :function (response) {
                         
                         $(_this).html('Save new password');
                          
                         $('.error-logs').html(response);
                         $('.error-logs').slideDown();
                         
                         if($.trim(response) ==1){
                             $('.error-logs').css('background','mediumseagreen');
                             $('.error-logs').html('Password changed successed');
                             window.location.href = "home" ;
                          }
                     } 
                 });
            }
        
        
        window.resendEmaiPassword = function (_this){
             
                $('.error-logs').css('background','tomato');
               var loadingTag = '<div id="fountainG"><div id="fountainG_1" class="fountainG"></div><div id="fountainG_2" class="fountainG"></div><div id="fountainG_3" class="fountainG"></div><div id="fountainG_4" class="fountainG"></div><div id="fountainG_5" class="fountainG"></div><div id="fountainG_6" class="fountainG"></div><div id="fountainG_7" class="fountainG"></div><div id="fountainG_8" class="fountainG"></div></div>';
                 $.ajax({
                     url :'controller/controller_resend_password.php',
                     type : 'POST' , 
                     data : {
                         'userOrEmail' :  $("#usernameoremail").val()
                     }  , 
                      beforeSend : function (){
                         $(_this).html(loadingTag);
                     },
                     success :function (response) {
                         
                         $(_this).html('Re-send Activation Code');
                          
                         $('.error-logs').html(response);
                         $('.error-logs').slideDown();
                         
                         if($.trim(response) ==1){
                             $('.error-logs').css('background','mediumseagreen');
                             $('.error-logs').html('We have sent you a link to change your password !');
                          }
                     } }); 
        }
});