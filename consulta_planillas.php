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
	$active_consultas="active";
	$title="Consultar Planillas"; 
	
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
			<h4><i class='glyphicon glyphicon-edit'></i> Reporte de Gastos</h4>
		</div>
		<div class="panel-body">
		<?php 
			include("modal/registro_gastos.php");
			
		?> 
			<form class="form-horizontal" id="datos_cotizacion">
				
						<div class="form-group row">
							
							<label for="q" class="col-md-1 control-label">Periodo</label>
							<div class="col-md-4">
								<input type="text" class="form-control input-sm" id="q" placeholder="Periodo" onkeyup='load(1);' >
							</div>
							
						
					<div class="pull-right">
						<button type="button" class="btn btn-info" onclick='load(1);'>
						 <span class="glyphicon glyphicon-search"></span> Buscar Regristros
						</button>
						<span id="loader"></span>
						<button type="submit" class="btn btn-default">
						  <span class="glyphicon glyphicon-print"></span> Imprimir
						</button>
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
	
	<script type="text/javascript" src="js/gastos.js"></script>
	

  </body>
</html>