<?php

 function load_all_pages ($_FILE_DIR){
   foreach (glob(dirname(__FILE__)."/".$_FILE_DIR."/*.php") as $filename)
        {
            if(is_file($filename)) require_once $filename;
            else { echo "Please ensure that you include all files inside system ";
            return false ;}
        }
}
load_all_pages('apis');
load_all_pages('applications');
load_all_pages('connections'); 
load_all_pages('paginations'); 
load_all_pages('general_applications'); 
 
?>
