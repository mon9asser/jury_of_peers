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
           