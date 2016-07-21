<?php
 
 $file_apis = dirname(__FILE__)."/../apis/main_get_app.php";
 if(is_file($file_apis))  require_once $file_apis ;
 
  $file_tbl = dirname(__FILE__)."/../connections/jury_of_peers_tbls.php";
 if(is_file($file_tbl))  require_once $file_tbl ;
 
class user_get_more_pagination_package_pst extends jury_of_peers_tbls {
   
    private function loadTable (){
        return $this->user_posts_get() ;
    }
    
    
    
    
    private function user_post_tbl (){
        return $this->user_posts_get() ;
    }
     private function friend_sys_tbl (){
        return $this->friend_system_get() ;
    }
    
    
    
    
    
    public function load_more_posts_in_time_line ( $lastId , $limit  , $args = [] , $OperatorType  ){
        
         // get connection string 
        $file_conx = dirname(__FILE__)."/../connections/jury_of_peers_db.php";
        if(is_file($file_conx))  require_once $file_conx ;
 
 
        $arguments = "WHERE `id` > {$lastId} AND" ;
        $i = 0 ;
        switch ($OperatorType) {
       
              
              case 'and':
                   foreach ($args as $key => $value) {
                            $arguments .=  " `".$key."`='".  mysqli_real_escape_string($this->open_connection(), htmlentities( strip_tags(trim($value)))) ."'";
                           if($i != (count($args)-1))
                               $arguments .= " AND";
                          $i++ ;
                       }
                 break;
                 
                 
               case 'or':
                   foreach ($args as $key => $value) {
                            $arguments .=  " `".$key."`='".mysqli_real_escape_string($this->open_connection(), htmlentities( strip_tags(trim($value))))."'";
                           if($i != (count($args)-1))
                               $arguments .= " OR";
                          $i++ ;
                       }
                 break;
             
        }
        
        $loadMore = $arguments." ORDER BY `id` DESC LIMIT {$limit} ";
        $get_apis = new main_get_app() ;
        $getAll = $get_apis->get_all_rows_desc($this->loadTable() , $loadMore) ; 
        return $getAll ;
    } 
    
    
    
    
    
    
    public function load_more_posts_in_timeline_frd ( $lastId , $limit  , $args  ){
        
         // get connection string 
        $file_conx = dirname(__FILE__)."/../connections/jury_of_peers_db.php";
        if(is_file($file_conx))  require_once $file_conx ;
 
 
        $arguments = "WHERE `id` > {$lastId} AND ". $args ;
       
        $loadMore = $arguments." ORDER BY `id` DESC LIMIT {$limit} ";
        $get_apis = new main_get_app() ;
        $getAll = $get_apis->get_all_rows_desc($this->loadTable() , $loadMore) ; 
        return $getAll ;
    } 
    
    
    
    
    public function load_more_posts_in_time_line_according_visistor_is_friend ($last_id , $limit , $visitorID , $OwnerId ){
        $file_conx = dirname(__FILE__)."/../connections/jury_of_peers_db.php";
        if(is_file($file_conx))  require_once $file_conx ;
        $conx = new connections_db() ;  
        $conx->open_connection() ;
          $queryString = "
            SELECT posts . * , friends . * FROM `user_posts` posts , `friend_system` friends 
            WHERE posts.user_id = {$OwnerId} AND posts.access_permission = 0 OR posts.access_permission = 1  AND 
              friends.id_sender = {$OwnerId} AND friends.id_receiver = {$visitorID} AND friends.is_accepted = 1 OR
                  friends.id_sender = {$visitorID} AND friends.id_receiver = {$OwnerId} AND friends.is_accepted = 1 
                 ORDER BY posts.id LIMIT {$limit}
             ";
        $query = mysqli_query($conx->open_connection() , $queryString  ) ;
        if(!$query ) return NULL ;
        if(mysqli_num_rows($query ) == 0) return false ;
        $listAll = [] ; 
        for ($i=mysqli_num_rows($query) -1 ; $i >= 0 ;$i--)
        $listAll[count ($listAll)] = mysqli_fetch_object ($query ) ;
        $conx ->close_connection() ;
        mysqli_free_result($query);
        return $listAll ;
    }
}




 
 /*
$ps = new user_get_more_pagination_package();
$users = $ps->load_more_posts_in_time_line_according_visistor_is_friend(360 ,5 , 9 , 1 );

echo '<pre>';
print_r($users );
echo '</pre>';
 */
?>
