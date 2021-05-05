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
        if (empty($_POST['club'])){
            $errors[] = "club vacíos";
        } elseif (empty($_POST['torneo'])){
            $errors[] = "torneo vacíos";
        }  elseif (empty($_POST['categoria'])) {
            $errors[] = "categoria vacío";
        } elseif (
            !empty($_POST['club'])
            && !empty($_POST['torneo'])
            && !empty($_POST['categoria'])
            
           
          ){ 
            require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
            require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
            
                // escaping, additionally removing everything that could be (html/javascript-) code
                $club = mysqli_real_escape_string($con,(strip_tags($_POST["club"],ENT_QUOTES)));
                $torneo = mysqli_real_escape_string($con,(strip_tags($_POST["torneo"],ENT_QUOTES)));
                $categoria = mysqli_real_escape_string($con,(strip_tags($_POST["categoria"],ENT_QUOTES)));
                            
                    
                // Escribe el nuevo registro
                $sql = " INSERT INTO  planilla (club,torneo ,categoria)
                 VALUES('".$club."','".$torneo."','".$categoria."');";
                    $completar_planilla = mysqli_query($con,$sql);

                    // if user has been added successfully
                    if ($completar_planilla) {
                        $messages[] = "El/La planilla ha sido cargado con éxito.";
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