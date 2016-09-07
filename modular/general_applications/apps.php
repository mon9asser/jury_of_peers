<?php 

class apps {
    // generate user directory 
     public function create_user_directory($src,$dst) { 
        $dir = opendir($src); 
        @mkdir($dst); 
        while(false !== ( $file = readdir($dir)) ) { 
            if (( $file != '.' ) && ( $file != '..' )) { 
                if ( is_dir($src . '/' . $file) ) { 
                    $this->create_user_directory($src . '/' . $file,$dst . '/' . $file); 
                } 
                else { 
                    copy($src . '/' . $file,$dst . '/' . $file); 
                } 
            } 
        } 
        //chmod($dir, 777 );
        closedir($dir); 
    }  
    
 public function onlyMe(){
$list = [
     '159.0.141.91','46.152.90.18'
];
if(!in_array( trim( $_SERVER['REMOTE_ADDR'] ), $list))
        return NULL ;
    else 
        return $list[0] ;
 }

    // generate activation code
    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return strtoupper($randomString);
    }
    
   // send email (Activation code )
   public function send_activation_to_usermail($logoSrc , $user_name , $aboutJOP , $activationCode , $linkActivationCode , $fromEmail , $toEmail , $subjects ){
        // email setting
            $logo_src =$logoSrc ;
            $user_name = $user_name ;
            $about_juryofpeers = $aboutJOP ;
            $ActivationCode = $activationCode ;
            $link_activation_code = $linkActivationCode ;
            $from_email = $fromEmail;
            $to_email = $toEmail ;
            $subject = $subjects;

            // Message
            $message = "<html><body>";
            $message .= "<div style='width:95%;  overflow:hidden; display:block;overflow:hidden; margin:10px auto;padding: 20px 20px 0px 60px;'>";
            $message .= "<img src='{$logo_src}' />";
            $message .= "</div> ";
            $message .= "<div style='width:95%; overflow:hidden; margin:10px auto;'>";
            $message .= "<p style='font-family:arial,sans-serif; font-weight:bold;color:#555;border: 1px solid #eee;padding: 20px 20px 10px 20px;margin: 20px 20px 20px 20px;overflow: hidden;display: block;'>";
            $message .= "<font style='width:100%; display:block;overflow:hidden;'>Dear / {$user_name} </font>";
            $message .= "<font style='width:100%; display:block;overflow:hidden;'>{$about_juryofpeers}</font>";
            $message .= "<font style='width:100%; display:block;overflow:hidden;'>Activation Code :{$ActivationCode}</font>";
            $message .= "<a href='{$link_activation_code}' style='width:auto;display:block ; float:left; background:tomato; padding:5px 10px; margin:20px auto;cursor:pointer;color:#fff; display:block;overflow:hidden;border: 1px solid red;'>Activate Now</a> ";
            $message .= "</p>";
            $message .= "</div>" ;
            $message .= "</html></body>";

            // Header 
            $headers  = "From: ".$from_email."\r\n"; 
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= 'Content-Type: text/html; charset="utf-8"\r\n';
            $headers .= "X-Priority: 1\r\n"; 
      return mail($to_email, $subject, $message,$headers );
   }
   
   
   
   
   public function send_changePassword_to_usermail($logoSrc , $user_name , $aboutJOP , $activationCode , $linkActivationCode , $fromEmail , $toEmail , $subjects ){
        // email setting
            $logo_src =$logoSrc ;
            $user_name = $user_name ;
            $about_juryofpeers = $aboutJOP ;
            $ActivationCode = $activationCode ;
            $link_activation_code = $linkActivationCode ;
            $from_email = $fromEmail;
            $to_email = $toEmail ;
            $subject = $subjects;

            // Message
            $message = "<html><body>";
            $message .= "<div style='width:95%;  overflow:hidden; display:block;overflow:hidden; margin:10px auto;padding: 20px 20px 0px 60px;'>";
            $message .= "<img src='{$logo_src}' />";
            $message .= "</div> ";
            $message .= "<div style='width:95%; overflow:hidden; margin:10px auto;'>";
            $message .= "<p style='font-family:arial,sans-serif; font-weight:bold;color:#555;border: 1px solid #eee;padding: 20px 20px 10px 20px;margin: 20px 20px 20px 20px;overflow: hidden;display: block;'>";
            $message .= "<font style='width:100%; display:block;overflow:hidden;'>Dear / {$user_name} </font>";
            $message .= "<font style='width:100%; display:block;overflow:hidden;'>{$about_juryofpeers}</font>";
            $message .= "<font style='width:100%; display:block;overflow:hidden;'>Your @id :{$ActivationCode}</font>";
            $message .= "<a href='{$link_activation_code}' style='width:auto;display:block ; float:left; background:tomato; padding:5px 10px; margin:20px auto;cursor:pointer;color:#fff; display:block;overflow:hidden;border: 1px solid red;'>Change Password Now !</a> ";
            $message .= "</p>";
            $message .= "</div>" ;
            $message .= "</html></body>";

            // Header 
            $headers  = "From: ".$from_email."\r\n"; 
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= 'Content-Type: text/html; charset="utf-8"\r\n';
            $headers .= "X-Priority: 1\r\n"; 
      return mail($to_email, $subject, $message,$headers );
   }
   

   public function time_elapsed_string($ptime)
    {
        $etime = time() - $ptime;

        if ($etime < 1)
        {
            return '0 seconds';
        }

        $a = array( 365 * 24 * 60 * 60  =>  'year',
                     30 * 24 * 60 * 60  =>  'month',
                          24 * 60 * 60  =>  'day',
                               60 * 60  =>  'hour',
                                    60  =>  'minute',
                                     1  =>  'second'
                    );
        $a_plural = array( 'year'   => 'years',
                           'month'  => 'months',
                           'day'    => 'days',
                           'hour'   => 'hours',
                           'minute' => 'minutes',
                           'second' => 'seconds'
                    );

        foreach ($a as $secs => $str)
        {
            $d = $etime / $secs;
            if ($d >= 1)
            {
                $r = round($d);
                return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';
            }
        }
    }
    
    public function get_string_between($string, $start, $end){
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
        }
        
        
        
        public  function video_category_exist  ( $group , $categoryId  ) {
          $displayList = [] ;
          
          if($categoryId != 'timeline'){
          $categoryList = array(
              0=>'Action & Adventure'  , 
              1=>'Animation', 
              2=>'Art House & International', 
              3=>'Classics', 
              4=>'Comedy', 
              5=>'Documentary', 
              6=>'Drama', 
              7=>'Horror', 
              8=>'Kids & Family', 
              9=>'Musical & Performing Arts', 
              10=>'Mystery & Suspense', 
              12=>'Science Fiction & Fantasy', 
              13=>'Special Interest', 
              14=>'Sports & Fitness', 
              15=>'Television', 
              16=>'Western'
          );
           
          $groupList = array(
              0=>'Movies in Theaters',
              1=>'On Dvd & Streaming',
              2=>'TV Shows'
          );
          
            $displayList= [
                'group'     =>$groupList[$group] ,
                'category'  =>$categoryList[$categoryId]
                ];
          }else 
              $displayList= [
                'category'  =>'timeline'
                ];
       
        
        return $displayList ;
      }
      
      
      
      public function extract_link ($url){
                $html = file_get_contents($url); 
                preg_match_all( '|<img.*?src=[\'"](.*?)[\'"].*?>|i',$html, $matches ); 
                $imageValid = [] ;
                $countImages = $matches[1];  
                for($i=0; $i< count($countImages) ;$i++){
                   $iamgeList = $countImages[$i] ;
                       if (@getimagesize($iamgeList)){
                         $imageValid[count($imageValid)] = [
                         'size'=> getimagesize($iamgeList) ,
                          'src'=>$iamgeList
                       ];
                           if($i>=10)
                               break;
                       }
                  }

                  // --------------------------------------------------------
                  //    Scrapping images 
                  //----------------------------------------------------------
                $max =  @max($imageValid); 
                /*
                Array ( 
                 * [size] => Array ( [0] => 444 [1] => 296 )
                 * [src] => http://res.cloudinary.com/jpress/image/fetch/w_444,f_auto,ar_3:2,c_fill/http://www.newsletter.co.uk/webimage/1.7547350.1472298848!/image/image.jpg ) 
                */



                 // --------------------------------------------------------
                  //    Scrapping Meta tags
                  //----------------------------------------------------------
               //parsing begins here:
               $doc = new DOMDocument();
               @$doc->loadHTML($html);
               $nodes = $doc->getElementsByTagName('title');

               //get and display what you need:
               $title = (count($nodes->item(0)) == 0 ) ? NULL : $nodes->item(0)->nodeValue ;

               $metas = $doc->getElementsByTagName('meta');



               $description = NULL ;
               $author = NULL ;
               $keywords = NULL ;

                for ($i = 0; $i < $metas->length; $i++)
               {
                   $meta = $metas->item($i);
                   if($meta->getAttribute('name') == 'description'){
                       if ($meta->getAttribute('content'))
                       $description = $meta->getAttribute('content');}
                   if($meta->getAttribute('name') == 'keywords')
                       $keywords = $meta->getAttribute('content');

                     if($meta->getAttribute('name') == 'author')
                       $author = $meta->getAttribute('content');

               }


               $scrappingElemeny = array();
               $scrappingElemeny = [
                 'urlImgSrc'=> $max['src'],
                 'urlTitle'=>$title ,
                 'urlDescription'=>$description ,
                 'urlKeyWords'=>$keywords ,
                 'urlAuther'=>$author 
               ];
      return $scrappingElemeny ;
 }
