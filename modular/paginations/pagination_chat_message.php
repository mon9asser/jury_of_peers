<?php
ob_start(); 
if(session_id() == '')
     session_start () ;
 
 $file_apis = dirname(__FILE__)."/../apis/main_get_app.php";
 if(is_file($file_apis))  require_once $file_apis ;
 
  $file_tbl = dirname(__FILE__)."/../connections/jury_of_peers_tbls.php";
 if(is_file($file_tbl))  require_once $file_tbl ;
 
class pagination_chat_message  extends jury_of_peers_tbls {
   
     
    
    
    
   public function chat_availablity($limit  ){
        
          // get all  
        $friend_system_applications_file = dirname(__FILE__)."/../autoload_apps.php";
        if(is_file($friend_system_applications_file)) require_once $friend_system_applications_file ;
         
         
         $me = $_SESSION['user_info']['user_id'] ;
         
         
         $time_of_me = 0;
         $time_of_friends = 0;
        
         
         
         
         
          $queryString = "
                 SELECT status . timestamps AS time_available , status . user_id  AS user_id_app , status.status   , 
                 user . u_name , user.f_name , user.s_name , user . e_mail ,
                 conversation_apps . id_sender AS sender_id , conversation_apps . id_receiver AS receiver_id , conversation_apps . is_seen AS conversation_app_seen , conversation_apps . timestamps AS time_conversation_apps
                    FROM 
                            user_available status   
                    LEFT JOIN
                           friend_system friends ON  friends.id_receiver = status.user_id  OR   friends.id_sender =status.user_id
                    LEFT JOIN 
                           conversation conversation_apps ON status.user_id  = conversation_apps.id_sender OR  status.user_id  = conversation_apps.id_receiver 
                    LEFT JOIN 
                           user_apps user ON status.user_id  = user.id        
                          
                    WHERE 
                         (
                            (( friends.id_receiver = {$me} or friends.id_sender = {$me} ) AND ( friends.is_accepted = {$me} ))
                             AND
                             status . user_id !=  {$me}
                        )
                        
                        
                    GROUP BY 
                        status.id  
                     ASC LIMIT 
                         {$limit}
                 
            ";
         
          // hide frd condotion in 30+
         
          $result = mysqli_query($this->open_connection() , $queryString  );
        if(!$result) return NULL  ;
       
        if(mysqli_num_rows($result) == 0 )  return 0 ;
        $listAll = [] ; 
        
        if(mysqli_num_rows($result) > 0){ 
            for ($i= 0 ; $i < mysqli_num_rows($result) ;$i++) 
            $listAll[count ($listAll)] = mysqli_fetch_object ($result) ;
              mysqli_free_result($result);
              
            }
      
     
        return  $listAll   ;
    }
    
    
     
     
}
 /*
$posA = new pagination_chat_message();
$pp = $posA ->chat_availablity(5);
echo "<pre>";
print_r($pp);
echo "</pre>";  */  
?>
