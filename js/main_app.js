
 $(document).ready(function(){
        // tooltip object of bootstrap
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
          
          // load page friendly for seo 
          $('a').click(function (){
              if($(this).attr('typeItem') == 'loadPage') {
                 jQuery("#Loaded").html("Load page"); 
                 var hrefDir = $(this).attr("href");
                 var url = hrefDir+'.php';
                  window.history.pushState({},'',hrefDir);
                  jQuery("#Loaded").load(url  + " .dataContainer") ;
                 return false ;             	
              }
          });
 });