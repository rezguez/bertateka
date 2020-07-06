<?php
//Variables de configuracion general

// variables de mensaje global
$st_despedida='Procesando petición...';
$st_consulta='Abriendo consulta pública de ejemplares';
$st_stats='Abriendo las estadísticas públicas';
$st_accion='ACCIÓN REALIZADA';

//Variables de configuracion para index.php
$baseclass='oxb';

//Clases necesarias para index.php
include_once 'clases/Modelo.php';
include_once 'clases/UsuariosModelo.php';
include_once 'clases/FichaForm.php';

// *************** Para mensaje de ACCION REALIZADA *************
$mimensaje='0';

// ************ VALIDACION SESION USUARIO *************

if ( isset($_POST['usuario'])) {
    $session_options = array();
    session_start();
    $Usuario = new UsuariosModelo();
    $datos_usuario = $Usuario->validar($_POST);
    
    if (!empty($datos_usuario)){
        $_SESSION['usuario']=$datos_usuario[0]['usuario'];
        $_SESSION['nombre']=$datos_usuario[0]['nombre'];
        $_SESSION['email']=$datos_usuario[0]['email'];
        $_SESSION['role']=$datos_usuario[0]['role'];
        $_SESSION['ok']=true;
        header('Location: user/prestamos.php');
    }
    else {
        $mimensaje = "Usuario y contraseña son incorrectos";
        $_SESSION['ok']=false;
    }
}
else {
    $_SESSION['ok']=false;
}


include_once 'inc/head.inc';
include_once 'inc/main.inc';

?>

<!-- EMPIEZA FILA PRINCIPAL -->
<div class='row'>

	<div id="loginbox" style="margin-top:30px;" class="mainbox col-md-4 mx-auto">
		<div class="card card-info" style="margin-bottom: 50px; box-shadow: 3px 4px 15px 1px rgba(0,0,0,0.53);">
			<h5	class="card-header  <?=$baseclass; ?> text-center font-weight-bold ">Identificación	</h5>
			<div style="padding-top: 30px" class="card-body <?=$baseclass; ?>fondo">
<!-- formulario -->
				<form id="loginform" class="form-horizontal " role="form" method="post">
					<div style="margin-bottom: 25px" class="input-group">
						<input id="login-username" type="text" class="form-control"
							name="usuario" value="" placeholder="usuario">
					</div>
					<div style="margin-bottom: 25px" class="input-group">
						<input id="login-password" type="password" class="form-control"
							name="password" placeholder="contraseña">
					</div>
					<!-- Button -->
					<div class="mainbox  mx-auto">
						<button class="btn btn-lg  <?=$baseclass; ?>but2 btn-block" type="submit">Entrar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>



<div class='row align-items-center ' style='height: 300px;'>
<div class='col-3'></div>
<div class='col'>
<!-- 		Cookies	 -->
	<div class='input-group  mb-6 pl-0 mx-auto'>
		<div class='input-group-prepend col-3 p-2'>
			<div
				class='input-group-text <?=$baseclass; ?>label col col-form-label badge mb-6'>
				A propósito de las cookies:</div>
		</div>
		<div class="badge badge-light">
			En este sitio solo se usan cookies para controlar la identificación y
			el acceso de los usuarios/as autorizados/as, pero no del público general.  <br>
			Para que usted pueda acceder con su usuario y contraseña,
			las cookies son <span class='marca <?php echo $baseclass; ?>'>necesarias</span>
			y consiente implícitamente en <span class='marca <?php echo $baseclass; ?>'>aceptar</span>
			su uso.
			
		</div>
	</div>
</div>
</div><!-- FIN mainbox -->
</div><!-- FIN container -->
</main><!-- FIN MAIN -->

<?php
include_once 'inc/footer.inc';
?>