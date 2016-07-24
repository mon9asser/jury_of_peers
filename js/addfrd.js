$(document).ready(function(){
                // load more results
                $('#load-more-boxs').click(function (){
                    var lastId =  $('.friend-block:last-child').attr('last-id')  ;
                 
                    if($('.friend-block').length == 0 )  
                          lastId = $('#load-more-boxs').attr('last-id');
                    
                      
                  // alert(lastId);
                   $.ajax({
                       url: "controller/controller_load_more_add_friend.php" , 
                       data : {'last-id':lastId} , 
                       type :'post' ,
                       beforeSend : function (){
                             $('#load-more-boxs').html('<div id="circularG"><div id="circularG_1" class="circularG"></div><div id="circularG_2" class="circularG"></div><div id="circularG_3" class="circularG"></div><div id="circularG_4" class="circularG"></div><div id="circularG_5" class="circularG"></div><div id="circularG_6" class="circularG"></div><div id="circularG_7" class="circularG"></div><div id="circularG_8" class="circularG"></div> </div>  ');
                       } ,
                       success : function (resp){
                            $('#load-more-boxs').html('Load More');
                           var result = $.trim(resp) ;
                           if(result == 1)
                               {
                                  $('#load-more-boxs').html('There are no results..');
                               }else 
                                $('.block-of-users').append(resp);
                       }
                   });
                });
                
           // add new friend
              window.addThisUser = function (id , elem){
                  var userId = id  ;
                  var parentOfcurrElement = $(elem).parent('.add-msg-controller').parent('.frdinfo-block').parent('.friend-block');
                    // parentOfcurrElement.fadeOut() ;
                    $.ajax({
                      url: "controller/controller_add_friend.php" , 
                        type : "post" ,
                        data : {'userId':$.trim(userId) , 'proccessType':"add_to_mylist"} , 
                        beforeSend : function (){ 
                            $(elem).html ('<div id="floatingCirclesG"><div class="f_circleG" id="frotateG_01"></div><div class="f_circleG" id="frotateG_02"></div><div class="f_circleG" id="frotateG_03"></div><div class="f_circleG" id="frotateG_04"></div><div class="f_circleG" id="frotateG_05"></div><div class="f_circleG" id="frotateG_06"></div><div class="f_circleG" id="frotateG_07"></div><div class="f_circleG" id="frotateG_08"></div></div>Sending request');
                        },
                        success : function (result){
                           
                            var res =  $.trim(result);
                            if(res == 1 ) //<i class="fa fa fa-plus-circle fa-frd"></i>
                                { 
                                    $(elem).html('Friend request sent');
                                    $(elem).css({
                                        'background' : 'teal' ,
                                        'border' : '1px solid teal'
                                    });
                                     
                                     
                                    parentOfcurrElement.addClass('animated rotateOutUpLeft') ;
                                    setTimeout(function (){
                                        parentOfcurrElement.remove() ;    
                                    } , 1000) ; 
                                   
                                }else if (res ==  2 ) {
                                     $(elem).html('you already sent request');
                                      
                                     
                                }
                        }
                    });
              }
              
              
              // Block this User
              window.blockThisUser = function (id , elem){
                  var userId = id  ;
                  var parentOfcurrElement = $(elem).parent('.add-msg-controller').parent('.frdinfo-block').parent('.friend-block');
                    // parentOfcurrElement.fadeOut() ;
                    $.ajax({
                      url: "controller/controller_block_friend.php" , 
                        type : "post" ,
                        data : {'userId':$.trim(userId) , 'proccessType':"block_from_mylist"} , 
                        beforeSend : function (){ 
                            $(elem).html ('<div id="floatingCirclesG"><div class="f_circleG" id="frotateG_01"></div><div class="f_circleG" id="frotateG_02"></div><div class="f_circleG" id="frotateG_03"></div><div class="f_circleG" id="frotateG_04"></div><div class="f_circleG" id="frotateG_05"></div><div class="f_circleG" id="frotateG_06"></div><div class="f_circleG" id="frotateG_07"></div><div class="f_circleG" id="frotateG_08"></div></div>Blocking this user');
                        },
                        success : function (result){
                           
                            var res =  $.trim(result);
                            if(res == 1 ) //<i class="fa fa fa-plus-circle fa-frd"></i>
                                { 
                                    $(elem).html('Block is done');
                                    $(elem).css({
                                        'background' : 'teal' ,
                                        'border' : '1px solid teal'
                                    });
                                     
                                     
                                    parentOfcurrElement.addClass('animated rotateOutDownRight') ;
                                    setTimeout(function (){
                                        parentOfcurrElement.remove() ;    
                                    } , 1000) ; 
                                   
                                }else if (res ==  2 ) {
                                     $(elem).html('you already Block thid user');
                                      
                                     
                                }
                        }
                    });
              }
                
                
});