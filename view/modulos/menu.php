
<?php 
$controladores=$_SESSION['controladores'];
 function getcontrolador($controlador,$controladores){
 	$display="display:none";
 	
 	if (!empty($controladores))
 	{
 	foreach ($controladores as $res)
 	{
 		if($res->nombre_controladores==$controlador)
 		{
 			$display= "display:block";
 			break;
 			
 		}
 	}
 	}
 	
 	return $display;
 }
 
?>








<ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
       
        <li class="treeview"  style="<?php echo getcontrolador("MenuAdministracion",$controladores) ?>"  >
          <a href="#">
            <i class="fa fa-folder"></i> <span>Administración</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li style="<?php echo getcontrolador("Usuarios",$controladores) ?>"><a href="index.php?controller=Usuarios&action=index"><i class="fa fa-circle-o"></i> Usuarios</a></li>
            <li style="<?php echo getcontrolador("Controladores",$controladores) ?>"><a href="index.php?controller=Controladores&action=index"><i class="fa fa-circle-o"></i> Controladores</a></li>
            <li style="<?php echo getcontrolador("Roles",$controladores) ?>"><a href="index.php?controller=Roles&action=index"><i class="fa fa-circle-o"></i> Roles de Usuario</a></li>
            <li style="<?php echo getcontrolador("PermisosRoles",$controladores) ?>"><a href="index.php?controller=PermisosRoles&action=index"><i class="fa fa-circle-o"></i> Permisos Roles</a></li>
            <li style="<?php echo getcontrolador("Estado",$controladores) ?>"><a href="index.php?controller=Estado&action=index"><i class="fa fa-circle-o"></i> Estado</a></li>
            <li style="<?php echo getcontrolador("Privilegios",$controladores) ?>"><a href="index.php?controller=Privilegios&action=index"><i class="fa fa-circle-o"></i> Privilegios</a></li>
            <li style="<?php echo getcontrolador("Actividades",$controladores) ?>"><a href="index.php?controller=Actividades&action=index"><i class="fa fa-circle-o"></i> Actividades</a></li>

            
          </ul>
        </li>
        
        
         <li class="treeview"  style="<?php echo getcontrolador("MenuInventario",$controladores) ?>"  >
          <a href="#">
            <i class="fa fa-folder"></i> <span>Inventario</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li style="<?php echo getcontrolador("Grupos",$controladores) ?>"><a href="index.php?controller=Grupos&action=index"><i class="fa fa-circle-o"></i> Grupos</a></li>
    	     <li style="<?php echo getcontrolador("Productos",$controladores) ?>"><a href="index.php?controller=Productos&action=index"><i class="fa fa-circle-o"></i> Productos</a></li>
  			<li style="<?php echo getcontrolador("Bodegas",$controladores) ?>"><a href="index.php?controller=Bodegas&action=index"><i class="fa fa-circle-o"></i> Bodegas</a></li>
  			  <li style="<?php echo getcontrolador("SolicitudCabeza",$controladores) ?>"><a href="index.php?controller=SolicitudCabeza&action=index"><i class="fa fa-circle-o"></i> Movimientos Productos Cabeza</a></li>
			<li style="<?php echo getcontrolador("Productos",$controladores) ?>"><a href="index.php?controller=Productos&action=consulta"><i class="fa fa-circle-o"></i> Consulta Productos</a></li>
			<li style="<?php echo getcontrolador("Proveedores",$controladores) ?>"><a href="index.php?controller=Proveedores&action=index"><i class="fa fa-circle-o"></i> Proveedores</a></li>
			<li style="<?php echo getcontrolador("Productos",$controladores) ?>"><a href="index.php?controller=MovimientosInv&action=compras"><i class="fa fa-circle-o"></i>Compras</a></li>

          </ul>
        </li>
        
       
       
      </ul>









