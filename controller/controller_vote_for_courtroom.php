<?php
ob_start();
if(session_id()=='')
session_start() ;
 
 $file_like = dirname(__FILE__)."/../modular/autoload_apps.php";
 if(is_file($file_like )) require_once  $file_like ;

  
/*
                    'is_like' 
                      'courtCode'  
                      'type'  
   
*/




$courtVote = new courtroom_votes_applications();
$courtInit = new courtroom_init_applications();

$courtVoteExsit = $courtVote->courtroom_votes_check_exist(['courtroom_code'=>$_POST['courtCode'],'user_id'=>$_SESSION['user_info']['user_id']]);
$court_details = $courtInit->courtroom_init_check_exist(['courtroom_code'=>$_POST['courtCode']]);
$pln_or_dfn = NULL ; 
if($courtVoteExsit == NULL )
    {   // ADD 
        switch ($_POST['type']){
            case 'pln':
                $pln_or_dfn = $court_details->plaintiff_id ;
                break;
            case 'dfn':
                 $pln_or_dfn = $court_details->defedant_id ;
                break;
        }
        
        $added = $courtVote->courtroom_votes_add_new_field([
            'court_id'=>$court_details->id , 
            'for_pln_dfn_id'=>$pln_or_dfn ,
            'user_id'=>$_SESSION['user_info']['user_id'] ,
            'likes_dislikes'=>$_POST['is_like'] ,
            'courtroom_code'=>$_POST['courtCode'] , 
            'timestamps'=>time()
        ]);
        if($added) echo "1";
    }else {
        echo "2";
    }

    
    
    
/*
    court_id
    for_pln_dfn_id
    user_id
    likes_dislikes
    courtroom_code
    timestamps
 */
?>