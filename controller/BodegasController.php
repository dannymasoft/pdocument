<?php

class BodegasController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    
    
    
    public function index(){
        
      
        
        session_start();
        
        //Creamos el objeto usuario
        $bodegas=new BodegasModel();
        //Conseguimos todos los usuarios
        
        $provincias=new ProvinciasModel();
        $resultProv=$provincias->getAll("nombre_provincias");
        
        $cantones=new CantonesModel();
        $resultCant=$cantones->getAll("nombre_cantones");
        
        $Parroquias=new ParroquiasModel();
        $resultParr=$Parroquias->getAll("nombre_parroquias");
            
        $resultEdit = "";
        
        $catalogo=null;
        $catalogo = new CatalogoModel();
        //para estados de catalogo de usuarios
        $whe_catalogo = "tabla_catalogo = 'bodegas' AND columna_catalogo = 'estado_bodegas'";
        $result_Bodegas_estados = $catalogo->getBy($whe_catalogo);
        
        if (isset(  $_SESSION['nombre_usuarios']) )
        {
            
            $nombre_controladores = "Bodegas";
            $id_rol= $_SESSION['id_rol'];
            $resultPer = $bodegas->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
            
            if (!empty($resultPer))
            {
                if (isset ($_GET["id_bodegas"])   )
                {
                    
                  
                        
                    $_id_bodegas = $_GET["id_bodegas"];
                        $columnas = "
                                      bodegas.id_bodegas, 
                                      provincias.id_provincias, 
                                      provincias.nombre_provincias, 
                                      cantones.id_cantones, 
                                      cantones.nombre_cantones, 
                                      parroquias.id_parroquias, 
                                      parroquias.nombre_parroquias, 
                                      catalogo.id_catalogo, 
                                      catalogo.nombre_catalogo, 
                                      catalogo.valor_catalogo, 
                                      bodegas.nombre_bodegas, 
                                      bodegas.estado_bodegas, 
                                      bodegas.creado, 
                                      bodegas.modificado";
                        $tablas   = " public.bodegas, 
                                      public.provincias, 
                                      public.cantones, 
                                      public.parroquias, 
                                      public.catalogo";
                        $where    = " provincias.id_provincias = bodegas.id_provincias AND
                                      cantones.id_cantones = bodegas.id_cantones AND
                                      parroquias.id_parroquias = bodegas.id_parroquias AND
                                      bodegas.estado_bodegas = catalogo.valor_catalogo AND
                                      public.catalogo.tabla_catalogo = 'bodegas' AND public.catalogo.columna_catalogo = 'estado_bodegas' 
                                         AND bodegas.id_bodegas = '$_id_bodegas'";
                        $id       = "bodegas.id_bodegas";
                        
                        $resultEdit = $bodegas->getCondiciones($columnas ,$tablas ,$where, $id);
                        
                    
                    
                }
                
                
                $this->view("Bodegas",array(
                    "resultSet"=>$resultSet, "resultEdit" =>$resultEdit, "resultProv"=>$resultProv, "resultCant"=>$resultCant, "resultParr"=>$resultParr, "result_Bodegas_estados" =>$result_Bodegas_estados
                    
                ));
                
                
                
            }
            else
            {
                $this->view("Error",array(
                    "resultado"=>"No tiene Permisos de Acceso a Bodegas"
                    
                ));
                
                exit();
            }
            
        }
        else{
            
            $this->redirect("Usuarios","sesion_caducada");
            
        }
        
    }
    
    
    
    public function InsertaBodegas(){
        
        session_start();
        
        $resultado = null;
        $bodegas=new BodegasModel();
        
        
        $nombre_controladores = "Bodegas";
        $id_rol= $_SESSION['id_rol'];
        $resultPer = $bodegas->getPermisosEditar("   nombre_controladores = '$nombre_controladores' AND id_rol = '$id_rol' " );
        
        if (!empty($resultPer))
        {
            
            if ( isset ($_POST["nombre_bodegas"]))
            
            {
                //die('llego');
                
                
                $_id_provincias = $_POST["id_provincias"];
                $_id_cantones = $_POST["id_cantones"];
                $_id_parroquias = $_POST["id_parroquias"];
                $_nombre_bodegas = $_POST["nombre_bodegas"];
                $_id_estado = $_POST["id_estado"];
                
                                
                
                if($_id_bodegas > 0){
                    
                    $columnas = "
                              
							  id_provincias ='$_id_provincias',
							  id_cantones = '$_id_cantones',
                              id_parroquias = '$_id_parroquias',
                              nombre_bodegas = '$_nombre_bodegas',
                              estado_bodegas = '$_id_estado'
							  
							  ";
                    $tabla = "    public.bodegas, 
                                  public.provincias, 
                                  public.cantones, 
                                  public.ciudad";
                    $where = "provincias.id_provincias = bodegas.id_provincias AND
                              cantones.id_cantones = bodegas.id_cantones AND
                              parroquias.id_parroquias = bodegas.id_parroquias AND
                              bodegas.estado_bodegas = catalogo.valor_catalogo AND
                              public.catalogo.tabla_catalogo = 'bodegas' AND public.catalogo.columna_catalogo = 'estado_bodegas' 
                             AND bodegas.id_bodegas = '$_id_bodegas'";
                    $resultado=$bodegas->UpdateBy($columnas, $tabla, $where);
                    
                }else{
                    
                    $funcion = "ins_bodegas";
                    $parametros = "'$_id_provincias', '$_id_cantones', '$_id_parroquias', '$_nombre_bodegas', '$_id_estado'";
                    $bodegas->setFuncion($funcion);
                    $bodegas->setParametros($parametros);
                    $resultado=$bodegas->Insert();
                }
                
            }
            
            $this->redirect("Bodegas", "index");
        }
        else
        {
            $this->view("Error",array(
                "resultado"=>"No tiene Permisos Para Crear Bodegas"
                
            ));
            
            
        }
        
        
        
    }
    
    public function borrarId()
    {
        
        session_start();
        $bodegas=new BodegasModel();
        $nombre_controladores = "Bodegas";
        $id_rol= $_SESSION['id_rol'];
        $resultPer = $bodegas->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
        
        if (!empty($resultPer))
        {
            if(isset($_GET["id_bodegas"]))
            {
                $id_bodegas=(int)$_GET["id_bodegas"];
                
                $bodegas->UpdateBy("estado_bodegas=2","bodegas","id_bodegas='$id_bodegas'");
                
                
                
            }
            
            $this->redirect("Bodegas", "index");
            
            
        }
        else
        {
            $this->view("Error",array(
                "resultado"=>"No tiene Permisos de Borrar Bodegas"
                
            ));
        }
        
    }
    
    
    public function devuelveCanton()
    {
        session_start();
        $resultCan = array();
        
        
        if(isset($_POST["id_provincias_vivienda"]))
        {
            
            $id_provincias=(int)$_POST["id_provincias_vivienda"];
            
            $cantones=new CantonesModel();
            
            $resultCan = $cantones->getCondiciones("id_cantones,nombre_cantones"," public.cantones ", "id_provincias = '$id_provincias'  ","nombre_cantones");
                        
        }
        
        if(isset($_POST["id_provincias_asignacion"]))
        {
            
            $id_provincias=(int)$_POST["id_provincias_asignacion"];
            
            $cantones=new CantonesModel();
            
            $resultCan = $cantones->getBy(" id_provincias = '$id_provincias'  ");
            
            
        }
        
        echo json_encode($resultCan);
        
    }
    
    
    
    
    
    
    
    public function devuelveParroquias()
    {
        session_start();
        $resultParr = array();
        
        
        if(isset($_POST["id_cantones_vivienda"]))
        {
            
            $id_cantones_vivienda=(int)$_POST["id_cantones_vivienda"];
            
            $parroquias=new ParroquiasModel();
            
            $resultParr = $parroquias->getBy(" id_cantones = '$id_cantones_vivienda'  ");
            
            
        }
        if(isset($_POST["id_cantones_asignacion"]))
        {
            
            $id_cantones_vivienda=(int)$_POST["id_cantones_asignacion"];
            
            $parroquias=new ParroquiasModel();
            
            $resultParr = $parroquias->getBy(" id_cantones = '$id_cantones_vivienda'  ");
            
            
        }
        
        echo json_encode($resultParr);
        
    }
    
    
    public function consulta_bodegas_activos(){
        
        
        
        
        session_start();
        $id_rol=$_SESSION["id_rol"];
        
        $usuarios = new UsuariosModel();
        $catalogo = null; $catalogo = new CatalogoModel();
        $where_to="";
        $columnas = "
                                      bodegas.id_bodegas,
                                      provincias.id_provincias,
                                      provincias.nombre_provincias,
                                      cantones.id_cantones,
                                      cantones.nombre_cantones,
                                      parroquias.id_parroquias,
                                      parroquias.nombre_parroquias,
                                      catalogo.id_catalogo,
                                      catalogo.nombre_catalogo,
                                      catalogo.valor_catalogo,
                                      bodegas.nombre_bodegas,
                                      bodegas.estado_bodegas,
                                      bodegas.creado,
                                      bodegas.modificado";
        $tablas   = " public.bodegas,
                                      public.provincias,
                                      public.cantones,
                                      public.parroquias,
                                      public.catalogo";
        $where    = " provincias.id_provincias = bodegas.id_provincias AND
                                      cantones.id_cantones = bodegas.id_cantones AND
                                      parroquias.id_parroquias = bodegas.id_parroquias AND
                                      bodegas.estado_bodegas = catalogo.valor_catalogo AND
                                      public.catalogo.tabla_catalogo = 'bodegas' AND public.catalogo.columna_catalogo = 'estado_bodegas'
                                      AND public.catalogo.nombre_catalogo='ACTIVO' ";
        $id       = "bodegas.id_bodegas";
        
        
        $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
        $search =  (isset($_REQUEST['search'])&& $_REQUEST['search'] !=NULL)?$_REQUEST['search']:'';
        
        
        if($action == 'ajax')
        {
            //estado_usuario
            $wherecatalogo = "tabla_catalogo='bodegas' AND columna_catalogo='estado_bodegas'";
            $resultCatalogo = $catalogo->getCondiciones('valor_catalogo,nombre_catalogo' ,'public.catalogo' , $wherecatalogo , 'tabla_catalogo');
            
            
            
            if(!empty($search)){
                
                
                $where1=" AND (bodegas.nombre_bodegas LIKE '".$search."%' )";
                
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
                $html.= "<table id='tabla_bodegas_activos' class='tablesorter table table-striped table-bordered dt-responsive nowrap dataTables-example'>";
                $html.= "<thead>";
                $html.= "<tr>";
                $html.='<th style="text-align: left;  font-size: 12px;"></th>';
                $html.='<th style="text-align: left;  font-size: 12px;">Nombre Bodega</th>';
                $html.='<th style="text-align: left;  font-size: 12px;">Provincia</th>';
                $html.='<th style="text-align: left;  font-size: 12px;">Cantones</th>';
                $html.='<th style="text-align: left;  font-size: 12px;">Parroquia</th>';
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
                    $html.='<td style="font-size: 11px;">'.$res->nombre_bodegas.'</td>';
                    $html.='<td style="font-size: 11px;">'.$res->nombre_provincias.'</td>';
                    $html.='<td style="font-size: 11px;">'.$res->nombre_cantones.'</td>';
                    $html.='<td style="font-size: 11px;">'.$res->nombre_parroquias.'</td>';
                    
                    
                    if(!empty($resultCatalogo)){
                        foreach ($resultCatalogo as $r_estado){
                            if($r_estado->valor_catalogo == $res->estado_bodegas ){
                                $html.='<td style="font-size: 11px;">'.$r_estado->nombre_catalogo.'</td>';
                            }
                        }
                    }
                    
                    
                    if($id_rol==1){
                        
                        $html.='<td style="font-size: 18px;"><span class="pull-right"><a href="index.php?controller=Bodegas&action=index&id_bodegas='.$res->id_bodegas.'" class="btn btn-success" style="font-size:65%;"><i class="glyphicon glyphicon-edit"></i></a></span></td>';
                        $html.='<td style="font-size: 18px;"><span class="pull-right"><a href="index.php?controller=Bodegas&action=borrarId&id_bodegas='.$res->id_bodegas.'" class="btn btn-danger" style="font-size:65%;"><i class="glyphicon glyphicon-trash"></i></a></span></td>';
                        
                    }
                    
                    $html.='</tr>';
                }
                
                
                
                $html.='</tbody>';
                $html.='</table>';
                $html.='</section></div>';
                $html.='<div class="table-pagination pull-right">';
                $html.=''. $this->paginate_bodegas_activos("index.php", $page, $total_pages, $adjacents).'';
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
    
    
    
    
    
    
    public function consulta_bodegas_inactivos(){
        
        session_start();
        $id_rol=$_SESSION["id_rol"];
        
        $usuarios = new UsuariosModel();
        $catalogo = null; $catalogo = new CatalogoModel();
        $where_to="";
        $columnas = "
                                      bodegas.id_bodegas,
                                      provincias.id_provincias,
                                      provincias.nombre_provincias,
                                      cantones.id_cantones,
                                      cantones.nombre_cantones,
                                      parroquias.id_parroquias,
                                      parroquias.nombre_parroquias,
                                      catalogo.id_catalogo,
                                      catalogo.nombre_catalogo,
                                      catalogo.valor_catalogo,
                                      bodegas.nombre_bodegas,
                                      bodegas.estado_bodegas,
                                      bodegas.creado,
                                      bodegas.modificado";
        $tablas   = " public.bodegas,
                                      public.provincias,
                                      public.cantones,
                                      public.parroquias,
                                      public.catalogo";
        $where    = " provincias.id_provincias = bodegas.id_provincias AND
                                      cantones.id_cantones = bodegas.id_cantones AND
                                      parroquias.id_parroquias = bodegas.id_parroquias AND
                                      bodegas.estado_bodegas = catalogo.valor_catalogo AND
                                      public.catalogo.tabla_catalogo = 'bodegas' AND public.catalogo.columna_catalogo = 'estado_bodegas'
                                      AND public.catalogo.nombre_catalogo='INACTIVO' ";
        $id       = "bodegas.id_bodegas";
        
        
        $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
        $search =  (isset($_REQUEST['search'])&& $_REQUEST['search'] !=NULL)?$_REQUEST['search']:'';
        
        
        if($action == 'ajax')
        {
            //estado_usuario
            $wherecatalogo = "tabla_catalogo='bodegas' AND columna_catalogo='estado_bodegas'";
            $resultCatalogo = $catalogo->getCondiciones('valor_catalogo,nombre_catalogo' ,'public.catalogo' , $wherecatalogo , 'tabla_catalogo');
            
            
            
            if(!empty($search)){
                
                
                $where1=" AND (bodegas.nombre_bodegas LIKE '".$search."%' )";
                
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
                $html.= "<table id='tabla_bodegas_inactivos' class='tablesorter table table-striped table-bordered dt-responsive nowrap dataTables-example'>";
                $html.= "<thead>";
                $html.= "<tr>";
                $html.='<th style="text-align: left;  font-size: 12px;"></th>';
                $html.='<th style="text-align: left;  font-size: 12px;">Nombre Bodega</th>';
                $html.='<th style="text-align: left;  font-size: 12px;">Provincia</th>';
                $html.='<th style="text-align: left;  font-size: 12px;">Cantones</th>';
                $html.='<th style="text-align: left;  font-size: 12px;">Parroquia</th>';
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
                    $html.='<td style="font-size: 11px;">'.$res->nombre_bodegas.'</td>';
                    $html.='<td style="font-size: 11px;">'.$res->nombre_provincias.'</td>';
                    $html.='<td style="font-size: 11px;">'.$res->nombre_cantones.'</td>';
                    $html.='<td style="font-size: 11px;">'.$res->nombre_parroquias.'</td>';
                    

                    
                    if(!empty($resultCatalogo)){
                        foreach ($resultCatalogo as $r_estado){
                            if($r_estado->valor_catalogo == $res->estado_bodegas ){
                                $html.='<td style="font-size: 11px;">'.$r_estado->nombre_catalogo.'</td>';
                            }
                        }
                    }
                    
                    
                    if($id_rol==1){
                        
                        $html.='<td style="font-size: 18px;"><span class="pull-right"><a href="index.php?controller=Bodegas&action=index&id_bodegas='.$res->id_bodegas.'" class="btn btn-success" style="font-size:65%;"><i class="glyphicon glyphicon-edit"></i></a></span></td>';
                        
                    }
                    
                    $html.='</tr>';
                }
                
                
                
                $html.='</tbody>';
                $html.='</table>';
                $html.='</section></div>';
                $html.='<div class="table-pagination pull-right">';
                $html.=''. $this->paginate_bodegas_inactivos("index.php", $page, $total_pages, $adjacents).'';
                $html.='</div>';
                
                
                
            }else{
                $html.='<div class="col-lg-6 col-md-6 col-xs-12">';
                $html.='<div class="alert alert-warning alert-dismissable" style="margin-top:40px;">';
                $html.='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                $html.='<h4>Aviso!!!</h4> <b>Actualmente no hay Bodegas registrados...</b>';
                $html.='</div>';
                $html.='</div>';
            }
            
            
            echo $html;
            die();
            
        }
    }
    
    
    
    
    public function paginate_bodegas_activos($reload, $page, $tpages, $adjacents) {
        
        $prevlabel = "&lsaquo; Prev";
        $nextlabel = "Next &rsaquo;";
        $out = '<ul class="pagination pagination-large">';
        
        // previous label
        
        if($page==1) {
            $out.= "<li class='disabled'><span><a>$prevlabel</a></span></li>";
        } else if($page==2) {
            $out.= "<li><span><a href='javascript:void(0);' onclick='load_bodegas_activos(1)'>$prevlabel</a></span></li>";
        }else {
            $out.= "<li><span><a href='javascript:void(0);' onclick='load_bodegas_activos(".($page-1).")'>$prevlabel</a></span></li>";
            
        }
        
        // first label
        if($page>($adjacents+1)) {
            $out.= "<li><a href='javascript:void(0);' onclick='load_bodegas_activos(1)'>1</a></li>";
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
                $out.= "<li><a href='javascript:void(0);' onclick='load_bodegas_activos(1)'>$i</a></li>";
            }else {
                $out.= "<li><a href='javascript:void(0);' onclick='load_bodegas_activos(".$i.")'>$i</a></li>";
            }
        }
        
        // interval
        
        if($page<($tpages-$adjacents-1)) {
            $out.= "<li><a>...</a></li>";
        }
        
        // last
        
        if($page<($tpages-$adjacents)) {
            $out.= "<li><a href='javascript:void(0);' onclick='load_bodegas_activos($tpages)'>$tpages</a></li>";
        }
        
        // next
        
        if($page<$tpages) {
            $out.= "<li><span><a href='javascript:void(0);' onclick='load_bodegas_activos(".($page+1).")'>$nextlabel</a></span></li>";
        }else {
            $out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
        }
        
        $out.= "</ul>";
        return $out;
    }
    
    
    
    
    
    public function paginate_bodegas_inactivos($reload, $page, $tpages, $adjacents) {
        
        $prevlabel = "&lsaquo; Prev";
        $nextlabel = "Next &rsaquo;";
        $out = '<ul class="pagination pagination-large">';
        
        // previous label
        
        if($page==1) {
            $out.= "<li class='disabled'><span><a>$prevlabel</a></span></li>";
        } else if($page==2) {
            $out.= "<li><span><a href='javascript:void(0);' onclick='load_bodegas_inactivos(1)'>$prevlabel</a></span></li>";
        }else {
            $out.= "<li><span><a href='javascript:void(0);' onclick='load_bodegas_inactivos(".($page-1).")'>$prevlabel</a></span></li>";
            
        }
        
        // first label
        if($page>($adjacents+1)) {
            $out.= "<li><a href='javascript:void(0);' onclick='load_bodegas_inactivos(1)'>1</a></li>";
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
                $out.= "<li><a href='javascript:void(0);' onclick='load_bodegas_inactivos(1)'>$i</a></li>";
            }else {
                $out.= "<li><a href='javascript:void(0);' onclick='load_bodegas_inactivos(".$i.")'>$i</a></li>";
            }
        }
        
        // interval
        
        if($page<($tpages-$adjacents-1)) {
            $out.= "<li><a>...</a></li>";
        }
        
        // last
        
        if($page<($tpages-$adjacents)) {
            $out.= "<li><a href='javascript:void(0);' onclick='load_bodegas_inactivos($tpages)'>$tpages</a></li>";
        }
        
        // next
        
        if($page<$tpages) {
            $out.= "<li><span><a href='javascript:void(0);' onclick='load_bodegas_inactivos(".($page+1).")'>$nextlabel</a></span></li>";
        }else {
            $out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
        }
        
        $out.= "</ul>";
        return $out;
    }

    
    
    
}
?>