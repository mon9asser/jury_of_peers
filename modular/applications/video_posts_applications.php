 <?php
 $autoload_tbl = dirname(__FILE__)."/../connections/jury_of_peers_tbls.php";
if(is_file($autoload_tbl )) require_once $autoload_tbl ;

$autoload_file = dirname(__FILE__)."/../apis/apis_autoload.php";
if(is_file($autoload_file )) require_once $autoload_file ;

$autoload_applications = dirname(__FILE__)."/../general_applications/apps.php";
if(is_file($autoload_applications )) require_once $autoload_applications ;

class video_posts_applications extends jury_of_peers_tbls {
    
    // TABLE
    private function table(){ return $this->video_posts_get();}
    
    
    
    
    /******************************************************************************************/
    /******************************** Retrive Functions ***************************************/
    /******************************************************************************************/
    public function video_posts_apis_get_all ($args = NULL ){
       $getApps = new main_get_app();
       return $getApps->get_all_rows ( $this->table() ,$args);   
    }
    public function video_posts_search_apis( $args, $operatorType /*Or - and */){
       $getApps = new main_get_app();
       return $getApps->get_data_according_to_array($this->table(), $args, '%', $operatorType);
    }
    public function video_posts_get_by_values ($args, $type /*OR-AND*/, $operatorType = NULL ){
       $getApps = new main_get_app();
       return $getApps->get_data_according_to_array($this->table(), $args, $type, $operatorType);
    }
    public function video_posts_check_exist ($value_args=[], $type = NULL){
               $getApps = new main_get_app();
       return $getApps->get_data_according_to_array($this->table(), $value_args, $type, $operatorType= NULL); 
    }
    
    /******************************************************************************************/
    /******************************** Add Functions *******************************************/
    /******************************************************************************************/
    
    public function video_posts_add_new_field ($args = []){
               $Add_module = new main_add_app;
              $add_result = $Add_module->add_new_fields($this->table() , $args );
              if($add_result)  
                      return TRUE ;
     }
    
    
    /******************************************************************************************/
    /******************************** Update Functions *******************************************/
    /******************************************************************************************/
    public function video_posts_update_fields ($column_args =[] , $value_args = []){
         $update_module = new main_update_app() ;
        $update_result =  $update_module->Module_Update($this->table() , $column_args, $value_args) ;
        if($update_result) return true;
    }
    
    /******************************************************************************************/
    /******************************** Delte Functions *******************************************/
    /******************************************************************************************/   
    public function video_posts_delete_fields ($args=[]){
        
        $delete_module = new delete_application() ;
        return $delete_module->Module_Delete($this->table() , $args);
    }
     
}   
   
 

?>
