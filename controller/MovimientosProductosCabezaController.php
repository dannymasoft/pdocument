<?php

class MovimientosInvCabezaController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		//Creamos el objeto usuario
	    $movimientos_productos_cabeza = new MovimientosProductosCabezaModel();
					//Conseguimos todos los usuarios
	    $resultSet=$movimientos_productos_cabeza->getAll("id_movimientos_productos_cabeza");
				
		$resultEdit = "";

		
		session_start();

	
		if (isset(  $_SESSION['nombre_usuarios']) )
		{

			$nombre_controladores = "MovimientosProductosCabeza";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $movimientos_productos_cabeza->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				if (isset ($_GET["id_movimientos_productos_cabeza"])   )
				{

					$nombre_controladores = "MovimientosProductosCabeza";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $movimientos_productos_cabeza->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
					if (!empty($resultPer))
					{
					
					    $_id_movimientos_productos_cabeza = $_GET["id_movimientos_productos_cabeza"];
						$columnas = " id_movimientos_productos_cabeza,
                                      fecha_movimientos_productos_cabeza,
                        			  numero_factura_movimientos_productos_cabeza,
                        			  numero_autorizacion_movimientos_productos_cabeza,
                        			  importe_movimientos_productos_cabeza,
                        			  cantidad_total_movimientos_productos_cabeza,
                        			  subtotal_doce_movimientos_productos_cabeza,
                        			  iva_movimientos_productos_cabeza,
                        			  valor_total_movimientos_productos_cabeza,
                        			  subtotal_cero_movimientos_productos_cabeza,
                        			  descuento_movimientos_productos_cabeza,
                        			  id_tipo_documento,
                        			  id_proveedor,
                        			  id_usuario_salida ";
						$tablas   = "movimientos_productos_cabeza";
						$where    = "id_movimientos_productos_cabeza = '$_id_movimientos_productos_cabeza' "; 
						$id       = "numero_factura_movimientos_productos_cabeza";
							
						$resultEdit = $movimientos_productos_cabeza->getCondiciones($columnas ,$tablas ,$where, $id);

					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar Movimientos Productos Cabeza"
					
						));
					
					
					}
					
				}
		
				
				$this->view("MovimientosProductosCabeza",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit
			
				));
		
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Movimientos Productos Cabeza"
				
				));
				
				exit();	
			}
				
		}
	else{
       	
       	$this->redirect("Usuarios","sesion_caducada");
       	
       }
	
	}
	
	public function InsertaMovimientosProductosCabeza(){
			
		session_start();
		$movimientos_productos_cabeza=new MovimientosProductosCabezaModel();

		$nombre_controladores = "MovimientosProductosCabeza";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $movimientos_productos_cabeza->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			$movimientos_productos_cabeza=new MovimientosProductosCabezaModel();
		
			if (isset ($_POST["numero_factura_movimientos_productos_cabeza"])   )
			{
				
			    $_id_movimientos_productos_cabeza = $_POST["id_movimientos_productos_cabeza"];
			    $_fecha_movimientos_productos_cabeza =  $_POST["fecha_movimientos_productos_cabeza"];
			    $_numero_factura_movimientos_productos_cabeza = $_POST["numero_factura_movimientos_productos_cabeza"];
			    $_numero_autorizacion_movimientos_productos_cabeza = $_POST["numero_autorizacion_movimientos_productos_cabeza"];
			    $_importe_movimientos_productos_cabeza =  $_POST["importe_movimientos_productos_cabeza"];
			    $_cantidad_total_movimientos_productos_cabeza = $_POST["cantidad_total_movimientos_productos_cabeza"];
			    $_subtotal_doce_movimientos_productos_cabeza = $_POST["subtotal_doce_movimientos_productos_cabeza"];
			    $_iva_movimientos_productos_cabeza =  $_POST["iva_movimientos_productos_cabeza"];
			    $_valor_total_movimientos_productos_cabeza = $_POST["valor_total_movimientos_productos_cabeza"];
			    $_subtotal_cero_movimientos_productos_cabeza = $_POST["subtotal_cero_movimientos_productos_cabeza"];
			    $_descuento_movimientos_productos_cabeza =  $_POST["descuento_movimientos_productos_cabeza"];
			    $_id_tipo_documento = $_POST["id_tipo_documento"];
			    $_id_proveedor = $_POST["id_proveedor"];
			    $_id_usuario_salida =  $_POST["id_usuario_salida"];
			    
			    if($_id_movimientos_productos_cabeza > 0){
					
					$columnas = "   fecha_movimientos_productos_cabeza = '$_fecha_movimientos_productos_cabeza',
                                    numero_factura_movimientos_productos_cabeza = '$_numero_factura_movimientos_productos_cabeza',
                                    numero_autorizacion_movimientos_productos_cabeza = '$_numero_autorizacion_movimientos_productos_cabeza',
                                    importe_movimientos_productos_cabeza = '$_importe_movimientos_productos_cabeza',
                                    cantidad_total_movimientos_productos_cabeza = '$_cantidad_total_movimientos_productos_cabeza',
                                    subtotal_doce_movimientos_productos_cabeza = '$_subtotal_doce_movimientos_productos_cabeza',
                                    iva_movimientos_productos_cabeza = '$_iva_movimientos_productos_cabeza',
                                    valor_total_movimientos_productos_cabeza = '$_valor_total_movimientos_productos_cabeza',
                                    subtotal_cero_movimientos_productos_cabeza = '$_subtotal_cero_movimientos_productos_cabeza',
                                    descuento_movimientos_productos_cabeza = '$_descuento_movimientos_productos_cabeza',
                                    id_tipo_documento = '$_id_tipo_documento',
                                    id_proveedor = '$_id_proveedor',
                                    id_usuario_salida = '$_id_usuario_salida'";
					$tabla = "movimientos_productos_cabeza";
					$where = "id_movimientos_productos_cabeza = '$_id_movimientos_productos_cabeza'";
					$resultado=$movimientos_productos_cabeza->UpdateBy($columnas, $tabla, $where);
					
				}else{
					
					$funcion = "ins_movimientos_productos_cabeza";
					$parametros = " '$_fecha_movimientos_productos_cabeza',
                                    '$_numero_factura_movimientos_productos_cabeza',
                                    '$_numero_autorizacion_movimientos_productos_cabeza',
                                    '$_importe_movimientos_productos_cabeza',
                                    '$_cantidad_total_movimientos_productos_cabeza',
                                    '$_subtotal_doce_movimientos_productos_cabeza',
                                    '$_iva_movimientos_productos_cabeza',
                                    '$_valor_total_movimientos_productos_cabeza',
                                    '$_subtotal_cero_movimientos_productos_cabeza',
                                    '$_descuento_movimientos_productos_cabeza',
                                    '$_id_tipo_documento',
                                    '$_$_id_proveedor',
                                    '$_id_usuario_salida'";
					$movimientos_productos_cabeza->setFuncion($funcion);
					$movimientos_productos_cabeza->setParametros($parametros);
					$resultado=$movimientos_productos_cabeza->Insert();
				}
				
				
				
		
			}
			$this->redirect("MovimientosProductosCabeza", "index");

		}
		else
		{
			$this->view("Error",array(
					"resultado"=>"No tiene Permisos de Insertar Movimientos Productos Cabeza"
		
			));
		
		
		}
		
	}
	
	public function borrarId()
	{

		session_start();
		$movimientos_productos_cabeza=new MovimientosProductosCabezaModel();
		$nombre_controladores = "MovimientosProductosCabeza";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $movimientos_productos_cabeza->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer))
		{
			if(isset($_GET["id_movimientos_productos_cabeza"]))
			{
			    $id_movimientos_productos_cabeza=(int)$_GET["id_movimientos_productos_cabeza"];
		
				
				
			    $movimientos_productos_cabeza->deleteBy("id_movimientos_productos_cabeza",$id_movimientos_productos_cabeza);
				
				
			}
			
			$this->redirect("MovimientosProductosCabeza", "index");
			
			
		}
		else
		{
			$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Movimientos Productos Cabeza"
			
			));
		}
				
	}
	
	
	public function Reporte(){
	
		//Creamos el objeto usuario
	    $movimientos_productos_cabeza=new MovimientosProductosCabezaModel();
		//Conseguimos todos los usuarios
		
	
	
		session_start();
	
	
		if (isset(  $_SESSION['usuario']) )
		{
		    $resultRep = $movimientos_productos_cabeza->getByPDF("id_grupos, nombre_grupos", " nombre_grupos != '' ");
			$this->report("MovimientosProductosCabeza",array(	"resultRep"=>$resultRep));
	
		}
					
	
	}
	
	
	
}
?>