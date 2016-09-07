<?php
$profilPicFile = dirname(__FILE__)."/../modular/applications/profile_picture_applications.php";
if(is_file($profilPicFile)) require_once $profilPicFile ;

$userAppFile = dirname(__FILE__)."/../modular/applications/user_applications.php";
if(is_file($userAppFile)) require_once $userAppFile ;


    


function checkProfileExists ($userId) {
    
    $profile_pic_apis = new profile_picture_applications();  
    $profilePicture = $profile_pic_apis->profile_pictureg_check_exist([
        'user_id'=>$userId , 
        'is_current'=>1
        ]);
   if($profilePicture != NULL )
   {
       $profilePict = $profile_pic_apis->profile_pictureg_get_by_values([
        'user_id'=>$userId , 
        'is_current'=>1
        ],'and');
        return $profilePict[count($profilePict)-1]->photo_src ;
   }
    else {
       // check this user female or man
       $userAPp = new user_applications() ;
       $userGender = $userAPp->user_application_check_exist([
           'id'=>$userId
       ]) ;
       
       if ($userGender->gender == 0 )
           return  "man_avatar.jpg" ;
           else 
               return  "female_avatar.jpg" ;
   }
}





function get_profile_picture ($userId) {
    
    $profile_pic_apis = new profile_picture_applications();  
    $profilePicture = $profile_pic_apis->profile_pictureg_check_exist([
        'user_id'=>$userId , 
        'is_current'=>1
        ]);
   if($profilePicture != NULL )
   {
       $profilePict = $profile_pic_apis->profile_pictureg_get_by_values([
        'user_id'=>$userId , 
        'is_current'=>1
        ],'and');
        return $profilePict[count($profilePict)-1]->photo_src ;
   }
    else {
       // check this user female or man
       $userAPp = new user_applications() ;
       $userGender = $userAPp->user_application_check_exist([
           'id'=>$userId
       ]) ;
       
       if ($userGender->gender == 0 )
           return  "man_avatar.jpg" ;
           else 
               return  "female_avatar.jpg" ;
   }
}
  

 

?>
