<?php

	/*-------------------------
	Autor: Obed Alvarado
	Web: obedalvarado.pw
	Mail: info@obedalvarado.pw
	---------------------------*/
	/* Conexion de la base de datos*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$id=intval($_GET['id']);
		$query=mysqli_query($con, "select * from registros where CODIGO='".$id."'");
		$rw_registro=mysqli_fetch_array($query);
		$count=$rw_registro['CODIGO'];
		if ($id!=1){
			if ($delete1=mysqli_query($con,"DELETE FROM registros WHERE CODIGO='".$id."'")){
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Aviso!</strong> Datos eliminados exitosamente.
			</div>
			<?php 
		}else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente.
			</div>
			<?php
			
		}
			
		} else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> No se puede borrar el registro administrador. 
			</div>
			<?php
		}
		
		
		
	}
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 $aColumns = array('DESCRIPCION', 'MONTO','CONCEPTO','PERIODO');//Columnas de busqueda
		 $sTable = "registros";
		 $sWhere = "";
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
		$sWhere.=" order by CODIGO desc";
		include 'pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10; //how much records you want to show
		$adjacents  = 4; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './registros_gastos.php';
		//main query to fetch the data
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);
		//loop through fetched data
		if ($numrows>0){
			
			?>
			<div class="table-responsive">
			  <table class="table">
				<tr  class="info">
					<th>ID</th>
					<th>Descripcion</th>
					<th>Monto</th>
					<th>Concepto</th>
					<th>Periodo</th>
					<th>Agregado</th>
					<th><span class="pull-right">Acciones</span></th>
					
				</tr>
				<?php
				$sumar_ingresos=0;
				$sumar_egresos=0;
				while ($row=mysqli_fetch_array($query)){
						$id=$row['CODIGO'];
						$descripcion=$row['DESCRIPCION'];
						$monto=$row['MONTO'];
						$concepto=$row['CONCEPTO'];
						$periodo=$row['PERIODO'];
						$date_added= date('d/m/Y', strtotime($row['FECHA']));
						if ($concepto == 'Ingreso') {
							$sumar_ingresos=$sumar_ingresos + $monto;
						}
						if ($concepto == 'Egreso') {
							$sumar_egresos=$sumar_egresos + $monto;
						}
						$control_registros=$sumar_ingresos - $sumar_egresos;
					?>
					
				<input type="hidden" value="<?php echo $row['DESCRIPCION'];?>" id="descripcion<?php echo $id;?>">
				<input type="hidden" value="<?php echo $row['MONTO'];?>" id="monto<?php echo $id;?>">
				<input type="hidden" value="<?php echo $row['CONCEPTO'];?>" id="concepto<?php echo $id;?>">
				<input type="hidden" value="<?php echo $row['PERIODO'];?>" id="periodo<?php echo $id;?>">
				<input type="hidden" value="<?php echo $row['FECHA'];?>" id="fecha<?php echo $id;?>">
				<input type="hidden" value="<?php echo $row['AÑO'];?>" id="año<?php echo $id;?>">
				
					<tr>
						<td><?php echo $id; ?></td>
						<td><?php echo $descripcion ?></td>
						<td>$<?php echo number_format ($monto,2); ?></td>
						<td ><?php echo $concepto; ?></td>
						<td ><?php echo $periodo; ?></td>
						<td><?php echo $date_added;?></td>
						
					<td ><span class="pull-right">
					<a href="#" class='btn btn-primary' title='Editar Registro' onclick="obtener_datos('<?php echo $id;?>');" data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-edit"></i></a> 
					
					<a href="#" class='btn btn-danger' title='Borrar Registro' onclick="eliminar('<?php echo $id; ?>')"><i class="glyphicon glyphicon-trash"></i> </a></span></td>
						
					</tr>
					<?php
				}
				?>
				<tr>
					<td colspan=9><span class="pull-right">
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