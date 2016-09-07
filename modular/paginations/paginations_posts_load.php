<?php
ob_start(); 
if(session_id() == '')
     session_start () ;
 
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
    
    
    public function load_posts_accordin_to_id ( $last_id  ){
        
         // get all  
        $friend_system_applications_file = dirname(__FILE__)."/../autoload_apps.php";
        if(is_file($friend_system_applications_file)) require_once $friend_system_applications_file ;
         
         $frd_apis = new friend_system_applications() ;
          
         
         $queryString = "
                 SELECT   
                       posts . *  ,  
                       user.f_name , user.s_name , user.u_name  , user.gender , user.e_mail   ,
                       ppics.photo_src , ppics.photo_name ,  
                       music.music_name , music.music_discribtion , music.music_src , music.singer_name , music.music_cover ,
                       img.album_id , img.img_dscription , img.app_serial , img.img_src,
                       vid.video_name , vid.video_description , vid.video_src,
                       links.url_links ,  links.image_src ,  links.title , links.keyword , links.description,

                        txt.post_text  
                      
                 FROM 
                       user_posts posts  
                 LEFT JOIN
                        user_apps user on posts.posted_by_id = user.id
                 LEFT JOIN
                        profile_picture ppics ON posts.posted_by_id = ppics.user_id   
                 LEFT JOIN
                        music_posts music ON posts.post_serial_id=music.post_serial_id
                 LEFT JOIN
                        images img ON posts.post_serial_id=img.post_serial_id 
                 LEFT JOIN
                        video_posts vid ON posts.post_serial_id=vid.post_serial_id
                  LEFT JOIN
                        user_links links ON posts.post_serial_id=links.post_serial_id
                 LEFT JOIN
                         text_posts txt ON posts.post_text_id=txt.id
                 LEFT JOIN
                         friend_system friends ON posts.posted_by_id = friends.id_receiver OR posts.posted_by_id = friends.id_sender 
                  WHERE
                ( posts.id = {$last_id} )  
                    AND 
                     (posts.`is_deleted`=0)
                      
            ";
         
          // hide frd condotion in 30+
         
          $result = mysqli_query($this->open_connection() , $queryString  );
        if(!$result) return NULL  ;
       
        if(mysqli_num_rows($result) == 0 )  return 0 ;
        $listAll = [] ; 
        
        for ($i= 0 ; $i < mysqli_num_rows($result) ;$i++) 
        $listAll[count ($listAll)] = mysqli_fetch_object ($result) ;
       
        mysqli_free_result($result);
     
        return  $listAll[0]   ;
    }
    
    
    
     public function load_posts_according_to_args( $last_id ,$limit , $me_or_asAvisitor ){
        
         // get all  
        $friend_system_applications_file = dirname(__FILE__)."/../autoload_apps.php";
        if(is_file($friend_system_applications_file)) require_once $friend_system_applications_file ;
         
         $frd_apis = new friend_system_applications() ;
         $me = $_SESSION['user_info']['user_id'] ;
         $visitor = $me_or_asAvisitor ; 
         
         if($last_id == 0 )
              $last_id = " ( SELECT MAX(id)+1  FROM `user_posts` ) ";
          
         $conditionPost1 = '';
         if($me != $visitor)
         {
             $conditionPost1 = '
                 (
                    ( friends.id_receiver = '.$me.' AND friends.id_sender = '.$visitor.' AND friends.is_accepted = 1) 
                     OR 
                    ( friends.id_receiver = '.$visitor.' AND friends.id_sender = '.$me.' AND friends.is_accepted = 1)
                 )
                 AND 
                 ( posts.access_permission = 0 OR posts.access_permission = 1 )
                 AND
                 (posts.`user_id` = '.$visitor.' AND (posts.`posted_by_id`= '.$visitor.' OR posts.`posted_by_id` != '.$visitor.'))
                 
                 ';
         }else if($me == $visitor){
             $conditionPost1 = '
                 (posts.`user_id` = '.$me.' AND (posts.`posted_by_id`= '.$me.' OR posts.`posted_by_id` != '.$me.'))
                     
                ';
         }
         
         
         $queryString = "
                 SELECT   
                       posts . *  ,  
                       user.f_name , user.s_name , user.u_name  , user.gender , user.e_mail   ,
                       ppics.photo_src , ppics.photo_name ,  
                       music.music_name , music.music_discribtion , music.music_src , music.singer_name , music.music_cover ,
                       img.album_id , img.img_dscription , img.app_serial , img.img_src,
                       vid.video_name , vid.video_description , vid.video_src, vid.id AS video_id ,
                       links.url_links ,  links.image_src ,  links.title , links.keyword , links.description,
                       txt.post_text  
                      
                 FROM 
                       user_posts posts  
                 LEFT JOIN
                        user_apps user on posts.posted_by_id = user.id
                 LEFT JOIN
                        profile_picture ppics ON posts.posted_by_id = ppics.user_id   
                 LEFT JOIN
                        music_posts music ON posts.post_serial_id=music.post_serial_id
                 LEFT JOIN
                        images img ON posts.post_serial_id=img.post_serial_id 
                 LEFT JOIN
                        video_posts vid ON posts.post_serial_id=vid.post_serial_id
                  LEFT JOIN
                      user_links links ON posts.post_serial_id=links.post_serial_id
                 LEFT JOIN
                         text_posts txt ON posts.post_text_id=txt.id
                 LEFT JOIN
                         friend_system friends ON posts.posted_by_id = friends.id_receiver OR posts.posted_by_id = friends.id_sender 
                 WHERE 
                        (        # FOR PUBLIC MODE
                             # (( friends.id_receiver IS NULL AND friends.id_sender IS NULL ) OR (friends.id_receiver ='' AND friends.id_sender ='')  OR ( friends.is_accepted = 0 ) )
                           # AND
                                ( posts.access_permission = 1 OR ( posts.access_permission != 0 AND  posts.access_permission != 2 ) )
                            AND 
                              ( ( posts.`user_id`= {$me_or_asAvisitor}) AND ( posts.`posted_by_id` != {$me_or_asAvisitor} OR posts.`posted_by_id` = {$me_or_asAvisitor}))
                        )
                        OR      
                  {$conditionPost1} # GET POST IN OTHER PROFILES
                        AND
                ( posts.id < {$last_id} )  
                     AND 
                     (posts.`is_deleted`=0)
                GROUP BY 
                        posts.id 
                 
                 DESC LIMIT 
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
    
    
    
    
    
    
    
    
    public function home_page_load_contents( $last_timestamps ,$limit , $me_or_asAvisitor ){
        
       
         // get all  
        $friend_system_applications_file = dirname(__FILE__)."/../autoload_apps.php";
        if(is_file($friend_system_applications_file)) require_once $friend_system_applications_file ;
         
         
         $me = $_SESSION['user_info']['user_id'] ;
         $visitor = $me_or_asAvisitor ; 
         if($last_timestamps == 0 )
             $last_timestamps = " ( SELECT MAX(timeupdates)+1  FROM `user_posts` ) ";
        
          $queryString = "
                 SELECT   
                       posts . *  , 
                       user.f_name , user.s_name , user.u_name  , user.gender , user.e_mail ,
                       ppics.photo_src , ppics.photo_name ,
                       music.music_name , music.music_discribtion , music.music_src , music.singer_name , music.music_cover ,
                       img.album_id , img.img_dscription , img.app_serial , img.img_src,
                       vid.video_name , vid.video_description , vid.video_src, vid.id AS video_id,
                       links.url_links ,  links.image_src ,  links.title , links.keyword , links.description,
                       txt.post_text ,
                       
                       album_img.user_id ,album_img.album_name ,album_img.album_description ,album_img.app_serial    , album_img.post_serial_id  AS album_img_serial_id,
                       album_msc.user_id , album_msc.album_name ,album_msc.app_serial , album_msc.post_serial_id  AS music_serial_id ,
                       album_vid.user_id ,album_vid.album_name ,album_vid.group_name ,album_vid.app_serial ,album_vid.post_serial_id  AS album_vid_serial_id
                      
                 FROM 
                       user_posts posts  
                 LEFT JOIN
                        user_apps user on posts.posted_by_id = user.id
                 LEFT JOIN
                        profile_picture ppics ON posts.posted_by_id =ppics.user_id
                 LEFT JOIN
                        music_posts music ON posts.post_serial_id=music.post_serial_id
                 LEFT JOIN
                        images img ON posts.post_serial_id=img.post_serial_id 
                 LEFT JOIN
                        video_posts vid ON posts.post_serial_id=vid.post_serial_id
                 LEFT JOIN
                        user_links links ON posts.post_serial_id=links.post_serial_id
                 LEFT JOIN
                        text_posts txt ON posts.post_text_id=txt.id
                 LEFT JOIN
                        video_film_categories album_vid on posts.post_serial_id = album_vid.post_serial_id
                 LEFT JOIN
                        music_albums album_msc on posts.post_serial_id = album_msc.post_serial_id
                 LEFT JOIN
                        photo_albums album_img on posts.post_serial_id = album_img.post_serial_id
                 LEFT JOIN
                        friend_system friends ON posts.posted_by_id = friends.id_receiver OR posts.posted_by_id = friends.id_sender 
                 WHERE 
                   (     
                     ( ( posts.`user_id`= {$me_or_asAvisitor} OR posts.`user_id` != {$me_or_asAvisitor}) AND ( posts.`posted_by_id` != {$me_or_asAvisitor} OR posts.`posted_by_id` = {$me_or_asAvisitor}))
                     AND
                     ( posts.access_permission = 0 OR posts.access_permission = 1 )
                     AND 
                     (( friends.id_receiver = {$me_or_asAvisitor} or friends.id_sender = {$me_or_asAvisitor} ) AND ( friends.is_accepted = 1 ) )
                    
                  ) 
                  
                  
                 AND 
                  ( posts.timeupdates < {$last_timestamps} )  
                   AND 
                     (posts.`is_deleted`=0)      
                
                 GROUP BY 
                       posts.timeupdates  
                 DESC LIMIT 
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
    
    
    
    public function load_more_court_rooms ( $last_id ,$limit , $me_or_asAvisitor ){
        
       
         // get all  
        $friend_system_applications_file = dirname(__FILE__)."/../autoload_apps.php";
        if(is_file($friend_system_applications_file)) require_once $friend_system_applications_file ;
         
         $frd_apis = new friend_system_applications() ;
         $me = $_SESSION['user_info']['user_id'] ;
         $visitor = $me_or_asAvisitor ; 
         /*
          if($last_id == 0)
            {
              $hhr = 'Select * from user_posts order by timeupdates desc limit 1 offset 1' ;
             $qu =  mysqli_query($this->open_connection(),$hhr);
             while ($row = mysqli_fetch_object($qu) )
                $last_id = $bigTime =  $row->timeupdates ;
             } 
                 */
          $queryString = "
                 SELECT courroom . * FROM `courtroom_init` courroom
                 LEFT JOIN
                        friend_system friends ON (courroom.plaintiff_id = friends.id_receiver OR courroom.plaintiff_id = friends.id_sender) OR (courroom.defedant_id = friends.id_receiver OR courroom.defedant_id = friends.id_sender)
                 WHERE 
                   (     
                     ( ( courroom.`plaintiff_id` != {$me_or_asAvisitor} OR courroom.`plaintiff_id` = {$me_or_asAvisitor}) OR ( courroom.`defedant_id` != {$me_or_asAvisitor} OR courroom.`defedant_id` = {$me_or_asAvisitor}))
                      AND 
                     (( friends.id_receiver = {$me_or_asAvisitor} or friends.id_sender = {$me_or_asAvisitor} ) AND ( friends.is_accepted = 1 ) )
                  ) 
                   
                 GROUP BY 
                       courroom.id 
                 DESC LIMIT 
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

 
   
?>
