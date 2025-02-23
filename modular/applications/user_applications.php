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
    public function user_application_check_exist ($value_args=[], $type = NULL){
               $getApps = new main_get_app();
       return $getApps->get_data_according_to_array($this->table(), $value_args, $type, $operatorType= NULL); 
    }
    
    /******************************************************************************************/
    /******************************** Add Functions *******************************************/
    /******************************************************************************************/
    
    public function user_application_add_new_field ($args = []){
        
                // check if this an email or not 
             if(!filter_var($args['e_mail'] , FILTER_VALIDATE_EMAIL))
                {
                     return false ;
                }    
                // check if this exist or not
              $email_exist = $this->user_application_check_exist(['e_mail'=>$args['e_mail']]);
              $username_exist = $this->user_application_check_exist(['u_name'=>$args['u_name']]);
              if($email_exist != NULL )
              {
                   return false ;
              }
              if($username_exist != NULL )
              {
                   return false ;
              }
                $args['p_assword'] = md5($args['p_assword']);
              
                   $Add_module = new main_add_app;
              $add_result = $Add_module->add_new_fields($this->table() , $args );
              if($add_result) {
                  $email_exist = $this->user_application_check_exist(['e_mail'=>$args['e_mail']]);
                  // CREATE USER DIRECTORY 
                  $dir_apps = new apps();
                 // $dir_apps->create_user_directory(dirname(__FILE__).'/../../usernames', dirname(__FILE__).'/../../'.strtolower($args['u_name']));
                    // CREATE ACTIVATION CODE FOR EACH USER 
                  $activationCode = $dir_apps->generateRandomString(10);
                  $user_id = $email_exist->id ;
                  $file_activation = dirname(__FILE__)."/user_activation_application.php";
                  if(is_file($file_activation)) require_once $file_activation ;
                  $activationCode_api = new activation_code_applications() ;
                  $activationCode_api->activation_code_application_add_new_field([
                    'user_id'=>$user_id  ,
                    'activation_code'=> $activationCode ,
                    'timestamps'=> time()
                  ]);
                  // SEND EMAIL TO ALLOW HIM ACTIVATE HIS ACCOUNT  l($user_id,$activationCode,$email_exist->e_mail ,);
                  // email setting of activation code 
                  $logoSrc = "http://juryofpeers.tv/images/logo.png" ;
                  $user_name =  $email_exist->u_name ;
                  $aboutJOP = "Welcome to Jury of peers Member , social network to judge your friends" ;
                  $activationCodes= $activationCode ;
                  $linkActivationCode= "http://juryofpeers.tv/activation?activation_code=".$activationCode."&username=". $email_exist->u_name ; 
                  $fromEmail= "Juryofpeers@juryofpeers.tv" ;
                  $toEmail= $email_exist->e_mail ;
                  $subjects = "Jury of peers activation code" ;
                  $dir_apps->send_activation_to_usermail($logoSrc, $user_name, $aboutJOP, $activationCodes, $linkActivationCode, $fromEmail, $toEmail, $subjects);
                    
                     return TRUE ;
                    
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
        $delete_module = new main_drop_app() ;
        return $delete_module->Module_Delete($this->table() , $args);
    }
     
}   
   
 

?>
