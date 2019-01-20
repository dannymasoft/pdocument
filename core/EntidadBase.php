<?php
class EntidadBase{
    private $table;
    private $db;
    private $conectar;
    
    
    public function __construct($table) {
        $this->table=(string) $table;
        
        require_once 'Conectar.php';
        $this->conectar=new Conectar();
        $this->db=$this->conectar->conexion();

        $this->fluent=$this->getConetar()->startFluent();
        $this->con=$this->getConetar()->conexion();
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
    
    public function getNuevo($secuencia){
    
    	$query=pg_query($this->con, "SELECT NEXTVAL('$secuencia')");
    	 
    	$resultSet = array();
    	 
    	while ($row = pg_fetch_object($query)) {
    		$resultSet[]=$row;
    	}
    	return $resultSet;
    }
    
    public function getAll($id){
        
    	$query=pg_query($this->con, "SELECT * FROM $this->table ORDER BY $id ASC");
    	$resultSet = array();
    	
           while ($row = pg_fetch_object($query)) {
             $resultSet[]=$row;
           }
        return $resultSet;
    }
    
    function getRealIP() {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))
            return $_SERVER['HTTP_CLIENT_IP'];
            
            if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
                return $_SERVER['HTTP_X_FORWARDED_FOR'];
                
                return $_SERVER['REMOTE_ADDR'];
    }
    
    
    
    public function getContador($contador){
    
    	$query=pg_query($this->con, "SELECT $contador FROM $this->table ");
    	$resultSet = array();
    	 
    	while ($row = pg_fetch_object($query)) {
    		$resultSet[]=$row;
    	}
    	return $resultSet;
    }
    
    public function getCantidad($columna,$tabla,$where){
    
    	//parametro $columna puede ser todo (*) o una columna especifica
    	$query=pg_query($this->con, "SELECT COUNT($columna) AS total FROM $tabla WHERE $where ");
    	$resultSet = array();
    
    	while ($row = pg_fetch_object($query)) {
    		$resultSet[]=$row;
    	}
    	return $resultSet;
    }    
    
    
    public function getById($id){
    	
    	$query=pg_query($this->con, "SELECT * FROM $this->table WHERE id=$id");
        $resultSet = array();
    	
           while ($row = pg_fetch_object($query)) {
             $resultSet[]=$row;
           }
        return $resultSet;
    }
    
    public function getBy($where){
    	
    	$query=pg_query($this->con, "SELECT * FROM $this->table WHERE   $where ");
        $resultSet = array();
    	
           while ($row = pg_fetch_object($query)) {
             $resultSet[]=$row;
           }
        return $resultSet;
    }
    
    public function deleteById($id){
    	
        $query=pg_query($this->con,"DELETE FROM $this->table WHERE $id"); 
        return $query;
    }
    
    public function deleteBy($column,$value){

    	try 
    	{
    		$query=pg_query($this->con,"DELETE FROM $this->table WHERE $column='$value' ");
    	}
    	catch (Exeption $Ex)
    	{
    		
    		
    	} 
    	
        return $query;
    }
    

    public function getCondiciones($columnas ,$tablas , $where, $id){
    	
    	$query=pg_query($this->con, "SELECT $columnas FROM $tablas WHERE $where ORDER BY $id  ASC");
    	$resultSet = array();
    	while ($row = pg_fetch_object($query)) {
    		$resultSet[]=$row;
    	}
    
    	return $resultSet;
    }
    
    public function getCondicionesValorMayor($columnas ,$tablas , $where){
    	 
    	$query=pg_query($this->con, "SELECT $columnas FROM $tablas WHERE $where");
    	$resultSet = array();
    	while ($row = pg_fetch_object($query)) {
    		$resultSet[]=$row;
    	}
    
    	return $resultSet;
    }
    
    
    
    public function getCondicionesDesc($columnas ,$tablas , $where, $id){
    	 
    	$query=pg_query($this->con, "SELECT $columnas FROM $tablas WHERE $where ORDER BY $id  DESC");
    	$resultSet = array();
    	while ($row = pg_fetch_object($query)) {
    		$resultSet[]=$row;
    	}
    
    	return $resultSet;
    }
   
    
    public function getCondiciones_grupo($columnas ,$tablas , $where, $grupo, $id){
    	 
    	$query=pg_query($this->con, "SELECT $columnas FROM $tablas WHERE $where GROUP BY $grupo ORDER BY $id  ASC");
    	$resultSet = array();
    	while ($row = pg_fetch_object($query)) {
    		$resultSet[]=$row;
    	}
    
    	return $resultSet;
    }
  
    public function getCondicionesPag($columnas ,$tablas , $where, $id, $limit){
    	 
    	$query=pg_query($this->con, "SELECT $columnas FROM $tablas WHERE $where ORDER BY $id  ASC  $limit");
    	$resultSet = array();
    	while ($row = pg_fetch_object($query)) {
    		$resultSet[]=$row;
    	}
    
    	return $resultSet;
    }
    
    
    public function getCondicionesPagDesc($columnas ,$tablas , $where, $id, $limit){
    
    	$query=pg_query($this->con, "SELECT $columnas FROM $tablas WHERE $where ORDER BY $id  DESC  $limit");
    	$resultSet = array();
    	while ($row = pg_fetch_object($query)) {
    		$resultSet[]=$row;
    	}
    
    	return $resultSet;
    }
    
    public function UpdateBy($colval ,$tabla , $where){
    	try 
    	{ 
    	     $query=pg_query($this->con, "UPDATE $tabla SET  $colval   WHERE $where ");
    	     
    	}
    	catch (Exeption  $Ex)
    	{
    		
    		
    	}
    }
    
    
    
    public function getByPDF($columnas, $tabla , $where){
    
    	if ($tabla == "")
    	{
    		$query=pg_query($this->con, "SELECT $columnas FROM $this->table WHERE   $where ");
    	}
    	else
    	{
    		$query=pg_query($this->con, "SELECT $columnas FROM $tabla WHERE   $where ");
    	}
    	
    	return $query;
    }
    
    public function getCondicionesPDF($columnas ,$tablas , $where, $id){
    	 
    	$query=pg_query($this->con, "SELECT $columnas FROM $tablas WHERE $where ORDER BY $id  ASC");
    
    	return $query;
    }
    
    
    
    /*
     * Aqui podemos montarnos un monton de métodos que nos ayuden
     * a hacer operaciones con la base de datos de la entidad
     */
    
    public function encriptar($cadena){
    	$key='rominajasonrosabal';  // Una clave de codificacion, debe usarse la misma para encriptar y desencriptar
    	$encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $cadena, MCRYPT_MODE_CBC, md5(md5($key))));
    	return $encrypted; //Devuelve el string encriptado
    
    }
    
    public function desencriptar($cadena){
    	$key='rominajasonrosabal';  // Una clave de codificacion, debe usarse la misma para encriptar y desencriptar
    	$decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($cadena), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
    	return $decrypted;  //Devuelve el string desencriptado
    }
    
    public function registrarSesion($id_usuarios, $usuario_usuarios, $id_rol, $nombre_usuarios, $apellido_usuarios, $correo_usuarios, $ip_usuarios, $cedula_usuarios)
    {
    	session_start();
    	$_SESSION["cedula_usuarios"]=$cedula_usuarios;
    	$_SESSION["id_usuarios"]=$id_usuarios;
    	$_SESSION["usuario_usuarios"]=$usuario_usuarios;
    	$_SESSION["id_rol"]=$id_rol;
    	$_SESSION["nombre_usuarios"]=$nombre_usuarios;
    	$_SESSION["apellidos_usuarios"]=$apellido_usuarios;
    	$_SESSION["correo_usuarios"]=$correo_usuarios;
    	$_SESSION["ip_usuarios"]=$ip_usuarios; 	

    	if (substr($ip_usuarios, 0, 3) == "192" )
    	{
    		$_SESSION["tipo_usuario"]="usuario_local";
    	}
    	else   ///usuarios externo 
    	{
    		
    		$_SESSION["tipo_usuario"]="usuario_externo";
    	}
    		
    	
    }
    
    
    
    public function registrarSesionParticipe($cedula_participe)
    {
    	
    	$_SESSION["cedula_participe"]=$cedula_participe;
    	
    	 
    }
    
    
    public function getPermisosVer($where){
    	 
    	$query=pg_query($this->con, "SELECT permisos_rol.ver_permisos_rol FROM public.controladores, public.permisos_rol WHERE  controladores.id_controladores = permisos_rol.id_controladores AND  ver_permisos_rol = 'TRUE'   AND   $where ");
    	$resultSet = array();
    	while ($row = pg_fetch_object($query)) {
    		$resultSet[]=$row;
    	}
    
    	return $resultSet;
    }

    
    public function getPermisosEditar($where){
    
    	$query=pg_query($this->con, "SELECT permisos_rol.editar_permisos_rol FROM public.controladores, public.permisos_rol WHERE  controladores.id_controladores = permisos_rol.id_controladores AND  editar_permisos_rol = 'TRUE'   AND   $where ");
    	$resultSet = array();
    	while ($row = pg_fetch_object($query)) {
    		$resultSet[]=$row;
    	}
    
    	return $resultSet;
    }
    

    public function getPermisosBorrar($where){
    
    	$query=pg_query($this->con, "SELECT permisos_rol.borrar_permisos_rol FROM public.controladores, public.permisos_rol WHERE  controladores.id_controladores = permisos_rol.id_controladores AND  borrar_permisos_rol = 'TRUE'   AND   $where ");
    	$resultSet = array();
    	while ($row = pg_fetch_object($query)) {
    		$resultSet[]=$row;
    	}
    
    	return $resultSet;
    }
    
    
    
    
    public function  EnviarMailSolCred($correo_participe, $id_usuario, $_nombres_solicitante_datos_personales, $_apellidos_solicitante_datos_personales){
    	
    	$usuarios = new UsuariosModel();
    	$where = "id_usuarios = '$id_usuario'";
    	$resultUsu = $usuarios->getBy($where);
    	
    	if(!empty($resultUsu))
    	{
    	
    		foreach ($resultUsu as $res){
    	
    			$correo_usuario   =$res->correo_usuarios;
    			$nombre_usuario   = $res->nombre_usuarios;
    		}
    	
    		$cabeceras = "MIME-Version: 1.0 \r\n";
    		$cabeceras .= "Content-type: text/html; charset=utf-8 \r\n";
    		$cabeceras .= "From: $correo_usuario \r\n";
    		$destino="$correo_participe";
    		$asunto="Solicitud de Prestamo (Capremci)";
    		$fecha=date("d/m/y");
    		$hora=date("H:i:s");
    		
    		
    		$resumen="
    		<table rules='all'>
    		<tr><td WIDTH='1000' HEIGHT='50'><center><img src='http://186.4.157.125:80/webcapremci/view/images/bcaprem.png' WIDTH='300' HEIGHT='120'/></center></td></tr>
    		</tabla>
    		<p><table rules='all'></p>
    		<tr style='background: #FFFFFF;'><td  WIDTH='1000' align='center'><b>Estimado Participe $_apellidos_solicitante_datos_personales $_nombres_solicitante_datos_personales</b></td></tr></p>
    		<tr style='background: #FFFFFF;'><td  WIDTH='1000' align='justify'>Envieme la siguiente información para agilizar el proceso de su solicitud de prestamo.</td></tr>
    		</tabla>
    		
    		<p><table rules='all'></p>
    		<tr style='background: #FFFFFF;'><td WIDTH='1000' > <b>1.-</b> 3 últimos roles de pago firmados por su entidad pagadora.</td></tr>
    		<tr style='background: #FFFFFF;'><td WIDTH='1000' > <b>2.-</b> Certificado de tiempo de servicio.</td></tr>
    		<tr style='background: #FFFFFF;'><td WIDTH='1000' > <b>3.-</b> Copia de cédula y papeleta de votación (4 febrero 2018).</td></tr>
    		<tr style='background: #FFFFFF;'><td WIDTH='1000' > <b>4.-</b> Copia planilla de servicio básico (Actualizada).</td></tr>
    		<tr style='background: #FFFFFF;'><td WIDTH='1000' > <b>5.-</b> Copia de libreta de ahorros.</td></tr>
    		</tabla>
    		
    		
    		<p><table rules='all'></p>
    		<tr style='background: #FFFFFF'><td WIDTH='1000' align='center'><b> TU OFICIAL DE CRÉDITO ASIGNADO ES: </b></td></tr>
    		<tr style='background: #FFFFFF;'><td WIDTH='1000' > <b>Nombre:</b> $nombre_usuario</td></tr>
    		<tr style='background: #FFFFFF;'><td WIDTH='1000' > <b>Correo:</b> $correo_usuario </td></tr>
    		</tabla>
    		<p><table rules='all'></p>
    		<tr style='background:#1C1C1C'><td WIDTH='1000' HEIGHT='50' align='center'><font color='white'>Capremci - <a href='http://www.capremci.com.ec'><FONT COLOR='#7acb5a'>www.capremci.com.ec</FONT></a> - Copyright © 2018-</font></td></tr>
    		</table>
    		";
    		
    		mail("$destino","Solicitud de Prestamo (Capremci)","$resumen","$cabeceras");
    		
    			
    	}
    	
    	
    }
    
    
    
    
    
    
    
    
    
    
    
    public function AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador,$id_usario=null)
    {
    
    
    	$traza=new TrazasModel();
    	$funcion = "ins_trazas";
    	$_id_usuarios="";
    
    	if(is_null($id_usario)){
    	$_id_usuarios=$_SESSION['id_usuarios'];
    	}else{
    	$_id_usuarios=$id_usario;
    	}
    	
    	$parametros = "'$_id_usuarios', '$_accion_trazas', '$_parametros_trazas', '$_nombre_controlador'  ";
    	$traza->setFuncion($funcion);
    	$traza->setParametros($parametros);
    	$resultadoT=$traza->Insert();
    
    }
    
    
    
    public function  Inser_Tipo_Notificaciones($descripcion_notificacion, $id_impulsor, $id_secretario){
    	 
    	$cantidad_notificacion=1;
    	$tipo_notificaciones = new TipoNotificacionModel();
    	$funcion = "ins_tipo_notificaciones_liventy";
    	$parametros = "'$descripcion_notificacion', '$cantidad_notificacion', '$id_impulsor', '$id_secretario'  ";
    	$tipo_notificaciones->setFuncion($funcion);
    	$tipo_notificaciones->setParametros($parametros);
    	$resultadoT=$tipo_notificaciones->Insert();
    	 
    }
    
    public function  Inser_Notificaciones($id_juicios, $id_tipo_notificaciones, $nombre_documentos){
    	
    	$notificaciones = new NotificacionesModel();
    	$funcion = "ins_notificaciones_liventy";
    	$parametros = "'$id_juicios', '$id_tipo_notificaciones', '$nombre_documentos'";
    	$notificaciones->setFuncion($funcion);
    	$notificaciones->setParametros($parametros);
    	$resultadoT=$notificaciones->Insert();
    }
    
    
    
    
 
  

    
    
    
    
    //funciones  de notificaciones anterior
    function verNotificaciones(){
    	//session_start();
    	$id_usuario=$_SESSION['id_usuarios'];
    	$notificaciones=new NotificacionesModel();
    	$where_notificacion = " id_usuarios = '$id_usuario' AND visto_notificaciones=false";
    	$result_notificaciones=$notificaciones->getBy($where_notificacion);
    	
    	return $result_notificaciones;
    }
    
	public function InsertaNotificaciones($id_tipo_notificacion ,$id_usuarios_dirigido_notificacion, $descripcion_notificaciones )
    {
    
    
    	$notificaciones=new NotificacionesModel();
    	
    	$usuarios = new UsuariosModel();
    		
    	$funcion = "ins_notificaciones";
    
    	$id_usuarios=$_SESSION['id_usuarios'];
    	
    	$resultUsuario=$usuarios->getBy("id_usuarios='$id_usuarios'");
    	
    	$descripcion_notificaciones.=" (".$resultUsuario[0]->usuario_usuarios.")";
    
    	
    	$parametros = "'$id_tipo_notificacion','$id_usuarios_dirigido_notificacion', '$descripcion_notificaciones'";
    	
    	    
    	$notificaciones->setFuncion($funcion);
    		
    	$notificaciones->setParametros($parametros);
    		
    	$resultadoN=$notificaciones->Insert();
    	
    
    }
    //termina funciones anteriores notificaciones
    
    
    
    
    
    
    
    public function MostrarNotificaciones($id_usuario)
    {
    	//session_start();
    	 /*
    	$notificaciones= new NotificacionesModel();
    	 
    	$columnas=" notificaciones.id_notificaciones,
			  notificaciones.descripcion_notificaciones,
			  notificaciones.usuario_destino_notificaciones,
			  notificaciones.usuario_origen_notificaciones,
			  notificaciones.numero_movimiento_notificaciones,
			  notificaciones.cantidad_cartones_notificaciones,
    		  notificaciones.creado,
    		  usuarios.id_usuarios,
			  usuarios.usuario_usuarios,
			  usuarios.nombre_usuarios,
			  notificaciones.visto_notificaciones,
			  tipo_notificacion.controlador_tipo_notificacion,
			  tipo_notificacion.accion_tipo_notificacion,
    		  tipo_notificacion.descripcion_notificacion";
    	 
    	$tablas=" public.notificaciones,
				  public.usuarios,
				  public.tipo_notificacion";
    	 
    	$where="notificaciones.usuario_origen_notificaciones = usuarios.id_usuarios AND
    	tipo_notificacion.id_tipo_notificacion = notificaciones.id_tipo_notificacion
    	AND  notificaciones.visto_notificaciones='FALSE'
    	AND notificaciones.usuario_destino_notificaciones='$id_usuario'";
    	 
    	$resultNotificaciones=$notificaciones->getCondiciones($columnas, $tablas, $where, "notificaciones.id_notificaciones");
    	 
    	$cantidad_notificaciones=count($resultNotificaciones);
    	 
    	 
    	if($cantidad_notificaciones<0)
    	{
    		$cantidad_notificaciones=0;
    		$resultNotificaciones=array();
    	}
    	
    	$contar=array();
    	$result=array();
    	 
    	foreach($resultNotificaciones as $linea=>$value)
    	{
    		
    		 
    		if(isset($contar[$value->descripcion_notificacion]))
    		{
    			 
    			$contar[$value->descripcion_notificacion]+=1;
    			
    			
    		}else{
    			 
    			array_push($result, $resultNotificaciones[$linea]);
    			 
    			$contar[$value->descripcion_notificacion]=1;
    			
    			
    		}
    		
    		
    		 
    	}
    	 
    	
    	$_SESSION['cantidad']=$cantidad_notificaciones;
    	$_SESSION["resultNotificaciones"]=$result;
    	$_SESSION["cantidad_fila_notificaciones"]=$contar;
    	*/
    }
    
    
    public  function CrearNotificacion($id_tipoNotificacion,$usuarioDestino,$descripcion,$numero_movimiento,$cantidad_cartones)
    {
    	$notificaciones = new NotificacionesModel();
    	 
    	$funcion = "ins_notificaciones";
    	 
    	$_usuario_origen=$_SESSION['id_usuarios'];
    	 
    
    	$parametros = "'$id_tipoNotificacion', '$_usuario_origen', '$usuarioDestino', '$descripcion','$numero_movimiento','$cantidad_cartones' ";
    	 
    	$notificaciones->setFuncion($funcion);
    	 
    	$notificaciones->setParametros($parametros);
    	 
    	$resultadoT=$notificaciones->Insert();
    }
    
    
    public function MenuDinamico($_id_rol)
    {
    	$resultPermisos=array();
    	$perimisos_rol = new PermisosRolesModel();
    	 
    	$columnas="controladores.nombre_controladores,
				  permisos_rol.id_rol,
				  permisos_rol.ver_permisos_rol";
    	 
    	$tablas="public.permisos_rol,
  				 public.controladores";
    	 
    	$where="controladores.id_controladores = permisos_rol.id_controladores
    	AND permisos_rol.ver_permisos_rol=TRUE AND permisos_rol.id_rol='$_id_rol'";
    	 
    	$id="controladores.id_controladores";
    	 
    	$resultPermisos = $perimisos_rol->getCondiciones($columnas, $tablas, $where, $id);
    	 
    	$_SESSION['controladores']=$resultPermisos;
    }
    
   
    
}
?>