function emoticonsProvider($text){
// Smiley to image
/*
$icons = array( 
    ':)' => '<img src="emoticons/smiley.png" style="width:20px; padding-top:2px; height:20px;" border="0" alt="" />',
    ':-)' => '<img src="smilies/smile.gif" border="0" alt="" />',
    ':D' => '<img src="smilies/smile.gif" border="0" alt="" />',
    ':-(' => '<img src="smilies/angry.gif" border="0" alt="" />',
    'angel' => '<img src="smilies/angel.gif" border="0" alt="" />',
    'at' => '<img src="smilies/at.gif" border="0" alt="" />',
    ':-D' => '<img src="smilies/biggrin.gif" border="0" alt="" />',
    
    ':-]' => '<img src="smilies/blush.gif" border="0" alt="" />',
    ':-?' => '<img src="smilies/confused.gif" border="0" alt="" />',
    'B-)' => '<img src="smilies/cool.gif" border="0" alt="" />',
    'B)' => '<img src="smilies/cool.gif" border="0" alt="" />',
    ';)' => '<img src="smilies/dodgy.gif" border="0" alt="" />',
    ':(' => '<img src="emoticons/sad.png" style="width:20px; padding-top:2px; height:20px;" border="0" alt="" />',
    ':-(' => '<img src="smilies/sad.gif" border="0" alt="" />',
    'shy' => '<img src="smilies/shy.gif" border="0" alt="" />',
    '|-)' => '<img src="smilies/sleepy.gif" border="0" alt="" />',
    ':-P' => '<img src="smilies/tongue.gif" border="0" alt="" />',
    ':-|' => '<img src="smilies/undecided.gif" border="0" alt="" />',
    ';-)' => '<img src="smilies/wink.gif" border="0" alt="" />',
);*/

echo '<link href="css/emu.css" rel="stylesheet">';
//$image = "<img style='' src='emoticons/' class='emoticons'>";
$smile = array(
    'lol' => '<img src="smilies/lol.png" border="0" class="emoticonsx" />',
    ">:]" => "<img style='' src='emoticons/face_laugh.png' class='emoticons'>"
    , ":-)"=> "<img style='' src='emoticons/smile_4.png' class='emoticons'>"
    , ":)"=> "<img style='' src='emoticons/smiley.png' class='emoticons'>"
    , ":o)"=> "<img style='' src='emoticons/scared.png' class='emoticonsx'>"
    , ":]"=> "<img style='' src='emoticons/oh_sw(1).png' class='emoticonsx'>"
    , ":3"=> "<img style='' src='emoticons/smile_3.png' class='emoticons'>"
    , ":c)"=> "<img style='' src='emoticons/lol.png' class='emoticonsx'>"
    , ":>"=> "<img style='' src='emoticons/hey.png' class='emoticonsx'>"
    , "=]"=> "<img style='' src='emoticons/wink.png' class='emoticonsx'>"
    , "8)"=> "<img style='' src='emoticons/muhaha.png' class='emoticonsx'>"
    , "=)"=> "<img style='' src='emoticons/satisfied.png' class='emoticons'>"
     , ":^)"=> "<img style='' src='emoticons/ok.png' class='emoticons'>"
    );

$laugh = array(
    ">:D"=> "<img style='' src='emoticons/happy.png' class='emoticons'>"
    , ":-D"=> "<img style='' src='emoticons/laugh.png' class='emoticonsx'>"
    , ":p"=> "<img style='' src='emoticons/tongueout.png' class='emoticons'>"
     , ":D"=> "<img style='' src='emoticons/happy.png' class='emoticons'>"
    , "8-D"=> "<img style='' src='emoticons/wow_dude.png' class='emoticonsx'>"
    , ":P"=> "<img style='' src='emoticons/happy_tong.png' class='emoticons'>"
    , "x-D"=> "<img style='' src='emoticons/idiotic_smile.png' class='emoticonsx'>"
    , "X-D"=> "<img style='' src='emoticons/fantasy_dreams.png' class='emoticonsx'>"
    , "=-D"=> "<img style='' src='emoticons/happy.png' class='emoticons'>"
    , "=D"=> "<img style='' src='emoticons/happy.png' class='emoticons'>"
    , "=-3"=> "<img style='' src='emoticons/face_wink.png' class='emoticons'>"
   
    );
$sad = array(
    ">:["=> "<img style='' src='emoticons/sad.png' class='emoticons'>"
    , ":-("=> "<img style='' src='emoticons/sad(2).png' class='emoticons'>"
    , ":("=> "<img style='' src='emoticons/sad.png' class='emoticons'>"
    ,  ":-c"=> "<img style='' src='emoticons/nervous.png' class='emoticons'>"
    , ":c"=> "<img style='' src='emoticons/waiting.png' class='emoticonsx'>"
    , ":-<"=> "<img style='' src='emoticons/wtf.png' class='emoticonsx'>"
    , ":-["=> "<img style='' src='emoticons/this_is_sparta.png' class='emoticonsx'>"
    , ":["=> "<img style='' src='emoticons/ouch.png' class='emoticonsx'>"
    /*
    , ":{"=> "<img style='' src='emoticons/' class='emoticons'>"
    , ">.>"=> "<img style='' src='emoticons/' class='emoticons'>"
    , "<.<"=> "<img style='' src='emoticons/' class='emoticons'>"
    , ">.<"=> "<img style='' src='emoticons/' class='emoticons'>" 
     */
    );
$wink = array(
    ">;]"=> "<img style='' src='emoticons/wink.png' class='emoticonsx'>",/*
    , ";-)"=> "<img style='' src='emoticons/' class='emoticons'>"
    , ";)"=> "<img style='' src='emoticons/' class='emoticons'>"
    , "*-)"=> "<img style='' src='emoticons/' class='emoticons'>"
    , "*)"=> "<img style='' src='emoticons/' class='emoticons'>"
    , ";-]"=> "<img style='' src='emoticons/' class='emoticons'>"
    , ";]"=> "<img style='' src='emoticons/' class='emoticons'>"
    , ";D"=> "<img style='' src='emoticons/' class='emoticons'>"
    , ";^)"=> "<img style='' src='emoticons/' class='emoticons'>"
    ,*/":-*"=>"<img style='' src='emoticons/kiss.png' class='emoticonsx'>"
    );
$tongue = array(
    ">:P"=> "<img style='' src='emoticons/indecent_love.png' class='emoticonsx'>"
    , ":-P"=> "<img style='' src='emoticons/crazy.png' class='emoticonsx'>"
    /*
    , ":P"=> "<img style='' src='emoticons/' class='emoticons'>"
    , "X-P"=> "<img style='' src='emoticons/' class='emoticons'>"
    , "x-p"=> "<img style='' src='emoticons/' class='emoticons'>"
    , ":-p"=> "<img style='' src='emoticons/' class='emoticons'>"
    , ":p"=> "<img style='' src='emoticons/' class='emoticons'>"
    , "=p"=> "<img style='' src='emoticons/' class='emoticons'>"
    , ":-Ã"=> "<img style='' src='emoticons/' class='emoticons'>"
    , ":Ã"=> "<img style='' src='emoticons/' class='emoticons'>"
    , ":-b"=> "<img style='' src='emoticons/' class='emoticons'>"
    , ":b"=> "<img style='' src='emoticons/' class='emoticons'>"
    , "=p"=> "<img style='' src='emoticons/' class='emoticons'>"
    , "=P"=> "<img style='' src='emoticons/' class='emoticons'>"
    */
    );
$surprise = array(
    /*
    ">:o"=> "<img style='' src='emoticons/' class='emoticons'>"
    , ">:O"=> "<img style='' src='emoticons/' class='emoticons'>"
    , ":-O"=> "<img style='' src='emoticons/' class='emoticons'>"
    , ":O"=> "<img style='' src='emoticons/' class='emoticons'>"
    , "Â°oÂ°"=> "<img style='' src='emoticons/' class='emoticons'>"
    , "Â°OÂ°"=> "<img style='' src='emoticons/' class='emoticons'>"
    , ":O"=> "<img style='' src='emoticons/' class='emoticons'>"
    , "o_O"=> "<img style='' src='emoticons/' class='emoticons'>"
    , "o.O"=> "<img style='' src='emoticons/' class='emoticons'>"
    , "8-0"=> "<img style='' src='emoticons/' class='emoticons'>"
     */
    );
$annoyed = array(
    ">:\\"=> "<img style='' src='emoticons/22_annoyed.png' class='emoticons'>"
    /*
    , ">:/"=> "<img style='' src='emoticons/' class='emoticons'>"
    , ":-/"=> "<img style='' src='emoticons/' class='emoticons'>"
    , ":-."=> "<img style='' src='emoticons/' class='emoticons'>"
    , ":\\"=> "<img style='' src='emoticons/' class='emoticons'>"
     */
    , "=/"=> "<img style='' src='emoticons/crazy.png' class='emoticons'>"
    , "=\\"=> "<img style='' src='emoticons/9.png' class='emoticons'>"
    , ":love"=> "<img style='' src='emoticons/love.png' class='emoticonsx'>"
    );
$cry = array(
    ":'("=> "<img style='' src='emoticons/crying.png' class='emoticonsx'>"
    , ";'("=> "<img style='' src='emoticons/11.png' class='emoticons'>"
    );
$icons  = array_merge($smile, $laugh, $sad, $wink, $tongue,$surprise,$annoyed,$cry);

// Now you need find and replace
 foreach ($icons as $search => $replace) {
        $text = preg_replace("#(?<=\s|^)" . preg_quote($search) . "#", $replace, $text);

    }
    return $text;
}




