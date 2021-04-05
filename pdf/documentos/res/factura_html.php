<style type="text/css">
<!--
table { vertical-align: top; }
tr    { vertical-align: top; }
td    { vertical-align: top; }
.midnight-blue{
	background:#2c3e50;
	padding: 4px 4px 4px;
	color:white;
	font-weight:bold;
	font-size:12px;
}
.silver{
	background:white;
	padding: 3px 4px 3px;
}
.clouds{
	background:#ecf0f1;
	padding: 3px 4px 3px;
}
.border-top{
	border-top: solid 1px #bdc3c7;
	
}
.border-left{
	border-left: solid 1px #bdc3c7;
}
.border-right{
	border-right: solid 1px #bdc3c7;
}
.border-bottom{
	border-bottom: solid 1px #bdc3c7;
}
table.page_footer {width: 100%; border: none; background-color: white; padding: 2mm;border-collapse:collapse; border: none;}
}
-->
</style>
<page backtop="15mm" backbottom="15mm" backleft="15mm" backright="15mm" style="font-size: 12pt; font-family: arial" >
        <page_footer>
        <table class="page_footer">
            <tr>

                <td style="width: 50%; text-align: left">
                    P&aacute;gina [[page_cu]]/[[page_nb]]
                </td>
                <td style="width: 50%; text-align: right">
                    &copy; <?php echo "obedalvarado.pw "; echo  $anio=date('Y'); ?>
                </td>
            </tr>
        </table>
    </page_footer>
    <?php include("encabezado_factura.php");?>
    <br>
    

	
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
        <tr>
           <td style="width:50%;" class='midnight-blue'>INFORMACION DEL CLUB</td>
        </tr>
		<tr>
           <td style="width:50%;" >
			<?php 
				$sql_cliente=mysqli_query($con,"select * from clubes where CLUB LIKE '%".$_SESSION['user_name']."%'");
				$rw_cliente=mysqli_fetch_array($sql_cliente);
				echo "Club: ";
				echo $rw_cliente['CLUB'];
				echo "<br> Direccion: ";
				echo $rw_cliente['DIRECCION'];
				echo "<br> Teléfono: ";
				echo $rw_cliente['TELEFONO'];
				echo "<br> Email: ";
				echo $rw_cliente['CORREO'];
			?>
			
		   </td>
        </tr>
        
   
    </table>
    
       <br>
		<table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
        <tr>
           <td style="width:35%;" class='midnight-blue'>ENTRENADOR</td>
		  <td style="width:25%;" class='midnight-blue'>FECHA</td>
		   
        </tr>
		<tr>
           <td style="width:35%;">
			<?php 
				$sql_user=mysqli_query($con,"select * from users where user_id='$id_vendedor'");
				$rw_user=mysqli_fetch_array($sql_user);
				echo $rw_user['firstname']." ".$rw_user['lastname'];
			?>
		   </td>
		  <td style="width:25%;"><?php echo date("d/m/Y");?></td>
		  
        </tr>
		
        
   
    </table>
    <br>
		<table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
        <tr>
          <td style="width:5%;" class='midnight-blue'>DNI</td>
		  <td style="width:10%;" class='midnight-blue'>JUGADOR</td>
		  <td style="width:10%;" class='midnight-blue'>EDAD</td>
		  <td style="width:10%;" class='midnight-blue'>CAMISETA</td>
		  <td style="width:15%;" class='midnight-blue'>CATEGORIA</td>
		   
        </tr>
		<tr>
           <td style="width:35%;">
			<?php 
				$sql_user=mysqli_query($con,"select * from users where user_id='$id_vendedor'");
				$rw_user=mysqli_fetch_array($sql_user);
				echo $rw_user['firstname']." ".$rw_user['lastname'];
			?>
		   </td>
		  <td style="width:25%;"><?php echo date("d/m/Y");?></td>
		  
        </tr>
		
        
   
    </table>
	
	
	  

</page>

