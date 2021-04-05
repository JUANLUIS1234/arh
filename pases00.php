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
	
	$active_pases="active";
	$title="Pases";
?>
<!DOCTYPE html>
<html lang="en">

  <head>
	<?php include("head.php");?>

  </head>
  <body>
	<?php
	include("navbar.php"); 
	$row='';
	$consulta='';
if (isset($_POST['enviar'])) {
	$Consultar= $_POST['dni'];

	$consulta=mysqli_query($con,"SELECT * FROM jugadores WHERE DNI='".$Consultar."'");

		$row = $consulta->fetch_assoc();
	
	
				
 }

	?>  
    <div class="container">
		<div class="panel panel-info">
		<div class="panel-heading">
		  <div class="btn-group pull-right">
				<button type='button' class="btn btn-primary" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus" ></span> Nuevo Pase</button>
			</div>
			<h4><i class='glyphicon glyphicon-list'></i> Planilla Pases de Jugadores</h4>
		</div>
			<div class="panel-body">
			<?php
			
			include("modal/editar_pases.php");
			
			?>
			<form class="form-horizontal" method="post" id="editar_jugador" name="editar_jugador">
							<div class="form-group row">
					

		
				<label for="q" class="col-md-1 control-label">Dni</label>
					<div class="col-md-3">
				<input style="background-color: lightyellow" type="text" class="form-control"  id="dni" name="dni"  placeholder="Dni" >
					<div class="pull-right">
							<button type="submit" class="btn btn-info" name="enviar"  >
								<span class="glyphicon glyphicon-search" ></span> Consultar</button>
								</div>
						</div>
<?php 

if ($row) {?>
	<label for="nombre2" class="col-md-1 control-label">Nombre</label>
				  <div class="col-md-3">
				 <input type="text" class="form-control input-sm" id="nombre2" name="nombre2" placeholder="Nombre y Apellido" value="<?php echo " ".$row['APELLIDO_Y_NOMBRE'] ?>" >
					  
				  </div>
				  <label for="club2" class="col-md-1 control-label">Club Origen</label>
				  <div class="col-md-3">
					  <input type="text" class="form-control input-sm" id="club2" name="club2" placeholder="club" value="<?php echo " ".$row['CLUB'] ?>">
					  
				  </div>
	<?php
}
 
?>

						</div>

				<div class="form-group row">
							<label for="empresa" class="col-md-1 control-label">Club Destino</label>
							<div class="col-md-3">
							<select class="form-control input-sm" id="id_vendedor">
									<?php
									  session_start();
										$jugador=mysqli_query($con,"SELECT * FROM jugadores");
								while($row = $jugador->fetch_assoc()):
					?>
									<option value="<?php echo $row['ID']?>" ><?php echo $row['CLUB']?></option>
										<?php endwhile; ?>	
								</select>
							</div>
							<label for="tel2" class="col-md-1 control-label">Fecha</label>
							<div class="col-md-2">
								<input type="text" class="form-control input-sm" id="fecha" value="<?php echo date("d/m/Y");?>" readonly>
							</div>
							<label for="nomto2" class="col-md-1 control-label">Monto</label>
				  <div class="col-md-3">
					  <input type="text" class="form-control input-sm" id="nomto2" name="nomto2" placeholder="Monto">
					  
				  </div>
						</div>
			<div class="form-group" >
					<div class="btn-group pull-right">
			<button type="submit" class="btn btn-warning" id="actualizar_datos2">
						 <span class="glyphicon glyphicon-search"></span> Pases jugadores
						</button>
						
						<button type="submit" class="btn btn-success">
						  <span class="glyphicon glyphicon-print"></span> Imprimir
						</button>
					
					</div>	
				</div>
				<div class="form-group row" >
					<label for="q" class="col-md-1 control-label">Jugador</label>
							<div class="col-md-3">
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
	
	<script type="text/javascript" src="js/pases.js"></script>
  </body>
</html>
<script>
$( "#guardar_jugador" ).submit(function( event ) {
  $('#guardar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/nuevo_pases.php",
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
			url: "ajax/editar_pases.php",
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
			var monto = $("#monto"+id).val();
			var destino = $("#destino"+id).val();
			
			var club = $("#club"+id).val();
			
			$("#mod_id").val(id);
			$("#dni2").val(dni);
			$("#nombre2").val(apellidos);
			$("#fecha2").val(fecha);
			$("#destino2").val(destino);
			$("#monto2").val(monto);
			$("#club2").val(club);
			
		}
</script>