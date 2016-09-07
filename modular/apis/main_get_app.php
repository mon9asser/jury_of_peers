<?php

 

/**
 * Description of main_get_app
 *
 * @author Montasser Mossallem
 */

$tble = dirname(__FILE__)."/../connections/jury_of_peers_db.php";
if(is_file($tble)) require_once $tble ;

class main_get_app extends connections_db  {
    
    
    private function get_apps ($tableName , $data = NULL){
         // check if table exists in databases
       $tbl_query = mysqli_query($this->open_connection(), "SHOW TABLES LIKE '{$tableName}'")   ;
       $this->close_connection();
         if(mysqli_num_rows($tbl_query  )  == 0)
            {
                echo "This table does not exist ... ";
                return FALSE ;
            }
          $qString = sprintf("SELECT * FROM `{$tableName}` %s",$data);
        $query = mysqli_query($this->open_connection(), $qString );
        $this->close_connection();
        if(!$query)
            return NULL ;
        
        if(mysqli_num_rows($query) == 0)
            return NULL  ; 
        
       $arrList = [];
       for ($i=0; $i < mysqli_num_rows($query) ;$i++)
        $arrList[@count($arrList)] = mysqli_fetch_object ($query);
       $this->close_connection();
       return $arrList ;
     }
     
     
      private function get_apps_sum ($tableName , $data = NULL){
         // check if table exists in databases
       $tbl_query = mysqli_query($this->open_connection(), "SHOW TABLES LIKE '{$tableName}'")   ;
       $this->close_connection();
         if(mysqli_num_rows($tbl_query  )  == 0)
            {
                echo "This table does not exist ... ";
                return FALSE ;  
            }
          $qString = sprintf("SELECT SUM(review_number) AS rows_sum , COUNT(*) AS rows_count   FROM `{$tableName}` %s " , $data);
        $query = mysqli_query($this->open_connection(), $qString );
        $this->close_connection();
         
         $arrList = [];
         $arrList[@count($arrList)] = mysqli_fetch_object ($query);
       $this->close_connection();
       return $arrList[0] ;
     }
     
     
     
     
     public function get_apps_sum_desc_reviews ($program_id , $groupType){
       
          $qString =  "SELECT *,COUNT(*) AS review_counter , SUM(review_number) AS sum_reviews FROM `reviews_rating` WHERE video_type= {$groupType} AND `program_type`={$program_id} group by `post_id` DESC ";
        $query = mysqli_query($this->open_connection(), $qString );
         
         $arrList = [];
         for($i=0; $i < mysqli_num_rows($query); $i++)
         $arrList[@count($arrList)] = mysqli_fetch_object ($query);
       $this->close_connection();
       return $arrList ;
     }
     
     
     
     
     private function get_apps_desc ($tableName , $data = NULL){
         // check if table exists in databases
       $tbl_query = mysqli_query($this->open_connection(), "SHOW TABLES LIKE '{$tableName}'")   ;
       $this->close_connection();
         if(mysqli_num_rows($tbl_query  )  == 0)
            {
                echo "This table does not exist ... ";
                return FALSE ;
            }  
          $qString = sprintf("SELECT * FROM `{$tableName}` %s",$data);
        $query = mysqli_query($this->open_connection(), $qString );
        $this->close_connection();
        if(!$query)
            return NULL ;
        
        if(mysqli_num_rows($query) == 0)
            return 0   ; 
        
       $arrList = [];
      for ($i=mysqli_num_rows($query) -1 ; $i >= 0 ;$i--)
         $arrList[@count($arrList)] = mysqli_fetch_object ($query);
       $this->close_connection();
       return $arrList ;
     }
     
     
     
     
     public function get_data_according_to_array( $tableName ,$args = [] , $type = NULL , $operatorType = NULL /*case ' % ' */  ){
       if(!is_array($args ))
        {
            echo "There are an errors " ;
            return false ;
        }
        
       if (count($args) == 0 )
       {
           echo "There are no fields ";
           return false ;
       }
       
         $arguments ="WHERE";
        $i=0;
        
        switch ($type) {
              case '%':
                    foreach ($args as $key => $value) {
                            $arguments .=" {$key} LIKE '%".  mysqli_real_escape_string($this->open_connection(), htmlentities( strip_tags(trim($value)))) ."%'";
                           if($i != (count($args)-1))
                               $arguments .= " ".$operatorType." ";
                          $i++ ;
                       }
                 break;
              
              case 'and':
                   foreach ($args as $key => $value) {
                            $arguments .=  " `".$key."`='".mysqli_real_escape_string($this->open_connection(), htmlentities( strip_tags(trim($value))))."'";
                           if($i != (count($args)-1))
                               $arguments .= " AND";
                          $i++ ;
                       }
                 break;
              
              case 'or':
                   foreach ($args as $key => $value) {
                            $arguments .=  " `".$key."`='".mysqli_real_escape_string($this->open_connection(), htmlentities( strip_tags(trim($value))))."'";
                           if($i != (count($args)-1))
                               $arguments .= " OR";
                          $i++ ;
                       }
                 break;
              
            default: // mean type is NULL exist
                 foreach ($args as $key => $value) {
                             $arguments .=  " `".$key."`='".mysqli_real_escape_string($this->open_connection(), htmlentities( strip_tags(trim($value))))."'";
                           if($i != (count($args)-1))
                               $arguments .= "AND";
                          $i++ ;
                       }
                break;
        }
         
         // check if table exists in databases
       $tbl_query = mysqli_query($this->open_connection(), "SHOW TABLES LIKE '{$tableName}'")   ;
       $this->close_connection();
         if(mysqli_num_rows($tbl_query  )  == 0)
            {
                echo "This table does not exist ... ";
                return FALSE ;
            }
            
        $results = $this->get_apps($tableName, $arguments) ;
        if($type == NULL )
        {
            if( $results != NULL )
                return $results[0];
                else 
                    return NULL ;
                
        } else {
            return $results ;
        }
    }
     // get all rows
     public function get_all_rows ($tableName , $data = NULL){
         return $this->get_apps($tableName, $data);
     }
     
      public function get_all_rows_sum ($tableName , $data = NULL){
         return $this->get_apps_sum($tableName, $data);
     }
     
     public function get_all_rows_desc ($tableName , $data = NULL){
         return $this->get_apps_desc($tableName, $data);
     } 
}

/*
$vv = new main_get_app();
$pp = $vv->get_apps_sum_desc_reviews(1);
echo "<pre>";
print_r($pp);
echo "</pre>";*/
?>
