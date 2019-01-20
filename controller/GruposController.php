<?php

class GruposController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		//Creamos el objeto usuario
     	$grupos=new GruposModel();
					//Conseguimos todos los usuarios
     	$resultSet=$grupos->getAll("id_grupos");
				
		$resultEdit = "";
		
		$catalogo=null;
		$catalogo = new CatalogoModel();
		//para estados de catalogo de usuarios
		$whe_catalogo = "tabla_catalogo = 'grupos' AND columna_catalogo = 'estado_grupos'";
		$result_Grupos_estados = $catalogo->getBy($whe_catalogo);

		
		session_start();
        
	
		if (isset(  $_SESSION['nombre_usuarios']) )
		{

			$nombre_controladores = "Grupos";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $grupos->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				if (isset ($_GET["id_grupos"])   )
				{

					$nombre_controladores = "Grupos";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $grupos->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
					if (!empty($resultPer))
					{
					
					    $_id_grupos = $_GET["id_grupos"];
						$columnas = " grupos.id_grupos, 
                                      grupos.nombre_grupos, 
                                      grupos.estado_grupos, 
                                      grupos.creado, 
                                      grupos.modificado, 
                                      catalogo.id_catalogo, 
                                      catalogo.nombre_catalogo, 
                                      catalogo.valor_catalogo";
						$tablas   = "public.grupos, 
                                     public.catalogo";
						$where    = "grupos.estado_grupos = catalogo.valor_catalogo
                                    AND public.catalogo.tabla_catalogo = 'grupos' AND public.catalogo.columna_catalogo = 'estado_grupos' AND grupos.id_grupos = '$_id_grupos' "; 
						$id       = "grupos.id_grupos";
							
						$resultEdit = $grupos->getCondiciones($columnas ,$tablas ,$where, $id);

					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar Grupos"
					
						));
					
					
					}
					
				}
		
				
				$this->view("Grupos",array(
				    "resultSet"=>$resultSet, "resultEdit" =>$resultEdit, "result_Grupos_estados" =>$result_Grupos_estados
			
				));
		
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Grupos"
				
				));
				
				exit();	
			}
				
		}
	else{
       	
       	$this->redirect("Usuarios","sesion_caducada");
       	
       }
	
	}
	
	public function InsertaGrupos(){
			
		session_start();
		$grupos=new GruposModel();
		
		

		$nombre_controladores = "Grupos";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $grupos->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer))
		{
		
		//die("llego");
		
			$resultado = null;
			$grupos=new GruposModel();
		
			if (isset ($_POST["nombre_grupos"])   )
			{
				
			    $_nombre_grupos = $_POST["nombre_grupos"];
			    $_id_grupos =  $_POST["id_grupos"];
			    $_id_estado = $_POST["id_estado"];
			    //die("llego");
			    if($_id_grupos > 0){
					
					$columnas = " nombre_grupos = '$_nombre_grupos',
                                  estado_grupos = '$_id_estado'";
					$tabla = "  public.grupos";
					$where = "id_grupos = '$_id_grupos'";
					$resultado=$grupos->UpdateBy($columnas, $tabla, $where);
					
				}else{
					
					$funcion = "ins_grupos";
					$parametros = " '$_nombre_grupos', '$_id_estado'";
					$grupos->setFuncion($funcion);
					$grupos->setParametros($parametros);
					$resultado=$grupos->Insert();
				}
				
				
				
		
			}
			$this->redirect("Grupos", "index");

		}
		else
		{
			$this->view("Error",array(
					"resultado"=>"No tiene Permisos de Insertar Grupos"
		
			));
		
		
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
	            
	            $grupos->UpdateBy("estado_grupos=2","grupos","id_grupos='$id_grupos'");
	            
	          
	            
	        }
	        
	        $this->redirect("Grupos", "index");
	        
	        
	    }
	    else
	    {
	        $this->view("Error",array(
	            "resultado"=>"No tiene Permisos de Borrar Roles"
	            
	        ));
	    }
	    
	}
	
	public function consulta_grupos_activos(){
	    
	    session_start();
	    $id_rol=$_SESSION["id_rol"];
	    
	    $usuarios = new UsuariosModel();
	    $catalogo = null; $catalogo = new CatalogoModel();
	    $where_to="";
	    $columnas = " grupos.id_grupos,
                      grupos.nombre_grupos, 
                      grupos.estado_grupos, 
                      catalogo.nombre_catalogo";
	    
	    $tablas = "public.grupos INNER JOIN public.catalogo ON grupos.estado_grupos = catalogo.valor_catalogo
                    AND catalogo.nombre_catalogo='ACTIVO' AND catalogo.tabla_catalogo ='grupos' 
                    AND catalogo.columna_catalogo = 'estado_grupos'";
	    
	    
	    $where    = " 1=1";
	    
	    $id       = "grupos.id_grupos";
	    
	    
	    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	    $search =  (isset($_REQUEST['search'])&& $_REQUEST['search'] !=NULL)?$_REQUEST['search']:'';
	    
	    
	    if($action == 'ajax')
	    {
	        //estado_usuario
	        $wherecatalogo = "tabla_catalogo='grupos' AND columna_catalogo='estado_grupos'";
	        $resultCatalogo = $catalogo->getCondiciones('valor_catalogo,nombre_catalogo' ,'public.catalogo' , $wherecatalogo , 'tabla_catalogo');
	        
	        
	        
	        if(!empty($search)){
	            
	            
	            $where1=" AND (grupos.nombre_grupos LIKE '".$search."%' )";
	            
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
	            $html.= "<table id='tabla_grupos_activos' class='tablesorter table table-striped table-bordered dt-responsive nowrap dataTables-example'>";
	            $html.= "<thead>";
	            $html.= "<tr>";
	            $html.='<th style="text-align: left;  font-size: 12px;"></th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Nombre</th>';
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
	                $html.='<td style="font-size: 11px;">'.$i.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->nombre_grupos.'</td>';
	                
	                if(!empty($resultCatalogo)){
	                    foreach ($resultCatalogo as $r_estado){
	                        if($r_estado->valor_catalogo == $res->estado_grupos ){
	                            $html.='<td style="font-size: 11px;">'.$r_estado->nombre_catalogo.'</td>';
	                        }
	                    }
	                }
	                
	                
	                if($id_rol==1){
	                    
	                    $html.='<td style="font-size: 18px;"><span class="pull-right"><a href="index.php?controller=Grupos&action=index&id_grupos='.$res->id_grupos.'" class="btn btn-success" style="font-size:65%;"><i class="glyphicon glyphicon-edit"></i></a></span></td>';
	                    $html.='<td style="font-size: 18px;"><span class="pull-right"><a href="index.php?controller=Grupos&action=borrarId&id_grupos='.$res->id_grupos.'" class="btn btn-danger" style="font-size:65%;"><i class="glyphicon glyphicon-trash"></i></a></span></td>';
	                    
	                }
	                
	                $html.='</tr>';
	            }
	            
	            
	            
	            $html.='</tbody>';
	            $html.='</table>';
	            $html.='</section></div>';
	            $html.='<div class="table-pagination pull-right">';
	            $html.=''. $this->paginate_grupos_activos("index.php", $page, $total_pages, $adjacents).'';
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
	
	public function consulta_grupos_inactivos(){
	    
	    session_start();
	    $id_rol=$_SESSION["id_rol"];
	    
	    $usuarios = new UsuariosModel();
	    $catalogo = null; $catalogo = new CatalogoModel();
	    $where_to="";
	    $columnas = " grupos.id_grupos,
                      grupos.nombre_grupos,
                      grupos.estado_grupos,
                      catalogo.nombre_catalogo";
	    
	    $tablas = "public.grupos INNER JOIN public.catalogo ON grupos.estado_grupos = catalogo.valor_catalogo
                    AND catalogo.nombre_catalogo='INACTIVO' AND catalogo.tabla_catalogo ='grupos'
                    AND catalogo.columna_catalogo = 'estado_grupos'";
	    
	    
	    $where    = " 1=1";
	    
	    $id       = "grupos.id_grupos";
	    
	    
	    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	    $search =  (isset($_REQUEST['search'])&& $_REQUEST['search'] !=NULL)?$_REQUEST['search']:'';
	    
	    
	    if($action == 'ajax')
	    {
	        //estado_usuario
	        $wherecatalogo = "tabla_catalogo='grupos' AND columna_catalogo='estado_grupos'";
	        $resultCatalogo = $catalogo->getCondiciones('valor_catalogo,nombre_catalogo' ,'public.catalogo' , $wherecatalogo , 'tabla_catalogo');
	        
	        
	        
	        if(!empty($search)){
	            
	            
	            $where1=" AND (grupos.nombre_grupos LIKE '".$search."%' )";
	            
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
	            $html.= "<table id='tabla_grupos_inactivos' class='tablesorter table table-striped table-bordered dt-responsive nowrap dataTables-example'>";
	            $html.= "<thead>";
	            $html.= "<tr>";
	            $html.='<th style="text-align: left;  font-size: 12px;"></th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Nombre</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Estado</th>';
	            
	            if($id_rol==1){
	                
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
	                $html.='<td style="font-size: 11px;">'.$i.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->nombre_grupos.'</td>';
	                
	                if(!empty($resultCatalogo)){
	                    foreach ($resultCatalogo as $r_estado){
	                        if($r_estado->valor_catalogo == $res->estado_grupos ){
	                            $html.='<td style="font-size: 11px;">'.$r_estado->nombre_catalogo.'</td>';
	                        }
	                    }
	                }
	                
	                
	                if($id_rol==1){
	                    
	                    $html.='<td style="font-size: 18px;"><span class="pull-right"><a href="index.php?controller=Grupos&action=index&id_grupos='.$res->id_grupos.'" class="btn btn-success" style="font-size:65%;"><i class="glyphicon glyphicon-edit"></i></a></span></td>';
	                   
	                }
	                
	                $html.='</tr>';
	            }
	            
	            
	            
	            $html.='</tbody>';
	            $html.='</table>';
	            $html.='</section></div>';
	            $html.='<div class="table-pagination pull-right">';
	            $html.=''. $this->paginate_grupos_inactivos("index.php", $page, $total_pages, $adjacents).'';
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
	
	
	
	
	public function paginate_grupos_activos($reload, $page, $tpages, $adjacents) {
	    
	    $prevlabel = "&lsaquo; Prev";
	    $nextlabel = "Next &rsaquo;";
	    $out = '<ul class="pagination pagination-large">';
	    
	    // previous label
	    
	    if($page==1) {
	        $out.= "<li class='disabled'><span><a>$prevlabel</a></span></li>";
	    } else if($page==2) {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='load_grupos_activos(1)'>$prevlabel</a></span></li>";
	    }else {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='load_grupos_activos(".($page-1).")'>$prevlabel</a></span></li>";
	        
	    }
	    
	    // first label
	    if($page>($adjacents+1)) {
	        $out.= "<li><a href='javascript:void(0);' onclick='load_grupos_activos(1)'>1</a></li>";
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
	            $out.= "<li><a href='javascript:void(0);' onclick='load_grupos_activos(1)'>$i</a></li>";
	        }else {
	            $out.= "<li><a href='javascript:void(0);' onclick='load_grupos_activos(".$i.")'>$i</a></li>";
	        }
	    }
	    
	    // interval
	    
	    if($page<($tpages-$adjacents-1)) {
	        $out.= "<li><a>...</a></li>";
	    }
	    
	    // last
	    
	    if($page<($tpages-$adjacents)) {
	        $out.= "<li><a href='javascript:void(0);' onclick='load_grupos_activos($tpages)'>$tpages</a></li>";
	    }
	    
	    // next
	    
	    if($page<$tpages) {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='load_grupos_activos(".($page+1).")'>$nextlabel</a></span></li>";
	    }else {
	        $out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
	    }
	    
	    $out.= "</ul>";
	    return $out;
	}
	
	
	
	
	
	
	
	public function paginate_grupos_inactivos($reload, $page, $tpages, $adjacents) {
	    
	    $prevlabel = "&lsaquo; Prev";
	    $nextlabel = "Next &rsaquo;";
	    $out = '<ul class="pagination pagination-large">';
	    
	    // previous label
	    
	    if($page==1) {
	        $out.= "<li class='disabled'><span><a>$prevlabel</a></span></li>";
	    } else if($page==2) {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='load_grupos_inactivos(1)'>$prevlabel</a></span></li>";
	    }else {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='load_grupos_inactivos(".($page-1).")'>$prevlabel</a></span></li>";
	        
	    }
	    
	    // first label
	    if($page>($adjacents+1)) {
	        $out.= "<li><a href='javascript:void(0);' onclick='load_grupos_inactivos(1)'>1</a></li>";
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
	            $out.= "<li><a href='javascript:void(0);' onclick='load_grupos_inactivos(1)'>$i</a></li>";
	        }else {
	            $out.= "<li><a href='javascript:void(0);' onclick='load_grupos_inactivos(".$i.")'>$i</a></li>";
	        }
	    }
	    
	    // interval
	    
	    if($page<($tpages-$adjacents-1)) {
	        $out.= "<li><a>...</a></li>";
	    }
	    
	    // last
	    
	    if($page<($tpages-$adjacents)) {
	        $out.= "<li><a href='javascript:void(0);' onclick='load_grupos_inactivos($tpages)'>$tpages</a></li>";
	    }
	    
	    // next
	    
	    if($page<$tpages) {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='load_grupos_inactivos(".($page+1).")'>$nextlabel</a></span></li>";
	    }else {
	        $out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
	    }
	    
	    $out.= "</ul>";
	    return $out;
	}
	
	
}
?>