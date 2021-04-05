<?php

/**
 * Class login
 * handles the user's login and logout process
 */
class Login
{
    /**
     * @var object The database connection
     */
    private $db_connection = null;
    /**
     * @var array Collection of error messages
     */
    public $errors = array();
    /**
     * @var array Collection of success / neutral messages
     */
    public $messages = array();

    /**
     * la función "__construct ()" se inicia automáticamente cada vez que se crea un objeto de esta clase,
      * ya sabes, cuando haces "$ login = new Login ();"
     */
    public function __construct()
    {
        //Sesión de creación / lectura, absolutamente necesaria
        session_start();

        // check the possible login actions:
        // if user tried to log out (happen when user clicks logout button)
        if (isset($_GET["logout"])) {
            $this->doLogout();
        }
        // login via post data (if user just submitted a login form)
        elseif (isset($_POST["login"])) {
            $this->dologinWithPostData();
        }
    }

    /**
     * log in with post data
     */
    private function dologinWithPostData()
    {
        // comprobar el contenido del formulario de inicio de sesión
        if (empty($_POST['user_name'])) {
          $this->errors[] = "El campo de nombre de usuario esta vacío.";
        } elseif (empty($_POST['user_password'])) {
            $this->errors[] = "El campo de contraseña esta vacío.";
        } elseif (!empty($_POST['user_name']) && !empty($_POST['user_password'])) {

            // crear una conexión de base de datos, usando las constantes de config / db.php (que cargamos en index.php)
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            // cambie el juego de caracteres a utf8 y verifíquelo
            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }

            //si no hay errores de conexión (= conexión a la base de datos en funcionamiento)
            if (!$this->db_connection->connect_errno) {

                // escapar de las cosas POST
                $user_name = $this->db_connection->real_escape_string($_POST['user_name']);

                // consulta de la base de datos, obteniendo toda la información del usuario seleccionado (permite iniciar sesión a través de la dirección de correo electrónico en el
                 // campo de nombre de usuario)
                $sql = "SELECT user_id, user_name, user_email, user_password_hash
                        FROM users
                        WHERE user_name = '" . $user_name . "' OR user_email = '" . $user_name . "';";
                $result_of_login_check = $this->db_connection->query($sql);

                // if this user exists
                if ($result_of_login_check->num_rows == 1) {

                    // get result row (as an object)
                    $result_row = $result_of_login_check->fetch_object();

                    // using PHP 5.5's password_verify() function to check if the provided password fits
                    // the hash of that user's password
                    if (password_verify($_POST['user_password'], $result_row->user_password_hash)) {

                        // write user data into PHP SESSION (a file on your server)
                        $_SESSION['user_id'] = $result_row->user_id;
						$_SESSION['user_name'] = $result_row->user_name;
                        $_SESSION['user_email'] = $result_row->user_email;
                        $_SESSION['user_login_status'] = 1;

                    } else {
                        $this->errors[] = "Usuario y/o contraseña no coinciden.";
                    }
                } else {
                    $this->errors[] = "Usuario y/o contraseña no coinciden.";
                }
            } else {
                $this->errors[] = "Problema de conexión de base de datos.";
            }
        }
    }

    /**
     * perform the logout
     */
    public function doLogout()
    {
        // delete the session of the user
        $_SESSION = array();
        session_destroy();
        // return a little feeedback message
        $this->messages[] = "Has sido desconectado.";

    }

    /**
     * simplemente devuelve el estado actual del inicio de sesión del usuario
      * @return estado de inicio de sesión del usuario booleano
     */
    public function isUserLoggedIn()
    {
        if (isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] == 1) {
            return true;
        }
        // default return
        return false;
    }
}
