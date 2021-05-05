<?php

include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
// checking for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Lo sentimos, Simple PHP Login no se ejecuta en una versión de PHP menor que 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // Si está utilizando PHP 5.3 o PHP 5.4, debe incluir password_api_compatibility_library.php
     // (esta biblioteca agrega las funciones de hash de contraseñas PHP 5.5 a versiones anteriores de PHP)
    require_once("../libraries/password_compatibility_library.php");
}		
		if (empty($_POST['factura'])){
            $errors[] = "Factura vacíos";
        }elseif (empty($_POST['descripcion'])){
            $errors[] = "Descripcion vacíos";
        } elseif (empty($_POST['monto'])){
            $errors[] = "Monto vacíos";
        }  elseif (empty($_POST['concepto'])) {
            $errors[] = "Concepto vacío";
        }  elseif (empty($_POST['periodo'])) {
            $errors[] = "Periodo vacío";
           
        } elseif (
            !empty($_POST['factura'])
            && !empty($_POST['descripcion'])
            && !empty($_POST['monto'])
            && !empty($_POST['concepto'])
            && !empty($_POST['periodo']) 
            
          ){ 
            require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
			require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
			
				// escaping, additionally removing everything that could be (html/javascript-) code
                $Factura = mysqli_real_escape_string($con,(strip_tags($_POST["factura"],ENT_QUOTES)));
                $Descripcion = mysqli_real_escape_string($con,(strip_tags($_POST["descripcion"],ENT_QUOTES)));
				$Monto = mysqli_real_escape_string($con,(strip_tags($_POST["monto"],ENT_QUOTES)));
				$Concepto = mysqli_real_escape_string($con,(strip_tags($_POST["concepto"],ENT_QUOTES)));
                $Periodo = mysqli_real_escape_string($con,(strip_tags($_POST["periodo"],ENT_QUOTES)));
                $fecha=date("Y/m/d");
				$ano = date ("Y");
				$user=$_SESSION["user_name"];
              
					
               	// Escribe el nuevo registro
                    $sql = "INSERT INTO registrojb (FACTURA, DESCRIPCION, MONTO, FECHA, PERIODO, AÑO, CONCEPTO, USUARIO)
                            VALUES('".$Factura."','".$Descripcion."','".$Monto."','" . $fecha . "', '" . $Periodo . "', '" . $ano . "','".$Concepto."','" . $user . "');";
                    $query_new_registro_insert = mysqli_query($con,$sql);

                    // if user has been added successfully
                    if ($query_new_registro_insert) {
                        $messages[] = "El registro ha sido cargado con éxito.";
                    } else {
                        $errors[] = "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo.";
                    }
                
            
        } else {
            $errors[] = "Un error desconocido ocurrió.";
        }
		
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>