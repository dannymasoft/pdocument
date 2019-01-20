<?php
class Conectar{
    private $driver;
    private $host, $user, $pass, $database, $charset, $port;
  
    public function __construct() {
        $db_cfg = require_once 'config/database.php';
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
       
            //$con = pg_connect("host=192.168.1.128 port=5432 dbname=rp_capremci user=postgres password=Capremci2018 ");
            $con = pg_connect("host=127.0.1.1 port=5432 dbname=pdocument user=postgres password=123456 ");
        	if(!$con){
        		echo "No se puedo Conectar a la Base";
        		exit();
        	} else {
        		
        	}
       
        }
        
        return $con;
	
    }
    
    public function startFluent(){
        require_once "FluentPDO/FluentPDO.php";
        
        if($this->driver=="pgsql" || $this->driver==null){
        	
        	try
        	{
                //$pdo = new PDO('pgsql:host=192.168.1.128;port=5432;dbname=rp_capremci', 'postgres', 'Capremci2018' );
                $pdo = new PDO('pgsql:host=127.0.1.1;port=5432;dbname=pdocument', 'postgres', '123456' );
            	
         
            	$fpdo = new FluentPDO($pdo);
            	
            }
            
            
            catch(Exception $err)
            {
            	echo "PDO No se puedo Conectar a la Base";
            	exit();
            }
        }
        
        return $fpdo;
    }
}
?>
