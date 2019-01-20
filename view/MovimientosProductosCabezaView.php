<!DOCTYPE html>
<html lang="en">
  <head>
  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Capremci</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    
    
   <?php include("view/modulos/links_css.php"); ?>
   
  </head>

  <body class="hold-transition skin-blue fixed sidebar-mini">   
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
            <li><a href="<?php echo $helper->url("Usuarios","Bienvenida"); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Grupos</li>
          </ol>
        </section>
        
        <section class="content">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Registrar Movimientos Productos Cabeza</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                
              </div>
            </div>
            
            <div class="box-body">
            
                <form action="<?php echo $helper->url("MovimientosProductosCabeza","InsertaMovimientosProductosCabeza"); ?>" method="post" class="col-lg-12 col-md-12 col-xs-12">
          		 	 <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
              		 	 <div class="row">
                         	<div class="col-xs-12 col-md-3 col-md-3 ">
                            	<div class="form-group">
                                	<label for="fecha_movimientos_productos_cabeza" class="control-label">Fecha</label>
                                    <input type="text" class="form-control" id="fecha_movimientos_productos_cabeza" name="fecha_movimientos_productos_cabeza" value="<?php echo $resEdit->fecha_movimientos_productos_cabeza; ?>"  placeholder="Fecha">
                                    <input type="hidden" name="id_movimientos_productos_cabeza" id="id_movimientos_productos_cabeza" value="<?php echo $resEdit->id_movimientos_productos_cabeza; ?>" class="form-control"/>
    					            <div id="mensaje_fecha_movimientos_productos_cabeza" class="errores"></div>
                                 </div>
                             </div>
                             <div class="col-xs-12 col-md-3 col-md-3 ">
                            	<div class="form-group">
                                	<label for="numero_factura_movimientos_productos_cabeza" class="control-label">Numero de Factura</label>
                                    <input type="text" class="form-control" id="numero_factura_movimientos_productos_cabeza" name="numero_factura_movimientos_productos_cabeza" value="<?php echo $resEdit->numero_factura_movimientos_productos_cabeza; ?>"  placeholder="Numero Factura">
                                    <input type="hidden" name="id_movimientos_productos_cabeza" id="id_movimientos_productos_cabeza" value="<?php echo $resEdit->id_movimientos_productos_cabeza; ?>" class="form-control"/>
    					            <div id="mensaje_nombre_grupos" class="errores"></div>
                                 </div>
                             </div>
                             <div class="col-xs-12 col-md-3 col-md-3 ">
                            	<div class="form-group">
                                	<label for="numero_autorizacion_movimientos_productos_cabeza" class="control-label">Numero Autorizacion</label>
                                    <input type="text" class="form-control" id="numero_autorizacion_movimientos_productos_cabeza" name="numero_autorizacion_movimientos_productos_cabeza" value="<?php echo $resEdit->numero_autorizacion_movimientos_productos_cabeza; ?>"  placeholder="Numero Autorizacion">
                                    <input type="hidden" name="id_movimientos_productos_cabeza" id="id_movimientos_productos_cabeza" value="<?php echo $resEdit->id_movimientos_productos_cabeza; ?>" class="form-control"/>
    					            <div id="mensaje_numero_autorizacion_movimientos_productos_cabeza" class="errores"></div>
                                 </div>
                             </div>
                             <div class="col-xs-12 col-md-3 col-md-3 ">
                            	<div class="form-group">
                                	<label for="importe_movimientos_productos_cabeza" class="control-label">Importe</label>
                                    <input type="text" class="form-control" id="importe_movimientos_productos_cabeza" name="importe_movimientos_productos_cabeza" value="<?php echo $resEdit->importe_movimientos_productos_cabeza; ?>"  placeholder="Importe">
                                    <input type="hidden" name="id_movimientos_productos_cabeza" id="id_movimientos_productos_cabeza" value="<?php echo $resEdit->id_movimientos_productos_cabeza; ?>" class="form-control"/>
    					            <div id="mensaje_importe_movimientos_productos_cabeza" class="errores"></div>
                                 </div>
                             </div>
                            </div>
                             <div class="row">
                         	<div class="col-xs-12 col-md-3 col-md-3 ">
                            	<div class="form-group">
                                	<label for="cantidad_total_movimientos_productos_cabeza" class="control-label">Cantidad Total</label>
                                    <input type="text" class="form-control" id="cantidad_total_movimientos_productos_cabeza" name="cantidad_total_movimientos_productos_cabeza" value="<?php echo $resEdit->cantidad_total_movimientos_productos_cabeza; ?>"  placeholder="Cantidad">
                                    <input type="hidden" name="id_movimientos_productos_cabeza" id="id_movimientos_productos_cabeza" value="<?php echo $resEdit->id_movimientos_productos_cabeza; ?>" class="form-control"/>
    					            <div id="mensaje_cantidad_total_movimientos_productos_cabeza" class="errores"></div>
                                 </div>
                             </div>
                             <div class="col-xs-12 col-md-3 col-md-3 ">
                            	<div class="form-group">
                                	<label for="subtotal_doce_movimientos_productos_cabeza" class="control-label">Subtotal 12</label>
                                    <input type="text" class="form-control" id="subtotal_doce_movimientos_productos_cabeza" name="subtotal_doce_movimientos_productos_cabeza" value="<?php echo $resEdit->subtotal_doce_movimientos_productos_cabeza; ?>"  placeholder="Subtotal 12">
                                    <input type="hidden" name="id_movimientos_productos_cabeza" id="id_movimientos_productos_cabeza" value="<?php echo $resEdit->id_movimientos_productos_cabeza; ?>" class="form-control"/>
    					            <div id="mensaje_subtotal_doce_movimientos_productos_cabeza" class="errores"></div>
                                 </div>
                             </div>
                             <div class="col-xs-12 col-md-3 col-md-3 ">
                            	<div class="form-group">
                                	<label for="iva_movimientos_productos_cabeza" class="control-label">Iva</label>
                                    <input type="text" class="form-control" id="iva_movimientos_productos_cabeza" name="iva_movimientos_productos_cabeza" value="<?php echo $resEdit->iva_movimientos_productos_cabeza; ?>"  placeholder="Iva">
                                    <input type="hidden" name="id_movimientos_productos_cabeza" id="id_movimientos_productos_cabeza" value="<?php echo $resEdit->id_movimientos_productos_cabeza; ?>" class="form-control"/>
    					            <div id="mensaje_iva_movimientos_productos_cabeza" class="errores"></div>
                                 </div>
                             </div>
                              <div class="col-xs-12 col-md-3 col-md-3 ">
                            	<div class="form-group">
                                	<label for="valor_total_movimientos_productos_cabeza" class="control-label">Valor Total</label>
                                    <input type="text" class="form-control" id="valor_total_movimientos_productos_cabeza" name="valor_total_movimientos_productos_cabeza" value="<?php echo $resEdit->valor_total_movimientos_productos_cabeza; ?>"  placeholder="Valor Total">
                                    <input type="hidden" name="id_movimientos_productos_cabeza" id="id_movimientos_productos_cabeza" value="<?php echo $resEdit->id_movimientos_productos_cabeza; ?>" class="form-control"/>
    					            <div id="mensaje_valor_total_movimientos_productos_cabeza" class="errores"></div>
                                 </div>
                             </div>
                               
                              </div>
                                 <div class="row">
                                    <div class="col-xs-12 col-md-3 col-md-3 ">
                            	<div class="form-group">
                                	<label for="subtotal_cero_movimientos_productos_cabeza" class="control-label">Subtotal 0</label>
                                    <input type="text" class="form-control" id="subtotal_cero_movimientos_productos_cabeza" name="subtotal_cero_movimientos_productos_cabeza" value="<?php echo $resEdit->subtotal_cero_movimientos_productos_cabeza; ?>"  placeholder="Subtotal 0">
                                    <input type="hidden" name="id_movimientos_productos_cabeza" id="id_movimientos_productos_cabeza" value="<?php echo $resEdit->id_movimientos_productos_cabeza; ?>" class="form-control"/>
    					            <div id="mensaje_subtotal_cero_movimientos_productos_cabeza" class="errores"></div>
                                 </div>
                             </div>
                        
                         	<div class="col-xs-12 col-md-3 col-md-3 ">
                            	<div class="form-group">
                                	<label for="descuento_movimientos_productos_cabeza" class="control-label">Descuento</label>
                                    <input type="text" class="form-control" id="descuento_movimientos_productos_cabeza" name="descuento_movimientos_productos_cabeza" value="<?php echo $resEdit->descuento_movimientos_productos_cabeza; ?>"  placeholder="descuento">
                                    <input type="hidden" name="id_movimientos_productos_cabeza" id="id_movimientos_productos_cabeza" value="<?php echo $resEdit->id_movimientos_productos_cabeza; ?>" class="form-control"/>
    					            <div id="mensaje_descuento_movimientos_productos_cabeza" class="errores"></div>
                                 </div>
                             </div>
                             <div class="col-xs-12 col-md-3 col-md-3 ">
                            	<div class="form-group">
                                	<label for="id_tipo_documento" class="control-label">Tipo Documento</label>
                                    <input type="text" class="form-control" id="id_tipo_documento" name="id_tipo_documento" value="<?php echo $resEdit->id_tipo_documento; ?>"  placeholder="Tipo Documento">
                                    <input type="hidden" name="id_movimientos_productos_cabeza" id="id_movimientos_productos_cabeza" value="<?php echo $resEdit->id_movimientos_productos_cabeza; ?>" class="form-control"/>
    					            <div id="mensaje_id_tipo_documento" class="errores"></div>
                                 </div>
                             </div>
                             <div class="col-xs-12 col-md-3 col-md-3 ">
                            	<div class="form-group">
                                	<label for="id_proveedor" class="control-label">Proveedor</label>
                                    <input type="text" class="form-control" id="id_proveedor" name="id_proveedor" value="<?php echo $resEdit->id_proveedor; ?>"  placeholder="Proveedor">
                                    <input type="hidden" name="id_movimientos_productos_cabeza" id="id_movimientos_productos_cabeza" value="<?php echo $resEdit->id_movimientos_productos_cabeza; ?>" class="form-control"/>
    					            <div id="mensaje_id_proveedor" class="errores"></div>
                                 </div>
                             </div>
                             </div>
                             <div class="row">
                               <div class="col-xs-12 col-md-3 col-md-3 ">
                            	<div class="form-group">
                                	<label for="id_usuario_salida" class="control-label">Usuario Salida</label>
                                    <input type="text" class="form-control" id="id_usuario_salida" name="id_usuario_salida" value="<?php echo $resEdit->id_usuario_salida; ?>"  placeholder="Usuario Salida">
                                    <input type="hidden" name="id_movimientos_productos_cabeza" id="id_movimientos_productos_cabeza" value="<?php echo $resEdit->id_movimientos_productos_cabeza; ?>" class="form-control"/>
    					            <div id="mensaje_id_usuario_salida" class="errores"></div>
                                 </div>
                             </div>
                              </div>
             
                      <?php } } else {?>                		    
                      	  <div class="row">
                		  	<div class="col-xs-12 col-md-3 col-md-3 ">
                    			<div class="form-group">
                                  <label for="fecha_movimientos_productos_cabeza" class="control-label">Fecha</label>
                                  <input type="text" class="form-control" id="fecha_movimientos_productos_cabeza" name="fecha_movimientos_productos_cabeza" value=""  placeholder="fecha">
                                  <div id="mensaje_fecha_movimientos_productos_cabeza" class="errores"></div>
                                 </div>
                             </div>
                             <div class="col-xs-12 col-md-3 col-md-3 ">
                    			<div class="form-group">
                                  <label for="numero_factura_movimientos_productos_cabeza" class="control-label">Numero Factura</label>
                                  <input type="text" class="form-control" id="numero_factura_movimientos_productos_cabeza" name="numero_factura_movimientos_productos_cabeza" value=""  placeholder="Numero Factura">
                                  <div id="mensaje_numero_factura_movimientos_productos_cabeza" class="errores"></div>
                                 </div>
                             </div>
                             <div class="col-xs-12 col-md-3 col-md-3 ">
                    			<div class="form-group">
                                  <label for="numero_autorizacion_movimientos_productos_cabeza" class="control-label">Numero Autorizacion</label>
                                  <input type="text" class="form-control" id="numero_autorizacion_movimientos_productos_cabeza" name="numero_autorizacion_movimientos_productos_cabeza" value=""  placeholder="Numero Autorizacion">
                                  <div id="mensaje_numero_autorizacion_movimientos_productos_cabeza" class="errores"></div>
                                 </div>
                             </div>
                             <div class="col-xs-12 col-md-3 col-md-3 ">
                    			<div class="form-group">
                                  <label for="importe_movimientos_productos_cabeza" class="control-label">Importe</label>
                                  <input type="text" class="form-control" id="importe_movimientos_productos_cabeza" name="importe_movimientos_productos_cabeza" value=""  placeholder="Imporrte">
                                  <div id="mensaje_importe_movimientos_productos_cabeza" class="errores"></div>
                                 </div>
                             </div>
                            </div>	
                             <div class="row">
                		  	<div class="col-xs-12 col-md-3 col-md-3 ">
                    			<div class="form-group">
                                  <label for="cantidad_total_movimientos_productos_cabeza" class="control-label">Cantidad Total</label>
                                  <input type="text" class="form-control" id="cantidad_total_movimientos_productos_cabeza" name="cantidad_total_movimientos_productos_cabeza" value=""  placeholder="Cantidad Total">
                                  <div id="mensaje_cantidad_total_movimientos_productos_cabeza" class="errores"></div>
                                 </div>
                             </div>
                             <div class="col-xs-12 col-md-3 col-md-3 ">
                    			<div class="form-group">
                                  <label for="subtotal_doce_movimientos_productos_cabeza" class="control-label">Subtotal 12</label>
                                  <input type="text" class="form-control" id="subtotal_doce_movimientos_productos_cabeza" name="subtotal_doce_movimientos_productos_cabeza" value=""  placeholder="Subtotal 12">
                                  <div id="mensaje_nombre_grupos" class="errores"></div>
                                 </div>
                             </div>
                             <div class="col-xs-12 col-md-3 col-md-3 ">
                    			<div class="form-group">
                                  <label for="iva_movimientos_productos_cabeza" class="control-label">Iva</label>
                                  <input type="text" class="form-control" id="iva_movimientos_productos_cabeza" name="iva_movimientos_productos_cabeza" value=""  placeholder="iva">
                                  <div id="mensaje_iva_movimientos_productos_cabeza" class="errores"></div>
                                 </div>
                             </div>
                             <div class="col-xs-12 col-md-3 col-md-3 ">
                    			<div class="form-group">
                                  <label for="valor_total_movimientos_productos_cabeza" class="control-label">Valor Total</label>
                                  <input type="text" class="form-control" id="valor_total_movimientos_productos_cabeza" name="valor_total_movimientos_productos_cabeza" value=""  placeholder="Valor Total">
                                  <div id="mensaje_valor_total_movimientos_productos_cabeza" class="errores"></div>
                                 </div>
                             </div>
                            </div>	
                             <div class="row">
                		  	<div class="col-xs-12 col-md-3 col-md-3 ">
                    			<div class="form-group">
                                  <label for="subtotal_cero_movimientos_productos_cabeza" class="control-label">Subtotal 0</label>
                                  <input type="text" class="form-control" id="subtotal_cero_movimientos_productos_cabeza" name="subtotal_cero_movimientos_productos_cabeza" value=""  placeholder="Subtotal 0">
                                  <div id="mensaje_subtotal_cero_movimientos_productos_cabeza" class="errores"></div>
                                 </div>
                             </div>
                             <div class="col-xs-12 col-md-3 col-md-3 ">
                    			<div class="form-group">
                                  <label for="descuento_movimientos_productos_cabeza" class="control-label">Descuento</label>
                                  <input type="text" class="form-control" id="descuento_movimientos_productos_cabeza" name="descuento_movimientos_productos_cabeza" value=""  placeholder="Descuento">
                                  <div id="mensaje_descuento_movimientos_productos_cabeza" class="errores"></div>
                                 </div>
                             </div>
                             <div class="col-xs-12 col-md-3 col-md-3 ">
                    			<div class="form-group">
                                  <label for="id_tipo_documento" class="control-label">Tipo Documento</label>
                                  <input type="text" class="form-control" id="id_tipo_documento" name="id_tipo_documento" value=""  placeholder="Tipo Documento">
                                  <div id="mensaje_id_tipo_documento" class="errores"></div>
                                 </div>
                             </div>
                             <div class="col-xs-12 col-md-3 col-md-3 ">
                    			<div class="form-group">
                                  <label for="id_proveedor" class="control-label">Proveedor</label>
                                  <input type="text" class="form-control" id="id_proveedor" name="id_proveedor" value=""  placeholder="Proveedor">
                                  <div id="mensaje_id_proveedor" class="errores"></div>
                                 </div>
                             </div>
                            </div>	
                           <div class="row">
                            <div class="col-xs-12 col-md-3 col-md-3 ">
                    			<div class="form-group">
                                  <label for="id_usuario_salida" class="control-label">Usuario Salida</label>
                                  <input type="text" class="form-control" id="id_usuario_salida" name="id_usuario_salida" value=""  placeholder="Usuario Salida">
                                  <div id="mensaje_id_usuario_salida" class="errores"></div>
                                 </div>
                             </div>
                             </div>
                    		            
                    		            
                     <?php } ?>
                     	<div class="row">
            			    <div class="col-xs-12 col-md-12 col-md-12 " style="margin-top:15px;  text-align: center; ">
                	   		    <div class="form-group">
            	                  <button type="submit" id="Guardar" name="Guardar" class="btn btn-success">Guardar</button>
        	                    </div>
    	        		    </div>
            		    </div>
          		 	
          		 	</form>
          
        			</div>
      			</div>
    		</section>
    		
    <!-- seccion para el listado de roles -->
      <section class="content">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Listado de Movimientos Registrados</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            
          </div>
        </div>
        
        <div class="box-body">
        
        
       <div class="ibox-content">  
      <div class="table-responsive">
        
		<table  class="table table-striped table-bordered table-hover dataTables-example">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Fecha</th>
                          <th>Número Factura</th>
                          <th>Número Autorización</th>
                          <th>Importe</th>
                          <th>Cantidad Total</th>
                          <th>Subtotal 12</th>
                          <th>Iva</th>
                          <th>Valor Total</th>
                          <th>Subtotal 0</th>
                          <th>Descuento</th>
                          <th>Tipo Documento</th>
                          <th>Proveedor</th>
                          <th>Usuario Salida</th>
                          

                        </tr>
                      </thead>


                      <tbody>
                      <?php $i=0;?>
    						<?php if (!empty($resultSet)) {  foreach($resultSet as $res) {?>
    						<?php $i++;?>
            	        		<tr>
            	                   <td > <?php echo $i; ?>  </td>
            		               <td > <?php echo $res->fecha_movimientos_productos_cabeza; ?></td> 
            		               <td > <?php echo $res->numero_factura_movimientos_productos_cabeza; ?></td> 
            		               <td > <?php echo $res->numero_autorizacion_movimientos_productos_cabeza; ?></td> 
            		               <td > <?php echo $res->importe_movimientos_productos_cabeza; ?></td> 
            		               <td > <?php echo $res->cantidad_total_movimientos_productos_cabeza; ?></td> 
            		               <td > <?php echo $res->subtotal_doce_movimientos_productos_cabeza; ?></td> 
            		               <td > <?php echo $res->iva_movimientos_productos_cabeza; ?></td> 
            		               <td > <?php echo $res->valor_total_movimientos_productos_cabeza; ?></td> 
            		               <td > <?php echo $res->subtotal_cero_movimientos_productos_cabeza; ?></td> 
            		               <td > <?php echo $res->descuento_movimientos_productos_cabeza; ?></td> 
            		               <td > <?php echo $res->id_tipo_documento; ?></td> 
            		               <td > <?php echo $res->id_proveedor; ?></td> 
            		               <td > <?php echo $res->id_usuario_salida; ?></td> 
            		               
            		               <td>
            			           		<div class="right">
            			                    <a href="<?php echo $helper->url("MovimientosProductosCabeza","index"); ?>&id_movimientos_productos_cabeza=<?php echo $res->id_movimientos_productos_cabeza; ?>" class="btn btn-warning" style="font-size:65%;"data-toggle="tooltip" title="Editar"><i class='glyphicon glyphicon-edit'></i></a>
            			                </div>
            			            
            			             </td>
            			             <td>   
            			                	<div class="right">
            			                    <a href="<?php echo $helper->url("MovimientosProductosCabeza","borrarId"); ?>&id_movimientos_productos_cabeza=<?php echo $res->id_movimientos_productos_cabeza; ?>" class="btn btn-danger" style="font-size:65%;"data-toggle="tooltip" title="Eliminar"><i class="glyphicon glyphicon-trash"></i></a>
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
  		</div>
  
  
 
 	<?php include("view/modulos/footer.php"); ?>	

   <div class="control-sidebar-bg"></div>
 </div>
    
    
   <?php include("view/modulos/links_js.php"); ?>
    	
  </body>
</html>

<!-- script pagina anterior -->
<script type="text/javascript">
     
        	   $(document).ready( function (){
        		   pone_espera();
        		   
	   			});

        	   function pone_espera(){

        		   $.blockUI({ 
        				message: '<h4><img src="view/images/load.gif" /> Espere por favor, estamos procesando su requerimiento...</h4>',
        				css: { 
        		            border: 'none', 
        		            padding: '15px', 
        		            backgroundColor: '#000', 
        		            '-webkit-border-radius': '10px', 
        		            '-moz-border-radius': '10px', 
        		            opacity: .5, 
        		            color: '#fff',
        		           
        	        		}
        	    });
            	
		        setTimeout($.unblockUI, 3000); 
		        
        	   }

 </script>
       
       
      
 




