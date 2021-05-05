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
		$num_planilla=intval($_GET['id']);
		$del1="delete from planilla where num_planilla='".$num_planilla."'";
		$del2="delete from detalle_planilla where num_planilla='".$num_planilla."'";
		if ($delete1=mysqli_query($con,$del1) and $delete2=mysqli_query($con,$del2)){
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Aviso!</strong> Datos eliminados exitosamente
			</div>
			<?php 
		}else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> No se puedo eliminar los datos
			</div>
			<?php
			
		}
	}
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		  $sTable = "planilla, clubes, users";
		 $sWhere = "";
		 $sWhere.=" WHERE planilla.club=clubes.club and planilla.user_id=users.user_id and planilla.club LIKE '%".$_SESSION['user_name']."%'";
		if ( $_GET['q'] != "" )
		{
		$sWhere.= " and  (planilla.num_planilla like '%$q%')";
			
		}
		
		$sWhere.=" order by planilla.id_planilla desc";
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
		$reload = './planilla.php';
		//main query to fetch the data
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);
		//loop through fetched data
		if ($numrows>0){
			echo mysqli_error($con);
			?>
			<div class="table-responsive">
			  <table class="table">
				<tr  class="info">
					<th>Planilla</th>
					<th>Fecha</th>
					<th>Club</th>
					<th>Entrenador</th>
					<th>Torneo</th>
                    <th>Categoria</th>
					<th class='text-right'>Acciones</th>
					
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
						$num_planilla=$row['num_planilla'];
						$fecha=date("d/m/Y", strtotime($row['fecha']));
						$club=$row['club'];
						$nombre_vendedor=$row['firstname']." ".$row['lastname'];
						$torneo=$row['torneo'];
                        if ($torneo==1){$text_estado1="Apertura";$label_class1='label-danger';}
						elseif ($torneo==2){$text_estado1="Clausura";$label_class1='label-danger';}
						elseif($torneo==3){$text_estado1="Anual";$label_class1='label-danger';}
						$categoria=$row['categoria'];
						if ($categoria==1){$text_estado="1-Caballeros";$label_class='label-success';}
						elseif ($categoria==2){$text_estado="1-Damas";$label_class='label-success';}
						elseif ($categoria==3){$text_estado="Sub 19";$label_class='label-success';}
                        elseif ($categoria==4){$text_estado="Sub 16";$label_class='label-success';}
                        elseif ($categoria==5){$text_estado="Sub 14";$label_class='label-success';}
                        elseif ($categoria==6){$text_estado="Sub 12";$label_class='label-success';}
						elseif($categoria==7){$text_estado="Infantiles";$label_class='label-success';}
						
					?>
					<tr>
						<td><?php echo $num_planilla; ?></td>
						<td><?php echo $fecha; ?></td>
						<td><?php echo $club; ?></td>
						<td><?php echo $nombre_vendedor; ?></td>
						<td><span class="label <?php echo $label_class1;?>"><?php echo $text_estado1; ?></span></td>
                        <td><span class="label <?php echo $label_class;?>"><?php echo $text_estado; ?></span></td>
										
					<td class="text-right">
						<a href="editar_planilla.php?id_planilla=<?php echo $id_planilla;?>" class='btn btn-default' title='Editar Planilla' ><i class="glyphicon glyphicon-edit"></i></a> 
						<a href="#" class='btn btn-default' title='Descargar factura' onclick="imprimir_factura('<?php echo $id_planilla;?>');"><i class="glyphicon glyphicon-download"></i></a> 
						<a href="#" class='btn btn-default' title='Borrar planilla' onclick="eliminar('<?php echo $num_planilla; ?>')"><i class="glyphicon glyphicon-trash"></i> </a>
					</td>
						
					</tr>
					<?php
				}
				?>
				<tr>
					<td colspan=7><span class="pull-right"><?php
					 echo paginate($reload, $page, $total_pages, $adjacents);
					?></span></td>
				</tr>
			  </table>
			</div>
			<?php
		}
	}
?>