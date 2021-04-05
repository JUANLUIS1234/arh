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
		if (empty($_POST['dni2'])){
            $errors[] = "dni vacío";
        } elseif (empty($_POST['recibo2'])){
            $errors[] = "recibo vacíos";
        }  elseif (empty($_POST['contribuyente2'])) {
            $errors[] = "contribuyente vacío";
        }  elseif (empty($_POST['club2'])) {
            $errors[] = "club vacío";
        } elseif (empty($_POST['cuota2'])){
            $errors[] = "cuota vacíos";
        }  elseif (empty($_POST['monto2'])) {
            $errors[] = "monto vacío";
        }  elseif (empty($_POST['periodo2'])) {
            $errors[] = "periodo vacío";
        } elseif (empty($_POST['estado2'])){
            $errors[] = "estado vacíos";
        } elseif (
            !empty($_POST['recibo2'])
            && !empty($_POST['dni2'])
            && !empty($_POST['contribuyente2'])
            && !empty($_POST['club2']) 
             && !empty($_POST['cuota2'])
            && !empty($_POST['monto2'])
            && !empty($_POST['periodo2'])
             && !empty($_POST['estado2'])
           
          )
        { 
            require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
			require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
			
				// escaping, additionally removing everything that could be (html/javascript-) code
                 $dni = mysqli_real_escape_string($con,(strip_tags($_POST["dni2"],ENT_QUOTES)));
				$recibo = mysqli_real_escape_string($con,(strip_tags($_POST["recibo2"],ENT_QUOTES)));
				$contribuyente = mysqli_real_escape_string($con,(strip_tags($_POST["contribuyente2"],ENT_QUOTES)));
                $club = mysqli_real_escape_string($con,(strip_tags($_POST["club2"],ENT_QUOTES)));
				 $cuota = mysqli_real_escape_string($con,(strip_tags($_POST["cuota2"],ENT_QUOTES)));
				$monto = mysqli_real_escape_string($con,(strip_tags($_POST["monto2"],ENT_QUOTES)));
				$periodo = mysqli_real_escape_string($con,(strip_tags($_POST["periodo2"],ENT_QUOTES)));
                $estado = mysqli_real_escape_string($con,(strip_tags($_POST["estado2"],ENT_QUOTES)));
				
				$id=intval($_POST['mod_id']);
					
               
					// write new user's data into database
                    $sql = "UPDATE fichajes SET RECIBO='".$recibo."', MONTO='".$monto."', DNI='".$dni."', CONTRIBUYENTE='".$contribuyente."', CLUB='".$club."', CUOTA='".$cuota."', PERIODO='".$periodo."', ESTADO='".$estado."'
                            WHERE ID ='".$id."';";
                    $query_update = mysqli_query($con,$sql);

                    // if user has been added successfully
                    if ($query_update) {
                        $messages[] = "La cuenta ha sido modificada con éxito.";
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