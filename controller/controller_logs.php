<?php
ob_start() ;
if(session_id()=='')
    session_start () ;

    if(!isset($_POST))
        return FALSE ;
    if(!isset($_POST['proccessType'])){
        return FALSE ;
     } 
     // sign up controller
    if($_POST['proccessType']=='s_up_add')
        {
            if(!isset($_POST['firstName'])){
                echo 'All fileds are required';
                return false ;
            }
            if(!isset($_POST['lastName'])){
                echo 'All fileds are required' ;
                 return false ;
            }
            if(!isset($_POST['user_name'])){
                echo 'All fileds are required';
                return false ;
            }
            if(!isset($_POST['password'])){
                echo 'All fileds are required';
                return false ;
            }
            if(!isset($_POST['mail'])){
                  echo 'All fileds are required';
                 return FALSE ;
            }else if (!filter_var($_POST['mail'] , FILTER_VALIDATE_EMAIL)){
                echo 'This is not email , please fill with valid email';
                return false ;
            }
            
            if(!isset($_POST['birthDay'])){
                echo 'All fileds are required';
                return FALSE ;
            }
            if(!isset($_POST['gender'])){
                  echo 'All fileds are required';
                 return FALSE ;
            }
            
             
            
           
           if(preg_replace('#[^0-9 /]#i','', $_POST['birthDay']))
           {
             
           }  else {
               echo 'Date of birth field must be fill with american format like 20/02/1988' ;
               return false ;
           }
          $application_file =  dirname(__FILE__)."/../modular/applications/user_applications.php";
          if(is_file($application_file ))
              require_once $application_file ;
           $add_user_module = new user_applications();
              $email_exist = $add_user_module->user_application_check_exist(['e_mail'=>$_POST['mail']]);
              $username_exist = $add_user_module->user_application_check_exist(['u_name'=>$_POST['user_name']]);
              if($email_exist != NULL )
              {
                  echo "This email is already exist";
                  return false ;
              }
              if($username_exist != NULL )
              {
                  //echo "This username is already exist";
                   echo "This username is already exist";
                  return false ;
              }
              
              
              
      $user_exist =   $add_user_module ->user_application_add_new_field([
              'f_name'=>$_POST['firstName'] ,
              's_name'=>$_POST['lastName'] ,
              'u_name'=>$_POST['user_name'] ,
              'e_mail'=>$_POST['mail'] ,
              'p_assword'=>$_POST['password'] ,
              'birthDay'=> $_POST['birthDay'] ,
              'gender'=>$_POST['gender'] ,
              'timestamps'=>  time(),
              'is_activated'=> 1
          ]);
      
      
      
      
          if( $user_exist ){ 
                // build user session
                $email_exist = $add_user_module->user_application_check_exist(['e_mail'=>$_POST['mail']]);
      
                $_SESSION['user_info'] = [
                    'user_id'=>$email_exist->id  ,
                    'first_name'=>$email_exist->f_name  ,
                    'second_name'=>$email_exist->s_name ,
                    'user_name'=>$email_exist->u_name ,
                    'user_mail'=>$email_exist->e_mail ,
                    'birthday'=>$email_exist->birthDay ,
                    'timestamps'=>$email_exist->timestamps 
                ];
                echo "1";
              }
        }else if ($_POST['proccessType']=='login_user'){
             if(!isset($_POST['user_name'])){
                echo 'All fileds are required';
                return false ;
            }
            if(!isset($_POST['password'])){
                echo 'All fileds are required';
                return false ;
            }
          
            $application_file =  dirname(__FILE__)."/../modular/applications/user_applications.php";
          if(is_file($application_file ))
              require_once $application_file ;
           $add_user_module = new user_applications();
           
            
           
              $email_exist = $add_user_module->user_application_check_exist([
                  'e_mail'=>$_POST['user_name'] ,
                   'p_assword' =>trim(md5($_POST['password']))
              ]);
              $username_exist = $add_user_module->user_application_check_exist([
                  'u_name'=>$_POST['user_name'],
                  'p_assword' =>trim(md5($_POST['password']))
                  ]);
              
              
              
              if($username_exist != NULL || $email_exist != NULL  )
              {
                  
                if(  $username_exist != NULL  ) 
                {
                    $_SESSION['user_info'] = [
                    'user_id'=>$username_exist->id  ,
                    'first_name'=>$username_exist->f_name  ,
                    'second_name'=>$username_exist->s_name ,
                    'user_name'=>$username_exist->u_name ,
                    'user_mail'=>$username_exist->e_mail ,
                    'birthday'=>$username_exist->birthDay ,
                    'timestamps'=>$username_exist->timestamps 
                    ];
                }else {
                    $_SESSION['user_info'] = [
                    'user_id'=>$email_exist->id  ,
                    'first_name'=>$email_exist->f_name  ,
                    'second_name'=>$email_exist->s_name ,
                    'user_name'=>$email_exist->u_name ,
                    'user_mail'=>$email_exist->e_mail ,
                    'birthday'=>$email_exist->birthDay ,
                    'timestamps'=>$email_exist->timestamps 
                    ];
                }
                     
                
                echo "1";
              }else 
                  echo "This email or username does not exist";
             
            
            
        }
        
        session_write_close() ;
         
 ?>
