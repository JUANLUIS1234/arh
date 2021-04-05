<?php
	/*-------------------------
	Autor: INNOVAWEBSV
	Web: www.innovawebsv.com
	Mail: info@innovawebsv.com
	---------------------------*/
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }

    /* Connect To Database*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
	
	$active_cargafichajes="active";
	$title="Fichajes";
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
				<button type='button' class="btn btn-primary" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus" ></span> Carga Fichas</button>
			</div>
			<h4><i class='glyphicon glyphicon-list'></i> Listado de Jugadores Fichados</h4>
		</div>
			<div class="panel-body">
			<?php
			include("modal/registro_fichas.php");
			include("modal/editar_fichas.php");
			
			?>
				<form class="form-horizontal" role="form" id="datos_fichas">
				
						<div class="form-group row">
							<label for="q" class="col-md-2 control-label">Fichas</label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="q"  placeholder="Apellido" onkeyup='load(1);'>
							</div>
							
							<div class="col-md-3">
								<button type="button" class="btn btn-info" onclick='load(1);'>
									<span class="glyphicon glyphicon-search" ></span> Buscar</button>
								<span id="loader"></span>
							</div>
							<div class="col-md-12">
							<div class="pull-right">
							<button type="submit" class="btn btn-default">
						  <span class="glyphicon glyphicon-print"></span> Imprimir
						</button>
				</div>
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
	
	<script type="text/javascript" src="js/fichas.js"></script>
  </body>
</html>
<script>
$( "#guardar_fichas" ).submit(function( event ) {
  $('#guardar_datos').attr("disabled", true);
  
	 var parametros = $(this).serialize();
		 $.ajax({
				type: "POST",
				url: "ajax/nuevo_fichas.php",
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

$( "#editar_fichas" ).submit(function( event ) {
  $('#actualizar_datos2').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/editar_fichas.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax2").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados_ajax2").html(datos);
			$('#actualizar_datos2').attr("disabled", false);
			load(1);
		  }
	});
  event.preventDefault();
})


	function get_user_id(id){
		$("#user_id_mod").val(id);
	}

	function obtener_datos(id){
			var dni = $("#dni"+id).val();
			var recibo = $("#recibo"+id).val();
			var contribuyente = $("#contribuyente"+id).val();
			var club = $("#club"+id).val();
			var cuota = $("#cuota"+id).val();
			var monto = $("#monto"+id).val();
			var fecha = $("#fecha"+id).val();
			var periodo = $("#periodo"+id).val();
			var año = $("#año"+id).val();
			var estado = $("#estado"+id).val();
			
			
			$("#mod_id").val(id);
			$("#dni2").val(dni);
			$("#recibo2").val(recibo);
			$("#contribuyente2").val(contribuyente);
			$("#club2").val(club);
			$("#cuota2").val(cuota);
			$("#monto2").val(monto);
			$("#fecha2").val(fecha);
			$("#periodo2").val(periodo);
			$("#estado2").val(estado);
			$("#año2").val(año);
			
			
		}
</script>