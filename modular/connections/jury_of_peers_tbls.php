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
    
    private static $text_posts_app = 'text_posts';
   protected function text_posts_get (){
        return jury_of_peers_tbls::$text_posts_app;
   }
   
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
   
   
   private static $ourtroom_in_contolling = 'courtroom_in_contolling';
   protected function  courtroom_in_contolling_get (){
        return jury_of_peers_tbls::$ourtroom_in_contolling;
   }
    
   private static $Profile_picture= 'profile_picture';
   protected function  Profile_picture_get (){
        return jury_of_peers_tbls::$Profile_picture;
   }
   
   private static $user_posts = 'user_posts';
   protected function  user_posts_get (){
        return jury_of_peers_tbls::$user_posts;
   }
   
   private static $video_film_categories = 'video_film_categories';
   protected function  video_film_categories_get (){
        return jury_of_peers_tbls::$video_film_categories;
   }
   
   private static $video_posts = 'video_posts';
   protected function  video_posts_get (){
        return jury_of_peers_tbls::$video_posts;
   }
   
   private static $music_albums = 'music_albums';
   protected function  music_albums_get (){
        return jury_of_peers_tbls::$music_albums;
   }
   
   private static $music_posts = 'music_posts';
   protected function  music_posts_get (){
        return jury_of_peers_tbls::$music_posts;
   }
    
     private static $photo_albums = 'photo_albums';
   protected function  photo_albums_get (){
        return jury_of_peers_tbls::$photo_albums;
   }
    
      private static $images = 'images';
   protected function  images_get (){
        return jury_of_peers_tbls::$images;
   }
      private static $user_links = 'user_links';
   protected function   user_links_get (){
        return jury_of_peers_tbls::$user_links;
   }
      private static $user_contents = 'user_contents';
   protected function  user_contents_get (){
        return jury_of_peers_tbls::$user_contents;
   }
      private static $reviews_rating = 'reviews_rating';
   protected function  reviews_rating_get (){
        return jury_of_peers_tbls::$reviews_rating ;
   }
      private static $user_like_dislikes = 'user_like_dislikes';
   protected function  user_like_dislikes_get (){
        return jury_of_peers_tbls::$user_like_dislikes;
   }
      private static $comments = 'comments';
   protected function  comments_get (){
        return jury_of_peers_tbls::$comments;
   }
      private static $trending_courtrooms = 'trending_courtrooms';
   protected function  trending_courtrooms_get (){
        return jury_of_peers_tbls::$trending_courtrooms;
   }
   
   
    private static $courtroom_init = 'ourtroom_init';
   protected function  courtroom_init_get (){
        return jury_of_peers_tbls::$courtroom_init;
   }
   
   
    private static $courtroom_winned = 'courtroom_winned';
   protected function  courtroom_winned_get (){
        return jury_of_peers_tbls::$courtroom_winnedt;
   }
   
   
   
    private static $courtroom_votes = 'courtroom_votes';
   protected function  courtroom_votes_get (){
        return jury_of_peers_tbls::$courtroom_votes;
   }
   
   
   
    private static $courtroom_invitations = 'courtroom_invitations';
   protected function   courtroom_invitations_get (){
        return jury_of_peers_tbls::$courtroom_invitations;
   }
   
   
   
    private static $courtroom_comments = 'courtroom_comments';
   protected function   courtroom_comments_get (){
        return jury_of_peers_tbls::$courtroom_comments;
   }
   
   
   
    private static $jury_of_peers = 'jury_of_peers';
   protected function    jury_of_peers_get (){
        return jury_of_peers_tbls::$jury_of_peers;
   }
}

 
?>
