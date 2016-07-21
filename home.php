<?php
ob_start() ;
if(session_id()=='')
session_start() ;
 
header('location: '.$_SESSION['user_info']['user_name'].'/');
?>
