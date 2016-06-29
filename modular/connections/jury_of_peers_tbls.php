<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of jury_of_peers_tbls
 *
 * @author Montasser Mossallem
 */

$conx_file = dirname(__FILE__)."/jury_of_peers_db.php";
if(is_file($conx_file ))    require_once $conx_file  ;

class jury_of_peers_tbls extends connections_db {
    
   
   private static $user_app = 'user_apps';
   protected function user_applications_get (){
        return jury_of_peers_tbls::$user_app;
   }
   
   private static $activation_code = 'activation_code';
   protected function activation_code_get (){
        return jury_of_peers_tbls::$activation_code;
   }
  
   private static $user_available = 'user_available';
   protected function user_available_get (){
        return jury_of_peers_tbls::$user_available;
   }
   
   private static $user_logs = 'user_logs';
   protected function user_logs_get (){
        return jury_of_peers_tbls::$user_logs;
   }
   
   private static $general_settings = 'general_settings';
   protected function general_settings_get (){
        return jury_of_peers_tbls::$general_settings;
   }
   
   private static $security_setting = 'security_setting';
   protected function security_setting_get (){
        return jury_of_peers_tbls::$security_setting;
   }
   
   
   private static $privacy_setting = 'privacy_setting';
   protected function privacy_setting_get (){
        return jury_of_peers_tbls::$privacy_setting;
   }
   
   
    private static $block_setting = 'block_setting';
   protected function block_setting_get (){
        return jury_of_peers_tbls::$block_setting;
   }
   
   
   private static $friend_system = 'friend_system';
   protected function friend_system_get (){
        return jury_of_peers_tbls::$friend_system;
   }
   
   
   private static $conversation = 'conversation';
   protected function conversation_get (){
        return jury_of_peers_tbls::$conversation;
   }
   
   
   private static $messagae = 'messagae';
   protected function  messagae_get (){
        return jury_of_peers_tbls::$messagae;
   }
   
   
   private static $notification_system = 'notification_system';
   protected function  notification_system_get (){
        return jury_of_peers_tbls::$notification_system;
   }
   
   
   private static $me_in_contolling = 'me_in_contolling';
   protected function  me_in_contolling_get (){
        return jury_of_peers_tbls::$me_in_contolling;
   }
   
   
   
}

 
?>
