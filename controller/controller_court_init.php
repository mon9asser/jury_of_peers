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
          $courtIinitApis = $courtApis->courtroom_init_check_exist(['id'=>$_POST['id']]); 
           $notifiCationApis = new notification_system_applications() ;
            $notifiCationApis->notification_system_add_new_field([
            'id_sender'=>trim($_SESSION['user_info']['user_id']) ,
            'id_receiver'=>trim($courtIinitApis->plaintiff_id) ,
            'app_type'=> 7 , 
            'app_con_id'=> $courtIinitApis->courtroom_code ,
            'timestamps'=> time()
            ]);
     }
 }
?>
