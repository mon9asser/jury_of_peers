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
   public function send_activation_to_usermail($id , $actCode , $email ,$u_name){
       // email settings
       $to = $email;
       $subject = 'Jury of peers activation code';
       $link = NULL ;
       $username = $u_name ;
       $activation = $actCode ;
       $headers = "From: seo@juryofpeers.tv\r\n";
       $headers .= "Reply-To: seo@juryofpeers.tv\r\n";
       $headers .= "CC: seo@juryofpeers.tv\r\n";
       $headers .= "MIME-Version: 1.0\r\n";
       $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
       
       $message  = "<html><body>";
       $message .= "<div style='width=90%;  overflow:hidden; display:block;'><img style='padding-bottom:5px; width:100%;' src='images/email_banner.jpg' title='jury of peers logo' /></div>";
       $message .= "<div style='width:95%; overflow:hidden; margin:10px auto;'>
            <p style='font-family:arial,sans-serif; font-weight:bold;color:#555;padding: 0px;margin: 0px;'>
                <font style='width:100%; display:block;overflow:hidden;'>Dear / ".$username.",</font>
                <font style='width:100%; display:block;overflow:hidden;'>
                    thank you for registration! Now lets get you started. - please activate your account by use a copy past to your browser then complete your profile 
                </font>
               <span style='width:auto;display:block ; float:left; background:tomato; padding:5px 10px; margin:20px auto;cursor:pointer;color:#fff; display:block;overflow:hidden;'>
                   ".$activation."
                </span>
            </p>
        </div>";
       $message .= "</body></html>";
       $message .= "</body></html>";
     //  return mail($to, $subject, $message, $headers);
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
