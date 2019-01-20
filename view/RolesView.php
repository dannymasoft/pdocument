<!DOCTYPE html>
<html lang="en">
  <head>
  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Capremci</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    
    
   <?php include("view/modulos/links_css.php"); ?>
   
  </head>
   <script>
		    // cada vez que se cambia el valor del combo
		    $(document).ready(function(){
		    
		    $("#Guardar").click(function() 
			{
		    	var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
		    	var validaFecha = /([0-9]{4})\-([0-9]{2})\-([0-9]{2})/;

		    	var nombre_controladores = $("#nombre_rol").val();
		    	
		    	
		    	
		    	if (nombre_controladores == "")
		    	{
			    	
		    		$("#mensaje_nombre_rol").text("Introduzca Un Rol");
		    		$("#mensaje_nombre_rol").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_nombre_rol").fadeOut("slow"); //Muestra mensaje de error
		            
				}   


		    	
			}); 


		        $( "##mensaje_nombre_rol" ).focus(function() {
				  $("##mensaje_nombre_rol").fadeOut("slow");
			    });
		        		      
				    
		}); 

	</script>
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
            <li class="active">Roles</li>
          </ol>
        </section>
        
        <section class="content">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Registrar Roles</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                
              </div>
            </div>
            
            <div class="box-body">
            
                <form action="<?php echo $helper->url("Roles","InsertaRoles"); ?>" method="post" class="col-lg-12 col-md-12 col-xs-12">
          		 	 <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
              		 	 <div class="row">
                         	<div class="col-xs-12 col-md-3 col-md-3 ">
                            	<div class="form-group">
                                	<label for="nombre_rol" class="control-label">Nombres Rol</label>
                                    <input type="text" class="form-control" id="nombre_rol" name="nombre_rol" value="<?php echo $resEdit->nombre_rol; ?>"  placeholder="Nombre Rol">
                                    <input type="hidden" name="id_rol" id="id_rol" value="<?php echo $resEdit->id_rol; ?>" class="form-control"/>
    					            <div id="mensaje_nombre_rol" class="errores"></div>
                                 </div>
                             </div>
                          </div>
                      <?php } } else {?>                		    
                      	  <div class="row">
                		  	<div class="col-xs-12 col-md-3 col-md-3 ">
                    			<div class="form-group">
                                  <label for="nombre_rol" class="control-label">Nombres Rol</label>
                                  <input type="text" class="form-control" id="nombre_rol" name="nombre_rol" value=""  placeholder="Nombre Rol">
                                  <div id="mensaje_nombre_rol" class="errores"></div>
                                 </div>
                             </div>
                            </div>	
                    		            
                    		            
                     <?php } ?>
                     	<div class="row">
            			    <div class="col-xs-12 col-md-4 col-md-4 " style="margin-top:15px;  text-align: center; ">
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
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Listado de Roles Registrados</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>                
              </div>
            </div>
        
            <div class="ibox-content">  
      		<div class="table-responsive">       
        	<table id="example1" class="table table-striped table-bordered table-hover dataTables-example">
                  <thead>
                   <tr>
                      <th>#</th>
                      <th>Nombre Rol</th>
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
            		               <td > <?php echo $res->nombre_rol; ?>     </td> 
            		               <td>
            			           		<div class="right">
            			                    <a href="<?php echo $helper->url("Roles","index"); ?>&id_rol=<?php echo $res->id_rol; ?>" class="btn btn-warning" style="font-size:65%;"><i class='glyphicon glyphicon-edit'></i></a>
            			                </div>
            			            
            			             </td>
            			             <td>   
            			                	<div class="right">
            			                    <a href="<?php echo $helper->url("Roles","borrarId"); ?>&id_rol=<?php echo $res->id_rol; ?>" class="btn btn-danger" style="font-size:65%;"><i class="glyphicon glyphicon-trash"></i></a>
            			                </div>
            			              
            		               </td>
            		    		</tr>
            		        <?php } } ?>
                    
                    </tbody>
                </table>
        
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
       
       
      
 




