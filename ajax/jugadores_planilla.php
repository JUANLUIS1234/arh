<?php

	/*-------------------------
	Autor: Obed Alvarado
	Web: obedalvarado.pw
	Mail: info@obedalvarado.pw
	---------------------------*/
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if($action == 'ajax'){
		//escapar, además de eliminar todo lo que podría ser código (html / javascript-)
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 $aColumns = array('dni','club');//Columnas de busqueda
		 $sTable = "jugadores";
		 $sWhere = "";
		 $ano = date("Y");
		if ( $_GET['q'] != "" )
		{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
		include 'pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 5; //cuántos registros quieres mostrar
		$adjacents  = 4; //espacio entre páginas después del número de adyacentes
		$offset = ($page - 1) * $per_page;
		//Cuente el número total de filas en su tabla * /
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './index.php';
		//consulta principal para obtener los datos
		$sql=("SELECT * FROM  $sTable WHERE dni LIKE '%".$q."%'  AND club LIKE '%".$_SESSION['user_name']."%'  LIMIT $offset,$per_page");
		$query = mysqli_query($con, $sql);
		//recorrer los datos obtenidos
		if ($numrows>0){
			
			?>
			<div class="table-responsive">
			  <table class="table">
				<tr  class="warning">
					<th>Dni</th>
					<th>Jugador</th>
					<th>Fecha Nac.</th>
					<th>Edad</th>
					<th><span class="pull-right">Camiseta</span></th>
					<th class='text-center' style="width: 36px;">Agregar</th>
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
					$dni=$row['DNI'];
					$apenombre=$row['APELLIDO_Y_NOMBRE'];
					$fecha=date('Y', strtotime($row['FECHA']));
					$edad= $ano - $fecha;
					
				?>
					<tr>
						<td><?php echo $dni; ?></td>
						<td><?php echo $apenombre; ?></td>
						<td><?php echo $fecha; ?></td>
						<td class='col-xs-1'>
						<div class="pull-right">
						<input type="text" class="form-control" style="text-align:right" id="edad_<?php echo $dni; ?>"  value="<?php echo $edad;?>" readonly>
						</div></td>
						<td class='col-xs-1'>
						<div class="pull-right">
						<input  type="text" class="form-control"style="text-align:right" value= "1"  id="camiseta_<?php echo $dni; ?>">
						</div>
						</td>
						
						<td class='text-center'><a class='btn btn-info'href="#" onclick="agregar('<?php echo $dni ?>')"><i class="glyphicon glyphicon-plus"></i></a></td>
					</tr>
					<?php
				}
				?>
				<tr>
					<td colspan=5><span class="pull-right">
					<?php
					 echo paginate($reload, $page, $total_pages, $adjacents);
					?></span></td>
				</tr>
			  </table>
			</div>
			<?php
		}
	}
?>