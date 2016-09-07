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
        'uploadDir' => '../photo_albums/', //Upload directory {String}
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
        print_r($files);
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
        $album_image_apis = new photo_albums_applications();
       $app_serial = rand(1000, 125452145).'jury_of_peers'.rand(1054, 2000021454) ;
        $album_name_exist = $album_image_apis->photo_albums_check_exist(['album_name'=>$name_untitled]);
        if($album_name_exist != NULL ) // Update Name
        {
                      // add images 
                    $imageApis = new images_applications();
                    $imageApis->images_applications_add_new_field([
                        'user_id'=>$_SESSION['user_info']['user_id'] ,
                        'album_id'=>$album_name_exist->id ,
                         'app_serial'=>$app_serial ,
                        'img_size'=>$size2 , 
                         'img_src'=>$name , 
                        'img_type'=>$type1 ,
                        'posted_by_id'=>$_SESSION['user_info']['user_id'] ,
                        'post_serial_id'=>$app_serial
                    ]);
            
            
        }else{ // Add new Album
            $album_image_apis->photo_albums_add_new_field([
                        'user_id'=>$_SESSION['user_info']['user_id'] ,
                          'app_serial'=>$app_serial ,
                         'timestamps'=>  time() ,
                          'posted_by_id'=>$_SESSION['user_info']['user_id'] ,
                        'post_serial_id'=>$app_serial ,
                        'album_name'=>$name_untitled
             ]);
            
            sleep(1);
             $album_name_exist = $album_image_apis->photo_albums_check_exist(['album_name'=>$name_untitled]);
             // add images 
                     $imageApis = new images_applications();
                    $imageApis->images_applications_add_new_field([
                       'user_id'=>$_SESSION['user_info']['user_id'] ,
                        'album_id'=>$album_name_exist->id ,
                         'app_serial'=>$app_serial ,
                        'img_size'=>$size2 , 
                         'img_src'=>$name , 
                        'img_type'=>$type1 ,
                        'posted_by_id'=>$_SESSION['user_info']['user_id'] ,
                        'post_serial_id'=>$app_serial
                    ]);
        }
    }

    if($data['hasErrors']){
        $errors = $data['errors'];
        print_r($errors);
    }
    
    
    
    function onFilesRemoveCallback($removed_files){
        foreach($removed_files as $key=>$value){
            $file = '../video_albums/' . $value;
            if(file_exists($file)){
                unlink($file);
            }
        }
         
        return $removed_files;
    }
?>
