<?php
 
 $file_apis = dirname(__FILE__)."/../apis/main_get_app.php";
 if(is_file($file_apis))  require_once $file_apis ;
 
  $file_tbl = dirname(__FILE__)."/../connections/jury_of_peers_tbls.php";
 if(is_file($file_tbl))  require_once $file_tbl ;
 
class user_get_more_pagination_package extends jury_of_peers_tbls {
   
    private function loadTable (){
        return $this->user_applications_get() ;
    }
    
    
    public function user_add_new_friend_get_more_by_values ( $lastId , $limit , $acordingTo = NULL , $accorType= NULL ){
        /*
        $extractedArr = NULL ;
        if($acordingTo != NULL and $accorType != NULL )
            {
                
            } // $extractedArr .= ......
            */
        
        if( $acordingTo == NULL )
             $acordingTo = '' ;
         $loadMore = "WHERE `id` > {$lastId} AND `id` != $acordingTo LIMIT {$limit}";
        $get_apis = new main_get_app() ;
        $getAll = $get_apis->get_all_rows($this->loadTable() , $loadMore) ; 
        return $getAll  ;
    }
    
    
     
    public function search_about_friend ($text){
       $loadMore = "WHERE u_name = '%".$text."%' OR f_name='%".$text."%' OR s_name='%".$text."%'";  
       $get_apis = new main_get_app() ;
        $getAll = $get_apis->get_all_rows($this->friend_system_get() , $loadMore) ; 
        return $getAll  ;
    }
    
    
    
    public function user_friend_invite ( $lastId , $limit , $userId){
        /*
        $extractedArr = NULL ;
        if($acordingTo != NULL and $accorType != NULL )
            {
                
            } // $extractedArr .= ......
            */
         
        $valuse = "(`id_sender`={$userId} OR `id_receiver`={$userId}) AND is_accepted=1" ;
         $loadMore = "WHERE `id` > {$lastId} AND {$valuse} GROUP BY id LIMIT {$limit}";
        $get_apis = new main_get_app() ;
        $getAll = $get_apis->get_all_rows($this->friend_system_get() , $loadMore) ; 
        return $getAll  ;
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
