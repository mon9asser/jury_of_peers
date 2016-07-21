<?php
   ob_start() ;
if(session_id()=='')
    session_start () ;

if(!isset($_POST['loadAccording']))
    return false ;




// load all posts via window loaded 
if($_POST['loadAccording']=='load_my_post') {
    
}
    
    
session_write_close() ;
?>
