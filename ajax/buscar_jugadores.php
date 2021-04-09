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
	//Archivo de funciones PHP
	include("../funciones.php");
	include("../head.php");
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	
		
		
	
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
        
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 $aColumns = array('dni');//Columnas de busqueda
		 $sTable = "jugadores";
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
		$sWhere.=" order by id desc";
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
		$reload = './jugadores.php';
		//main query to fetch the data
		$sql=("SELECT * FROM  $sTable WHERE dni LIKE '%".$q."%' AND club LIKE '%".$_SESSION['user_name']."%'  LIMIT $offset,$per_page");
		$query = mysqli_query($con, $sql);
		//loop through fetched data
		
			?>
			<div class="table-responsive">
			  <table class="table">
				<tr  class="info">
					
					<th class='text-tight'>Documento</th>
					<th class='text-tight'>Jugador</th>
					<th class='text-tight'>Año de Nac.</th>
					<th class='text-tight'>Direccion</th>
					<th class='text-tight'>Telefono</th>
					<th class='text-tight'>Documentacion</th>
					<th class='text-tight'>Club</th>
					
					
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
						
						$dni=$row['DNI'];
						$jugador=$row['APELLIDO_Y_NOMBRE'];
					    $nacimiento=$row['FECHA'];
						$direccion=$row['DIRECCION'];
						$telefono=$row['TELEFONO'];
						$documentacion=$row['DOCUMENTACION'];
						$club=$row['CLUB'];
						
						
						
						
					?>
					
					
					<tr>
					
					<td class='text-tight'><?php echo $dni; ?></td>
					<td class='text-tight'><?php echo $jugador; ?></td>
					<td class='text-tight'><?php echo $nacimiento;?></td>
					<td class='text-tight'><?php echo $direccion;?></td>
					<td class='text-tight'><?php echo $telefono;?></td>
					<td class='text-tight'><?php echo $documentacion;?></td>
					<td class='text-tight'><?php echo $club;?></td>
						
						
						
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
?>
