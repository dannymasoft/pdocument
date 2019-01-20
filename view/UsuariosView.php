<!DOCTYPE html>
<html lang="en">
  <head>
  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Capremci</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
      
      
   <?php include("view/modulos/links_css.php"); ?>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    
   
  </head>

  <body class="hold-transition skin-blue fixed sidebar-mini">

 <?php  $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
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
                <li class="active">Usuarios</li>
            </ol>
        </section>
        
        <!-- comienza diseño controles usuario -->
        
        <section class="content">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Registrar Usuarios</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                
              </div>
            </div>
            
            <div class="box-body">
            
                <form action="<?php echo $helper->url("Usuarios","InsertaUsuarios"); ?>" method="post" enctype="multipart/form-data" class="col-lg-12 col-md-12 col-xs-12">
          		 	  <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
              		 	 <div class="row">
                         	<div class="col-xs-6 col-md-3 col-lg-3 ">
                            	<div class="form-group">
                                	<label for="cedula_usuarios" class="control-label">Cedula:</label>
                                    <input type="text" class="form-control" id="cedula_usuarios" name="cedula_usuarios" value="<?php echo $resEdit->cedula_usuarios; ?>"  placeholder="ci-ruc.." readonly>
                                    <input type="hidden" class="form-control" id="id_usuarios" name="id_usuarios" value="<?php echo $resEdit->id_usuarios; ?>" >
                                    <div id="mensaje_cedula_usuarios" class="errores"></div>
                                 </div>
                             </div>
                             <div class="col-xs-6 col-md-3 col-lg-3">
                             	<div class="form-group">
                                	 <label for="nombre_usuarios" class="control-label">Nombres:</label>
                                      <input type="text" class="form-control" id="nombre_usuarios" name="nombre_usuarios" value="<?php echo $resEdit->nombre_usuarios; ?>" placeholder="nombres..">
                                      <div id="mensaje_nombre_usuarios" class="errores"></div>
                                 </div>
                             </div>
                             <div class="col-xs-6 col-md-3 col-lg-3">
                             	<div class="form-group">
                                	 <label for="apellidos_usuarios" class="control-label">Apellidos:</label>
                                      <input type="text" class="form-control" id="apellidos_usuarios" name="apellidos_usuarios" value="<?php echo $resEdit->apellidos_usuarios; ?>" placeholder="nombres..">
                                      <div id="mensaje_apellido_usuarios" class="errores"></div>
                                 </div>
                             </div>
                             <div class="col-xs-6 col-md-3 col-lg-3 ">
                            	<div class="form-group">
                                	<label for="usuario_usuarios" class="control-label">Usuario:</label>
                                    <input type="text" class="form-control" id="usuario_usuarios" name="usuario_usuarios" value="<?php echo $resEdit->usuario_usuarios; ?>"  placeholder="usuario..." >
                                    <div id="usuario_usuarios" class="errores"></div>
                                 </div>
                             </div> 
                          </div>
                          <div class="row">
                          
                          	<div class="col-xs-6 col-md-3 col-lg-3 ">
                          		<div class="form-group">
                             		 	<label for="fecha_nacimiento_usuarios" class="control-label">Fecha Nacimiento:</label>
                                        <div class="input-group">
                                          <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                          </div>
                                          <input type="date" class="form-control" id="fecha_nacimiento_usuarios" name="fecha_nacimiento_usuarios" value="<?php echo $resEdit->fecha_nacimiento_usuarios; ?>"  >
                                          <div id="mensaje_fecha_nacimiento_usuarios" class="errores"></div>
                                        </div>
                                        <!-- /.input group -->
                                      </div>                            	
                             </div> 
                             
                             <div class="col-lg-3 col-xs-6 col-md-3">
                             
                                 <div class="form-group">
                                    <label>Celular:</label>
                                    <div class="input-group">
                                      <div class="input-group-addon">
                                        <i class="fa fa-tablet"></i>
                                      </div>
                                      <input type="text" id="celular_usuarios" name="celular_usuarios" value="<?php echo $resEdit->celular_usuarios; ?>" class="form-control" data-inputmask='"mask": "999-999-9999"' data-mask>
                                      <div id="mensaje_celular_usuarios" class="errores"></div>
                                    </div>
                                    <!-- /.input group -->
                                  </div>
                    		    
                             </div>
                             
                             <div class="col-lg-3 col-xs-6 col-md-3">
                             	<div class="form-group">
                                        <label>Telefono:</label>
                                        <div class="input-group">
                                          <div class="input-group-addon">
                                            <i class="fa fa-phone"></i>
                                          </div>
                                          <input type="text" class="form-control"  id="telefono_usuarios" name="telefono_usuarios" value="<?php echo $resEdit->telefono_usuarios; ?>"  data-inputmask='"mask": "(99) 9999-999"' data-mask>
                                        </div>
                                        <!-- /.input group -->
                                  </div>
                    		   
                    	    </div>
                    	    
                    	    
                    	    <div class="col-lg-3 col-xs-12 col-md-3">
                        		    <div class="form-group">
                                          <label for="correo_usuarios" class="control-label">Correo:</label>
                                          <input type="email" class="form-control" id="correo_usuarios" name="correo_usuarios" value="<?php echo $resEdit->correo_usuarios; ?>" placeholder="email..">
                                          <div id="mensaje_correo_usuarios" class="errores"></div>
                                    </div>
                    		    </div>
                                
                        	                            
                          </div>
                          
                          <div class="row">
                		       
                		       <div class="col-xs-6 col-md-3 col-lg-3">
                        		<div class="form-group">
                                  <label for="clave_usuarios" class="control-label">Password:</label>
                                  <input type="password" class="form-control caducaclave" id="clave_usuarios" name="clave_usuarios" value="<?php echo $resEdit->clave_n_claves; ?>" placeholder="(solo números..)" maxlength="4" onkeypress="return numeros(event)" readonly>
                                  <div id="mensaje_clave_usuarios" class="errores"></div>
                                </div>
                            	</div>
                            		    
                    		    <div class="col-lg-3 col-xs-6 col-md-3">
                    		    <div class="form-group">
                                      <label for="clave_usuarios_r" class="control-label">Repita Password:</label>
                                      <input type="password" class="form-control" id="clave_usuarios_r" name="clave_usuarios_r" value="<?php echo $resEdit->clave_n_claves; ?>" placeholder="(solo números..)" maxlength="4" onkeypress="return numeros(event)" readonly>
                                      <div id="mensaje_clave_usuarios_r" class="errores"></div>
                                </div>
                                </div>
                    			
                    		    
                    		    <div class="col-xs-12 col-md-3 col-lg-3">
                        		   <div class="form-group">
                                      <label for="id_estado" class="control-label">Estado:</label>
                                      <select name="id_estado" id="id_estado"  class="form-control" >
                                      <option value="0" selected="selected">--Seleccione--</option>
    									<?php  foreach($result_catalogo_usuario as $res) {?>
    										<option value="<?php echo $res->valor_catalogo; ?>" <?php if ($res->valor_catalogo == $resEdit->estado_usuarios )  echo  ' selected="selected" '  ;  ?> ><?php echo $res->nombre_catalogo; ?> </option>
    							        <?php } ?>
    								   </select> 
                                      <div id="mensaje_id_estados" class="errores"></div>
                                    </div>
                                  </div>
                    		    <div class="col-lg-3 col-xs-12 col-md-3">
                        		    <div class="form-group">
                                          <label for="fotografia_usuarios" class="control-label">Fotografía:</label>
                                          <input type="file" class="form-control" id="fotografia_usuarios" name="fotografia_usuarios" value="">
                                          <div id="mensaje_usuario" class="errores"></div>
                                    </div>
                    		    </div>
                        	</div>
                        	
                        	
                    		
                    		<div class="row"> 
                    		
                    			<div class="col-xs-12 col-lg-3 col-md-3">
                        		   <div class="form-group">
                                      <label for="id_rol_principal" class="control-label">Rol Principal:</label>
                                      <select name="id_rol_principal" id="id_rol_principal"  class="form-control" >
                                      <option value="0" selected="selected">--Seleccione--</option>
    									<?php foreach($resultRol as $res) {?>
    										<option value="<?php echo $res->id_rol; ?>" <?php if ($res->id_rol == $resEdit->id_rol )  echo  ' selected="selected" '  ;  ?> ><?php echo $res->nombre_rol; ?> </option>
    							        <?php } ?>
    								   </select> 
                                      <div id="mensaje_id_rols" class="errores"></div>
                                    </div>
                                 </div> 
                                 
                                 <div class="col-xs-12 col-lg-3 col-md-3">                                  
                        		   <div class="form-group">
                        		   <br>
                        		   	  <input type="hidden" class="form-control" id="codigo_clave" name="codigo_clave" value="<?php echo $resEdit->clave_n_claves; ?>" >
                                      <label for="cambiar_clave" class="control-label">Cambiar Clave: </label> &nbsp;&nbsp;
                                      <input type="checkbox"  id="cambiar_clave" name="cambiar_clave" value="1"   /> <br>
                                      <label for="caduca_clave" class="control-label">Caduca  Clave: </label> &nbsp;&nbsp; &nbsp;
                                      <input type="checkbox"  id="caduca_clave" name="caduca_clave" value="1" <?php  if($resEdit->caduca_claves=='t'){echo 'checked="checked" ';} ?>  />
                                    </div>
                                 </div> 
                                 
                              </div>
                              
                              <div class="row">
                        		<div class="col-xs-12 col-lg-5 col-md-5">
                        		   <div class="form-group">
                                      <label for="id_rol" class="control-label">Roles Disponibles</label>
                                      <select name="id_rol" id="id_rol" multiple="multiple" class="form-control" >
    									<?php foreach($resultRol as $res) {?>
    										<option value="<?php echo $res->id_rol; ?>" ><?php echo $res->nombre_rol; ?> </option>
    							        <?php } ?>
    								   </select> 
                                      <div id="mensaje_id_rols" class="errores"></div>
                                    </div>
                                 </div>
                                 
                                 <div class="col-xs-12 col-lg-2 col-md-2">
                                 	<table class="table table-bordered" style="text-align: center;">
                                        
                                        <tr>                                          
                                          <td>
                                            <div class="btn-group-vertical">
                                              <button id="link_agregar_rol" type="button" class="btn btn-default"><i class="fa fa-fw fa-angle-right"></i></button>
                                              <button id="link_agregar_roles" type="button" class="btn btn-default"><i class="fa fa-fw fa-angle-double-right"></i></button>
                                              <button id="link_eliminar_rol" type="button" class="btn btn-default"><i class="fa fa-fw fa-angle-left"></i></button>
                                              <button id="link_eliminar_roles" type="button" class="btn btn-default"><i class="fa fa-fw fa-angle-double-left"></i></button>
                                            </div>
                                          </td>
                                         </tr>
                                      </table>
                                 	 
                                 </div>
                                 
                                 <div class="col-xs-12 col-lg-5 col-md-5">
                        		   <div class="form-group">
                                      <label for="lista_roles" class="control-label">Usuario tiene Rol(es):</label>
                                      <select name="lista_roles[]" id="lista_roles" multiple="multiple" class="form-control" >
                                      <?php foreach($result_privilegios as $res) {?>
    										<option value="<?php echo $res->id_rol; ?>" <?php echo  ' selected="selected" '  ;  ?> ><?php echo $res->nombre_rol; ?> </option>
    							        <?php } ?>
    								   </select> 
                                      <div id="mensaje_id_rols" class="errores"></div>
                                    </div>
                                 </div>
                        	
                        	</div>
                                
                      <?php } } else {?>                		    
                      	  <div class="row">
                		  	<div class="col-xs-6 col-md-3 col-lg-3 ">
                    			<div class="form-group">
                                    <label for="cedula_usuarios" class="control-label">Cedula:</label>
                                    <input type="text" class="form-control" id="cedula_usuarios" name="cedula_usuarios" value=""  placeholder="ci-ruc.." >
                                     <input type="hidden" class="form-control" id="id_usuarios" name="id_usuarios" value="0" >
                                    <div id="mensaje_cedula_usuarios" class="errores"></div>
                                 </div>
                             </div>
                             <div class="col-xs-6 col-md-3 col-lg-3">
                             	<div class="form-group">
                                	 <label for="nombre_usuarios" class="control-label">Nombres:</label>
                                      <input type="text" class="form-control" id="nombre_usuarios" name="nombre_usuarios" value="" placeholder="nombres..">
                                      <div id="mensaje_nombre_usuarios" class="errores"></div>
                                 </div>
                             </div>
                             <div class="col-xs-6 col-md-3 col-lg-3">
                             	<div class="form-group">
                                	 <label for="apellidos_usuarios" class="control-label">Apellidos:</label>
                                      <input type="text" class="form-control" id="apellidos_usuarios" name="apellidos_usuarios" value="" placeholder="apellidos..">
                                      <div id="mensaje_apellido_usuarios" class="errores"></div>
                                 </div>
                             </div>
                             
                             <div class="col-xs-6 col-md-3 col-lg-3 ">
                                	<div class="form-group">
                                    	<label for="usuario_usuarios" class="control-label">Usuario:</label>
                                        <input type="text" class="form-control" id="usuario_usuarios" name="usuario_usuarios" value=""  placeholder="usuario..." >
                                        <div id="mensaje_usuario_usuarios" class="errores"></div>
                                     </div>
                                 </div>
                             </div>
                                  
                             <div class="row">
                             	
                             	<div class="col-xs-6 col-md-3 col-lg-3 ">
                             		 <div class="form-group">
                             		 	<label for="fecha_nacimiento_usuarios" class="control-label">Fecha Nacimiento:</label>
                                        <div class="input-group">
                                          <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                          </div>
                                          <input type="date" class="form-control" id="fecha_nacimiento_usuarios" name="fecha_nacimiento_usuarios" value="" min="2001-01-01" max="<?php echo date("Y-m-d");?>"  step="2" required>
                                         <div id="mensaje_fecha_nacimiento_usuarios" class="errores"></div>
                                        </div>
                                         
                                        <!-- /.input group -->
                                      </div>
                                	
                                   </div>  
                                
                                 
                                 <div class="col-lg-3 col-xs-6 col-md-3">
                                 	<div class="form-group">
                                        <label>Celular:</label>
                                        <div class="input-group">
                                          <div class="input-group-addon">
                                            <i class="fa fa-tablet"></i>
                                          </div>
                                          <input type="text" id="celular_usuarios" name="celular_usuarios" value="" class="form-control" data-inputmask='"mask": "999-999-9999"' data-mask>
                                          <div id="mensaje_celular_usuarios" class="errores"></div>
                                        </div>
                                        <!-- /.input group -->
                                      </div>
                                </div>
                                
                                <div class="col-lg-3 col-xs-6 col-md-3">
                                	<div class="form-group">
                                        <label>Telefono:</label>
                                        <div class="input-group">
                                          <div class="input-group-addon">
                                            <i class="fa fa-phone"></i>
                                          </div>
                                          <input type="text" class="form-control" id="telefono_usuarios" name="telefono_usuarios" value=""  data-inputmask='"mask": "(99) 9999-999"' data-mask>
                                        </div>
                                        <!-- /.input group -->
                                      </div>
                        		    
                        	    </div>
                        	    
                        	    
                    		    <div class="col-lg-3 col-xs-12 col-md-3">
                        		    <div class="form-group">
                                          <label for="correo_usuarios" class="control-label">Correo:</label>
                                          <input type="email" class="form-control" id="correo_usuarios" name="correo_usuarios" value="" placeholder="email..">
                                          <div id="mensaje_correo_usuarios" class="errores"></div>
                                    </div>
                    		    </div>
                    		    									
                                
                             	                            
                              </div>
                            
                          
                          <div class="row">                		      
                    			
                    		    <div class="col-xs-6 col-md-3 col-lg-3">
                            		<div class="form-group">
                                      <label for="clave_usuarios" class="control-label">Password:</label>
                                      <input type="password" class="form-control" id="clave_usuarios" name="clave_usuarios" value="" placeholder="(solo números..)" maxlength="4" onkeypress="return numeros(event)">
                                      <div id="mensaje_clave_usuarios" class="errores"></div>
                                    </div>
                            	</div>
                            	
                            	<div class="col-lg-3 col-xs-6 col-md-3">
                        		    <div class="form-group">
                                          <label for="clave_usuarios_r" class="control-label">Repita Password:</label>
                                          <input type="password" class="form-control" id="clave_usuarios_r" name="clave_usuarios_r" value="" placeholder="(solo números..)" maxlength="4" onkeypress="return numeros(event)">
                                          <div id="mensaje_clave_usuarios_r" class="errores"></div>
                                    </div>
                                </div>
                                
                    		    <div class="col-xs-12 col-md-3 col-lg-3">
                        		   <div class="form-group">
                                      <label for="id_estado" class="control-label">Estado:</label>
                                      <select name="id_estado" id="id_estado"  class="form-control" >
                                      <option value="0" selected="selected">--Seleccione--</option>
    									<?php foreach($result_catalogo_usuario as $res) {?>
    										<option value="<?php echo $res->valor_catalogo; ?>" ><?php echo $res->nombre_catalogo; ?> </option>
    							        <?php } ?>
    								   </select> 
                                      <div id="mensaje_id_estados" class="errores"></div>
                                    </div>
                                  </div>
                                  
                                  <div class="col-lg-3 col-xs-12 col-md-3">
                        		    <div class="form-group">
                                          <label for="fotografia_usuarios" class="control-label">Fotografía:</label>
                                          <input type="file" class="form-control" id="fotografia_usuarios" name="fotografia_usuarios" value="">
                                          <div id="mensaje_fotografia_usuario" class="errores"></div>
                                    </div>
                    		    </div>
                        	</div>
                        	
                        	<div class="row"> 
                    		    		    
                        		<div class="col-xs-12 col-lg-3 col-md-3">
                        		   <div class="form-group">
                                      <label for="id_rol_principal" class="control-label">Rol Principal:</label>
                                      <select name="id_rol_principal" id="id_rol_principal"   class="form-control" >
                                      <option value="0" selected="selected">--Seleccione--</option>
    									<?php foreach($resultRol as $res) {?>
    										<option value="<?php echo $res->id_rol; ?>" ><?php echo $res->nombre_rol; ?> </option>
    							        <?php } ?>
    								   </select> 
                                      <div id="mensaje_id_rol_principal" class="errores"></div>
                                    </div>
                                 </div>
                                 
                                 <div class="col-xs-12 col-lg-3 col-md-3">                                  
                        		   <div class="form-group" >
                        		   <br>
                        		   	  <input type="hidden" class="form-control" id="codigo_clave" name="codigo_clave" value="0" />
                        		   	  <label for="cambiar_clave" class="control-label" id="lbl_cambiar_clave"></label>&nbsp;&nbsp;
                        		   	  <input type="checkbox"  id="cambiar_clave" name="cambiar_clave" value="0"  style="display:none" /> <br>
                                      <label for="id_rol_principal" class="control-label">Caduca Clave: </label> &nbsp;&nbsp;
                                      <input type="checkbox" id="caduca_clave" name="caduca_clave" value=""  />
                                    </div>
                                 </div> 
                                 
                             </div>
                        	
                        	<div class="row">
                        		<div class="col-xs-12 col-lg-5 col-md-5">
                        		   <div class="form-group">
                                      <label for="id_rol_principal" class="control-label">Roles Disponibles</label>
                                      <select name="id_rol" id="id_rol" multiple="multiple" class="form-control" >
    									<?php foreach($resultRol as $res) {?>
    										<option value="<?php echo $res->id_rol; ?>" ><?php echo $res->nombre_rol; ?> </option>
    							        <?php } ?>
    								   </select> 
                                      <div id="mensaje_id_rols" class="errores"></div>
                                    </div>
                                 </div>
                                 
                                 <div class="col-xs-12 col-lg-2 col-md-2">
                                 	<table class="table table-bordered" style="text-align: center;">
                                        
                                        <tr>                                          
                                          <td>
                                            <div class="btn-group-vertical">
                                              <button id="link_agregar_rol" type="button" class="btn btn-default"><i class="fa fa-fw fa-angle-right"></i></button>
                                              <button id="link_agregar_roles" type="button" class="btn btn-default"><i class="fa fa-fw fa-angle-double-right"></i></button>
                                              <button id="link_eliminar_rol" type="button" class="btn btn-default"><i class="fa fa-fw fa-angle-left"></i></button>
                                              <button id="link_eliminar_roles" type="button" class="btn btn-default"><i class="fa fa-fw fa-angle-double-left"></i></button>
                                            </div>
                                          </td>
                                         </tr>
                                      </table>
                                 	 
                                 </div>
                                 
                                 <div class="col-xs-12 col-lg-5 col-md-5">
                        		   <div class="form-group">
                                      <label for="lista_roles" class="control-label">Usuario tiene Rol(es):</label>
                                      <select name="lista_roles[]" id="lista_roles" multiple="multiple" class="form-control" >
                                      
    								   </select> 
                                      <div id="mensaje_id_rols" class="errores"></div>
                                    </div>
                                 </div>
                        	
                        	</div>
                        	
                        	
                    		            
                     <?php } ?>
                     	<div class="row">
            			    <div class="col-xs-12 col-md-12 col-md-12 " style="margin-top:15px;  text-align: center; ">
                	   		    <div class="form-group">
            	                  <button type="submit" id="Guardar" name="Guardar" class="btn btn-success">GUARDAR</button>
            	                  <a class="btn btn-danger" href="<?php  echo $helper->url("Usuarios","index"); ?>">CANCELAR</a>
        	                    </div>
    	        		    </div>
    	        		    
            		    </div>
          		 	
          		 	</form>
          
        			</div>
      			</div>
      			
      			<div id="resultadosjq">
      			
      			</div>
    		</section>
    		
    		
    		
    		
       <section class="content">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Listado Usuarios</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                
              </div>
            </div>
            
            <div class="box-body">
            
            
            
            
            
           <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activos" data-toggle="tab">Usuarios Activos</a></li>
              <li><a href="#inactivos" data-toggle="tab">Usuarios Inactivos</a></li>
            </ul>
            
            <div class="col-md-12 col-lg-12 col-xs-12">
            <div class="tab-content">
            <br>
              <div class="tab-pane active" id="activos">
                
					<div class="pull-right" style="margin-right:15px;">
						<input type="text" value="" class="form-control" id="search" name="search" onkeyup="load_usuarios(1)" placeholder="search.."/>
					</div>
					<div id="load_registrados" ></div>	
					<div id="users_registrados"></div>	
                
              </div>
              
              <div class="tab-pane" id="inactivos">
                
                    <div class="pull-right" style="margin-right:15px;">
					<input type="text" value="" class="form-control" id="search_inactivos" name="search_inactivos" onkeyup="load_usuarios_inactivos(1)" placeholder="search.."/>
					</div>
					
					
					<div id="load_inactivos_registrados" ></div>	
					<div id="users_inactivos_registrados"></div>
                
                
              </div>
             
             
            </div>
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
   
    <script src="view/bootstrap/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="view/bootstrap/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="view/bootstrap/plugins/input-mask/jquery.inputmask.extensions.js"></script>
   
   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  
 
   
   
   <!-- para el autocompletado -->
    
 
 <!-- funciones javascript para la pagina -->
 
  <script type="text/javascript">
     
   $(document).ready( function (){
	   
	   /*pone_espera();*/
	   load_usuarios(1);
	   load_usuarios_inactivos(1);

	   $('[data-mask]').inputmask();

	   /*para manejo de multiples roles*/
	    /**$("#link_agregar_rol").click(function() {
			return !($('#id_rol option:selected').clone()).appendTo('#lista_roles'); 
	    });*/
	    $('#link_agregar_rol').click(function() { 
	        copiarOpcion($('#id_rol option:selected').clone(), "#lista_roles");
	    });

	    $('#link_agregar_roles').click(function() { 
	        $('#id_rol option').each(function() {
	            copiarOpcion($(this).clone(), "#lista_roles");
	        }); 
	    });

	    $('#link_eliminar_rol').click(function() { 
	        $('#lista_roles option:selected').remove(); 
	    });

	    $('#link_eliminar_roles').click(function() { 
	        $('#lista_roles option').each(function() {
	            $(this).remove(); 
	        }); 
	    });

	    $('#id_rol_principal').change(function() { 
	    	copiarOpcion($('#id_rol_principal option:selected').clone(), "#lista_roles");
	    });

	   

	    $(".caducaclave").blur(function(){
			var clave = $("#clave_usuarios").val();
			var _id_usuarios = $("#id_usuarios").val();

			if($('#cambiar_clave').is(':checked')){
    			$.ajax({
    	            beforeSend: function(objeto){
    	              $("#resultadosjq").html('...');
    	            },
    	            url: 'index.php?controller=Usuarios&action=ajax_caducaclave',
    	            type: 'POST',
    	            data: {clave_usuarios:clave,id_usuarios:_id_usuarios},
    	            success: function(x){
    	             if(x.trim()!=""){
    	            	 	$("#mensaje_clave_usuarios").text(x);
    			    		$("#mensaje_clave_usuarios").fadeIn("slow");
        	            	 $("#clave_usuarios").val("");
        	            	 $("#clave_usuarios_r").val("");
    	                 }
    	            },
    	           error: function(jqXHR,estado,error){
    	             $("#resultadosjq").html("Ocurrio un error al cargar la informacion de Usuarios..."+estado+"    "+error);
    	           }
    	         });
			}
    	        
	   });

		$('#cambiar_clave').change(
			    function(){				    
			        if (this.checked) {

				           $('#clave_usuarios').removeAttr("readonly");
				           $('#clave_usuarios_r').removeAttr("readonly");
				           $('#clave_usuarios').val("");
				           $('#clave_usuarios_r').val("");
			        }else{
			        	$('#clave_usuarios').attr("readonly","readonly");
				        $('#clave_usuarios_r').attr("readonly","readonly");
				        $('#clave_usuarios').val($('#codigo_clave').val());
				        $('#clave_usuarios_r').val($('#codigo_clave').val());
				        }
			    });

		
});

    function copiarOpcion(opcion, destino) {
        var valor = $(opcion).val();
        if (($(destino + " option[value=" + valor + "] ").length == 0) && valor != 0 ) {
            $(opcion).appendTo(destino);
        }
    }

    function selecionarTodos(){
    	$("#lista_roles option").each(function(){
	      $(this).attr("selected", true);
		 });
     }
    

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

        	   
   function load_usuarios(pagina){

	   var search=$("#search").val();
       var con_datos={
				  action:'ajax',
				  page:pagina
				  };
		  
     $("#load_registrados").fadeIn('slow');
     
     $.ajax({
               beforeSend: function(objeto){
                 $("#load_registrados").html('<center><img src="view/images/ajax-loader.gif"> Cargando...</center>');
               },
               url: 'index.php?controller=Usuarios&action=consulta_usuarios_activos&search='+search,
               type: 'POST',
               data: con_datos,
               success: function(x){
                 $("#users_registrados").html(x);
                 $("#load_registrados").html("");
                 $("#tabla_usuarios").tablesorter(); 
                 
               },
              error: function(jqXHR,estado,error){
                $("#users_registrados").html("Ocurrio un error al cargar la informacion de Usuarios..."+estado+"    "+error);
              }
            });


	   }

   function load_usuarios_inactivos(pagina){

	   var search=$("#search_inactivos").val();
       var con_datos={
				  action:'ajax',
				  page:pagina
				  };
		  
     $("#load_inactivos_registrados").fadeIn('slow');
     
     $.ajax({
               beforeSend: function(objeto){
                 $("#load_inactivos_registrados").html('<center><img src="view/images/ajax-loader.gif"> Cargando...</center>');
               },
               url: 'index.php?controller=Usuarios&action=consulta_usuarios_inactivos&search='+search,
               type: 'POST',
               data: con_datos,
               success: function(x){
                 $("#users_inactivos_registrados").html(x);
                 $("#load_inactivos_registrados").html("");
                 $("#tabla_usuarios_inactivos").tablesorter(); 
                 
               },
              error: function(jqXHR,estado,error){
                $("#users_inactivos_registrados").html("Ocurrio un error al cargar la informacion de Usuarios..."+estado+"    "+error);
              }
            });


	   }

  

   
