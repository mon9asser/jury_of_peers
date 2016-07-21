<?php
ob_start() ;
if(session_id()=='')
    session_start () ;

          $user_file = dirname(__FILE__)."/../modular/paginations/paginations_comment_load.php";
        if(is_file($user_file)) require_once $user_file ;
                        
        $user_apis = new user_get_more_pagination_comment_package();
        
        $lastId = trim($_POST['last-id']);
        $commentInPosts = $user_apis->load_more_comments_in_timeline_frd($lastId, 3 , "(post_id=".trim($_POST['post-id']).")") ;
        
                   
 ?>
     
 <?php
   for( $cmt =0 ; $cmt < count($commentInPosts ); $cmt++  ) { 
   $positionIt = "center center";
   $sizeIt = "100% 100%";
   $profileExixst = new profile_picture_applications();
   $checkProfi = $profileExixst->profile_pictureg_check_exist(['user_id'=>$commentInPosts[$cmt]->user_id]);
   if($checkProfi != NULL )
   {
   $positionIt = $checkProfi->position_y_x;
   $sizeIt = $checkProfi->photo_w_h;
   }else {
   $positionIt = "center center";
   $sizeIt = "100% 100%";
   } 
   $userInfo =  $userAPPS->user_application_check_exist(['id'=>$commentInPosts[$cmt]->user_id]);
   if($userInfo != NULL ){
   $userName = $userInfo->u_name ;
   $fullName = $userInfo->f_name .' '. $userInfo->s_name ;
   }else 
   {
   $fullName = "User of jury of peers" ;
   }
   ?>
   <li>
   <div class="add-com msComments" >
   <div class="user-image sizerComm" style="background-image:  url(../<?php echo $userName ; ?>/photo_albums/profile_picture/<?php echo checkProfileExists($commentInPosts[$cmt]->user_id);?>);background-size:<?php echo $sizeIt ; ?>; background-position:<?php echo $positionIt ; ?>;"></div>
   <div class="commentBlock">
   <b><?php echo $fullName;?></b>
   <div class="clearFix"></div>
   <span>
   <?php echo $commentInPosts[$cmt]->comment_contents;  ?>
   <font class="text-right">
   <?php
   $GeneralApis = new apps();
   echo $GeneralApis->time_elapsed_string($commentInPosts[$cmt]->timestamps);
   ?> 
   </font> 
   </span> 
   </div>
   </div>
   </li>
   <?php } ?>
 <?php   
  session_write_close() ;
?>