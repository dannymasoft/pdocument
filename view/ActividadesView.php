<!DOCTYPE HTML>
<html lang="es">
      <head>
         
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Capremci</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
 
   <?php include("view/modulos/links_css.php"); ?>
	
        
         <script type="text/javascript">
     
        	   $(document).ready( function (){
        		   
        		   load_actividades(1);


        		 			  $("#buscar").click(function() 
        					{
        				    	var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
        				    	var validaFecha = /([0-9]{4})\-([0-9]{2})\-([0-9]{2})/;

        				    	var desde = $("#desde").val();
        				    	var hasta = $("#hasta").val();
        				    	
        				    	
        				    	


        						if(desde > hasta){

        							$("#mensaje_desde").text("Fecha desde no puede ser mayor a hasta");
        				    		$("#mensaje_desde").fadeIn("slow"); //Muestra mensaje de error
        				            return false;
        				            
            					}else 
        				    	{
        				    		$("#mensaje_desde").fadeOut("slow"); //Muestra mensaje de error
        				    		load_actividades(1);
        						} 


        						if(hasta < desde){

        							$("#mensaje_hasta").text("Fecha hasta no puede ser menor a desde");
        				    		$("#mensaje_hasta").fadeIn("slow"); //Muestra mensaje de error
        				            return false;
        				            
            					}else 
        				    	{
        				    		$("#mensaje_hasta").fadeOut("slow"); //Muestra mensaje de error
        				    		load_actividades(1);
        						} 
        						
        				    					    

        					}); 


        				        $( "#desde" ).focus(function() {
        						  $("#mensaje_desde").fadeOut("slow");
        					    });
        						
        				        $( "#hasta" ).focus(function() {
          						  $("#mensaje_hasta").fadeOut("slow");
          					    });
        						


        		   
	   			});

        	  

        	   
        	   function load_actividades(pagina){


        		   var search=$("#search").val();
        		   var desde=$("#desde").val();
        		   var hasta=$("#hasta").val();
        		   var con_datos={
           					  action:'ajax',
           					  page:pagina,
           					  desde:desde,
           					  hasta:hasta
           					  };
                 $("#load_registrados").fadeIn('slow');
           	     $.ajax({
           	               beforeSend: function(objeto){
           	                 $("#load_registrados").html('<center><img src="view/images/ajax-loader.gif"> Cargando...</center>')
           	               },
           	               url: 'index.php?controller=Actividades&action=search_actividades&search='+search,
           	               type: 'POST',
           	               data: con_datos,
           	               success: function(x){
           	                 $("#actividades_registrados").html(x);
           	               	 $("#tabla_actividades").tablesorter(); 
           	                 $("#load_registrados").html("");
           	               },
           	              error: function(jqXHR,estado,error){
           	                $("#actividades_registrados").html("Ocurrio un error al cargar la información de activiades..."+estado+"    "+error);
           	              }
           	            });


           		   }
        </script>
        
   
		     
			        
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
        <li><a href="<?php echo $helper->url("Usuarios","Bienvenida"); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Controladores</li>
      </ol>
    </section>   

    <section class="content">
     <div class="box box-primary">
     <div class="box-header">
          <h3 class="box-title">Buscar Actividades</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            
          </div>
        </div>
        
                  
                  <div class="box-body">

								 	  <div class="row">
                		  	   
                              	
                                    <div class="col-xs-6 col-md-3 col-lg-3">
                                  	<div class="form-group">
                                    	<label for="desde" class="control-label">Desde:</label>
                                        <input type="date" class="form-control" id="desde" name="desde" value="" placeholder="desde.."  >
                                        <div id="desde" class="errores"></div>
                                     </div>
                              </div>
                             <div class="col-xs-6 col-md-3 col-lg-3 ">
                                	<div class="form-group">
                                    	<label for="hasta" class="control-label">Hasta:</label>
                                        <input type="date" class="form-control" id="hasta" name="hasta" value="" placeholder="hasta.."  >
                                        <div id="hasta" class="errores"></div>
                                     </div>
                               </div>  
                            </div>	   
					   
                           		<div class="row">
                    			    <div class="col-xs-12 col-md-12 col-md-12 " style="margin-top:15px;  text-align: center; ">
 		                	   		    <div class="form-group">
                    	                  <button type="button" id="buscar" name="buscar" class="btn btn-success">Buscar</button>
        	    	                    </div>
            	        		    </div>
                    		    </div>
 
                      
                      
                      <div class="pull-right" style="margin-right:11px;">
					<input type="text" value="" class="form-control" id="search" name="search" onkeyup="load_actividades(1)" placeholder="search.."/>
					</div>
					
					
					<div id="load_registrados" ></div>	
					<div id="actividades_registrados"></div>	
                      
                      
                      
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

