<?php
// checking for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Lo sentimos, Simple PHP Login no se ejecuta en una versión de PHP menor que 5.3.7.");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // si está utilizando PHP 5.3 o PHP 5.4, debe incluir password_api_compatibility_library.php
     // (esta biblioteca agrega las funciones de hash de contraseña de PHP 5.5 a versiones anteriores de PHP)
    require_once("libraries/password_compatibility_library.php");
}

// include the configs / constants for the database connection
require_once("config/db.php");

// load the login class
require_once("classes/Login.php");

//crear un objeto de inicio de sesión. cuando se crea este objeto, hará todas las cosas de inicio / cierre de sesión automáticamente
// por lo que esta única línea maneja todo el proceso de inicio de sesión. en consecuencia, puede simplemente ...
$login = new Login();

// ... pregunte si hemos iniciado sesión aquí:
if ($login->isUserLoggedIn() == true) {
    //el usuario ha iniciado sesión. Puede hacer lo que quiera aquí.
     // para fines de demostración, simplemente mostramos la vista "ha iniciado sesión".
   header("location: index.php");

} else {
    //el usuario no ha iniciado sesión. Puede hacer lo que quiera aquí.
     // para fines de demostración, simplemente mostramos la vista "no ha iniciado sesión".
    
    ?>
	<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>Inicio Sesion | Login</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <!-- CSS  -->
   <link href="css/login.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
 <div class="container">
        <div class="card card-container">
            <img id="profile-img" class="profile-img-card" src="img/avatar_2x.png" />
            <p id="profile-name" class="profile-name-card"></p>
            <form method="post" accept-charset="utf-8" action="login.php" name="loginform" autocomplete="off" role="form" class="form-signin">
			<?php
				// mostrar posibles errores / comentarios (del objeto de inicio de sesión)
				if (isset($login)) {
					if ($login->errors) {
						?>
						<div class="alert alert-danger alert-dismissible" role="alert">
						    <strong>Error!</strong> 
						
						<?php 
						foreach ($login->errors as $error) {
							echo $error;
						}
						?>
						</div>
						<?php
					}
					if ($login->messages) {
						?>
						<div class="alert alert-success alert-dismissible" role="alert">
						    <strong>Aviso!</strong>
						<?php
						foreach ($login->messages as $message) {
							echo $message;
						}
						?>
						</div> 
						<?php 
					}
				}
				?>
                <span id="reauth-email" class="reauth-email"></span>
                <input class="form-control" placeholder="Usuario" name="user_name" type="text" value="" autofocus="" required>
                <input class="form-control" placeholder="Contraseña" name="user_password" type="password" value="" autocomplete="off" required>
                <button type="submit" class="btn btn-lg btn-success btn-block btn-signin" name="login" id="submit">Iniciar Sesión</button>
                <!--<a href="">Registra tu Asociacion</a>-->
            </form><!-- /form -->
            
        </div><!-- /card-container -->
    </div><!-- /container -->
  </body>
</html>

	<?php
}


