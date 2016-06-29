<?php
 

$autoload_tbl = dirname(__FILE__)."/../connections/jury_of_peers_tbls.php";
if(is_file($autoload_tbl )) require_once $autoload_tbl ;

$autoload_file = dirname(__FILE__)."/../apis/apis_autoload.php";
if(is_file($autoload_file )) require_once $autoload_file ;

$autoload_applications = dirname(__FILE__)."/../general_applications/apps.php";
if(is_file($autoload_applications )) require_once $autoload_applications ;

class user_applications extends jury_of_peers_tbls {
    
    // TABLE
    private function table(){ return $this->user_applications_get();}
    
    
    
    
    /******************************************************************************************/
    /******************************** Retrive Functions ***************************************/
    /******************************************************************************************/
    public function user_application_apis_get_all ($args = NULL ){
       $getApps = new main_get_app();
       return $getApps->get_all_rows ( $this->table() ,$args);   
    }
    public function user_application_search_apis( $args, $operatorType /*Or - and */){
       $getApps = new main_get_app();
       return $getApps->get_data_according_to_array($this->table(), $args, '%', $operatorType);
    }
    public function user_application_get_by_values ($args, $type /*OR-AND*/, $operatorType = NULL ){
       $getApps = new main_get_app();
       return $getApps->get_data_according_to_array($this->table(), $args, $type, $operatorType);
    }
    public function user_application_check_exist ($args, $type = NULL){
       $getApps = new main_get_app();
       return $getApps->get_data_according_to_array($this->table(), $args, $type, $operatorType= NULL); 
    }
    /******************************************************************************************/
    /******************************** Add Functions *******************************************/
    /******************************************************************************************/
    
    public function user_application_add_new_field ($args = []){
                // check if this exist or not
              $email_exist = $this->user_application_check_exist(['e_mail'=>$args['e_mail']]);
              $username_exist = $this->user_application_check_exist(['u_name'=>$args['u_name']]);
              if($email_exist != NULL )
              {
                  echo "EMAIL_EXIST";
                  return false ;
              }
              if($username_exist != NULL )
              {
                  echo "USERNAME_EXIST";
                  return false ;
              }
              // Add Module Apis
              $Add_module = new main_add_app;
              $add_result = $Add_module->add_new_fields($this->table() , $args );
              if($add_result) {
                  
                  // CREATE USER DIRECTORY 
                  $dir_apps = new apps();
                  $dir_apps->create_user_directory(dirname(__FILE__).'/../../usernames', dirname(__FILE__).'/../../'.strtolower($args['u_name']));
                  // CREATE ACTIVATION CODE FOR EACH USER 
                  // SEND EMAIL TO ALLOW HIM ACTIVATE HIS ACCOUNT 
                  // ADD USER LOGS
                  // ........... HERE ......
                  
                
                  echo "ADDED_SUCCESSED";
                  }
    }
    
    
    /******************************************************************************************/
    /******************************** Update Functions *******************************************/
    /******************************************************************************************/
    public function user_application_update_fields ($column_args =[] , $value_args = []){
        
        
             if(array_key_exists( 'e_mail', $value_args ))
             {
                 $email_exist = $this->user_application_check_exist([
                    'e_mail'=>$value_args['e_mail'] 
                    ]);
                    if($email_exist != NULL && $email_exist->id != $column_args['id'])
                    {
                        echo "UPDATE_EMAIL_EXIST";
                        return false ;
                    }

             }
              
               if(array_key_exists( 'u_name', $value_args )) {
                    $username_exist = $this->user_application_check_exist([
                        'u_name'=>$value_args['u_name']
                    ]);

                    if($username_exist != NULL && $username_exist->id != $column_args['id'])
                    {
                        echo "UPDATE_USERNAME_EXIST";
                        return false ;
                    }
               }
              
        $update_module = new main_update_app() ;
        $update_result =  $update_module->Module_Update($this->table() , $column_args, $value_args) ;
        if($update_result) echo "UPDATED_SUCCESSED";
    }
    
    /******************************************************************************************/
    /******************************** Delte Functions *******************************************/
    /******************************************************************************************/   
    public function user_application_delete_fields ($args=[]){
        
        $id_exist = $this->user_application_check_exist([
                'id'=>$args['id'] 
              ]);
        
        if($id_exist == NULL )
        {
            echo "ID_NOT_FOUND";
            return false ;
        }
        $delete_module = new delete_application() ;
        return $delete_module->Module_Delete($this->table() , $args);
    }
     
}   
$va = new user_applications() ;
 
$va->user_application_add_new_field([
    'f_name'=>      'Ghada'                ,
    's_name'=>             'Adel'         ,
    'u_name'=>               'Ghada88'   ,
    'e_mail'=>               'Ghada88@email.com'   ,
    'gender'=>              1    ,
    'zip_code'=>            '1235'    ,
    'is_activated'=>        1    ,
    'is_deleted'=>        0  ,
    'timestamps'=> time()  ,
]); 
 
 

?>
