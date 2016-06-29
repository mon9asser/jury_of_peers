<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of connections_db
 *
 * @author Montasser Mossallem
 */

class server_setting {
    private static $SERVER_NAME = 'localhost'; 
    private static $DATABASE_NAME = 'jury_of_peers' ;
    private static $PASSWORD = '';
    private static $USER_NAME ='root';
    
    protected function getServerName(){
        return server_setting::$SERVER_NAME;
    }
    protected function getDatabaseName(){
        return server_setting::$DATABASE_NAME;
    }
    protected function getPassword(){
        return server_setting::$PASSWORD ;
    }
    protected function getUserName(){
        return server_setting::$USER_NAME;
    }
}
class connections_db extends server_setting {
    private $db_connection =  NULL ;
    private function database_open_conx (){
         $this->db_connection = @mysqli_connect($this->getServerName() , $this->getUserName() , $this->getPassword() , $this->getDatabaseName());
        if($this->db_connection )
        {
            @mysqli_set_charset( $this->db_connection,"utf8");
            return $this->db_connection ;
        }
        else 
        return false ;   
    }
   public function open_connection(){
        return $this->database_open_conx();
    }
    
    public function close_connection (){
        if($this->open_connection() == TRUE)
           return @mysqli_close ($this->db_connection);
    }  
    
}

?>
