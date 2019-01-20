<?php

class SolicitudCabezaController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		//Creamos el objeto usuario
	    $solicitud_cabeza=new SolicitudCabezaModel();
	    $productos=new ProductosModel();
	    $usuarios = null; $usuarios= new UsuariosModel();
	    
	    $resultSet=null;
		$resultEdit = "";

		session_start();

	
		if (isset(  $_SESSION['nombre_usuarios']) )
		{

		$nombre_controladores = "SolicitudCabeza";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $solicitud_cabeza->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{ 
				if (isset ($_GET["id_solicitud_cabeza"])   )
				{

					$nombre_controladores = "SolicitudCabeza";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $solicitud_cabeza->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
					if (!empty($resultPer))
					{
					
					    $_id_productos = $_GET["id_productos"];
						$columnas = " id_grupos,
                                     codigo_productos,
                                     marca_productos,
                                     nombre_productos,
                                     descripcion_productos,
                                    unidad_medida_productos,
                                     ult_precio_productos ";
						$tablas   = "productos";
						$where    = "id_productos = '$_id_productos' "; 
						$id       = "codigo_productos";
							
						$resultEdit = $productos->getCondiciones($columnas ,$tablas ,$where, $id);

					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar Solicitud Cabeza"
					
						));
					
					
					}
					
				}else{
				    $_id_usuarios = $_SESSION['id_usuarios'];
				    $resultSet = $usuarios->getBy("id_usuarios = $_id_usuarios");
				}
				
		
				
				$this->view("SolicitudCabeza",array(
				    "resultSet"=>$resultSet, "resultEdit" =>$resultEdit, "resultProdu" =>$resultProdu,
			
				));
		
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Solicitud Cabeza"
				
				));
				
				exit();	
			}
				
		}
	else{
       	
       	$this->redirect("Usuarios","sesion_caducada");
       	
       }
	
	}
	
	
	
	public function borrarId()
	{

		session_start();
		$grupos=new GruposModel();
		$nombre_controladores = "Grupos";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $grupos->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer))
		{
			if(isset($_GET["id_grupos"]))
			{
			    $id_grupos=(int)$_GET["id_grupos"];
		
				
				
			    $grupos->deleteBy(" id_grupos",$id_grupos);
				
				
			}
			
			$this->redirect("Grupos", "index");
			
			
		}
		else
		{
			$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Grupos"
			
			));
		}
				
	}
	
	
	public function Reporte(){
	
		//Creamos el objeto usuario
	    $grupos=new GruposModel();
		//Conseguimos todos los usuarios
		
	
	
		session_start();
	
	
		if (isset(  $_SESSION['usuario']) )
		{
		    $resultRep = $grupos->getByPDF("id_grupos, nombre_grupos", " nombre_grupos != '' ");
			$this->report("Grupos",array(	"resultRep"=>$resultRep));
	
		}
					
	
	}
	
	
	
	///////////////////////////////////////////// METODOS AJAX ///////////////////////////////////////
	
	public function ajax_trae_productos(){
	    
	    session_start();
	    
	    $productos = null; $productos = new ProductosModel();
	    
	    /*variables que vienes de peticion ajax*/
	    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	    $search =  (isset($_REQUEST['buscador'])&& $_REQUEST['buscador'] !=NULL)?$_REQUEST['buscador']:'';
	    $page =  (isset($_REQUEST['page'])&& $_REQUEST['page'] !=NULL)?$_REQUEST['page']:1;
    
        
        
        if($action == 'ajax')
        {
            /* consulta a la BD */
            
            $col_productos="productos.id_productos,
                        grupos.id_grupos,
                        grupos.nombre_grupos,
                        productos.codigo_productos,
                        productos.nombre_productos,
                        productos.marca_productos,
                        unidad_medida.nombre_unidad_medida,
                        productos.ult_precio_productos";
            
            $tab_productos = "public.productos INNER JOIN public.grupos ON grupos.id_grupos = productos.id_grupos
                        INNER JOIN public.unidad_medida ON unidad_medida.id_unidad_medida = productos.id_unidad_medida";
            
            $where_productos = "1=1";
            
            
            if(!empty($search)){
                
                $where_busqueda=" AND (productos.nombre_productos LIKE '".$search."%' OR productos.codigo_productos LIKE '".$search."%' OR productos.marca_productos LIKE '".$search."%' )";
                
                $where_productos.=$where_busqueda;
            }
            
            $resultSet=$productos->getCantidad("*", $tab_productos, $where_productos);
            $cantidadResult=(int)$resultSet[0]->total;
            
            $per_page = 10; //la cantidad de registros que desea mostrar
            $adjacents  = 9; //brecha entre páginas después de varios adyacentes
            $offset = ($page - 1) * $per_page;
            
            $limit = " LIMIT   '$per_page' OFFSET '$offset'";
            
            $resultSet=$productos->getCondicionesPag($col_productos, $tab_productos, $where_productos, "productos.nombre_productos", $limit);
            $count_query   = $cantidadResult;
            $total_pages = ceil($cantidadResult/$per_page);
            
            $html="";
            if($cantidadResult>0)
            {
                
                $html.='<div class="pull-left" style="margin-left:11px;">';
                $html.='<span class="form-control"><strong>Registros: </strong>'.$cantidadResult.'</span>';
                $html.='<input type="hidden" value="'.$cantidadResult.'" id="total_query" name="total_query"/>' ;
                $html.='</div>';
                $html.='<div class="col-lg-12 col-md-12 col-xs-12">';
                $html.='<section style="height:425px; overflow-y:scroll;">';
                $html.= "<table id='tabla_productos' class='tablesorter table table-striped table-bordered dt-responsive nowrap'>";
                $html.= "<thead>";
                $html.= "<tr>";
                $html.='<th style="text-align: left;  font-size: 12px;"></th>';
                $html.='<th style="text-align: left;  font-size: 12px;">Grupo</th>';
                $html.='<th style="text-align: left;  font-size: 12px;">Codigo</th>';
                $html.='<th style="text-align: left;  font-size: 12px;">Nombre</th>';
                $html.='<th style="text-align: left;  font-size: 12px;">Cantidad</th>';
                $html.='<th style="text-align: left;  font-size: 12px;"></th>';
                $html.='<th style="text-align: left;  font-size: 12px;"></th>';
                    //$html.='<th style="text-align: left;  font-size: 12px;"></th>';
                                    
                $html.='</tr>';
                $html.='</thead>';
                $html.='<tbody>';
                
                $i=0;
                
                foreach ($resultSet as $res)
                {
                    $i++;
                    $html.='<tr>';
                    $html.='<td style="font-size: 11px;">'.$i.'</td>';
                    $html.='<td style="font-size: 11px;">'.$res->nombre_grupos.'</td>';
                    $html.='<td style="font-size: 11px;">'.$res->codigo_productos.'</td>';
                    $html.='<td style="font-size: 11px;">'.$res->nombre_productos.'</td>';
                    $html.='<td class="col-xs-1"><div class="pull-right">';
                    $html.='<input type="text" class="form-control input-sm"  id="cantidad_'.$res->id_productos.'" value="1"></div></td>';
                    $html.='<td style="font-size: 18px;"><span class="pull-right"><a href="#" onclick="agregar_producto('.$res->id_productos.')" class="btn btn-info" style="font-size:65%;"><i class="glyphicon glyphicon-plus"></i></a></span></td>';
                   
                    $html.='</tr>';
                }
                
                
                $html.='</tbody>';
                $html.='</table>';
                $html.='</section></div>';
                $html.='<div class="table-pagination pull-right">';
                $html.=''. $this->paginate("index.php", $page, $total_pages, $adjacents).'';
                $html.='</div>';
                
                
                
            }else{
                $html.='<div class="col-lg-6 col-md-6 col-xs-12">';
                $html.='<div class="alert alert-warning alert-dismissable" style="margin-top:40px;">';
                $html.='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                $html.='<h4>Aviso!!!</h4> <b>Sin Resultados Productos</b>';
                $html.='</div>';
                $html.='</div>';
            }
            
            
            echo $html;
           
        }
	        
	    
	}
	
	public function trae_temporal($id_usuario = null){
	    
	   
	    $page =  (isset($_REQUEST['page'])&& $_REQUEST['page'] !=NULL)?$_REQUEST['page']:1;
	    
	    $id_usuario =  isset($_SESSION['id_usuarios'])?$_SESSION['id_usuarios']:null;
	    
	    if($id_usuario==null){ session_start(); $id_usuario=$_SESSION['id_usuarios'];}
	    
	    
	    
	    if($id_usuario != null)
	    {
	        /* consulta a la BD */
	        
	        $temp_solicitud = null; $temp_solicitud = new TempSolicitudModel();
	        
	        $col_temp=" productos.id_productos,
                    grupos.nombre_grupos,
                    productos.codigo_productos,
                    productos.nombre_productos,
                    temp_solicitud.id_temp_solicitud,
                    temp_solicitud.cantidad_temp_solicitud";
	        
	        $tab_temp = "public.temp_solicitud INNER JOIN public.productos ON productos.id_productos = temp_solicitud.id_producto_temp_solicitud
                    INNER JOIN  public.grupos ON grupos.id_grupos = productos.id_grupos";
	        
	        $where_temp = "1 = 1";
	        
	        
	        $resultSet=$temp_solicitud->getCantidad("*", $tab_temp, $where_temp);
	        $cantidadResult=(int)$resultSet[0]->total;
	        
	        $per_page = 10; //la cantidad de registros que desea mostrar
	        $adjacents  = 9; //brecha entre páginas después de varios adyacentes
	        $offset = ($page - 1) * $per_page;
	        
	        $limit = " LIMIT   '$per_page' OFFSET '$offset'";
	        
	        $resultSet=$temp_solicitud->getCondicionesPag($col_temp, $tab_temp, $where_temp, "temp_solicitud.creado", $limit);
	        $count_query   = $cantidadResult;
	        $total_pages = ceil($cantidadResult/$per_page);
	        
	        $html="";
	        if($cantidadResult>0)
	        {
	            
	            $html.='<div class="pull-left" style="margin-left:11px;">';
	            $html.='<span class="form-control"><strong>Registros: </strong>'.$cantidadResult.'</span>';
	            $html.='<input type="hidden" value="'.$cantidadResult.'" id="total_query" name="total_query"/>' ;
	            $html.='</div>';
	            $html.='<div class="col-lg-12 col-md-12 col-xs-12">';
	            $html.='<section style="height:425px; overflow-y:scroll;">';
	            $html.= "<table id='tabla_temporal' class='tablesorter table table-striped table-bordered dt-responsive nowrap'>";
	            $html.= "<thead>";
	            $html.= "<tr>";
	            $html.='<th style="text-align: left;  font-size: 12px;"></th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Grupo</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Codigo</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Nombre</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Cantidad</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;"></th>';
	            
	            $html.='</tr>';
	            $html.='</thead>';
	            $html.='<tbody>';
	            
	            $i=0;
	            
	            foreach ($resultSet as $res)
	            {
	                $i++;
	                $html.='<tr>';
	                $html.='<td style="font-size: 11px;">'.$i.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->nombre_grupos.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->codigo_productos.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->nombre_productos.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->cantidad_temp_solicitud.'</td>';
	                $html.='<td style="font-size: 18px;"><span class="pull-right"><a href="#" onclick="eliminar_producto('.$res->id_temp_solicitud.')" class="btn btn-danger" style="font-size:65%;"><i class="glyphicon glyphicon-trash"></i></a></span></td>';
	                
	                $html.='</tr>';
	            }
	            
	            
	            $html.='</tbody>';
	            $html.='</table>';
	            $html.='</section></div>';
	            $html.='<div class="table-pagination pull-right">';
	            $html.=''. $this->paginatetemp("index.php", $page, $total_pages, $adjacents).'';
	            $html.='</div>';
	            
	            
	            
	        }else{
	            $html.='<div class="col-lg-6 col-md-6 col-xs-12">';
	            $html.='<div class="alert alert-warning alert-dismissable" style="margin-top:40px;">';
	            $html.='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
	            $html.='<h4>Aviso!!!</h4> <b>Sin Resultados Productos</b>';
	            $html.='</div>';
	            $html.='</div>';
	        }
	        
	        
	        echo $html;
	        
	    }
	    
	    
	}
	
	public function paginate($reload, $page, $tpages, $adjacents) {
	    
	    $prevlabel = "&lsaquo; Prev";
	    $nextlabel = "Next &rsaquo;";
	    $out = '<ul class="pagination pagination-large">';
	    
	    // previous label
	    
	    if($page==1) {
	        $out.= "<li class='disabled'><span><a>$prevlabel</a></span></li>";
	    } else if($page==2) {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='load_productos_solicitud(1)'>$prevlabel</a></span></li>";
	    }else {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='load_productos_solicitud(".($page-1).")'>$prevlabel</a></span></li>";
	        
	    }
	    
	    // first label
	    if($page>($adjacents+1)) {
	        $out.= "<li><a href='javascript:void(0);' onclick='load_productos_solicitud(1)'>1</a></li>";
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
	            $out.= "<li><a href='javascript:void(0);' onclick='load_productos_solicitud(1)'>$i</a></li>";
	        }else {
	            $out.= "<li><a href='javascript:void(0);' onclick='load_productos_solicitud(".$i.")'>$i</a></li>";
	        }
	    }
	    
	    // interval
	    
	    if($page<($tpages-$adjacents-1)) {
	        $out.= "<li><a>...</a></li>";
	    }
	    
	    // last
	    
	    if($page<($tpages-$adjacents)) {
	        $out.= "<li><a href='javascript:void(0);' onclick='load_productos_solicitud($tpages)'>$tpages</a></li>";
	    }
	    
	    // next
	    
	    if($page<$tpages) {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='load_productos_solicitud(".($page+1).")'>$nextlabel</a></span></li>";
	    }else {
	        $out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
	    }
	    
	    $out.= "</ul>";
	    return $out;
	}
	
	
	public function insertar_producto(){
	    
	    session_start();
	    
	    $_id_usuarios = $_SESSION['id_usuarios'];
	    
	    $producto_id = (isset($_REQUEST['id_productos'])&& $_REQUEST['id_productos'] !=NULL)?$_REQUEST['id_productos']:0;
	    
	    $cantidad = (isset($_REQUEST['cantidad'])&& $_REQUEST['cantidad'] !=NULL)?$_REQUEST['cantidad']:0;
	    
	    
	    if($_id_usuarios!='' && $producto_id>0){
	        
	        $_session_id = session_id();
	        
	        //para insertado de temp
	        $temp_solicitud = new TempSolicitudModel();
	        $funcion = "ins_temp_solicitud";
	        $parametros = "'$_id_usuarios',
		    				   '$producto_id',
                               '$cantidad',
                               '$_session_id',
                               '1' ";
	        /*nota estado de temp no esta insertado por el momento*/
	        $temp_solicitud->setFuncion($funcion);
	        $temp_solicitud->setParametros($parametros);
	        $resultado=$temp_solicitud->Insert();
	        
	        $this->trae_temporal($_id_usuarios);
	        
	    }
	}
	
	public function eliminar_producto(){
	    
	    session_start();
	    
	    $_id_usuarios = $_SESSION['id_usuarios'];
	    
	    $solicitud_temp_id = (isset($_REQUEST['id_solicitud'])&& $_REQUEST['id_solicitud'] !=NULL)?$_REQUEST['id_solicitud']:0;
	    
	    if($_id_usuarios!='' && $solicitud_temp_id>0){
	        
	        $_session_id = session_id();
	        
	        //para eliminado de temp
	        $temp_solicitud = new TempSolicitudModel();	 
	        
	        $where = "id_usuario_temp_solicitud = $_id_usuarios AND id_temp_solicitud = $solicitud_temp_id ";
	        $resultado=$temp_solicitud->deleteById($where);
	        
	        $this->trae_temporal($_id_usuarios);
	    }
	}
	
	
	
	public function paginatetemp($reload, $page, $tpages, $adjacents) {
	    
	    $prevlabel = "&lsaquo; Prev";
	    $nextlabel = "Next &rsaquo;";
	    $out = '<ul class="pagination pagination-large">';
	    
	    // previous label
	    
	    if($page==1) {
	        $out.= "<li class='disabled'><span><a>$prevlabel</a></span></li>";
	    } else if($page==2) {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='load_temp_solicitud(1)'>$prevlabel</a></span></li>";
	    }else {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='load_temp_solicitud(".($page-1).")'>$prevlabel</a></span></li>";
	        
	    }
	    
	    // first label
	    if($page>($adjacents+1)) {
	        $out.= "<li><a href='javascript:void(0);' onclick='load_temp_solicitud(1)'>1</a></li>";
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
	            $out.= "<li><a href='javascript:void(0);' onclick='load_temp_solicitud(1)'>$i</a></li>";
	        }else {
	            $out.= "<li><a href='javascript:void(0);' onclick='load_temp_solicitud(".$i.")'>$i</a></li>";
	        }
	    }
	    
	    // interval
	    
	    if($page<($tpages-$adjacents-1)) {
	        $out.= "<li><a>...</a></li>";
	    }
	    
	    // last
	    
	    if($page<($tpages-$adjacents)) {
	        $out.= "<li><a href='javascript:void(0);' onclick='load_temp_solicitud($tpages)'>$tpages</a></li>";
	    }
	    
	    // next
	    
	    if($page<$tpages) {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='load_temp_solicitud(".($page+1).")'>$nextlabel</a></span></li>";
	    }else {
	        $out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
	    }
	    
	    $out.= "</ul>";
	    return $out;
	}
	
	
	public function inserta_solicitud(){
	    
	    session_start();
	    $resultado = null;
	    $usuarios=new UsuariosModel();
	    $solicitudCabeza = null; $solicitudCabeza = new SolicitudCabezaModel();
	    
	    if (isset(  $_SESSION['nombre_usuarios']) )
	    { 
	        if (isset ($_POST["id_clientes"]))
	        {
	            
	            $_id_clientes   = $_POST["id_clientes"];
	            $_id_mesas      = $_POST['id_mesa_selecionada'];
	            $_id_usuario    = $_SESSION['id_usuarios'];
	            $_id_rol        = $_SESSION['id_rol'];
	            
	            
	            //agregar numero pedido
	            $numero_pedido='0';
	            
	            //traer numero pedido
	            
	            $columna="*";
	            $tabla="consecutivos";
	            $where="nombre_consecutivos='PEDIDOS'";
	            
	            $resultado = $pedidos->getCondiciones($columna,$tabla,$where,"id_consecutivos");
	            
	            $numero_pedido = $resultado[0]->real_consecutivos;
	            
	            $valor_total_pedidos=0.0;
	            
	            
	            $funcion = "ins_pedidos";
	            
	            $parametros = "'$_id_clientes',
		    				   '$_id_usuario',
		    				   '$_id_mesas',
		    	               '$numero_pedido',
		    	               '$valor_total_pedidos'";
	            
	            $pedidos->setFuncion($funcion);
	            $pedidos->setParametros($parametros);
	            $resultadoinsert=$pedidos->Insert();
	            
	            $columna="pedidos.id_clientes,
                          pedidos.id_usuarios_registra,
                          pedidos.id_mesas,
                          pedidos.numero_pedidos,
                          pedidos.id_pedidos";
	            
	            $tabla="public.pedidos";
	            
	            $actualizado = $pedidos->UpdateBy("real_consecutivos = real_consecutivos + 1 ","consecutivos","nombre_consecutivos='PEDIDOS'");
	            
	            $where="numero_pedidos='$numero_pedido' AND  id_usuarios_registra='$_id_usuario' AND id_clientes = '$_id_clientes' AND id_mesas = '$_id_mesas'";
	            
	            $resultado = $pedidos->getCondiciones($columna,$tabla,$where,"id_pedidos");
	            
	            $pedido_id = $resultado[0]->id_pedidos;
	            
	            if($pedido_id>0){
	                
	                $pedidos_detalle = null; $pedidos_detalle = new PedidosDetalleModel();
	                
	                $funcion = "ins_pedidos";
	                
	                $parametros = "'$_id_clientes',
		    				   '$_id_usuario',
		    				   '$_id_mesas',
		    	               '$numero_pedido',
		    	               '$valor_total_pedidos'";
	                
	                $pedidos->setFuncion($funcion);
	                $pedidos->setParametros($parametros);
	                $resultadoinsert=$pedidos->Insert();
	                
	            }
	            
	            print_r($resultadoinsert);
	            
	            die('llego2');
	            
	            
	            
	            
	            $this->redirect("Pedidos", "index");
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
	
	public function ajax_inserta_solicitud(){
	    
	    session_start();
	    $resultado = null;
	    $usuarios=new UsuariosModel();
	    $solicitudCabeza = null; $solicitudCabeza = new SolicitudCabezaModel();
	    
	    if (isset(  $_SESSION['nombre_usuarios']) )
	    {
	        if (isset ($_POST["id_usuario"]))
	        {
	            
	            $_id_usuarios      = $_POST["id_usuario"];
	            $_razon_solictud   = (isset($_REQUEST['razon_solicitud'])&& $_REQUEST['razon_solicitud'] !=NULL)?$_REQUEST['razon_solicitud']:'';
	            
	            $fecha_solicitud = date("Y-m-d");
	            
	            $funcion = "ins_solicitud_cabeza";
	            
	            $parametros = "'$_id_usuarios',
		    				   '$_razon_solictud',
		    				   '$fecha_solicitud'";
	            
	            $solicitudCabeza->setFuncion($funcion);
	            $solicitudCabeza->setParametros($parametros);
	            $resultadoinsert=$solicitudCabeza->Insert();
	            
	            print_r($parametros);
	            
	            print_r($resultadoinsert);
	            
	            die('llego');
	            
	            
	            //agregar numero pedido
	            $numero_pedido='0';
	            
	            //traer numero pedido
	            
	            $columna="*";
	            $tabla="consecutivos";
	            $where="nombre_consecutivos='PEDIDOS'";
	            
	            $resultado = $pedidos->getCondiciones($columna,$tabla,$where,"id_consecutivos");
	            
	            $numero_pedido = $resultado[0]->real_consecutivos;
	            
	            $valor_total_pedidos=0.0;
	            
	            
	            $funcion = "ins_pedidos";
	            
	            $parametros = "'$_id_clientes',
		    				   '$_id_usuario',
		    				   '$_id_mesas',
		    	               '$numero_pedido',
		    	               '$valor_total_pedidos'";
	            
	            $pedidos->setFuncion($funcion);
	            $pedidos->setParametros($parametros);
	            $resultadoinsert=$pedidos->Insert();
	            
	            $columna="pedidos.id_clientes,
                          pedidos.id_usuarios_registra,
                          pedidos.id_mesas,
                          pedidos.numero_pedidos,
                          pedidos.id_pedidos";
	            
	            $tabla="public.pedidos";
	            
	            $actualizado = $pedidos->UpdateBy("real_consecutivos = real_consecutivos + 1 ","consecutivos","nombre_consecutivos='PEDIDOS'");
	            
	            $where="numero_pedidos='$numero_pedido' AND  id_usuarios_registra='$_id_usuario' AND id_clientes = '$_id_clientes' AND id_mesas = '$_id_mesas'";
	            
	            $resultado = $pedidos->getCondiciones($columna,$tabla,$where,"id_pedidos");
	            
	            $pedido_id = $resultado[0]->id_pedidos;
	            
	            if($pedido_id>0){
	                
	                $pedidos_detalle = null; $pedidos_detalle = new PedidosDetalleModel();
	                
	                $funcion = "ins_pedidos";
	                
	                $parametros = "'$_id_clientes',
		    				   '$_id_usuario',
		    				   '$_id_mesas',
		    	               '$numero_pedido',
		    	               '$valor_total_pedidos'";
	                
	                $pedidos->setFuncion($funcion);
	                $pedidos->setParametros($parametros);
	                $resultadoinsert=$pedidos->Insert();
	                
	            }
	            
	            print_r($resultadoinsert);
	            
	            die('llego2');
	            
	            
	            
	            
	            $this->redirect("Pedidos", "index");
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
	
	
}
?>