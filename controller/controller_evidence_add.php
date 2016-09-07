<?php
ob_start() ;
if(session_id()=='')
    session_start() ;


 $files = dirname(__FILE__)."/../modular/autoload_apps.php";
 if(is_file($files )) require_once $files  ;
  

 
 if(!isset($_POST['courtRoomCode']))
     return false ;
 
 $txt = '';
 if(isset($_POST['evidenceText']))
     $txt = $_POST['evidenceText'] ; 
 
 $target = '';
 if(isset($_FILES['target_file']))
   $target = $_FILES['target_file'] ;
  
 if(!isset($_POST['courtType']))
     return false ; 
 
 
     
    $post = $txt;
    $courtCode  = $_POST['courtRoomCode'];
   $courtRoomType =trim ( $_POST['courtType'] ); 
 
 
 
 $image_rename = '' ;
 if(isset($_FILES['target_file'])) {
     
     $fileName = $_FILES["target_file"]["name"]; // The file name
 $fileTmpLoc = $_FILES["target_file"]["tmp_name"]; // File in the PHP tmp folder
 $fileType = $_FILES["target_file"]["type"]; // The type of file it is
 $fileSize = $_FILES["target_file"]["size"]; // File size in bytes
 $fileErrorMsg = $_FILES["target_file"]["error"]; // 0 for false... and 1 for true
 
 
       $image_rename = rand(2000 , 1000000) . "_" .time() . "_".rand(2000 , 1000000) . "_juryofpeers_evidence_".$fileName; 
  $fileRoot = dirname (__FILE__) . "/../evidence/$image_rename";
    // upload file to server 
  move_uploaded_file($fileTmpLoc , $fileRoot) ;

 }

  
  
 
  $courApis = new courtroom_init_applications() ;
  $courtApis =  $courApis->courtroom_init_check_exist(['courtroom_code'=>$courtCode]);
  switch ($courtRoomType) {
      case 'texts' :
          $text_courApis = new courtroom_comments_applications() ;
          $text_courApis ->courtroom_comments_add_new_field([
              'user_id'=>$_SESSION['user_info']['user_id'] ,
              'court_id'=>$courtApis->id ,
              'img_src'=>$image_rename ,
              'comment_txt'=>$post ,
              'timestamps'=> time() ,
              'courtroom_code'=>$courtCode 
          ]) ;
          break; 
  }
?>
