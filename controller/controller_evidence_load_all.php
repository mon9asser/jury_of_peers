<?php
if(session_id()=='')
    session_start() ;

 
  
if(!isset($_SESSION['user_info']))
    return false ;


 $file = dirname(__FILE__)."/../modular/autoload_apps.php";   
 if(is_file($file )) require_once $file  ;
 
 $courtroomApis = new courtroom_comments_applications() ;
 $courtInitApis = new courtroom_init_applications();
 $userApp = new user_applications() ;
 
 
 
 
 if(!isset($_POST['type']))
return false ;
 
 
 // Load all comments of jury of peers 
if(!isset($_POST['courtCode']))
return false ;



$courtCode = $_POST['courtCode'] ;

 if($_POST['type'] == 'cmt_add'){

     if(!isset($_POST['evedenc']))
        return false ;

     $evedence = $_POST['evedenc'] ;


if($evedence == '' || $courtCode =='' )
    {
        echo "2";
        return false ;
    }
    
    
 $courtInitExist = $courtInitApis->courtroom_init_check_exist(['courtroom_code'=>trim($courtCode)]);
 if($courtInitExist == NULL )
 {
     echo "2";
     return FALSE ;
 }
 
 $cmtAdd = $courtroomApis->courtroom_comments_add_new_field([
     'user_id'          =>  $_SESSION['user_info']['user_id'] ,
     'court_id'         =>  $courtInitExist->id , 
     'comment_txt'      =>  $evedence ,
     'timestamps'       =>  time() ,
     'courtroom_code'   =>  $courtCode
 ]);
 if($cmtAdd)
     echo "1";
 }else if($_POST['type'] == 'load') 
    {
     echo "<b style='width: 100%;
text-align: left;
display: block;
padding: 0px 14px;'>All Evidence</b>";
     $loadCmt = $courtroomApis->courtroom_comments_get_by_values(['courtroom_code'   =>  $courtCode ] , 'and');
     for($i=0;$i < count($loadCmt) ; $i++){
          ?>
            <div class="juryCntr commentCourtRoom text-left">
                <div class="viewComments"></div>
                <img style="float: left;" class="juryImage" src="photo_albums/profile_picture/<?php echo get_profile_picture( $loadCmt[$i]-> user_id) ;?>" />
                <p style="float: left;width: 556px;padding-left: 10px;padding-top: 3px;">
                    <b style="width: 100%; display: block;overflow: hidden ;">
                       <?php
                        $u = $userApp->user_application_check_exist(['id'=> $loadCmt[$i]-> user_id]);
                        echo  $u->u_name;
                       ?>
                    </b>
                   <?php 
                   $app = new apps();
                   echo $app->emoticonsProvider( $loadCmt[$i]-> comment_txt );?> 
                </p>
                <?php
                
                    if($loadCmt[$i]-> img_src != NULL ){
                       
                        ?>
                            
                <a  href="evidence/<?php echo $loadCmt[$i]-> img_src ; ?>" file-name="<?php $loadCmt[$i]-> img_src ; ?>"   style="
                    width: 100%;
                    text-align: right;
                    display: block;
                    padding: 0px 14px;
                    cursor: pointer;
                    "><i class="fa fa-file"></i> Evidence File</a>
                            
                            <?php
                    }
                ?>
                
           </div>	    
            <?php
     }
       
    } 
    
?>

<div style="
     width: 100%;
     display: block ;
     overflow: hidden ;
     padding: 10px;
     margin: 0px auto ;
      text-align: left ;
      overflow: hidden ;
      "> 
    <b style='width:100%;text-align:left;'>Add new Evidence</b>
      
    <input id="fileUloaded" type="file" />
        <input id="courtroomCode" value="<?php echo $courtCode ; ?>" type="hidden" />
        <textarea id="commentTextCourtRoom" style="width: 100%; display: block ;" court-code="<?php echo $courtCode ; ?>" id="judgeComment" onkeydown="resizeComment(this);" placeholder="Write your notes" class="juryStatus"></textarea>
        <button style="
               float: right;
margin: 11px 0px 0px 0px;
display: inline-block;
padding: 2px;
background: teal ;
color:#fff;" onclick="send_evidence(this);">Send Evidence </button>
    
</div>




<script>
    
    window.send_evidence = function (item) {
        var evidenceText =  document.getElementById('commentTextCourtRoom');
        var courtRoomCode = document.getElementById('courtroomCode');
        var file = document.getElementById('fileUloaded').files[0];
         
         var formdata = new FormData();
         formdata.append("target_file", file);
         formdata.append("evidenceText", evidenceText.value);
         formdata.append("courtRoomCode", courtRoomCode.value);
         formdata.append("courtType", "texts");
         
        
         var ajax = new XMLHttpRequest();
                // inprogress bar 
               ajax.upload.addEventListener("progress", function (event){
                 
                  $(item).addClass('disabled');
                  var percent = (event.loaded / event.total) * 100;
                  $(item).html(percent+"% Uploaded");
                } , false);
              // image upload completed 
              ajax.addEventListener("load", function (event){ 
                  console.log(event.target.responseText);
                   
                  $(item).html('Evidence Added Success !'); 
               }, false); 
              // finish ajax request
              ajax.open("POST", "controller/controller_evidence_add.php");
              ajax.send(formdata);
         
     
        
    } 
        window.downloadFIle = function (ss) {
             $.ajax({
                 url : 'controller/controller_download.php' , 
                 data : {'fileName':$(ss).attr('file-name') } ,
                  type :'post', 
                  success:  function (d){console.log(d);} 
             })
         }
    
</script>