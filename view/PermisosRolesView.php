    
    <!DOCTYPE HTML>
	<html lang="es">
    <head>
        
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Capremci</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
    <?php include("view/modulos/links_css.php"); ?>		
      
    
    <script>
		    // cada vez que se cambia el valor del combo
		    $(document).ready(function(){
		    
		    $("#Guardar").click(function() 
			{
		    	var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
		    	var validaFecha = /([0-9]{4})\-([0-9]{2})\-([0-9]{2})/;

		    	var nombre_permisos_rol = $("#nombre_permisos_rol").val();
		    	var id_rol = $("#id_rol").val();
		    	var id_controladores = $("#id_controladores").val();
		    	var ver_permisos_rol = $("#ver_permisos_rol").val();
		    	var guardar_permisos_rol = $("#guardar_permisos_rol").val();
		    	var editar_permisos_rol = $("#editar_permisos_rol").val();
		    	var borrar_permisos_rol = $("#borrar_permisos_rol").val();
		    	
		    	
		    	
		    	if (nombre_permisos_rol == "")
		    	{
			    	
		    		$("#mensaje_nombre_permisos_rol").text("Introduzca Nombre");
		    		$("#mensaje_nombre_permisos_rol").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_nombre_permisos_rol").fadeOut("slow"); //Muestra mensaje de error
		            
				}   


		    	if (id_rol == 0)
		    	{
			    	
		    		$("#mensaje_id_rol").text("Seleccione Rol");
		    		$("#mensaje_id_rol").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_id_rol").fadeOut("slow"); //Muestra mensaje de error
		            
				}  


		    	if (id_controladores == 0)
		    	{
			    	
		    		$("#mensaje_id_controladores").text("Seleccione Controlador");
		    		$("#mensaje_id_controladores").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_id_controladores").fadeOut("slow"); //Muestra mensaje de error
		            
				}   


		    	if (ver_permisos_rol == 0)
		    	{
			    	
		    		$("#mensaje_ver_permisos_rol").text("Seleccione Permiso");
		    		$("#mensaje_ver_permisos_rol").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_ver_permisos_rol").fadeOut("slow"); //Muestra mensaje de error
		            
				}   

		    	if (guardar_permisos_rol == 0)
		    	{
			    	
		    		$("#mensaje_guardar_permisos_rol").text("Seleccione Permiso");
		    		$("#mensaje_guardar_permisos_rol").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_guardar_permisos_rol").fadeOut("slow"); //Muestra mensaje de error
		            
				}   

		    	if (editar_permisos_rol == 0)
		    	{
			    	
		    		$("#mensaje_editar_permisos_rol").text("Seleccione Permiso");
		    		$("#mensaje_editar_permisos_rol").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_editar_permisos_rol").fadeOut("slow"); //Muestra mensaje de error
		            
				}   

		    	if (borrar_permisos_rol == 0)
		    	{
			    	
		    		$("#mensaje_borrar_permisos_rol").text("Seleccione Permiso");
		    		$("#mensaje_borrar_permisos_rol").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_borrar_permisos_rol").fadeOut("slow"); //Muestra mensaje de error
		            
				}  
								    

			}); 


		        $( "#nombre_permisos_rol" ).focus(function() {
				  $("#mensaje_nombre_permisos_rol").fadeOut("slow");
			    });
		        $( "#id_rol" ).focus(function() {
					  $("#mensaje_id_rol").fadeOut("slow");
				    });
		        $( "#id_controladores" ).focus(function() {
					  $("#mensaje_id_controladores").fadeOut("slow");
				    });
		        $( "#ver_permisos_rol" ).focus(function() {
					  $("#mensaje_ver_permisos_rol").fadeOut("slow");
				    });

		        $( "#guardar_permisos_rol" ).focus(function() {
					  $("#mensaje_guardar_permisos_rol").fadeOut("slow");
				    });
		        $( "#editar_permisos_rol" ).focus(function() {
					  $("#mensaje_editar_permisos_rol").fadeOut("slow");
				    });
				
		        $( "#borrar_permisos_rol" ).focus(function() {
					  $("#mensaje_borrar_permisos_rol").fadeOut("slow");
				    });
				
		      
				    
		}); 

	</script>
        
    
    
    
    
    
    
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
        <li class="active">Permisos Roles</li>
      </ol>
    </section>



    <section class="content">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Registrar Permisos</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        
        <div class="box-body">
          
        
        <form action="<?php echo $helper->url("PermisosRoles","InsertaPermisosRoles"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12 col-md-12 col-xs-12">
                                <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
                                
                                <div class="row">
                        		    <div class="col-xs-12 col-md-3 col-md-3 ">
                        		    <div class="form-group">
                                                          <label for="nombre_permisos_rol" class="control-label">Nombres Permiso Rol</label>
                                                          <input type="text" class="form-control" id="nombre_permisos_rol" name="nombre_permisos_rol" value="<?php echo $resEdit->nombre_permisos_rol; ?>"  placeholder="Nombres">
                                                          <input type="hidden" name="id_permisos_rol" id="id_permisos_rol" value="<?php echo $resEdit->id_permisos_rol; ?>" class="form-control"/>
					                                      <div id="mensaje_nombre_permisos_rol" class="errores"></div>
                                    </div>
                        		    </div>
                        		    
                        		    <div class="col-xs-12 col-md-3 col-md-3">
                        		    <div class="form-group">
                                                       
                                                          <label for="id_rol" class="control-label">Rol</label>
                                                          <select name="id_rol" id="id_rol"  class="form-control">
                                                            <option value="0" selected="selected">--Seleccione--</option>
																<?php foreach($resultRol as $resRol) {?>
				 												<option value="<?php echo $resRol->id_rol; ?>" <?php if ($resRol->id_rol == $resEdit->id_rol )  echo  ' selected="selected" '  ;  ?> ><?php echo $resRol->nombre_rol; ?> </option>
													            <?php } ?>
								    					  </select>
		   		   										  <div id="mensaje_id_rol" class="errores"></div>
                                    </div>
                                    </div>
                        			
                        			
                        			<div class="col-xs-12 col-md-3 col-md-3">
                        		    <div class="form-group">
                                                          <label for="id_controladores" class="control-label">Controladores</label>
                                                          <select name="id_controladores" id="id_controladores"  class="form-control">
                                                            <option value="0" selected="selected">--Seleccione--</option>
                        									<?php foreach($resultCon as $resCon) {?>
                        				 						<option value="<?php echo $resCon->id_controladores; ?>" <?php if ($resCon->id_controladores == $resEdit->id_controladores )  echo  ' selected="selected" '  ;  ?> ><?php echo $resCon->nombre_controladores; ?> </option>
                        						            <?php } ?>
                        								    	
                        									</select>
                                                           <div id="mensaje_id_controladores" class="errores"></div>
                                    </div>
                        		    </div>
                        		    
                        			
                        	    	<div class="col-xs-12 col-md-3 col-md-3">
                        		    <div class="form-group">
                                                          <label for="ver_permisos_rol" class="control-label">Ver</label>
                        								  <select name="ver_permisos_rol" id="ver_permisos_rol"  class="form-control">
                        								    <option value="0" selected="selected">--Seleccione--</option>
                                    										<option value="TRUE"  <?php  if ( $resEdit->ver_permisos_rol =='t')  echo ' selected="selected" ' ; ?> >Permitir </option>
                                    						            	<option value="FALSE" <?php  if ( $resEdit->ver_permisos_rol =='f')  echo ' selected="selected" ' ; ?> >Denegar </option>
                                    					   </select>	                                  
                                                           <div id="mensaje_ver_permisos_rol" class="errores"></div>
                                    </div>
                        		    </div>
                        		    </div>
                        		    <div class="row">
                        		    <div class="col-xs-12 col-md-3 col-md-3">
                        		    <div class="form-group">
                                                          <label for="guardar_permisos_rol" class="control-label">Guardar</label>
                        								  <select name="guardar_permisos_rol" id="guardar_permisos_rol"  class="form-control">
                        								    <option value="0" selected="selected">--Seleccione--</option>
                                    										<option value="TRUE"  <?php  if ( $resEdit->guardar_permisos_rol =='t')  echo ' selected="selected" ' ; ?> >Permitir </option>
                                    						            	<option value="FALSE" <?php  if ( $resEdit->guardar_permisos_rol =='f')  echo ' selected="selected" ' ; ?> >Denegar </option>
                                    					   </select>	                                  
                                                           <div id="mensaje_guardar_permisos_rol" class="errores"></div>
                                    </div>
                        		    </div>
                        		    
                        			<div class="col-xs-12 col-md-3 col-md-3">
                        		    <div class="form-group">
                                                          <label for="editar_permisos_rol" class="control-label">Editar</label>
                        								  <select name="editar_permisos_rol" id="editar_permisos_rol"  class="form-control">
                        								    <option value="0" selected="selected">--Seleccione--</option>
                                										<option value="TRUE"  <?php  if ( $resEdit->editar_permisos_rol =='t')  echo ' selected="selected" ' ; ?>>Permitir </option>
                                						            	<option value="FALSE" <?php  if ( $resEdit->editar_permisos_rol =='f')  echo ' selected="selected" ' ; ?>  >Denegar </option>
                                					    </select>	                                  
                                                        <div id="mensaje_editar_permisos_rol" class="errores"></div>
                                    </div>
                        		    </div>    
                        		    <div class="col-xs-12 col-md-3 col-md-3">
                        		    <div class="form-group">
                                                          <label for="borrar_permisos_rol" class="control-label">Borrar</label>
                        								  <select name="borrar_permisos_rol" id="borrar_permisos_rol"  class="form-control">
                        								    <option value="0" selected="selected">--Seleccione--</option>
                                										<option value="TRUE"  <?php  if ( $resEdit->borrar_permisos_rol =='t')  echo ' selected="selected" ' ; ?> >Permitir </option>
                                						            	<option value="FALSE" <?php  if ( $resEdit->borrar_permisos_rol =='f')  echo ' selected="selected" ' ; ?>  >Denegar </option>
                                					    </select>	                                  
                                                        <div id="mensaje_borrar_permisos_rol" class="errores"></div>
                                    </div>
                        		    </div>
                		    
                        		     </div>
                    	
                    			
                                 
                                
                    		     <?php } } else {?>
                    		    
                    		   
								 <div class="row">
                        		    <div class="col-xs-12 col-md-3 col-md-3 ">
                        		    <div class="form-group">
                                                          <label for="nombre_permisos_rol" class="control-label">Nombres Permiso Rol</label>
                                                          <input type="text" class="form-control" id="nombre_permisos_rol" name="nombre_permisos_rol" value=""  placeholder="Nombres">
                                                           <div id="mensaje_nombre_permisos_rol" class="errores"></div>
                                    </div>
                        		    </div>
                        		    
                        		    <div class="col-xs-12 col-md-3 col-md-3">
                        		    <div class="form-group">
                                                          <label for="id_rol" class="control-label">Rol</label>
                                                          <select name="id_rol" id="id_rol"  class="form-control">
                                                            <option value="0" selected="selected">--Seleccione--</option>
																<?php foreach($resultRol as $resRol) {?>
				 												<option value="<?php echo $resRol->id_rol; ?>"  ><?php echo $resRol->nombre_rol; ?> </option>
													            <?php } ?>
								    					  </select>
		   		   										   <div id="mensaje_id_rol" class="errores"></div>
                                    </div>
                                    </div>
                        			
                        			
                        			<div class="col-xs-12 col-md-3 col-md-3">
                        		    <div class="form-group">
                                                          <label for="id_controladores" class="control-label">Controladores</label>
                                                          <select name="id_controladores" id="id_controladores"  class="form-control">
                                                            <option value="0" selected="selected">--Seleccione--</option>
                        									<?php foreach($resultCon as $resCon) {?>
                        				 						<option value="<?php echo $resCon->id_controladores; ?>"  ><?php echo $resCon->nombre_controladores; ?> </option>
                        						            <?php } ?>
                        								    	
                        									</select>
                                                            <div id="mensaje_id_controladores" class="errores"></div>
                                    </div>
                        		    </div>
                        		    
									
									
							    	<div class="col-xs-12 col-md-3 col-md-3">
                        		    <div class="form-group">
                                                          <label for="ver_permisos_rol" class="control-label">Ver</label>
                        								  <select name="ver_permisos_rol" id="ver_permisos_rol"  class="form-control">
                        								    <option value="0" selected="selected">--Seleccione--</option>
                                    										<option value="TRUE"   >Permitir </option>
                                    						            	<option value="FALSE"  >Denegar </option>
                                    					   </select>	                                  
                                                            <div id="mensaje_ver_permisos_rol" class="errores"></div>
                                    </div>
                        		    </div>
                        		    </div>
                        		    <div class="row">
                        		    <div class="col-xs-12 col-md-3 col-md-3">
                        		    <div class="form-group">
                                                          <label for="guardar_permisos_rol" class="control-label">Guardar</label>
                        								  <select name="guardar_permisos_rol" id="guardar_permisos_rol"  class="form-control">
                        								    <option value="0" selected="selected">--Seleccione--</option>
                                    										<option value="TRUE"   >Permitir </option>
                                    						            	<option value="FALSE"  >Denegar </option>
                                    					   </select>	                                  
                                                            <div id="mensaje_guardar_permisos_rol" class="errores"></div>
                                    </div>
                        		    </div>
                        		    
                        			<div class="col-xs-12 col-md-3 col-md-3">
                        		    <div class="form-group">
                                                          <label for="editar_permisos_rol" class="control-label">Editar</label>
                        								  <select name="editar_permisos_rol" id="editar_permisos_rol"  class="form-control">
                        								    <option value="0" selected="selected">--Seleccione--</option>
                                										<option value="TRUE"  >Permitir </option>
                                						            	<option value="FALSE"   >Denegar </option>
                                					    </select>	                                  
                                                         <div id="mensaje_editar_permisos_rol" class="errores"></div>
                                    </div>
                        		    </div>    
                        		    <div class="col-xs-12 col-md-3 col-md-3">
                        		    <div class="form-group">
                                                          <label for="borrar_permisos_rol" class="control-label">Borrar</label>
                        								  <select name="borrar_permisos_rol" id="borrar_permisos_rol"  class="form-control">
                        								    <option value="0" selected="selected">--Seleccione--</option>
                                										<option value="TRUE"   >Permitir </option>
                                						            	<option value="FALSE"   >Denegar </option>
                                					    </select>	                                  
                                                         <div id="mensaje_borrar_permisos_rol" class="errores"></div>
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
          <h3 class="box-title">Listado de Permisos Registrados</h3>
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
                          <th>Nombre Permisos Rol</th>
                          <th>Nombre Rol</th>
                          <th>Nombre Controlador</th>
                          <th>Ver</th>
                           <th>Guardar</th>
                          <th>Editar</th>
                          <th>Borrar</th>
                          
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
            		               <td > <?php echo $res->nombre_permisos_rol; ?>     </td> 
            		               <td > <?php echo $res->nombre_rol; ?>   </td>
            		               <td > <?php echo $res->nombre_controladores; ?>   </td>
            		               <td > <?php if ($res->ver_permisos_rol =="t"){ echo "Si";}else{echo "No";}; ?>  </td>
            		               <td > <?php if ($res->guardar_permisos_rol =="t"){ echo "Si";}else{echo "No";}; ?>  </td>
            		               <td > <?php if ($res->editar_permisos_rol == "t"){ echo "Si";}else{echo "No";}; ?>  </td>
            		               <td > <?php if ($res->borrar_permisos_rol == "t"){ echo "Si";}else{echo "No";}; ?>  </td>
            		           	   <td>
            			           		<div class="right">
            			                    <a href="<?php echo $helper->url("PermisosRoles","index"); ?>&id_permisos_rol=<?php echo $res->id_permisos_rol; ?>" class="btn btn-warning" style="font-size:65%;" data-toggle="tooltip" title="Editar"><i class='glyphicon glyphicon-edit'></i></a>
            			                </div>
            			            
            			             </td>
            			             <td>   
            			                	<div class="right">
            			                    <a href="<?php echo $helper->url("PermisosRoles","borrarId"); ?>&id_permisos_rol=<?php echo $res->id_permisos_rol; ?>" class="btn btn-danger" style="font-size:65%;" data-toggle="tooltip" title="Eliminar"><i class="glyphicon glyphicon-trash"></i></a>
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



