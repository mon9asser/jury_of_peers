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
    
    
    public function load_posts_according_to_args( $last_id ,$limit , $me_or_asAvisitor ){
        
         // get all  
        $friend_system_applications_file = dirname(__FILE__)."/../autoload_apps.php";
        if(is_file($friend_system_applications_file)) require_once $friend_system_applications_file ;
        
         
         
         $frd_apis = new friend_system_applications() ;
         $me = $_SESSION['user_info']['user_id'] ;
         $visitor = $me_or_asAvisitor ; 
         
         
         // post results - table
         $posts = " posts . * ";
         $postTbl_variable = " `user_posts` posts ";
         
         // user results - tble 
         $users = " users.f_name , users.s_name , users.gender , users.u_name , users.e_mail ";
         $usersTbl_variable =" LEFT OUTER JOIN user_apps users ON posts.posted_by_id = users.id " ;
         
         
         // profile picture results - table
         $profile_picture = " ppics.photo_src , ppics.photo_name " ;
         $profile_pictureTbl_variable =" LEFT OUTER JOIN profile_picture ppics ON posts.posted_by_id =ppics.user_id " ;
         
         // Music results - table 
         $musics = " music.music_name , music.music_discribtion , music.music_src , music.singer_name , music.music_cover ";
         $musicsTbl_variable = " LEFT OUTER JOIN music_posts music ON posts.post_serial_id=music.post_serial_id " ;
         
         
         // post images 
         $post_images = " img.album_id , img.img_dscription , img.app_serial , img.img_src ";
         $post_imagesTbl_variable = " LEFT OUTER JOIN images img ON posts.post_serial_id=img.post_serial_id " ;
         
         // post videos 
         $post_videos = " vid.video_name , vid.video_description , vid.video_src "; 
         $post_videosTbl_variable = " LEFT OUTER JOIN video_posts vid ON posts.post_serial_id=vid.post_serial_id " ;
         
         // post Links 
         $post_links = " links.url_links ,  links.content_blob ,  links.app_serial ";
         $post_linksTbl_variable = " LEFT OUTER JOIN user_links links ON posts.post_serial_id=links.post_serial_id " ;
         
         // post Texts 
         $post_texts = " txt.post_text " ;
         $post_textsTble_variables = " LEFT OUTER JOIN text_posts txt ON posts.post_serial_id=txt.post_serial_id " ;
         
         // friend exists 
         $friendsTable_variables = "`friend_system` friends";
         $friends = "friends . id_receiver , friends . is_accepted , friends . id_sender";
         $isFriend = "" ; 
         // check and search about friends 
          $friendApis = new friend_system_applications();  
           if( $me != $visitor ){ // visitor
                $isFriend = $friendApis->friend_system_apis_get_all(" WHERE ( `id_sender` = {$me} AND `id_receiver` = {$visitor} AND `is_accepted`=1 ) OR (`id_sender` = {$visitor} AND `id_receiver` = {$me} AND `is_accepted`=1 ) ");
                if(count($isFriend) > 0 ){  // friends only
                   $isFriend .= " ((friends.`id_sender`= {$me} AND  friends.id_receiver = {$visitor} AND friends.`is_accepted`= 1 ) OR (friends.`id_sender`= {$visitor} AND  friends.id_receiver = {$me} AND friends.`is_accepted`= 1)) AND (posts.`access_permission` = 0 OR posts.`access_permission` = 1)" ;  
                  }else{ // public access 
                     $isFriend .= " ( posts.`access_permission` = 1) " ; 
               }
            }else { // me 
                $isFriend ="" ;
            }
           
             
            
            
            $limitations = " posts.`id` > {$last_id} GROUP BY posts.`id` ORDER BY posts.`id` DESC LIMIT {$limit} ";
            $postConditions = "( posts.`posted_by_id` != {$me_or_asAvisitor} OR posts.`posted_by_id` = {$me_or_asAvisitor} ) AND (posts.`user_id`= {$me_or_asAvisitor} ) " ;
             $TableParameter = " {$posts}           ,   {$profile_picture},                 {$musics}               ,   {$post_images},             {$post_videos},             {$post_links},                  {$post_texts},                  {$users}                {$friends}" ;
            $defineTables = " {$postTbl_variable}   ,   {$profile_pictureTbl_variable}      {$musicsTbl_variable}       {$post_imagesTbl_variable}  {$post_videosTbl_variable}  {$post_linksTbl_variable}       {$post_textsTble_variables}     {$usersTbl_variable}    {$friendsTable_variables}       " ;
            $conditions = "{$postConditions} {$isFriend} ";
            $queryString = "SELECT {$TableParameter} FROM {$defineTables} WHERE {$conditions} AND {$limitations}";
            
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
$users = $ps->load_more_posts_in_time_line_according_visistor_is_friend(360 ,5 , 9 , 1 );

echo '<pre>';
print_r($users );
echo '</pre>';
 */
?>
