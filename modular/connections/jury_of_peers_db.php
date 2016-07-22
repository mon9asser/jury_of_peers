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
    private static $SERVER_NAME = 'vps.juryofpeers.tv'; 
        private static $DATABASE_NAME = 'juryofpe_ers2016' ;
        private static $PASSWORD = 'rV_#G.$Jtqo#';
        private static $USER_NAME ='juryofpe_pro';
    /* 
     
        private static $SERVER_NAME = 'vps.juryofpeers.tv'; 
        private static $DATABASE_NAME = 'juryofpe_ers2016' ;
        private static $PASSWORD = 'rV_#G.$Jtqo#';
        private static $USER_NAME ='juryofpe_pro';
     
     */
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
