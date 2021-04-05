<?php	
date_default_timezone_set('America/Argentina/La_Rioja');
setlocale(LC_TIME, 'Spanish');
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: ../login.php");
		exit;
    }