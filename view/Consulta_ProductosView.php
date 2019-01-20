    
<!DOCTYPE HTML>
<html lang="es">
      <head>
         
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Capremci</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
 
   <?php include("view/modulos/links_css.php"); ?>
   

        
			        
    </head>
    
    
    <body class="hold-transition skin-blue fixed sidebar-mini"  >
    

     <?php
        
        $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha=$dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
        ?>
    
    
      
    
    <div class="wrapper">

  <header class="main-header">
  
      <?php include("view/modulos/logo.php"); ?>
      <?php include("view/modulos/head.php"); ?>	
    
  </header>

   <aside class="main-sidebar">
    <section class="sidebar">
     <?php include("view/modulos/menu_profile.php"); ?>
      <br>
     <?php include("view/modulos/menu.php"); ?>
    </section>
  </aside>

  <div class="content-wrapper">
  
  <section class="content-header">
      <h1>
        
        <small><?php echo $fecha; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $helper->url("Consulta de Productos","Bienvenida"); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Consulta de Productos</li>
      </ol>
    </section>   
    
     <section class="content">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Consultar Productos</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            
          </div>
        </div>
        
        <div class="box-body">
        
       <form action="<?php echo $helper->url("Productos","consulta"); ?></form>

        
        
       <div class="ibox-content">  
      <div class="table-responsive">
        
	                
                    <table  class="table table-striped  dataTables-example">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Grupos</th>
                          <th>Código</th>
                          <th>Marca</th>
                          <th>Nombre</th>
                           <th>Descripcion</th>
                          <th>Unidad De M.</th>
                          <th>ULT Precio</th>
                          <th></th>
                          <th>Consultar</th>
                        

                        </tr>
                      </thead>

                      <tbody>
    					<?php $i=0;?>
    						<?php if (!empty($resultSet)) {  foreach($resultSet as $res) {?>
    						<?php $i++;?>
            	        		<tr>
            	                   <td > <?php echo $i; ?>  </td>
            		               <td > <?php echo $res->nombre_grupos; ?>     </td> 
            		               <td > <?php echo $res->codigo_productos; ?>   </td>
            		               <td > <?php echo $res->marca_productos; ?>   </td>
            		               <td > <?php echo $res->nombre_productos; ?>   </td>
            		               <td > <?php echo $res->descripcion_productos; ?>   </td>
            		               <td > <?php echo $res->nombre_unidad_medida; ?>   </td>
            		               <td > <?php echo $res->ult_precio_productos; ?>   </td>
            		              </td>
            			             <td> 
            		           	   <td>
            		           	   
            		           	   
            			           		<div class="right">
            			                    <a href="<?php echo $helper->url("Productos","consulta"); ?>&id_productos=<?php echo $res->id_productos; ?>" class="btn btn-info" style="font-size:65%;" data-toggle="tooltip" title="Consultar"><i class='glyphicon glyphicon-edit'></i></a>
            			                </div>
            			            
            			               
            			                	
            			                
            		               </td>
            		    		</tr>
            		    		
            		        <?php } } ?>
                    	
    					                    				  	

                      </tbody>
                    </table>
       
        </div>
         </div>
        
        
        </div>
        </div>
        </section>
        
        
        
        
        
        <?php if(!empty($resultEdit)){?>
            
            
         <section class="content">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Consultar Productos</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            
          </div>
        </div>
        
        <div class="box-body">
        
       
        
       <div class="ibox-content">  
      <div class="table-responsive">
        
	                
                    <table  class="table table-striped  dataTables-example">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Código</th>
                          <th>Marca</th>
                          <th>Nombre</th>
                           <th>Descripcion</th>
                          <th>Unidad De M.</th>
                          <th>ULT Precio</th>
                          <th>Cantidad</th>
                          <th>Saldo_f</th>
                          <th>Saldo_v</th>
                          <th>Número</th>
                          <th>Razón</th>
                          <th>Fecha</th>
                          <th>Cantidad Cab.</th>
                          <th>Importe</th>
                          <th>Número Factura</th>
                          <th>Número Autorizacion</th>
                          <th>Subtotal 12%</th>
                          <th>iva</th>
                          <th>Subtotal 0%</th>
                          <th>Descuento</th>
                          <th>Estado</th>
                          <th>Cédula</th>
                          <th>Nombre</th>
                          <th>Apellido</th>
                          <th>Usuario</th>
                          <th></th>
                          <th></th>
                        

                        </tr>
                      </thead>

                      <tbody>
    					<?php $i=0;?>
    						<?php if (!empty($resultEdit)) {  foreach($resultEdit as $res) {?>
    						<?php $i++;?>
            	        		<tr>
            	                   <td > <?php echo $i; ?>  </td>
            		               <td > <?php echo $res->codigo_productos; ?>   </td>
            		               <td > <?php echo $res->marca_productos; ?>   </td>
            		               <td > <?php echo $res->nombre_productos; ?>   </td>
            		               <td > <?php echo $res->descripcion_productos; ?>   </td>
            		               <td > <?php echo $res->nombre_unidad_medida; ?>   </td>
            		               <td > <?php echo $res->ult_precio_productos; ?>   </td>
            		               <td > <?php echo $res->cantidad_movimientos_inv_detalle; ?>   </td>
            		               <td > <?php echo $res->saldo_f_movimientos_inv_detalle; ?>   </td>
            		               <td > <?php echo $res->saldo_v_movimientos_inv_detalle; ?>   </td>
            		               <td > <?php echo $res->numero_movimientos_inv_cabeza; ?>   </td>
            		               <td > <?php echo $res->razon_movimientos_inv_cabeza; ?>   </td>
            		               <td > <?php echo $res->fecha_movimientos_inv_cabeza; ?>   </td>
            		               <td > <?php echo $res->cantidad_movimientos_inv_cabeza; ?>   </td>
            		               <td > <?php echo $res->importe_movimientos_inv_cabeza; ?>   </td>
            		               <td > <?php echo $res->numero_factura_movimientos_inv_cabeza; ?>   </td>
            		               <td > <?php echo $res->numero_autorizacion_movimientos_inv_cabeza; ?>   </td>
            		               <td > <?php echo $res->subtotal_doce_movimientos_inv_cabeza; ?>   </td>
            		               <td > <?php echo $res->iva_movimientos_inv_cabeza; ?>   </td>
            		               <td > <?php echo $res->subtotal_cero_movimientos_inv_cabeza; ?>   </td>
            		               <td > <?php echo $res->descuento_movimientos_inv_cabeza; ?>   </td>
            		               <td > <?php echo $res->estado_movimientos_inv_cabeza; ?>   </td>
            		               <td > <?php echo $res->cedula_usuarios; ?>   </td>
            		               <td > <?php echo $res->nombre_usuarios; ?>   </td>
            		               <td > <?php echo $res->apellidos_usuarios; ?>   </td>
            		               <td > <?php echo $res->usuario_usuarios; ?>   </td>
            		              
            			           <td></td>  
            		           	   <td></td>
            		    		</tr>
            		    		
            		        <?php } } ?>
                    	
    					                    				  	

                      </tbody>
                    </table>
       
        </div>
         </div>
        
        
        </div>
        </div>
        </section>    
            
            
            
            
            
            
            
        <?php }?>
        
         
        
        
       
    
  </div>
 
 	<?php include("view/modulos/footer.php"); ?>	

   <div class="control-sidebar-bg"></div>
 </div>
    
    <?php include("view/modulos/links_js.php"); ?>
	

       
       

 	
	
	
  </body>
</html>   

    