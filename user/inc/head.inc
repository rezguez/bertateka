<?php 
// variables de mensaje global
$st_despedida='Procesando petición...';
$st_lectores='Abriendo gestión de lectores';
$st_ejemplares='Abriendo gestión de ejemplares';
$st_prestamos='Abriendo gestión de préstamos';
$st_admin='Abriendo gestión de administración';
$st_accion='ACCIÓN REALIZADA';

// MANEJO DE SESIONES
$session_options = array();
session_start($session_options);
if( !isset($_SESSION['ok']) )  $_SESSION['ok'] = false;

// Establecer tiempo de vida de la sesión en segundos
$inactividad = 600;
// Comprobar si $_SESSION["timeout"] está establecida
if(isset($_SESSION["timeout"])){
    // Calcular el tiempo de vida de la sesión (TTL = Time To Live)
    $sessionTTL = time() - $_SESSION["timeout"];
    if($sessionTTL > $inactividad){
        session_destroy();
        header("Location: ../login.php");
    }
}
// El siguiente key se crea cuando se inicia sesión
$_SESSION["timeout"] = time();


?>

