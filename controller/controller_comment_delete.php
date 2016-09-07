<?php
    if(!isset($_POST['CommentId']))
        return false ;
    
    $allFile = dirname(__FILE__)."/../modular/autoload_apps.php";
    if(is_file($allFile ))  require_once $allFile ;
    
    $posApi = new comments_applications();
    $isDEl = $posApi->comments_update_fields(['id'=>$_POST['CommentId']],['is_deleted'=>1]);
    if($isDEl)
        echo '1';
?>