<?php

 

/**
 * Description of main_get_app
 *
 * @author Montasser Mossallem
 */

$tble = dirname(__FILE__)."/../connections/jury_of_peers_db.php";
if(is_file($tble)) require_once $tble ;

class main_drop_app extends connections_db  {
     private $COLUMNS_VALUES = [];
       private function Module_api_delete ($tbl , $arr )
               {
                   // check if table exists in databases
                    $tbl_query = mysqli_query($this->open_connection(), "SHOW TABLES LIKE '{$tbl}'")   ;
                    $this->close_connection();
                      if(mysqli_num_rows($tbl_query  )  == 0)
                         {
                             echo "This table does not exist ... ";
                             return FALSE ;
                         }
                        if(!is_array($arr))
                        {
                            throw new SW_Exception_Module("This is not Array , Error in System");
                            return FALSE ;
                        }
                        foreach ($arr as $key => $value) {
                            $this->COLUMNS_VALUES[]= $key .' = '."'".mysqli_real_escape_string($this->open_connection(), htmlentities(strip_tags(trim($value))))."'";
                            }
                        $deleteRow = implode(" AND ", $this->COLUMNS_VALUES);
                        $queryStringDelete = "DELETE FROM `{$tbl}` WHERE {$deleteRow }";
                        $query = mysqli_query($this->open_connection(), $queryStringDelete);
                         ini_set('mysql.connect_timeout', 300);
                         ini_set('default_socket_timeout', 300);
                        if(!$query){
                           print ("Delete Faild , there is Error In System Loop".  mysqli_error($this->open_connection()));
                           return false ;
                           
                            }
                                $this->close_connection(); 
                                return TRUE ;
                    
                    }
       
        // FOR CALLING ONLY         
        public function Module_Delete($table , $arr)
           {
            return $this->Module_api_delete($table ,$arr ) ;
            }
}

?>
