<?php 
// variables de mensaje global
$st_despedida='Procesando petici�n...';
$st_lectores='Abriendo gesti�n de lectores';
$st_ejemplares='Abriendo gesti�n de ejemplares';
$st_prestamos='Abriendo gesti�n de pr�stamos';
$st_admin='Abriendo gesti�n de administraci�n';
$st_accion='ACCI�N REALIZADA';

// MANEJO DE SESIONES
$session_options = array();
session_start($session_options);
if( !isset($_SESSION['ok']) )  $_SESSION['ok'] = false;

// Establecer tiempo de vida de la sesi�n en segundos
$inactividad = 600;
// Comprobar si $_SESSION["timeout"] est� establecida
if(isset($_SESSION["timeout"])){
    // Calcular el tiempo de vida de la sesi�n (TTL = Time To Live)
    $sessionTTL = time() - $_SESSION["timeout"];
    if($sessionTTL > $inactividad){
        session_destroy();
        header("Location: ../login.php");
    }
}
// El siguiente key se crea cuando se inicia sesi�n
$_SESSION["timeout"] = time();


?>

