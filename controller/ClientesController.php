<?php
class ClientesController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }

    public function index(){

    }

    public function AutocompleteCedula(){
	    
	    $clientes = new ClientesModel();
	    $cedula_clientes = $_GET['term'];
	    
	    $resultSet=$clientes->getBy("cedula_clientes LIKE '$cedula_clientes%'");
	    
	    if(!empty($resultSet)){
	        
	        foreach ($resultSet as $res){
	            
	            $_respuesta[] = $res->cedula_clientes;
	        }
	        echo json_encode($_respuesta);
	    }
	    
    }
    
    public function AutocompleteDevuelveNombres(){
	    
	    $clientes = new ClientesModel();
	    
	    $cedula_clientes = $_POST['cedula_clientes'];
	    
	    $columna = " clientes.id_clientes, clientes.nombre_clientes , clientes.cedula_clientes, clientes.estado_clientes";
	    
	    $tablas = " public.clientes";
	    
	    $where = "1=1 AND clientes.cedula_clientes = '$cedula_clientes'";
	    
	    $resultSet=$clientes->getCondiciones($columna,$tablas,$where,"clientes.cedula_clientes");
	    	    
	    $respuesta = new stdClass();
	    
	    if(!empty($resultSet)){
	        
	        $respuesta->id_clientes = $resultSet[0]->id_clientes;
	        $respuesta->cedula_clientes = $resultSet[0]->cedula_clientes;
	        $respuesta->nombre_clientes = $resultSet[0]->nombre_clientes;	       
	        $respuesta->estado_clientes = $resultSet[0]->estado_clientes;
	        
	        
	    }
	    
	    echo json_encode($respuesta);
	}

}
?>