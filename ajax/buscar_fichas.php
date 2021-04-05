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
	if (isset($_GET['id'])){
		$id=intval($_GET['id']);
		$query=mysqli_query($con, "select * from fichajes where ID='".$id."'");
		$rw_fichas=mysqli_fetch_array($query);
		
		if ($id!=1){
		if ($delete1 = mysqli_query($con,"DELETE FROM fichajes WHERE ID='".$id."'")){
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
			  <strong>Error!</strong> No se puede borrar esta ficha administrador. 
			</div>
			<?php
		}
		
		
		
	}
		
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
         
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 $aColumns = array('contribuyente','dni','periodo','año','club','recibo');//Columnas de busqueda
		 $sTable = "fichajes";
		 $sWhere = "";
		
		if ( $_GET['q'] != "")
		{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
		$sWhere.=" order by ID desc";
		include 'pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 20; //how much records you want to show
		$adjacents  = 4; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_paginas = ceil($numrows/$per_page);
		$reload = './fichajes.php';
		//main query to fetch the data
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);
		//loop through fetched data
		if ($numrows>0){
			?>
			<div class="table-responsive">
			  <table class="table">
				<tr  class="info">
					<th class='text-tight'>Id</th>
					<th class='text-tight'>Recibo</th>
					<th class='text-tight'>Documento</th>
					<th class='text-tight'>Jugador</th>
					<th class='text-tight'>Club</th>
					<th class='text-tight'>Cuota</th>
					<th class='text-tight'>Monto</th>
					<th class='text-tight'>Periodo</th>
					<th class='text-tight'>Fecha</th>
					<th class='text-tight'>Año</th>
					<th class='text-tight'>Estado</th>
					<th><span class="pull-right">Acciones</span></th>
					
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
					    $id=$row['ID'];
						$recibo=$row['RECIBO'];
						$dni=$row['DNI'];
						$jugador=$row['CONTRIBUYENTE'];
						$club=$row['CLUB'];
						$cuota=$row['CUOTA'];
						$monto=$row['MONTO'];
						$periodo=$row['PERIODO'];
						$fecha=date('d/m/Y', strtotime($row['FECHA']));
						$ano=$row['AÑO'];
						$estado=$row['ESTADO'];
						if ($estado=='Habilitado'){$text_estado="Habilitado";$label_class='label-success';}
						else{$text_estado="Desahabilitado";$label_class='label-warning';}
						
					?>
					<input type="hidden" value="<?php echo $row['RECIBO'];?>" id="recibo<?php echo $id;?>">
					<input type="hidden" value="<?php echo $row['DNI'];?>" id="dni<?php echo $id;?>">
					<input type="hidden" value="<?php echo $row['FECHA'];?>" id="fecha<?php echo $id;?>">
					<input type="hidden" value="<?php echo $row['CONTRIBUYENTE'];?>" id="contribuyente<?php echo $id;?>">
					<input type="hidden" value="<?php echo $row['CLUB'];?>" id="club<?php echo $id;?>">
					<input type="hidden" value="<?php echo $row['CUOTA'];?>" id="cuota<?php echo $id;?>">
					<input type="hidden" value="<?php echo $row['MONTO'];?>" id="monto<?php echo $id;?>">
					<input type="hidden" value="<?php echo $row['PERIODO'];?>" id="periodo<?php echo $id;?>">
					<input type="hidden" value="<?php echo $row['AÑO'];?>" id="año<?php echo $id;?>">
					<input type="hidden" value="<?php echo $row['ESTADO'];?>" id="estado<?php echo $id;?>">
					
					
					<tr>
						<td class='text-tight'><?php echo $id; ?></td>
						<td class='text-tight'><?php echo $recibo; ?></td>
						<td class='text-tight'><?php echo $dni; ?></td>
						<td class='text-tight'><?php echo $jugador;?></td>
						<td class='text-tight'><?php echo $club;?></td>
						<td class='text-tight'><?php echo $cuota;?></td>
						<td class='text-tight'>$<?php echo $monto;?></td>
						<td class='text-tight'><?php echo $periodo;?></td>
						<td class='text-tight'><?php echo $fecha;?></td>
						<td class='text-tight'><?php echo $ano;?></td>
						<td><span class="label <?php echo $label_class;?>"><?php echo $text_estado; ?></span></td>
						
						<td ><span class="pull-right">
					<a href="#" class='btn btn-primary' title='Editar Fichas' onclick="obtener_datos('<?php echo $id;?>');" data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-edit"></i></a> 
					
					<a href="#" class='btn btn-danger' title='Borrar Fichas' onclick="eliminar('<?php echo $id; ?>')"><i class="glyphicon glyphicon-trash"></i> </a></span></td>
					
					
						
					</tr>
					<?php
				}
				?>
				<tr>
					<td colspan=6><span class="pull-left">
					<?php
					 echo paginate($reload, $page, $total_paginas, $adjacents);
					?></span></td>
				</tr>
			  </table>
			</div>
			<?php
		}
	}
?>