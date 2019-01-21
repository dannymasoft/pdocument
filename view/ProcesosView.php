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
              <h3 class="box-title">Buscar</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                
              </div>
            </div>
            
            <div class="box-body">
            
                <form action="<?php echo $helper->url("Usuarios","InsertaUsuarios"); ?>" method="post" enctype="multipart/form-data" class="col-lg-12 col-md-12 col-xs-12">
          		 	                 		    
					<div class="row">
						<div class="col-xs-6 col-md-4 col-lg-4 ">
							<div class="form-group">
								<label for="cedula_clientes" class="control-label">Cedula:</label>
								<div class="input-group margin">
									<input type="text" class="form-control" id="cedula_clientes" name="cedula_clientes" value=""  placeholder="cedula.." >
									<input type="hidden" class="form-control" id="id_clientes" name="id_clientes" value="0" >
									<div id="mensaje_cedula_clientes" class="errores"></div>
										<span class="input-group-btn">
										<button type="button" class="btn btn-info btn-flat">Buscar</button>
										</span>
								</div>
															
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
              <h3 class="box-title">Procesos</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                
              </div>
            </div>
            
            <div class="box-body">
            
            
           <div class="nav-tabs-custom">
            <ul class="nav nav-tabs" id="mytab">
              <li ><a  href="#nivel2" data-toggle="tab">Nivel 2</a></li>
              <li><a href="#nivel1" data-toggle="tab">Nivel 1</a></li>
            </ul>
            
            <div class="col-md-12 col-lg-12 col-xs-12">
            <div class="tab-content">
            <br>
              <div class="tab-pane " id="nivel2">
				
			  	<div class="row">
					<div class="col-lg-4">
						<a class="btn btn-app">
						<i class="fa fa-folder-o"></i> CORPORATIVO
						</a>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-4">
						<a class="btn btn-app">
						<i class="fa fa-folder-o"></i> PERSONAL
						</a>
					</div>
				</div>
					
              </div>
              
              <div class="tab-pane" id="nivel1">
                
                   hola
                
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
   
   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
   <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  
   <!-- para el autocompletado -->
    
 
 <!-- funciones javascript para la pagina -->
 
  <script type="text/javascript">
     
   $(document).ready( function (){
	   
	   /*pone_espera();*/
	   //load_usuarios(1);
	   //load_usuarios_inactivos(1);

	   //$('[data-mask]').inputmask();

		
});

   
        	   
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

	var cedula_clientes = $("#cedula_clientes").val();

	
		$( "#cedula_clientes" ).autocomplete({

			source: "<?php echo $helper->url("Clientes","AutocompleteCedula"); ?>",
			minLength: 4
		});

		$("#cedula_clientes").focusout(function(){
			validarcedula();
			$.ajax({
				url:'<?php echo $helper->url("Clientes","AutocompleteDevuelveNombres"); ?>',
				type:'POST',
				dataType:'json',
				data:{cedula_clientes:$('#cedula_clientes').val()}
			}).done(function(respuesta){
				
				if(parseInt(respuesta.id_clientes)>0){
					
					$('.nav-tabs a[href="#nivel2"]').tab('show');
					$('#id_clientes').val(respuesta.id_clientes);
				}
			
			}).fail(function(respuesta) {

				$('#id_clientes').val("");
				
			
			});  		
		});
	
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
				
		    

			}); 


		        $( "#cedula_clientes" ).focus(function() {
				  $("#mensaje_cedula_clientes").fadeOut("slow");
			    });
				
				    
		}); 

	</script>
	
	<script type="text/javascript">
      function validarcedula() {
        var cad = document.getElementById("cedula_clientes").value.trim();
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
        	  $("#cedula_clientes").val(cad);
          }else{
        	  $("#mensaje_cedula_clientes").text("Introduzca Identificación Valida");
	    	$("#mensaje_cedula_clientes").fadeIn("slow");
        	  document.getElementById("cedula_clientes").focus();
        	  $("#cedula_clientes").val("");
        	  
          }
        }
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
         
 	
  </body>
</html>

 