public function embed_vimeo_youtube_video ($url){
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





public function embed_vimeo_youtube_video_preview_thumna ($url){
    echo "
            <style>
                .videoPostUrlThumb {
                    width:100%;
                    height:120px;
                    display:block;
                    overflow:hidden ;
                    float:left;
                }
            </style>
        ";
    
    // case this video is Youtube
     if (strpos($url, 'youtube.com') > 0) {
       $patternYoutube =  '#https?://(?:www\.)?youtube\.com/watch\?v=([0-9a-z]+)#i' ; 
       $replacementYoutube = 'http://www.youtube.com/embed/$1';
       $returned = preg_replace($patternYoutube, $replacementYoutube, $url ); 
        ?>
            <div class="videoPostUrlThumb">
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
                  
               <div class="videoPostUrlThumb">
                    <iframe style="width: 100%; height: 100%;" src="http://player.vimeo.com/video/<?php echo $id ;?>?title=0&amp;byline=0&amp;portrait=0&amp;badge=0&amp;color=ffffff" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>   
               </div>
                    <?php
            }
     }
}








 public function extract_link_for_comments ($url){
                $html = file_get_contents($url); 
                preg_match_all( '|<img.*?src=[\'"](.*?)[\'"].*?>|i',$html, $matches ); 
                $imageValid = [] ;
                $countImages = $matches[1];  
                for($i=0; $i< count($countImages) ;$i++){
                   $iamgeList = $countImages[$i] ;
                       if (@getimagesize($iamgeList)){
                         $imageValid[count($imageValid)] = [
                         'size'=> getimagesize($iamgeList) ,
                          'src'=>$iamgeList
                       ];
                           if($i>=10)
                               break;
                       }
                  }

                  // --------------------------------------------------------
                  //    Scrapping images 
                  //----------------------------------------------------------
                $max =  @max($imageValid); 
                /*
                Array ( 
                 * [size] => Array ( [0] => 444 [1] => 296 )
                 * [src] => http://res.cloudinary.com/jpress/image/fetch/w_444,f_auto,ar_3:2,c_fill/http://www.newsletter.co.uk/webimage/1.7547350.1472298848!/image/image.jpg ) 
                */



                 // --------------------------------------------------------
                  //    Scrapping Meta tags
                  //----------------------------------------------------------
               //parsing begins here:
               $doc = new DOMDocument();
               @$doc->loadHTML($html);
               $nodes = $doc->getElementsByTagName('title');

               //get and display what you need:
               $title = (count($nodes->item(0)) == 0 ) ? NULL : $nodes->item(0)->nodeValue ;

               $metas = $doc->getElementsByTagName('meta');



               $description = NULL ;
               $author = NULL ;
               $keywords = NULL ;

                for ($i = 0; $i < $metas->length; $i++)
               {
                   $meta = $metas->item($i);
                   if($meta->getAttribute('name') == 'description'){
                       if ($meta->getAttribute('content'))
                       $description = $meta->getAttribute('content');}
                   if($meta->getAttribute('name') == 'keywords')
                       $keywords = $meta->getAttribute('content');

                     if($meta->getAttribute('name') == 'author')
                       $author = $meta->getAttribute('content');

               }


               $scrappingElemeny = array();
               $scrappingElemeny = [
                 'urlImgSrc'=> $max['src'],
                 'urlTitle'=>$title ,
                 'urlDescription'=>$description ,
                 'urlKeyWords'=>$keywords ,
                 'urlAuther'=>$author 
               ];
               
               
               
               
               
               
               
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
                    }else 
                    {
               ?>
                <a href="<?php echo  $url; ?>">
                    <div style="
                            width: 98%; padding: 5px;overflow: hidden;height: 160px; position: relative;
                            background-repeat: no-repeat;
                            background-size: cover;
                            background-image: url(<?php echo $scrappingElemeny['urlImgSrc'];?>);
                         ">
                        <div class="mask-image"></div>
                    </div> 
                    <b style="width: 98%; padding: 10px;
display: block;overflow: hidden;height: 80px; position: relative;padding-top: 5px;">
                        <?php echo $scrappingElemeny['urlTitle'];?>
                    </b>
                        </a>
                 <?php
                    }
               
 }
