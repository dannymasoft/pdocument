<?php
class EntidadBaseSQL{

	private $con;
	
	// constructor
	function __construct() {
		require_once 'ConectarSQL.php';
		// connecting to database
		$db = new ConectarSQL();
		$this->con = $db->conexion();
	}
	
	
	
    

     public function fluent(){
     	return $this->fluent;
     }
     
     public function con(){
     	return $this->con;
     }
     
     
     public function getConetar(){
     	return $this->conectar;
     }
     
     public function db(){
     	return $this->db;
     }

    public function getCondiciones_SQL($columnas ,$tablas , $where){
    	
    	$query=sqlsrv_query($this->con, "SELECT $columnas FROM $tablas WHERE $where");
    	$resultSet = array();
    	while ($row = sqlsrv_fetch_object($query)) {
    		$resultSet[]=$row;
    	}
    
    	return $resultSet;
    }
    
    
    public function getCantidad($columna,$tabla,$where){
    
    	//parametro $columna puede ser todo (*) o una columna especifica
    	$query=sqlsrv_query($this->con, "SELECT COUNT($columna) AS total FROM $tabla WHERE $where ");
    	$resultSet = array();
    
    	while ($row = sqlsrv_fetch_object($query)) {
    		$resultSet[]=$row;
    	}
    	return $resultSet;
    }
    
}
?>
