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
	
	$active_cargajugador="active";
	$title="Jugadores";
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
				<button type='button' class="btn btn-primary" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus" ></span> Nuevo Jugador</button>
			</div>
			<h4><i class='glyphicon glyphicon-list'></i> Listado de Jugadores</h4>
		</div>
			<div class="panel-body">
			<?php
			include("modal/registro_jugador.php");
			include("modal/editar_jugador.php");
			
			?>
			<form class="form-horizontal" role="form" id="datos_jugadores">
				
						<div class="form-group row">
							<label for="q" class="col-md-2 control-label">Jugador</label>
							<div class="col-md-5">
								<input style="background-color: lightyellow" type="text" class="form-control" id="q"  placeholder="Dni, Apellido, club" onkeyup='load(1);'>
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
	
	<script type="text/javascript" src="js/jugador.js"></script>
  </body>
</html>
<script>
$( "#guardar_jugador" ).submit(function( event ) {
  $('#guardar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/nuevo_jugador.php",
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

$( "#editar_jugador" ).submit(function( event ) {
  $('#actualizar_datos2').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/editar_jugador.php",
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
			var apellidos = $("#nombre"+id).val();
			var fecha = $("#fecha"+id).val();
			var sexo = $("#sexo"+id).val();
			var provincia = $("#provincia"+id).val();
			var direccion = $("#direccion"+id).val();
			var sanguineo = $("#sanguineo"+id).val();
			var social = $("#social"+id).val();
			var telefono = $("#telefono"+id).val();
			var historial = $("#historial"+id).val();
			var correo = $("#correo"+id).val();
			var documentacion = $("#documentacion"+id).val();
			var categoria = $("#categoria"+id).val();
			var club = $("#club"+id).val();
			
			$("#mod_id").val(id);
			$("#dni2").val(dni);
			$("#nombre2").val(apellidos);
			$("#fecha2").val(fecha);
			$("#sexo2").val(sexo);
			$("#provincia2").val(provincia);
			$("#direccion2").val(direccion);
			$("#sanguineo2").val(sanguineo);
			$("#social2").val(social);
			$("#telefono2").val(telefono);
			$("#historial2").val(historial);
			$("#correo2").val(correo);
			$("#documentacion2").val(documentacion);
			$("#categoria2").val(categoria);
			$("#club2").val(club);
			
		}
</script>