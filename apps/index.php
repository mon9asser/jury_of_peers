<?php
ob_start(); 
session_start () ;
 ini_set("session.cookie_domain", ".juryofpeers.tv"); 
 
 
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 
 

      $file = dirname(__FILE__)."/../modular/autoload_apps.php";
    if(is_file($file )) require_once $file  ;
    
    
    if(!isset($_SESSION['user_info']))
    {
            header('location: http://juryofpeers.tv');
            exit(1);
        }
    // user name get 
    $username = $_SESSION['user_info']['user_name'];
    
  
    
    $userApis = new user_applications() ;
    $userInfo = $userApis ->user_application_check_exist(['u_name'=>$username]);
        if($userInfo == NULL )
     {
            header('location: http://juryofpeers.tv');
            exit(1);
        }
        
              ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(!isset($_GET['n']))
{
    header('location: http://juryofpeers.tv');
    exit(1);
}










// for delete

$list = [
    '46.152.89.7','2.89.214.157'
    // tester ip's 
   // ,'173.209.181.160' // Mike thomas
];
if( !in_array( trim( $_SERVER['REMOTE_ADDR'] ), $list))
        { 
            echo "<center>
                    <h1>
                         this apps not verified from developer
                    </h1>
                </center>";
         // header('location: undefine');
            exit(1);
        }      
        
 
?>
 
