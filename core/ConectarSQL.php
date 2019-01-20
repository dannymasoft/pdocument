<?php
class ConectarSQL{
    private $driver;
    private $host, $user, $pass, $database, $charset, $port;
  
    public function __construct() {
        $db_cfg = require_once 'config/database.php';
        $this->driver=$db_cfg["driver_sql"];
        $this->host=$db_cfg["host"];
        $this->user=$db_cfg["user"];
        $this->pass=$db_cfg["pass"];
        $this->database=$db_cfg["database"];
        $this->charset=$db_cfg["charset"];
        $this->port=$db_cfg["port"];
    }
    
    public function conexion(){
        
        if($this->driver=="sql" || $this->driver==null){
        	
        	$serverName = "192.168.1.208, 1433"; //serverName\instanceName, portNumber (por defecto es 1433)
        	$connectionInfo = array("Database"=>'one.capremci_PROD', "UID"=>'sa', "PWD"=>'$software$01');
        	$con = sqlsrv_connect($serverName, $connectionInfo);
        	
        
        	
        	if(!$con){
        		echo "No se puedo Conectar a la Base";
        		exit();
        	} else {
        		
        	}
       
        }
        
        return $con;
	
    }
    
   
}
?>
