<?php
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
// checking for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once("../libraries/password_compatibility_library.php");
}		
		if (empty($_POST['recibo'])){
            $errors[] = "recibo vacío";
        } elseif (empty($_POST['dni'])){
            $errors[] = "dni vacíos";
        }  elseif (empty($_POST['contribuyente'])) {
            $errors[] = "contribuyente vacío";
        }  elseif (empty($_POST['club'])) {
            $errors[] = "club vacío";
        } elseif (empty($_POST['cuota'])){
            $errors[] = "cuota vacíos";
        }  elseif (empty($_POST['monto'])) {
            $errors[] = "monto vacío";
        }  elseif (empty($_POST['periodo'])) {
            $errors[] = "periodo vacío";
        } elseif (empty($_POST['estado'])){
            $errors[] = "estado vacíos";
        } elseif (
            !empty($_POST['recibo'])
            && !empty($_POST['dni'])
            && !empty($_POST['contribuyente'])
            && !empty($_POST['club']) 
             && !empty($_POST['cuota'])
            && !empty($_POST['monto'])
            && !empty($_POST['periodo'])
             && !empty($_POST['estado'])
           
          ){ 
            require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
			require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
			
				// escaping, additionally removing everything that could be (html/javascript-) code
                $Dni = mysqli_real_escape_string($con,(strip_tags($_POST["dni"],ENT_QUOTES)));
				$recibo = mysqli_real_escape_string($con,(strip_tags($_POST["recibo"],ENT_QUOTES)));
				$contribuyente = mysqli_real_escape_string($con,(strip_tags($_POST["contribuyente"],ENT_QUOTES)));
                $club = mysqli_real_escape_string($con,(strip_tags($_POST["club"],ENT_QUOTES)));
				 $cuota = mysqli_real_escape_string($con,(strip_tags($_POST["cuota"],ENT_QUOTES)));
				$monto = mysqli_real_escape_string($con,(strip_tags($_POST["monto"],ENT_QUOTES)));
				$periodo = mysqli_real_escape_string($con,(strip_tags($_POST["periodo"],ENT_QUOTES)));
                $estado = mysqli_real_escape_string($con,(strip_tags($_POST["estado"],ENT_QUOTES)));
                $ano = date ("Y");
                $fecha=date("Y-m-d");
                $user=$_SESSION["user_name"];
              
					
               	// Escribe el nuevo registro
                    $sql = "INSERT INTO fichajes (RECIBO,DNI, CONTRIBUYENTE, FECHA, CLUB, CUOTA, MONTO, PERIODO, AÑO, ESTADO, USUARIO)
                        VALUES('".$recibo."','".$Dni."','".$contribuyente."','" . $fecha . "', '" . $club . "', '" . $cuota . "','".$monto."','" . $periodo . "','".$ano."','".$estado."','".$user."');";
                    $query_new_ficha_insert = mysqli_query($con,$sql);

                    // if user has been added successfully
                    if ($query_new_ficha_insert) {
                        $messages[] = "La ficha ha sido cargado con éxito.";
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