<?php

 

/**
 * Description of main_get_app
 *
 * @author Montasser Mossallem
 */

$tble = dirname(__FILE__)."/../connections/jury_of_peers_db.php";
if(is_file($tble)) require_once $tble ;

class main_add_app extends connections_db  {
    private function add_apps ($tableName , $fields=[]){
            // check if table exists in databases
       $tbl_query = mysqli_query($this->open_connection(), "SHOW TABLES LIKE '{$tableName}'")   ;
       $this->close_connection();
         if(mysqli_num_rows($tbl_query  )  == 0)
            {
                echo "This table does not exist ... ";
                return FALSE ;
            }
          
      $value_fields = NULL ;
      $index_fields = NULL ;
      $i = 0;
      
      foreach ($fields as $key => $value) {
                 $value_fields .= "'".  mysqli_real_escape_string($this->open_connection(), htmlentities(strip_tags(trim($value))))."'";
                if($i != (count($fields)-1))
                $value_fields .= " , ";
                 $index_fields .= "".$key."";
                if($i != (count($fields)-1))
                $index_fields  .= " , ";
           $i++;
      }
       ini_set('mysql.connect_timeout', 300);
        ini_set('default_socket_timeout', 300); 
      $queryString = "INSERT INTO `{$tableName}` ({$index_fields}) VALUE({$value_fields})";
     $Qresult = mysqli_query($this->open_connection() , $queryString );
     $this->close_connection();
     return $Qresult ;
    }
    public function add_new_fields ($tableName , $fields=[]){
        return $this->add_apps($tableName, $fields);
    }
}

?>
