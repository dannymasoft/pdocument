<!DOCTYPE html>
<html lang="en">
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

		    	var nombre_grupos = $("#nombre_grupos").val();
		    	
		    	
		    	
		    	if (nombre_grupos == "")
		    	{
			    	
		    		$("#mensaje_nombre_grupos").text("Introduzca Un Grupo");
		    		$("#mensaje_nombre_grupos").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_nombre_grupos").fadeOut("slow"); //Muestra mensaje de error
		            
				}   


		    	
			}); 


		        $( "#nombre_grupos" ).focus(function() {
				  $("#mensaje_nombre_grupos").fadeOut("slow");
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
            <li class="active">Grupos</li>
          </ol>
        </section>
        
        <section class="content">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Registrar Grupos</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                
              </div>
            </div>
            
            <div class="box-body">
            
                <form action="<?php echo $helper->url("Grupos","InsertaGrupos"); ?>" method="post" class="col-lg-12 col-md-12 col-xs-12">
          		 	 <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
              		 	 <div class="row">
                         	<div class="col-xs-12 col-lg-3 col-md-3 ">
                            	<div class="form-group">
                                	<label for="nombre_grupos" class="control-label">Nombres Grupos</label>
                                    <input type="text" class="form-control" id="nombre_grupos" name="nombre_grupos" value="<?php echo $resEdit->nombre_grupos; ?>"  placeholder="Nombre Grupos">
                                    <input type="hidden" name="id_grupos" id="id_grupos" value="<?php echo $resEdit->id_grupos; ?>" class="form-control"/>
    					            <div id="mensaje_nombre_grupos" class="errores"></div>
                                 </div>
                                  </div>
                                 <div class="col-xs-12 col-md-3 col-lg-3">
                        		   <div class="form-group">
                                      <label for="id_estado" class="control-label">Estado:</label>
                                      <select name="id_estado" id="id_estado"  class="form-control" >
                                      <option value="0" selected="selected">--Seleccione--</option>
    									<?php  foreach($result_Grupos_estados as $res) {?>
    										<option value="<?php echo $res->valor_catalogo; ?>" <?php if ($res->valor_catalogo == $resEdit->estado_grupos )  echo  ' selected="selected" '  ;  ?> ><?php echo $res->nombre_catalogo; ?> </option>
    							        <?php } ?>
    								   </select> 
                                      <div id="mensaje_id_estados" class="errores"></div>
                                    </div>
                                  </div>
                            
                          </div>
                      <?php } } else {?>                		    
                      	  <div class="row">
                		  	<div class="col-xs-12 col-lg-3 col-md-3 ">
                    			<div class="form-group">
                                  <label for="nombre_grupos" class="control-label">Nombres Grupos</label>
                                  <input type="text" class="form-control" id="nombre_grupos" name="nombre_grupos" value=""  placeholder="Nombre Grupos">
                                   <input type="hidden" name="id_grupos" id="id_grupos" value="" class="form-control"/>
                                  <div id="mensaje_nombre_grupos" class="errores"></div>
                                 </div>
                             </div>
                             
                             <div class="col-xs-12 col-md-3 col-lg-3">
                        		   <div class="form-group">
                                      <label for="id_estado" class="control-label">Estado:</label>
                                      <select name="id_estado" id="id_estado"  class="form-control" >
                                      <option value="0" selected="selected">--Seleccione--</option>
    									<?php foreach($result_Grupos_estados as $res) {?>
    										<option value="<?php echo $res->valor_catalogo; ?>" ><?php echo $res->nombre_catalogo; ?> </option>
    							        <?php } ?>
    								   </select> 
                                      <div id="mensaje_id_estados" class="errores"></div>
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
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Listado Grupos</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                
              </div>
            </div>
            
            <div class="box-body">
            
            
            
            
            
           <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activos" data-toggle="tab">Grupos Activos</a></li>
              <li><a href="#inactivos" data-toggle="tab">Grupos Inactivos</a></li>
            </ul>
            
            <div class="col-md-12 col-lg-12 col-xs-12">
            <div class="tab-content">
            <br>
              <div class="tab-pane active" id="activos">
                
					<div class="pull-right" style="margin-right:15px;">
						<input type="text" value="" class="form-control" id="search_activos" name="search_activos" onkeyup="load_grupos_activos(1)" placeholder="search.."/>
					</div>
					<div id="load_grupos_activos" ></div>	
					<div id="grupos_activos_registrados"></div>	
                
              </div>
              
              <div class="tab-pane" id="inactivos">
                
                    <div class="pull-right" style="margin-right:15px;">
					<input type="text" value="" class="form-control" id="search_inactivos" name="search_inactivos" onkeyup="load_grupos_inactivos(1)" placeholder="search.."/>
					</div>
					
					
					<div id="load_grupos_inactivos" ></div>	
					<div id="grupos_inactivos_registrados"></div>
                
                
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
    	
  </body>
</html>

<!-- script pagina anterior -->
<script type="text/javascript">
     
        	   $(document).ready( function (){
        		   
        		   load_grupos_inactivos(1);
        		   load_grupos_activos(1);
        		   
	   			});

        	


	   function load_grupos_activos(pagina){

		   var search=$("#search_activos").val();
	       var con_datos={
					  action:'ajax',
					  page:pagina
					  };
			  
	     $("#load_grupos_activos").fadeIn('slow');
	     
	     $.ajax({
	               beforeSend: function(objeto){
	                 $("#load_grupos_activos").html('<center><img src="view/images/ajax-loader.gif"> Cargando...</center>');
	               },
	               url: 'index.php?controller=Grupos&action=consulta_grupos_activos&search='+search,
	               type: 'POST',
	               data: con_datos,
	               success: function(x){
	                 $("#grupos_activos_registrados").html(x);
	                 $("#load_grupos_activos").html("");
	                 $("#tabla_grupos_activos").tablesorter(); 
	                 
	               },
	              error: function(jqXHR,estado,error){
	                $("#grupos_activos_registrados").html("Ocurrio un error al cargar la informacion de Grupos Activos..."+estado+"    "+error);
	              }
	            });


		   }

	   function load_grupos_inactivos(pagina){

		   var search=$("#search_inactivos").val();
	       var con_datos={
					  action:'ajax',
					  page:pagina
					  };
			  
	     $("#load_grupos_inactivos").fadeIn('slow');
	     
	     $.ajax({
	               beforeSend: function(objeto){
	                 $("#load_grupos_inactivos").html('<center><img src="view/images/ajax-loader.gif"> Cargando...</center>');
	               },
	               url: 'index.php?controller=Grupos&action=consulta_grupos_inactivos&search='+search,
	               type: 'POST',
	               data: con_datos,
	               success: function(x){
	                 $("#grupos_inactivos_registrados").html(x);
	                 $("#load_grupos_inactivos").html("");
	                 $("#tabla_grupos_inactivos").tablesorter(); 
	                 
	               },
	              error: function(jqXHR,estado,error){
	                $("#grupos_inactivos_registrados").html("Ocurrio un error al cargar la informacion de Grupos Inactivos..."+estado+"    "+error);
	              }
	            });


		   }

	  
        	        	   

 </script>
 
 
<!-- -----cargar la tabla activos e inactivos -->


        
        
       
       
      
 




