    
    <!DOCTYPE HTML>
	<html lang="es">
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
        <li class="active">Productos</li>
      </ol>
    </section>



    <section class="content">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Registrar Proveedores</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        
        <div class="box-body">
          
        
        <form action="<?php echo $helper->url("Proveedores","InsertaProveedores"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12 col-md-12 col-xs-12">
                                <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
                                
                                <div class="row">
                        		    
                        		    
                        		
									<div class="col-xs-12 col-md-3 col-md-3 ">
                        		    <div class="form-group">
                                                          <label for="nombre_proveedores" class="control-label">Nombre Proveedores</label>
                                                          <input type="text" class="form-control" id="nombre_proveedores" name="nombre_proveedores" value="<?php echo $resEdit->nombre_proveedores; ?>"  placeholder="Nombre Proveedores" >
                                                          <input type="hidden" name="id_proveedores" id="id_proveedores" value="<?php echo $resEdit->id_proveedores; ?>" class="form-control"/>
					                                      <div id="mensaje_nombre_proveedores" class="errores"></div>
                                    </div>
                        		    </div>   
                        		    
                        		    <div class="col-xs-12 col-md-3 col-md-3 ">
                        		    <div class="form-group">
                                                          <label for="identificacion_proveedores" class="control-label">Ruc Proveedores</label>
                                                          <input type="text" class="form-control" id="identificacion_proveedores" name="identificacion_proveedores" value="<?php echo $resEdit->identificacion_proveedores; ?>"  placeholder="Ruc Proveedores">
                                                          <input type="hidden" name="id_proveedores" id="id_proveedores" value="<?php echo $resEdit->id_proveedores; ?>" class="form-control"/>
					                                      <div id="mensaje_identificacion_proveedores" class="errores"></div>
                                    </div>
                        		    </div>
                        		    
                        		    <div class="col-xs-12 col-md-3 col-md-3 ">
                        		    <div class="form-group">
                                                          <label for="contactos_proveedores" class="control-label">Contactos Proveedores</label>
                                                          <input type="text" class="form-control" id="contactos_proveedores" name="contactos_proveedores" value="<?php echo $resEdit->contactos_proveedores; ?>"  placeholder="Contactos Proveedores">
                                                          <input type="hidden" name="id_proveedores" id="id_proveedores" value="<?php echo $resEdit->id_proveedores; ?>" class="form-control"/>
					                                      <div id="mensaje_contactos_proveedores" class="errores"></div>
                                    </div>
                        		    </div>    
                        		    
                        		     <div class="col-xs-12 col-md-3 col-md-3 ">
                        		    <div class="form-group">
                                                          <label for="direccion_proveedores" class="control-label">Dirección Proveedores</label>
                                                          <input type="text" class="form-control" id="direccion_proveedores" name="direccion_proveedores" value="<?php echo $resEdit->direccion_proveedores; ?>"  placeholder="Dirección Proveedores">
                                                          <input type="hidden" name="id_proveedores" id="id_proveedores" value="<?php echo $resEdit->id_proveedores; ?>" class="form-control"/>
					                                      <div id="mensaje_direccion_proveedores" class="errores"></div>
                                    </div>
                        		    </div>                     			
                        	
                        	    </div>
                    			
                    			
                    			<div class="row">
                    			                   			
                    			    
                        		<div class="col-xs-12 col-md-3 col-md-3">
                        		    <div class="form-group">
                                                <label for="telefono_proveedores" class="control-label">Teléfono Proveedores</label>
                                                          <input type="text" class="form-control" id="telefono_proveedores" name="telefono_proveedores" value="<?php echo $resEdit->telefono_proveedores; ?>"  placeholder="Teléfono Proveedores">
                                                          <input type="hidden" name="id_proveedores" id="id_proveedores" value="<?php echo $resEdit->id_proveedores; ?>" class="form-control"/>
					                                      <div id="mensaje_telefono_proveedores" class="errores"></div>
                                  
                                    </div>
                                    </div>
                        		    
                        		    
                        		    <div class="col-lg-3 col-xs-12 col-md-3">
                        		     <div class="form-group">
                                                <label for="email_proveedores" class="control-label">Email Proveedores</label>
                                                          <input type="text" class="form-control" id="email_proveedores" name="email_proveedores" value="<?php echo $resEdit->email_proveedores; ?>"  placeholder="Email Proveedores">
                                                          <input type="hidden" name="id_proveedores" id="id_proveedores" value="<?php echo $resEdit->id_proveedores; ?>" class="form-control"/>
					                                      <div id="mensaje_email_proveedores" class="errores"></div>
                                  
                                    </div>
                                 
                        		    
                    		        </div>
                    		         <div class="col-lg-3 col-xs-12 col-md-3">
                        		     <div class="form-group">
                                                <label for="fecha_nacimiento_proveedores" class="control-label">Fecha Nacimiento Proveedores</label>
                                                          <input type="text" class="form-control" id="fecha_nacimiento_proveedores" name="fecha_nacimiento_proveedores" value="<?php echo $resEdit->fecha_nacimiento_proveedores; ?>"  placeholder="Fecha Proveedores">
                                                          <input type="hidden" name="id_proveedores" id="id_proveedores" value="<?php echo $resEdit->id_proveedores; ?>" class="form-control"/>
					                                      <div id="mensaje_fecha_nacimiento_proveedores" class="errores"></div>
                                  
                                    </div>
                                 
                        		    
                    		        </div>
                        		    
                        	
                    	
                    	
                    	
                        		    </div>
                    			
                                 
                                
                    		     <?php } } else {?>
                    		    
                    		   
								 <div class="row">
                        		    
                        		    
                        		 		
                        			
                        			<div class="col-xs-12 col-md-3 col-md-3 ">
                        		    <div class="form-group">
                                                          <label for="nombre_proveedores" class="control-label">Nombre Proveedores</label>
                                                          <input type="text" class="form-control" id="nombre_proveedores" name="nombre_proveedores" value=""  placeholder="Nombre Proveedores">
                                                          <input type="hidden" name="id_proveedores" id="id_proveedores" value="0" class="form-control"/>
					        
                                                           <div id="mensaje_nombre_proveedores" class="errores"></div>
                                    </div>
                        		    </div>
                        		    
                        		    <div class="col-xs-12 col-md-3 col-md-3 ">
                        		    <div class="form-group">
                                                          <label for="identificacion_proveedores" class="control-label">Ruc Proveedores</label>
                                                          <input type="text" class="form-control" id="identificacion_proveedores" name="identificacion_proveedores" value=""  placeholder="Ruc Proveedores">
                                                           <div id="mensaje_identificacion_proveedores" class="errores"></div>
                                    </div>
                        		    </div>
                        		    
                        		    <div class="col-xs-12 col-md-3 col-md-3 ">
                        		    <div class="form-group">
                                                          <label for="contactos_proveedores" class="control-label">Contactos Proveedores</label>
                                                          <input type="text" class="form-control" id="contactos_proveedores" name="contactos_proveedores" value=""  placeholder="Contactos Proveedores">
                                                           <div id="mensaje_contactos_proveedores" class="errores"></div>
                                    </div>
                        		    </div>
                        		       <div class="col-xs-12 col-md-3 col-md-3 ">
                        		    <div class="form-group">
                                                          <label for="direccion_proveedores" class="control-label">Dirección Proveedores</label>
                                                          <input type="text" class="form-control" id="direccion_proveedores" name="direccion_proveedores" value=""  placeholder="Dirección Proveedores">
                                                           <div id="mensaje_direccion_proveedores" class="errores"></div>
                                    </div>
                        		    </div>
                        		    
                        		
                		    
									</div>
									
									<div class="row">
									
									<div class="col-xs-12 col-md-3 col-md-3 ">
                        		    <div class="form-group">
                                                          <label for="telefono_proveedores" class="control-label">Teléfono Proveedores</label>
                                                          <input type="text" class="form-control" id="telefono_proveedores" name="telefono_proveedores" value=""  placeholder="Teléfono Proveedores">
                                                           <div id="mensaje_telefono_proveedores" class="errores"></div>
                                    </div>
                        		    </div>
                        		    <div class="col-xs-12 col-md-3 col-md-3 ">
                        		    <div class="form-group">
                                                          <label for="email_proveedores" class="control-label">Email Proveedores</label>
                                                          <input type="text" class="form-control" id="email_proveedores" name="email_proveedores" value=""  placeholder="Email Proveedores">
                                                           <div id="mensaje_email_proveedores" class="errores"></div>
                                    </div>
                        		    </div>
                        		    
                        		     <div class="col-xs-12 col-md-3 col-md-3 ">
                        		    <div class="form-group">
                                                          <label for="fecha_nacimiento_proveedores" class="control-label">Fecha Proveedores</label>
                                                          <input type="date" class="form-control" id="fecha_nacimiento_proveedores" name="fecha_nacimiento_proveedores" value=""  placeholder="Fecha Proveedores">
                                                           <div id="mensaje_fecha_nacimiento_proveedores" class="errores"></div>
                                    </div>
                        		    </div>
                        		    
                        		    
                        		    
                        		 
                        			
									
									
									
									</div>
                		    
                    	
                    			
                                 	                     	           	
                    		     <?php } ?>
                    		    <br>  
                    		    <div class="row">
                    		    <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center; ">
                    		    <div class="form-group">
                                                      <button type="submit" id="Guardar" name="Guardar" class="btn btn-success">Guardar</button>
                                </div>
                    		    </div>
                    		    </div>
                    		      
                    		  
              </form>
          
        </div>
        
        
      </div>
    </section>
    
    
    
     <section class="content">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Listado de Proveedores</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        
        <div class="box-body">
        
        
       <div class="ibox-content">  
      <div class="table-responsive">
        
      
      
  <table  class="table table-striped table-bordered table-hover dataTables-example">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Nombre</th>
                          <th>Identificación</th>
                          <th>Contactos</th>
                          <th>Dirección</th>
                          <th>Teléfono</th>
                          <th>Email</th>
                          <th>Fecha</th>
                          <th></th>
                          <th></th>
                         
                        </tr>
                      </thead>

                      <tbody>
    					<?php $i=0;?>
    						<?php if (!empty($resultSet)) {  foreach($resultSet as $res) {?>
    						<?php $i++;?>
            	        		<tr>
            	                   <td > <?php echo $i; ?>  </td>
            		               <td > <?php echo $res->nombre_proveedores; ?>     </td> 
            		               <td > <?php echo $res->identificacion_proveedores; ?>   </td>
            		               <td > <?php echo $res->contactos_proveedores; ?>   </td>
            		               <td > <?php echo $res->direccion_proveedores; ?>   </td>
            		               <td > <?php echo $res->telefono_proveedores; ?>   </td>
            		               <td > <?php echo $res->email_proveedores; ?>   </td>
            		               <td > <?php echo $res->fecha_nacimiento_proveedores; ?>   </td>
            		              
            		           	   <td>
            			           		<div class="right">
            			                    <a href="<?php echo $helper->url("Proveedores","index"); ?>&id_proveedores=<?php echo $res->id_proveedores; ?>" class="btn btn-warning" style="font-size:65%;" data-toggle="tooltip" title="Editar"><i class='glyphicon glyphicon-edit'></i></a>
            			                </div>
            			            
            			             </td>
            			             <td>   
            			                	<div class="right">
            			                    <a href="<?php echo $helper->url("Proveedores","borrarId"); ?>&id_proveedores=<?php echo $res->id_proveedores; ?>" class="btn btn-danger" style="font-size:65%;" data-toggle="tooltip" title="Eliminar"><i class="glyphicon glyphicon-trash"></i></a>
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
	
	
    
           
	
	
	<script src="view/bootstrap/otros/inputmask_bundle/jquery.inputmask.bundle.js"></script>
       <script>
      $(document).ready(function(){
      $(".cantidades1").inputmask();
      });
	  </script>
	  
	  
    
           <script>
           // Campos Vacíos
		    // cada vez que se cambia el valor del combo
		    $(document).ready(function(){
		    
		    $("#Guardar").click(function() 
			{
		    	var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
		    	var validaFecha = /([0-9]{4})\-([0-9]{2})\-([0-9]{2})/;

		    	var nombre_proveedores = $("#nombre_proveedores").val();
		    	var identificacion_proveedores = $("#identificacion_proveedores").val();
		    	var contactos_proveedores = $("#contactos_proveedores").val();
		    	var direccion_proveedores = $("#direccion_proveedores").val();
		    	var telefono_proveedores = $("#telefono_proveedores").val();
		    	var email_proveedores = $("#email_proveedores").val();
		    	var fecha_nacimiento_proveedores = $("#fecha_nacimiento_proveedores").val();
		    	
		    	
		    	
		    	if (nombre_proveedores == 0)
		    	{
			    	
		    		$("#mensaje_nombre_proveedores").text("Introduzca Un Nombre");
		    		$("#mensaje_nombre_proveedores").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_nombre_proveedores").fadeOut("slow"); //Muestra mensaje de error
		            
				}   

		    	if (identificacion_proveedores == "")
		    	{
			    	
		    		$("#mensaje_identificacion_proveedores").text("Introduzca Un Ruc");
		    		$("#mensaje_identificacion_proveedores").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_identificacion_proveedores").fadeOut("slow"); //Muestra mensaje de error
		            
				}   

		    	if (contactos_proveedores == "")
		    	{
			    	
		    		$("#mensaje_contactos_proveedores").text("Introduzca Un Contacto");
		    		$("#mensaje_contactos_proveedores").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_contactos_proveedores").fadeOut("slow"); //Muestra mensaje de error
		            
				}   

		    	if (direccion_proveedores == "")
		    	{
			    	
		    		$("#mensaje_direccion_proveedores").text("Introduzca Una Dirección");
		    		$("#mensaje_direccion_proveedores").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_direccion_proveedores").fadeOut("slow"); //Muestra mensaje de error
		            
				}   

		    	if (telefono_proveedores == "")
		    	{
			    	
		    		$("#mensaje_telefono_proveedores").text("Introduzca Un teléfono");
		    		$("#mensaje_telefono_proveedores").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_telefono_proveedores").fadeOut("slow"); //Muestra mensaje de error
		            
				}   
		    	if (email_proveedores == "")
		    	{
			    	
		    		$("#mensaje_email_proveedores").text("Introduzca Un Email");
		    		$("#mensaje_email_proveedores").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_email_proveedores").fadeOut("slow"); //Muestra mensaje de error
		            
				}   

		    	if (fecha_nacimiento_proveedores == "")
		    	{
			    	
		    		$("#mensaje_fecha_nacimiento_proveedores").text("Introduzca Una Fecha");
		    		$("#mensaje_fecha_nacimiento_proveedores").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_fecha_nacimiento_proveedores").fadeOut("slow"); //Muestra mensaje de error
		            
				}   

		    	

		    	
				


		    	
			}); 


		        $( "#nombre_proveedores" ).focus(function() {
				  $("#mensaje_nombre_proveedores").fadeOut("slow");
			    });

		        $( "#identificacion_proveedores" ).focus(function() {
					  $("#mensaje_identificacion_proveedores").fadeOut("slow");
				    });
		        $( "#contactos_proveedores" ).focus(function() {
					  $("#mensaje_contactos_proveedores").fadeOut("slow");
				    });
		        $( "#direccion_proveedores" ).focus(function() {
					  $("#mensaje_direccion_proveedores").fadeOut("slow");
				    });
		        $( "#telefono_proveedores" ).focus(function() {
					  $("#mensaje_telefono_proveedores").fadeOut("slow");
				    });
		        $( "#email_proveedores" ).focus(function() {
					  $("#mensaje_email_proveedores").fadeOut("slow");
				    });
		        $( "#fecha_nacimiento_proveedores" ).focus(function() {
					  $("#mensaje_fecha_nacimiento_proveedores").fadeOut("slow");
				    });
		        		      

			    
		}); 

	</script>	
	
		<script type="text/javascript">
     
        	   $(document).ready( function (){
        		   
        		   load_bodegas_inactivos(1);
        		   load_bodegas_activos(1);
        		   
	   			});

        	


	   function load_bodegas_activos(pagina){

		   var search=$("#search_activos").val();
	       var con_datos={
					  action:'ajax',
					  page:pagina
					  };
			  
	     $("#load_bodegas_activos").fadeIn('slow');
	     
	     $.ajax({
	               beforeSend: function(objeto){
	                 $("#load_bodegas_activos").html('<center><img src="view/images/ajax-loader.gif"> Cargando...</center>');
	               },
	               url: 'index.php?controller=Bodegas&action=consulta_bodegas_activos&search='+search,
	               type: 'POST',
	               data: con_datos,
	               success: function(x){
	                 $("#bodegas_activos_registrados").html(x);
	                 $("#load_bodegas_activos").html("");
	                 $("#tabla_bodegas_activos").tablesorter(); 
	                 
	               },
	              error: function(jqXHR,estado,error){
	                $("#bodegas_activos_registrados").html("Ocurrio un error al cargar la informacion de Bodegas Activos..."+estado+"    "+error);
	              }
	            });


		   }

	   function load_bodegas_inactivos(pagina){

		   var search=$("#search_inactivos").val();
	       var con_datos={
					  action:'ajax',
					  page:pagina
					  };
			  
	     $("#load_bodegas_inactivos").fadeIn('slow');
	     
	     $.ajax({
	               beforeSend: function(objeto){
	                 $("#load_bodegas_inactivos").html('<center><img src="view/images/ajax-loader.gif"> Cargando...</center>');
	               },
	               url: 'index.php?controller=Bodegas&action=consulta_bodegas_inactivos&search='+search,
	               type: 'POST',
	               data: con_datos,
	               success: function(x){
	                 $("#bodegas_inactivos_registrados").html(x);
	                 $("#load_bodegas_inactivos").html("");
	                 $("#tabla_bodegas_inactivos").tablesorter(); 
	                 
	               },
	              error: function(jqXHR,estado,error){
	                $("#bodegas_inactivos_registrados").html("Ocurrio un error al cargar la informacion de Bodegas Inactivos..."+estado+"    "+error);
	              }
	            });


		   }

	  
        	        	   

 </script>
	
  </body>
</html>   



