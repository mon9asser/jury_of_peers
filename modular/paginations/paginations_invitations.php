<?php
 
 $file_apis = dirname(__FILE__)."/../apis/main_get_app.php";
 if(is_file($file_apis))  require_once $file_apis ;
 
  $file_tbl = dirname(__FILE__)."/../connections/jury_of_peers_tbls.php";
 if(is_file($file_tbl))  require_once $file_tbl ;
 
class user_get_more_pagination_invitation_package extends jury_of_peers_tbls {
   
    
    private function user_tbl (){
        return $this->courtroom_invitations_get();
    } 
     public function load_more_invitation_list( $lastId , $limit  , $args  ){
      //   echo $lastId ;
         // get connection string 
        $file_conx = dirname(__FILE__)."/../connections/jury_of_peers_db.php";
        if(is_file($file_conx))  require_once $file_conx ;
  
         $loadMore = "WHERE `id` > {$lastId} AND {$args} ORDER BY `id` LIMIT {$limit} ";
        $get_apis = new main_get_app() ;
        $getAll = $get_apis->get_all_rows_desc($this->user_tbl() , $loadMore) ; 
        return $getAll ;
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
