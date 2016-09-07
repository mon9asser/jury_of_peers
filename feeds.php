<?php
 


function embed_vimeo_youtube_video ($url){
    echo "
            <style>
                .videoPostUrl {
                    width:100%;
                    height:350px;
                    display:block;
                    overflow:hidden ;
                }
            </style>
        ";
    
    // case this video is Youtube
     if (strpos($url, 'youtube.com') > 0) {
       $patternYoutube =  '#https?://(?:www\.)?youtube\.com/watch\?v=([0-9a-z]+)#i' ; 
       $replacementYoutube = 'http://www.youtube.com/embed/$1';
       $returned = preg_replace($patternYoutube, $replacementYoutube, $url ); 
        ?>
            <div class="videoPostUrl">
                <iframe style="width: 100%; height: 100%;" src="<?php echo $returned ; ?>" frameborder="0" allowfullscreen></iframe>
            </div>
          <?php 
     }else if (strpos($url, 'vimeo.com') > 0 ) {
          if(preg_match(
                '/\/\/(www\.)?vimeo.com\/(\d+)($|\/)/',
                $url,
                $matches
            )){
              $id = $matches[2];  
              ?>
                  
               <div class="videoPostUrl">
                    <iframe style="width: 100%; height: 100%;" src="http://player.vimeo.com/video/<?php echo $id ;?>?title=0&amp;byline=0&amp;portrait=0&amp;badge=0&amp;color=ffffff" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>   
               </div>
                    <?php
            }
     }
}

 
  ?> 

   