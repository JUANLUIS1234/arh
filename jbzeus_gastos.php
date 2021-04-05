<?php
	
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }

	/* Connect To Database*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
	$active_facturas="";
	$active_productos="";
	$active_clientes="";
	$active_JBGastos="active";	
	$title="JB Gastos";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<?php include("head.php");?>
  </head>
  <body>
 	<?php
	include("navbar.php");
	?> 
    <div class="container">
		<div class="panel panel-info">
		<div class="panel-heading">
		    <div class="btn-group pull-right">
				<button type='button' class="btn btn-primary" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus" ></span> Nuevo Registro JB</button>
			</div>
			<h4><i class='glyphicon glyphicon-search'></i> Buscar Registros JB</h4>
		</div>			
			<div class="panel-body">
			<?php
			include("modal/registro_jb.php");
			include("modal/editar_jbgastos.php");
			//include("modal/cambiar_password.php");
			?>
			<form class="form-horizontal" role="form" id="datos_cotizacion">
				
						<div class="form-group row">
							<label for="q" class="col-md-2 control-label">Registros:</label>
							<div class="col-md-5">
							<input style="background-color: lightyellow" type="text" class="form-control" id="q" placeholder="registro" onkeyup='load(1);'>
							</div>
							
							
							
							<div class="col-md-3">
								<button type="button" class="btn btn-info" onclick='load(1);'>
									<span class="glyphicon glyphicon-search" ></span> Buscar</button>
								<span id="loader"></span>
							</div>
							
						</div>
				
				
				
			</form>
				<div id="resultados"></div><!-- Carga los datos ajax -->
				<div class='outer_div'></div><!-- Carga los datos ajax -->
						
			</div>
		</div>

	</div>
	<hr>
	<?php
	include("footer.php");
	?>
	<script type="text/javascript" src="js/jbzeus.js"></script>

	
	


  </body>
</html>
<script>
$( "#guardar_registro" ).submit(function( event ) {
  $('#guardar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/nuevo_registrojb.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados_ajax").html(datos);
			$('#guardar_datos').attr("disabled", false);
			load(1);
		  }
	});
  event.preventDefault();
})

$( "#editar_registro" ).submit(function( event ) {
  $('#actualizar_datos2').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/editar_registrojb.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax2").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados_ajax2").html(datos);
			$('#actualizar_datos').attr("disabled", false);
			load(1);
		  }
	});
  event.preventDefault();
})


	function get_user_id(id){
		$("#user_id_mod").val(id);
	}

	function obtener_datos(id){
		    var factura = $("#factura"+id).val();
			var descripcion = $("#descripcion"+id).val();
			var monto = $("#monto"+id).val();
			var concepto = $("#concepto"+id).val();
			var periodo = $("#periodo"+id).val();
			var año = $("#año"+id).val();
			var fecha =$("#fecha"+id).val();
			
			$("#mod_id").val(id);
			$("#factura2").val(factura);
			$("#descripcion2").val(descripcion);
			$("#monto2").val(monto);
			$("#concepto2").val(concepto);
			$("#periodo2").val(periodo);
			$("#fecha2").val(fecha);
			$("#año2").val(año);
			
			
		}
</script>