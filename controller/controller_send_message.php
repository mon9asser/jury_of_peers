<?php
if(!isset($_POST['user_id']))
return FALSE ;
  $file  = dirname(__FILE__)."/../modular/autoload_apps.php";
  if(is_file($file)) require_once $file  ;
 
  
  $userApps = new user_applications();
  $userInfo = $userApps ->user_application_check_exist(['id'=>trim($_POST['user_id'])]);
?>
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title"><i class="icon-comment-alt-1"></i>Message </h4>
</div>
<div style="width: 100%;
                                display: block;
                                overflow: hidden;
                                padding: 15px 20px;
                                margin: 0px;
                                overflow: hidden;" >
                                    Send to : <span style="padding: 3px 5px; background: rgba(52, 152, 219,.3); border: 1px solid #2980b9; "> <?php echo $userInfo->u_name; ?></span>
</div>
<div class="modal-body">  
                                  <div id="editable" contenteditable="true">
                                      <p style="color: #999;">Write message here</p>
                                  </div>
</div>
<div class="modal-footer">
    <button id="close" type="button" style="
                                          background: #eee;
                                            padding: 5px 20px;
                                            margin-top: 6px;
                                            color: #999;
                                            border: 1px solid #dfdfdf;
                                            " data-dismiss="modal">Cancel</button>
                                                                            <button type="button" class="" style="background: #e52826;
                                            padding: 5px 20px;
                                            margin-top: 6px;
                                            color: #fff;
                                            border: 1px solid tomato;" onclick="sendMessageContents( <?php echo $_POST['user_id'] ; ?> , this);">Send</button>
</div>


 <script>
            $(document).ready(function (){
                
                window.sendMessageContents = function (userId, _this){
                    var conenteMsg = $.trim($('#editable').text());
                  
                    if(conenteMsg == 'Write message here'    ) 
                    return false;
                    
                    if(   conenteMsg == ''  ) 
                     return false;
                     
                     
                         $.ajax({
                            url : 'controller/controller_send_message_to.php',
                            data :{'user_id':userId , 'messageContent':conenteMsg} ,
                               type : 'post' ,
                               beforeSend : function () {
                                     $(_this).html("Sending ...") ;
                               } ,
                               success :function (responsedData) {
                                   console.log(responsedData);
                                   if($.trim(responsedData) == 1 )
                                       {
                                           setTimeout(function (){
                                               $('#close').trigger('click');
                                           }, 60);
                                           
                                       }
                               } 
                       });   
                }
                   jQuery.fn.selectText = function(){
                    var doc = document;
                    var element = this[0];
                    console.log(this, element);
                    if (doc.body.createTextRange) {
                        var range = document.body.createTextRange();
                        range.moveToElementText(element);
                        range.select();
                    } else if (window.getSelection) {
                        var selection = window.getSelection();        
                        var range = document.createRange();
                        range.selectNodeContents(element);
                        selection.removeAllRanges();
                        selection.addRange(range);
                    }
                };

                $("#editable").click(function() {
                    $("#editable").selectText();
                });
            });
 </script>