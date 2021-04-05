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
			<h4><i class='glyphicon glyphicon-edit'></i> Crear Planilla de Pases</h4>
		</div>
		<div class="panel-body">
		<?php 
			include("modal/buscar_jugador.php");
			
		?>
			<form class="form-horizontal" method="post" id="editar_jugador" name="editar_jugador">
			<div id="resultados_ajax2"></div> 
				<div class="form-group row">
				  <label for="q" class="col-md-1 control-label">Dni</label>
				  <div class="col-md-3">
					  <input type="text" class="form-control input-sm" id="q" placeholder="Dni" onkeyup='load(1);'><p>
		  <span class='btn btn-primary'>
	                   <a href="#" class="btn btn-warning"  onclick="obtener_datos('<?php echo $id;?>');" onclick='load(1);' >
		                <i class="glyphicon glyphicon-search"></i> Buscar
						</a>
          </span>
					  </div>

				  <label for="nombre2" class="col-md-1 control-label">Nombre</label>
				  <div class="col-md-3">
					  <input type="text" class="form-control input-sm" id="nombre2" name="nombre2" placeholder="Nombre y Apellido">
					  
				  </div>
				  <label for="club2" class="col-md-1 control-label">Club Origen</label>
				  <div class="col-md-3">
					  <input type="text" class="form-control input-sm" id="club2" name="club2" placeholder="club">
					  
				  </div>

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
				
				
				<div class="col-md-12">
					<div class="pull-right">
						<button type="submit" class="btn btn-default" id="actualizar_datos2">
						 <span class="glyphicon glyphicon-search"></span> Pases jugadores
						</button>
						<button type="submit" class="btn btn-default">
						  <span class="glyphicon glyphicon-print"></span> Imprimir
						</button>
					</div>	
				</div>
			</form>	
			
	<div id="resultados" class='col-md-12' style="margin-top:10px"></div><!-- Carga los datos ajax -->	
		<div class='outer_div'></div><!-- Carga los datos ajax -->		
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
	<script type="text/javascript" src="js/jugadores.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	

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