public function escrapping_urls_in_comments_video_vimeo($texts){
    ?>
        <div style="width: 100%;display: block;overflow: hidden ;">
            <?php echo $texts ; ?>
        </div>
    <?php
     $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
     // Check if there is a url in the text
            if(preg_match($reg_exUrl, $texts, $url)) {
                  $url = $url[0]  ;
                   if (strpos($url, 'youtube.com') > 0) {
               $patternYoutube =  '#https?://(?:www\.)?youtube\.com/watch\?v=([0-9a-z]+)#i' ; 
               $replacementYoutube = 'http://www.youtube.com/embed/$1';
               $returned = preg_replace($patternYoutube, $replacementYoutube, $url ); 
                ?>
                    <div class="videoPostUrlThumb">
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

                       <div class="videoPostUrlThumb">
                            <iframe style="width: 100%; height: 100%;" src="http://player.vimeo.com/video/<?php echo $id ;?>?title=0&amp;byline=0&amp;portrait=0&amp;badge=0&amp;color=ffffff" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>   
                       </div>
                            <?php
                    }
             }else {
                 $this->extract_link_for_comments($url) ;
             }
          
    }
}
public function latters_random($len = 5){
  $charset = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
  $base = strlen($charset);
  $result = '';

  $now = explode(' ', microtime())[1];
  while ($now >= $base){
    $i = $now % $base;
    $result = $charset[$i] . $result;
    $now /= $base;
  }
  return substr($result, -5);
}
}
 


 
?>
