<?php
	/*-------------------------
	Autor: Obed Alvarado
	Web: obedalvarado.pw
	Mail: info@obedalvarado.pw
	---------------------------*/
	
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }
	$active_pases="active";
	$title="Pases";
	
	/* Connect To Database*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
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
			<h4><i class='glyphicon glyphicon-edit'></i> Nuevo Pase</h4>
		</div>
		<div class="panel-body">
		<?php 
			include("modal/editar_pases.php");
			
		?>
			<form class="form-horizontal" method="post" id="guardar_jugador" name="guardar_jugador">
				<div class="form-group row">
				  <label for="dni_jugador" class="col-md-1 control-label">DNI</label>
				  <div class="col-md-2">
					  <input type="text" class="form-control input-sm" id="dni_jugador" name="dni_jugador" placeholder="Selecciona un dni" required>
					  	
				  </div>
				  <label for="nombre_jugador" class="col-md-1 control-label">Jugador/a</label>
							<div class="col-md-3">
								<input type="text" class="form-control input-sm" id="nombre_jugador" name="nombre_jugador" placeholder="Nombre y Apellido" readonly>
							</div>
					<label for="origen" class="col-md-1 control-label">Club Origen</label>
							<div class="col-md-3">
								<input type="text" class="form-control input-sm" id="origen" name="origen" placeholder="CLUB" readonly>
							</div>
				 </div>
						<div class="form-group row">
							<label for="destino" class="col-md-1 control-label">Club Destino</label>
							<div class="col-md-3">
								<select class="form-control input-sm" id="destino" name="destino">
									<?php
										$sql_club=mysqli_query($con,"select * from clubes order by CLUB");
										while ($rw=mysqli_fetch_array($sql_club)){
											$id_club=$rw["ID"];
								$nombre_club=$rw["CLUB"]." ";
											
											?>
											<option value="<?php echo $nombre_club?>"><?php echo $nombre_club?></option>
											<?php
										}
									?>
								</select>
							</div>
							<label for="fecha" class="col-md-1 control-label">Fecha</label>
							<div class="col-md-2">
								<input type="text" class="form-control input-sm" id="fecha" name="fecha" value="<?php echo date("Y-m-d");?>" readonly>
							</div>
							<label for="monto" class="col-md-1 control-label">Monto</label>
							 <div class="col-md-3">
					  <input type="text" class="form-control input-sm" id="monto" name="monto" placeholder="Monto">
					  
				  </div>
						</div>
				
				
				<div class="col-md-12">
					<div class="pull-right">
						
						<button type="submit" class="btn btn-warning" id="guardar_datos">
						 <span class="glyphicon glyphicon-search"></span> Pases jugadores
						</button>
						<button type="submit" class="btn btn-success">
						  <span class="glyphicon glyphicon-print"></span> Imprimir
						</button>
					</div>	
				</div>
				<div class="form-group row" >
					<label for="q" class="col-md-1 control-label">Busqueda</label>
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
		<div class='outer_div'></div><!-- Carga los datos ajax-->			
		</div>
	</div>		
		  <div class="row-fluid">
			<div class="col-md-12">
			
	

			
			</div>	
		 </div>
	</div>
	<hr>
	<?php
	include("footer.php");
	?>
	<script type="text/javascript" src="js/VentanaCentrada.js"></script>
	<script type="text/javascript" src="js/pases.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
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

		$(function() {
						$("#dni_jugador").autocomplete({
							source: "./ajax/autocomplete/pases.php",
							minLength: 2,
							select: function(event, ui) {
								event.preventDefault();
								$('#id_jugador').val(ui.item.id_jugador);
								$('#nombre_jugador').val(ui.item.nombre_jugador);
								$('#dni_jugador').val(ui.item.dni_jugador);
								$('#origen').val(ui.item.origen);

																
								
							 }
						}); 
						 
						
					});
					
	$("#dni_jugador" ).on( "keydown", function( event ) {
						if (event.keyCode== $.ui.keyCode.LEFT || event.keyCode== $.ui.keyCode.RIGHT || event.keyCode== $.ui.keyCode.UP || event.keyCode== $.ui.keyCode.DOWN || event.keyCode== $.ui.keyCode.DELETE || event.keyCode== $.ui.keyCode.BACKSPACE )
						{
							$("#id_jugador" ).val("");
							$("#origen" ).val("");
							$("#nombre_jugador" ).val("");
											
						}
						if (event.keyCode==$.ui.keyCode.DELETE){
							$("#nombre_jugador" ).val("");
							$("#id_jugador" ).val("");
							$("#origen" ).val("");
							$("#dni_jugador" ).val("");
						}
			});	

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

  </body>
</html>