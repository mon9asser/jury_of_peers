<?php
ob_start(); 
if(session_id() == '')
     session_start () ;
 
 $file_apis = dirname(__FILE__)."/../apis/main_get_app.php";
 if(is_file($file_apis))  require_once $file_apis ;
 
  $file_tbl = dirname(__FILE__)."/../connections/jury_of_peers_tbls.php";
 if(is_file($file_tbl))  require_once $file_tbl ;
 
class pagination_apps  extends jury_of_peers_tbls {
   
     
    
    
    
   public function app_trends( $LIMIT , $moreConditions = NULL ){
        
         // get all  
        $friend_system_applications_file = dirname(__FILE__)."/../autoload_apps.php";
        if(is_file($friend_system_applications_file)) require_once $friend_system_applications_file ;
        $mmParam = '';
        if($moreConditions != NULL )
        {
            $mmParam =" AND ".$moreConditions;
        }
        
          $queryString = "
                    #   /////////////////////////////////  app logs ////////////////////////////////////////
                    SELECT applogs . `id`,  applogs . `user_id_logged` ,  applogs . `app_id`, 
                    count(`app_id`) AS counts ,  applogs . `time`,


                    #  /////////////////////////////////  App info ////////////////////////////////////////
                    appname.`app_name` , appname.`id` , appname.`app_username` , appname.`app_thumbnails` ,
                    appname.`app_type`, appname.`web_url`, appname.`app_info`, appname.`app_category`, appname.`time`

                     FROM app_files appname
                    LEFT JOIN `my_apps_login` applogs ON appname.id = applogs.app_id
                    WHERE  appname.`app_type` = 1 
                    {$mmParam}
                    GROUP BY app_id
                    ORDER BY COUNT(app_id) DESC LIMIT {$LIMIT}
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
 
   $pp = new pagination_apps();
   echo '<pre>';
   print_r($pp->app_trends(6));
   echo '</pre>';
 * 
 * 
 */
?>
