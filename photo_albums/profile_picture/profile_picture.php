<?php
$profilPicFile = dirname(__FILE__)."/../../modular/autoload_apps.php";
if(is_file($profilPicFile)) require_once $profilPicFile ;
 
  
  ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



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






function home_profile_pics ($userId) {
    
    $profile_pic_apis = new profile_picture_applications();  
    $profilePicture = $profile_pic_apis->profile_pictureg_get_by_values([
        'user_id'=>$userId  
        ],'and');

    if(count($profilePicture) != 0 )
   {
       $profilePict = $profile_pic_apis->profile_pictureg_get_by_values([
        'user_id'=>$userId  
        ],'and');
       
        echo $profilePict[count($profilePict)-1]->photo_src ;
   } else {
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
  

//home_profile_pics(1);

?>
