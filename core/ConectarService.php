<?php
class ConectarService{
	
     private $driver = "";
     private $host = "";
     private $user = "";
     private $pass = "";
     private $database = "";
     private $charset = "";
     private $port = "";
  
    public function __construct() {
        $db_cfg = require_once '../config/database.php';
        $this->driver=$db_cfg["driver"];
        $this->host=$db_cfg["host"];
        $this->user=$db_cfg["user"];
        $this->pass=$db_cfg["pass"];
        $this->database=$db_cfg["database"];
        $this->charset=$db_cfg["charset"];
        $this->port=$db_cfg["port"];
    }
    
    public function conexion(){
        
        if($this->driver=="pgsql" || $this->driver==null){
       
        	$con = pg_connect("host=192.168.1.128 port=5432 dbname=web_capremci user=postgres password=Capremci2018");
        	if(!$con){
        		echo "No se puedo Conectar a la Base";
        	} else {
        	}
        }
        return $con;
    }
    
    public function startFluent(){
        require_once "FluentPDO/FluentPDO.php";
        
        if($this->driver=="pgsql" || $this->driver==null){
        	$pdo = new PDO('pgsql:host=192.168.1.128;port=5432;dbname=web_capremci', 'postgres', 'Capremci2018' );
            //$pdo = new PDO($this->driver.":dbname=".$this->database, $this->user, $this->pass);
            
            try 
            {
            	$fpdo = new FluentPDO($pdo);
            	
            }
            
            
            catch(PDOException $err)
            {
            	echo "No se puedo Conectar a la Base";
            }
        }
        
        return $fpdo;
    }
}
?>
