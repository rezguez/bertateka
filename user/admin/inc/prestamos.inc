<?php 
//Variables de configuracion texto a utf8
$st_alta='ALTA DE NUEVO PRÉSTAMO';
$st_gestion='GESTIÓN DE PRESTAMOS';
$st_alta='ALTA DE NUEVO PRÉSTAMO';

// ************ ARRAYS GLOBALES OPCIONES CAMPOS  *************
$global_cursos = ['ADULTOS','ESO 1','ESO 2', 'INF 3','INF 4','INF 5','OTROS','PRI 1','PRI 2','PRI 3','PRI 4','PRI 5','PRI 6'];


// ************ CAMPOS DE FORMULARIO PRESTAMOS  *************
$FECHAPRESTAMO = new CampoForm ('fila','FECHAPRESTAMO',  'hidden', '', '', '', true,  true);
$CURSO = new CampoForm ('fila','CURSO',  'select', 'CURSO', '',  '', true);
$CODLEC = new CampoForm ( 'fila','CODLEC', 'select', '', '',  '', true, true);
$CODEJ = new CampoForm ('fila','CODEJ',  'text', '', '',  '',true);
$TITULO = new CampoForm ('fila','TITULO',  'text', 'TITULO', '');


$Fila1 = new FilaForm($FECHAPRESTAMO);
$Fila2 = new FilaForm($CURSO);
$Fila2->addCol($CODLEC);
$Fila3 = NEW FilaForm($CODEJ);
$Fila4 = new FilaForm($TITULO);



// ************ FORMULARIOS PARA PRESTAMOS  *************
$Vacio= new Form('addprestamo', 'prestamos.php?action=add' , '', $baseclass, 'despedida()');
$Vacio->addFilas($Fila1);
$Vacio->addFilas($Fila2);
$Vacio->addFilas($Fila3);
$Vacio->addFilas($Fila4);

// ************ FICHAS PARA PRESTAMOS  *************

$Ges_Prestamo= new FichaCard('ges_prestamo', $st_gestion, 'Nuevo', 'button', '#nuevoprestamo', $baseclass);

$NuevoPrestamo = new FichaModal('nuevoprestamo', $st_alta, $baseclass);

// ************ FORMULARIOS-FICHA **************
$Emergente = new FormModal($Vacio, $NuevoPrestamo);

?>