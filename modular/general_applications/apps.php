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
}
 


 
?>
