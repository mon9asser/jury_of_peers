<?php
 $files = dirname(__FILE__)."/../modular/autoload_apps.php";
 if(is_file($files )) require_once $files  ;
 if(isset($_POST['accType'])){
     if($_POST['accType'] == 'decline'){
         $courtApis = new courtroom_init_applications();
         $courtApis->courtroom_init_delete_fields(['id'=>$_POST['id']]);
     }else if ($_POST['accType'] == 'accept'){
        $courtApis = new courtroom_init_applications();
         $courtApis->courtroom_init_update_fields(['id'=>$_POST['id']],['is_accepted'=>1,'setlment_dfnt'=>$_POST['setlmentdfn'],'timestamps'=>time()]); 
     }
 }
?>