</script>

<script type="text/javascript">


$(document).ready(function(){

	

            var cedula_usuarios = $("#cedula_usuarios").val();

            if(cedula_usuarios>0){

             }else{
       		
			$( "#cedula_usuarios" ).autocomplete({

				source: "<?php echo $helper->url("Usuarios","AutocompleteCedula"); ?>",
  				minLength: 4
			});

			$("#cedula_usuarios").focusout(function(){
				validarcedula();
				$.ajax({
					url:'<?php echo $helper->url("Usuarios","AutocompleteDevuelveNombres"); ?>',
					type:'POST',
					dataType:'json',
					data:{cedula_usuarios:$('#cedula_usuarios').val()}
				}).done(function(respuesta){

					$('#id_usuarios').val(respuesta.id_usuarios);					
					$('#nombre_usuarios').val(respuesta.nombre_usuarios);
					$('#apellidos_usuarios').val(respuesta.apellidos_usuarios);
					$('#usuario_usuarios').val(respuesta.usuario_usuarios);
					$('#fecha_nacimiento_usuarios').val(respuesta.fecha_nacimiento_usuarios);
					$('#celular_usuarios').val(respuesta.celular_usuarios);
					$('#telefono_usuarios').val(respuesta.telefono_usuarios);
					$('#correo_usuarios').val(respuesta.correo_usuarios);					
					$('#codigo_clave').val(respuesta.clave_n_claves);

					if(respuesta.id_rol>0){
						$('#id_rol_principal option[value='+respuesta.id_rol+']').attr('selected','selected');
						}

					if(respuesta.estado_usuarios>0){
						$('#id_estado option[value='+respuesta.estado_usuarios+']').attr('selected','selected');
						}

					if(respuesta.caduca_claves=='t'){
						
						$('#caduca_clave').attr('checked','checked');
					}

					if( typeof respuesta.clave_n_usuarios !== "undefined"){
						$('#clave_usuarios').val(respuesta.clave_n_claves).attr('readonly','readonly');
						$('#clave_usuarios_r').val(respuesta.clave_n_claves).attr('readonly','readonly');
						$('#lbl_cambiar_clave').text("Cambiar Clave:  ");
						$('#cambiar_clave').show();
							
							
						}

					

                    if(respuesta.privilegios.length>0){
                    	 $('#lista_roles').empty();
                    	 $.each(respuesta.privilegios, function(k, v) {
                    		 $('#lista_roles').append("<option value= " +v.id_rol +" >" + v.nombre_rol  + "</option>");
                 		   
                    	});
					}
					
					
					
				
    			}).fail(function(respuesta) {

    				$('#id_usuarios').val("");
					$('#nombre_usuarios').val("");
					$('#apellidos_usuarios').val("");
					$('#usuario_usuarios').val("");
					$('#fecha_nacimiento_usuarios').val("");
					$('#celular_usuarios').val("");
					$('#telefono_usuarios').val("");
					$('#correo_usuarios').val("");
					$('#clave_usuarios').val("");
					$('#clave_usuarios_r').val("");
					    			    
    			  });
				 
				
			});  
            }

            
            
			
		});


 </script>
        
        
         <script type="text/javascript" >
		    // cada vez que se cambia el valor del combo
		    $(document).ready(function(){

			    
		    $("#Cancelar").click(function() 
			{
			 $("#cedula_usuarios").val("");
		     $("#nombre_usuarios").val("");
		     $("#clave_usuarios").val("");
		     $("#clave_usuarios_r").val("");
		     $("#telefono_usuarios").val("");
		     $("#celular_usuarios").val("");
		     $("#correo_usuarios").val("");
		     $("#id_rol").val("");
		     $("#id_estado").val("");
		     $("#fotografia_usuarios").val("");
		     $("#id_usuarios").val("");
		     
		    }); 
		    }); 
			</script>
        
        
        
        
         
        <script  type="text/javascript">
		    // cada vez que se cambia el valor del combo
	    $(document).ready(function(){

		    $("#Guardar").click(function() 
			{
		    	selecionarTodos();
		    	
		    	var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
		    	var validaFecha = /([0-9]{4})\-([0-9]{2})\-([0-9]{2})/;

		    	var cedula_usuarios = $("#cedula_usuarios").val();
		    	var nombre_usuarios = $("#nombre_usuarios").val();
		    			    	
		    	var id_rol  = $("#id_rol").val();
		    	var id_estado  = $("#id_estado").val();
		    	var id_rol_principal = $("#id_rol_principal").val();
		    	
		    	
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

		    	if ($("#apellidos_usuarios").val() == "")
		    	{
			    	
		    		$("#mensaje_apellido_usuarios").text("Introduzca un apellido");
		    		$("#mensaje_apellido_usuarios").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_apellido_usuarios").fadeOut("slow"); //Muestra mensaje de error
		            
				}

				/*para input fecha nacimiento*/				
				if ($("#fecha_nacimiento_usuarios").val() == "")
		    	{
			    	
		    		$("#mensaje_fecha_nacimiento_usuarios").text("Introduzca fecha Nacimiento");
		    		$("#mensaje_fecha_nacimiento_usuarios").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_fecha_nacimiento_usuarios").fadeOut("slow"); //Muestra mensaje de error
		            
				}

				/*para input usuario*/				
				if ($("#usuario_usuarios").val() == "")
		    	{
			    	
		    		$("#mensaje_usuario_usuarios").text("Introduzca Nombre de Usuario");
		    		$("#mensaje_usuario_usuarios").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_usuario_usuarios").fadeOut("slow"); //Muestra mensaje de error
		            
				}

				/*para input celular*/				
				if ($("#celular_usuarios").val() == "")
		    	{
			    	
		    		$("#mensaje_celular_usuarios").text("Introduzca Celular");
		    		$("#mensaje_celular_usuarios").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_celular_usuarios").fadeOut("slow"); //Muestra mensaje de error
		            
				}

				/* input correos */
				
		    	if ($("#correo_usuarios") == "")
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
		    	
		    	    	
			
		    	if ($("#clave_usuarios").val() == "")
		    	{
		    		
		    		$("#mensaje_clave_usuarios").text("Introduzca una Clave");
		    		$("#mensaje_clave_usuarios").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }else if ($("#clave_usuarios").val().length!=4){
			    	$("#mensaje_clave_usuarios").text("Introduzca minimo 4 números");
		    		$("#mensaje_clave_usuarios").fadeIn("slow"); //Muestra mensaje de error
		            return false;
				}
		    	else 
		    	{
		    		$("#mensaje_clave_usuarios").fadeOut("slow"); //Muestra mensaje de error
		            
				}
		    	

		    	if ($("#clave_usuarios_r").val() == "")
		    	{
		    		
		    		$("#mensaje_clave_usuarios_r").text("Introduzca una Clave");
		    		$("#mensaje_clave_usuarios_r").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_clave_usuarios_r").fadeOut("slow"); 
		            
				}
		    	
		    	if ($("#clave_usuarios").val() != $("#clave_usuarios_r").val())
		    	{
			    	
		    		$("#mensaje_clave_usuarios_r").text("Claves no Coinciden");
		    		$("#mensaje_clave_usuarios_r").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else
		    	{
		    		$("#mensaje_clave_usuarios_r").fadeOut("slow"); 
			        
		    	}	

		    	/*para input_select estado usuario*/
		    	var id_estado = $("#id_estado").val();
		    	if (id_estado == 0 )
		    	{
			    	
		    		$("#mensaje_id_estados").text("Seleccione un Estado");
		    		$("#mensaje_id_estados").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else
		    	{
		    		$("#mensaje_id_estados").fadeOut("slow"); 
			        
		    	}	

		    	if (id_rol_principal == 0 )
		    	{
			    	
		    		$("#mensaje_id_rol_principal").text("Seleccione Rol Principal");
		    		$("#mensaje_id_rol_principal").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else
		    	{
		    		$("#mensaje_id_rol_principal").fadeOut("slow"); 
			        
		    	}	
					    

			}); 


		        $( "#cedula_usuarios" ).focus(function() {
				  $("#mensaje_cedula_usuarios").fadeOut("slow");
			    });
				
				$( "#nombre_usuarios" ).focus(function() {
					$("#mensaje_nombre_usuarios").fadeOut("slow");
    			});

				$( "#apellidos_usuarios" ).focus(function() {
					$("#mensaje_apellido_usuarios").fadeOut("slow");
    			});

				$( "#fecha_nacimiento_usuarios" ).focus(function() {
					$("#mensaje_fecha_nacimiento_usuarios").fadeOut("slow");
    			});
    			
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
    			
				$("#id_rol_principal").focus(function() {
					$("#mensaje_id_rol_principal").fadeOut("slow"); 
    			});
			
				
		      
				    
		}); 

	</script>
	
	<script type="text/javascript">
      function validarcedula() {
        var cad = document.getElementById("cedula_usuarios").value.trim();
        var total = 0;
        var longitud = cad.length;
        var longcheck = longitud - 1;

        if (cad !== "" && longitud === 10){
          for(i = 0; i < longcheck; i++){
            if (i%2 === 0) {
              var aux = cad.charAt(i) * 2;
              if (aux > 9) aux -= 9;
              total += aux;
            } else {
              total += parseInt(cad.charAt(i)); // parseInt o concatenará en lugar de sumar
            }
          }

          total = total % 10 ? 10 - total % 10 : 0;

          if (cad.charAt(longitud-1) == total) {
        	  $("#cedula_usuarios").val(cad);
          }else{
        	  $("#mensaje_cedula_usuarios").text("Introduzca Identificación Valida");
	    	$("#mensaje_cedula_usuarios").fadeIn("slow");
        	  document.getElementById("cedula_usuarios").focus();
        	  $("#cedula_usuarios").val("");
        	  
          }
        }
      }
    </script>
	
        
        
        
        
    <script type="text/javascript" >   
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
    
    <script type="text/javascript">
    var interval, mouseMove;

    $(document).mousemove(function(){
        //Establezco la última fecha cuando moví el cursor
        mouseMove = new Date();
        /* Llamo a esta función para que ejecute una acción pasado x tiempo
         después de haber dejado de mover el mouse (en este caso pasado 3 seg) */
        inactividad(function(){
        	window.location.href = "index.php?controller=Usuarios&amp;action=cerrar_sesion";
        }, 600);
      });

    $(document).scroll(function(){
        //Establezco la última fecha cuando moví el cursor
        mouseMove = new Date();
        /* Llamo a esta función para que ejecute una acción pasado x tiempo
         después de haber dejado de mover el mouse (en este caso pasado 3 seg) */
        inactividad(function(){
        	window.location.href = "index.php?controller=Usuarios&amp;action=cerrar_sesion";
        }, 600);
      });

      $(document).keydown(function(){
          //Establezco la última fecha cuando moví el cursor
          mouseMove = new Date();
          /* Llamo a esta función para que ejecute una acción pasado x tiempo
           después de haber dejado de mover el mouse (en este caso pasado 3 seg) */
          inactividad(function(){
          	window.location.href = "index.php?controller=Usuarios&amp;action=cerrar_sesion";
          }, 600);
        });

     

      /* Función creada para ejecutar una acción (callback), al pasar x segundos 
         (seconds) de haber dejado de mover el cursor */
      var inactividad = function(callback, seconds){
        //Elimino el intervalo para que no se ejecuten varias instancias
        clearInterval(interval);
        //Creo el intervalo
        interval = setInterval(function(){
           //Hora actual
           var now = new Date();
           //Diferencia entre la hora actual y la última vez que se movió el cursor
           var diff = (now.getTime()-mouseMove.getTime())/1000;
           //Si la diferencia es mayor o igual al tiempo que pasastes por parámetro
           if(diff >= seconds){
            //Borro el intervalo
            clearInterval(interval);
            //Ejecuto la función que será llamada al pasar el tiempo de inactividad
            callback();          
           }
        }, 200);
      }
    </script>

	
	
	<script src="view/bootstrap/otros/inputmask_bundle/jquery.inputmask.bundle.js"></script>
       <script>
      $(document).ready(function(){
      $(".cantidades1").inputmask();
      });
	  </script>
 	
 	
 	
             
 	
  </body>
</html>

 