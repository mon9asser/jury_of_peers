<?php
ob_start() ;
if(session_id()=='')
    session_start () ;
if(!isset($_SESSION['user_info']))
    return false ;
    
  
 $files = dirname(__FILE__)."/../modular/autoload_apps.php";
 if(is_file($files )) require_once $files  ;
    
 $text = $_POST['url-links'];
   $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
 
// Check if there is a url in the text
if(preg_match($reg_exUrl, $text, $url)) {
    $app = new apps() ;
    $fields = $app->extract_link($url[0]);
    
    $links = $url[0] ;
    $imageThumb = $fields['urlImgSrc'];
    $titleThumb = $fields['urlTitle'];
    $descriptionThumb = $fields['urlDescription'];
    $KeyWordsThumb = $fields['urlKeyWords'];
    $urlAutherThumb = $fields['urlAuther'];
    
    
    
    
    
     if(strpos($links, 'youtube.com') > 0  OR strpos($links, 'vimeo.com') > 0){
        $apps = new apps() ;
        $apps->embed_vimeo_youtube_video_preview_thumna($links);
     
         }else { 
    
    ?>
        <div style="background-image: url(<?php echo $imageThumb ;?>)" class="thumbnails-image">
            
            <input id="urllink" type="hidden" value="<?php echo $links ;?>" />
            <input id="imageThumb" type="hidden" value="<?php echo $imageThumb ;?>" />
            <input id="titleThumb" type="hidden" value="<?php echo $titleThumb ;?>" />
            <input id="descriptionThumb" type="hidden" value="<?php echo $descriptionThumb ;?>" />
            <input id="KeyWordsThumb" type="hidden" value="<?php echo $KeyWordsThumb ;?>" />
            <input id="urlAutherThumb" type="hidden" value="<?php echo $urlAutherThumb ;?>" />
            
            <div class="mask-image"></div>
           <a class="url-links"><?php echo substr($links, 0, 53);  ?>   </a>
        </div>
        <div class="thumbnails-text-links">
           
           <h3> <?php echo  $titleThumb ;  ?></h3>
          
           <p>
               <?php 
                 echo substr($descriptionThumb, 0, 152 );
               
               ?>
           
          </p>
        </div>
    <?php
    
                                                }
    
    
    
    
    
}

?>

