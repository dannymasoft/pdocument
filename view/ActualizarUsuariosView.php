<!DOCTYPE HTML>
<html lang="es">
      <head>
        <meta charset="utf-8"/>
        <title>ActualizarUsuarios - Template 2018</title>

	
		
		<link rel="stylesheet" href="view/css/estilos.css">
		<link rel="stylesheet" href="view/vendors/table-sorter/themes/blue/style.css">
	
	
	
		    <!-- Bootstrap -->
    		<link href="view/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    		<!-- Font Awesome -->
		    <link href="view/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		    <!-- NProgress -->
		    <link href="view/vendors/nprogress/nprogress.css" rel="stylesheet">
		    
		   
		    <!-- Custom Theme Style -->
		    <link href="view/build/css/custom.min.css" rel="stylesheet">
				
			
			<!-- Datatables -->
		    <link href="view/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
		    
		   		

			<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
			<script type="text/javascript" src="view/vendors/table-sorter/jquery.tablesorter.js"></script> 
        <script src="view/js/jquery.blockUI.js"></script>
        
        
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
       
        
        
        <script >
		    // cada vez que se cambia el valor del combo
		    $(document).ready(function(){
		    
		    $("#Guardar").click(function() 
			{
		    	var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
		    	var validaFecha = /([0-9]{4})\-([0-9]{2})\-([0-9]{2})/;

		    	var cedula_usuarios = $("#cedula_usuarios").val();
		    	var nombre_usuarios = $("#nombre_usuarios").val();
		    	//var usuario_usuario = $("#usuario_usuario").val();
		    	var clave_usuarios = $("#clave_usuarios").val();
		    	var cclave_usuarios = $("#clave_usuarios_r").val();
		    	var celular_usuarios = $("#celular_usuarios").val();
		    	var correo_usuarios  = $("#correo_usuarios").val();
		    	var id_rol  = $("#id_rol").val();
		    	var id_estado  = $("#id_estado").val();
		    	
		    	
		    	if (cedula_usuarios == "")
		    	{
			    	
		    		$("#mensaje_cedula_usuarios").text("Introduzca Identificación");
		    		$("#mensaje_cedula_usuarios").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_cedula_usuarios").fadeOut("slow"); //Muestra mensaje de error
		            
				}    
				
		    	if (nombre_usuarios == "")
		    	{
			    	
		    		$("#mensaje_nombre_usuarios").text("Introduzca un Nombre");
		    		$("#mensaje_nombre_usuarios").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_nombre_usuarios").fadeOut("slow"); //Muestra mensaje de error
		            
				}
		    	/*
		    	if (usuario_usuario == "")
		    	{
			    	
		    		$("#mensaje_usuario_usuario").text("Introduzca un Usuario");
		    		$("#mensaje_usuario_usuario").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_usuario_usuario").fadeOut("slow"); //Muestra mensaje de error
		            
				}   
						    	
			*/
		    	if (clave_usuarios == "")
		    	{
		    		
		    		$("#mensaje_clave_usuarios").text("Introduzca una Clave");
		    		$("#mensaje_clave_usuarios").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }else if (clave_usuarios.length<4){
			    	$("#mensaje_clave_usuarios").text("Introduzca minimo 4 números");
		    		$("#mensaje_clave_usuarios").fadeIn("slow"); //Muestra mensaje de error
		            return false;
				}else if (clave_usuarios.length>4){
			    	$("#mensaje_clave_usuarios").text("Introduzca máximo 4 números");
		    		$("#mensaje_clave_usuarios").fadeIn("slow"); //Muestra mensaje de error
		            return false;
				}
		    	else 
		    	{
		    		$("#mensaje_clave_usuarios").fadeOut("slow"); //Muestra mensaje de error
		            
				}
		    	

		    	if (cclave_usuarios == "")
		    	{
		    		
		    		$("#mensaje_clave_usuarios_r").text("Introduzca una Clave");
		    		$("#mensaje_clave_usuarios_r").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_clave_usuarios_r").fadeOut("slow"); 
		            
				}
		    	
		    	if (clave_usuarios != cclave_usuarios)
		    	{
			    	
		    		$("#mensaje_clave_usuarios_r").text("Claves no Coinciden");
		    		$("#mensaje_clave_usuarios_r").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else
		    	{
		    		$("#mensaje_clave_usuarios_r").fadeOut("slow"); 
			        
		    	}	
				

				//los telefonos
		    	
		    	if (celular_usuarios == "" )
		    	{
			    	
		    		$("#mensaje_celular_usuarios").text("Ingrese un Celular");
		    		$("#mensaje_celular_usuarios").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_celular_usuarios").fadeOut("slow"); //Muestra mensaje de error
		            
				}

				// correos
				
		    	if (correo_usuarios == "")
		    	{
			    	
		    		$("#mensaje_correo_usuarios").text("Introduzca un correo");
		    		$("#mensaje_correo_usuarios").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else if (regex.test($('#correo_usuarios').val().trim()))
		    	{
		    		$("#mensaje_correo_usuarios").fadeOut("slow"); //Muestra mensaje de error
		            
				}
		    	else 
		    	{
		    		$("#mensaje_correo_usuarios").text("Introduzca un correo Valido");
		    		$("#mensaje_correo_usuarios").fadeIn("slow"); //Muestra mensaje de error
		            return false;	
			    }

		    	
		    	if (id_rol == 0 )
		    	{
			    	
		    		$("#mensaje_id_rol").text("Seleccione");
		    		$("#mensaje_id_rol").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_id_rol").fadeOut("slow"); //Muestra mensaje de error
		            
				}



		    	if (id_estado == 0 )
		    	{
			    	
		    		$("#mensaje_id_estado").text("Seleccione");
		    		$("#mensaje_id_estado").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_id_estado").fadeOut("slow"); //Muestra mensaje de error
		            
				}
		    					    

			}); 


		        $( "#cedula_usuarios" ).focus(function() {
				  $("#mensaje_cedula_usuarios").fadeOut("slow");
			    });
				
				$( "#nombre_usuarios" ).focus(function() {
					$("#mensaje_nombre_usuarios").fadeOut("slow");
    			});
				/*$( "#usuario_usuario" ).focus(function() {
					$("#mensaje_usuario_usuario").fadeOut("slow");
    			});
    			*/
				$( "#clave_usuarios" ).focus(function() {
					$("#mensaje_clave_usuarios").fadeOut("slow");
    			});
				$( "#clave_usuarios_r" ).focus(function() {
					$("#mensaje_clave_usuarios_r").fadeOut("slow");
    			});
				
				$( "#celular_usuarios" ).focus(function() {
					$("#mensaje_celular_usuarios").fadeOut("slow");
    			});
				
				$( "#correo_usuarios" ).focus(function() {
					$("#mensaje_correo_usuarios").fadeOut("slow");
    			});
			
				$( "#id_rol" ).focus(function() {
					$("#mensaje_id_rol").fadeOut("slow");
    			});

				$( "#id_estado" ).focus(function() {
					$("#mensaje_id_estado").fadeOut("slow");
    			});
				
		      
				    
		}); 

	</script>
        
        
        <script >   
    function numeros(e){
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = "0123456789";
    especiales = [8,37,39,46];
 
    tecla_especial = false
    for(var i in especiales){
    if(key == especiales[i]){
     tecla_especial = true;
     break;
        } 
    }
 
    if(letras.indexOf(tecla)==-1 && !tecla_especial)
        return false;
     }
    </script>   
        
			        
    </head>
    
    
    <body class="nav-md"  >
    
      <?php
        
        $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha=$dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
        ?>
    
    
       
    
    
    
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col  menu_fixed">
          <div class="left_col scroll-view">
            <?php include("view/modulos/logo.php"); ?>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <?php include("view/modulos/menu_profile.php"); ?>
            <!-- /menu profile quick info -->

            <br />
			<?php include("view/modulos/menu.php"); ?>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
		<?php include("view/modulos/head.php"); ?>	
        <!-- /top navigation -->

        <!-- page content -->
		<div class="right_col" role="main">        
            <?php
       $sel_menu = "";
       
    
       if($_SERVER['REQUEST_METHOD']=='POST' )
       {
       	 
       	 
       	$sel_menu=$_POST['criterio'];
       	
       	 
       }
      
	 	?>
    <div class="container">
       <section class="content-header">
         <small><?php echo $fecha; ?></small>
         <ol class=" pull-right breadcrumb">
         <li><a href="<?php echo $helper->url("Usuarios","Bienvenida"); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Perfil de Usuarios</li>
         </ol>
         </section>
  	
  	
  	<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>ACTUALIZAR<small>Usuario</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">


            <form  action="<?php echo $helper->url("Usuarios","Actualiza"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12 col-md-12 col-xs-12">
                               
                               
                               
                               
                                <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
                                
                             
                             		                    		   
                    		   
                    		 <div class="row">
                    		    <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                      <label for="cedula_usuarios" class="control-label">Cedula:</label>
                                                      <input type="number" class="form-control" id="cedula_usuarios" name="cedula_usuarios" value="<?php echo $resEdit->cedula_usuarios; ?>"  placeholder="ci-ruc.." readonly>
                                                      <div id="mensaje_cedula_usuarios" class="errores"></div>
                                </div>
                                </div>
                    		    
                    		    
                    		    <div class="col-lg-6 col-xs-12 col-md-6">
                    		    <div class="form-group">
                                                      <label for="nombre_usuarios" class="control-label">Nombres:</label>
                                                      <input type="text" class="form-control" id="nombre_usuarios" name="nombre_usuarios" value="<?php echo $resEdit->nombre_usuarios; ?>" placeholder="nombres..">
                                                      <div id="mensaje_nombre_usuarios" class="errores"></div>
                                </div>
                                
                                
                    		    </div>
                    		    
                    		    <!-- 
                    		    <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                      <label for="usuario_usuario" class="control-label">Usuario</label>
                                                      <input type="text" class="form-control" id="usuario_usuario" name="usuario_usuario" value="" placeholder="usuario..">
                                                      <div id="mensaje_usuario_usuario" class="errores"></div>
                                </div>
                                </div>
                    			 -->
                    			
                    				<div class="col-lg-2 col-xs-12 col-md-2">
                        		    <div class="form-group">
                                                          <label for="clave_usuarios" class="control-label">Password:</label>
                                                          <input type="password" class="form-control" id="clave_usuarios" name="clave_usuarios" value="<?php echo $resEdit->pass_sistemas_usuarios; ?>" placeholder="(solo números..)" maxlength="4" onkeypress="return numeros(event)">
                                                          <div id="mensaje_clave_usuarios" class="errores"></div>
                                    </div>
                        		    </div>
                        		    
                        		    <div class="col-lg-2 col-xs-12 col-md-2">
                        		    <div class="form-group">
                                                          <label for="clave_usuarios_r" class="control-label">Repita Password:</label>
                                                          <input type="password" class="form-control" id="clave_usuarios_r" name="clave_usuarios_r" value="<?php echo $resEdit->pass_sistemas_usuarios; ?>" placeholder="(solo números..)" maxlength="4" onkeypress="return numeros(event)">
                                                          <div id="mensaje_clave_usuarios_r" class="errores"></div>
                                    </div>
                                    </div>
                    	       </div>
                    			
                               
                    			
                    			<div class="row">
                    		       <div class="col-lg-2 col-xs-12 col-md-2">
                            		    <div class="form-group">
                                                              <label for="telefono_usuarios" class="control-label">Teléfono:</label>
                                                              <input type="text" class="form-control" id="telefono_usuarios" name="telefono_usuarios" value="<?php echo $resEdit->telefono_usuarios; ?>"  placeholder="teléfono..">
                                                              <div id="mensaje_telefono_usuarios" class="errores"></div>
                                        </div>
                            	    </div>
                            		    
                            		    
                    			
                        			<div class="col-lg-2 col-xs-12 col-md-2">
                                		    <div class="form-group">
                                                                  <label for="celular_usuarios" class="control-label">Celular:</label>
                                                                  <input type="text" class="form-control" id="celular_usuarios" name="celular_usuarios" value="<?php echo $resEdit->celular_usuarios; ?>"  placeholder="celular..">
                                                                  <div id="mensaje_celular_usuarios" class="errores"></div>
                                            </div>
                                    </div>
                        		    <div class="col-lg-4 col-xs-12 col-md-4">
                        		    <div class="form-group">
                                                          <label for="correo_usuarios" class="control-label">Correo:</label>
                                                          <input type="email" class="form-control" id="correo_usuarios" name="correo_usuarios" value="<?php echo $resEdit->correo_usuarios; ?>" placeholder="email..">
                                                          <div id="mensaje_correo_usuarios" class="errores"></div>
                                    </div>
                        		    </div>
                        		    
                        		    
                        		    
                        		    <div class="col-lg-4 col-xs-12 col-md-4">
                        		    <div class="form-group">
                                                          <label for="fotografia_usuarios" class="control-label">Fotografía:</label>
                                                          <input type="file" class="form-control" id="fotografia_usuarios" name="fotografia_usuarios" value="">
                                                          <div id="mensaje_usuario" class="errores"></div>
                                    </div>
                        		    </div>
                        		
								     
                        		    
                        		    
                        		     <div class="col-xs-12 col-md-3 col-md-3">
                        		   <div class="form-group">
                                                          <label for="id_rol" class="control-label">Rol:</label>
                                                          <select name="id_rol" id="id_rol"  class="form-control" disabled>
                                                          <option value="0" selected="selected">--Seleccione--</option>
                        									<?php foreach($resultRol as $res) {?>
                        										<option value="<?php echo $res->id_rol; ?>" <?php if ($res->id_rol == $resEdit->id_rol )  echo  ' selected="selected" '  ;  ?> ><?php echo $res->nombre_rol; ?> </option>
                        							        <?php } ?>
                        								   </select> 
                                                          <div id="mensaje_id_rol" class="errores"></div>
                                    </div>
                                    </div>
                                    
                                    <div class="col-xs-12 col-md-3 col-md-3">
                        		   <div class="form-group">
                                                          <label for="id_estado" class="control-label">Estado:</label>
                                                          <select name="id_estado" id="id_estado"  class="form-control" disabled>
                                                          <option value="0" selected="selected">--Seleccione--</option>
                        									<?php foreach($resultEst as $res) {?>
                        										<option value="<?php echo $res->id_estado; ?>" <?php if ($res->id_estado == $resEdit->id_estado )  echo  ' selected="selected" '  ;  ?> ><?php echo $res->nombre_estado; ?> </option>
                        							        <?php } ?>
                        								   </select> 
                                                          <div id="mensaje_id_estado" class="errores"></div>
                                    </div>
                                    </div>
                                
                                </div>
                             
                             
                             
                             
                             
                                
                                
                    		     <?php } } else {?>
                    		    
                    		   
                    	           	
                    		     <?php } ?>
                    		      
                    		    <div class="row">
                    		    <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center; margin-top:20px">
                    		    <div class="form-group">
                                                      <button type="submit" id="Guardar" name="Guardar" class="btn btn-success"><i class="glyphicon glyphicon-floppy-saved"> Actualizar</i></button>
                                </div>
                    		    </div>
                    		    </div>
  
              </form>
  
                  </div>
                </div>
              </div>
		
  
      
        <!-- /page content -->
		
		
		
      
      </div>
    </div>

</div>
</div>
        <!-- jQuery -->
     
    <!-- Bootstrap -->
    <script src="view/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    
    
    
    <!-- NProgress -->
    <script src="view/vendors/nprogress/nprogress.js"></script>
   
   
    <!-- Datatables -->
    <script src="view/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    
    
    <script src="view/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="view/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    
    
    
    <!-- Custom Theme Scripts -->
    <script src="view/build/js/custom.min.js"></script>
	
  </body>
</html>   