<?php
ob_start() ;
if(session_id()=='')
    session_start() ;

 if (isset($_COOKIE['user_info'])) {
    setcookie('user_info', '', time()-300);   
 }
 session_destroy();
 
header('location: index');
?>
