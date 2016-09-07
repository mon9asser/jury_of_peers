<?php 
ob_start();
if(session_id()=='')
session_start() ;
 
 $file_like = dirname(__FILE__)."/../modular/autoload_apps.php";
 if(is_file($file_like )) require_once  $file_like ;

 
 
 
 if(isset($_POST['is_like']) and isset($_POST['post_id'])){
     
      $user_id =  $_SESSION['user_info']['user_id'];
      $post_id = $_POST['post_id'];
     
      $like_or_dis = new user_like_dislikes_applications() ;
      $exists = $like_or_dis ->user_like_dislikes_check_exist([
          'liked_by_userid'=>  trim( $user_id ) ,
          'post_id'=>trim($post_id)
      ]);
      
      if($exists == NULL )
      {
          $like_or_dis->user_like_dislikes_add_new_field([
              'liked_by_userid'=> trim( $user_id ) ,
              'post_id'=> trim($post_id) ,
              'is_liked'=> trim($_POST['is_like']),
              'timestamps'=> time()
          ]);
           // notification system 
      }else {
          if($_POST['is_like'] == $exists->is_liked ){
                    $like_or_dis->user_like_dislikes_delete_fields ([
                 'liked_by_userid'=>  trim( $user_id ) ,
                 'post_id'=>trim($post_id)
             ]); }else{
          $like_or_dis->user_like_dislikes_update_fields(['id'=>$exists->id], ['is_liked'=> trim($_POST['is_like'])]);
            // notification system 
          }
      }
      
      
      
 
$likes_dislikes = new user_like_dislikes_applications();
$likes =  $likes_dislikes->user_like_dislikes_get_by_values(['post_id'=>$_POST['post_id'] , 'is_liked'=> 1] ,'and');
$dislikes =  $likes_dislikes->user_like_dislikes_get_by_values(['post_id'=>$_POST['post_id'] , 'is_liked'=> 0 ] ,'and');

$islikeSys = $likes_dislikes->user_like_dislikes_check_exist(['liked_by_userid'=>$_SESSION['user_info']['user_id'],'post_id'=>$_POST['post_id']]);
 
$results = [
   0=>count($dislikes), 
   1=>count($likes) , 
   2=> ($islikeSys != NULL ) ?  $islikeSys->is_liked : 2
] ;
  
 echo json_encode($results);
}


 session_write_close() ;

  
?>