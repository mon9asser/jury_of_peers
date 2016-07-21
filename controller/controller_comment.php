<?php
ob_start() ;
if(session_id()=='')
    session_start () ;

if(!isset($_POST['postId']) and !isset($_POST['comment-text']))
    return false ;


$comment_system_file = dirname(__FILE__)."/../modular/applications/comments_application.php";
  if(is_file($comment_system_file)) require_once $comment_system_file ;  
  
  $comment_apis = new comments_applications();
  $comment_apis->comments_add_new_field([
      'user_id'=>$_SESSION['user_info']['user_id'],
      'post_id'=>$_POST['postId'],
      'comment_contents'=>$_POST['comment-text'] ,
      'timestamps'=>time()
  ]);
?>

 
