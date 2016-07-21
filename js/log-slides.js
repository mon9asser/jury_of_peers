$(document).ready(function(){
           
            $('.parent-bg').delay(3000).fadeOut();
            var wss_array  = [
                '<div class="parent-bg img-background" style="background-image: url(img_sliders/2.jpg); "> </div>',
                '<div class="parent-bg img-background" style="background-image: url(img_sliders/3.jpg); "> </div>',
                '<div class="parent-bg img-background" style="background-image: url(img_sliders/4.jpg); "> </div>',
                '<div class="parent-bg img-background" style="background-image: url(img_sliders/1.jpg); "> </div>',
            ];
            
           
            
            var wss_i = 0;
            var wss_elem;
            
            window.wssNext = function (){
                $('.body-bg').css('background-image','none'); 
                    wss_i++;
                       if(wss_i > (wss_array.length - 1)){
                            wss_i = 0;
                    }
                    
                    setTimeout('wssSlide()',4500);
            }
           window.wssSlide = function (){
             
               wss_elem.prepend(wss_array[wss_i]);
                   wss_elem.children('.img-background:first-child').animate({
                       opacity: 1    
                   },function (){
                        wss_elem.children('.img-background:last').animate({
                       opacity: 0    
                   },function (){
                       wss_elem.children('.img-background:last').fadeOut('slow',function (){
                           wss_elem.children('.img-background:last').remove();
                       });
                       
                   });
                   });
                   
                     setTimeout('wssNext()',1000);
             }
           wss_elem = $("#slide-container"); wssSlide();
           
           
           window.loginuser = function (_this){
               
               var useroremail = $("#usernameoremail");
               var password = $("#passworduser");
               if(useroremail.val() ==''   )
                   {  
                       $('.error-logs').html(null);
                       // $('.error-logs').css('display','block');
                       $('.error-logs').slideDown();
                       $('.error-logs').append('all fileds required to login') ;
                       return false ;
                   }
                if(  password.val() == '' )
                   {
                       $('.error-logs').html(null);
                     //  $('.error-logs').css('display','block');
                       $('.error-logs').slideDown();
                       $('.error-logs').append('all fileds required to login') ;
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
                     success :function (response) {
                         $('.error-logs').html(response);
                         $('.error-logs').slideDown();
                          if($.trim(response) ==1){
                             $('.error-logs').css('display','none');
                             window.location.href ='home.php' ;
                         }
                         
                     } 
                 });
                   
                   
           }
           
           
           
           
           
           
            window.sign_up_new_user = function (_this) {
                $('.error-logs').css('display','none');
                $(_this).html('Signing Up ... ');
                // Create my account now
                var firstName , secondName , userName , email ,password ,dateBirth , gender ,errorList = [] ;
                firstName = $('.fname').val();
                secondName = $('.sname').val();
                userName  = $('.usname').val(); 
                email = $('.emails').val();  
                password = $('.Password').val(); 
                dateBirth= $('.dateofbirth').val();
                gender = $('input[name=gender]:checked').val(); 
                
                 $('.fname , .sname , .usname , .emails ,  .dateBirth').css({
                         'border-bottom':'1px solid #eee'
                     });
                $('.Password').parent().css( 'border-bottom','1px solid #eee');   
                if(firstName == '' && secondName == '' || userName == '' || email =='' || password =='' || dateBirth =='' || gender =='')
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
                   if(dateBirth =='' ){
                       errorList[errorList.length] = 'err'
                      $('.dateofbirth').parent().css('border-bottom','1px solid tomato'); 
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
                         $(_this).html('Create my account now')
                        return false ;}
                  
                   var dataStrings = {
                       'proccessType' : 's_up_add' ,
                       'firstName' : firstName , 
                       'lastName' : secondName , 
                       'user_name' : userName , 
                       'password': password , 
                       'birthDay' : dateBirth , 
                       'gender' : gender  , 
                       'mail' :email
                   };
                   
                  // Connect to controller 
                 
                 $.ajax({
                     url :'controller/controller_logs.php',
                     type : 'POST' , 
                     data : dataStrings  , 
                     success :function (response) {
                         $('.error-logs').html(response);
                         $('.error-logs').slideDown();
                         
                         if($.trim(response) ==1){
                             $('.error-logs').css('display','none');
                             window.location.href ='home.php' ;
                         }
                     } 
                 });
                 
                 $(_this).html('Create my account now')
             //   console.log(dataStrings);
            }
        });