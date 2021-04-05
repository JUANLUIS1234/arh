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
        if (empty($_POST['nombre'])){
            $errors[] = "nombre y apellido vacíos";
        } elseif (empty($_POST['dni'])){
            $errors[] = "dni vacíos";
        }  elseif (empty($_POST['fecha'])) {
            $errors[] = "fecha vacío";
        }  elseif (empty($_POST['club'])) {
            $errors[] = "club vacío";
        } elseif (empty($_POST['categoria'])){
            $errors[] = "categoria vacíos";
        }  elseif (empty($_POST['sexo'])) {
            $errors[] = "sexo vacío";
        }  elseif (empty($_POST['provincia'])) {
            $errors[] = "provincia vacío";
        } elseif (empty($_POST['direccion'])){
            $errors[] = "direccion vacíos";
        } elseif (
            !empty($_POST['nombre'])
            && !empty($_POST['dni'])
            && !empty($_POST['fecha'])
            && !empty($_POST['club']) 
             && !empty($_POST['categoria'])
            && !empty($_POST['sexo'])
            && !empty($_POST['provincia'])
             && !empty($_POST['direccion'])
           
          ){ 
            require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
            require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
            
                // escaping, additionally removing everything that could be (html/javascript-) code
                $Dni = mysqli_real_escape_string($con,(strip_tags($_POST["dni"],ENT_QUOTES)));
                $nombre = mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));
                $fecha = mysqli_real_escape_string($con,(strip_tags($_POST["fecha"],ENT_QUOTES)));
                $club = mysqli_real_escape_string($con,(strip_tags($_POST["club"],ENT_QUOTES)));
                 $categoria = mysqli_real_escape_string($con,(strip_tags($_POST["categoria"],ENT_QUOTES)));
                $sexo = mysqli_real_escape_string($con,(strip_tags($_POST["sexo"],ENT_QUOTES)));
                $provincia = mysqli_real_escape_string($con,(strip_tags($_POST["provincia"],ENT_QUOTES)));
                $direccion = mysqli_real_escape_string($con,(strip_tags($_POST["direccion"],ENT_QUOTES)));
                $sanguineo = mysqli_real_escape_string($con,(strip_tags($_POST["sanguineo"],ENT_QUOTES)));
                $social = mysqli_real_escape_string($con,(strip_tags($_POST["social"],ENT_QUOTES)));
                $telefono = mysqli_real_escape_string($con,(strip_tags($_POST["telefono"],ENT_QUOTES)));
                $correo = mysqli_real_escape_string($con,(strip_tags($_POST["correo"],ENT_QUOTES)));
                $historial = mysqli_real_escape_string($con,(strip_tags($_POST["historial"],ENT_QUOTES)));
                $documentacion = mysqli_real_escape_string($con,(strip_tags($_POST["documentacion"],ENT_QUOTES)));
                $user=$_SESSION["user_name"];
              
                    
                // Escribe el nuevo registro
                $sql = " INSERT INTO  jugadores (DNI,APELLIDO_Y_NOMBRE ,FECHA, SEXO, PROVINCIA, DIRECCION, GRUPO_SANGUINEO, OBRA_SOCIAL, TELEFONO, HISTORIAL_MEDICO, CORREO,   DOCUMENTACION,CATEGORIA,CLUB, USUARIO)
                 VALUES('".$Dni."','".$nombre."','".$fecha."','".$fecha."','".$sexo."','".$provincia."','".$direccion."','".$sanguineo."','".$social."','".$telefono."','".$historial."','".$correo."','".$documentacion."','".$categoria."','".$club ."','".$user."');";
                    $query_new_jugadores_insert = mysqli_query($con,$sql);

                    // if user has been added successfully
                    if ($query_new_jugadores_insert) {
                        $messages[] = "El/La jugador/a ha sido cargado con éxito.";
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