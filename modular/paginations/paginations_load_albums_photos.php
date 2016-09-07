<?php
 
 $file_apis = dirname(__FILE__)."/../apis/main_get_app.php";
 if(is_file($file_apis))  require_once $file_apis ;
 
  $file_tbl = dirname(__FILE__)."/../connections/jury_of_peers_tbls.php";
 if(is_file($file_tbl))  require_once $file_tbl ;
 
class albums_photos_get_more_pagination_package extends jury_of_peers_tbls {
  
     
    public function albums_of_photo_load_more ( $last_id ,$limit , $me_or_asAvisitor ){
        // get all  
        $friend_system_applications_file = dirname(__FILE__)."/../autoload_apps.php";
        if(is_file($friend_system_applications_file)) require_once $friend_system_applications_file ;
         
         $frd_apis = new friend_system_applications() ;
         $me = $_SESSION['user_info']['user_id'] ;
         $visitor = $me_or_asAvisitor ; 
           
         $queryString = "
                 SELECT   
                      albums . *    
                       
                      
                 FROM 
                       photo_albums albums  
                 LEFT JOIN
                        user_apps user on albums.posted_by_id = user.id
                  LEFT JOIN
                        friend_system friends ON albums.posted_by_id = friends.id_receiver  
                 WHERE 
                          
                  (     # FOR FRIENDS MODE
                        (
                              (( friends.id_receiver = {$me_or_asAvisitor} or friends.id_sender = {$me_or_asAvisitor} ) AND ( friends.is_accepted = 1 ) )
                            AND
                              ( albums.access_permission = 0 OR albums.access_permission = 1 )
                            AND
                              ( ( albums.`user_id`= {$me_or_asAvisitor}) AND ( albums.`posted_by_id` != {$me_or_asAvisitor} OR albums.`posted_by_id` = {$me_or_asAvisitor}))
                        )
                 OR     # FOR PUBLIC MODE
                        (
                              (( friends.id_receiver IS NULL AND friends.id_sender IS NULL ) OR (friends.id_receiver ='' AND friends.id_sender ='')  OR ( friends.is_accepted = 0 ) )
                            AND
                                ( albums.access_permission = 1 OR ( albums.access_permission != 0 AND  albums.access_permission != 2 ) )
                            AND 
                              ( ( albums.`user_id`= {$me_or_asAvisitor}) AND ( albums.`posted_by_id` != {$me_or_asAvisitor} OR albums.`posted_by_id` = {$me_or_asAvisitor}))
                        )
                 OR     # FOR ME MODE 
                        (
                             ( albums.access_permission = 0 OR  albums.access_permission = 1 OR albums.access_permission = 2 )
                            AND 
                            ( ( albums.`user_id`= {$me}) AND ( albums.`posted_by_id` != {$me} OR albums.`posted_by_id` = {$me}))
                        )
                  )
                  
                  
                 AND 
                  ( albums.id > {$last_id} )  
                        
                
                 GROUP BY 
                        albums.id 
                 LIMIT 
                        {$limit}
                 
            ";
         
          // hide frd condotion in 30+
         
          $result = mysqli_query($this->open_connection() , $queryString  );
        if(!$result) return NULL  ;
       
        if(mysqli_num_rows($result) == 0 )  return 0 ;
        $listAll = [] ; 
        
        for ($i= 0 ; $i < mysqli_num_rows($result) ;$i++) 
        $listAll[count ($listAll)] = mysqli_fetch_object ($result) ;
       
        mysqli_free_result($result);
     
        return  $listAll   ;
    }
}

 /*
$ps = new user_get_more_pagination_package();
$users = $ps->user_add_new_friend_get_more_by_values(11,5);

echo '<pre>';
print_r($users );
echo '</pre>';
   */
?>
