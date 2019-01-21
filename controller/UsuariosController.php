<?php
class UsuariosController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    
	public function index(){
	
		session_start();
		
		if (isset($_SESSION['nombre_usuarios']) )
		{
			//Creamos el objeto usuario
			$rol=new RolesModel();
			$resultRol = $rol->getAll("nombre_rol");
			
			$resultSet="";
			
			$usuarios = new UsuariosModel();

			$nombre_controladores = "Usuarios";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $usuarios->getPermisosEditar("controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
				
			if (!empty($resultPer))
			{
				$resultEdit = "";
				$result_catalogo_usuario=null;
				$resultRolPrincipal = array();
				$result_privilegios = array();
				
				$catalogo=null;
				$catalogo = new CatalogoModel();
				//para estados de catalogo de usuarios
				$whe_catalogo = "tabla_catalogo = 'usuarios' AND columna_catalogo = 'estado_usuarios'";
				$result_catalogo_usuario = $catalogo->getBy($whe_catalogo);
			
					if (isset ($_GET["id_usuarios"])   )
					{
						
						
						$columnas = " usuarios.id_usuarios,
								usuarios.cedula_usuarios,
								usuarios.nombre_usuarios,
								usuarios.apellidos_usuarios,
								usuarios.telefono_usuarios,
								usuarios.celular_usuarios,
								usuarios.correo_usuarios,
								claves.clave_n_claves,
								claves.caduca_claves,
								usuarios.fotografia_usuarios,
								usuarios.creado,
								usuarios.fecha_nacimiento_usuarios,
								usuarios.usuario_usuarios,
								usuarios.estado_usuarios,
								privilegios.id_rol,
								catalogo.nombre_catalogo ";
						
						$tablas = "public.usuarios INNER JOIN public.claves ON usuarios.id_usuarios = claves.id_usuarios
									INNER JOIN public.privilegios ON usuarios.id_usuarios = privilegios.id_usuarios
									INNER JOIN public.catalogo ON privilegios.tipo_rol_privilegios = catalogo.valor_catalogo 
									AND tabla_catalogo = 'privilegios' AND columna_catalogo='tipo_rol_privilegios' 
									AND nombre_catalogo='PRINCIPAL'
									INNER JOIN public.catalogo c1 ON c1.valor_catalogo = claves.estado_claves 
									AND c1.tabla_catalogo = 'claves' AND c1.columna_catalogo='estado_claves' 
									AND c1.nombre_catalogo='ACTUAL'";
						
						$id       = "usuarios.id_usuarios";
						
						$_id_usuarios = $_GET["id_usuarios"];
						$where    = " usuarios.id_usuarios = '$_id_usuarios' "; 
						$resultEdit = $usuarios->getCondiciones($columnas ,$tablas ,$where, $id); 
						
						
						/*para catalogo de privilegios (Roles Secundarios)*/
						$col_privilegios = "rol.id_rol,rol.nombre_rol";
						$tab_privilegios = "public.privilegios INNER JOIN public.rol ON rol.id_rol=privilegios.id_rol
											INNER JOIN public.catalogo ON catalogo.valor_catalogo = privilegios.tipo_rol_privilegios";
						$where_privilegios = "columna_catalogo='tipo_rol_privilegios' 
												AND privilegios.id_usuarios='$_id_usuarios'";
						
						$result_privilegios = $catalogo->getCondiciones($col_privilegios,$tab_privilegios,$where_privilegios,"tabla_catalogo");
						
						
					}
					
					
					
					$this->view("Usuarios",array(
						"resultSet"=>$resultSet, "resultRol"=>$resultRol, "resultEdit" =>$resultEdit ,
						"result_catalogo_usuario"=>$result_catalogo_usuario,
						"result_privilegios"=>$result_privilegios
				
					));
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Usuarios"
			
				));
			
			}
			
		
			}
			else{
			
			$this->redirect("Usuarios","sesion_caducada");
			
		}
			
	}
	
	
	
	public function InsertaUsuarios(){
			
		session_start();
		$resultado = null;
		$usuarios=new UsuariosModel();
		$_array_roles=array();
		
		/*para la consulta de catalogos*/
		$catalogo = null; $catalogo=new CatalogoModel();
		$privilegios = null; $privilegios=new PrivilegiosModel();
		$claves = null; $claves = new ClavesModel();
		
	
		if (isset(  $_SESSION['nombre_usuarios']) )
		{
	
			if (isset ($_POST["cedula_usuarios"]))
			{
				$_cedula_usuarios     = $_POST["cedula_usuarios"];
				$_nombre_usuarios     = $_POST["nombre_usuarios"];
				$_apellidos_usuario     = $_POST["apellidos_usuarios"];
				$_fecha_nacimiento_usuarios = $_POST['fecha_nacimiento_usuarios'];
				$_usuario_usuarios    = $_POST['usuario_usuarios'];
				$_clave_usuarios      = $usuarios->encriptar($_POST["clave_usuarios"]);
				$_clave_n_usuarios    = $_POST["clave_usuarios"];
				$_telefono_usuarios   = $_POST["telefono_usuarios"];
				$_celular_usuarios    = $_POST["celular_usuarios"];
				$_correo_usuarios     = $_POST["correo_usuarios"];
				$_id_rol_principal    = $_POST["id_rol_principal"];
				$_array_roles         = isset($_POST["lista_roles"])?$_POST["lista_roles"]:array();
				$_id_estado           = $_POST["id_estado"];		    
				$_id_usuarios         = $_POST["id_usuarios"];
				
				$_caduca_clave        = isset($_POST['caduca_clave'])?$_POST['caduca_clave']:"0";
				$_cambiar_clave       = isset($_POST['cambiar_clave'])?$_POST['cambiar_clave']:"0";
				
				if($_id_usuarios > 0){
					
					
					if ($_FILES['fotografia_usuarios']['tmp_name']!="")
					{
							
						$directorio = $_SERVER['DOCUMENT_ROOT'].'/rp_c/fotografias_usuarios/';
							
						$nombre = $_FILES['fotografia_usuarios']['name'];
						$tipo = $_FILES['fotografia_usuarios']['type'];
						$tamano = $_FILES['fotografia_usuarios']['size'];
							
						move_uploaded_file($_FILES['fotografia_usuarios']['tmp_name'],$directorio.$nombre);
						$data = file_get_contents($directorio.$nombre);
						$imagen_usuarios = pg_escape_bytea($data);
							
							
						$colval = "cedula_usuarios= '$_cedula_usuarios',
									nombre_usuarios = '$_nombre_usuarios',
									apellidos_usuarios = '$_apellidos_usuario',
									telefono_usuarios = '$_telefono_usuarios',
									celular_usuarios = '$_celular_usuarios',
									correo_usuarios = '$_correo_usuarios',
									usuario_usuarios = '$_usuario_usuarios',
									fecha_nacimiento_usuarios = '$_fecha_nacimiento_usuarios',
									estado_usuarios = '$_id_estado',
									fotografia_usuarios = '$imagen_usuarios'";
						
						$tabla = "usuarios";
						$where = "id_usuarios = '$_id_usuarios'";
						$resultado=$usuarios->UpdateBy($colval, $tabla, $where);
						
						
						//para actualizacion de roles principal y secundario
						$rsCatalogoSecundario = $catalogo->getBy("tabla_catalogo='privilegios' AND columna_catalogo='tipo_rol_privilegios'");
						
						$valor_rol_principal=0;
						$valor_rol_secundario = 0;
						
						if(count($rsCatalogoSecundario)>0){
							foreach ($rsCatalogoSecundario as $tiporol ){
								if($tiporol->nombre_catalogo == 'PRINCIPAL'){
									$valor_rol_principal = $tiporol->valor_catalogo;
								}
								if($tiporol->nombre_catalogo == 'SECUNDARIO'){
									$valor_rol_secundario = $tiporol->valor_catalogo;
								}
							}
						}
						
						
						
						
						//rol secunadrio
						/*consulta estado privilegios de catalogo*/
						$wherecatalogo = "nombre_catalogo='ACTIVO' AND  tabla_catalogo='privilegios' AND columna_catalogo='estado_rol_privilegios'";
						$resultCatalogo = $catalogo->getCondiciones('valor_catalogo' ,'public.catalogo' , $wherecatalogo , 'tabla_catalogo');
						$_estado_privilegios = $resultCatalogo[0]->valor_catalogo;
						
						//var_dump($_array_roles); die('datos array');
						
						if(count($_array_roles)>0){
							
							$resultadoEliminar = $privilegios->deleteById("id_usuarios = '$_id_usuarios' ");
							//var_dump($resultadoEliminar); die('llego');
							foreach ($_array_roles as $id_rol){
								
								$funcion = "ins_privilegios";
								
								$parametros = "'$_id_usuarios',
								'$id_rol',
								'$valor_rol_secundario',
								'$_estado_privilegios'";
								
								$privilegios->setFuncion($funcion);
								$privilegios->setParametros($parametros);
								$resultado=$privilegios->Insert();
								//var_dump($resultadoEliminar); die('llego');
							}
						}
						
						//rol principal
						$colval = " tipo_rol_privilegios = '$valor_rol_principal'";
						$tabla = "privilegios";
						$where = "id_usuarios = '$_id_usuarios' AND id_rol='$_id_rol_principal'";
						$resultado=$privilegios->UpdateBy($colval, $tabla, $where);
						
						
						//para actualizacion de tabla claves
						if((int)$_cambiar_clave==1 || $_cambiar_clave=="on"){
							
							$wherecatalogo = " nombre_catalogo='ACTUAL' AND tabla_catalogo='claves' AND columna_catalogo='estado_claves'";
							$resultCatalogo = $catalogo->getCondiciones('valor_catalogo' ,'public.catalogo' , $wherecatalogo , 'tabla_catalogo');
							$_estado_claves_actual = $resultCatalogo[0]->valor_catalogo;
							
							$wherecatalogo = " nombre_catalogo='ANTERIOR' AND tabla_catalogo='claves' AND columna_catalogo='estado_claves'";
							$resultCatalogo = $catalogo->getCondiciones('valor_catalogo' ,'public.catalogo' , $wherecatalogo , 'tabla_catalogo');
							$_estado_claves_anterior = $resultCatalogo[0]->valor_catalogo;
							
							//para fecha de insersion clave
							$clave_fecha_hoy = date("Y-m-d");
							$clave_fecha_siguiente_mes = date("Y-m-d",strtotime($clave_fecha_hoy."+ 1 month"));
							$_clave_caduca="0";
							
							if((int)$_caduca_clave ==1 || $_caduca_clave=="on"){
								
								$_clave_caduca="1";
							}
							
							$colval = "estado_claves='$_estado_claves_anterior'";
							$tabla = "claves";
							$where = "id_usuarios = '$_id_usuarios'";
							$resultado=$claves->UpdateBy($colval, $tabla, $where);
							
							//para insertado de claves
							$claves = new ClavesModel();
							$funcion = "ins_claves";
							$parametros = "'$_id_usuarios',
								'$_clave_usuarios',
								'$_clave_n_usuarios',
								'$clave_fecha_hoy',
								'$clave_fecha_siguiente_mes',
								'$_clave_caduca',
								'$_estado_claves_actual'";
							$claves->setFuncion($funcion);
							$claves->setParametros($parametros);
							$resultado=$claves->Insert();
							
							
						}
						
						
					}
					else
					{  //caso contrario cuando no hay imagen selecionada por el usuario
					
					//actualizacion de tabla usuario
						$colval = "cedula_usuarios= '$_cedula_usuarios', 
									nombre_usuarios = '$_nombre_usuarios',
									apellidos_usuarios = '$_apellidos_usuario', 
									telefono_usuarios = '$_telefono_usuarios', 
									celular_usuarios = '$_celular_usuarios', 
									correo_usuarios = '$_correo_usuarios',
									usuario_usuarios = '$_usuario_usuarios',
									fecha_nacimiento_usuarios = '$_fecha_nacimiento_usuarios',
									estado_usuarios = '$_id_estado'";
						$tabla = "usuarios";
						$where = "id_usuarios = '$_id_usuarios'";
						$resultado=$usuarios->UpdateBy($colval, $tabla, $where);
						
						
						//para actualizacion de roles principal y secundario
						$rsCatalogoSecundario = $catalogo->getBy("tabla_catalogo='privilegios' AND columna_catalogo='tipo_rol_privilegios'");
						
						$valor_rol_principal=0;
						$valor_rol_secundario = 0;
						
						if(count($rsCatalogoSecundario)>0){
							foreach ($rsCatalogoSecundario as $tiporol ){
								if($tiporol->nombre_catalogo == 'PRINCIPAL'){
									$valor_rol_principal = $tiporol->valor_catalogo;
								}
								if($tiporol->nombre_catalogo == 'SECUNDARIO'){
									$valor_rol_secundario = $tiporol->valor_catalogo;
								}
							}
						}
						
						
						//inserta privilegios
						/*consulta estado privilegios de catalogo*/
						$wherecatalogo = "nombre_catalogo='ACTIVO' AND  tabla_catalogo='privilegios' AND columna_catalogo='estado_rol_privilegios'";
						$resultCatalogo = $catalogo->getCondiciones('valor_catalogo' ,'public.catalogo' , $wherecatalogo , 'tabla_catalogo');
						$_estado_privilegios = $resultCatalogo[0]->valor_catalogo;
						
						//var_dump($_array_roles); die('datos array');
						
						if(count($_array_roles)>0){
							
							$resultadoEliminar = $privilegios->deleteById("id_usuarios = '$_id_usuarios' ");
							//var_dump($resultadoEliminar); die('llego');
							foreach ($_array_roles as $id_rol){
								//var_dump($id_rol); die('llego');
								$funcion = "ins_privilegios";
								
								$parametros = "'$_id_usuarios',
								'$id_rol',
								'$valor_rol_secundario',
								'$_estado_privilegios'";
								
								$privilegios->setFuncion($funcion);
								$privilegios->setParametros($parametros);
								$resultado=$privilegios->Insert();
							
							}
							
						}
						
						
						//rol principal
						$colval = " tipo_rol_privilegios = '$valor_rol_principal'";
						$tabla = "privilegios";
						$where = "id_usuarios = '$_id_usuarios' AND id_rol='$_id_rol_principal' ";
						$resultado=$privilegios->UpdateBy($colval, $tabla, $where);
						
						
						//para actualizacion de tabla claves
						if((int)$_cambiar_clave==1 || $_cambiar_clave=="on"){
							
							$wherecatalogo = " nombre_catalogo='ACTUAL' AND tabla_catalogo='claves' AND columna_catalogo='estado_claves'";
							$resultCatalogo = $catalogo->getCondiciones('valor_catalogo' ,'public.catalogo' , $wherecatalogo , 'tabla_catalogo');
							$_estado_claves_actual = $resultCatalogo[0]->valor_catalogo;
							
							$wherecatalogo = " nombre_catalogo='ANTERIOR' AND tabla_catalogo='claves' AND columna_catalogo='estado_claves'";
							$resultCatalogo = $catalogo->getCondiciones('valor_catalogo' ,'public.catalogo' , $wherecatalogo , 'tabla_catalogo');
							$_estado_claves_anterior = $resultCatalogo[0]->valor_catalogo;
							
							//para fecha de insersion clave
							$clave_fecha_hoy = date("Y-m-d");
							$clave_fecha_siguiente_mes = date("Y-m-d",strtotime($clave_fecha_hoy."+ 1 month"));
							$_clave_caduca="0";
							
							if((int)$_caduca_clave ==1 || $_caduca_clave=="on"){
								
								$_clave_caduca="1";
							}
							
							$colval = "estado_claves='$_estado_claves_anterior'";
							$tabla = "claves";
							$where = "id_usuarios = '$_id_usuarios'";
							$resultado=$claves->UpdateBy($colval, $tabla, $where);
							
							
							//para insertado de claves
							$claves = new ClavesModel();
							$funcion = "ins_claves";
							$parametros = "'$_id_usuarios',
								'$_clave_usuarios',
								'$_clave_n_usuarios',
								'$clave_fecha_hoy',
								'$clave_fecha_siguiente_mes',
								'$_clave_caduca',
								'$_estado_claves_actual'";
							$claves->setFuncion($funcion);
							$claves->setParametros($parametros);
							$resultado=$claves->Insert();
							
							
							
						}
					
					}
					
					
					
				}else{ /*CUANDO NO HAY ID USUARIO SE VA INSERTADO*/
				
					
				if ($_FILES['fotografia_usuarios']['tmp_name']!="")
				{
				
					$directorio = $_SERVER['DOCUMENT_ROOT'].'/rp_c/fotografias_usuarios/';
				
					$nombre = $_FILES['fotografia_usuarios']['name'];
					$tipo = $_FILES['fotografia_usuarios']['type'];
					$tamano = $_FILES['fotografia_usuarios']['size'];
					
					move_uploaded_file($_FILES['fotografia_usuarios']['tmp_name'],$directorio.$nombre);
					$data = file_get_contents($directorio.$nombre);
					$imagen_usuarios = pg_escape_bytea($data);
					
					/*consultamos datos de catalogo*/
					//estado usuario catalogo
					$wherecatalogo = "nombre_catalogo='ACTIVO' AND  tabla_catalogo='usuarios' AND columna_catalogo='estado_usuarios'";
					$resultCatalogo = $catalogo->getCondiciones('valor_catalogo' ,'public.catalogo' , $wherecatalogo , 'tabla_catalogo');
					$_estado_usuarios = $resultCatalogo[0]->valor_catalogo;
				
				
					$funcion = "ins_usuarios";
					$parametros = "'$_cedula_usuarios',
								'$_nombre_usuarios',
								'$_apellidos_usuario',
								'$_correo_usuarios',
								'$_celular_usuarios',
								'$_telefono_usuarios',
								'$_fecha_nacimiento_usuarios',
								'$_usuario_usuarios',
								'$_estado_usuarios', 
								'$imagen_usuarios'";
					$usuarios->setFuncion($funcion);
					$usuarios->setParametros($parametros);
					$resultado=$usuarios->Insert();
					
					//para datos de usuario traer de BD
					$rsUsuario = null;		    	
					$whereconsulta = "cedula_usuarios = '$_cedula_usuarios' AND nombre_usuarios = '$_nombre_usuarios' AND apellidos_usuarios = '$_apellidos_usuario'AND correo_usuarios = '$_correo_usuarios'AND usuario_usuarios='$_usuario_usuarios'"; 
					$rsUsuario=$usuarios->getCondiciones('id_usuarios' ,'public.usuarios' , $whereconsulta , 'id_usuarios');
					
					//valor para guardar el id_usuarios
					$consulta_id_usuarios = null;
					$consulta_id_usuarios = $rsUsuario[0]->id_usuarios;
									
					$_clave_caduca="0";
					if((int)$_caduca_clave ==1 || $_caduca_clave=="on"){
						
						$_clave_caduca="1";
					}
									
					//estado usuario catalogo
					$wherecatalogo = "nombre_catalogo='ACTUAL' AND  tabla_catalogo='claves' AND columna_catalogo='estado_claves'";
					$resultCatalogo = $catalogo->getCondiciones('valor_catalogo' ,'public.catalogo' , $wherecatalogo , 'tabla_catalogo');
					$_estado_claves = $resultCatalogo[0]->valor_catalogo;
					
					//para fecha de insersion clave
					$clave_fecha_hoy = date("Y-m-d");
					$clave_fecha_siguiente_mes = date("Y-m-d",strtotime($clave_fecha_hoy."+ 1 month"));
					//para insertado de claves
					$claves = new ClavesModel();
					$funcion = "ins_claves";
					$parametros = "'$consulta_id_usuarios',
								'$_clave_usuarios',
								'$_clave_n_usuarios',
								'$clave_fecha_hoy',
								'$clave_fecha_siguiente_mes',
								'$_clave_caduca',
								'$_estado_claves'";
					$claves->setFuncion($funcion);
					$claves->setParametros($parametros);
					$resultado=$claves->Insert();
					
					
					//para el ingreso de los privilegios
					$privilegios = null;
					$privilegios = new PrivilegiosModel();
					
					/*consultamos datos de catalogo*/
					//estado catalogo
					$wherecatalogo = "nombre_catalogo='ACTIVO' AND  tabla_catalogo='privilegios' AND columna_catalogo='estado_rol_privilegios'";
					$resultCatalogo = $catalogo->getCondiciones('valor_catalogo' ,'public.catalogo' , $wherecatalogo , 'tabla_catalogo');
					$_estado_privilegios = $resultCatalogo[0]->valor_catalogo;
					//tipo rol catalogo
					$wherecatalogo = "nombre_catalogo='PRINCIPAL' AND  tabla_catalogo='privilegios' AND columna_catalogo='tipo_rol_privilegios'";
					$resultCatalogo = $catalogo->getCondiciones('valor_catalogo' ,'public.catalogo' , $wherecatalogo , 'tabla_catalogo');
					$_tipo_rol_privilegios = $resultCatalogo[0]->valor_catalogo;
					
					$funcion = "ins_privilegios";
					
					$parametros = "'$consulta_id_usuarios',
								'$_id_rol_principal',
								'$_tipo_rol_privilegios',
								'$_estado_privilegios'";
					
					$privilegios->setFuncion($funcion);
					$privilegios->setParametros($parametros);
					$resultado=$privilegios->Insert();
					
					//para ingreso de roles secundarios
						if(count($_array_roles)>0){
							
							/*consultamos datos de catalogo*/
							
							//tipo rol catalogo
							$wherecatalogo = "nombre_catalogo='SECUNDARIO' AND  tabla_catalogo='privilegios' AND columna_catalogo='tipo_rol_privilegios'";
							$resultCatalogo = $catalogo->getCondiciones('valor_catalogo' ,'public.catalogo' , $wherecatalogo , 'tabla_catalogo');
							$_tipo_rol_privilegios = $resultCatalogo[0]->valor_catalogo;
							
							foreach ($_array_roles as $id_rol){
								
								$funcion = "ins_privilegios";
								
								$parametros = "'$consulta_id_usuarios',
									'$id_rol',
									'$_tipo_rol_privilegios',
									'$_estado_privilegios'";
								
								$privilegios->setFuncion($funcion);
								$privilegios->setParametros($parametros);
								$resultado=$privilegios->Insert();
							}
						}
					
					
					
				}
				else
				{
				
					$where_TO = "cedula_usuarios = '$_cedula_usuarios'";
					$result=$usuarios->getBy($where_TO);
					
					if ( !empty($result) )
					{
						
						/*$imagen_usuarios = "";
						$_id_usuarios = $result[0]->id_usuarios;
						
						if( $_FILES['fotografia_usuarios']['tmp_name']!="" ){
							
							$directorio = $_SERVER['DOCUMENT_ROOT'].'/rp_c/fotografias_usuarios/';
							
							$nombre = $_FILES['fotografia_usuarios']['name'];
							$tipo = $_FILES['fotografia_usuarios']['type'];
							$tamano = $_FILES['fotografia_usuarios']['size'];
							
							move_uploaded_file($_FILES['fotografia_usuarios']['tmp_name'],$directorio.$nombre);
							$data = file_get_contents($directorio.$nombre);
							$imagen_usuarios = pg_escape_bytea($data);
						}
						
						$colval = "cedula_usuarios= '$_cedula_usuarios', nombre_usuarios = '$_nombre_usuarios',  telefono_usuarios = '$_telefono_usuarios', celular_usuarios = '$_celular_usuarios', correo_usuarios = '$_correo_usuarios', fotografia_usuarios ='$imagen_usuarios'";
						$tabla = "usuarios";
						$where = "id_usuarios = '$_id_usuarios'";
						$resultado=$usuarios->UpdateBy($colval, $tabla, $where);*/
						
						/*implementar actualizacion de claves*/
						
					}
					else{
						
						$imagen_usuarios="";
						
						/*consultamos datos de catalogo*/
						//estado usuario catalogo
						$wherecatalogo = "nombre_catalogo='ACTIVO' AND  tabla_catalogo='usuarios' AND columna_catalogo='estado_usuarios'";
						$resultCatalogo = $catalogo->getCondiciones('valor_catalogo' ,'public.catalogo' , $wherecatalogo , 'tabla_catalogo');
						$_estado_usuarios = $resultCatalogo[0]->valor_catalogo;
						
						
						$funcion = "ins_usuarios";
						$parametros = "'$_cedula_usuarios',
								'$_nombre_usuarios',
								'$_apellidos_usuario',
								'$_correo_usuarios',
								'$_celular_usuarios',
								'$_telefono_usuarios',
								'$_fecha_nacimiento_usuarios',
								'$_usuario_usuarios',
								'$_estado_usuarios',
								'$imagen_usuarios'";
						$usuarios->setFuncion($funcion);
						$usuarios->setParametros($parametros);
						$resultado=$usuarios->Insert();
						
						//para datos de usuario traer de BD
						$rsUsuario = null;
						$whereconsulta = "cedula_usuarios = '$_cedula_usuarios' AND nombre_usuarios = '$_nombre_usuarios' AND apellidos_usuarios = '$_apellidos_usuario'AND correo_usuarios = '$_correo_usuarios'AND usuario_usuarios='$_usuario_usuarios'";
						$rsUsuario=$usuarios->getCondiciones('id_usuarios' ,'public.usuarios' , $whereconsulta , 'id_usuarios');
						
						//valor para guardar el id_usuarios
						$consulta_id_usuarios = null;
						$consulta_id_usuarios = $rsUsuario[0]->id_usuarios;
						
						/*consultamos datos de catalogo para claves*/
						//estado usuario catalogo
						$wherecatalogo = "nombre_catalogo='ACTUAL' AND  tabla_catalogo='claves' AND columna_catalogo='estado_claves'";
						$resultCatalogo = $catalogo->getCondiciones('valor_catalogo' ,'public.catalogo' , $wherecatalogo , 'tabla_catalogo');
						$_estado_claves = $resultCatalogo[0]->valor_catalogo;
						
						//para fecha de insersion clave
						$_clave_caduca="0";
						if((int)$_caduca_clave ==1 || $_caduca_clave=="on"){
							
							$_clave_caduca="1";
						}
						
						//para fecha de insersion clave
						$clave_fecha_hoy = date("Y-m-d");
						$clave_fecha_siguiente_mes = date("Y-m-d",strtotime($clave_fecha_hoy."+ 1 month"));
						//para insertado de claves
						$claves = new ClavesModel();
						$funcion = "ins_claves";
						$parametros = "'$consulta_id_usuarios',
								'$_clave_usuarios',
								'$_clave_n_usuarios',
								'$clave_fecha_hoy',
								'$clave_fecha_siguiente_mes',
								'$_clave_caduca',
								'$_estado_claves'";
						$claves->setFuncion($funcion);
						$claves->setParametros($parametros);
						$resultado=$claves->Insert();
						
						
						//para el ingreso de los privilegios
						$privilegios = null;
						$privilegios = new PrivilegiosModel();
						
						/*consultamos datos de catalogo*/
						//estado catalogo
						$wherecatalogo = "nombre_catalogo='ACTIVO' AND  tabla_catalogo='privilegios' AND columna_catalogo='estado_rol_privilegios'";
						$resultCatalogo = $catalogo->getCondiciones('valor_catalogo' ,'public.catalogo' , $wherecatalogo , 'tabla_catalogo');
						$_estado_privilegios = $resultCatalogo[0]->valor_catalogo;
						//tipo rol catalogo
						$wherecatalogo = "nombre_catalogo='PRINCIPAL' AND  tabla_catalogo='privilegios' AND columna_catalogo='tipo_rol_privilegios'";
						$resultCatalogo = $catalogo->getCondiciones('valor_catalogo' ,'public.catalogo' , $wherecatalogo , 'tabla_catalogo');
						$_tipo_rol_privilegios = $resultCatalogo[0]->valor_catalogo;
						
						$funcion = "ins_privilegios";
						
						$parametros = "'$consulta_id_usuarios',
								'$_id_rol_principal',
								'$_tipo_rol_privilegios',
								'$_estado_privilegios'";
						
						$privilegios->setFuncion($funcion);
						$privilegios->setParametros($parametros);
						$resultado=$privilegios->Insert();
						
						//para ingreso de roles secundarios
						if(count($_array_roles)>0){
							
							/*consultamos datos de catalogo*/
							
							//tipo rol catalogo
							$wherecatalogo = "nombre_catalogo='SECUNDARIO' AND  tabla_catalogo='privilegios' AND columna_catalogo='tipo_rol_privilegios'";
							$resultCatalogo = $catalogo->getCondiciones('valor_catalogo' ,'public.catalogo' , $wherecatalogo , 'tabla_catalogo');
							$_tipo_rol_privilegios = $resultCatalogo[0]->valor_catalogo;
							
							foreach ($_array_roles as $id_rol){
								
								$funcion = "ins_privilegios";
								
								$parametros = "'$consulta_id_usuarios',
								'$id_rol',
								'$_tipo_rol_privilegios',
								'$_estado_privilegios'";
								
								$privilegios->setFuncion($funcion);
								$privilegios->setParametros($parametros);
								$resultado=$privilegios->Insert();
								
							}//fin de foreach
							
						}//fin array de roles
						
					}
				
				}
			}
			
						
			$this->redirect("Usuarios", "index");
		}
		
	   }else{
	   	
	   	$error = TRUE;
	   	$mensaje = "Te sesión a caducado, vuelve a iniciar sesión.";
	   		
	   	$this->view("Login",array(
	   			"resultSet"=>"$mensaje", "error"=>$error
	   	));
	   		
	   		
	   	die();
	   	
	   }
	}
	
	public function borrarId()
	{
	    session_start();
	    $id_usuario_on = (int)$_SESSION['id_usuarios'];
	    $catalogo = null; $catalogo= new CatalogoModel();
	    
		if(isset($_GET["id_usuarios"]))
		{
			$id_usuario=(int)$_GET["id_usuarios"];
			
			if($id_usuario_on!=$id_usuario){
			    
			    //estado_usuario
			    $wherecatalogo = "nombre_catalogo='INACTIVO' AND  tabla_catalogo='usuarios' AND columna_catalogo='estado_usuarios'";
			    $resultCatalogo = $catalogo->getCondiciones('valor_catalogo' ,'public.catalogo' , $wherecatalogo , 'tabla_catalogo');
			    $estado_usuarios = $resultCatalogo[0]->valor_catalogo;
			    
			    $usuarios=new UsuariosModel();
			    
			    $colval = "estado_usuarios='$estado_usuarios'";
			    $tabla = "usuarios";
			    $where = "id_usuarios = '$id_usuario'";
			    $resultado=$usuarios->UpdateBy($colval, $tabla, $where);
			    
			    
			}
			
		}
	
		$this->redirect("Usuarios", "index");
	}
	
	
	public function Inicio(){
	
		session_start();
		
		$this->view("Login",array(
				"allusers"=>""
		));
	}
    
    
    public function Login(){
    
    	session_destroy();
    	$usuarios=new UsuariosModel();
    
    	//Conseguimos todos los usuarios
    	$allusers=$usuarios->getLogin();
    	 
    	//Cargamos la vista index y l e pasamos valores
    	$this->view("Login",array(
    			"allusers"=>$allusers
    	));
    }
    
    
    
    
    
    public function Loguear(){
    	
    	if (isset($_POST["usuario"]) && ($_POST["clave"] ) )
    	{
    	
    		
    		$usuarios=new UsuariosModel();
    		$_usuario = $_POST["usuario"];
    		$_clave =   $usuarios->encriptar($_POST["clave"]);
    		
    		
    		$columnas="usuarios.id_usuarios,
                      usuarios.cedula_usuarios, 
                      usuarios.nombre_usuarios, 
					  usuarios.apellidos_usuarios,
					  usuarios.usuario_usuarios,                       
					  usuarios.estado_usuarios";
					  
			$tablas="public.usuarios";
			
    		$where="usuarios.cedula_usuarios='$_usuario' AND usuarios.clave_usuarios='$_clave' ";
    		$id="usuarios.cedula_usuarios";
    		$result=$usuarios->getCondiciones($columnas, $tablas, $where, $id);
    		
    		$id_usuarios=0;
    		$usuario_usuarios = "";
    		$id_rol  = "";
    		$nombre_usuarios = "";
    		$apellido_usuarios = "";
    		$correo_usuarios = "";
    		$estado_usuarios=0;
    		$ip_usuarios = "";
    		
    		if ( !empty($result) )
    		{ 
    			foreach($result as $res) 
    			{
    				$id_usuarios  		= $res->id_usuarios;
    				$usuario_usuarios  	= $res->usuario_usuarios;
	    			$nombre_usuarios   	= $res->nombre_usuarios;
	    			$apellido_usuarios  = $res->apellidos_usuarios;
	    			$estado_usuarios    = (boolean) $res->estado_usuarios;
	    			$cedula_usuarios    = $res->cedula_usuarios;
	    			
				}	
				
    			
    			if($estado_usuarios==1){
    				
    				
    				
    				//$usuarios->MenuDinamico($_id_rol);
    				
					//inserto en la session
					$usuarios->registrarSesion($id_usuarios, $usuario_usuarios, "0", $nombre_usuarios, $apellido_usuarios, "", "", $cedula_usuarios);
    				$_id_usuario = $_SESSION['id_usuarios'];    				 
    				
    				
    				//if($_id_rol==1){
    					

    					$this->view("BienvenidaAdmin",array(
    							""=>""
    					));
    					
    					die();
    					
    				/*}else{
    					
    					$this->view("Bienvenida",array(
    							""=>""
    					));
    						
    					die();
    					
    				}*/
    				
    				
    			}else{
    				
    				$error = TRUE;
    				$mensaje = "Hola $nombre_usuarios $apellido_usuarios tu usuario se encuentra inactivo.";
    				 
    				 
    				$this->view("Login",array(
    						"resultSet"=>"$mensaje", "error"=>$error
    				));
    				 
    				 
    				die();
    			}
    			
    			
    		}
    		else
    		{
    			$error = TRUE;
    			$mensaje = "Este Usuario no existe resgistrado en nuestro sistema.";
    			
    			
	    		$this->view("Login",array(
	    				"resultSet"=>"$mensaje", "error"=>$error
	    		));
	    		
	    		
	    		die();
    		}
    		
    	} 
    	else
    	{
    		    $error = TRUE;
    			$mensaje = "Ingrese su cedula y su clave.";
    			
    			
	    		$this->view("Login",array(
	    				"resultSet"=>"$mensaje", "error"=>$error
	    		));
	    		
	    		
	    		die();
    		
    	}
    	
    }

    
    public function  sesion_caducada()
    {
    	session_start();
    	session_destroy();
    
    	$error = TRUE;
	    $mensaje = "Te sesión a caducado, vuelve a iniciar sesión.";
	    	
	    $this->view("Login",array(
	    		"resultSet"=>"$mensaje", "error"=>$error
	    ));
	    	
	    die();
	    		
    
    }
    
    
	public function  cerrar_sesion ()
	{
		session_start();
		session_destroy();
		
		$error = TRUE;
		$mensaje = "Te has desconectado de nuestro sistema.";
		 
		 
		$this->view("Login",array(
				"resultSet"=>"$mensaje", "error"=>$error
		));
		 
		 
		die();
		
		
	}
	

	public function paginate($reload, $page, $tpages, $adjacents) {
	
		$prevlabel = "&lsaquo; Prev";
		$nextlabel = "Next &rsaquo;";
		$out = '<ul class="pagination pagination-large">';
	
		// previous label
	
		if($page==1) {
			$out.= "<li class='disabled'><span><a>$prevlabel</a></span></li>";
		} else if($page==2) {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_usuarios(1)'>$prevlabel</a></span></li>";
		}else {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_usuarios(".($page-1).")'>$prevlabel</a></span></li>";
	
		}
	
		// first label
		if($page>($adjacents+1)) {
			$out.= "<li><a href='javascript:void(0);' onclick='load_usuarios(1)'>1</a></li>";
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
				$out.= "<li><a href='javascript:void(0);' onclick='load_usuarios(1)'>$i</a></li>";
			}else {
				$out.= "<li><a href='javascript:void(0);' onclick='load_usuarios(".$i.")'>$i</a></li>";
			}
		}
	
		// interval
	
		if($page<($tpages-$adjacents-1)) {
			$out.= "<li><a>...</a></li>";
		}
	
		// last
	
		if($page<($tpages-$adjacents)) {
			$out.= "<li><a href='javascript:void(0);' onclick='load_usuarios($tpages)'>$tpages</a></li>";
		}
	
		// next
	
		if($page<$tpages) {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_usuarios(".($page+1).")'>$nextlabel</a></span></li>";
		}else {
			$out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
		}
	
		$out.= "</ul>";
		return $out;
	}
	
	

	////////////////////////////////////////REPORTES /////////////////////////////////////////////////////////////
	
	
	
	
	public function generar_reporte()
	{
	
		session_start();
		$ordinario_detalle = new Ordinario_DetalleModel();
		$ordinario_solicitud = new Ordinario_SolicitudModel();
		$emergente_solicitud = new Emergente_SolicitudModel();
		$emergente_detalle = new Emergente_DetalleModel();
		$c2x1_solicitud = new C2x1_solicitudModel();
		$c2x1_detalle = new C2x1_detalleModel();
		$app_solicitud = new app_solicitudModel();
		$app_detalle = new app_detalleModel();
		$hipotecario_solicitud = new Hipotecario_SolicitudModel();
		$hipotecario_detalle = new Hipotecario_DetalleModel();
		$afiliado_transacc_cta_ind = new Afiliado_transacc_cta_indModel();
		$afiliado_transacc_cta_desemb = new Afiliado_transacc_cta_desembModel();
		$usuarios= new UsuariosModel();
	
		$refinanciamiento_solicitud = new Refinanciamiento_SolicitudModel();
		$refinanciamiento_detalle = new Refinanciamiento_DetalleModel();
	
		$html="";
	
	
	
		$cedula_usuarios = $_SESSION["cedula_participe"];
		$fechaactual = getdate();
		$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		$fechaactual=$dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
		 
		$directorio = $_SERVER ['DOCUMENT_ROOT'] . '/webcapremci';
		$dom=$directorio.'/view/dompdf/dompdf_config.inc.php';
		$domLogo=$directorio.'/view/images/lcaprem.png';
		$logo = '<img src="'.$domLogo.'" alt="Responsive image" width="200" height="50">';
		 
	
	
		if(!empty($cedula_usuarios)){
				
	
			if(isset($_GET["credito"])){
	
				$credito=$_GET["credito"];
	
	
				if($credito=="ordinario"){
						
						
					$columnas_ordi_cabec ="*";
					$tablas_ordi_cabec="ordinario_solicitud";
					$where_ordi_cabec="cedula='$cedula_usuarios'";
					$id_ordi_cabec="cedula";
					$resultCredOrdi_Cabec=$ordinario_solicitud->getCondicionesDesc($columnas_ordi_cabec, $tablas_ordi_cabec, $where_ordi_cabec, $id_ordi_cabec);
	
						
	
					if(!empty($resultCredOrdi_Cabec)){
							
						$_numsol_ordinario=$resultCredOrdi_Cabec[0]->numsol;
						$_cuota_ordinario=$resultCredOrdi_Cabec[0]->cuota;
						$_interes_ordinario=$resultCredOrdi_Cabec[0]->interes;
						$_tipo_ordinario=$resultCredOrdi_Cabec[0]->tipo;
						$_plazo_ordinario=$resultCredOrdi_Cabec[0]->plazo;
						$_fcred_ordinario=$resultCredOrdi_Cabec[0]->fcred;
						$_ffin_ordinario=$resultCredOrdi_Cabec[0]->ffin;
						$_cuenta_ordinario=$resultCredOrdi_Cabec[0]->cuenta;
						$_banco_ordinario=$resultCredOrdi_Cabec[0]->banco;
						$_valor_ordinario= number_format($resultCredOrdi_Cabec[0]->valor, 2, '.', ',');
						$_cedula_ordinario=$resultCredOrdi_Cabec[0]->cedula;
						$_nombres_ordinario=$resultCredOrdi_Cabec[0]->nombres;
							
						if($_numsol_ordinario != ""){
	
							$columnas_ordi_detall ="numsol,
										pago,
										mes,
										ano,
										fecpag,ROUND(capital,2) as capital,
										ROUND(interes,2) as interes,
										ROUND(intmor,2) as intmor,
										ROUND(seguros,2) as seguros,
										ROUND(total,2) as total,
										ROUND(saldo,2) as saldo,
										estado";
								
							$tablas_ordi_detall="ordinario_detalle";
							$where_ordi_detall="numsol='$_numsol_ordinario'";
							$id_ordi_detall="pago";
							$resultSet=$ordinario_detalle->getCondiciones($columnas_ordi_detall, $tablas_ordi_detall, $where_ordi_detall, $id_ordi_detall);
	
								
							$html.='<p style="text-align: right;">'.$logo.'<hr style="height: 2px; background-color: black;"></p>';
							$html.='<p style="text-align: right; font-size: 13px;"><b>Impreso:</b> '.$fechaactual.'</p>';
							$html.='<p style="text-align: center; font-size: 16px;"><b>DETALLE CRÉDITO ORDINARIO</b></p>';
	
							$html.= '<p style="margin-top:15px; text-align: justify; font-size: 13px;"><b>NOMBRES:</b> '.$_nombres_ordinario.'  <b style="margin-left: 20%; font-size: 13px;">IDENTIFICACIÓN:</b> '.$_cedula_ordinario.'</p>';
	
							$html.= "<table style='width: 100%;' border=1 cellspacing=0 >";
							$html.= '<tr style="background-color: #D5D8DC;">';
							$html.='<th style="text-align: left;  font-size: 13px;">No de Solicitud:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Monto Concedido:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Cuota:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Interes:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Tipo:</th>';
							$html.='</tr>';
	
							$html.= "<tr>";
							$html.='<td style="font-size: 13px;">'.$_numsol_ordinario.'</td>';
							$html.='<td style="font-size: 13px;">'.$_valor_ordinario.'</td>';
							$html.='<td style="font-size: 13px;">'.$_cuota_ordinario.'</td>';
							$html.='<td style="font-size: 13px;">'.$_interes_ordinario.'</td>';
							$html.='<td style="font-size: 13px;">'.$_tipo_ordinario.'</td>';
							$html.='</tr>';
	
	
							$html.= '<tr style="background-color: #D5D8DC;">';
							$html.='<th style="text-align: left;  font-size: 13px;">PLazo:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Concedido en:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Termina en:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Cuenta No:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Banco:</th>';
							$html.='</tr>';
								
							$html.= "<tr>";
							$html.='<td style="font-size: 13px;">'.$_plazo_ordinario.'</td>';
							$html.='<td style="font-size: 13px;">'.$_fcred_ordinario.'</td>';
							$html.='<td style="font-size: 13px;">'.$_ffin_ordinario.'</td>';
							$html.='<td style="font-size: 13px;">'.$_cuenta_ordinario.'</td>';
							$html.='<td style="font-size: 13px;">'.$_banco_ordinario.'</td>';
							$html.='</tr>';
								
							$html.='</table>';
	
	
	
	
							$html.= "<table style='margin-top:20px; width: 100%;' border=1 cellspacing=0 cellpadding=2>";
							$html.= "<thead>";
							$html.= "<tr style='background-color: #D5D8DC;'>";
								
							$html.='<th style="text-align: left;  font-size: 12px;">Pago</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Mes</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">A&ntilde;o</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Fecha Pago</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Capital</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Interes</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Interes por Mora</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Seguro Desgr.</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Total</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Saldo</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Estado</th>';
							$html.='</tr>';
							$html.='</thead>';
							$html.='<tbody>';
	
							$i=0;
							foreach ($resultSet as $res)
							{
								$i++;
								$html.='<tr>';
								$html.='<td style="font-size: 12px;">'.$res->pago.'</td>';
								$html.='<td style="font-size: 12px;">'.$res->mes.'</td>';
								$html.='<td style="font-size: 12px;">'.$res->ano.'</td>';
								$html.='<td style="font-size: 12px;">'.$res->fecpag.'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->capital, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->interes, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->intmor, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->seguros, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->total, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->saldo, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.$res->estado.'</td>';
								$html.='</tr>';
							}
	
							$html.='</tbody>';
							$html.='</table>';
	
						}
							
					}
	
						
					$this->report("Creditos",array( "resultSet"=>$html));
					die();
						
						
						
						
				}elseif ($credito=="emergente"){
						
						
					$columnas_emer_cabec ="*";
					$tablas_emer_cabec="emergente_solicitud";
					$where_emer_cabec="cedula='$cedula_usuarios'";
					$id_emer_cabec="cedula";
					$resultCredEmer_Cabec=$emergente_solicitud->getCondicionesDesc($columnas_emer_cabec, $tablas_emer_cabec, $where_emer_cabec, $id_emer_cabec);
						
						
						
	
						
					if(!empty($resultCredEmer_Cabec)){
							
						$_numsol_emergente=$resultCredEmer_Cabec[0]->numsol;
						$_cuota_emergente=$resultCredEmer_Cabec[0]->cuota;
						$_interes_emergente=$resultCredEmer_Cabec[0]->interes;
						$_tipo_emergente=$resultCredEmer_Cabec[0]->tipo;
						$_plazo_emergente=$resultCredEmer_Cabec[0]->plazo;
						$_fcred_emergente=$resultCredEmer_Cabec[0]->fcred;
						$_ffin_emergente=$resultCredEmer_Cabec[0]->ffin;
						$_cuenta_emergente=$resultCredEmer_Cabec[0]->cuenta;
						$_banco_emergente=$resultCredEmer_Cabec[0]->banco;
						$_valor_emergente= number_format($resultCredEmer_Cabec[0]->valor, 2, '.', ',');
						$_cedula_emergente=$resultCredEmer_Cabec[0]->cedula;
						$_nombres_emergente=$resultCredEmer_Cabec[0]->nombres;
							
						if($_numsol_emergente != ""){
								
							$columnas_emer_detall ="numsol,
										CAST(pago as int),
										mes,
										ano,
										fecpag,ROUND(capital,2) as capital,
										ROUND(interes,2) as interes,
										ROUND(intmor,2) as intmor,
										ROUND(seguros,2) as seguros,
										ROUND(total,2) as total,
										ROUND(saldo,2) as saldo,
										estado";
	
							$tablas_emer_detall="emergente_detalle";
							$where_emer_detall="numsol='$_numsol_emergente'";
							$id_emer_detall="pago";
								
							$resultSet=$emergente_detalle->getCondiciones($columnas_emer_detall, $tablas_emer_detall, $where_emer_detall, $id_emer_detall);
								
	
							$html.='<p style="text-align: right;">'.$logo.'<hr style="height: 2px; background-color: black;"></p>';
							$html.='<p style="text-align: right; font-size: 13px;"><b>Impreso:</b> '.$fechaactual.'</p>';
							$html.='<p style="text-align: center; font-size: 16px;"><b>DETALLE CRÉDITO EMERGENTE</b></p>';
								
							$html.= '<p style="margin-top:15px; text-align: justify; font-size: 13px;"><b>NOMBRES:</b> '.$_nombres_emergente.'  <b style="margin-left: 20%; font-size: 13px;">IDENTIFICACIÓN:</b> '.$_cedula_emergente.'</p>';
								
							$html.= "<table style='width: 100%;' border=1 cellspacing=0 >";
							$html.= '<tr style="background-color: #D5D8DC;">';
							$html.='<th style="text-align: left;  font-size: 13px;">No de Solicitud:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Monto Concedido:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Cuota:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Interes:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Tipo:</th>';
							$html.='</tr>';
								
							$html.= "<tr>";
							$html.='<td style="font-size: 13px;">'.$_numsol_emergente.'</td>';
							$html.='<td style="font-size: 13px;">'.$_valor_emergente.'</td>';
							$html.='<td style="font-size: 13px;">'.$_cuota_emergente.'</td>';
							$html.='<td style="font-size: 13px;">'.$_interes_emergente.'</td>';
							$html.='<td style="font-size: 13px;">'.$_tipo_emergente.'</td>';
							$html.='</tr>';
								
								
							$html.= '<tr style="background-color: #D5D8DC;">';
							$html.='<th style="text-align: left;  font-size: 13px;">PLazo:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Concedido en:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Termina en:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Cuenta No:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Banco:</th>';
							$html.='</tr>';
	
							$html.= "<tr>";
							$html.='<td style="font-size: 13px;">'.$_plazo_emergente.'</td>';
							$html.='<td style="font-size: 13px;">'.$_fcred_emergente.'</td>';
							$html.='<td style="font-size: 13px;">'.$_ffin_emergente.'</td>';
							$html.='<td style="font-size: 13px;">'.$_cuenta_emergente.'</td>';
							$html.='<td style="font-size: 13px;">'.$_banco_emergente.'</td>';
							$html.='</tr>';
	
							$html.='</table>';
								
								
								
								
							$html.= "<table style='margin-top:20px; width: 100%;' border=1 cellspacing=0 cellpadding=2>";
							$html.= "<thead>";
							$html.= "<tr style='background-color: #D5D8DC;'>";
	
							$html.='<th style="text-align: left;  font-size: 12px;">Pago</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Mes</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">A&ntilde;o</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Fecha Pago</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Capital</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Interes</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Interes por Mora</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Seguro Desgr.</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Total</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Saldo</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Estado</th>';
							$html.='</tr>';
							$html.='</thead>';
							$html.='<tbody>';
								
							$i=0;
							foreach ($resultSet as $res)
							{
								$i++;
								$html.='<tr>';
								$html.='<td style="font-size: 12px;">'.$res->pago.'</td>';
								$html.='<td style="font-size: 12px;">'.$res->mes.'</td>';
								$html.='<td style="font-size: 12px;">'.$res->ano.'</td>';
								$html.='<td style="font-size: 12px;">'.$res->fecpag.'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->capital, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->interes, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->intmor, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->seguros, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->total, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->saldo, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.$res->estado.'</td>';
								$html.='</tr>';
							}
								
							$html.='</tbody>';
							$html.='</table>';
								
						}
							
					}
						
	
					$this->report("Creditos",array( "resultSet"=>$html));
					die();
						
						
						
				}elseif ($credito=="2_x_1"){
						
	
					$columnas_2_x_1_cabec ="*";
					$tablas_2_x_1_cabec="c2x1_solicitud";
					$where_2_x_1_cabec="cedula='$cedula_usuarios'";
					$id_2_x_1_cabec="cedula";
					$resultCred2_x_1_Cabec=$c2x1_solicitud->getCondicionesDesc($columnas_2_x_1_cabec, $tablas_2_x_1_cabec, $where_2_x_1_cabec, $id_2_x_1_cabec);
	
						
	
					if(!empty($resultCred2_x_1_Cabec)){
							
						$_numsol_2x1=$resultCred2_x_1_Cabec[0]->numsol;
						$_cuota_2x1=$resultCred2_x_1_Cabec[0]->cuota;
						$_interes_2x1=$resultCred2_x_1_Cabec[0]->interes;
						$_tipo_2x1=$resultCred2_x_1_Cabec[0]->tipo;
						$_plazo_2x1=$resultCred2_x_1_Cabec[0]->plazo;
						$_fcred_2x1=$resultCred2_x_1_Cabec[0]->fcred;
						$_ffin_2x1=$resultCred2_x_1_Cabec[0]->ffin;
						$_cuenta_2x1=$resultCred2_x_1_Cabec[0]->cuenta;
						$_banco_2x1=$resultCred2_x_1_Cabec[0]->banco;
						$_valor_2x1= number_format($resultCred2_x_1_Cabec[0]->valor, 2, '.', ',');
						$_cedula_2x1=$resultCred2_x_1_Cabec[0]->cedula;
						$_nombres_2x1=$resultCred2_x_1_Cabec[0]->nombres;
							
						if($_numsol_2x1 != ""){
	
	
							$columnas_2_x_1_detall ="numsol,
										pago,
										mes,
										ano,
										fecpag,ROUND(capital,2) as capital,
										ROUND(interes,2) as interes,
										ROUND(intmor,2) as intmor,
										ROUND(seguros,2) as seguros,
										ROUND(total,2) as total,
										ROUND(saldo,2) as saldo,
										estado";
							$tablas_2_x_1_detall="c2x1_detalle";
							$where_2_x_1_detall="numsol='$_numsol_2x1'";
							$id_2_x_1_detall="pago";
							$resultSet=$c2x1_detalle->getCondiciones($columnas_2_x_1_detall, $tablas_2_x_1_detall, $where_2_x_1_detall, $id_2_x_1_detall);
	
								
							$html.='<p style="text-align: right;">'.$logo.'<hr style="height: 2px; background-color: black;"></p>';
							$html.='<p style="text-align: right; font-size: 13px;"><b>Impreso:</b> '.$fechaactual.'</p>';
							$html.='<p style="text-align: center; font-size: 16px;"><b>DETALLE CRÉDITO 2 X 1</b></p>';
	
							$html.= '<p style="margin-top:15px; text-align: justify; font-size: 13px;"><b>NOMBRES:</b> '.$_nombres_2x1.'  <b style="margin-left: 20%; font-size: 13px;">IDENTIFICACIÓN:</b> '.$_cedula_2x1.'</p>';
	
							$html.= "<table style='width: 100%;' border=1 cellspacing=0 >";
							$html.= '<tr style="background-color: #D5D8DC;">';
							$html.='<th style="text-align: left;  font-size: 13px;">No de Solicitud:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Monto Concedido:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Cuota:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Interes:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Tipo:</th>';
							$html.='</tr>';
	
							$html.= "<tr>";
							$html.='<td style="font-size: 13px;">'.$_numsol_2x1.'</td>';
							$html.='<td style="font-size: 13px;">'.$_valor_2x1.'</td>';
							$html.='<td style="font-size: 13px;">'.$_cuota_2x1.'</td>';
							$html.='<td style="font-size: 13px;">'.$_interes_2x1.'</td>';
							$html.='<td style="font-size: 13px;">'.$_tipo_2x1.'</td>';
							$html.='</tr>';
	
	
							$html.= '<tr style="background-color: #D5D8DC;">';
							$html.='<th style="text-align: left;  font-size: 13px;">PLazo:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Concedido en:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Termina en:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Cuenta No:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Banco:</th>';
							$html.='</tr>';
								
							$html.= "<tr>";
							$html.='<td style="font-size: 13px;">'.$_plazo_2x1.'</td>';
							$html.='<td style="font-size: 13px;">'.$_fcred_2x1.'</td>';
							$html.='<td style="font-size: 13px;">'.$_ffin_2x1.'</td>';
							$html.='<td style="font-size: 13px;">'.$_cuenta_2x1.'</td>';
							$html.='<td style="font-size: 13px;">'.$_banco_2x1.'</td>';
							$html.='</tr>';
								
							$html.='</table>';
	
	
	
	
							$html.= "<table style='margin-top:20px; width: 100%;' border=1 cellspacing=0 cellpadding=2>";
							$html.= "<thead>";
							$html.= "<tr style='background-color: #D5D8DC;'>";
								
							$html.='<th style="text-align: left;  font-size: 12px;">Pago</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Mes</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">A&ntilde;o</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Fecha Pago</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Capital</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Interes</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Interes por Mora</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Seguro Desgr.</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Total</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Saldo</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Estado</th>';
							$html.='</tr>';
							$html.='</thead>';
							$html.='<tbody>';
	
							$i=0;
							foreach ($resultSet as $res)
							{
								$i++;
								$html.='<tr>';
								$html.='<td style="font-size: 12px;">'.$res->pago.'</td>';
								$html.='<td style="font-size: 12px;">'.$res->mes.'</td>';
								$html.='<td style="font-size: 12px;">'.$res->ano.'</td>';
								$html.='<td style="font-size: 12px;">'.$res->fecpag.'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->capital, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->interes, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->intmor, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->seguros, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->total, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->saldo, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.$res->estado.'</td>';
								$html.='</tr>';
							}
	
							$html.='</tbody>';
							$html.='</table>';
	
						}
							
					}
	
						
					$this->report("Creditos",array( "resultSet"=>$html));
					die();
	
	
	
						
						
						
						
				}elseif ($credito=="acuerdo_pago"){
						
						
					$columnas_app_cabec ="*";
					$tablas_app_cabec="app_solicitud";
					$where_app_cabec="cedula='$cedula_usuarios'";
					$id_app_cabec="cedula";
					$resultCredApp_Cabec=$app_solicitud->getCondicionesDesc($columnas_app_cabec, $tablas_app_cabec, $where_app_cabec, $id_app_cabec);
	
	
	
						
					if(!empty($resultCredApp_Cabec)){
							
						$_numsol_app=$resultCredApp_Cabec[0]->numsol;
						$_cuota_app=$resultCredApp_Cabec[0]->cuota;
						$_interes_app=$resultCredApp_Cabec[0]->interes;
						$_tipo_app=$resultCredApp_Cabec[0]->tipo;
						$_plazo_app=$resultCredApp_Cabec[0]->plazo;
						$_fcred_app=$resultCredApp_Cabec[0]->fcred;
						$_ffin_app=$resultCredApp_Cabec[0]->ffin;
						$_cuenta_app=$resultCredApp_Cabec[0]->cuenta;
						$_banco_app=$resultCredApp_Cabec[0]->banco;
						$_valor_app= number_format($resultCredApp_Cabec[0]->valor, 2, '.', ',');
						$_cedula_app=$resultCredApp_Cabec[0]->cedula;
						$_nombres_app=$resultCredApp_Cabec[0]->nombres;
							
						if($_numsol_app != ""){
								
								
							$columnas_app_detall ="numsol,
										pago,
										mes,
										ano,
										fecpag,ROUND(capital,2) as capital,
										ROUND(interes,2) as interes,
										ROUND(intmor,2) as intmor,
										ROUND(seguros,2) as seguros,
										ROUND(total,2) as total,
										ROUND(saldo,2) as saldo,
										estado";
								
							$tablas_app_detall="app_detalle";
							$where_app_detall="numsol='$_numsol_app'";
							$id_app_detall="pago";
							$resultSet=$app_detalle->getCondiciones($columnas_app_detall, $tablas_app_detall, $where_app_detall, $id_app_detall);
								
	
							$html.='<p style="text-align: right;">'.$logo.'<hr style="height: 2px; background-color: black;"></p>';
							$html.='<p style="text-align: right; font-size: 13px;"><b>Impreso:</b> '.$fechaactual.'</p>';
							$html.='<p style="text-align: center; font-size: 16px;"><b>DETALLE ACUERDO DE PAGO</b></p>';
								
							$html.= '<p style="margin-top:15px; text-align: justify; font-size: 13px;"><b>NOMBRES:</b> '.$_nombres_app.'  <b style="margin-left: 20%; font-size: 13px;">IDENTIFICACIÓN:</b> '.$_cedula_app.'</p>';
								
							$html.= "<table style='width: 100%;' border=1 cellspacing=0 >";
							$html.= '<tr style="background-color: #D5D8DC;">';
							$html.='<th style="text-align: left;  font-size: 13px;">No de Solicitud:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Monto Concedido:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Cuota:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Interes:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Tipo:</th>';
							$html.='</tr>';
								
							$html.= "<tr>";
							$html.='<td style="font-size: 13px;">'.$_numsol_app.'</td>';
							$html.='<td style="font-size: 13px;">'.$_valor_app.'</td>';
							$html.='<td style="font-size: 13px;">'.$_cuota_app.'</td>';
							$html.='<td style="font-size: 13px;">'.$_interes_app.'</td>';
							$html.='<td style="font-size: 13px;">'.$_tipo_app.'</td>';
							$html.='</tr>';
								
								
							$html.= '<tr style="background-color: #D5D8DC;">';
							$html.='<th style="text-align: left;  font-size: 13px;">PLazo:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Concedido en:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Termina en:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Cuenta No:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Banco:</th>';
							$html.='</tr>';
	
							$html.= "<tr>";
							$html.='<td style="font-size: 13px;">'.$_plazo_app.'</td>';
							$html.='<td style="font-size: 13px;">'.$_fcred_app.'</td>';
							$html.='<td style="font-size: 13px;">'.$_ffin_app.'</td>';
							$html.='<td style="font-size: 13px;">'.$_cuenta_app.'</td>';
							$html.='<td style="font-size: 13px;">'.$_banco_app.'</td>';
							$html.='</tr>';
	
							$html.='</table>';
								
								
								
								
							$html.= "<table style='margin-top:20px; width: 100%;' border=1 cellspacing=0 cellpadding=2>";
							$html.= "<thead>";
							$html.= "<tr style='background-color: #D5D8DC;'>";
	
							$html.='<th style="text-align: left;  font-size: 12px;">Pago</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Mes</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">A&ntilde;o</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Fecha Pago</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Capital</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Interes</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Interes por Mora</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Seguro Desgr.</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Total</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Saldo</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Estado</th>';
							$html.='</tr>';
							$html.='</thead>';
							$html.='<tbody>';
								
							$i=0;
							foreach ($resultSet as $res)
							{
								$i++;
								$html.='<tr>';
								$html.='<td style="font-size: 12px;">'.$res->pago.'</td>';
								$html.='<td style="font-size: 12px;">'.$res->mes.'</td>';
								$html.='<td style="font-size: 12px;">'.$res->ano.'</td>';
								$html.='<td style="font-size: 12px;">'.$res->fecpag.'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->capital, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->interes, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->intmor, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->seguros, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->total, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->saldo, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.$res->estado.'</td>';
								$html.='</tr>';
							}
								
							$html.='</tbody>';
							$html.='</table>';
								
						}
							
					}
						
	
					$this->report("Creditos",array( "resultSet"=>$html));
					die();
						
						
						
	
						
						
						
						
						
				}elseif ($credito=="hipotecario"){
						
						
	
					$columnas_hipo_cabec ="*";
					$tablas_hipo_cabec="hipotecario_solicitud";
					$where_hipo_cabec="cedula='$cedula_usuarios'";
					$id_hipo_cabec="cedula";
					$resultCredHipo_Cabec=$hipotecario_solicitud->getCondicionesDesc($columnas_hipo_cabec, $tablas_hipo_cabec, $where_hipo_cabec, $id_hipo_cabec);
						
						
						
	
					if(!empty($resultCredHipo_Cabec)){
							
						$_numsol_hipotecario=$resultCredHipo_Cabec[0]->numsol;
						$_cuota_hipotecario=$resultCredHipo_Cabec[0]->cuota;
						$_interes_hipotecario=$resultCredHipo_Cabec[0]->interes;
						$_tipo_hipotecario=$resultCredHipo_Cabec[0]->tipo;
						$_plazo_hipotecario=$resultCredHipo_Cabec[0]->plazo;
						$_fcred_hipotecario=$resultCredHipo_Cabec[0]->fcred;
						$_ffin_hipotecario=$resultCredHipo_Cabec[0]->ffin;
						$_cuenta_hipotecario=$resultCredHipo_Cabec[0]->cuenta;
						$_banco_hipotecario=$resultCredHipo_Cabec[0]->banco;
						$_valor_hipotecario= number_format($resultCredHipo_Cabec[0]->valor, 2, '.', ',');
						$_cedula_hipotecario=$resultCredHipo_Cabec[0]->cedula;
						$_nombres_hipotecario=$resultCredHipo_Cabec[0]->nombres;
							
						if($_numsol_hipotecario != ""){
	
	
							$columnas_hipo_detall ="numsol,
										pago,
										mes,
										ano,
										fecpag,ROUND(capital,2) as capital,
										ROUND(interes,2) as interes,
										ROUND(intmor,2) as intmor,
										ROUND(seguros,2) as seguros,
										ROUND(total,2) as total,
										ROUND(saldo,2) as saldo,
										estado";
								
							$tablas_hipo_detall="hipotecario_detalle";
							$where_hipo_detall="numsol='$_numsol_hipotecario'";
							$id_hipo_detall="pago";
							$resultSet=$hipotecario_detalle->getCondiciones($columnas_hipo_detall, $tablas_hipo_detall, $where_hipo_detall, $id_hipo_detall);
	
								
							$html.='<p style="text-align: right;">'.$logo.'<hr style="height: 2px; background-color: black;"></p>';
							$html.='<p style="text-align: right; font-size: 13px;"><b>Impreso:</b> '.$fechaactual.'</p>';
							$html.='<p style="text-align: center; font-size: 16px;"><b>DETALLE CRÉDITO HIPOTECARIO</b></p>';
	
							$html.= '<p style="margin-top:15px; text-align: justify; font-size: 13px;"><b>NOMBRES:</b> '.$_nombres_hipotecario.'  <b style="margin-left: 20%; font-size: 13px;">IDENTIFICACIÓN:</b> '.$_cedula_hipotecario.'</p>';
	
							$html.= "<table style='width: 100%;' border=1 cellspacing=0 >";
							$html.= '<tr style="background-color: #D5D8DC;">';
							$html.='<th style="text-align: left;  font-size: 13px;">No de Solicitud:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Monto Concedido:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Cuota:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Interes:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Tipo:</th>';
							$html.='</tr>';
	
							$html.= "<tr>";
							$html.='<td style="font-size: 13px;">'.$_numsol_hipotecario.'</td>';
							$html.='<td style="font-size: 13px;">'.$_valor_hipotecario.'</td>';
							$html.='<td style="font-size: 13px;">'.$_cuota_hipotecario.'</td>';
							$html.='<td style="font-size: 13px;">'.$_interes_hipotecario.'</td>';
							$html.='<td style="font-size: 13px;">'.$_tipo_hipotecario.'</td>';
							$html.='</tr>';
	
	
							$html.= '<tr style="background-color: #D5D8DC;">';
							$html.='<th style="text-align: left;  font-size: 13px;">PLazo:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Concedido en:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Termina en:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Cuenta No:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Banco:</th>';
							$html.='</tr>';
								
							$html.= "<tr>";
							$html.='<td style="font-size: 13px;">'.$_plazo_hipotecario.'</td>';
							$html.='<td style="font-size: 13px;">'.$_fcred_hipotecario.'</td>';
							$html.='<td style="font-size: 13px;">'.$_ffin_hipotecario.'</td>';
							$html.='<td style="font-size: 13px;">'.$_cuenta_hipotecario.'</td>';
							$html.='<td style="font-size: 13px;">'.$_banco_hipotecario.'</td>';
							$html.='</tr>';
								
							$html.='</table>';
	
	
	
	
							$html.= "<table style='margin-top:20px; width: 100%;' border=1 cellspacing=0 cellpadding=2>";
							$html.= "<thead>";
							$html.= "<tr style='background-color: #D5D8DC;'>";
								
							$html.='<th style="text-align: left;  font-size: 12px;">Pago</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Mes</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">A&ntilde;o</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Fecha Pago</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Capital</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Interes</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Interes por Mora</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Seguro Desgr.</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Total</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Saldo</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Estado</th>';
							$html.='</tr>';
							$html.='</thead>';
							$html.='<tbody>';
	
							$i=0;
							foreach ($resultSet as $res)
							{
								$i++;
								$html.='<tr>';
								$html.='<td style="font-size: 12px;">'.$res->pago.'</td>';
								$html.='<td style="font-size: 12px;">'.$res->mes.'</td>';
								$html.='<td style="font-size: 12px;">'.$res->ano.'</td>';
								$html.='<td style="font-size: 12px;">'.$res->fecpag.'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->capital, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->interes, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->intmor, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->seguros, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->total, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->saldo, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.$res->estado.'</td>';
								$html.='</tr>';
							}
	
							$html.='</tbody>';
							$html.='</table>';
	
						}
							
					}
	
						
					$this->report("Creditos",array( "resultSet"=>$html));
					die();
						
						
						
						
						
				}elseif ($credito=="cta_individual"){
						
						
	
					$columnas_ind="afiliado_transacc_cta_ind.id_afiliado_transacc_cta_ind,
							  afiliado_transacc_cta_ind.ordtran,
							  afiliado_transacc_cta_ind.histo_transacsys,
							  afiliado_transacc_cta_ind.cedula,
							  afiliado_transacc_cta_ind.fecha_conta,
							  afiliado_transacc_cta_ind.descripcion,
							  afiliado_transacc_cta_ind.mes_anio,
							  afiliado_transacc_cta_ind.valorper,
							  afiliado_transacc_cta_ind.valorpat,
							  afiliado_transacc_cta_ind.saldoper,
							  afiliado_transacc_cta_ind.saldopat,
							  afiliado_transacc_cta_ind.id_afiliado";
					$tablas_ind="public.afiliado_transacc_cta_ind";
					$where_ind="1=1 AND afiliado_transacc_cta_ind.cedula='$cedula_usuarios'";
					$id_ind="afiliado_transacc_cta_ind.secuencial_saldos";
					$resultSet=$afiliado_transacc_cta_ind->getCondicionesDesc($columnas_ind, $tablas_ind, $where_ind, $id_ind);
						
						
						
	
					if(!empty($resultSet)){
	
	
						$result_par=$usuarios->getBy("cedula_usuarios='$cedula_usuarios'");
	
						if(!empty($result_par)){
							$_cedula_usuarios=$result_par[0]->cedula_usuarios;
							$_nombre_usuarios=$result_par[0]->nombre_usuarios;
								
						}else{
								
							$_cedula_usuarios="";
							$_nombre_usuarios="";
						}
	
	
						$columnas_ind_mayor = "sum(valorper+valorpat) as total, max(fecha_conta) as fecha";
						$tablas_ind_mayor="afiliado_transacc_cta_ind";
						$where_ind_mayor="cedula='$cedula_usuarios'";
						$resultDatosMayor_Cta_individual=$afiliado_transacc_cta_ind->getCondicionesValorMayor($columnas_ind_mayor, $tablas_ind_mayor, $where_ind_mayor);
							
						if (!empty($resultDatosMayor_Cta_individual)) {  foreach($resultDatosMayor_Cta_individual as $res) {
	
							$fecha=$res->fecha;
							$total= number_format($res->total, 2, '.', ',');
						}}else{
	
							$fecha="";
							$total= 0.00;
	
						}
	
	
						$html.='<p style="text-align: right;">'.$logo.'<hr style="height: 2px; background-color: black;"></p>';
						$html.='<p style="text-align: right; font-size: 13px;"><b>Impreso:</b> '.$fechaactual.'</p>';
						$html.='<p style="text-align: center; font-size: 16px;"><b>DETALLE CUENTA INDIVIDUAL</b></p>';
						$html.= '<p style="margin-top:15px; text-align: justify; font-size: 13px;"><b>NOMBRES:</b> '.$_nombre_usuarios.'  <b style="margin-left: 20%; font-size: 13px;">IDENTIFICACIÓN:</b> '.$_cedula_usuarios.'</p>';
						$html.='<center style="margin-top:5px;"><h4><b>Total Cuenta Individual Actualizada al</b> '.$fecha.' : $'.$total.'</h4></center>';
						$html.= "<table style='margin-top:5px; width: 100%;' border=1 cellspacing=0 cellpadding=2>";
						$html.= "<thead>";
						$html.= "<tr style='background-color: #D5D8DC;'>";
							
						$html.='<th style="text-align: left;  font-size: 12px;">Fecha</th>';
						$html.='<th style="text-align: left;  font-size: 12px;">Descripción</th>';
						$html.='<th style="text-align: left;  font-size: 12px;">Mes/A&ntilde;o</th>';
						$html.='<th style="text-align: left;  font-size: 12px;">Valor Personal</th>';
						$html.='<th style="text-align: left;  font-size: 12px;">Valor Patronal</th>';
						$html.='<th style="text-align: left;  font-size: 12px;">Saldo Personal</th>';
						$html.='<th style="text-align: left;  font-size: 12px;">Saldo Patronal</th>';
							
						$html.='</tr>';
						$html.='</thead>';
						$html.='<tbody>';
	
						$i=0;
						foreach ($resultSet as $res)
						{
							$i++;
							$html.='<tr>';
							$html.='<td style="font-size: 11px;">'.$res->fecha_conta.'</td>';
							$html.='<td style="font-size: 11px;">'.$res->descripcion.'</td>';
							$html.='<td style="font-size: 11px;">'.$res->mes_anio.'</td>';
							$html.='<td style="font-size: 11px;">'.number_format($res->valorper, 2, '.', ',').'</td>';
							$html.='<td style="font-size: 11px;">'.number_format($res->valorpat, 2, '.', ',').'</td>';
							$html.='<td style="font-size: 11px;">'.number_format($res->saldoper, 2, '.', ',').'</td>';
							$html.='<td style="font-size: 11px;">'.number_format($res->saldopat, 2, '.', ',').'</td>';
							$html.='</tr>';
						}
	
						$html.='</tbody>';
						$html.='</table>';
	
	
							
					}
	
						
					$this->report("Creditos",array( "resultSet"=>$html));
					die();
						
						
						
						
				}elseif ($credito=="cta_desembolsar"){
						
						
	
					$columnas_desemb="afiliado_transacc_cta_desemb.id_afiliado_transacc_cta_desemb,
						  	afiliado_transacc_cta_desemb.ordtran,
						  	afiliado_transacc_cta_desemb.histo_transacsys,
						  	afiliado_transacc_cta_desemb.cedula,
						  	afiliado_transacc_cta_desemb.fecha_conta,
						  	afiliado_transacc_cta_desemb.descripcion,
						  	afiliado_transacc_cta_desemb.mes_anio,
						  	afiliado_transacc_cta_desemb.valorper,
						 	afiliado_transacc_cta_desemb.valorpat,
						  	afiliado_transacc_cta_desemb.saldoper,
						 	afiliado_transacc_cta_desemb.saldopat,
						    afiliado_transacc_cta_desemb.id_afiliado";
					$tablas_desemb="public.afiliado_transacc_cta_desemb";
					$where_desemb="1=1 AND afiliado_transacc_cta_desemb.cedula='$cedula_usuarios'";
					$id_desemb="afiliado_transacc_cta_desemb.secuencial_saldos";
					$resultSet=$afiliado_transacc_cta_ind->getCondicionesDesc($columnas_desemb, $tablas_desemb, $where_desemb, $id_desemb);
						
						
						
	
					if(!empty($resultSet)){
	
	
						$result_par=$usuarios->getBy("cedula_usuarios='$cedula_usuarios'");
	
						if(!empty($result_par)){
							$_cedula_usuarios=$result_par[0]->cedula_usuarios;
							$_nombre_usuarios=$result_par[0]->nombre_usuarios;
								
						}else{
								
							$_cedula_usuarios="";
							$_nombre_usuarios="";
						}
	
	
						$columnas_desemb_mayor = "sum(valorper+valorpat) as total, max(fecha_conta) as fecha";
						$tablas_desemb_mayor="afiliado_transacc_cta_desemb";
						$where_desemb_mayor="cedula='$cedula_usuarios'";
						$resultDatosMayor_Cta_desembolsar=$afiliado_transacc_cta_ind->getCondicionesValorMayor($columnas_desemb_mayor, $tablas_desemb_mayor, $where_desemb_mayor);
							
						if (!empty($resultDatosMayor_Cta_desembolsar)) {  foreach($resultDatosMayor_Cta_desembolsar as $res) {
	
							$fecha=$res->fecha;
							$total= number_format($res->total, 2, '.', ',');
						}}else{
	
							$fecha="";
							$total= 0.00;
	
						}
	
	
						$html.='<p style="text-align: right;">'.$logo.'<hr style="height: 2px; background-color: black;"></p>';
						$html.='<p style="text-align: right; font-size: 13px;"><b>Impreso:</b> '.$fechaactual.'</p>';
						$html.='<p style="text-align: center; font-size: 16px;"><b>DETALLE CUENTA DESEMBOLSAR</b></p>';
						$html.= '<p style="margin-top:15px; text-align: justify; font-size: 13px;"><b>NOMBRES:</b> '.$_nombre_usuarios.'  <b style="margin-left: 20%; font-size: 13px;">IDENTIFICACIÓN:</b> '.$_cedula_usuarios.'</p>';
						$html.='<center style="margin-top:5px;"><h4><b>Total Cuenta Individual Actualizada al</b> '.$fecha.' : $'.$total.'</h4></center>';
						$html.= "<table style='margin-top:5px; width: 100%;' border=1 cellspacing=0 cellpadding=2>";
						$html.= "<thead>";
						$html.= "<tr style='background-color: #D5D8DC;'>";
							
						$html.='<th style="text-align: left;  font-size: 12px;">Fecha</th>';
						$html.='<th style="text-align: left;  font-size: 12px;">Descripción</th>';
						$html.='<th style="text-align: left;  font-size: 12px;">Mes/A&ntilde;o</th>';
						$html.='<th style="text-align: left;  font-size: 12px;">Valor Personal</th>';
						$html.='<th style="text-align: left;  font-size: 12px;">Valor Patronal</th>';
						$html.='<th style="text-align: left;  font-size: 12px;">Saldo Personal</th>';
						$html.='<th style="text-align: left;  font-size: 12px;">Saldo Patronal</th>';
							
						$html.='</tr>';
						$html.='</thead>';
						$html.='<tbody>';
	
						$i=0;
						foreach ($resultSet as $res)
						{
							$i++;
							$html.='<tr>';
							$html.='<td style="font-size: 11px;">'.$res->fecha_conta.'</td>';
							$html.='<td style="font-size: 11px;">'.$res->descripcion.'</td>';
							$html.='<td style="font-size: 11px;">'.$res->mes_anio.'</td>';
							$html.='<td style="font-size: 11px;">'.number_format($res->valorper, 2, '.', ',').'</td>';
							$html.='<td style="font-size: 11px;">'.number_format($res->valorpat, 2, '.', ',').'</td>';
							$html.='<td style="font-size: 11px;">'.number_format($res->saldoper, 2, '.', ',').'</td>';
							$html.='<td style="font-size: 11px;">'.number_format($res->saldopat, 2, '.', ',').'</td>';
							$html.='</tr>';
						}
	
						$html.='</tbody>';
						$html.='</table>';
	
	
							
					}
	
						
					$this->report("Creditos",array( "resultSet"=>$html));
					die();
						
	
	
	
				}elseif ($credito=="refinanciamiento"){
						
						
						
					$columnas_refi_cabec ="*";
					$tablas_refi_cabec="refinanciamiento_solicitud";
					$where_refi_cabec="cedula='$cedula_usuarios'";
					$id_refi_cabec="cedula";
					$resultCredRefi_Cabec=$refinanciamiento_solicitud->getCondicionesDesc($columnas_refi_cabec, $tablas_refi_cabec, $where_refi_cabec, $id_refi_cabec);
						
						
						
	
						
					if(!empty($resultCredRefi_Cabec)){
							
						$_numsol_app=$resultCredRefi_Cabec[0]->numsol;
						$_cuota_app=$resultCredRefi_Cabec[0]->cuota;
						$_interes_app=$resultCredRefi_Cabec[0]->interes;
						$_tipo_app=$resultCredRefi_Cabec[0]->tipo;
						$_plazo_app=$resultCredRefi_Cabec[0]->plazo;
						$_fcred_app=$resultCredRefi_Cabec[0]->fcred;
						$_ffin_app=$resultCredRefi_Cabec[0]->ffin;
						$_cuenta_app=$resultCredRefi_Cabec[0]->cuenta;
						$_banco_app=$resultCredRefi_Cabec[0]->banco;
						$_valor_app= number_format($resultCredRefi_Cabec[0]->valor, 2, '.', ',');
						$_cedula_app=$resultCredRefi_Cabec[0]->cedula;
						$_nombres_app=$resultCredRefi_Cabec[0]->nombres;
							
						if($_numsol_app != ""){
								
								
							$columnas_app_detall ="numsol,
										pago,
										mes,
										ano,
										fecpag,ROUND(capital,2) as capital,
										ROUND(interes,2) as interes,
										ROUND(intmor,2) as intmor,
										ROUND(seguros,2) as seguros,
										ROUND(total,2) as total,
										ROUND(saldo,2) as saldo,
										estado";
								
							$tablas_app_detall="refinanciamiento_detalle";
							$where_app_detall="numsol='$_numsol_app'";
							$id_app_detall="pago";
							$resultSet=$refinanciamiento_detalle->getCondiciones($columnas_app_detall, $tablas_app_detall, $where_app_detall, $id_app_detall);
	
							$html.='<p style="text-align: right;">'.$logo.'<hr style="height: 2px; background-color: black;"></p>';
							$html.='<p style="text-align: right; font-size: 13px;"><b>Impreso:</b> '.$fechaactual.'</p>';
							$html.='<p style="text-align: center; font-size: 16px;"><b>DETALLE CRÉDITO DE REFINANCIAMIENTO</b></p>';
								
							$html.= '<p style="margin-top:15px; text-align: justify; font-size: 13px;"><b>NOMBRES:</b> '.$_nombres_app.'  <b style="margin-left: 20%; font-size: 13px;">IDENTIFICACIÓN:</b> '.$_cedula_app.'</p>';
								
							$html.= "<table style='width: 100%;' border=1 cellspacing=0 >";
							$html.= '<tr style="background-color: #D5D8DC;">';
							$html.='<th style="text-align: left;  font-size: 13px;">No de Solicitud:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Monto Concedido:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Cuota:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Interes:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Tipo:</th>';
							$html.='</tr>';
								
							$html.= "<tr>";
							$html.='<td style="font-size: 13px;">'.$_numsol_app.'</td>';
							$html.='<td style="font-size: 13px;">'.$_valor_app.'</td>';
							$html.='<td style="font-size: 13px;">'.$_cuota_app.'</td>';
							$html.='<td style="font-size: 13px;">'.$_interes_app.'</td>';
							$html.='<td style="font-size: 13px;">'.$_tipo_app.'</td>';
							$html.='</tr>';
								
								
							$html.= '<tr style="background-color: #D5D8DC;">';
							$html.='<th style="text-align: left;  font-size: 13px;">PLazo:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Concedido en:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Termina en:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Cuenta No:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Banco:</th>';
							$html.='</tr>';
	
							$html.= "<tr>";
							$html.='<td style="font-size: 13px;">'.$_plazo_app.'</td>';
							$html.='<td style="font-size: 13px;">'.$_fcred_app.'</td>';
							$html.='<td style="font-size: 13px;">'.$_ffin_app.'</td>';
							$html.='<td style="font-size: 13px;">'.$_cuenta_app.'</td>';
							$html.='<td style="font-size: 13px;">'.$_banco_app.'</td>';
							$html.='</tr>';
	
							$html.='</table>';
								
								
								
								
							$html.= "<table style='margin-top:20px; width: 100%;' border=1 cellspacing=0 cellpadding=2>";
							$html.= "<thead>";
							$html.= "<tr style='background-color: #D5D8DC;'>";
	
							$html.='<th style="text-align: left;  font-size: 12px;">Pago</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Mes</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">A&ntilde;o</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Fecha Pago</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Capital</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Interes</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Interes por Mora</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Seguro Desgr.</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Total</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Saldo</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Estado</th>';
							$html.='</tr>';
							$html.='</thead>';
							$html.='<tbody>';
								
							$i=0;
							foreach ($resultSet as $res)
							{
								$i++;
								$html.='<tr>';
								$html.='<td style="font-size: 12px;">'.$res->pago.'</td>';
								$html.='<td style="font-size: 12px;">'.$res->mes.'</td>';
								$html.='<td style="font-size: 12px;">'.$res->ano.'</td>';
								$html.='<td style="font-size: 12px;">'.$res->fecpag.'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->capital, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->interes, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->intmor, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->seguros, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->total, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->saldo, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.$res->estado.'</td>';
								$html.='</tr>';
							}
								
							$html.='</tbody>';
							$html.='</table>';
								
						}
							
					}
						
	
					$this->report("Creditos",array( "resultSet"=>$html));
					die();
						
						
						
	
						
						
						
						
						
				}
	
	
	
			}else{
	
				$this->redirect("Usuarios","sesion_caducada");
	
			}
				
	
		}else{
	
			$this->redirect("Usuarios","sesion_caducada");
	
		}
	
	}
	
	
	//////////////////////////////////////////////BUSQUEDA DE USUARIOS///////////////////////////////////////
	/*ACTIVOS*/
	public function consulta_usuarios_activos(){
	    
	    session_start();
	    $id_rol=$_SESSION["id_rol"];
	    
	    $usuarios = new UsuariosModel();
	    $catalogo = null; $catalogo = new CatalogoModel();
	    $where_to="";
	    $columnas = " usuarios.id_usuarios,
					  usuarios.cedula_usuarios,
					  usuarios.nombre_usuarios,
                      usuarios.apellidos_usuarios,
					  claves.clave_claves,
					  claves.clave_n_claves,
					  usuarios.telefono_usuarios,
					  usuarios.celular_usuarios,
					  usuarios.correo_usuarios,
					  rol.id_rol,
					  rol.nombre_rol,
					  usuarios.estado_usuarios,
					  usuarios.fotografia_usuarios,
					  usuarios.creado";
	    
	    $tablas = "public.usuarios INNER JOIN public.claves ON claves.id_usuarios = usuarios.id_usuarios
                    INNER JOIN public.privilegios ON privilegios.id_usuarios=usuarios.id_usuarios
                    INNER JOIN public.rol ON rol.id_rol=privilegios.id_rol
                    INNER JOIN public.catalogo ON privilegios.tipo_rol_privilegios = catalogo.valor_catalogo
                    AND catalogo.nombre_catalogo='PRINCIPAL' AND catalogo.tabla_catalogo ='privilegios' AND catalogo.columna_catalogo = 'tipo_rol_privilegios'
                    INNER JOIN public.catalogo c1 ON c1.tabla_catalogo='usuarios' AND c1.columna_catalogo='estado_usuarios' 
                    AND c1.nombre_catalogo='ACTIVO' AND c1.valor_catalogo=usuarios.estado_usuarios";
	    
	    
	    $where    = " 1=1";
	    
	    $id       = "usuarios.id_usuarios";
	    
	    
	    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	    $search =  (isset($_REQUEST['search'])&& $_REQUEST['search'] !=NULL)?$_REQUEST['search']:'';
	    
	    
	    if($action == 'ajax')
	    {
	        //estado_usuario
	        $wherecatalogo = "tabla_catalogo='usuarios' AND columna_catalogo='estado_usuarios'";
	        $resultCatalogo = $catalogo->getCondiciones('valor_catalogo,nombre_catalogo' ,'public.catalogo' , $wherecatalogo , 'tabla_catalogo');
	        
	        
	        
	        if(!empty($search)){
	            
	            
	            $where1=" AND (usuarios.cedula_usuarios LIKE '".$search."%' OR usuarios.nombre_usuarios LIKE '".$search."%' OR usuarios.correo_usuarios LIKE '".$search."%' OR rol.nombre_rol LIKE '".$search."%' )";
	            
	            $where_to=$where.$where1;
	        }else{
	            
	            $where_to=$where;
	            
	        }
	        
	        $html="";
	        $resultSet=$usuarios->getCantidad("*", $tablas, $where_to);
	        $cantidadResult=(int)$resultSet[0]->total;
	        
	        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	        
	        $per_page = 10; //la cantidad de registros que desea mostrar
	        $adjacents  = 9; //brecha entre páginas después de varios adyacentes
	        $offset = ($page - 1) * $per_page;
	        
	        $limit = " LIMIT   '$per_page' OFFSET '$offset'";
	        
	        $resultSet=$usuarios->getCondicionesPag($columnas, $tablas, $where_to, $id, $limit);
	        $count_query   = $cantidadResult;
	        $total_pages = ceil($cantidadResult/$per_page);
	        
	        
	        
	        
	        
	        if($cantidadResult>0)
	        {
	            
	            $html.='<div class="pull-left" style="margin-left:15px;">';
	            $html.='<span class="form-control"><strong>Registros: </strong>'.$cantidadResult.'</span>';
	            $html.='<input type="hidden" value="'.$cantidadResult.'" id="total_query" name="total_query"/>' ;
	            $html.='</div>';
	            $html.='<div class="col-lg-12 col-md-12 col-xs-12">';
	            $html.='<section style="height:425px; overflow-y:scroll;">';
	            $html.= "<table id='tabla_usuarios' class='tablesorter table table-striped table-bordered dt-responsive nowrap dataTables-example'>";
	            $html.= "<thead>";
	            $html.= "<tr>";
	            $html.='<th style="text-align: left;  font-size: 12px;"></th>';
	            $html.='<th style="text-align: left;  font-size: 12px;"></th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Cedula</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Nombre</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Teléfono</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Celular</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Correo</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Rol</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Estado</th>';
	            
	            if($id_rol==1){
	                
	                $html.='<th style="text-align: left;  font-size: 12px;"></th>';
	                $html.='<th style="text-align: left;  font-size: 12px;"></th>';
	                
	            }
	            
	            $html.='</tr>';
	            $html.='</thead>';
	            $html.='<tbody>';
	            
	            
	            $i=0;
	            
	            foreach ($resultSet as $res)
	            {
	                $i++;
	                $html.='<tr>';
	                $html.='<td style="font-size: 11px;"><img src="view/DevuelveImagenView.php?id_valor='.$res->id_usuarios.'&id_nombre=id_usuarios&tabla=usuarios&campo=fotografia_usuarios" width="80" height="60"></td>';
	                $html.='<td style="font-size: 11px;">'.$i.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->cedula_usuarios.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->nombre_usuarios.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->telefono_usuarios.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->celular_usuarios.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->correo_usuarios.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->nombre_rol.'</td>';
	                
	                if(!empty($resultCatalogo)){
	                    foreach ($resultCatalogo as $r_estado){
	                        if($r_estado->valor_catalogo == $res->estado_usuarios ){
	                            $html.='<td style="font-size: 11px;">'.$r_estado->nombre_catalogo.'</td>';
	                        }
	                    }
	                }
	                
	                
	                if($id_rol==1){
	                    
	                    $html.='<td style="font-size: 18px;"><span class="pull-right"><a href="index.php?controller=Usuarios&action=index&id_usuarios='.$res->id_usuarios.'" class="btn btn-success" style="font-size:65%;"><i class="glyphicon glyphicon-edit"></i></a></span></td>';
	                    $html.='<td style="font-size: 18px;"><span class="pull-right"><a href="index.php?controller=Usuarios&action=borrarId&id_usuarios='.$res->id_usuarios.'" class="btn btn-danger" style="font-size:65%;"><i class="glyphicon glyphicon-trash"></i></a></span></td>';
	                    
	                }
	                
	                $html.='</tr>';
	            }
	            
	            
	            
	            $html.='</tbody>';
	            $html.='</table>';
	            $html.='</section></div>';
	            $html.='<div class="table-pagination pull-right">';
	            $html.=''. $this->paginate_usuarios("index.php", $page, $total_pages, $adjacents,"load_usuarios").'';
	            $html.='</div>';
	            
	            
	            
	        }else{
	            $html.='<div class="col-lg-6 col-md-6 col-xs-12">';
	            $html.='<div class="alert alert-warning alert-dismissable" style="margin-top:40px;">';
	            $html.='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
	            $html.='<h4>Aviso!!!</h4> <b>Actualmente no hay usuarios registrados...</b>';
	            $html.='</div>';
	            $html.='</div>';
	        }
	        
	        
	        echo $html;
	        die();
	        
	    }
	    
	}
	
	public function consulta_usuarios_inactivos(){
	    
	    session_start();
	    $id_rol=$_SESSION["id_rol"];
	    
	    $usuarios = new UsuariosModel();
	    $catalogo = null; $catalogo = new CatalogoModel();
	    $where_to="";
	    $columnas = " usuarios.id_usuarios,
					  usuarios.cedula_usuarios,
					  usuarios.nombre_usuarios,
                      usuarios.apellidos_usuarios,
					  claves.clave_claves,
					  claves.clave_n_claves,
					  usuarios.telefono_usuarios,
					  usuarios.celular_usuarios,
					  usuarios.correo_usuarios,
					  rol.id_rol,
					  rol.nombre_rol,
					  usuarios.estado_usuarios,
					  usuarios.fotografia_usuarios,
					  usuarios.creado";
	    
	    $tablas = "public.usuarios INNER JOIN public.claves ON claves.id_usuarios = usuarios.id_usuarios
                    INNER JOIN public.privilegios ON privilegios.id_usuarios=usuarios.id_usuarios
                    INNER JOIN public.rol ON rol.id_rol=privilegios.id_rol
                    INNER JOIN public.catalogo ON privilegios.tipo_rol_privilegios = catalogo.valor_catalogo
                    AND catalogo.nombre_catalogo='PRINCIPAL' AND catalogo.tabla_catalogo ='privilegios' AND catalogo.columna_catalogo = 'tipo_rol_privilegios'
                    INNER JOIN public.catalogo c1 ON c1.tabla_catalogo='usuarios' AND c1.columna_catalogo='estado_usuarios'
                    AND c1.nombre_catalogo='INACTIVO' AND c1.valor_catalogo=usuarios.estado_usuarios";
	    
	    
	    $where    = " 1=1";
	    
	    $id       = "usuarios.id_usuarios";
	    
	    
	    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	    $search =  (isset($_REQUEST['search'])&& $_REQUEST['search'] !=NULL)?$_REQUEST['search']:'';
	    
	    
	    if($action == 'ajax')
	    {
	        //estado_usuario
	        $wherecatalogo = "tabla_catalogo='usuarios' AND columna_catalogo='estado_usuarios'";
	        $resultCatalogo = $catalogo->getCondiciones('valor_catalogo,nombre_catalogo' ,'public.catalogo' , $wherecatalogo , 'tabla_catalogo');
	        
	        
	        
	        if(!empty($search)){
	            
	            
	            $where1=" AND (usuarios.cedula_usuarios LIKE '".$search."%' OR usuarios.nombre_usuarios LIKE '".$search."%' OR usuarios.correo_usuarios LIKE '".$search."%' OR rol.nombre_rol LIKE '".$search."%' )";
	            
	            $where_to=$where.$where1;
	        }else{
	            
	            $where_to=$where;
	            
	        }
	        
	        $html="";
	        $resultSet=$usuarios->getCantidad("*", $tablas, $where_to);
	        $cantidadResult=(int)$resultSet[0]->total;
	        
	        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	        
	        $per_page = 10; //la cantidad de registros que desea mostrar
	        $adjacents  = 9; //brecha entre páginas después de varios adyacentes
	        $offset = ($page - 1) * $per_page;
	        
	        $limit = " LIMIT   '$per_page' OFFSET '$offset'";
	        
	        $resultSet=$usuarios->getCondicionesPag($columnas, $tablas, $where_to, $id, $limit);
	        $count_query   = $cantidadResult;
	        $total_pages = ceil($cantidadResult/$per_page);
	        
	        
	        
	        
	        
	        if($cantidadResult>0)
	        {
	            
	            $html.='<div class="pull-left" style="margin-left:15px;">';
	            $html.='<span class="form-control"><strong>Registros: </strong>'.$cantidadResult.'</span>';
	            $html.='<input type="hidden" value="'.$cantidadResult.'" id="total_query" name="total_query"/>' ;
	            $html.='</div>';
	            $html.='<div class="col-lg-12 col-md-12 col-xs-12">';
	            $html.='<section style="height:425px; overflow-y:scroll;">';
	            $html.= "<table id='tabla_usuarios_inactivos' class='tablesorter table table-striped table-bordered dt-responsive nowrap dataTables-example'>";
	            $html.= "<thead>";
	            $html.= "<tr>";
	            $html.='<th style="text-align: left;  font-size: 12px;"></th>';
	            $html.='<th style="text-align: left;  font-size: 12px;"></th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Cedula</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Nombre</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Teléfono</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Celular</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Correo</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Rol</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Estado</th>';
	            
	            if($id_rol==1){
	                
	                $html.='<th style="text-align: left;  font-size: 12px;"></th>';
	                $html.='<th style="text-align: left;  font-size: 12px;"></th>';
	                
	            }
	            
	            $html.='</tr>';
	            $html.='</thead>';
	            $html.='<tbody>';
	            
	            
	            $i=0;
	            
	            foreach ($resultSet as $res)
	            {
	                $i++;
	                $html.='<tr>';
	                $html.='<td style="font-size: 11px;"><img src="view/DevuelveImagenView.php?id_valor='.$res->id_usuarios.'&id_nombre=id_usuarios&tabla=usuarios&campo=fotografia_usuarios" width="80" height="60"></td>';
	                $html.='<td style="font-size: 11px;">'.$i.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->cedula_usuarios.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->nombre_usuarios.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->telefono_usuarios.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->celular_usuarios.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->correo_usuarios.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->nombre_rol.'</td>';
	                
	                if(!empty($resultCatalogo)){
	                    foreach ($resultCatalogo as $r_estado){
	                        if($r_estado->valor_catalogo == $res->estado_usuarios ){
	                            $html.='<td style="font-size: 11px;">'.$r_estado->nombre_catalogo.'</td>';
	                        }
	                    }
	                }
	                
	                
	                if($id_rol==1){
	                    
	                    $html.='<td style="font-size: 18px;"><span class="pull-right"><a href="index.php?controller=Usuarios&action=index&id_usuarios='.$res->id_usuarios.'" class="btn btn-success" style="font-size:65%;"><i class="glyphicon glyphicon-edit"></i></a></span></td>';
	                    	                    
	                }
	                
	                $html.='</tr>';
	            }
	            
	            
	            
	            $html.='</tbody>';
	            $html.='</table>';
	            $html.='</section></div>';
	            $html.='<div class="table-pagination pull-right">';
	            $html.=''. $this->paginate_usuarios("index.php", $page, $total_pages, $adjacents,"load_usuarios_inactivos").'';
	            $html.='</div>';
	            
	            
	            
	        }else{
	            $html.='<div class="col-lg-6 col-md-6 col-xs-12">';
	            $html.='<div class="alert alert-warning alert-dismissable" style="margin-top:40px;">';
	            $html.='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
	            $html.='<h4>Aviso!!!</h4> <b>Actualmente no hay usuarios registrados...</b>';
	            $html.='</div>';
	            $html.='</div>';
	        }
	        
	        
	        echo $html;
	        die();
	        
	    }
	    
	}
	
	public function paginate_usuarios($reload, $page, $tpages, $adjacents,$funcion='') {
	    
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
	
	//////////////////////////////////////////////CAMBIO DE CLAVE////////////////////////////////////////////
	
	public function ajax_caducaclave(){
	    
	    
	    if(isset($_POST['clave_usuarios']) && isset($_POST['id_usuarios']) ){
	       
	        if($_POST['id_usuarios']!=""){
	            
	            $claves = null; $claves = new ClavesModel();
	            
	            $id_usuario = $_POST['id_usuarios'];
	            $clave_nueva = $_POST['clave_usuarios'];
	            
	            $rsClaves = $claves->getBy("id_usuarios='$id_usuario' AND clave_n_claves='$clave_nueva'");
	            
	            if(!empty($rsClaves))
	            {
	                echo "clave ya fue utilizada con este usuario !Favor cambiar!";
	            }
	            
	        }
	        
	    }
	}
	
	
    public function ajax_validacedula(){
        
        $usuarios = null; $usuarios= new UsuariosModel();
        
        if(isset($_POST['cedula']) && $_POST['cedula']!=""){
            
            $cedula_usuarios = $_POST['cedula'];
            
            $rsUsuarios = $usuarios->getBy(" cedula_usuarios = '$cedula_usuarios'");
            
            if(!empty($rsUsuarios)){
                echo "Cedula!  ya se encuentra registrada...";
            }
        }
	    
	}
	
	public function AutocompleteCedula(){
	    
	    $usuarios = new UsuariosModel();
	    $cedula_usuarios = $_GET['term'];
	    
	    $resultSet=$usuarios->getBy("cedula_usuarios LIKE '$cedula_usuarios%'");
	    
	    if(!empty($resultSet)){
	        
	        foreach ($resultSet as $res){
	            
	            $_respuesta[] = $res->cedula_usuarios;
	        }
	        echo json_encode($_respuesta);
	    }
	    
	}
	
	public function AutocompleteDevuelveNombres(){
	    
	    $usuarios = new UsuariosModel();
	    $catalogo = new CatalogoModel();
	    
	    $cedula_usuarios = $_POST['cedula_usuarios'];
	    
	    $columna = " usuarios.id_usuarios,
    	    usuarios.cedula_usuarios,
    	    usuarios.nombre_usuarios,
    	    usuarios.apellidos_usuarios,
            usuarios.usuario_usuarios,
            usuarios.fecha_nacimiento_usuarios,
    	    claves.clave_claves,
    	    claves.clave_n_claves,
            claves.caduca_claves,
    	    usuarios.telefono_usuarios,
    	    usuarios.celular_usuarios,
    	    usuarios.correo_usuarios,
    	    rol.id_rol,
    	    rol.nombre_rol,
    	    usuarios.estado_usuarios,
    	    usuarios.fotografia_usuarios,
    	    usuarios.creado";
	    
	    $tablas = " public.usuarios INNER JOIN public.claves ON claves.id_usuarios = usuarios.id_usuarios
        	    INNER JOIN public.privilegios ON privilegios.id_usuarios=usuarios.id_usuarios
        	    INNER JOIN public.rol ON rol.id_rol=privilegios.id_rol
        	    INNER JOIN public.catalogo ON privilegios.tipo_rol_privilegios = catalogo.valor_catalogo
        	    AND catalogo.nombre_catalogo='PRINCIPAL' AND catalogo.tabla_catalogo ='privilegios' 
                AND catalogo.columna_catalogo = 'tipo_rol_privilegios'";
	    
	    $where = "1=1 AND usuarios.cedula_usuarios = '$cedula_usuarios'";
	    
	    $resultSet=$usuarios->getCondiciones($columna,$tablas,$where,"usuarios.cedula_usuarios");
	    
	    $columna_privilegios = "
    	    usuarios.id_usuarios,
    	    usuarios.cedula_usuarios,
    	    rol.id_rol,
    	    rol.nombre_rol,
    	    catalogo.valor_catalogo";
	    
	    $tabla_privilegios = " public.usuarios INNER JOIN public.privilegios ON usuarios.id_usuarios = privilegios.id_usuarios
            	    INNER JOIN public.rol ON rol.id_rol = privilegios.id_rol
            	    INNER JOIN public.catalogo ON catalogo.valor_catalogo = privilegios.tipo_rol_privilegios
            	    AND catalogo.tabla_catalogo = 'privilegios' AND catalogo.columna_catalogo = 'tipo_rol_privilegios'
                    INNER JOIN public.catalogo c1 ON c1.valor_catalogo = privilegios.estado_rol_privilegios AND c1.nombre_catalogo = 'ACTIVO' 
                    AND c1.tabla_catalogo = 'privilegios' AND c1.columna_catalogo = 'estado_rol_privilegios'";
	    
	    $where_privilegios = "1=1 AND usuarios.cedula_usuarios = '$cedula_usuarios'";
	    
	    $resultprivilegios=$usuarios->getCondiciones($columna_privilegios,$tabla_privilegios,$where_privilegios,"privilegios.id_privilegios");
	    
	    
	    $respuesta = new stdClass();
	    
	    if(!empty($resultSet)){
	        
	        $respuesta->id_usuarios = $resultSet[0]->id_usuarios;
	        $respuesta->cedula_usuarios = $resultSet[0]->cedula_usuarios;
	        $respuesta->nombre_usuarios = $resultSet[0]->nombre_usuarios;
	        $respuesta->apellidos_usuarios = $resultSet[0]->apellidos_usuarios;
	        $respuesta->usuario_usuarios = $resultSet[0]->usuario_usuarios;
	        $respuesta->fecha_nacimiento_usuarios = $resultSet[0]->fecha_nacimiento_usuarios;	        
	        $respuesta->clave_claves = $resultSet[0]->clave_claves;
	        $respuesta->clave_n_claves = $resultSet[0]->clave_n_claves;
	        $respuesta->telefono_usuarios = $resultSet[0]->telefono_usuarios;
	        $respuesta->celular_usuarios = $resultSet[0]->celular_usuarios;
	        $respuesta->correo_usuarios = $resultSet[0]->correo_usuarios;
	        $respuesta->caduca_claves = $resultSet[0]->caduca_claves;
	        $respuesta->id_rol = $resultSet[0]->id_rol;
	        $respuesta->nombre_rol = $resultSet[0]->nombre_rol;
	        $respuesta->estado_usuarios = $resultSet[0]->estado_usuarios;
	        $respuesta->fotografia_usuarios = $resultSet[0]->fotografia_usuarios;
	        
	        
	    }
	    
	    if(!empty($resultprivilegios)){
	        if(is_array($resultprivilegios)){
	            if(count($resultprivilegios)>0)
	            {
	                $respuesta->privilegios=$resultprivilegios;
	            }else{
	                $respuesta->privilegios= new stdClass();
	            }
	        }else{$respuesta->privilegios= new stdClass();}
	       
	    }else{$respuesta->privilegios= new stdClass();}
	    
	    echo json_encode($respuesta);
	}
	
}

?>
