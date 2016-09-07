<?php
ob_start() ;
if(session_id()=='')
    session_start ();
if(!isset($_POST['AccType']))
    return false ;
if(!$_SESSION['user_info'])
    return FALSE ;
      $files  = dirname(__FILE__)."/../../modular/autoload_apps.php";
   if(is_file( $files))   require_once $files  ;
   
   ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$accessType = trim($_POST['AccType']) ;

 //array ( [name] => fb2.png [type] => image/png [tmp_name] => /tmp/phpEjK6Ls [error] => 0 [size] => 89943 ) 

if($accessType == 'add_app')
    {
        if(!isset($_POST['appName']) ||!isset($_POST['webSiteUrl']) || !isset($_POST['userNameApp']) || !isset($_FILES['appThumbnails'])   || !isset($_POST['applicationInfo']) || !isset($_POST['appCategory'])){
            return FALSE ;
        }
 
        $applicationApis = new app_s_program();
        $appApis = new apps();
        $exit = $applicationApis->app_s_check_exist(['app_username'=>$_POST['appName']]);
        if($exit == NULL )
        {
          
           $appName = trim( $_POST['appName'] );
           $applicationInfo =  trim( $_POST['applicationInfo']  );
           $appCategory =  trim($_POST['appCategory'] ) ;
           $userNameApp =  trim( $_POST['userNameApp']  );
           $webSiteUrl =  trim( $_POST['webSiteUrl']  );
                  
                  
                  
            $AppImageRandomThumb =  rand(1000, 500000).'_'.rand(1000, 500000).'_'.$_FILES['appThumbnails']['name'];
             $appCredentials =trim ('$j&u#r@y*op'.$appApis->latters_random(140).rand(1000, 50000000).'$j&u#r@y*op'.$appApis->latters_random(140).'$j&u#r@y*op'.rand(1000, 50000000));
             move_uploaded_file($_FILES['appThumbnails']['tmp_name'], '../app_files/'.$AppImageRandomThumb);
              $sdsd = $applicationApis->app_s_add_new_field([
                 'app_name'=>$appName ,
                 'app_username'=>$userNameApp ,
                 'app_thumbnails'=>$AppImageRandomThumb ,
                  'app_type'=> 1 ,
                  'web_url'=>$webSiteUrl ,
                 'app_secret_id'=>$appCredentials , 
                  'user_id'=> $_SESSION['user_info']['user_id'] ,
                 'app_info'=> $applicationInfo ,
                 'app_category'=>$appCategory ,
                 'time' => time()
             ]);
             
             if(!$sdsd) 
                 echo '204';
             else {
                 ?>
                     
                 
                <div style="width: 100%;display: block;">
                    <b style="width: 100%; display: block; line-height: 3;">
                        1 - Open this page <?php echo $webSiteUrl ; ?> and got head tag of html 
                    </b>
                    
                     <b style="width: 100%; display: block;line-height: 3;">
                        2 - copy & pest the following Private Key in your website head tag
                        <code style="
                     height: auto;width: 100%;display: block;background: #000;border: 0px;color: #fff;line-height: 1.5;padding: 10px;
                              ">
                            <font style="color: tomato;">&lt;</font><font style="color: tomato;">meta</font> property="juryofpeers:private_key" content="<?php echo $appCredentials;?>" <font style="color: tomato;">/&gt;</font>
                        </code>
                    </b>
                </div>   
                      
                  <?php
                 
             }
            
        }else {
            echo "404";
        }
    }

?>
