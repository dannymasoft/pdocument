<?php

class ActividadesController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
	
		
		
		session_start();
		
		if (isset($_SESSION['nombre_usuarios']))
		{
		    
		    $actividades = new ActividadesModel();
		    $roles = new RolesModel();
		    $resultRol = $roles->getAll("nombre_rol");
		    
		    
		    $usuarios = new UsuariosModel();
		    $resultUsu = $usuarios->getAll("nombre_usuarios");
		    
			$nombre_controladores = "Actividades";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $actividades->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				
				
				
				
				$this->view("Actividades",array(
				    "resultRol"=>$resultRol, "resultUsu"=>$resultUsu
			
				));
		
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Actividades"
				
				));
				
				exit();	
			}
				
		}
	else{
       	
       	$this->redirect("Usuarios","sesion_caducada");
       	
       }
	
	}
	
	
	public function search_actividades(){
	    
	    session_start();
	    $actividades = new ActividadesModel();
	    $where_to="";
	    $columnas = "usuarios.id_usuarios, 
                      usuarios.cedula_usuarios, 
                      usuarios.nombre_usuarios, 
                      usuarios.apellidos_usuarios, 
                      rol.id_rol, 
                      rol.nombre_rol, 
                      actividades.id_actividades, 
                      actividades.ip_usuarios_actividades, 
                      actividades.fecha_usuarios_actividades, 
                      actividades.descripcion_actividades, 
                      actividades.tabla_actividades, 
                      actividades.campo_actividades, 
                      actividades.valor_actividades, 
                      actividades.creado";
	    
	    $tablas   = "public.actividades, 
                      public.usuarios, 
                      public.privilegios, 
                      public.rol";
	    
	    $where    = "usuarios.id_usuarios = actividades.id_usuarios AND
                  privilegios.id_usuarios = usuarios.id_usuarios AND
                  privilegios.id_rol = rol.id_rol";
	    
	    $id       = "usuarios.id_usuarios";
	    
	    
	    
	    
	    
	    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	    $search =  (isset($_REQUEST['search'])&& $_REQUEST['search'] !=NULL)?$_REQUEST['search']:'';
	    $desde=  (isset($_REQUEST['desde'])&& $_REQUEST['desde'] !=NULL)?$_REQUEST['desde']:'';
	    $hasta=  (isset($_REQUEST['hasta'])&& $_REQUEST['hasta'] !=NULL)?$_REQUEST['hasta']:'';
	    
	    $where2="";
	    
	    
	    if($action == 'ajax')
	    {
	        
	        if(!empty($search)){
	            
	            
	            if($desde!="" && $hasta!=""){
	                
	                $where2=" AND DATE(actividades.fecha_usuarios_actividades)  BETWEEN '$desde' AND '$hasta'";
	                
	            }
	            
	            $where1=" AND (usuarios.cedula_usuarios LIKE '".$search."%' OR usuarios.nombre_usuarios LIKE '".$search."%' OR usuarios.apellidos_usuarios LIKE '".$search."%' OR actividades.descripcion_actividades LIKE '".$search."%')";
	            
	            $where_to=$where.$where1.$where2;
	        }else{
	            if($desde!="" && $hasta!=""){
	                
	                $where2=" AND DATE(actividades.fecha_usuarios_actividades)  BETWEEN '$desde' AND '$hasta'";
	                
	            }
	            
	            
	            
	            
	            // aqui solo agrega en el where estos dos campos mijin de ahi dale formato igual a los otros formularios pilas
	            //y mirale porque no para esta imagen .gif
	            
	            $where_to=$where.$where2;
	            
	        }

	        
	        $html="";
	        $resultSet=$actividades->getCantidad("*", $tablas, $where_to);
	        $cantidadResult=(int)$resultSet[0]->total;
	        
	        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	        
	        $per_page = 20; //la cantidad de registros que desea mostrar
	        $adjacents  = 9; //brecha entre páginas después de varios adyacentes
	        $offset = ($page - 1) * $per_page;
	        
	        $limit = " LIMIT   '$per_page' OFFSET '$offset'";
	        
	        $resultSet=$actividades->getCondicionesPagDesc($columnas, $tablas, $where_to, $id, $limit);
	        $count_query   = $cantidadResult;
	        $total_pages = ceil($cantidadResult/$per_page);
	        
	        
	        
	        
	        
	        if($cantidadResult>0)
	        {
	            
	            $html.='<div class="pull-left" style="margin-left:11px;">';
	            $html.='<span class="form-control"><strong>Registros: </strong>'.$cantidadResult.'</span>';
	            $html.='<input type="hidden" value="'.$cantidadResult.'" id="total_query" name="total_query"/>' ;
	            $html.='</div>';
	            $html.='<div class="col-lg-12 col-md-12 col-xs-12">';
	            $html.='<section style="height:425px; overflow-y:scroll;">';
	            $html.= "<table id='tabla_actividades' class='tablesorter table table-striped table-bordered dt-responsive nowrap'>";
	            $html.= "<thead>";
	            $html.= "<tr>";
	            $html.='<th style="text-align: left;  font-size: 12px;"></th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Nombre Usuario</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Ip Usuarios</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Fecha</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Descripción</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Tabla</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Campo</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Valor</th>';
	            $html.='</tr>';
	            $html.='</thead>';
	            $html.='<tbody>';
	            
	            $i=0;
	            
	            foreach ($resultSet as $res)
	            {
	                $i++;
	                $html.='<tr>';
	                $html.='<td style="font-size: 11px;">'.$i.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->nombre_usuarios.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->ip_usuarios_actividades.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->fecha_usuarios_actividades.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->descripcion_actividades.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->tabla_actividades.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->campo_actividades.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->valor_actividades.'</td>';
	                $html.='</tr>';
	            }
	            
	            
	            $html.='</tbody>';
	            $html.='</table>';
	            $html.='</section></div>';
	            $html.='<div class="table-pagination pull-right">';
	            $html.=''. $this->paginate_actividades("index.php", $page, $total_pages, $adjacents).'';
	            $html.='</div>';
	            
	            
	        }else{
	            $html.='<div class="col-lg-6 col-md-6 col-xs-12">';
	            $html.='<div class="alert alert-warning alert-dismissable" style="margin-top:40px;">';
	            $html.='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
	            $html.='<h4>Aviso!!!</h4> <b>Actualmente no hay actividades registradas...</b>';
	            $html.='</div>';
	            $html.='</div>';
	        }
	        
	        
	        
	        
	        echo $html;
	        die();
	        
	    }
	    
	    
	}
	
	
	
	
	
	public function paginate_actividades($reload, $page, $tpages, $adjacents) {
	    
	    $prevlabel = "&lsaquo; Prev";
	    $nextlabel = "Next &rsaquo;";
	    $out = '<ul class="pagination pagination-large">';
	    
	    // previous label
	    
	    if($page==1) {
	        $out.= "<li class='disabled'><span><a>$prevlabel</a></span></li>";
	    } else if($page==2) {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='load_actividades(1)'>$prevlabel</a></span></li>";
	    }else {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='load_actividades(".($page-1).")'>$prevlabel</a></span></li>";
	        
	    }
	    
	    // first label
	    if($page>($adjacents+1)) {
	        $out.= "<li><a href='javascript:void(0);' onclick='load_actividades(1)'>1</a></li>";
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
	            $out.= "<li><a href='javascript:void(0);' onclick='load_actividades(1)'>$i</a></li>";
	        }else {
	            $out.= "<li><a href='javascript:void(0);' onclick='load_actividades(".$i.")'>$i</a></li>";
	        }
	    }
	    
	    // interval
	    
	    if($page<($tpages-$adjacents-1)) {
	        $out.= "<li><a>...</a></li>";
	    }
	    
	    // last
	    
	    if($page<($tpages-$adjacents)) {
	        $out.= "<li><a href='javascript:void(0);' onclick='load_actividades($tpages)'>$tpages</a></li>";
	    }
	    
	    // next
	    
	    if($page<$tpages) {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='load_actividades(".($page+1).")'>$nextlabel</a></span></li>";
	    }else {
	        $out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
	    }
	    
	    $out.= "</ul>";
	    return $out;
	}
	
	
	
	
	
	
	
	
		
}
?>