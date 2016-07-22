<?php

 if(!isset($_POST['userOrEmail']))
 {
     echo "Email Field is Required to send verification";
     return FALSE ;
 }
 
  $fileDirs = dirname(__FILE__)."/../modular/autoload_apps.php";
    if(is_file($fileDirs )) require_once $fileDirs  ;

    
    $emailOrUser = trim(htmlentities(strip_tags($_POST['userOrEmail']))) ;
    
   $userApps = new user_applications() ;
   $userExist = NULL ;
   $user1 =  $userApps->user_application_check_exist(['e_mail'=>$emailOrUser]);
   $user2 = $userApps->user_application_check_exist(['u_name'=>$emailOrUser]);
   if($user1 != NULL )
       $userExist = $user1 ;
   else if($user2 != NULL )
         $userExist = $user2 ;
   else {
       
       echo "This user unregistered in our system !";
       return false ;
       exit(1);
   }
    if($userExist != NULL )
    {
        $general_api = new apps() ; 
        $activationApis = new activation_code_applications() ;
        $activationCoded = $activationApis->activation_code_application_check_exist([
            'user_id'=>$userExist->id
        ]);
        $logoSrc = "http://juryofpeers.tv/images/logo.png" ;
        $user_name =  $userExist->u_name ;
        $aboutJOP = "Welcome to Jury of peers Member , social network to judge your friends" ;
        $activationCode = $activationCoded->activation_code ;
        $linkActivationCode= "http://juryofpeers.tv/activation?activation_code=".$activationCode."&username=". $user_name ; 
        $fromEmail= "Juryofpeers@juryofpeers.tv" ;
        $toEmail= $userExist->e_mail ;
        $subjects = "Jury of peers activation code" ;
        if($activationCoded != NULL ){
            $is_sent =   $general_api->send_activation_to_usermail($logoSrc, $user_name, $aboutJOP,$activationCode , $linkActivationCode, $fromEmail, $toEmail, $subjects);
            if($is_sent)
                echo "1";
        }

    }
     
    ?>
