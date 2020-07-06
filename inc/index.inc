<?php 
//Variables de configuracion texto a utf8


// ************ ARRAYS GLOBALES OPCIONES CAMPOS  *************
$global_fondo = ['LIBRO', 'AUDIO','GRÁFICO', 'JUEGO','VIDEO'];
$global_idioma = ['ESP', 'BUL','CAT', 'FRA','ING','SLV'];
$global_tipo = ['NORMAL','NO PRESTABLE','RESTRINGIDO'];
$global_ubic = ['F1-C1',   'F1-C2', 'F1-C3', 'F1-C4', 'F1-C5', 'F2-C1', 'F2-C2', 'F2-C3', 'F2-C4', 'F2-C5', 'F2-C7', 'F2-C8', 'F2-C9', 'F3-C1', 
'F3-C2', 'F3-C3', 'F3-C4', 'F3-C5', 'F3-C6','F3-C8','F4-C1','F4-C2','F4-C3','F4-C4','F4-C6','F4-C8','F5-C1','F5-C2','F5-C3','F5-C4','F5-C5', 
'F5-C6', 'F5-C7','F6-C1','F6-C2','F6-C3','F6-C4','F6-C5','F6-C6','HHH-NO','LMV-NO','PROF-NO','XX-C4','XX-XX' ];

// ************ CAMPOS DE FORMULARIO LECTORES  *************
$CODEJEM = new CampoForm ('col','CODEJEM',  'text', 'COD', '', '', '...', true,  true);
$TITULO = new CampoForm ('fila','TITULO',  'text', 'TITULO', '', '',  '...', true, true);
$SERIE = new CampoForm ('fila','SERIE',  'text', 'SERIE', '', '',  '...', true, true);
$AUTOR = new CampoForm ('fila','AUTOR',  'text', 'AUTOR', '', '',  '...', true, true);
$EDITORIAL = new CampoForm ( 'fila','EDITORIAL', 'text', 'EDITORIAL', '', '',  '...', true, true);
$FONDO = new CampoForm ( 'col','FONDO', 'text', 'FONDO', '', '',  '...', true, true );
$TIPO = new CampoForm ('col','TIPO',  'text', 'TIPO','', '',  '...', true, true );
$UBIC = new CampoForm ('col','UBIC',  'text', 'UBIC', '', '', '...', true, true);
$IDIOMA = new CampoForm ( 'col','IDIOMA', 'text', 'IDIOMA', '', '',  '...', true, true);
$PRESTADO = new CampoForm ( 'col','PRESTADO', 'text', 'PRESTADO', '', '', '', true, true);
$FECHAALTA = new CampoForm ( 'col','FECHAALTA', 'date', 'ALTA', '', '', '', true, true);

$Fila1= new FilaForm($TITULO);
$Fila2= new FilaForm($SERIE);
$Fila3= new FilaForm($EDITORIAL);
$Fila4= new FilaForm($AUTOR);
$Fila5= new FilaForm($CODEJEM,3);
$Fila5->addCol($FECHAALTA,3);
$Fila5->addCol($PRESTADO,3);
$Fila5->addCol($IDIOMA,3);
$Fila6= new FilaForm($FONDO,4);
$Fila6->addCol($TIPO,4);
$Fila6->addCol($UBIC,4);


// ************ FORMULARIOS PARA index  *************
$Edit_Ejemplar = new Form('edit_ejemplar', '', '', $baseclass, 'despedida()');
$Edit_Ejemplar->addFilas($Fila1);
$Edit_Ejemplar->addFilas($Fila2);
$Edit_Ejemplar->addFilas($Fila3);
$Edit_Ejemplar->addFilas($Fila4);
$Edit_Ejemplar->addFilas($Fila5);
$Edit_Ejemplar->addFilas($Fila6);


// ************ FICHAS PARA index  *************
$Ges_Ejemplar= new FichaCard('ges_ejemplar', 'CONSULTA DE EJEMPLARES', null, '', '', $baseclass);
$DetalleEjemplar = new FichaModal('detalleejemplar', 'DETALLE DE EJEMPLAR', $baseclass);

// ************ FORMULARIOS-FICHA **************
$Derecha = new FormModal($Edit_Ejemplar, $DetalleEjemplar);
$Derecha->FichaModal->setDefinition($Derecha->Form->getInicioForm());
$Derecha->FichaModal->setHeader();
$Derecha->FichaModal->setBody($Derecha->Form->getBodyForm());
$Derecha->FichaModal->setFooter(null);
$Derecha->FichaModal->setEnding($Derecha->Form->getFinalForm());



?>

