<?php
    if(!isset($_POST['postId']))
        return false ;
    
    $allFile = dirname(__FILE__)."/../modular/autoload_apps.php";
    if(is_file($allFile ))  require_once $allFile ;
    
    $posApi = new user_posts_applications();
    $isDEl = $posApi->user_posts_update_fields(['id'=>$_POST['postId']],['is_deleted'=>1]);
    if($isDEl)
        echo '1';
?>