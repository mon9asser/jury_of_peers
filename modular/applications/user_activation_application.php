<?php
 

$autoload_tbl = dirname(__FILE__)."/../connections/jury_of_peers_tbls.php";
if(is_file($autoload_tbl )) require_once $autoload_tbl ;

$autoload_file = dirname(__FILE__)."/../apis/apis_autoload.php";
if(is_file($autoload_file )) require_once $autoload_file ;

$autoload_applications = dirname(__FILE__)."/../general_applications/apps.php";
if(is_file($autoload_applications )) require_once $autoload_applications ;

class activation_code_applications extends jury_of_peers_tbls {
    
    // TABLE
    private function table(){ return $this->activation_code_get();}
    
    
    
    
    /******************************************************************************************/
    /******************************** Retrive Functions ***************************************/
    /******************************************************************************************/
    public function activation_code_application_apis_get_all ($args = NULL ){
       $getApps = new main_get_app();
       return $getApps->get_all_rows ( $this->table() ,$args);   
    }
    public function activation_code_application_search_apis( $args, $operatorType /*Or - and */){
       $getApps = new main_get_app();
       return $getApps->get_data_according_to_array($this->table(), $args, '%', $operatorType);
    }
    public function activation_code_application_get_by_values ($args, $type /*OR-AND*/, $operatorType = NULL ){
       $getApps = new main_get_app();
       return $getApps->get_data_according_to_array($this->table(), $args, $type, $operatorType);
    }
    public function activation_code_application_check_exist ($args, $type = NULL){
       $getApps = new main_get_app();
       return $getApps->get_data_according_to_array($this->table(), $args, $type, $operatorType= NULL); 
    }
    /******************************************************************************************/
    /******************************** Add Functions *******************************************/
    /******************************************************************************************/
    
    public function activation_code_application_add_new_field ($args = []){
               // check if this exist or not
               $Add_module = new main_add_app;
              $add_result = $Add_module->add_new_fields($this->table() , $args );
             
    }
    
    
    /******************************************************************************************/
    /******************************** Update Functions *******************************************/
    /******************************************************************************************/
    public function activation_code_application_update_fields ($column_args =[] , $value_args = []){
        
         $update_module = new main_update_app() ;
        $update_result =  $update_module->Module_Update($this->table() , $column_args, $value_args) ;
       
    }
    
    /******************************************************************************************/
    /******************************** Delte Functions *******************************************/
    /******************************************************************************************/   
    public function activation_code_application_delete_fields ($args=[]){
         $delete_module = new delete_application() ;
        return $delete_module->Module_Delete($this->table() , $args);
    }
     
}   
 

?>
