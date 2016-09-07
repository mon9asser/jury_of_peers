<?php
    if(!isset($_POST['postId']))
        return false ;
    
    $filesD = dirname(__FILE__)."/../modular/autoload_apps.php";
    if(is_file($filesD)) require_once $filesD ;
     
?>

<?php
 $postId = trim($_POST['postId']);
    $commenApis = new comments_applications();
    $comments = $commenApis->comments_apis_get_all("WHERE `post_id`={$postId} AND `is_deleted`=0 ORDER BY id DESC");
    
    if(count($comments)!=0)
    {
        for($i=0; $i<count($comments);$i++){
            ?>
            <div class="add-com msComments" >
                <div class="user-image sizerComm" style="background-image:  url(photo_albums/profile_picture/<?php echo get_profile_picture($comments[$i]->user_id); ?>);  "></div>
                <div class="commentBlock">
                    <b style="
                       width: 100%;
                        display: block;
                        ">
                        <?php
                            $userApp = new user_applications();
                            $userInfo = $userApp->user_application_check_exist([
                                'id'=>$comments[$i]->user_id
                            ]);
                            
                            if($userInfo != NULL )
                            { 
                                echo $userInfo->u_name;
                            }
                        ?>
                        
                           <?php
                                if($comments[$i]->user_id == $_SESSION['user_info']['user_id']){
                                 ?>
                         <i data-toggle="tooltip" data-placement="left" title="Delete Comment" onclick="remove_this_comment(<?php echo $comments[$i]->id; ?>,this)" style="float: right; color: #999;cursor: pointer;" class="fa fa-remove"></i>
                         <?php } ?>
                    </b>
                    <div class="clearFix"></div>
                    <span>
                 
                        <?php $app = new apps(); ?>
                        <?php   $app->escrapping_urls_in_comments_video_vimeo($comments[$i]->comment_contents); ?>
                        <?php
                        /*$app->emoticonsProvider($comments[$i]->comment_contents)*/
                        ?>
                        
                        <font class="text-right">
                            <?php
                                $appApis = new apps() ;
                               echo $appApis->time_elapsed_string($comments[$i]->timestamps );
                            ?>
                        </font> 
                    </span> 
                </div>
            </div>
            <?php
        }
        
    }else {
        ?>
            <center>
                <b style="color: tomato; padding: 5px;display: block;">There are no comments</b>
            </center>
         <?php
    }
?>


<script>
    $(document).ready(function(){
         $('[data-toggle="tooltip"]').tooltip();
          window.remove_this_comment = function(id,thisElem){
                          $.ajax({
                             url : 'controller/controller_comment_delete.php'  ,
                                 data :{'CommentId':id} ,
                                 type : 'post' ,
                                 beforeSend : function () {
                                     //class="fa fa-spinner fa-pulse fa-3x fa-fw margin-bottom"
                                    $(thisElem).removeClass('fa-remove');
                                    $(thisElem).addClass('fa-spinner fa-pulse fa-3x fa-fw margin-bottom');
                                 } ,
                                 success :function (responsedData) {

                                     if($.trim( responsedData) == 1){
                                      $(thisElem).parent('b').parent('.commentBlock').parent('.msComments').addClass('animated fadeOut');
                                       $(thisElem).parent('b').parent('.commentBlock').parent('.msComments').remove();} 
                                 } 
                         });
             }
    });
   
</script>