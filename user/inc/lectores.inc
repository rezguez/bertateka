<?php
//Variables de configuracion texto a utf8
$st_gestionlectores='GESTIÓN DE LECTORES';

// ************ ARRAYS GLOBALES OPCIONES CAMPOS  *************
$global_cursos = ['ADULTOS','ESO 1','ESO 2', 'INF 3','INF 4','INF 5','OTROS','PRI 1','PRI 2','PRI 3','PRI 4','PRI 5','PRI 6'];

// ************ CAMPOS DE FORMULARIO LECTORES  *************
$APELLIDOS = new CampoForm('fila','APELLIDOS', 'text', 'APELLIDOS', Array(),'Apellidos...', true);
$NOMBRE = new CampoForm('fila','NOMBRE', 'text', 'NOMBRE', Array(),'NOMBRE...', true);
$CURSO = new CampoForm( 'col', 'CURSO','select', 'CURSO', $global_cursos);
$FECHAALTA = new CampoForm( 'col', 'FECHAALTA','text', 'ALTA', Array(), '','' , true, true);
$CODIGOLECTOR = new CampoForm( 'col','CODIGOLECTOR', 'text', 'CÓDIGO', Array(),'','',true,true);
$NACIMIENTO = new CampoForm( 'col','NACIMIENTO', 'text', 'NACIMIENTO', Array(), 'Año de nacimiento...');
$Fila1= new FilaForm($APELLIDOS);
$Fila2= new FilaForm($NOMBRE);
$Fila3= new FilaForm($CODIGOLECTOR);
$Fila3->addCol($FECHAALTA);
$Fila3->addCol($NACIMIENTO);
$Fila3->addCol($CURSO);

// ************ FORMULARIOS PARA LECTORES  *************
$Edit_Lector = new Form('edit_lector', 'lectores.php?action=modificar', 'sm', $baseclass, 'despedida()');
$Edit_Lector->addFilas($Fila1);
$Edit_Lector->addFilas($Fila2);
$Edit_Lector->addFilas($Fila3);

$Add_Lector = new Form('add_lector', 'lectores.php?action=add', '', $baseclass,'despedida()');
$Add_Lector->addFilas(new FilaForm($APELLIDOS));
$Add_Lector->addFilas(new FilaForm($NOMBRE));
$CODIGOLECTOR->setValue($Lectores->nextid);
$FECHAALTA->setValue(date("Y-m-d"));
$Fila4= new FilaForm($CODIGOLECTOR,3);
$Fila4->addCol($FECHAALTA,3);
$Fila4->addCol($NACIMIENTO,3);
$Fila4->addCol($CURSO,3);
$Add_Lector->addFilas($Fila4);

// ************ FICHAS PARA LECTORES  *************
$Ges_Lector= new FichaCard('ges_lector', $st_gestionlectores, 'Nuevo', 'button', '#nuevolector', $baseclass);
$Edita= new FichaCard('edita', 'DETALLE', 'Guardar', 'submit', 'submit', $baseclass);
$NuevoLector = new FichaModal('nuevolector', 'ALTA DE NUEVO LECTOR/A', $baseclass);

// ************ FORMULARIOS-FICHA **************
$Emergente = new FormModal($Add_Lector, $NuevoLector);
$Derecha = new FormCard($Edit_Lector, $Edita);


?>