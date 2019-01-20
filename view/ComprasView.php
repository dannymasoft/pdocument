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
              <h3 class="box-title">Registrar Compras</h3>
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
                                	<label for="usuario_usuarios" class="control-label">Usuario:</label>
                                    <input type="text" class="form-control" id="usuario_usuarios" name="usuario_usuarios" value="<?php echo $resEdit->usuario_usuarios; ?>"  placeholder="usuario..." >
                                    <div id="usuario_usuarios" class="errores"></div>
                                 </div>
                             </div> 
                          </div>
                          
                          
                          
                    		
                    		
                           
                                
                      <?php } } else {?>      
                          
                          <div class="row">                		      
                    			
                    		    <div class="col-xs-6 col-md-3 col-lg-3">
                            		<div class="form-group">
                                      <label for="clave_usuarios" class="control-label">Password:</label>
                                      <input type="password" class="form-control" id="clave_usuarios" name="clave_usuarios" value="" placeholder="(solo números..)" maxlength="4" onkeypress="return numeros(event)">
                                      <div id="mensaje_clave_usuarios" class="errores"></div>
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
      			
    		</section>
    		
    		
    		
    		
       <section class="content">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Orden Compra</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                
              </div>
            </div>
            
            <div class="box-body">
            <table id="example" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th></th>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Position</th>
                        <th>Office</th>
                        <th width="18%">Start date</th>
                        <th>Salary</th>
                    </tr>
                </thead>
            </table>
            
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
 var editor; // use a global for the submit and return data rendering in the examples
 
 $(document).ready(function() {
     editor = new $.fn.dataTable.Editor( {
         ajax: "../php/staff.php",
         table: "#example",
         fields: [ {
                 label: "First name:",
                 name: "first_name"
             }, {
                 label: "Last name:",
                 name: "last_name"
             }, {
                 label: "Position:",
                 name: "position"
             }, {
                 label: "Office:",
                 name: "office"
             }, {
                 label: "Extension:",
                 name: "extn"
             }, {
                 label: "Start date:",
                 name: "start_date",
                 type: "datetime"
             }, {
                 label: "Salary:",
                 name: "salary"
             }
         ]
     } );
  
     // Activate an inline edit on click of a table cell
     $('#example').on( 'click', 'tbody td:not(:first-child)', function (e) {
         editor.inline( this );
     } );
  
     $('#example').DataTable( {
         dom: "Bfrtip",
         ajax: "../php/staff.php",
         order: [[ 1, 'asc' ]],
         columns: [
             {
                 data: null,
                 defaultContent: '',
                 className: 'select-checkbox',
                 orderable: false
             },
             { data: "first_name" },
             { data: "last_name" },
             { data: "position" },
             { data: "office" },
             { data: "start_date" },
             { data: "salary", render: $.fn.dataTable.render.number( ',', '.', 0, '$' ) }
         ],
         select: {
             style:    'os',
             selector: 'td:first-child'
         },
         buttons: [
             { extend: "create", editor: editor },
             { extend: "edit",   editor: editor },
             { extend: "remove", editor: editor }
         ]
     } );
 } );
 </script>
 
  <script type="text/javascript">
     
   $(document).ready( function (){
	   
	   /*pone_espera();*/
	  
	   /*para manejo de multiples roles*/
	    /**$("#link_agregar_rol").click(function() {
			return !($('#id_rol option:selected').clone()).appendTo('#lista_roles'); 
	    });*/
	   

		

		
});

 

   
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
     

             
 	
  </body>
</html>

 