<?php
	/*-------------------------
	Autor: Obed Alvarado
	Web: obedalvarado.pw
	Mail: info@obedalvarado.pw
	---------------------------*/
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
$session_id= session_id();
if (isset($_POST['id'])){$id=$_POST['id'];}
if (isset($_POST['camiseta'])){$camiseta=$_POST['camiseta'];}
if (isset($_POST['edad'])){$edad=$_POST['edad'];}


	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	//Archivo de funciones PHP
	include("../funciones.php");
if (!empty($id) and !empty($camiseta)  and !empty($edad))
{
	$consulta=mysqli_query($con, "SELECT * FROM tmp where dni='$id'");
	$resulta=mysqli_fetch_array($consulta);
	if ($resulta >0) {
		?>
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Aviso!</strong> El/la jugador/a ya ha sido selecionado, elige a otro/a.
			</div>
			<?php 
		
	}else{ $insert_tmp=mysqli_query($con, "INSERT INTO  tmp (dni,camiseta,edad,session_id) VALUES ('$id','$camiseta', '$edad','$session_id')" );}


}
if (isset($_GET['id']))//codigo elimina un elemento del array
{
$id_tmp=intval($_GET['id']);	
$delete=mysqli_query($con, "DELETE FROM tmp WHERE id_tmp='".$id_tmp."'");
}
//$simbolo_moneda=get_row('perfil','moneda', 'id_perfil', 1);
?>
<table class="table">
<tr>
	<th class='text-center'>DNI</th>
	<th class='text-center'>CAMISETA</th>
	<th>JUGADOR</th>
	<th class='text-center'>EDAD</th>
	<th class='text-center'>ELIMINAR</th>
	
	<th></th>
</tr>
<?php
	//$sumador_total=0;
	$sql=mysqli_query($con, "select * from jugadores, tmp where jugadores.dni=tmp.dni and tmp.session_id='".$session_id."'");
	while ($row=mysqli_fetch_array($sql))
	{
	$id_tmp=$row["id_tmp"];
	$dni=$row["dni"];
	$jugador=$row["APELLIDO_Y_NOMBRE"];
	$camiseta=$row['camiseta'];
	$edad=$row['edad'];
	
	
	//$precio_venta=$row['precio_tmp'];
	//$precio_venta_f=number_format($precio_venta,2);//Formateo variables
	//$precio_venta_r=str_replace(",","",$precio_venta_f);//Reemplazo las comas
	//$precio_total=$precio_venta_r*$cantidad;
	//$precio_total_f=number_format($precio_total,2);//Precio total formateado
	//$precio_total_r=str_replace(",","",$precio_total_f);//Reemplazo las comas
	//$sumador_total+=$precio_total_r;//Sumador
	
		?>
		<tr>
			<td class='text-center'><?php echo $dni;?></td>
			<td class='text-center'><?php echo $camiseta;?></td>
			<td><?php echo $jugador;?></td>
			<td class='text-center'><?php echo $edad;?></td>
			
			<td class='text-center'><a href="#" onclick="eliminar('<?php echo $id_tmp ?>')"><i class="glyphicon glyphicon-trash"></i></a></td>
		</tr>		
		<?php
	}
	//$impuesto=get_row('perfil','impuesto', 'id_perfil', 1);
	//$subtotal=number_format($sumador_total,2,'.','');
	//$total_iva=($subtotal * $impuesto )/100;
	//$total_iva=number_format($total_iva,2,'.','');
	//$total_factura=$subtotal+$total_iva;

?>


</table>
