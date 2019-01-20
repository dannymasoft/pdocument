<?php

class ProveedoresController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		//Creamos el objeto usuario
	    $proveedores=new ProveedoresModel();
					//Conseguimos todos los usuarios
	    $resultSet=$proveedores->getAll("id_proveedores");
				
		$resultEdit = "";
		
	
		
		session_start();
        
	
		if (isset(  $_SESSION['nombre_usuarios']) )
		{

			$nombre_controladores = "Proveedores";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $proveedores->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				if (isset ($_GET["id_proveedores"])   )
				{

					$nombre_controladores = "Proveedores";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $proveedores->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
					if (!empty($resultPer))
					{
					
					    $_id_proveedores = $_GET["id_proveedores"];
						$columnas = " id_proveedores, nombre_proveedores, identificacion_proveedores, contactos_proveedores, direccion_proveedores, telefono_proveedores, email_proveedores, fecha_nacimiento_proveedores ";
						$tablas   = "proveedores";
						$where    = "id_proveedores = '$_id_proveedores' "; 
						$id       = "nombre_proveedores";
							
						$resultEdit = $proveedores->getCondiciones($columnas ,$tablas ,$where, $id);

					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar Proveedores"
					
						));
					
					
					}
					
				}
		
				
				$this->view("Proveedores",array(
				    "resultSet"=>$resultSet, "resultEdit" =>$resultEdit
			
				));
		
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Proveedores"
				
				));
				
				exit();	
			}
				
		}
	else{
       	
       	$this->redirect("Usuarios","sesion_caducada");
       	
       }
	
	}
	
	public function InsertaProveedores(){
			
		session_start();
		$proveedores=new ProveedoresModel();

		$nombre_controladores = "Proveedores";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $proveedores->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			$proveedores=new ProveedoresModel();
		
			if (isset ($_POST["nombre_proveedores"])   )
			{
			    $_id_proveedores =  $_POST["id_proveedores"];
			    $_nombre_proveedores = $_POST["nombre_proveedores"];
			    $_identificacion_proveedores = $_POST["identificacion_proveedores"];
			    $_contactos_proveedores = $_POST["contactos_proveedores"];
			    $_direccion_proveedores = $_POST["direccion_proveedores"];
			    $_telefono_proveedores = $_POST["telefono_proveedores"];
			    $_email_proveedores = $_POST["email_proveedores"];
			    $_fecha_nacimiento_proveedores = $_POST["fecha_nacimiento_proveedores"];
			   
			  
				
			    if($_id_proveedores > 0){
					
					$columnas = " nombre_proveedores = '$_nombre_proveedores',
                                  identificacion_proveedores = '$_identificacion_proveedores',
                                  contactos_proveedores = '$_contactos_proveedores',
                                    direccion_proveedores = '$_direccion_proveedores',
                                    telefono_proveedores = '$_telefono_proveedores',
                                    email_proveedores = '$_email_proveedores',
                                    fecha_nacimiento_proveedores = '$_fecha_nacimiento_proveedores'";
					$tabla = "proveedores";
					$where = "id_proveedores = '$_id_proveedores'";
					$resultado=$proveedores->UpdateBy($columnas, $tabla, $where);
					
				}else{
					
					$funcion = "ins_proveedores";
					$parametros = " '$_nombre_proveedores','$_identificacion_proveedores','$_contactos_proveedores','$_direccion_proveedores','$_telefono_proveedores','$_email_proveedores','$_fecha_nacimiento_proveedores'";
					$proveedores->setFuncion($funcion);
					$proveedores->setParametros($parametros);
					$resultado=$proveedores->Insert();
				}
				
				
				
		
			}
			$this->redirect("Proveedores", "index");

		}
		else
		{
			$this->view("Error",array(
					"resultado"=>"No tiene Permisos de Insertar Proveedores"
		
			));
		
		
		}
		
	}
	
	public function borrarId()
	{
	    
	    session_start();
	    $proveedores=new ProveedoresModel();
	    $nombre_controladores = "Proveedores";
	    $id_rol= $_SESSION['id_rol'];
	    $resultPer = $proveedores->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
	    
	    if (!empty($resultPer))
	    {
	        if(isset($_GET["id_proveedores"]))
	        {
	            $id_proveedores=(int)$_GET["id_proveedores"];
	            
	            
	            
	            $proveedores->deleteBy("id_proveedores",$id_proveedores);
	            
	            
	        }
	        
	        $this->redirect("Proveedores", "index");
	        
	        
	    }
	    else
	    {
	        $this->view("Error",array(
	            "resultado"=>"No tiene Permisos de Borrar Proveedores"
	            
	        ));
	    }
	    
	}
	

	
	public function paginate_grupos($reload, $page, $tpages, $adjacents,$funcion='') {
	    
	    $prevlabel = "&lsaquo; Prev";
	    $nextlabel = "Next &rsaquo;";
	    $out = '<ul class="pagination pagination-large">';
	    
	    // previous label
	    
	    if($page==1) {
	        $out.= "<li class='disabled'><span><a>$prevlabel</a></span></li>";
	    } else if($page==2) {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='$funcion(1)'>$prevlabel</a></span></li>";
	    }else {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='$funcion(".($page-1).")'>$prevlabel</a></span></li>";
	        
	    }
	    
	    // first label
	    if($page>($adjacents+1)) {
	        $out.= "<li><a href='javascript:void(0);' onclick='$funcion(1)'>1</a></li>";
	    }
	    // interval
	    if($page>($adjacents+2)) {
	        $out.= "<li><a>...</a></li>";
	    }
	    
	    // pages
	    
	    $pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
	    $pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
	    for($i=$pmin; $i<=$pmax; $i++) {
	        if($i==$page) {
	            $out.= "<li class='active'><a>$i</a></li>";
	        }else if($i==1) {
	            $out.= "<li><a href='javascript:void(0);' onclick='$funcion(1)'>$i</a></li>";
	        }else {
	            $out.= "<li><a href='javascript:void(0);' onclick='$funcion(".$i.")'>$i</a></li>";
	        }
	    }
	    
	    // interval
	    
	    if($page<($tpages-$adjacents-1)) {
	        $out.= "<li><a>...</a></li>";
	    }
	    
	    // last
	    
	    if($page<($tpages-$adjacents)) {
	        $out.= "<li><a href='javascript:void(0);' onclick='$funcion($tpages)'>$tpages</a></li>";
	    }
	    
	    // next
	    
	    if($page<$tpages) {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='$funcion(".($page+1).")'>$nextlabel</a></span></li>";
	    }else {
	        $out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
	    }
	    
	    $out.= "</ul>";
	    return $out;
	}

	
	
	
}
?>