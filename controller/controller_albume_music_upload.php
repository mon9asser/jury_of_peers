<?php
ob_start() ;
if(session_id()=='')
    session_start () ;
if(!isset($_SESSION['user_info']))
    return false ;

 $files = dirname(__FILE__)."/../modular/autoload_apps.php";
 if(is_file($files )) require_once $files  ;
    
    $uploader = new Uploader();
    $data = $uploader->upload($_FILES['files'], array(
        'limit' => 10, //Maximum Limit of files. {null, Number}
        'maxSize' => 10, //Maximum Size of files {null, Number(in MB's)}
        'extensions' => null, //Whitelist for file extension. {null, Array(ex: array('jpg', 'png'))}
        'required' => false, //Minimum one file is required for upload {Boolean}
        'uploadDir' => '../music_albums/', //Upload directory {String}
        'title' => array('name'), //New file name {null, String, Array} *please read documentation in README.md
        'removeFiles' => true, //Enable file exclusion {Boolean(extra for jQuery.filer), String($_POST field name containing json data with file names)}
        'perms' => null, //Uploaded file permisions {null, Number}
        'onCheck' => null, //A callback function name to be called by checking a file for errors (must return an array) | ($file) | Callback
        'onError' => null, //A callback function name to be called if an error occured (must return an array) | ($errors, $file) | Callback
        'onSuccess' => null, //A callback function name to be called if all files were successfully uploaded | ($files, $metas) | Callback
        'onUpload' => null, //A callback function name to be called if all files were successfully uploaded (must return an array) | ($file) | Callback
        'onComplete' => null, //A callback function name to be called when upload is complete | ($file) | Callback
        'onRemove' => 'onFilesRemoveCallback' //A callback function name to be called by removing files (must return an array) | ($removed_files) | Callback
    ));
    
    if($data['isComplete']){
        $files = $data['data'];
        // Insert to databases 
        $date = $files['metas'][0]['date'] ;
        $extension = $files['metas'][0]['extension'] ;
        $file = $files['metas'][0]['file'] ;
        $name = $files['metas'][0]['name'] ;
        $old_name = $files['metas'][0]['old_name'] ;
        $size = $files['metas'][0]['size'] ;
        $size2 = $files['metas'][0]['size2'] ;
        $type1 = $files['metas'][0]['type'][0] ;
        $type2 = $files['metas'][0]['type'][1] ;
        
        $code_id = rand(2000,9000000).rand(2000,9000000).rand(2000,9000000).rand(2000,9000000);
        $name_untitled = trim('Untitled Album');

        // Save Album
        $music_album_apis = new music_albums_applications();
       
        $album_name_exist = $music_album_apis->music_albums_check_exist(['album_name'=>$name_untitled]);
        if($album_name_exist != NULL ) // Update Name
        {
            
              
                    // add images 
                     $musicApis = new music_posts_applications() ;
                    $musicApis->music_posts_add_new_field([
                        'album_id'=>$album_name_exist->id ,
                        'user_id'=> $_SESSION['user_info']['user_id'] , 
                        'music_src'=>$name , 
                        'app_serial'=>$album_name_exist->post_serial_id ,
                        'created_on'=> time() , 
                        'file_size'=> $size2 , 
                        'posted_by_id'=>  $_SESSION['user_info']['user_id']     ,
                        'post_serial_id'=>$album_name_exist->post_serial_id 
                    ]);
            
            
        }else{ // Add new Album
            $music_album_apis->music_albums_add_new_field([
                'user_id'=>         $_SESSION['user_info']['user_id']     ,
                'album_name'=>      $name_untitled               ,
                'app_serial'=>      $code_id                ,
                'timestamps'=>      time()                ,
                 'posted_by_id'=>   $_SESSION['user_info']['user_id']     , 
                'post_serial_id'=>  $code_id
            ]);
            
            sleep(1);
             $album_name_exist = $music_album_apis->music_albums_check_exist(['album_name'=>$name_untitled]);
             // add images 
                     $musicApis = new music_posts_applications() ;
                    $musicApis->music_posts_add_new_field([
                        'album_id'=>$album_name_exist->id ,
                        'user_id'=> $_SESSION['user_info']['user_id'] , 
                        'music_src'=>$name , 
                        'app_serial'=>$album_name_exist->post_serial_id ,
                        'created_on'=> time() , 
                        'file_size'=> $size2 , 
                        'posted_by_id'=>  $_SESSION['user_info']['user_id']     ,
                        'post_serial_id'=>$album_name_exist->post_serial_id 
                    ]);
        }
    }

    if($data['hasErrors']){
        $errors = $data['errors'];
        print_r($errors);
    }
    
    
    
    function onFilesRemoveCallback($removed_files){
        foreach($removed_files as $key=>$value){
            $file = '../music_albums/' . $value;
            if(file_exists($file)){
                unlink($file);
            }
        }
         
        return $removed_files;
    }
?>
