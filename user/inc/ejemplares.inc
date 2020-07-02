<?php 
// variables de mensaje global
$st_gestionejemplares='GESTIÓN DE EJEMPLARES';


// ************ ARRAYS GLOBALES OPCIONES CAMPOS  *************
$global_columna = [ 'C1', 'C2', 'C3', 'C4','C5', 'C6', 'C7','C8', 'C9', 'NO','XX'];
$global_fila = ['F1', 'F2','F3','F4','F5','F6','HHH','LMV','PROF', 'XX'];
$global_fondo = ['LIBRO', 'AUDIO','GRÁFICO', 'JUEGO','VIDEO'];
$global_idioma = ['ESP', 'BUL','CAT', 'FRA','ING','SLV'];
$global_tipo = ['NORMAL','NO PRESTABLE','RESTRINGIDO'];

// ************ CAMPOS DE FORMULARIO LECTORES  *************
$CODEJEM = new CampoForm ('col','CODEJEM',  'text', 'COD', '', 'Apellidos...', true,  true);
$TITULO = new CampoForm ('fila','TITULO',  'text', 'TÍTULO', '',  'Nombre...', true);
$SERIE = new CampoForm ('fila','SERIE',  'text', 'SERIE', '',  'Nombre...');
$AUTOR = new CampoForm ('fila','AUTOR',  'text', 'AUTOR', '',  'Nombre...');
$EDITORIAL = new CampoForm ( 'fila','EDITORIAL', 'text', 'EDITORIAL', '',  'Nombre...');
$FONDO = new CampoForm ( 'col','FONDO', 'select', 'FONDO', $global_fondo );
$TIPO = new CampoForm ('col','TIPO',  'select', 'TIPO',$global_tipo );
$FILA = new CampoForm ('col','FILA',  'select', 'FILA',$global_fila);
$COLUMNA = new CampoForm ('col','COLUMNA',  'select', 'COLUMNA',$global_columna);
$IDIOMA = new CampoForm ( 'col','IDIOMA', 'select', 'IDIOMA', $global_idioma);
$PRESTADO = new CampoForm ( 'col','PRESTADO', 'text', 'PRESTADO', '', '', true, true);
$FECHAALTA = new CampoForm ( 'col','FECHAALTA', 'date', 'ALTA', '', '', true, true);


$Fila1= new FilaForm($TITULO);
$Fila2= new FilaForm($SERIE);
$Fila3= new FilaForm($EDITORIAL);
$Fila4= new FilaForm($AUTOR);
$Fila5= new FilaForm($CODEJEM,3);
$Fila5->addCol($FECHAALTA,3);
$Fila5->addCol($PRESTADO,3);
$Fila5->addCol($IDIOMA,3);
$Fila6= new FilaForm($FONDO,3);
$Fila6->addCol($TIPO,3);
$Fila6->addCol($FILA,3);
$Fila6->addCol($COLUMNA,3);

// ************ FORMULARIOS PARA LECTORES  *************
$Edit_Ejemplar = new Form('edit_ejemplar', 'ejemplares.php?action=modificar', 'sm', $baseclass, 'despedida()');
$Edit_Ejemplar->addFilas($Fila1);
$Edit_Ejemplar->addFilas($Fila2);
$Edit_Ejemplar->addFilas($Fila3);
$Edit_Ejemplar->addFilas($Fila4);
$Edit_Ejemplar->addFilas($Fila5);
$Edit_Ejemplar->addFilas($Fila6);

$Add_Ejemplar = new Form('add_ejemplar', 'ejemplares.php?action=add', '', $baseclass, 'despedida()');
$Add_Ejemplar->addFilas($Fila1);
$Add_Ejemplar->addFilas($Fila2);
$Add_Ejemplar->addFilas($Fila3);
$Add_Ejemplar->addFilas($Fila4);
$CODEJEM->setValue($Ejemplares->nextid);
$FECHAALTA->setValue(date("Y-m-d"));
$PRESTADO->setValue('DISPONIBLE');
$Fila7= new FilaForm($CODEJEM,3);
$Fila7->addCol($FECHAALTA,3);
$Fila7->addCol($PRESTADO,3);
$Fila7->addCol($IDIOMA,3);
$Add_Ejemplar->addFilas($Fila7);
$Add_Ejemplar->addFilas($Fila6);

// ************ FICHAS PARA LECTORES  *************

$Ges_Ejemplar= new FichaCard('ges_ejemplar', $st_gestionejemplares, 'Nuevo', 'button', '#nuevoejemplar', $baseclass);
$Edita= new FichaCard('edita', 'DETALLE DE EJEMPLAR', 'Guardar', 'submit', 'submit', $baseclass);
$Historial= new FichaCard('historial', 'LECTURAS', 'Detalles', 'button', '#detalleejemplar', $baseclass);
$NuevoEjemplar = new FichaModal('nuevoejemplar', 'ALTA DE NUEVO EJEMPLAR', $baseclass);
$DetalleEjemplar = new FichaModal('detalleejemplar', 'DETALLE DE EJEMPLAR', $baseclass);
// ************ FORMULARIOS-FICHA **************
$Emergente = new FormModal($Add_Ejemplar, $NuevoEjemplar);
$Derecha = new FormModal($Edit_Ejemplar, $DetalleEjemplar);


?>